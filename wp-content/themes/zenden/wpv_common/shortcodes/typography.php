<?php

/**
 * [raw][/raw]
 *
 * Disable Automatic Formatting on Posts
 * Thanks to TheBinaryPenguin (http://wordpress.org/support/topic/plugin-remove-wpautop-wptexturize-with-a-shortcode)
 */
function penguin_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece)
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} elseif(!empty($piece)) {
			$new_content .= wptexturize(wpautop($piece));
		} else {
			$new_content .= $piece;
		}
	return $new_content;
}
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'penguin_formatter', 99);

remove_filter('widget_text', 'wpautop');
remove_filter('widget_text', 'wptexturize');
add_filter('widget_text', 'penguin_formatter', 99);

function wpv_shortcode_dropcaps($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => ''
	), $atts));
	
	$style = '';
	if(!empty($color))
		$style = "style='color:$color'";
	
	return "<span class='$code' $style>" . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'wpv_shortcode_dropcaps');
add_shortcode('dropcap2', 'wpv_shortcode_dropcaps');

/**
 * blockquotes wrapper
 */

function wpv_shortcode_blockquote($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => false,
		'cite' => false,
	), $atts));
	
	$align = $align? "class='align$align'" : '';
	$cite = $cite? "<div class='cite'>$cite</div>" : '';
	
	ob_start();
	
	include WPV_SHORTCODE_TEMPLATES . 'blockquote.php';
	
	return ob_get_clean();
}
add_shortcode('blockquote', 'wpv_shortcode_blockquote');

/**
 * highlights some inline text
 */

function wpv_shortcode_highlight($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => false
	), $atts));

	return "<span class='highlight $type'>".do_shortcode($content).'</span>';
}
add_shortcode('highlight', 'wpv_shortcode_highlight');

/**
 * <ul> wrapper
 */
 
function wpv_shortcode_list($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'color' => '',
	), $atts));

	if($color)
		$color = ' list_color_'.$color;
	
	return str_replace('<ul>', '<ul class="'.$style.$color.'">', do_shortcode($content));
}
add_shortcode('list', 'wpv_shortcode_list');

/**
 * text with an icon
 */

function wpv_shortcode_icon($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => false,
		'color' => '',
		'size' => 'small',
	), $atts));
	
	$size_int = array(
		'small' => 16,
		'medium' => 32,
		'large' => 64,
	);
	
	$size_int = $size_int[$size];
	
	return "<span class='icon_$size'><img src='".WPV_THEME_IMAGES."icons/{$color}_{$size_int}/{$style}.png' alt='{$style}' /></span>".do_shortcode($content);
}
add_shortcode('icon', 'wpv_shortcode_icon');

/**
 * adds vertical whitespace
 */

function wpv_shortcode_push($atts, $content = null) {
	extract(shortcode_atts(array(
		'h' => false,
	), $atts));
	
	$style = $h? "style='height:{$h}px'" : '';
	
	return '<div class="push" '.$style.'></div>';;
}
add_shortcode('push', 'wpv_shortcode_push');

/**
 * the following code will filter <pre><code> blocks
 */

global $wpv_code_token;
$wpv_code_token = md5(uniqid(rand()));
$wpv_code_matches = array();
function wpv_code_before_filter($content) {
	return preg_replace_callback("/(.?)\[(pre|code)\b(.*?)(?:(\/))?\](?:(.+?)\[\/\\2\])?(.?)/s", 
			"wpv_code_before_filter_callback", $content);
}
add_filter('the_content', 'wpv_code_before_filter', 0);

function wpv_code_before_filter_callback(&$match) {
	global $wpv_code_token, $wpv_code_matches;
	$i = count($wpv_code_matches);
	
	$wpv_code_matches[$i] = $match;
	
	return "\n\n<p>" . $wpv_code_token . sprintf("%03d", $i) . "</p>\n\n";
}

function wpv_code_after_filter($content) {
	global $wpv_code_token;
	
	return preg_replace_callback("/<p>\s*" . $wpv_code_token . "(\d{3})\s*<\/p>/si",
			"wpv_code_after_filter_callback", $content);
}
add_filter('the_content', 'wpv_code_after_filter', 99);

function wpv_code_after_filter_callback($match) {
	global $wpv_code_matches;
	$i = intval($match[1]);
	$content = $wpv_code_matches[$i];
	$content[5] = trim($content[5]);
	
	if (version_compare(PHP_VERSION, '5.2.3') >= 0)
		$output = htmlspecialchars($content[5], ENT_NOQUOTES, get_bloginfo('charset'), false);
	else {
		$specialChars = array('&' => '&amp;', '<' => '&lt;', '>' => '&gt;');
		$output = strtr(htmlspecialchars_decode($content[5]), $specialChars);
	}
	
	return '<' . $content[2] . ' class="'. $content[2] .'">' . $output . '</' . $content[2] . '>';
}
