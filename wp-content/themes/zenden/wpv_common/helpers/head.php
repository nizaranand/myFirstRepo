<?php

// put all javascript that has to be included in a separate <script> tag here
// everything else put in combine.php
function wpv_enqueue_scripts() {
	$move_bottom = true;
	
	if(!is_admin()) {

		if(!wpv_is_login()) {
			// modernizr should be on top
			wp_enqueue_script( 'modernizr', WPV_JS .'modernizr-1.7.min.js');
			
			if(wpv_get_option('gmap_api_key')) {
				wp_enqueue_script('gmap-api', 'http://maps.google.com/maps?file=api&amp;v=2&amp;key=' . wpv_get_option('gmap_api_key'), array(), false, $move_bottom);
				/* wp_enqueue_script('jquery-gmap', WPV_JS .'jquery.gmap-1.1.0-min.js', array('jquery'), THEME_VERSION, $move_bottom); */
				wp_register_script( 'front-'.$file, WPV_JS .$file.'.js', array('jquery'), false, $move_bottom);
			}

			if ( is_singular() && comments_open() ) {
	  			wp_enqueue_script( 'comment-reply', false, false, false, $move_bottom );
	  		}

			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-tabs');

			wp_register_script('video-js', 'http://vjs.zencdn.net/c/video.js', array('jquery'), THEME_VERSION, $move_bottom);

			$wpv_js = array(
				'wpvslider.uncompressed' => false,
				'wpvslider.fx' => false,
				'jquery.jplayer.min' => false,
				'jquery.easing' => false,
				'jquery.tweet' => false,
				//'jquery.swfobject.1-1-1.min' => true,
				'jquery.colorbox-min' => true,
				'validator' => true,
				'jquery.ui.accordion' => true,
				'jail' => true,
				'widgets/contact_form' => true,
				'jquery.corner' => false,
				'wpv_common' => true,
			);

			foreach($wpv_js as $file=>$enqueue) {
				if($enqueue) {
					wp_enqueue_script( 'front-'.$file, WPV_JS .$file.'.js', array('jquery'), THEME_VERSION, $move_bottom);
				} else {
					/* wp_register_script( 'front-'.$file, WPV_JS .$file.'.js', array('jquery'), THEME_VERSION, $move_bottom); */
					wp_register_script( 'front-'.$file, WPV_JS .$file.'.js', array('jquery'), false, $move_bottom);
				}
			}

			wp_enqueue_script( 'wpv-theme', WPV_THEME_JS .'wpv_theme.js', array('jquery', 'front-wpv_common'), false, $move_bottom);
		}
	}
	else {
		wp_enqueue_script( 'jquery-colorbox', WPV_JS .'jquery.colorbox-min.js', array('jquery'), THEME_VERSION, $move_bottom);
		
		wp_enqueue_script( 'common');
		wp_enqueue_script( 'editor');
		wp_enqueue_script( 'jquery-ui-sortable');
		wp_enqueue_script( 'jquery-ui-draggable');
		wp_enqueue_script( 'jquery-ui-tabs');
		wp_enqueue_script( 'jquery-ui-range', WPV_ADMIN_ASSETS_URI .'js/jquery.ui.range.js', array('jquery'), THEME_VERSION, $move_bottom);
		wp_enqueue_script( 'jquery-ui-slider', WPV_ADMIN_ASSETS_URI .'js/jquery.ui.slider.js', array('jquery', 'jquery-ui-mouse'), THEME_VERSION, $move_bottom);
		wp_enqueue_script( 'thickbox');
		wp_enqueue_script( 'jquery-layout', WPV_ADMIN_ASSETS_URI .'js/jquery.layout-latest.js', array('jquery'), THEME_VERSION, $move_bottom);
		wp_enqueue_script( 'general-layout-editor', WPV_ADMIN_ASSETS_URI .'js/general-layout.js', array('jquery'), THEME_VERSION, $move_bottom);
		wp_enqueue_script( 'wpv_admin', WPV_ADMIN_ASSETS_URI .'js/wpv_admin.js', array('jquery'), THEME_VERSION, $move_bottom);
		wp_enqueue_script( 'ibutton', WPV_ADMIN_ASSETS_URI .'js/jquery.ibutton.js', array('jquery'), THEME_VERSION, $move_bottom);
		wp_enqueue_script( 'mcolorpicker', WPV_ADMIN_ASSETS_URI .'js/mColorPicker.js', array('jquery'), THEME_VERSION, $move_bottom);
		wp_enqueue_script( 'shortcode', WPV_ADMIN_ASSETS_URI . 'js/shortcode.js', array('jquery'), THEME_VERSION, $move_bottom);
		
		if (isset($_GET['gallery_edit_image'])) {
			wp_enqueue_script('theme-gallery-edit-image', WPV_ADMIN_ASSETS_URI . 'js/gallery-edit-image.js', array('jquery', 'wpv-back'), THEME_VERSION, $move_bottom);
		}
	}
	
}
add_action('init', 'wpv_enqueue_scripts');

// put all css that has to be included in a separate <link> tag here
// everything else put in combine.php
function wpv_enqueue_styles() {
	if(!is_admin()) {
		if(!wpv_is_login()) {
			$external_fonts = wpv_get_option('external-fonts');
			if(!empty($external_fonts)) {
				foreach($external_fonts as $name=>$url) {
					wp_enqueue_style( 'wpv-'.$name, $url, array(), THEME_VERSION);	
				}
			}

			$css_files = include WPV_THEME_CSS_DIR . 'list.php';

			foreach($css_files as $file) {
				wp_enqueue_style( 'front-'.basename($file), wpv_prepare_url(WPV_THEME_CSS . $file . '.css'), array(), THEME_VERSION);
			}

			wp_enqueue_style('videojs', 'http://vjs.zencdn.net/c/video-js.css');
		}
	}
	else {
		wp_enqueue_style( 'thickbox');
		wp_enqueue_style( 'colorbox', WPV_THEME_CSS . 'colorbox/colorbox.css');
		wp_enqueue_style( 'wpv_admin', WPV_ADMIN_ASSETS_URI . 'css/wpv_admin.css');
		
		if(stristr($_SERVER['HTTP_USER_AGENT'], "msie 7") || stristr($_SERVER['HTTP_USER_AGENT'], "msie 8") ) {
			wp_enqueue_style( 'wpv-ie78', WPV_ADMIN_ASSETS_URI . 'css/ie78.css');
		}
	}
	
}
add_action('init', 'wpv_enqueue_styles');
