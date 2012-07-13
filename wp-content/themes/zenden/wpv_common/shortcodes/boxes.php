<?php

/**
 * displays a box with some content
 */

function wpv_shortcode_message_box($atts, $content = null, $code) {
	return '[raw]<div class="msgbox clearfix ' . $code . '">
				<div class="message_box_content">' . wpv_clean_do_shortcode($content) . '</div>
		    </div>[/raw]';
}

add_shortcode('info','wpv_shortcode_message_box');
add_shortcode('success','wpv_shortcode_message_box');
add_shortcode('error','wpv_shortcode_message_box');
add_shortcode('notice','wpv_shortcode_message_box');

/*
 * note box
 */

function wpv_shortcode_note($atts, $content = null) {
	extract(shortcode_atts(array(
		'align' => false,
		'title' => '',
		'width' => false,
	), $atts));
	
	$align = $align ? ' align'.$align : '';
	$width = $width ? ' style="width:'.$width.'px"' : '';
	
	if(!empty($title))
		$title = '<h4 class="note_title">'.$title.'</h4>';
	
	return '[raw]<div class="note' . $align . '"'.$width.'>'.
				$title.'<div class="note_content">' . wpv_clean_do_shortcode($content) . '</div>
			</div>[/raw]';
}
add_shortcode('note', 'wpv_shortcode_note');

/*
 * framed box
 */

function wpv_shortcode_framed_box($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '',
		'bgcolor' => '',
		'textcolor' => '',
		'rounded' => 'false',
	), $atts));
	
	$width = $width ? 'width:'.$width.'px;' : '';
	$height = $height ? 'height:'.$height.'px;' : '';

	$style = (!empty($width)) ? ' style="'.$width.'"' : '';
	$bgcolor = $bgcolor ? 'background-color:'.$bgcolor.';' : '';
	$textcolor = $textcolor ? 'color:'.$textcolor : '';
	$rounded = ($rounded == 'true') ? ' rounded' : '';
	
	if(!empty($height) || !empty($bgcolor) || !empty($textcolor))
		$content_style = ' style="'.$height.$bgcolor.$textcolor.'"';
	else
		$content_style = '';
	
	return '[raw]<div class="' . $code .$rounded. '"'.$style.'>
				<div class="framed_box_content"'.$content_style.'>' . wpv_clean_do_shortcode($content) . 
					'<div class="clearboth"></div>
				</div>
			</div>[/raw]';
}
add_shortcode('framed_box', 'wpv_shortcode_framed_box');
