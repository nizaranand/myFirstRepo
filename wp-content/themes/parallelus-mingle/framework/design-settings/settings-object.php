<?php

class design_settings_admin extends framework_admin_object_ambassador_1 {

	// Add hooks & crooks
	function add_actions() {
		
		//include JS for drag and drop layout manager (cutsom jquery UI)
		add_action('admin_print_scripts-' . $this->parent_menu . '_page_' . $this->slug, array(&$this, 'load_admin_js'));
		
	}

	function after_settings_init() {
		/* nothing */
  	}

	function validate_sumbission() {

		// Design defaults
		if ($this->navigation == 'design_settings') {
			if (!$_POST) return false;
			$this->fields = array(
				'var' => array('label', 'logo', 'logo_width', 'logo_height', 'skin', 'skin_custom', 'sidebar', 'css_custom', 'js_custom'),
				'array' => array(
					'fonts' => array('heading', 'heading_cufon', 'heading_standard', 'body'),
					'layout' => array('header', 'footer', 'default', 'home', 'page', 'post', 'blog', 'category', 'author', 'tag', 'date', 'search', 'error', 'bp', 'bp-activity', 'bp-blogs', 'bp-forums', 'bp-groups', 'bp-groups-single', 'bp-groups-single-plugins', 'bp-members', 'bp-members-single', 'bp-members-single-plugins' )
				)
			);
			
			// Force these values to be the same
			// $_POST['bp-members-single-plugins'] = $_POST['bp-members-single'];

			// Set the index
			$_POST['index'] = 'design_setting';
		}


		// Layouts
		if ($this->navigation == 'layouts') {
			if (!$_POST) return false;
			$this->fields = array(
				'var' => array('label', 'key', 'header', 'footer', 'skin'),
				'array' => array('layout_fields')
			);
			// Save data in 'design => layouts' (set by keys)
			if (!esc_attr($_POST['label'])) {
				$this->set_navigation('layout');
				return $this->error(__('You must enter a template name.', THEME_NAME)); 
			}
			if (!($name = esc_attr($_POST['key']))) {
				$this->set_navigation('layout');
				return $this->error(__('You must specify a unique key.', THEME_NAME)); 
			}
			
			// manage the funky JS array saved in the hidden field
			parse_str($_POST['layout_fields'], $layout_fields);
			$_POST['layout_fields'] = $layout_fields;
			
			$name = sanitize_title($name);
			$_POST['key'] = $name; // replace value with sanitized version
			$_POST['index'] = $name;
		}
		
		
		// Slideshows
		if ($this->navigation == 'slideshows') {
			if (!$_POST) return false;
			$this->fields = array(
				'var' => array('label', 'key', 'width', 'height', 'timing', 'transition', 'speed', 'pause_on_hover', 'columns'),
				'array' => array('slides_1', 'slides_2', 'slides_3', 'slides_4')
			);
			// Save data in 'design => layouts' (set by keys)
			if (!esc_attr($_POST['label'])) {
				$this->set_navigation('slideshow');
				return $this->error(__('You must enter a name.', THEME_NAME)); 
			}
			if (!($name = esc_attr($_POST['key']))) {
				$this->set_navigation('slideshow');
				return $this->error(__('You must specify a unique key.', THEME_NAME)); 
			}
						
			$name = sanitize_title($name);
			$_POST['key'] = $name; // replace value with sanitized version
			$_POST['index'] = $name;
		}
		
		// Add/Edit Slide
		if ($this->navigation == 'slide' && $this->action == 'add') {

			// Default field values for a new slide
			$this->default = array('target_blank' => '0', 'format' => 'image', 'position' => 'left', 'transition' => '');
	
		}
		
		if ($this->navigation == 'slideshow') {
			
			// This case means we're adding a new slideshow
			if ($this->action == 'add') {
				
				// Set default field values
				$this->default = array('timing' => '6', 'transition' => 'fade', 'pause_on_hover' => '0', 'columns' => '1');
				
		
			// The alternative (else) is that we're saving a slide for the current slide show.	
			} else {
				
				// we want to ignore the test for !$_POST if we are moving a slide position (or it will fail)
				if ($this->action != 'move' && $this->action != 'delete') {
					
					// Check if we have a postback event, if so we are doing a save/add
					if (!$_POST) return false;

					$this->fields = array(
						'var' => array('key', 'media', 'link', 'target_blank', 'format', 'position', 'transition', 'content'),
						'array' => array()
					);

					// no keys or indexes for slides. Auto-generate and stored in hidden fields.
					if (!$_POST['key']) { 
						$_POST['key'] = base_convert(microtime(), 10, 36);
					}
					$_POST['index'] = $_POST['key'];
					
				}
			}
		}

		// Top Graphics
		if ($this->navigation == 'top_graphics') {
			if (!$_POST) return false;
			$this->fields = array(
				'var' => array('label', 'key', 'width', 'height', 'background', 'background_color', 'bg_pos_x', 'bg_pos_y', 'content'),
				'array' => array()
			);
			// Save data
			if (!esc_attr($_POST['label'])) {
				$this->set_navigation('top_graphic');
				return $this->error(__('You must enter a title.', THEME_NAME)); 
			}
			if (esc_attr($_POST['background_color'])) {
				// validate the content
				$hex = str_replace( "#", "", esc_attr($_POST['background_color']) );
				if ( strlen($hex) > 6 ) {
					$this->set_navigation('top_graphic');
					return $this->error(__('Your HEX color cannot be more than 6 characters in length.', THEME_NAME)); 
				}
				if ( strlen($hex) < 6 && strlen($hex) !== 3 ) {
					$this->set_navigation('top_graphic');
					return $this->error(__('Your HEX color is the wrong length.', THEME_NAME)); 
				}
				// everything seems good, set the return the value back to the form element
				$_POST['background_color'] = $hex;
			}
									
			// no keys or indexes for slides. Auto-generate and stored in hidden fields.
			// Unique keys are important, otherwise a reference to this item could fail if the title is used as the key and it gets changed. 
			if (!$_POST['key']) { 
				$_POST['key'] = base_convert(microtime(), 10, 36);
			}
			$_POST['index'] = $_POST['key'];
		}


		// Sidebars
		if ($this->navigation == 'sidebars') {
			if (!$_POST) return false;
			$this->fields = array(
				'var' => array('label', 'alias', 'key'),
				'array' => array()
			);
			// Validate fields
			if (!esc_attr($_POST['label'])) {
				$this->set_navigation('sidebar');
				return $this->error(__('You must enter a title.', THEME_NAME)); 
			}
			if (!esc_attr($_POST['alias'])) {
				$_POST['alias'] = $_POST['label'];
			}
									
			// No keys or indexes for this type. Auto-generate and stored in hidden fields.
			// Unique keys are important, otherwise a reference to this item could fail if the title is used as the key and it gets changed. 
			if (!$_POST['key']) { 
				$_POST['key'] = base_convert(microtime(), 10, 36);
			}
			$_POST['alias'] = sanitize_title($_POST['alias']);
			$_POST['index'] = $_POST['key'];

		}


		// Page Headers - add/edit
		if ($this->navigation == 'page_header' && $this->action == 'add') {

			// Default field values for a new slide
			$this->default = array('menu_width' => 'page', 'menus' => array('left','right'), 'curve_style' => 'curve', 'showcase_background' => 'closed');
	
		}
		// Page Headers - save
		if ($this->navigation == 'page_headers') {
			if (!$_POST) return false;
			$this->fields = array(
				'var' => array('key', 'label', 'logo', 'menu_width', 'top_sidebar', 'content', 'curve_style', 'showcase_background', 'showcase_content'),
				'array' => array('menus')
			);
			// Save data - validate
			if (!esc_attr($_POST['label'])) {
				$this->set_navigation('page_header');
				return $this->error(__('You must enter a title.', THEME_NAME)); 
			}
									
			// no keys or indexes for slides. Auto-generate and stored in hidden fields.
			// Unique keys are important, otherwise a reference to this item could fail if the title is used as the key and it gets changed. 
			if (!$_POST['key']) { 
				$_POST['key'] = base_convert(microtime(), 10, 36);
			}
			$_POST['index'] = $_POST['key'];
		}
		
		
		// Page Footers - add/edit
		if ($this->navigation == 'page_footer' && $this->action == 'add') {

			// Default field values for a new slide
			$this->default = array();
	
		}
		// Page Footers - save
		if ($this->navigation == 'page_footers') {
			if (!$_POST) return false;
			$this->fields = array(
				'var' => array('key', 'label', 'content_top', 'content_bottom'),
				'array' => array('menus')
			);
			// Save data - validate
			if (!esc_attr($_POST['label'])) {
				$this->set_navigation('page_footer');
				return $this->error(__('You must enter a title.', THEME_NAME)); 
			}
									
			// no keys or indexes for slides. Auto-generate and stored in hidden fields.
			// Unique keys are important, otherwise a reference to this item could fail if the title is used as the key and it gets changed. 
			if (!$_POST['key']) { 
				$_POST['key'] = base_convert(microtime(), 10, 36);
			}
			$_POST['index'] = $_POST['key'];
		}

		// If all is OK
		return true;
		
	}
	
	function load_objects() {
		global $design_settings;		
		$this->data = $design_settings->load_objects();
		return $this->data;
	}

	function load_admin_js() {

		// JS for drag and drop layout manager
		$js = FRAMEWORK_URL . 'js/';
		wp_deregister_script( 'jquery-ui' );
        wp_register_script( 'jquery-ui', $js.'jquery-ui-1.8.10.custom.min.js', array('jquery'), '1.8.10', true);
        wp_enqueue_script( 'jquery-ui' );
		
	} 

}
?>