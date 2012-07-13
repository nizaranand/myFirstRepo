<?php

define('WPV_RESPONSIVE', false);

global $wpv_hsidebars_widths, $wpv_slider_shortcode_styles;

$wpv_hsidebars_widths = array(
	'full' => 'Full',
	'one_half' => '1/2',
	'one_third' => '1/3',
	'one_fourth' => '1/4',
	'one_fifth' => '1/5',
	'one_sixth' => '1/6',
	'two_thirds' => '2/3',
	'three_fourths' => '3/4',
	'two_fifths' => '2/5',
	'three_fifths' => '3/5',
	'four_fifths' => '4/5',
	'five_sixths' => '5/6',
);

$wpv_slider_shortcode_styles = array(
	'gallery' => __('Gallery', 'wpv') ,
	'showcase' => __('Showcase', 'wpv') ,
);

add_filter('wpv_slider_effects', 'std_slider_effects');
function std_slider_effects($styles) {
	unset($styles['shrink']);
	unset($styles['peek']);
	unset($styles['gridWaveBL2TR']);
	unset($styles['gridRandomSlideDown']);
	$styles['gridFadeQueue'] = 'Grid';

	return $styles;
}

function po_shortcode_slider_width($width, $style) {
	if($style == 'showcase') {
		$width -= 192;
	}
	return $width;
}
add_filter('wpv_shortcode_slider_width', 'po_shortcode_slider_width',10,2);

function zen_posts_widget_img_size($img_size) {
	return 72;
}
add_filter('wpv_posts_widget_img_size', 'zen_posts_widget_img_size');

function get_slider_design($animation) {
	$groups = array(
		'fade' => 'navigation-preview',
		'fadeMultipleCaptions' => 'navigation-preview',
		'slide' => 'navigation-preview',
		'slideMultipleCaptions' => 'navigation-preview',
		'gridFadeQueue' => 'face',
		'gridWaveBL2TR' => 'face',
		'gridRandomSlideDown' => 'face',
		'zoomIn' => 'caption-center',
//		'shrink' => 'side-caption',
//		'peek' => 'peek',
	);
	
	return $groups[$animation];
}

function po_post_header($meta, $news='false') {
	global $post;

	$tag = 'h2';
	if($news == 'true') {
		$tag = 'h6';
	}
	
	if(!has_post_format('aside') && !has_post_format('quote')):
		$link = has_post_format('link') ? 
					get_post_meta($post->ID, 'post-link', true) :
					get_permalink();
		?>
			<header>
				<<?php echo $tag?>>
					<a href="<?php echo $link ?>" title="<?php the_title()?>"><?php the_title(); ?></a>
				</<?php echo $tag?>>
			</header>
		<?php
	endif;
}

// Produces an avatar image
function po_get_gravatar() {
	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 73 ) );
	echo $avatar;
}

// Custom callback to list comments
function po_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
  ?>
  	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
  		<div class="comment-author">
  			<?php po_get_gravatar(); ?>
			<div class="clearfix"></div>
			<?php edit_comment_link('Edit') ?>
  		</div>
          <div class="comment-content">
          	<div class="comment-meta">
		  		<?php printf(__('by %s', 'wpv'), get_comment_author_link()); ?>
				<span title="<?php comment_time(); ?>" class="comment-time"><?php comment_date(); ?></span>
		  		<?php
					if($args['type'] == 'all' || get_comment_type() == 'comment') :
						comment_reply_link(array_merge($args, array(
							'reply_text' => __('Reply','shape'), 
							'login_text' => __('Log in to reply.','shape'),
							'depth' => $depth,
							'before' => '<div class="comment-reply-link">', 
							'after' => '</div>'
						)));
					endif;
				?>
          	</div>
			<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'shape') ?>
      		<?php comment_text() ?>
  		</div>
  		<div class="clearfix"></div>
<?php } // end po_comments

function po_share_class($class) {
	$class .= ' wire-pad alignnone';
	
	return $class;
}
add_filter('wpv_share_class', 'po_share_class');

function std_share($share, $context) {
	global $post;

	ob_start();

	?>
	<!-- Starts share-btns (do not remove this comment) -->
	<div class="<?php echo apply_filters('wpv_share_class', 'share-btns')?> vertical">
		<div class="fake-btns">
			<?php
			if(wpv_get_option("share-$context-twitter")): ?>
				<span class="sbtn-twitter"></span>
			<?php
			endif;
			if(wpv_get_option("share-$context-facebook")): ?>	
				<span class="sbtn-fb"></span>
			<?php
			endif;
			?>
		</div><!-- / .fake-btns -->
		<div class="real-btns">
			<?php
			if(wpv_get_option("share-$context-twitter")): ?>
				<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a>
				<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			<?php
			endif;
			if(wpv_get_option("share-$context-facebook")): ?>
				<div class="s-sep"></div><iframe src="http://www.facebook.com/plugins/like.php?app_id=222649311093721&amp;href=<?php echo urlencode($post->guid)?>&amp;send=false&amp;layout=box_count&amp;width=60&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" style="border:none;overflow:hidden;width:auto;height:62px;float: left;" allowTransparency="true"></iframe>
			<?php
			endif;
			?>
		</div><!-- / .real-btns -->
		<div class="clearfix"></div>
	</div><!-- Ends share-btns (do not remove this comment) -->


	<?php

	return ob_get_clean();
}
add_filter('wpv_share', 'std_share', 10, 2);

// Menu descriptions
class description_walker extends Walker_Nav_Menu {
	public function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= (!empty( $item->url ) && $item->url != '#') ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '<strong>';
		$append = '</strong>';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

		if($depth != 0) {
			$description = $append = $prepend = "";
		}

		$item_output = '';

		if(is_object($item) && isset($item->title)) {
			$item_output = (is_object($args) ? $args->before : '').
							'<a'. $attributes .'>'.
		    				(is_object($args) ? $args->link_before : '') .
		    				$prepend.
		    				apply_filters( 'the_title', $item->title, $item->ID ).
		    				$append.
		    				$description.
		    				(is_object($args) ? $args->link_after : '') .
		    				'</a>'.
		    				(is_object($args) ? $args->before : '');
		}

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

function std_excerpt_more($more) {
	return ' <span class="excerpt-more">&rarr;</span>';
}
add_filter('excerpt_more', 'std_excerpt_more');

function std_excerpt_length($length) {
	global $wpv_loop_vars;

	if(isset($wpv_loop_vars) && isset($wpv_loop_vars['news']) && $wpv_loop_vars['news'] == 'true') {
		return 15;
	}

	return $length;
}
add_filter('excerpt_length', 'std_excerpt_length');

function std_title_style() {
	global $post;
	
	$title_bgimage = wpv_post_default('title_background_image', 'page_title_background_image');
	$title_bgrepeat = wpv_post_default('title_background_repeat', 'page_title_background_repeat');
	                        
	$title_style = '';
	if(!empty($title_bgimage)) {
	        $title_style .= "background-image:url('$title_bgimage') !important;";
	}
	if(!empty($title_bgrepeat)) {
	        $title_style .= "background-repeat:$title_bgrepeat !important;";
	}
	
	echo $title_style;
}

function zenden_before_widget_title($code, $position) {
	// position is one of: header, body, footer, feedback

	return '<div class="title-wrap"><h4>';
}
add_filter('wpv_before_widget_title', 'zenden_before_widget_title', 10, 2);

function zenden_after_widget_title($code, $position) {
	// position is one of: header, body, footer, feedback

	return '</h4></div>';
}
add_filter('wpv_after_widget_title', 'zenden_after_widget_title', 10, 2);

// FIXME: remove this action
add_action('init', 'slider_migration');
function slider_migration() {
	if(!wpv_get_option('new slider')) {
		$posts = get_posts(array(
			'post_type' => array('slideshow'),
			'posts_per_page' => -1,
		));
		
		foreach($posts as $post) {
			update_post_meta($post->ID, 'first-caption', $post->post_content);
			$post->post_content = '';
			wp_update_post($post);
			update_post_meta($post->ID, 'second-caption', get_post_meta($post->ID, 'helper-caption-1', true));
			update_post_meta($post->ID, 'third-caption', get_post_meta($post->ID, 'helper-caption-2', true));
			delete_post_meta($post->ID, 'helper-caption-1');
			delete_post_meta($post->ID, 'helper-caption-2');
		}

		$posts = get_posts(array(
			'post_type' => array('post', 'page', 'portfolio'),
			'posts_per_page' => -1,
		));
		
		foreach($posts as $post) {
			$slider_categories = get_post_meta($post->ID, 'slider_categories', true);
			if($cats = @unserialize($slider_categories) && isset($cats[0])) {
				update_post_meta($post->ID, 'slider', $cats[0]);
			}
		}

		wpv_update_option('new slider', true);
	}
}

function zen_get_header_sidebars($title=null) {
	if(is_null($title))
		$title = get_the_title();

	$result = false;
	global $wpv_has_header_sidebars;
	if( $wpv_has_header_sidebars) {?>
		<div class="pane">
			<div class="container_16">
			<?php 
				$result = true;
				?><header class="page-header">
					<?php if(!!wpv_post_default('show_page_header', 'has-page-header')): ?>
						<h1 class="page-header-title"><?php echo $title;?></h1>
					<?php endif ?>
					<?php if(is_singular(array('post','portfolio'))) wpv_post_siblings_links() ?>
				</header><?php
				wpv_header_sidebars();?>
			</div>
		</div>
		<?php
	}

	return $result;
}

function zen_page_header($page_header_placed, $title=null) {
	if(is_null($title))
		$title = get_the_title();

	if (!$page_header_placed): ?>
		<header class="page-header">
			<?php if(!!wpv_post_default('show_page_header', 'has-page-header')): ?>
				<h1 class="page-header-title"><?php echo $title;?></h1>
			<?php endif ?>
			<?php if(is_singular(array('post','portfolio'))) wpv_post_siblings_links() ?>
		</header>
	<?php
	endif;
}