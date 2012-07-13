<?php
	extract(wpv_post_info());
	$format = get_post_format();
    $format = empty($format)? 'standard' : $format;

	if(has_post_format('image') || has_post_format('gallery')) {
		$show_image = true;
		$img_style = 'fullimage';
	}
	
	ob_start();
	if($news != 'true' && $show_image) {
		if(has_post_format('gallery')) {
			$has_image = 'fullimage';
			echo do_shortcode('[gallery style="gallery featured" raw="false"]');
		} else {
			$has_image = wpv_post_image($img_style, $width);
		}
	} else {
		$has_image = 'no-image';
	}
	$image = ob_get_clean();

	if(defined('WPV_ARCHIVE_TEMPLATE'))
		$fullpost = false;
?>


<div class="post-article <?php echo $has_image?>-wrapper">
	<div class="<?php echo $format?>-post-format clearfix">
		<?php echo $image; ?>
		
		<div class="post-content-outer <?php echo $has_image ?>">
			<?php
				$format = get_post_format();
				$format = empty($format)? 'standard' : $format;
			?>
			
				
			<?php if(!has_post_format('quote')): ?>
			<div class="side-post-info <?php echo $has_image ?>">
				<a class="post-format-pad" href="<?php echo add_query_arg( 'format_filter',$format,home_url()) ?>"><span class="<?php echo $format?>"></span></a>
				<?php edit_post_link('Edit') ?>
			</div>
			<?php endif ?>
			
			<?php if(!is_single()) po_post_header($meta, $news); ?>

			<?php
			$content = get_the_content();
			if(!empty($content)):
			?>
			
				<div class="post-content the-content">
					<?php if(has_post_format('quote')): ?>
						<blockquote>
							<div>
								<div class="side-post-info <?php echo $has_image ?>">
									<a class="post-format-pad" href="<?php echo add_query_arg( 'format_filter',$format,home_url()) ?>"><span class="<?php echo $format?>"></span></a>
									<?php edit_post_link('Edit') ?>
								</div>
								<?php the_content() ?>
							</div>
						</blockquote>
						<cite>
							<?php
								$post_link = get_post_meta(get_the_id(), 'post-link', true);
								$quote_author = get_post_meta(get_the_id(), 'quote-author', true);
							?>
							<a href="<?php echo $post_link?>" title="<?php echo $quote_author?>"><?php echo $quote_author?></a>
						</cite>
						<?php if(is_single()): ?>
							<?php
								wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpv' ), 'after' => '</div>' ) );
							?>
						<?php endif ?>
					<?php else: ?>
						<?php
							if(is_single()) {
								the_content();
								wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpv' ), 'after' => '</div>' ) );
							} else {
								if(!!$fullpost) {
									global $more;
									$more = 0;
									the_content(__("Read More", 'wpv'),false);
								} else {
									the_excerpt();
								}
							}
						?>
					
					<?php endif ?>
				</div>
			<?php endif ?>
			
			<?php if(is_single()) wpv_share('post'); ?>

			<footer class="entry-utility">
				<?php if($meta && !wpv_get_option('hide-post-author')): ?>
					<span class="author">by <b><?php the_author_posts_link()?></b></span>
				<?php endif ?>
				<?php if(wpv_get_option('meta_posted_on')): ?>
					<span class="entry-date" title="<?php the_time(); ?>" data-day="<?php the_time('j')?>" data-month="<?php the_time('F')?>"><?php the_time('j F'); ?></span>
					<span class="entry-month" style="display:none"><?php the_time('F')?></span>
					<span class="entry-day" style="display:none"><?php the_time('j')?></span>
				<?php endif ?>
				<?php if($meta && wpv_get_option('meta_posted_in')): ?>
					<span><?php _e('Categories:', 'wpv')?></span> <span class="post-cats"><?php echo get_the_category_list(', '); ?></span>
					<span class="the-tags"><?php the_tags('<span>Tags: </span><span>',', ','</span>')?></span>
				<?php endif ?>
				<?php if(wpv_get_option('meta_comment_count')): ?>
					<span class="comments-link fr"><?php comments_popup_link('<b>Leave a comment</b> <span class="icomment-box">?</span>', '<b>Comment</b> <span class="icomment-box">1</span>', '<b>Comments</b> <span class="icomment-box">%</span>'); ?></span>
				<?php endif ?>
			</footer>
		</div>
	</div>
	
</div>
