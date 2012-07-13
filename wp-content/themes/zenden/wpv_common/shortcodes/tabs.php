<?php

/**
 * tabs
 */

function wpv_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => '',
		'delay' => '0',
		'vertical' => 'false'
	), $atts));

	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches))
		return do_shortcode($content);
	
	for($i = 0; $i < count($matches[0]); $i++)
		$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		
	global $tabs_shown;
	if($tabs_shown) {
		$tabs_shown++;
	} else {
		$tabs_shown = 1;
	}
	
	if($vertical == 'true') {
		$vertical = ' vertical';
	} else {
		$vertival = '';
	}
	
	$id = 'tabs-'.$tabs_shown.rand(0,10000);

	$output = '<ul>';
	for($i=0; $i<count($matches[0]); $i++)
		$output .= '<li><a href="#'.$id.$i.'">' . $matches[3][$i]['title'] . '</a></li>';
	$output .= '</ul>';
	
	for($i=0; $i<count($matches[0]); $i++) {
		$output .= '<div class="pane" id="'.$id.$i.'">' . do_shortcode(trim($matches[5][$i])) . '</div>';
	}
		
	return '<div class="tabs '.$style.$vertical.'" data-delay="'.$delay.'">' . $output . '</div>';
}
add_shortcode('tabs', 'wpv_shortcode_tabs');
