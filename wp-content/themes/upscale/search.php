<?php 
global $avia_config;


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();

	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
		
			<div class='container'>
				
				<div class='template-search content'>
				<h2 class='firstheading'><?php echo avia_which_archive(); ?></h2>
				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-search.php and that will be used instead.
				*/
				$more = 0;
				get_template_part( 'includes/loop', 'search' );
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				$avia_config['currently_viewing'] = 'page';
				if(is_front_page()) { $avia_config['currently_viewing'] = 'frontpage'; }

				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>