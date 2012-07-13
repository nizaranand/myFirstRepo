<?php

/**
 * displays a button
 */

function wpv_shortcode_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'size' => 'small',
		'font' => '',
		'link' => '',
		'linktarget' => '',
		'color' => '',
		'bgcolor' => '',
		'align' => false,
	), $atts));
	
	$id = $id ? ' id="' . $id . '"' : '';
	$class = $class ? ' '.$class : '';
	$link = $link ? ' href="' . $link . '"' : '';
	$linktarget = $linktarget ? ' target="' . $linktarget . '"' : '';
	
	// inline styles for the button
	$color = $color ? "color: $color !important;" : '';
	$font = $font ? "font-size: {$font}px;" : '';
	
	$style = ($color != '' || $font != '')? " style='$color $font'" : '';
	
	$aligncss = ($align != 'center') ? ' align'.$align : '';
	
	$content = '<a'.
					$id.
					$link.
					$linktarget.
					$style.
					' class="button '.
					"$size $bgcolor $class $aligncss".
				'"><span>' . trim($content) . '</span></a>';
	
	$content = "[raw]".$content."[/raw]";
	
	if($align === 'center')
		return '<p class="textcenter">'.$content.'</p>';
	else
		return $content;
}
add_shortcode('button', 'wpv_shortcode_button');