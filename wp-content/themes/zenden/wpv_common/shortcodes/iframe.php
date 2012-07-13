<?php

/**
 * show content in an iframe
 */

function wpv_shortcode_iframe($atts, $content = null) {
	extract(shortcode_atts(array(
		'width' => false,
		'height' => false,
		'src' => '',
	), $atts));
	
	$width = $width?' width="'.$width.'"':'';
	$height = $height?' height="'.$height.'"':'';
	
	return '<div class="frame-fl"><iframe src="'.$src.'"'.$width.$height.' seamless="seamless"></iframe></div>';
}

add_shortcode('iframe','wpv_shortcode_iframe');