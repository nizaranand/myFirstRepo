<?php

/**
 * Various template helpers
 */

/**
 * page layout
 */
function wpv_get_layout() {
	if(!defined('WPV_LAYOUT_TYPE')) {
		$layout_type = '';
		if(is_singular(array('page', 'post', 'portfolio'))) {
			$layout_type = wpv_post_default('layout-type', 'default-body-layout');
		} else {
			$layout_type = wpv_get_option('default-body-layout');
		}

		if(empty($layout_type)) {
			$layout_type = 'full';
		}

		define('WPV_LAYOUT_TYPE', $layout_type);
		
		switch($layout_type) {
			case 'left-only':
				define('WPV_LAYOUT', 'left-sidebar');
			break;
			case 'right-only':
				define('WPV_LAYOUT', 'right-sidebar');
			break;
			case 'left-right':
				define('WPV_LAYOUT', 'two-sidebars');
			break;
			case 'full':
				define('WPV_LAYOUT', 'no-sidebars');
			break;
		}

		return $layout_type;
	}

	return WPV_LAYOUT_TYPE;
}

/**
 * deals with the left sidebar
 */
function wpv_has_left_sidebar() {
	global $sidebars;
	$layout_type = wpv_get_layout();

	if($layout_type == 'left-only' || $layout_type == 'left-right'): ?>
		<aside class="<?php echo apply_filters('wpv_left_sidebar_class', 'left', $layout_type) ?>">
			<?php $sidebars->get_sidebar('left'); ?>
		</aside>
	<?php endif;
}

/**
 * deals with the right sidebar
 */
function wpv_has_right_sidebar() {
	global $sidebars;
	$layout_type = wpv_get_layout();

	if($layout_type == 'right-only' || $layout_type == 'left-right'): ?>
		<aside class="<?php echo apply_filters('wpv_right_sidebar_class', 'right', $layout_type) ?>">
			<?php $sidebars->get_sidebar('right'); ?>
		</aside>
	<?php endif;
}

/**
 * wrapper for wpv_hf_sidebars
 */
function wpv_header_sidebars() {
	wpv_hf_sidebars('header');
}

/**
 * wrapper for wpv_hf_sidebars
 */
function wpv_footer_sidebars() {
	wpv_hf_sidebars('footer');
}

/**
 * displays header/footer sidebars
 */
function wpv_hf_sidebars($area) {
	$is_active = false;
	$sidebar_count = (int)wpv_get_option("$area-sidebars");
	for($i=1; $i<=$sidebar_count; $i++) {
		$is_active = $is_active || is_active_sidebar("$area-sidebars-$i");
	}
	
	if($is_active): 
?>

	<div id="<?php echo $area?>-sidebars">
		<div class="clearfix">
			<?php for($i=1; $i<=$sidebar_count; $i++): ?>
				<?php if ( is_active_sidebar("$area-sidebars-$i") ) : ?>
					<?php $is_last = wpv_get_option("$area-sidebars-$i-last") ?>
					<aside class="<?php wpvge("$area-sidebars-$i-width")?><?php if($is_last) echo ' last' ?>"><div>
						<?php dynamic_sidebar("$area-sidebars-$i"); ?>
					</div></aside>
					<?php if($is_last): ?>
						<div class="clearboth push"></div>
						<?php if($i != $sidebar_count): ?>
							<div class="sep"></div>
						<?php endif ?>
					<?php endif ?>
				<?php endif; ?>
			<?php endfor ?>
		</div>
	</div>

	<?php endif;
}

/**
 * echos the html for the post's featured image
 * 
 * @returns 'no-image' or $img_style
 */
function wpv_post_image($img_style, $width="full") {
	$has_image = 'no-image';
	
	if( $img_style == 'sideimage' || $img_style == 'right sideimage'): // not full width images 
		$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		if(isset($img[0])):
			$has_image = $img_style;
			
			$class = '';
			if($img_style == 'right sideimage') {
				$class .= 'alignright';
			}

			if(WPV_RESPONSIVE) {
				$width = floor(apply_filters('wpv_post_fullimage_width', wpv_str_to_width($width), $width)*0.4);
				$height = 0;
			} else {
				$width = wpv_get_option('post-thumbnail-width');
				$height = wpv_get_option('post-thumbnail-height');
			}
?>
			<div class="post-thumb <?php echo $class?>"><div>
				<?php if(!is_single()): ?>
					<a href="<?php the_permalink(); ?>">
				<?php else: ?>
					<span class="thumbnail">
				<?php endif ?>
						<?php wpv_lazy_load( wpv_resize_image($img[0], $width, $height), get_the_title(), array(
							'width' => $width,
							'height' => $height
						)) ?>
				<?php if(!is_single()): ?>
					</a>
				<?php else: ?>
					</span>
				<?php endif ?>
			</div></div>
<?php 
		endif;
	else:
		$width = apply_filters('wpv_post_fullimage_width', wpv_str_to_width($width), $width);
		$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		if(isset($img[0])):
			$has_image = $img_style;
?>
			<div class="post-full-thumb">
				<?php if(!is_single()): ?>
					<a href="<?php the_permalink(); ?>">
				<?php else: ?>
					<span class="thumbnail">
				<?php endif ?>
						<?php wpv_lazy_load( wpv_resize_image($img[0], $width, wpv_get_option('fullimage-height')), get_the_title(), array(
							'width' => $width,
							'height' => wpv_get_option('fullimage-height')
						))?>
				<?php if(!is_single()): ?>
					</a>
				<?php else: ?>
					</span>
				<?php endif ?>
			</div>
<?php
		endif;
	endif;
	
	return $has_image;
}

/**
 * echos the html for the page's featured image
 * 
 * @returns 'no-image' or'fullimage'
 */
function wpv_page_image() {
	$has_image = 'no-image';
	
	$width = apply_filters('wpv_page_image_width', wpv_get_central_column_width());
	$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	if(isset($img[0])):
		$has_image = 'fullimage';
?>
		<div class="post-full-thumb">
			<span class="thumbnail">
				<?php wpv_lazy_load(wpv_resize_image($img[0], $width, wpv_get_option('fullimage-height')), get_the_title())?>
			</span>
		</div>
<?php
	endif;
	
	return $has_image;
}

/**
 * echoes prev/next links
 */

function wpv_post_siblings_links() {
	global $post;

	$same_cat = count(wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'))) > 0;
	if($post->post_type == 'portfolio')
		$same_cat = count(wp_get_object_terms($post->ID, 'portfolio_category', array('fields' => 'ids'))) > 0;
	
	echo '<div class="prev-next-posts-links clearfix">';

	previous_post_link('<span class="prev-post">%link</span>', __('<span></span><b>Previous</b>', 'wpv'), $same_cat);
	echo '<a href="#" class="all-items"><span></span><b>View all</b></a>';
	next_post_link('<span class="next-post">%link</span>', __('<span></span><b>Next</b>', 'wpv'), $same_cat);

	echo '</div>';
}

add_filter('get_previous_post_join', 'wpv_post_siblings_join', 10, 3);
add_filter('get_next_post_join', 'wpv_post_siblings_join', 10, 3);
function wpv_post_siblings_join($join, $in_same_cat, $excluded_categories) {
	global $post;

	if($post->post_type == 'portfolio') {
		$join = str_replace("'category'", "'portfolio_category'", $join);
		$cat_array = wp_get_object_terms($post->ID, 'portfolio_category', array('fields' => 'ids'));
		$cat_in = "tt.term_id IN (" . implode(',', $cat_array) . ")";
		$join = preg_replace('#tt\.term_id IN \([^)]*\)#', $cat_in, $join);
	}

	return $join;
}

add_filter('get_previous_post_where', 'wpv_post_siblings_where', 10, 3);
add_filter('get_next_post_where', 'wpv_post_siblings_where', 10, 3);
function wpv_post_siblings_where($where, $in_same_cat, $excluded_categories) {
	global $post;

	if($post->post_type == 'portfolio') {
		$where = str_replace("'category'", "'portfolio_category'", $where);
	}

	return $where;
}

/**
 * echoes the "load more" button
 */

function wpv_load_more() {
	global $wp_query;
	
	$max = $wp_query->max_num_pages;
	$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
	
	if($max != $paged) {
		echo '<div class="load-more"><a href="'.get_next_posts_page_link($max).'" class="lm-btn">'.__('Load more', 'wpv').'<span></span></a></div>';
	}
}

/**
 * some social buttons and feedback form/button
 */
function wpv_buttons() {
	if(!apply_filters('wpv_show_buttons', true)) return;

	?>
	<?php if(wpv_get_option('show-feedback')): ?>
		<div id="feedback-wrapper">
			<?php if(wpv_get_option('feedback-type') == 'sidebar'): ?>
				<?php dynamic_sidebar('feedback-sidebar') ?>
				<a href="#" id="feedback" class="slideout" ></a>
			<?php else: ?>
				<a href="<?php wpvge('feedback-link')?>" id="feedback"></a>
			<?php endif ?>
		</div>
	<?php endif ?>
	
	<?php if(wpv_get_option('show_scroll_to_top')): ?>
		<div id="scroll-to-top"></div>
	<?php endif ?>
	
	<div class="icons-top">
	<?php if(wpv_get_option('show_rss_button')): ?>
		<a href="<?php bloginfo('rss2_url')?>" id="rss-top"></a>
	<?php endif ?>
	
	<?php if(wpv_get_option('fb-link')): ?>
		<a href="<?php wpvge('fb-link')?>" id="ifb" target="_blank"></a>
	<?php endif ?>
	
	<?php if(wpv_get_option('twitter-link')): ?>
		<a href="<?php wpvge('twitter-link')?>" id="itwitter" target="_blank"></a>
	<?php endif ?>
	
	<?php if(wpv_get_option('youtube-link')): ?>
		<a href="<?php wpvge('youtube-link')?>" id="iyoutube" target="_blank"></a>
	<?php endif ?>
	
	<?php if(wpv_get_option('flickr-link')): ?>
		<a href="<?php wpvge('flickr-link')?>" id="iflickr" target="_blank"></a>
	<?php endif ?>

	<?php if(wpv_get_option('linkedin-link')): ?>
		<a href="<?php wpvge('linkedin-link')?>" id="ilinkedin" target="_blank"></a>
	<?php endif ?>

	</div><!-- / .icons-top -->
	
	<?php
}
add_action('wp_footer', 'wpv_buttons');

/*
 * adds share buttons depending on context
 */

if(!function_exists('wpv_share')):
function wpv_share($context) {
	global $post;
	
	ob_start();
	
	if(wpv_get_option("share-$context-twitter") || wpv_get_option("share-$context-facebook")):
	?>
	<div class="<?php echo apply_filters('wpv_share_class', 'share-btns')?>">
	<?php
	
	if(wpv_get_option("share-$context-twitter")): ?>
		<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<?php
	endif;
	if(wpv_get_option("share-$context-facebook")): ?>
		<iframe src="http://www.facebook.com/plugins/like.php?app_id=222649311093721&amp;href=<?php echo urlencode($post->guid)?>&amp;send=false&amp;layout=button_count&amp;width=60&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" style="border:none; overflow:hidden; width:auto; height:21px; float: left;" allowTransparency="true"></iframe>
	<?php
	endif;
	?>
		<div class="clearfix"></div>
	</div><!-- / .wire-pad -->
	<?php
	endif;
	
	echo apply_filters('wpv_share', ob_get_clean(), $context);
}
endif;

/*
 * post meta helper
 */

if(!function_exists('wpv_meta')):
function wpv_meta() {?>
	<?php if(wpv_get_option('meta_posted_in') || wpv_get_option('meta_posted_on') || wpv_get_option('meta_comment_count')): ?>
		<div class="entry-meta">
			<?php if(wpv_get_option('meta_posted_in')):?>
				<span class="posted-in"><?php wpv_posted_in() ?></span>
				<span class="meta-sep">|</span>
			<?php endif ?>
			<?php if(wpv_get_option('meta_posted_in')):?>
				<span class="posted-on"><?php wpv_posted_on() ?></span>
				<span class="meta-sep">|</span>
			<?php endif ?>
			<?php if(wpv_get_option('meta_comment_count')):?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'wpv' ), __( '1 Comment', 'wpv' ), __( '% Comments', 'wpv' ) ); ?></span>
			<?php endif ?>
			<?php edit_post_link( __( 'Edit', 'wpv' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</div>
	<?php endif ?>
<?php
}
endif;

/*
 * comments callback
 */

if ( ! function_exists( 'wpv_comments' ) ) :
function wpv_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
        ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div class="comment-wrapper">
					<div class="comment-left">
						<?php echo get_avatar( $comment, 80 ); ?>
					</div>
					<div class="comment-right">
						<div class="comment-meta">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<?php comment_date()?>
							</a>
							<?php edit_comment_link( __( '(Edit)', 'wpv' ), ' ' );?>
						</div>
						<div class="comment-author vcard">
							<?php comment_author_link()?>
						</div><!-- .comment-author .vcard -->
						
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'wpv' ); ?></em>
							<br />
						<?php endif; ?>
	
						<div class="comment-body"><?php comment_text(); ?></div>
	
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</div><!-- .comment-right -->
				</div><!-- .comment-wrapper -->

	<?php
		break;
		
		case 'pingback'  :
		case 'trackback' :
	?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'wpv' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'wpv'), ' ' ); ?></p>
        <?php
		break;
	endswitch;
	
}
endif;

/*
 * "posted on" meta
 */

if ( ! function_exists( 'wpv_posted_on' ) ) :
function wpv_posted_on() {
	printf( __( '%2$s <span class="meta-sep">|</span> by %3$s', 'wpv' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'wpv' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

/*
 * "posted in" meta
 */

if ( ! function_exists( 'wpv_posted_in' ) ) :
function wpv_posted_in() {
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list )
		$posted_in = __( 'Posted in %1$s <span class="meta-sep">|</span> tags %2$s', 'wpv' );
	elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) )
		$posted_in = __( 'Posted in %1$s', 'wpv' );
	
	printf($posted_in,
		get_the_category_list( ', ' ),
		$tag_list
	);
}
endif;