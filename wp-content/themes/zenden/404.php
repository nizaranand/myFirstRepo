<?php
/**
 * @package WordPress
 * @subpackage zenden
 */

get_header(); ?>

<div class="clearfix"> 
	<div class="page-404">
		<?php get_search_form(); ?>
	</div>
	
	<div class="clearfix"></div>
	
	<p class="page-404-description">
		<a href="<?php echo home_url(); ?>" class="more-btn"><span><?php _e('Or start from the home page', 'wpv')?></span></a>
	</p>
</div> 

<?php get_footer(); ?>