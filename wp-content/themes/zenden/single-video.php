<?php

extract(wpv_post_info());

if(defined('WPV_ARCHIVE_TEMPLATE'))
	$fullpost = false;
?>
<div class="post-article">
	<div class="side-post-info video">
		<a class="post-format-pad" href="<?php echo add_query_arg( 'format_filter','video',home_url()) ?>"><span class="video"></span></a>
		<?php edit_post_link('Edit') ?>
	</div>
	<article class="video-post-format">
		<?php $width = ($width == 'full') ? wpv_str_to_width($width)-10 : wpv_str_to_width($width);?>
		<?php if($news != 'true'): ?>
			<div class="post-video"><?php wpv_post_video($width) ?></div>
		<?php endif ?>
		
		<?php if(!is_single()) po_post_header($meta, $news) ?>

		<?php
			$content = get_the_content();
			if(!empty($content) && !defined('WPV_ARCHIVE_TEMPLATE')):
		?>
			<div class="post-content">
				<?php
					if(is_single()) {
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpv' ), 'after' => '</div>' ) );
						wpv_share('post');
					} else {
						if($fullpost) {
							global $more;
							$more = 0;
							the_content(__("Read More", 'wpv'),false);
						} else {
							the_excerpt();
						}
					}
				?>
			</div>
		<?php endif ?>

		<footer class="entry-utility">
			<?php if($meta && wpv_get_option('meta_posted_in')): ?>
				<span><?php _e('Categories:', 'wpv')?></span> <span><?php echo get_the_category_list(', '); ?></span>
				<span class="the-tags"><?php the_tags('<span>Tags: </span><span>',', ','</span>')?></span>
			<?php endif ?>
			<?php if(wpv_get_option('meta_comment_count')): ?>
				<span class="comments-link fr"><?php comments_popup_link('<b>Leave a comment</b> <span class="icomment-box">?</span>', '<b>Comment</b> <span class="icomment-box">1</span>', '<b>Comments</b> <span class="icomment-box">%</span>'); ?></span>
			<?php endif ?>
		</footer>
	</article>
</div>
