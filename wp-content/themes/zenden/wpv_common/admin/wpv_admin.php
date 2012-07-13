<?php

/**
 * Framework admin enhancements
 * 
 * @author Nikolay Yordanov <me@nyordanov.com>
 * @package wpv
 */

class Wpv_Admin {
	
	public function __construct() {
		add_action('admin_menu', array(&$this, 'load_menus'));
		
		$this->load_metaboxes();
		
		$this->load_functions();
		
		require_once WPV_ADMIN_HELPERS . 'version-checker.php';
	}
	
	public function load_menus() {
		add_menu_page('Vamtam', 'Vamtam', 'edit_themes', 'wpv_quick_setup', array(&$this, 'load_options_page'), WPV_THEME_IMAGES .'vamtam_16.png', 23);
		add_submenu_page('wpv_quick_setup', __('Vamtam | quick setup', 'wpv'), __('Quick setup', 'wpv'), 'edit_themes', 'wpv_quick_setup', array(&$this, 'load_options_page'));
		add_submenu_page('wpv_quick_setup', __('Vamtam | advanced options', 'wpv'), __('Advanced options', 'wpv'), 'edit_themes', 'wpv_advanced', array(&$this, 'load_options_page'));
		add_submenu_page('wpv_quick_setup', __('Vamtam | help', 'wpv'), __('Help', 'wpv'), 'edit_themes', 'wpv_help', array(&$this, 'load_options_page'));
	}
	
	public function load_options_page() {
		require_once WPV_ADMIN_HELPERS . 'config_generator.php';
		$page = include WPV_ADMIN_OPTIONS . str_replace('wpv_', '', $_GET['page']) . '.php';
	
		if($page['auto']) {
			new Config_Generator($page['name'], $page['config']);
		}
	}
	
	private function load_metaboxes() {
		require_once WPV_ADMIN_METABOXES . 'shortcode.php';
		require_once WPV_ADMIN_METABOXES . 'general.php';
		require_once WPV_ADMIN_METABOXES . 'template.php';
	}
	
	private function load_functions() {
		require_once WPV_ADMIN_HELPERS . 'base.php';
		require_once WPV_ADMIN_AJAX_DIR . 'base.php';
		
		if( isset($_GET['gallery_image_upload']) || isset($_POST['gallery_image_upload']) || 
			(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'gallery_image_upload'))
		  ) {
			require_once WPV_ADMIN_HELPERS . 'upload-common.php';
			require_once WPV_ADMIN_HELPERS . 'gallery-upload.php';
		}
		if( isset($_GET['media_image_upload']) || isset($_POST['media_image_upload']) ||
			(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'media_image_upload'))
		) {
			require_once WPV_ADMIN_HELPERS . 'upload-common.php';
			require_once WPV_ADMIN_HELPERS . 'media-upload.php';
		}
		
		require_once WPV_ADMIN_TYPES . 'slideshow.php';
		require_once WPV_ADMIN_TYPES . 'portfolio.php';
	}
}
