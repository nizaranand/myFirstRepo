<?php

/**
 * various content dividers
 */

function wpv_shortcode_divider_1() {
	return '<div class="sep"></div>';
}
add_shortcode('divider_1', 'wpv_shortcode_divider_1');

function wpv_shortcode_divider_2() {
	return '<div class="sep-2"></div>';
}
add_shortcode('divider_2', 'wpv_shortcode_divider_2');

function wpv_shortcode_divider_3() {
	return '<div class="sep-3"></div>';
}
add_shortcode('divider_3', 'wpv_shortcode_divider_3');

// adds a div with clear:both

function wpv_shortcode_clearboth() {
   return '<div class="clearboth"></div>';
}
add_shortcode('clearboth', 'wpv_shortcode_clearboth');

