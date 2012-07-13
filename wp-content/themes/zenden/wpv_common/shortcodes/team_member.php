<?php

/*
 * team_member shortcode
 */

function wpv_shortcode_team_member($atts, $content = null, $code) {
	global $wp_filter;
	
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'name' => '',
		'position' => '',
		'phone' => '',
		'email' => '',
		'picture' => '',
	), $atts));
	
	ob_start();

	include WPV_SHORTCODE_TEMPLATES . 'team_member.php';

	return '[raw]'.ob_get_clean().'[/raw]';
}
add_shortcode('team_member','wpv_shortcode_team_member');
