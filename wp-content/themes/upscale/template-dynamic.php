<?php 
	
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	 if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); the_post(); }



	 /* 
	  * create a new dynamic template object and display it.
	  * The rendering class is located in includes/helper-templates.php
	  */
	 $template_name = avia_post_meta('dynamic_templates');	 
 	 $template = new avia_dynamic_template($template_name);
 	 $sliderHTML = $callout = $slider_active = $avia_config['callout_class'] = "";
 	 
 	 if($template->check(0) == 'slideshow')
 	 {
 	 	$sliderHTML = $template -> get(0);
 	 	$slider_active = 'slider_active';

 	 	if($template->check(1) == 'textarea')
	 	{
	 		$avia_config['callout_class'] = "callout_active";
	 	 	$callout = $template -> get(1);
	 	}
 	 	
 	 }

 	 if($template->check(0) == 'textarea')
 	 {
 	 	$avia_config['callout_class'] = "callout_active";
 	 	$callout = $template -> get(0);
 	 }
 	 
 	 echo $sliderHTML;
	 ?>
	
	
	
	
		<!-- ####### callout-panel CONTAINER ####### -->
		<div class='container_wrap callout-panel <?php echo $avia_config['callout_class']. " ".$slider_active; ?>'>
			
			<div class='container'>
				
				<?php
				if(!$sliderHTML) new avia_breadcrumb(); 
				echo $callout;
				?>
			
			</div>
			<!-- end container-->
		
		</div>
		<!-- end container_wrap_header -->
		
		<!-- ####### END callout-panel CONTAINER ####### -->
			
			
			
	
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['callout_class']; ?>' id='main'>
		
			<div class='container'>

				<div class='template-fullwidth content template-dynamic template-dynamic-<?php echo $template_name; ?>'>
				
				<?php
				
				$template -> display();
				
				?>
				
				
				<!--end content-->
				</div>
				
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>