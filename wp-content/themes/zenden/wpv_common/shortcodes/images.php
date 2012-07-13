<?php
/**
 * displays an image
 *
 * default sizes: small, medium, blog
 * icons: zoom, doc, play
 */
 
function wpv_shortcode_image($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'link' => '#',
		'lightbox' => 'false',
		'title' => '',
		'align' => false,
		'group' => '',
		'width' => false,
		'height' => false,
		'autoheight' => 'false',
		'quality' => false,
		'frame' => false,
		'link_class' => '',
		'underline' => 'true',
	), $atts));
	
	$width = (int)$width;
	$height = (int)$height;
	
	if($autoheight=='true')
		$height = '';

	$src = trim($content);
	$no_link = '';
	
	if($lightbox == 'true') {
		if($link == '#')
			$link = $src;
	} elseif(empty($link))
			$no_link = ' image_no_link';
	
	$class = '';
	$class .= ($frame == 'true') ? 'framed' : 'not-framed';

	$quality = empty($quality) ? null : $quality;
	
	$image_options = array(
		'width' => $width,
		'height' => $height,
		'class' => $class,
	);

	$src = wpv_resize_image($src, $width, $height, $quality);
	
	$image = wpv_get_lazy_load($src, $title, $image_options);
	
	ob_start();
	include WPV_SHORTCODE_TEMPLATES . 'images.php';
	
	return ob_get_clean();
}
add_shortcode('image', 'wpv_shortcode_image');
