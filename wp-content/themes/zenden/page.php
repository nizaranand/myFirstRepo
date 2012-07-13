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
			<?php wpv_share('page'); ?>
			<div class="clearfix page-wrapper">
				<?php wpv_has_left_sidebar() ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(wpv_get_layout()); ?>>
					<?php $has_image = wpv_page_image() ?>
					<div class="page-content <?php echo $has_image?>">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpv' ), 'after' => '</div>' ) ); ?>
					</div>

					
				</article>
				
				<?php wpv_has_right_sidebar() ?>
			</div>
		</div>
	</div>
</div>

<?php endwhile ?>

<?php get_footer(); ?>
