<?php
/*
 * portfolio listing
 * 
 * kond of like the blog shortcode, but with different styles
 */

function wpv_shortcode_portfolio($atts, $content = null, $code) {
	global $wp_filter, $post;
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'column' => 4,
		'width' => 'full',
		'cat' => '',
		'ids' => '',
		'max' => 8,
		'height' => 400,
		'title' => 'true',
		'desc' => 'true',
		'more' => 'true',
		'moretext' => __('Read more', 'wpv'),
		'nopaging' => 'false',
		'sortable' => 'false',
		'group' => 'true',
		'long' => 'false',
	), $atts));
	
	// number of columns - get the css class
	$column = intval($column);
	$column_class = array('one_column', 'two_columns', 'three_columns', 'four_columns');
	$column_class = $column_class[$column-1];
	
	// get the overall portfolio width
	$central_width = wpv_str_to_width($width);

	$column_width = intval($central_width / $column);
	$size = array($central_width, $height);
	
	// set the width of a column (without blank space)
	if($column > 1) {
		$size[0] = round($column_width - 20 * ($column-1)/$column);
	} else {
		$size[0] = intval(0.7 * $column_width) -20;
	}
	
	$rel_group = 'portfolio_'.rand(1,1000); //for lightbox group
	
	ob_start();
	
	include WPV_SHORTCODE_TEMPLATES . 'portfolio.php';
	
	$wp_filter['the_content'] = $the_content_filter_backup;
		
	return '[raw]'.wpv_clean_raw(ob_get_clean()).'[/raw]';
}
add_shortcode('portfolio', 'wpv_shortcode_portfolio');
