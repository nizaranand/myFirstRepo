<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	$meta = get_post_custom($post->ID);
	
?>

		<div class='post-entry'>
			
			<?php 
			//call the function that displays featured images and slideshows within posts
			$slider = new avia_slideshow(get_the_ID());
 	 		echo $slider->display_small($avia_config['size']);
			?>

			
			<div class="entry-content">	
				
				<h1 class='post-title'>
					<?php the_title(); ?>
				</h1>
				<?php 

				//display the actual post content
				the_content(__('Read more','avia_framework')); 
				
				//check if this is the contact form page, if so display the form
				if(avia_get_option('email_page') == $post->ID) get_template_part( 'includes/contact-form' );
			
				 ?>	
								
			</div>							
		
		
								        
		</div><!--end post-entry-->
		<div class="hr"><?php edit_post_link('Edit', '', ''); ?></div> 		
		
<?php 
	endwhile;		
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<?php get_template_part('includes/error404'); ?>
	</div>
<?php

	endif;
?>