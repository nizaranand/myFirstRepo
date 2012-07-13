<?php

/*
 * services shortcode (used in our "Services" demo page)
 */

function wpv_shortcode_services($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'text_align' => 'justify',
		'icon' => '',
		'title' => '',
		'title_size' => '30',
		'description_size' => '12',
		'button_text' => '',
		'button_link' => '',
		'no_button' => 'false',
		'fullimage' => 'false',
		'class' => '',
		'image_height' => 0,
	), $atts));
	
	ob_start();

	include WPV_SHORTCODE_TEMPLATES . 'services.php';

	return ob_get_clean();
}
add_shortcode('services','wpv_shortcode_services');
