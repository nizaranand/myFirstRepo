<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	
?>

		<div class='post-entry'>
			
			<?php
			//force to display small inline content slider on archive pages. Single pages and posts are allowed to display the 3d slider
			$force_small_slider = true;
			if(is_singular()) $force_small_slider = false;
			
			$slider = new avia_slideshow(get_the_ID());
 	 		echo $slider->display_small('page', $force_small_slider);
			?>
			
						
			<div class="entry-content">	
				
				<h1 class='post-title'>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
				</h1>
				
				<!--meta info-->
		        <div class="blog-meta">
		        
					<span class='post-date-comment-container'>
						<?php
						$cats = get_the_category();
						if(!empty($cats))
						{
							echo '<span class="blog-categories">';
							echo '<!--<strong>Categories: </strong>-->';
							the_category(', ');
							echo '</span>';
						}
						?></span>	
					<span class='date-container'><span><?php the_time('d') ?></span> <strong><?php the_time('M') ?> <?php the_time('Y') ?></strong></span>
					<span class='comment-container'><?php comments_popup_link("<strong>0</strong> ".__('Comments','avia_framework'), "<strong>1</strong> ".__('Comment' ,'avia_framework'),
																				  "<strong>%</strong> ".__('Comments','avia_framework'),'comments-link',
																				  "<strong></strong> ".__('Comments<br/>Off','avia_framework')
																				  ); ?>
						</span>
				<?php the_tags(' <span class="blog-tags">'.__('Tags: ','avia_frameworkt'), ', ', '</span>');  ?>
				</div><!--end meta info-->
				
				
				<?php the_content('<span class="inner_more">'.__('Read more','avia_framework').'</span>');  ?>	
								
			</div>							
		
		
									        
		</div><!--end post-entry-->
		<div class="hr"><?php edit_post_link('Edit', '', ''); ?></div> 	
		
<?php 
	endwhile;		
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
<?php

	endif;
	
	if(!isset($avia_config['remove_pagination'] ))
		echo avia_pagination();	
?>