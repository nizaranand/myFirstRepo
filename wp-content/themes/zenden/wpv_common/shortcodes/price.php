<?php

/*
 * price lisitng column
 */

function wpv_shortcode_price($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'text_align' => 'justify',
		'price' => '',
		'currency' => '',
		'duration' => '',
		'summary' => '',
		'price_size' => '',
		'price_background' => '',
		'price_color' => '',
		'title' => '',
		'title_background' => '',
		'title_color' => '',
		'title_size' => '18',
		'description' => '',
		'description_background' => '',
		'description_color' => '',
		'button_text' => '',
		'button_link' => '',
	), $atts));
	
	ob_start();

	include WPV_SHORTCODE_TEMPLATES . 'price.php';

	return ob_get_clean();
}
add_shortcode('price','wpv_shortcode_price');
