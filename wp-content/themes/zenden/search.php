<?php
/**
 * @package WordPress
 * @subpackage zenden
 */

$title = sprintf( __( 'Search Results for: %s', 'wpv' ), '<span>' . get_search_query() . '</span>' );
 
get_header(); ?>

<?php $page_header_placed = zen_get_header_sidebars($title) ?>

<?php if ( have_posts() ): the_post(); ?>
<div class="pane main-pane">
	<div class="container_16">
		<?php zen_page_header($page_header_placed, $title); ?>
		
		<div class="page-outer-wrapper">
			<div class="clearfix page-wrapper">
				<?php wpv_has_left_sidebar() ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(wpv_get_layout()); ?>>
					<div class="page-content">
						<?php rewind_posts() ?>
						<?php get_template_part('loop', 'category') ?>
					</div>
				</article>
				<?php wpv_has_right_sidebar() ?>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<div class="pane main-pane">
	<h1 style="text-align: center"><?php _e('Sorry, nothing found', 'wpv') ?></h1>
</div>
<?php endif ?>

<?php get_footer(); ?>
