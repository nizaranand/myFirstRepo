<?php
/**
 * @package WordPress
 * @subpackage zenden
 */

get_header();

if ( have_posts() ): the_post();
	$title = sprintf( __( 'Posts by %s', 'wpv' ), "<a href='".get_author_posts_url(get_the_author_meta( 'id' ))."' rel='me'>".get_the_author()."</a>" );
endif;
rewind_posts();

$page_header_placed = zen_get_header_sidebars($title);

if ( have_posts() ): the_post(); ?>

<div class="pane main-pane">
	<div class="container_16">
		<?php zen_page_header($page_header_placed, $title); ?>

		<div class="page-outer-wrapper">
			<div class="clearfix page-wrapper">
				<?php wpv_has_left_sidebar() ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(wpv_get_layout()); ?>>
					<div class="page-content">
						<?php if ( get_the_author_meta( 'description' ) ) : ?>
							<div id="entry-author-info" class="wire-pad">
								<div id="author-avatar">
									<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
								</div>
								<div id="author-description">
									<h4><?php printf( __( 'About %s', 'wpv' ), get_the_author() ); ?></h4>
									<?php the_author_meta( 'description' ); ?>
								</div>
								<div class="clearfix"></div>
							</div>
						<?php endif; ?>
						<?php rewind_posts() ?>
						<?php get_template_part('loop', 'archive') ?>
					</div>
				</article>

				<?php wpv_has_right_sidebar() ?>
			</div>
		</div>
	</div>
</div>
<?php endif ?>

<?php get_footer(); ?>