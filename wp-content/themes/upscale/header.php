<?php global $avia_config; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php 

	/*
	 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
	 * located in framework/php/function-set-avia-frontend.php
	 */
	 if (function_exists('avia_set_follow')) { echo avia_set_follow(); }
	 
?>


<!-- page title, displayed in your browser bar -->
<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>


<!-- add feeds, pingback and stuff-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> RSS2 Feed" href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- add css stylesheets -->	
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/projekktor/theme/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen"/>


<?php

	/* add javascript */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'avia-default' );
	wp_enqueue_script( 'avia-prettyPhoto' );
	wp_enqueue_script( 'avia-html5-video' );


	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
	
?>

<!-- plugin and theme output with wp_head() -->
<?php 

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	 
	wp_head();
?>

<!-- custom.css file: use this file to add your own styles and overwrite the theme defaults -->
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css" type="text/css" media="screen"/>
<!--[if IE 8]>
<style type='text/css'> #top  .tooltip_search_site #searchsubmit, #top  .tooltip_search_site #searchsubmit:hover{top:17px; right:10px;} </style>
<![endif]-->

<!--[if lt IE 8]>
<style type='text/css'> 
.one_fourth	{ width:21.5%;} 
</style>
<![endif]-->

</head>



<body id="top" <?php body_class(avia_get_option('boxed')); ?>>

	<div id='wrap_all'>
	
	<!-- ####### HEAD CONTAINER ####### -->
			<div class='container_wrap' id='header'>
			
				<div class='submenu'>
				
					<div class='container'>
						<?php
						/*
						*	display the main navigation menu
						*   modify the output in your wordpress admin backend at appearance->menus
						*/
						$args = array('theme_location'=>'avia2', 'fallback_cb' => '', 'max_columns'=>4);
						wp_nav_menu($args); 
						?>
					
					
						<ul class="social_bookmarks">
							<li class='rss'><a href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>"><?php _e('Subscribe to our RSS Feed', 'avia_framework')?></a></li>
							<?php 
							if($twitter = avia_get_option('twitter')) echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>".__('Follow us on Twitter', 'avia_framework')."</a></li>";
							if($facebook = avia_get_option('facebook')) echo "<li class='facebook'><a href='".$facebook."'>".__('Join our Facebook Group', 'avia_framework')."</a></li>";
							 ?>
							<li class='search_site'><a href="#"><?php _e('Search Site', 'avia_framework')?></a>
							
								<?php 
								/*
								*	display the theme search form
								*   the tempalte file that is called is searchform.php in case you want to edit it
								*/
								get_search_form(); 
								?>
							
							</li>		
						</ul>
						<!-- end social_bookmarks-->
					</div>
				</div>
				
				<div class='container main_menu'>
				
					<?php  
					/*
					*	display the theme logo by checking if the default css defined logo was overwritten in the backend.
					*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
					*/
					echo avia_logo();
					
					
					/*
					*	display the main navigation menu
					*   modify the output in your wordpress admin backend at appearance->menus
					*/
					$args = array('theme_location'=>'avia', 'fallback_cb' => 'avia_fallback_menu', 'max_columns'=>4);
					wp_nav_menu($args); 
					?> 

				</div>
				<!-- end container-->
				
				<?php
				$real_ID = $dynamic_tempalte ='';
				if(isset($avia_config['new_query']['page_id'])) 
				{
					$real_ID = $avia_config['new_query']['page_id'];
					$dynamic_tempalte = avia_post_meta($real_ID, 'dynamic_templates');
				}
				else if(is_singular())
				{
					$dynamic_tempalte = avia_post_meta($post->ID, 'dynamic_templates');
				}
				
				
				//slideshow?
					$sliderHTML = "";
					$slider_active = "";
					if(isset($post->ID) && ((is_singular() && !$dynamic_tempalte) || (is_front_page() && !$dynamic_tempalte && $real_ID)))
					{
						if(!$real_ID) $real_ID = $post->ID;
						$slider = new avia_slideshow($real_ID);
 	 					$sliderHTML = $slider->display();
 	 					
 	 					if($sliderHTML)
 	 					{
 	 						echo $sliderHTML;
 	 						$slider_active = 'slider_active';
 	 					}
					}	
				?>

			</div>
			<!-- end container_wrap_header -->
			
			<!-- ####### END HEAD CONTAINER ####### -->
			
			
			<?php 			
			/*get the callout if one is avalable*/
			if(isset($post->ID) && ((is_singular() && !$dynamic_tempalte) || (is_front_page() && !$dynamic_tempalte && $real_ID)))
			{
			
			$output = "";
			if(isset($post))
			{
				$meta = avia_post_meta($post->ID);
				$avia_config['callout_class'] = '';
				if(is_singular() && isset($meta['display_callout']) && $meta['display_callout'] == "true" )
				{		
					$avia_config['callout_class'] = "callout_active";				
					$output .= "<div class='outer_callout'>";
					$output .= "	<blockquote class='callout'>";
					
					if(!empty($meta['callout_button'])) 
						$output .= "<span class='style_wrap'><a class='big_button' href='".avia_get_link($meta, 'callout_')."'>".$meta['callout_button']."</a></span>";
						
					$output .= "		<div class='content-area'>";
					
					if(!empty($meta['callout_title']))	
						$output .= "<strong>".$meta['callout_title']."</strong>";
						
					if(!empty($meta['callout_text']))	
						$output .= "<p>".$meta['callout_text']."</p>";
						
					$output .= "		</div>";
	
					$output .= "	</blockquote>";
					$output .= "</div>";
				}
			}
			?>
			
			<?php
			}
			
			/*get the callout if one is avalable*/
			if(!(is_singular() && $dynamic_tempalte) && !(is_front_page() && $dynamic_tempalte && $real_ID))
			{
			?>
				<!-- ####### callout-panel CONTAINER ####### -->
				<div class='container_wrap callout-panel <?php echo $avia_config['callout_class']." ".$slider_active; ?>'>
					
					<div class='container'>
						
						<?php
						if(!$sliderHTML) new avia_breadcrumb(); 
						if(!empty($output)) echo $output;
						?>
					
					</div>
					<!-- end container-->
				
				</div>
				<!-- end container_wrap_header -->
			
			<!-- ####### END callout-panel CONTAINER ####### -->
			<?php
			}
			?>
			
			