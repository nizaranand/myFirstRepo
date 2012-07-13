<?php 
/*
Template Name: Portfolio
*/

global $avia_config;


	//set a deafult query with all portfolio items in case the user just selected to display the page tempalte instead of setting up a portfolio properly
	if(empty($avia_config['new_query']['tax_query'][0]['terms'][0]) || $avia_config['new_query']['tax_query'][0]['terms'][0] == "null") 
	{ 
		if(!isset($avia_config['portfolio_item_count'])) $avia_config['portfolio_item_count'] = '-1';
	
		$avia_config['new_query'] = array("paged" => get_query_var( 'paged' ),  "posts_per_page" => $avia_config['portfolio_item_count'],  "post_type"=>"portfolio"); 
	

	}


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['callout_class']; ?>' id='main'>
		
			<div class='container'>

				<div class='template-portfolio-overview content portfolio-size-<?php echo $avia_config['portfolio_columns']. " ".$avia_config['portfolio_style']; ?>'>
				
				<?php
				//display the default content of the portfolio
				if(isset($post->ID))
				{
					the_post();
					echo "<div class='post-entry post-entry-first'>";
					echo "<h2 class='portfolio-title'>".get_the_title()."</h2>";
					if(get_the_content() != "")
					{
						the_content();
					}
					echo "</div>";
					echo "<div class='hr portfolio-hr portfolio-hr-first'>";
					edit_post_link('Edit');
					echo "</div>";	
				}
				
				
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-portfolio.php and that will be used instead.
				*/
				
				get_template_part( 'includes/loop', 'portfolio' );
				
				?>
				
				
				<!--end content-->
				</div>
				
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>