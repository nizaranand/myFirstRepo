<?php
/**
 * @package WordPress
 * @subpackage zenden
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php $page_header_placed = zen_get_header_sidebars() ?>

<div class="pane main-pane">
	<div class="container_16">
		<?php zen_page_header($page_header_placed) ?>
		<div class="page-outer-wrapper">
			<div class="clearfix page-wrapper">

				<?php wpv_has_left_sidebar() ?>
				
				<div <?php post_class('single-post-wrapper '.wpv_get_layout())?>>
					<div class="loop-wrapper clearfix full">
						<div class="page-content post-head clearfix">
							<?php wpv_post_template(array('audio', 'video')); ?>
						</div>
						<div class="clearboth">
							<?php comments_template(); ?>
						</div>
					</div>
				</div>
					
				<?php wpv_has_right_sidebar() ?>

			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>
