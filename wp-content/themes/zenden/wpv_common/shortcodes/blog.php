<?php

/**
 * displays blog posts in a page/post
 */

function wpv_shortcode_blog($atts, $content = null, $code) {
	global $wp_filter;
	
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'count' => 3,
		'cat' => '',
		'posts' => '',
		'image' => 'false',
		'meta' => 'true',
		'full' => 'false',
		'nopaging' => 'true',
		'paged' => '',
		'img_style' => 'side',
		'width' => 'full',
		'split' => '1',
		'news' => 'false',
	), $atts));
	
	$query = array(
		'posts_per_page' => (int)$count,
		'post_type'=>'post',
	);
	
	if($paged)
		$query['paged'] = $paged;
		
	if($cat)
		$query['cat'] = $cat;
		
	if($posts)
		$query['post__in'] = explode(',',$posts);

	if ($nopaging == 'false') {
		$query['paged'] = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
	}
		
	$called_from_shortcode = true;

	$split = (int)$split;
	if($split > 1) {
		$denominator = array('','', 'half', 'third', 'fourth', 'fifth', 'sixth');	
		
		$width = 'one_'.$denominator[$split];
	}
	
	ob_start();
	query_posts($query);
	
	include locate_template(array('loop.php'));
	
	$output = ob_get_contents();
	ob_end_clean();

	wp_reset_query();
	wp_reset_postdata();
	$wp_filter['the_content'] = $the_content_filter_backup;
	return '[raw]'.$output.'[/raw]';
}
add_shortcode('blog','wpv_shortcode_blog');
