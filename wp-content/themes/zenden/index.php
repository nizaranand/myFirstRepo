<?php
/**
 * @package WordPress
 * @subpackage zenden
 */

get_header(); 

$format = get_query_var('format_filter');
$title = $format? sprintf(__('Post format: %s', 'wpv'), $format) :
				  __('Blog', 'wpv');

$page_header_placed = zen_get_header_sidebars($title);

?>

<div class="pane main-pane">
	<div class="container_16">
		<?php zen_page_header($page_header_placed, $title); ?>

		<div class="page-outer-wrapper">
			<div class="page-wrapper clearfix">
				<?php wpv_has_left_sidebar() ?>

				<article <?php post_class(wpv_get_layout()) ?>>
					<div class="page-content">
						<?php get_template_part( 'loop', 'index' ); ?>
					</div>
				</article>

				<?php wpv_has_right_sidebar() ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
