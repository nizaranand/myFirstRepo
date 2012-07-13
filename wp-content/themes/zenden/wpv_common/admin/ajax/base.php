<?php

// galleries
function gallery_get_image_action_callback() {
	$html = gallery_create_image_item($_POST['id']);
	if ($html) {
		exit;
	} else {
		echo '0';
		exit;
	}
}
add_action('wp_ajax_theme-gallery-get-image', 'gallery_get_image_action_callback');

function gallery_create_image_item($id) {
	$image = & get_post($id);
	if ($image):
		$meta = wp_get_attachment_metadata($id);
		$date = mysql2date(get_option('date_format'), $image->post_date);
		$size = $meta['width'] . ' x ' . $meta['height'] . 'px';
	
		return include(WPV_ADMIN_HELPERS . 'gallery-item.php');

	endif;
	
	return false;
}

/*
 * media upload
 */

function media_get_image_action_callback() {
	$image = & get_post($_POST['id']);
	if($image)
		echo $image->guid;
	else
		echo '0';
	exit;
}
add_action('wp_ajax_wpv-media-get-image', 'media_get_image_action_callback');

/// handles ajax request when saving a theme's options
function save_theme_config_callback() {
	foreach($_POST['config'] as &$opt) {
		$opt = stripslashes($opt);
	}
	unset($opt);
	
	$output = json_encode($_POST['config']);
	$_POST['file'] = trim($_POST['file']);
	
	if(file_put_contents(WPV_SAVED_OPTIONS.$_POST['file'], $output)) {
		echo '<span class="success">'. __('Success.', 'wpv') . '</span>';
	} else {
		echo '<span class="error">'. __('Cannot save file.', 'wpv') . '</span>';
	}
	exit;
}
add_action('wp_ajax_save_theme_config', 'save_theme_config_callback');

// deletes a skin
function delete_theme_config_callback() {
	$_POST['file'] = trim($_POST['file']);
	
	if(@unlink(WPV_SAVED_OPTIONS.$_POST['file'])) {
		echo '<span class="success">'. __('Success.', 'wpv') . '</span>';
	} else {
		echo '<span class="error">'. __('Cannot delete file.', 'wpv') . '</span>';
	}
	exit;
}
add_action('wp_ajax_delete_theme_config', 'delete_theme_config_callback');

// lists available theme configs
function wpv_available_configs_callback() {
	$skins_dir = opendir(WPV_SAVED_OPTIONS);
	
	if(isset($_POST['prefix'])) {
		$prefix = $_POST['prefix'].'_';
		
		echo '<option value="">'.__('Available skins', 'wpv').'</option>';
		while($file = readdir($skins_dir)):
			if($file != "." && $file != ".." && strpos($file, $prefix) == 0):
		?>
				<option value="<?php echo WPV_SAVED_OPTIONS_URI.$file?>"><?php echo str_replace($prefix, '', $file) ?></option>
		<?php 
			endif;
		endwhile;
					
		closedir($skins_dir);
	}
	
	exit;
}
add_action('wp_ajax_wpv-available-configs', 'wpv_available_configs_callback');

function save_theme_last_config_callback() {
	wpv_update_option('last-active-skin', $_POST['name']);
	
	echo '<span class="success">The changes are temporary, you have to click "Save options".</span>';
	
	exit;
}
add_action('wp_ajax_save_last_theme_config', 'save_theme_last_config_callback');

// gets the stylesheet for the font preview
function wpv_font_preview_callback() {
	global $available_fonts;
	
	$url = wpv_get_font_url($_POST['face']);
	
	if(!empty($url)) {
		echo $url;
	}
	
	exit;
}
add_action('wp_ajax_wpv-font-preview', 'wpv_font_preview_callback');

// lists available templates
function wpv_available_templates_callback() {
	$templates_dir = opendir(WPV_TEMPLATES_DIR);

	echo '<option value="">'.__('Available templates', 'wpv').'</option>';
	while($file = readdir($templates_dir)):
		if($file != "." && $file != ".." && strpos($file, THEME_SLUG) == 0):
	?>
			<option value="<?php echo WPV_TEMPLATES_URI.$file?>"><?php echo str_replace(THEME_SLUG, '', $file) ?></option>
	<?php 
		endif;
	endwhile;
				
	closedir($templates_dir);
	
	exit;
}
add_action('wp_ajax_wpv-available-templates', 'wpv_available_templates_callback');

// saves a template
function wpv_save_template_callback() {
	foreach($_POST['template'] as &$opt) {
		if(is_string($opt)) {
			$opt = stripslashes($opt);
		}
	}
	unset($opt);
	
	$output = json_encode($_POST['template']);
	$_POST['file'] = trim($_POST['file']);
	
	if(file_put_contents(WPV_TEMPLATES_DIR.THEME_SLUG.$_POST['file'], $output)) {
		echo '<span class="success">'. __('Success.', 'wpv') . '</span>';
	} else {
		echo '<span class="error">'. __('Cannot save file.', 'wpv') . '</span>';
	}
	exit;
}
add_action('wp_ajax_wpv-save-template', 'wpv_save_template_callback');

// deletes a template
function wpv_delete_template_callback() {
	$file = WPV_TEMPLATES_DIR.THEME_SLUG.$_POST['file'];
	
	if(@unlink($file)) {
		echo '<span class="success">'. __('Deleted.', 'wpv') . '</span>';
	} else {
		echo '<span class="error">'. __('Cannot delete file.', 'wpv') . '</span>';
	}
	
	exit;
}
add_action('wp_ajax_wpv-delete-template', 'wpv_delete_template_callback');

// saves the theme/framework options
function wpv_save_options_callback() {
	$page = include WPV_ADMIN_OPTIONS . str_replace('wpv_', '', $_POST['page']) . '.php';
	
	wpv_save_config($page['config']);
	
	_e('Saved', 'wpv');
	
	exit;
}
add_action('wp_ajax_wpv-save-options', 'wpv_save_options_callback');

class WPVSliderEditor {
	public function __construct() {
		$actions = array(
			'get-attachments' => 'get_attachments',
			'slide-get-config' => 'get_slide_config',
			'slide-save-config' => 'save_slide_config',
			'create-slider' => 'create_slider',
			'get-slider-data' => 'get_slider_data',
			'get-sliders' => 'get_sliders',
			'get-slides' => 'get_slides',
			'create-slide' => 'create_slide',
			'slide-trash' => 'trash_slide',
			'slide-delete' => 'delete_slide',
			'slide-restore' => 'restore_slide',
			'slider-save-order' => 'slider_save_order',
			'slider-delete' => 'delete_slider',
		);

		foreach($actions as $hook=>$func) {
			add_action('wp_ajax_wpv-'.$hook, array(&$this, $func));
		}
	}

	public function delete_slider() {
		$slider = (int)$_POST['id'];
		$slides = $this->get_slides_by_slider_id($slider);
		wp_delete_term($slider, 'slideshow_category');

		foreach($slides as $slide_id=>$data) {
			wp_delete_post($slide_id, true);
		}

		die(1);
	}

	// saves the order of some slides, the array should be in the form slide_id:menu_order
	public function slider_save_order() {
		foreach($_POST['order'] as $slide=>$menu_order) {
			wp_update_post(array(
				'ID' => $slide,
				'menu_order' => $menu_order,
			));
		}
		die('1');
	}

	// returns a json object of image attachments in the form "id":"thumbnail"
	public function get_attachments() {
		$attachments = get_posts(array(
			'post_type' => 'attachment',
			'posts_per_page' => -1,
		));

		$result = array(
			-1 => WPV_ADMIN_ASSETS_URI . 'images/html-slide.jpg'
		);

		foreach($attachments as $a) {
			$result[$a->ID] = wp_get_attachment_image_src($a->ID, array(150,150));
			$result[$a->ID] = $result[$a->ID][0];
		}

		header('Content-type: application/json');
		echo json_encode($result);

		exit;
	}

	// returns the form fields for an image slide
	public function get_slide_config() {
		global $post;
		$id = (int)$_POST['id'];
		$post = get_post($id);

		$config = array(
			'id' => 'slide-options',
			'ondemand' => true,
		);

		$htmlslide = (get_post_thumbnail_id($id) <= 0);

		require_once WPV_ADMIN_HELPERS . 'metaboxes_generator.php';
		$options = include WPV_THEME_METABOXES . 'slideshow.php';

		$options = array_merge($options, array(array(
			'title' => __('Save changes', 'wpv'),
			'type' => 'button',
			'class' => 'wpv-save-slide-config',
		)));

		$form = new metaboxes_generator($config, $options);
		$form->render();
	
		exit;
	}

	// saves slide config
	public function save_slide_config() {
		global $post;
		$id = (int)$_POST['id'];
		$post = get_post($id);
		$_POST['post_type'] = 'slideshow';

		$config = array(
			'id' => 'slide-options',
			'ondemand' => true,
		);


		require_once WPV_ADMIN_HELPERS . 'metaboxes_generator.php';
		$options = include WPV_THEME_METABOXES . 'slideshow.php';
		$form = new metaboxes_generator($config, $options);
		$form->save($id);
	
		die(1);
		exit;
	}

	// creates a new slider
	public function create_slider() {
		if(!term_exists($_POST['title'], 'slideshow_category')) {
			$term = wp_insert_term($_POST['title'], 'slideshow_category');
			echo $term['term_id'];
			exit;
		}

		die('0');
	}

	// returns a json object with info about the slider
	public function get_slider_data() {
		$slider = get_term($_POST['id'], 'slideshow_category');

		header('Content-type: application/json');
		echo json_encode(array(
			'name' => $slider->name,
		));
		exit;
	}

	public function get_slides() {
		header('Content-type: application/json');
		echo json_encode($this->get_slides_by_slider_id((int)$_POST['id']));
		exit;
	}

	private function get_slides_by_slider_id($id) {
		$slides = array();
		$query = array(
			'post_type' => 'slideshow',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post_status' => array('publish', 'trash'),
			'tax_query' => array(
				array(
					'taxonomy' => 'slideshow_category',
					'field' => 'id',
					'terms' => $id,
					'operator' => 'IN',
				)
			),
		);
		
		$raw_slides = get_posts($query);
		foreach($raw_slides as $s) {
			$thumbnail_id = get_post_thumbnail_id($s->ID);
			if($thumbnail_id > 0) {
				$image = wp_get_attachment_image_src( $thumbnail_id , array(150,150));
				$image = $image[0];
			} else {
				$image = WPV_ADMIN_ASSETS_URI . 'images/html-slide.jpg';
			}

			$slides[] = array(
				'id' => $s->ID,
				'img' => $image,
				'status' => $s->post_status,
				'menu_order' => $s->menu_order,
			);
		}

		return $slides;
	}

	// returns a json array with all slider ids
	public function get_sliders() {
		$sliders = get_terms('slideshow_category', array(
			'hide_empty' => false,
		));

		$ids = array();
		foreach($sliders as $s) {
			$ids[]= $s->term_id;
		}

		header('Content-type: application/json');
		echo json_encode($ids);
		exit;
	}

	// create a slide and attach an image if present
	public function create_slide() {
		$catid = (int)$_POST['slider'];
		$thumbnail_id = (int)$_POST['image'];

		$slide = wp_insert_post(array(
			'post_title' => ' ',
			'post_content' => ' ',
			'post_status' => 'publish',
			'post_type' => 'slideshow',
			'tax_input' => array('slideshow_category' => array($catid)),
		), true);

		if($thumbnail_id > 0)
			update_post_meta($slide, '_thumbnail_id', $thumbnail_id);

		echo $slide;
		exit;
	}

	// trashes a slide
	public function trash_slide() {
		$slide = (int)$_POST['id'];

		echo wp_update_post(array(
			'ID' => $slide,
			'post_status' => 'trash',
		));
		exit;
	}

	// deletes a slide
	public function delete_slide() {
		$slide = (int)$_POST['id'];

		wp_delete_post($slide);
		die('1');
	}

	// restores a slide
	public function restore_slide() {
		$slide = (int)$_POST['id'];

		echo wp_update_post(array(
			'ID' => $slide,
			'post_status' => 'publish',
		));
		exit;
	}
}
new WPVSliderEditor;
