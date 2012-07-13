<?php

global $wpv_slider_effects, $wpv_shortcode_slider_effects, $wpv_slider_wavetypes, $wpv_slider_resizing;

$wpv_slider_effects = apply_filters('wpv_slider_effects', array(
	'fade' => 'fade',
	'fadeMultipleCaptions' => 'fade with multiple captions',
	'slide' => 'slide',
	'slideMultipleCaptions' => 'slide with multiple captions',
	'gridFadeQueue' => 'Grid Fade',
	'gridWaveBL2TR' => 'Grid Wave',
	'gridRandomSlideDown' => 'Grid Random',
	'zoomIn' => 'zoom in',
	'shrink' => 'shrink slide',
	'peek' => 'peek',
));

$wpv_slider_resizing = apply_filters('wpv_slider_resizing', array(
	'crop' => __('Crop', 'wpv'),
	'cropTop' => __('Crop at the top', 'wpv'),
	'fit' => __('Fit', 'wpv'),
	'stretch' => __('Stretch', 'wpv'),
));

$wpv_shortcode_slider_effects = apply_filters('wpv_shortcode_slider_effects', array(
	'fade' => 'fade',
	'slide' => 'slide',
	'zoomIn' => 'zoom in',
));

$wpv_slider_wavetypes = apply_filters('wpv_slider_wavetypes', array(
	'R2L' => __('Right to left', 'wpv'),
	'L2R' => __('Left to right', 'wpv'),
	'B2T' => __('Bottom to top', 'wpv'),
	'T2B' => __('Top to bottom', 'wpv'),
	'R2L_SNAKE' => __('Right to left / snake', 'wpv'),
	'L2R_SNAKE' => __('Left to right / snake', 'wpv'),
	'B2T_SNAKE' => __('Bottom to top / snake', 'wpv'),
	'T2B_SNAKE' => __('Top to bottom / snake', 'wpv'),
	'BR2TL' => __('Bottom right to top left', 'wpv'),
	'TL2BR' => __('Top left to bottom right', 'wpv'),
	'BL2TR' => __('Bottom left to top right', 'wpv'),
	'TR2BL' => __('Top right to bottom left', 'wpv'),
	'RAND' => __('Random', 'wpv'),
));

function wpv_get_slider_resizing($effect) {
	$resizing = array(
		'fade' => 'cropTop',
		'fadeMultipleCaptions' => 'cropTop',
		'slide' => 'cropTop',
		'slideMultipleCaptions' => 'cropTop',
		'gridFadeQueue' => 'crop',
		'gridWaveBL2TR' => 'crop',
		'gridRandomSlideDown' => 'crop',
		'zoomIn' => 'crop',
		'shrink' => 'crop',
		'peek' => 'crop',
	);

	return $resizing[$effect];
}

// most used template functions go here

/**
 * get_option wrapper
 */

if(!function_exists('wpv_get_option')) {
	function wpv_get_option($name, $default = null, $stripslashes = true) {
		global $wpv_defaults;
		if($default === null)
			$default = isset($wpv_defaults[$name]) ? $wpv_defaults[$name] : false;
		
		$option = get_option('wpv_'.$name, $default);
		if($stripslashes && is_string($option))
			$option = stripslashes($option);
		
		return $option;
	}
}

/**
 * echo option
 */

function wpvge($name, $default = null, $stripslashes = true, $boolean = false) {
	$opt = wpv_get_option($name, $default, $stripslashes);
	
	if($boolean === true) {
		$opt = (bool)$opt;
	}
	
	echo $opt;
}

/**
 * set option
 */

function wpv_update_option($name, $new_value) {
	if($new_value == 'true')
		$new_value = true;
	elseif($new_value == 'false')
		$new_value = false;
	
	$rand = rand();
	if(wpv_get_option($name, 'is_this_new'.$rand) != 'is_this_new'.$rand) {
   		update_option('wpv_' . $name, $new_value);
	} else {
		add_option('wpv_' . $name, $new_value);
	}
}

/**
 * delete option
 */

function wpv_delete_option($name) {
	delete_option('wpv_' . $name);
}

/**
 * gets either a post meta value or a blog option
 */

function wpv_post_default($meta, $default, $default_is_value = false) {
	global $post;
	
	if(!$default_is_value) {
		$default = wpv_sanitize_bool(wpv_get_option($default));
	}
	
	return (!is_singular(array('post', 'page', 'portfolio', 'slideshow')) || (get_post_meta($post->ID, 'use-global-options', true) !== 'false')) ? $default : wpv_sanitize_bool(get_post_meta($post->ID, $meta, true));
}

function wpv_sanitize_bool($value) {
	if($value === '1' || $value === 'true') {
		$value = true;
	} else if($value === '0' || $value === 'false') {
		$value = false;
	}
	return $value;
}

/**
 * slider width
 */

function wpv_get_slider_width() {
	$width = (int)wpv_get_option('content-width');
	
	return $width;
}
 
function wpv_slider_width() {
	echo wpv_get_slider_width();
}
 
/**
 * helper function - returns second argument when the first is empty, otherwise returns the first
 */

function wpv_default($value, $default) {
	if(empty($value))
		return $default;
	return $value;
}

/*
 * checks if current page is the blog page set in Settings->Reading
 */

function is_blog() {
	global $post;
	
	return $post->ID == get_option('page_for_posts');
}

/*
 * gets the width in px of the central column depending on current post settings
 */

if(!function_exists('wpv_get_central_column_width')):
function wpv_get_central_column_width() {
	global $post;

	if(defined('WPV_LAYOUT')) {
		$layout_type = WPV_LAYOUT;
	} else if(is_single()){
		$layout_type = get_post_meta($post->ID, 'layout-type', 'left-only');
	} else {
		$layout_type = 'full';
	}
	
	if(WPV_RESPONSIVE) {
		$central_width = WPV_MAX_WIDTH; 
		switch($layout_type) {
			case 'left-only':
			case 'left-sidebar':
			case 'right-only':
			case 'right-sidebar':
				$central_width = floor(0.666667*$central_width);
			break;

			case 'left-right':
			case 'two-sidebars':
				$central_width = floor(0.4*$central_width);
			break;
		}
	} else {
		$central_width = (int)wpv_get_option('content-width');
		
		if($layout_type == 'left-only' || $layout_type == 'left-right' || $layout_type == 'two-sidebars' || $layout_type == 'left-sidebar') {
			$central_width -= (int)wpv_get_option('left_sidebar_width');
		}
		if($layout_type == 'right-only' || $layout_type == 'left-right' || $layout_type == 'two-sidebars' || $layout_type == 'right-sidebar') {
			$central_width -= (int)wpv_get_option('right_sidebar_width');
		}
	}
	
	return $central_width;
}
endif;

// turns a string as four_fifths to a value in pixels, works only for the central column
if(!function_exists('wpv_str_to_width')):
function wpv_str_to_width($frac = 'full') {
	$width = wpv_get_central_column_width();
	if($frac != 'full') {
		$frac = explode('_', $frac);
		$map = array(
			'one' => 1,
			'two' => 2,
			'half' => 2,
			'three' => 3,
			'third' => 3,
			'thirds' => 3,
			'four' => 4,
			'fourth' => 4,
			'fourths' => 4,
			'five' => 5,
			'fifth' => 5,
			'fifths' => 5,
			'six' => 6,
			'sixth' => 6,
			'sixths' => 6,
		);
		
		$frac[0] = $map[$frac[0]];
		$frac[1] = $map[$frac[1]];
		
		$width = ($width - ($frac[1]-1)*20)/$frac[1]*$frac[0] + ($frac[0]-1)*20;
	}
	
	return $width;
}
endif;

/*
 * gets the correct post template depending on the post format
 */

if(!function_exists('wpv_post_template')):
function wpv_post_template($post_formats = null) {
	global $wpv_post_formats;
	if(is_null($post_formats)) {
		$post_formats = $wpv_post_formats;
	}

	$standard_post_format = true;
	foreach($post_formats as $post_format) {
		if(has_post_format($post_format)) {
			$standard_post_format = false;
			get_template_part('single', $post_format);
		}
	}
	
	if($standard_post_format) {
		get_template_part('single', 'standard');
	}
}
endif;			

/*
 * gets basic post settings
 */

if(!function_exists('wpv_post_info')):
function wpv_post_info() {
	global $wpv_loop_vars, $post;
	
	$result = array();
	
	if(is_array($wpv_loop_vars)) {
		extract($wpv_loop_vars);
		$result['show_image'] = ($image == 'true');
		$result['img_style'] = $img_style;
		$result['meta'] = ($meta == 'true');
		$result['fullpost'] = ($fullpost == 'true');
		$result['width'] = $width;
		$result['news'] = $news;
	} else {
		$result['img_style'] = wpv_post_default('img_style', 'single-featured-image-position');
		$result['show_image'] = true;
		$result['meta'] = true;
		$result['fullpost'] = true;
		$result['width'] = 'full';
		$result['news'] = 'false';
	}
	
	return $result;
}
endif;

/*
 * echoes the post video for the video post type
 */

if(!function_exists('wpv_post_video')):
function wpv_post_video($width, $height = null, $link = null) {
	global $post;

	if(!isset($link)) {
		$link = get_post_meta($post->ID, 'post-link', true);	
	}
	$type = 'html5';
	
	if(isset($height)) {
		$height = 'height="'.$height.'"';
	}
			
	if(strpos($link, 'youtube') !== false || strpos($link, 'youtu.be') !== false) {
		$type = 'youtube';
	} elseif(strpos($link, 'vimeo') !== false) {
		$type = 'vimeo';
	} elseif(strpos($link, 'dailymotion') !== false) {
		$type = 'dailymotion';
	} elseif(preg_match('/\.swf$/i', $link)) {
		$type = 'flash';
	} elseif(preg_match('/\.(mp4|ogg|webm)$/i', $link)) {
		$type = 'html5';
	}
	
	echo do_shortcode('[video type="'.$type.'" src="'.$link.'" width="'.$width.'" '.$height.']');
}
endif;

// lazy load images
if(!function_exists('wpv_lazy_load')):
function wpv_lazy_load($url, $alt='', $atts = array()) {
	echo wpv_get_lazy_load($url, $alt, $atts);
}

function wpv_get_lazy_load($url, $alt='', $atts = array()) {
	$disabled = wpv_get_option('disable-lazy-load');

	if(!$disabled) {
		if(isset($atts['class'])) {
			$atts['class'] .= ' lazy';
		} else {
			$atts['class'] = 'lazy';
		}
	}
	
	if(isset($atts['height']) && empty($atts['height'])) { 
		unset($atts['height']);
	}

	if(isset($atts['width']) && empty($atts['width'])) { 
		unset($atts['width']);
	}	
	
	$extended_atts = array();
	foreach($atts as $att=>$val) {
		$extended_atts[] = "$att='$val'";
	}
	$atts = implode(' ', $extended_atts);

	ob_start();
?>
	<img src="<?php echo $url?>" alt="<?php echo $alt?>" <?php echo $atts?> />
<?php
	$clean = ob_get_clean();

	ob_start();
?>
	<img src="<?php echo WPV_IMAGES ?>blank.gif" alt="<?php echo $alt?>" data-href="<?php echo $url?>" <?php echo $atts?> />
	<noscript><?php echo $clean ?></noscript>
<?php
	$lazy = ob_get_clean();
	return $disabled ? $clean : $lazy;
}
endif;

// Remove empty paragraph tags from the_content
function wpv_remove_empty_p($content) {
    return preg_replace("/<p[^>]*>\s*<\\/p[^>]*>/", '', $content);
}
add_filter('the_content', 'wpv_remove_empty_p', 100000);

function wpv_get_portfolio_options($group, $rel_group) {
	$res = array();
	
	$res['image'] = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true);
			
	$res['type'] = wpv_default(get_post_meta(get_the_id(), 'portfolio_type', true), 'image');
			
	$res['width'] = '';
	$res['height'] = '';
	$res['iframe'] = '';
			
	// calculate some options depending on the portfolio item's type
	if($res['type'] == 'image') {
		$res['href'] =  $res['image'][0];
		$res['lightbox'] = ' lightbox';
		$res['rel'] = ($group == 'true')? ' rel="'.$rel_group.'"' : '';

	} elseif($res['type'] == 'video') {
		$res['href'] = get_post_meta(get_the_id(), 'portfolio_data_url', true);
		if(empty($res['href'])) {
			$res['href'] = $res['image'][0];
		}
				
		$res['video_width'] = get_post_meta(get_the_id(), 'portfolio_video_width', true);
		$res['video_height'] = get_post_meta(get_the_id(), 'portfolio_video_height', true);

		$res['width'] = ' data-width="'.$res['video_width'].'"';
		$res['height'] = ' data-height="'.$res['video_height'].'"';
		$res['iframe'] = ' data-iframe="true"';
				
		$res['lightbox'] = ' lightbox';
		$res['rel'] = ($group == 'true')? ' rel="'.$rel_group.'"' : '';
				
	} elseif($res['type'] == 'link') {
		$res['href'] = get_post_meta(get_the_ID(), 'portfolio_data_url', true);

		$res['link_target'] = get_post_meta(get_the_ID(), '_link_target', true);
		$res['link_target'] = $res['link_target'] ? $res['link_target'] : '_self';

		$res['lightbox'] = ' no-lightbox';
		$res['rel'] = '';
				
	} elseif($res['type'] == 'gallery') {
		$res['image_ids'] = array_keys(get_children(get_the_ID()));
		$res['rel'] = ($group == 'true')? ' rel="'.$rel_group.'"' : '';
				
		if(!empty($res['image_ids'])) {
			$res['rel'] = 'rel="gallery-'.get_the_ID().'"';
			$res['href'] = $res['image'][0]; 
		}

		$res['lightbox'] = ' lightbox';

	} elseif($res['type'] == 'document') {
		if(is_single()) {
			$res['href'] = $res['image'][0];
			$res['lightbox'] = ' lightbox';
		} else {
			$res['href'] = get_permalink();
			$res['lightbox'] = ' no-lightbox';
		}
		$res['rel'] = '';
	}

	return $res;
}

/* standard post format filter */
add_filter('query_vars', 'wpv_format_filter_vars' );
function wpv_format_filter_vars($qvars) {
	$qvars[] = 'format_filter';
	return $qvars;
}

add_filter('body_class', 'wpv_format_filter_body_class');
function wpv_format_filter_body_class($classes) {
	if(get_query_var('format_filter'))
		$classes[] = 'archive';
	return $classes;
}

add_action('wp_head', 'wpv_format_filter_query', 10000);
function wpv_format_filter_query() {
	$format = get_query_var('format_filter');
	if($format) {
		global $wpv_post_formats;
		
		$post_formats_longname = array();
		
		$query = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
				)
			),
			'paged' => get_query_var('paged') ? get_query_var('paged') : 
						(get_query_var('page') ? get_query_var('page') : 1),
			'format_filter' => $format,
		);
		
		if($format == 'standard') {
			foreach($wpv_post_formats as $f) {
				$post_formats_longname[] = 'post-format-'.$f;
			}
			
			$query['tax_query'][0]['terms'] = $post_formats_longname;
			$query['tax_query'][0]['operator'] = 'NOT IN';
		} else {
			$query['tax_query'][0]['terms'] = array('post-format-'.$format);
			$query['tax_query'][0]['operator'] = 'IN';
		}

		query_posts($query);
		unset($GLOBALS['wp_the_query']);
		$GLOBALS['wp_the_query'] =& $GLOBALS['wp_query'];
	}
}

// passes the code through do_shortcode and then removes [raw]...[/raw] wrappers
function wpv_clean_do_shortcode($content) {
	return wpv_clean_raw(do_shortcode($content));
}

function wpv_clean_raw($content) {
	return str_replace('[raw]', '', str_replace('[/raw]', '', $content));
}

function wpv_static($option) {
	if(isset($option['static']) && $option['static']) {
		echo 'static';
	}	
}

function wpv_custom_js() {
	$custom_js = wpv_get_option('custom_js');
		
	if(!empty($custom_js)):
?>
	<script><?php echo $custom_js; ?></script>
<?php
	endif;
}
add_action('wp_footer', 'wpv_custom_js');

function wpv_ga_script() {
	$an_key = wpv_get_option('analytics_key');
	if($an_key): 
?>
	<script>
    	var _gaq=[['_setAccount','<?php echo $an_key?>'],['_trackPageview']];
    	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    	s.parentNode.insertBefore(g,s)}(document,'script'));
  	</script>
<?php
	endif;
}
add_action('wp_footer', 'wpv_ga_script');

function wpv_sub_shortcode($name, $content, &$params, &$sub_contents) {
	if(!preg_match_all("/\[$name\b(?P<params>.*?)(?:\/)?\](?:(?P<contents>.+?)\[\/$name\])?/s", $content, $matches)) {
		return false;
	}
	
	$params = array();
	$sub_contents = $matches['contents'];
	
	foreach($matches['params'] as $param_str) {
		$params[] = shortcode_parse_atts($param_str);
	}
	
	return true;
}

function wpv_is_login() {
	return strpos($_SERVER['PHP_SELF'], 'wp-login.php') !== false;
}

/**
 * @see http://wordpress.stackexchange.com/a/7094/8344
 */
function wpv_get_attachment_id( $url ) {
    $dir = wp_upload_dir();
    $dir = trailingslashit($dir['baseurl']);

    if( false === strpos( $url, $dir ) )
        return false;

    $file = basename($url);

    $query = array(
        'post_type' => 'attachment',
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'value' => $file,
                'compare' => 'LIKE',
            )
        )
    );

    $query['meta_query'][0]['key'] = '_wp_attached_file';
    $ids = get_posts( $query );

    foreach( $ids as $id )
        if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
            return $id;

    $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
    $ids = get_posts( $query );

    foreach( $ids as $id ) {

        $meta = wp_get_attachment_metadata($id);

        foreach( $meta['sizes'] as $size => $values )
            if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {

                $this->attachment_size = $size;
                return $id;
            }
    }

    return false;
}

/**
 * This function check whether a given url is an image attachment and resizes it to $width x $height
 */
function wpv_resize_image($src, $width, $height, $quality=90) {
	$attachment_id = wpv_get_attachment_id($src);
	if( $attachment_id !== false && wp_attachment_is_image($attachment_id) ) {
		$uploads = wp_upload_dir();
		$file = get_attached_file($attachment_id);
		$thumbnail = wpv_thumbnail_path($file, $width, $height);

		if(is_wp_error($thumbnail)) {
			return $src;
		} else {
			if(!file_exists($thumbnail))
				$thumbnail = image_resize($file, $width, $height, true, null, null, $quality);

			return str_replace($uploads['basedir'], $uploads['baseurl'], $thumbnail);
		}
	} 

	return $src; // not an image attachment, will not be resized
}

/**
 * Returns the possible file path for a scaled down version of an image
 * 
 * Most of the code matches the parts of the image_resize() function, since it doesn't check if the file exists before overwriting it.
 *
 * @param string $file Image file path.
 * @param int $max_w Maximum width to resize to.
 * @param int $max_h Maximum height to resize to.
 * @return string Thumbnail file path
 */
function wpv_thumbnail_path($file, $max_w, $max_h) {
	$size = @getimagesize( $file );
	if ( !$size )
		return new WP_Error('invalid_image', __('Could not read image size', 'wpv'), $file);
	list($orig_w, $orig_h, $orig_type) = $size;

	$dims = image_resize_dimensions($orig_w, $orig_h, $max_w, $max_h, true);
	if ( !$dims )
		return new WP_Error( 'error_getting_dimensions', __('Could not calculate resized image dimensions', 'wpv') );
	list($dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) = $dims;

	$info = pathinfo($file);
	$dir = $info['dirname'];
	$ext = $info['extension'];
	$name = wp_basename($file, ".$ext");

	return "{$dir}/{$name}-{$dst_w}x{$dst_h}.{$ext}";

	return file_exists($destfilename);
}

function wpv_prepare_url($url) {
	while(preg_match('#/[-\w]+/\.\./#', $url)) {
		$url = preg_replace('#/[-\w]+/\.\./#', '/', $url);
	}

	return $url;
}
