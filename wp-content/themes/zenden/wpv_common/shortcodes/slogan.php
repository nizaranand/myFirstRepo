<?php

/*
 * slogan shortcode
 */

function wpv_shortcode_slogan($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'button_text' => '',
		'link' => '',
		'nopadding' => 'false',
		'carved' => 'false',
		'background' => '',
		'text_color' => '',
	), $atts));
	
	$nopadding = ($nopadding == 'true')? 'nopadding' : '';
	$carved = ($carved == 'true')? 'carved' : '';
	
	ob_start();

	include WPV_SHORTCODE_TEMPLATES . 'slogan.php';

	return ob_get_clean();
}
add_shortcode('slogan','wpv_shortcode_slogan');
