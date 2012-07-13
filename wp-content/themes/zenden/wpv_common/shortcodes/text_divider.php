<?php

/*
 * slogan shortcode
 */

function wpv_shortcode_text_divider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'vertical' => 'false',
	), $atts));
	
	if (preg_match('/^\s*</', $content)) { // has html
	   return '<div class="title-wrap">' . $content . '</div>';
	}
	return '<div class="title-wrap"><h4>' . $content . '</h4></div>';
}
add_shortcode('text_divider','wpv_shortcode_text_divider');
