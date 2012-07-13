<?php

/**
 * wpv theme framework base class
 * 
 * @author Nikolay Yordanov <me@nyordanov.com>
 * @package wpv
 */
 
/**
 * This is the first loaded framework file
 * 
 * Wpv_Framework does the following (in this order):
 *  - sets constants for the frequently used paths
 *  - loads translations
 *  - loads the plugins bundled with the theme
 *  - loads some functions and helpers used in various places
 *  - sets the custom post types
 *  - loads the shortcode library for the framework
 *  - if this is wp-admin, load admin files
 * 
 * This class also loads the custom widgets and sets what the theme supports (+ custom menus)
 */

class Wpv_Framework {
	public function __construct($options) {
		$this->set_constants($options);
		$this->load_languages();
		$this->load_functions();
		$this->load_plugins();
		$this->load_types();
		$this->load_shortcodes();
		$this->load_admin();
		
		add_action('after_setup_theme', array(&$this, 'theme_supports'));
		add_action('widgets_init', array(&$this, 'load_widgets'));
		add_action('wp_before_admin_bar_render', array(&$this, 'setup_adminbar'));
	}
	
	private function set_constants($options) {
		define('THEME_NAME', $options['name']);
		define('THEME_SLUG', $options['slug']);

        // theme dir and uri
		define('WPV_DIR', get_template_directory() . '/');
		define('WPV_URI', get_template_directory_uri() .'/');

		$theme_data = get_theme_data(WPV_DIR . 'style.css');
		define('THEME_VERSION', $theme_data['Version']);

        // framework dir and uri
		define('WPV_COMMON_DIR', WPV_DIR . 'wpv_common/');
		define('WPV_COMMON_URI', WPV_URI . 'wpv_common/');

        // theme-specific assets dir and uri
		define('WPV_THEME_DIR', WPV_DIR . 'wpv_theme/');
		define('WPV_THEME_URI', WPV_URI . 'wpv_theme/');

        // common assets dir and uri
        define('WPV_ASSETS_DIR', WPV_COMMON_DIR . 'assets/');
        define('WPV_ASSETS_URI', WPV_COMMON_URI . 'assets/');

        // common file paths
		define('WPV_HELPERS', WPV_COMMON_DIR . 'helpers/');
		define('WPV_PLUGINS', WPV_COMMON_DIR . 'plugins/');
		define('WPV_TYPES', WPV_COMMON_DIR . 'types/');
		define('WPV_WIDGETS', WPV_COMMON_DIR . 'widgets/');
		define('WPV_WIDGETS_TPL', WPV_WIDGETS . 'tpl/');
		define('WPV_WIDGETS_ASSETS', WPV_WIDGETS . 'assets/');
		define('WPV_SHORTCODES', WPV_COMMON_DIR . 'shortcodes/');
		define('WPV_SHORTCODES_GENERATOR', WPV_SHORTCODES . 'generator/');
        define('WPV_FONTS_URI', WPV_ASSETS_URI . 'fonts/');
        define('WPV_INCLUDES', WPV_ASSETS_URI . 'includes/');
        define('WPV_JS', WPV_ASSETS_URI . 'js/');
		define('WPV_SWF', WPV_ASSETS_URI . 'swf/');
		define('WPV_IMAGES', WPV_ASSETS_URI . 'images/');

        // theme-specific file paths
		define('WPV_SAVED_OPTIONS', WPV_THEME_DIR . 'saved_skins/');
		define('WPV_SAVED_OPTIONS_URI', WPV_THEME_URI . 'saved_skins/');
		define('WPV_THEME_ASSETS_DIR', WPV_THEME_DIR . 'assets/');
		define('WPV_THEME_ASSETS_URI', WPV_THEME_URI . 'assets/');
		define('WPV_TEMPLATES_DIR', WPV_THEME_DIR . 'templates/');
		define('WPV_TEMPLATES_URI', WPV_THEME_URI . 'templates/');
		define('WPV_THEME_OPTIONS', WPV_THEME_DIR . 'options/');
		define('WPV_THEME_HELPERS', WPV_THEME_DIR . 'helpers/');
		define('WPV_THEME_METABOXES', WPV_THEME_DIR . 'metaboxes/');
		define('WPV_THEME_SAMPLE_CONTENT', WPV_THEME_DIR . 'samples/content.xml');
		define('WPV_THEME_SAMPLE_WIDGETS', WPV_THEME_DIR . 'samples/sidebars');
		define('WPV_SHORTCODE_TEMPLATES', WPV_THEME_DIR . 'shortcode_templates/');		
		define('WPV_THEME_IMAGES', WPV_THEME_ASSETS_URI . 'images/');
		define('WPV_THEME_JS', WPV_THEME_ASSETS_URI . 'js/');
		define('WPV_THEME_JS_DIR', WPV_THEME_ASSETS_DIR . 'js/');
        define('WPV_THEME_CSS', WPV_THEME_ASSETS_URI . 'css/');
		define('WPV_THEME_CSS_DIR', WPV_THEME_ASSETS_DIR . 'css/');

        // cache
        define('WPV_CACHE_DIR', WPV_DIR . 'cache/');
		define('WPV_CACHE_URI', WPV_URI . 'cache/');

        // admin
		define('WPV_ADMIN', WPV_COMMON_DIR . 'admin/');
		define('WPV_ADMIN_URI', WPV_COMMON_URI . 'admin/');
		define('WPV_ADMIN_TYPES', WPV_ADMIN . 'types/');
		define('WPV_ADMIN_AJAX_DIR', WPV_ADMIN . 'ajax/');
		define('WPV_ADMIN_AJAX', WPV_ADMIN_URI . 'ajax/');
		define('WPV_ADMIN_ASSETS_URI', WPV_ADMIN_URI . 'assets/');
		define('WPV_ADMIN_HELPERS', WPV_ADMIN . 'helpers/');
		define('WPV_ADMIN_OPTIONS', WPV_ADMIN . 'options/');
		define('WPV_ADMIN_METABOXES', WPV_ADMIN . 'metaboxes/');
	}

	public function theme_supports() {
		global $wpv_post_formats;
		$wpv_post_formats = apply_filters('wpv_post_formats', array('aside', 'link', 'image', 'video', 'audio', 'quote', 'gallery'));

		ini_set('pcre.backtrack_limit','200000');
		
		if (function_exists('add_theme_support')) {
			add_theme_support('post-thumbnails', array('post', 'page', 'portfolio', 'slideshow'));
			
			add_theme_support('automatic-feed-links');
			
			add_theme_support('post-formats', $wpv_post_formats);
		}
		
		if(function_exists('register_nav_menus')) {
			register_nav_menus(array(
				'menu-header' => __('Menu Header', 'wpv'),
				'menu-top' => __('Menu Top', 'wpv')
			));
		}
	}
	
	private function load_languages() {
		load_theme_textdomain('wpv', WPV_DIR . 'languages');
	}
	
	private function load_functions() {
		global $wpv_defaults, $wpv_fonts;
		$wpv_defaults = include WPV_THEME_HELPERS . 'default-options.php';
		$wpv_fonts = include WPV_HELPERS . 'fonts.php';
		
		include WPV_THEME_HELPERS . 'base.php';
		
		require_once WPV_HELPERS . 'base.php';
		require_once WPV_HELPERS . 'template.php';
		require_once WPV_HELPERS . 'css.php';
		require_once WPV_HELPERS . 'sidebars.php';
		require_once WPV_HELPERS . 'wpv-pagination.php';
		require_once WPV_HELPERS . 'dimox-breadcrumbs.php';
		
		require_once WPV_HELPERS . 'head.php';
	}
	
	private function load_plugins() {
		require WPV_PLUGINS . 'importer/importer.php';
		require WPV_PLUGINS . 'widget-importer/importer.php';
	}
	
	private function load_types() {
		// slides
		register_post_type('slideshow', array(
			'labels' => array(
				'name' => __('Slides', 'wpv'),
				'singular_name' => __('Slide', 'wpv'),
				'add_new' => _x('Add New', 'slide', 'wpv' ),
				'add_new_item' => __('Add New Slide', 'wpv' ),
				'edit_item' => __('Edit Slide', 'wpv' ),
				'new_item' => __('New Slide', 'wpv' ),
				'view_item' => __('View Slide', 'wpv' ),
				'search_items' => __('Search Slides', 'wpv' ),
				'not_found' =>  __('No slides found', 'wpv' ),
				'not_found_in_trash' => __('No slides found in Trash', 'wpv' ),
			),
			'public' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'custom-fields',
				'page-attributes',
			),
		));
		
		register_taxonomy('slideshow_category', 'slideshow', array(
			'hierarchical' => false,
			'labels' => array(
				'name' => _x( 'Categories', 'taxonomy general name', 'wpv' ),
				'singular_name' => _x( 'Slideshow Category', 'taxonomy singular name', 'wpv' ),
				'search_items' =>  __( 'Search Categories', 'wpv' ),
				'popular_items' => __( 'Popular Categories', 'wpv' ),
				'all_items' => __( 'All Categories', 'wpv' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Slideshow Category', 'wpv' ), 
				'update_item' => __( 'Update Slideshow Category', 'wpv' ),
				'add_new_item' => __( 'Add New Slideshow Category', 'wpv' ),
				'new_item_name' => __( 'New Slideshow Category Name', 'wpv' ),
				'separate_items_with_commas' => __( 'Separate Slideshow categories with commas', 'wpv' ),
				'add_or_remove_items' => __( 'Add or remove Slideshow category', 'wpv' ),
				'choose_from_most_used' => __( 'Choose from the most used Slideshow categories', 'wpv' )
			),
			'show_ui' => false,
			'query_var' => false,
			'rewrite' => false,
		));
		
		// portfolios
		register_post_type('portfolio', array(
			'labels' => array(
				'name' => _x('Portfolios', 'post type general name', 'wpv' ),
				'singular_name' => _x('Portfolio', 'post type singular name', 'wpv' ),
				'add_new' => _x('Add New', 'portfolio', 'wpv' ),
				'add_new_item' => __('Add New Portfolio', 'wpv' ),
				'edit_item' => __('Edit Portfolio', 'wpv' ),
				'new_item' => __('New Portfolio', 'wpv' ),
				'view_item' => __('View Portfolio', 'wpv' ),
				'search_items' => __('Search Portfolios', 'wpv' ),
				'not_found' =>  __('No portfolios found', 'wpv' ),
				'not_found_in_trash' => __('No portfolios found in Trash', 'wpv' ), 
				'parent_item_colon' => '',
			),
			'singular_label' => __('portfolio', 'wpv' ),
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'with_front' => false ),
			'query_var' => false,
			'menu_position' => 21,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'custom-fields',
				'thumbnail',
				'comments',
				'page-attributes'
			)
		));
	
		register_taxonomy('portfolio_category','portfolio',array(
			'hierarchical' => true,
			'labels' => array(
				'name' => _x( 'Categories', 'taxonomy general name', 'wpv' ),
				'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'wpv' ),
				'search_items' =>  __( 'Search Categories', 'wpv' ),
				'popular_items' => __( 'Popular Categories', 'wpv' ),
				'all_items' => __( 'All Categories', 'wpv' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Portfolio Category', 'wpv' ), 
				'update_item' => __( 'Update Portfolio Category', 'wpv' ),
				'add_new_item' => __( 'Add New Portfolio Category', 'wpv' ),
				'new_item_name' => __( 'New Portfolio Category Name', 'wpv' ),
				'separate_items_with_commas' => __( 'Separate Portfolio category with commas', 'wpv' ),
				'add_or_remove_items' => __( 'Add or remove portfolio category', 'wpv' ),
				'choose_from_most_used' => __( 'Choose from the most used portfolio category', 'wpv' )
			),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => false,
		));
	}
	
	private function load_shortcodes() {
		$shortcodes = array(
			'accordion',
			'blog',
			'boxes',
			'buttons',
			'chart',
			'columns',
			'dividers',
			'gallery',
			'gmap',
			'iframe',
			'images',
			'lightbox',
			'portfolio',
			'price',
			'services',
			'sitemap',
			'showcase',
			'slider',
			'slogan',
			'styled_table',
			'tabs',
			'team_member',
			'text_divider',
			'tooltip',
			'typography',
			'video',
			'widgets',
		);
		
		foreach($shortcodes as $name) {
			require_once WPV_SHORTCODES . $name . '.php';
		}
	}
	
	public function load_widgets() {
		add_filter('widget_text', 'do_shortcode');
		
		$widgets = array(
			'authors',
			'advertisement',
			'flickr',
			'twitter',
			'social',
			'subpages',
			'contactinfo',
			'gmap',
			'posts',
			'contactform',
			'post-formats',
		);
		
		foreach($widgets as $name) {
			require_once WPV_WIDGETS . "/$name.php";
		}
	}
	
	private function load_admin() {
		if(is_admin()) {
			require_once WPV_ADMIN . 'wpv_admin.php';
			$admin = new Wpv_Admin;
		}
	}

	public function setup_adminbar() {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'parent' => false,
			'id' => 'wpv-settings',
			'title' => __('Vamtam', 'wpv'),
			'href' => admin_url( 'admin.php?page=wpv_quick_setup'),
			'meta' => false
		));

		$wp_admin_bar->add_menu( array(
			'parent' => 'wpv-settings',
			'id' => 'wpv-quick-setup',
			'title' => __('Quick setup', 'wpv'),
			'href' => admin_url( 'admin.php?page=wpv_quick_setup'),
			'meta' => false
		));

		$wp_admin_bar->add_menu( array(
			'parent' => 'wpv-settings',
			'id' => 'wpv-advanced',
			'title' => __('Advanced options', 'wpv'),
			'href' => admin_url( 'admin.php?page=wpv_advanced'),
			'meta' => false
		));

		$wp_admin_bar->add_menu( array(
			'parent' => 'wpv-settings',
			'id' => 'wpv-help',
			'title' => __('Help', 'wpv'),
			'href' => admin_url( 'admin.php?page=wpv_help'),
			'meta' => false
		));
	}
}
