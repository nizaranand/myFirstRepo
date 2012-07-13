<?php 
global $avia_config, $custom_widget_area;

if ($avia_config['currently_viewing'] != "fullwidth") // check if its a full width page, if full width dont show the sidebar content
{
			##############################################################################
			# Display the sidebar menu
			##############################################################################

				$default_sidebar = true;
				
				echo "<div class='sidebar sidebar1'>";
				echo "<span class='sidebar_top'><!-- needed for smooth start of sidebar background--></span>";
				echo "<span class='sidebar_bottom'><!-- needed for smooth end of sidebar background--></span>";
				
				// general blog sidebars
				if ($avia_config['currently_viewing'] == 'blog' && dynamic_sidebar('Sidebar Blog') ) : $default_sidebar = false; endif;
								
				// general pages sidebars
				if ($avia_config['currently_viewing'] == 'page' && dynamic_sidebar('Sidebar Pages') ) : $default_sidebar = false; endif;
				
				
				$custom_widget_area = avia_check_custom_widget('page');
								
				//unique Page sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page: '.$custom_widget_area) ) : $default_sidebar = false; endif;
				
				$custom_widget_area = avia_check_custom_widget('cat');
				
				//unique Category sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Category: '.$custom_widget_area) ) : $default_sidebar = false; endif;
								
				//sidebar area displayed everywhere
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Displayed Everywhere')) : $default_sidebar = false; endif;
				
				//default dummy sidebar
				if ($default_sidebar)
				{
	
					 avia_dummy_widget(2);
					 avia_dummy_widget(3);
					 avia_dummy_widget(4);

				}
				echo "</div>";

}	       	?>	          