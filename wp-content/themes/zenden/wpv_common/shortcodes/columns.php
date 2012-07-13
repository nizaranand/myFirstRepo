<?php

/**
 * columnize content
 */

global $wpv_in_row;
$wpv_in_row = false;

function wpv_shortcode_column($atts, $content = null, $code) {
	global $wpv_in_row;

	if(!$wpv_in_row) {
		$code .= ' first';
		$wpv_in_row = true;
	}
	return '[raw]<div class="'.$code.'"><div class="cell">[/raw]' . do_shortcode(trim($content)) . '[raw]</div></div>[/raw]';
}

function wpv_shortcode_column_last($atts, $content = null, $code) {
	global $wpv_in_row;
	$wpv_in_row = false;
	return '[raw]<div class="'.str_replace('_last','',$code).' last"><div class="cell">[/raw]' . 
				do_shortcode(trim($content)) . 
			'[raw]</div></div>
			<div class="clearboth"></div>[/raw]';
}

add_shortcode('one_half', 'wpv_shortcode_column');
add_shortcode('one_third', 'wpv_shortcode_column');
add_shortcode('one_fourth', 'wpv_shortcode_column');
add_shortcode('one_fifth', 'wpv_shortcode_column');
add_shortcode('one_sixth', 'wpv_shortcode_column');

add_shortcode('two_thirds', 'wpv_shortcode_column');
add_shortcode('three_fourths', 'wpv_shortcode_column');
add_shortcode('two_fifths', 'wpv_shortcode_column');
add_shortcode('three_fifths', 'wpv_shortcode_column');
add_shortcode('four_fifths', 'wpv_shortcode_column');
add_shortcode('five_sixths', 'wpv_shortcode_column');

add_shortcode('one_half_last', 'wpv_shortcode_column_last');
add_shortcode('one_third_last', 'wpv_shortcode_column_last');
add_shortcode('one_fourth_last', 'wpv_shortcode_column_last');
add_shortcode('one_fifth_last', 'wpv_shortcode_column_last');
add_shortcode('one_sixth_last', 'wpv_shortcode_column_last');

add_shortcode('two_thirds_last', 'wpv_shortcode_column_last');
add_shortcode('three_fourths_last', 'wpv_shortcode_column_last');
add_shortcode('two_fifths_last', 'wpv_shortcode_column_last');
add_shortcode('three_fifths_last', 'wpv_shortcode_column_last');
add_shortcode('four_fifths_last', 'wpv_shortcode_column_last');
add_shortcode('five_sixths_last', 'wpv_shortcode_column_last');