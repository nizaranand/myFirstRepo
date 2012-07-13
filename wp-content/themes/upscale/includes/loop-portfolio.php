<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got a page to display:
if (have_posts()) :


	$loop_counter = 1;
	$extraClass = 'first';
	
	$grid = 'grid3';
	$image_size = 'page';
	$showcaption = true;
	$hr_class = "hr";
	
	if(empty($avia_config['portfolio_columns'])) $avia_config['portfolio_columns'] = 4;
	
	switch($avia_config['portfolio_columns'])
	{
		case 1: $grid = 'grid12'; $image_size = 'featured';  break;
		case 2: $grid = 'grid6';  $image_size = 'portfolio2'; break;
		case 3: $grid = 'grid4';  $image_size = 'portfolio3'; break;
		case 4: $grid = 'grid3';  $image_size = 'portfolio'; $showcaption = false; break;
	}
	
	//iterate over the posts
	while (have_posts()) : the_post();	
	
	
?>

		
		<div class='post-entry <?php echo $grid.' '.$extraClass; ?>'>
														
			<?php 
			$slider = new avia_slideshow(get_the_ID());
			$force_display = true;
 	 		echo $slider->display_small($image_size, $force_display, $showcaption);
 	 		
 	 		//$showcaption
			
			if(!isset($avia_config['remove_portfolio_text']))
			{
				echo '<div class="entry-content">';
				
				echo "<h1 class='post-title'><a href='".get_permalink()."' rel='bookmark' title='".__('Permanent link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a></h1>";
				
				if($avia_config['portfolio_columns'] == 1)
				{
					echo get_the_term_list(  get_the_ID(), 'portfolio_entries', '<span class="blog-categories"><strong>'.__('Categories', 'avia_framework').': </strong>', ', ','</span>');
				}
				
				the_excerpt(); 
				
				
				echo "</div>";
				if(!empty($avia_config['portfolio_style']) && $avia_config['portfolio_style'] == 'portfolio_entries_boxed' ) 
				{ 
					echo '<a class="more-link" href="'. get_permalink().'"><span class="inner_more">'.__('Read more','avia_framework').'</span></a>';
				}
			}
			else
			{
				$hr_class = 'hr_invisible';
			}
			 
		?>				        
		<!-- end post-entry-->
		</div>
	
	<?php 

	$loop_counter++;
	$extraClass = "";
	if($loop_counter > $avia_config['portfolio_columns'])
	{
		$loop_counter = 1;
		$extraClass = 'first';
		echo "<div class='$hr_class'></div>";
	}


	endwhile;		
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
<?php

	endif;
	
	if($loop_counter != 1){ echo "<div class='hr'></div>"; }
	
	if(!isset($avia_config['remove_pagination'] ))
		echo avia_pagination();		
?>