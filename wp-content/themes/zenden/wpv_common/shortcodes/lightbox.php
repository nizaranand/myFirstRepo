<?php
/**
 * displays some content in a lightbox
 *
 * icons: zoom, doc, play
 */
function wpv_shortcode_lightbox($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'href' => '#',
		'title' => '',
		'group' => '',
		'width' => false,
		'height' => false,
		'iframe' => 'false',
		'inline' => 'false',
		'photo' => 'false',
		'close' => 'true',
		'class' => '',
	), $atts));
	
	$width = ($width && preg_match('/(\d+)(%|px)?/', $width)) ? ' data-width="'.$width.'"' : '';
	$height = ($height && preg_match('/(\d+)(%|px)?/', $width)) ? ' data-height="'.$height.'"' : '';
	
	if($iframe != 'false')
		$iframe = 'true';
	$iframe = ' data-iframe="'.$iframe.'"';
	
	if($inline != 'false') {
		$inline = ' data-inline="true" data-href="'.$href.'"';
		$href = '#';
	} else
		$inline = ' data-inline="false"';
	
	if($photo != 'false')
		$photo = 'true';
	$photo = ' data-photo="'.$photo.'"';
	
	if($close != 'false')
		$close = 'true';
	$close = ' data-close="'.$close.'"';
	
	$before = $after = '';
	if(strpos(do_shortcode($content), '[raw]') !== false) {
		$before = '[raw]';
		$after = '[/raw]';
	}
	$content = wpv_clean_do_shortcode($content);
	
	return $before.'<a title="'.$title.'" href="'.$href.'"'.($group?' rel="'.$group.'"':'').' class="colorbox '.$class.'"'.$width.$height.$iframe.$inline.$photo.$close.'>'.$content.'</a>'.$after;
}

add_shortcode('lightbox', 'wpv_shortcode_lightbox');