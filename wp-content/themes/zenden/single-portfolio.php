<?php
/**
 * @package WordPress
 * @subpackage studium
 */

get_header();

$page_header_placed = zen_get_header_sidebars();

?>

<div class="pane main-pane">
	<div class="container_16">
		<?php zen_page_header($page_header_placed) ?>

		<div class="page-outer-wrapper">
			<div class="clearfix page-wrapper">
				<?php wpv_has_left_sidebar() ?>
					
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php $rel_group = 'portfolio_'.get_the_ID() ?>
					<?php extract(wpv_get_portfolio_options('true', $rel_group)) ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(wpv_get_layout().' '.$type); ?>>
						<?php
							$column_width = wpv_get_central_column_width();
							$size = ($type == 'gallery') ? intval(0.7 * $column_width) -28 : $column_width;

							$full_height = wpv_get_option('fullimage-height');

							if($type == 'gallery') {
								// these two set the gallery thumbnails' size and count
								$per_line = 3;
								$between = 10;

								$image_ids = array_keys(get_children(array(
									'post_parent' => get_the_id(),
									'post_status' => 'inherit',
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
								)));

								array_unshift($image_ids, get_post_thumbnail_id());
								$image_ids = array_values(array_unique($image_ids));

								$small_size = intval((0.3*$column_width+20 - $between*($per_line-1))/ $per_line);
								$rows = ceil(count($image_ids)/$per_line);

								$full_height = max($full_height, min(
													4*$small_size + 3*$between, 
													$rows*$small_size + $between*($rows-1)
												));
							}
						?>
						
						<?php if($type != 'document'): ?>
							<div class="portfolio_image_wrapper<?php if($type != 'gallery') { echo " fullwidth-folio"; } ?>">
								<?php if($type != 'video'): ?>
									<?php
										wpv_lazy_load( wpv_resize_image($image[0], $size, $full_height), get_the_title(), array(
											'width' => $size,
											'height' => $full_height,
										)); ?>
								<?php else: ?>
									<?php wpv_post_video($size, null, $href) ?>
								<?php endif ?>
							</div>
						<?php endif ?>
						
						<?php if($type == 'gallery'): ?>
							<div class="portfolio_details project-info-pad folio single">
							<?php
								foreach($image_ids as $num=>$image_id):
									$image = wp_get_attachment_image_src($image_id,'full');
									$image = $image[0];
									$image_link = wpv_resize_image($image, $size, $full_height);

									?><a class="portfolio-small lightbox thumbnail <?php if($num % $per_line ==0) echo " first-in-line"?>" href="<?php echo $image_link ?>" <?php echo $rel?>><?php
										wpv_lazy_load( wpv_resize_image($image, $small_size, $small_size), get_the_title(), array(
											'width' => $small_size,
											'height' => $small_size,
										));
									?></a><?php
								endforeach; 
							?>
							</div>
						<?php endif; ?>
						
						<div class="clearfix"></div>
						
						<div class="portfolio-text-content">
							<?php the_content()?>
						</div>
						
						<div class="clearboth">
							<?php wpv_share('portfolio'); ?>
						</div>
						
						<div class="clearboth">
							<?php comments_template(); ?>
						</div>
					</article>
					
				<?php endwhile ?>
				
				<?php wpv_has_right_sidebar() ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
