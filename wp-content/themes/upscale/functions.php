<?php

##################################################################
# AVIA FRAMEWORK by Kriesi

# this include calls a file that automatically includes all 
# the files within the folder framework and therefore makes 
# all functions and classes available for later use
							
add_theme_support('avia_mega_menu');
require_once( 'framework/avia_framework.php' );


##################################################################


//register additional image thumbnail sizes that should be generated when user uploads an image:
global $avia_config;

$avia_config['imgSize']['widget'] 		= array('width'=>48,  'height'=>48 );		// small preview pics eg sidebar news
$avia_config['imgSize']['related'] 		= array('width'=>128, 'height'=>80);		// small images for related items
$avia_config['imgSize']['portfolio'] 	= array('width'=>208, 'height'=>125);		// small preview pic for default portfolio (4 columns )
$avia_config['imgSize']['portfolio2'] 	= array('width'=>448, 'height'=>260);		// medium preview pic for 2 column portfolio and small 3d slider
$avia_config['imgSize']['portfolio3'] 	= array('width'=>288, 'height'=>170);		// medium preview pic for 3 column portfolio
$avia_config['imgSize']['page'] 		= array('width'=>608, 'height'=>200);		// image for pages and one column portfolio
$avia_config['imgSize']['featured'] 	= array('width'=>928, 'height'=>350);		// big images for fullsize pages and fullsize 2D & 3D slider
$avia_config['imgSize']['portrait'] 	= array('width'=>340, 'height'=>390);		// medium preview pic for portrait pictures




/*preview images for special column sizes of the dynamic template. you can remove those if you dont use them, it will save performance while uploading images and will also save ftp storage*/
$avia_config['imgSize']['grid6'] 		= array('width'=>448, 'height'=>125); 		// half sized images when using 4 columns
$avia_config['imgSize']['grid8'] 		= array('width'=>608, 'height'=>170);		// two/third image	
$avia_config['imgSize']['grid9'] 		= array('width'=>688, 'height'=>125);		// three/fourth image
$avia_config['imgSize']['grid_fifth1'] 	= array('width'=>148, 'height'=>100);		// one fifth
$avia_config['imgSize']['grid_fifth2'] 	= array('width'=>340, 'height'=>100);		// two fifth
$avia_config['imgSize']['grid_fifth3'] 	= array('width'=>532, 'height'=>100);		// three fifth
$avia_config['imgSize']['grid_fifth4'] 	= array('width'=>724, 'height'=>100);	    // four fifth
///////



avia_backend_add_thumbnail_size($avia_config);






##################################################################
# Frontend Stuff necessary for the theme:
##################################################################

load_theme_textdomain('avia_framework');

/* Register frontend javascripts: */

wp_register_script( 'avia-default', AVIA_BASE_URL.'js/avia.js', array('jquery','avia-html5-video'), 1, false );
wp_register_script( 'avia-prettyPhoto',  AVIA_BASE_URL.'js/prettyPhoto/js/jquery.prettyPhoto.js', 'jquery', "3.0.1", false);
wp_register_script( 'avia-html5-video',  AVIA_BASE_URL.'js/projekktor/projekktor.min.js', 'jquery', "1", false);



/* Activate native wordpress navigation menu and register a menu location */

add_theme_support('nav_menus');
register_nav_menu('avia', THEMENAME.' Main Menu');
register_nav_menu('avia2', THEMENAME.' Small Sub Menu');


//load some frontend functions in folder include:

require_once( 'includes/admin/register-widget-area.php' );		// register sidebar widgets for the sidebar and footer
require_once( 'includes/admin/register-portfolio.php' );		// register custom post types for portfolio entries
require_once( 'includes/admin/register-styles.php' );			// register the styles for dynamic frontend styling
require_once( 'includes/admin/register-shortcodes.php' );		// register wordpress shortcodes
require_once( 'includes/loop-comments.php' );					// necessary to display the comments properly
require_once( 'includes/helper-slideshow.php' ); 				// holds the class that generates the 2d & 3d slideshows, as well as feature images
require_once( 'includes/helper-templates.php' ); 				// holds some helper functions necessary for dynamic templates
require_once( 'includes/admin/compat.php' );					// compatibility functions for 3rd party plugins

//activate framework widgets
register_widget( 'avia_tweetbox');
register_widget( 'avia_newsbox' );
register_widget( 'avia_portfoliobox' );
register_widget( 'avia_socialcount' );
register_widget( 'avia_combo_widget' );
register_widget( 'avia_partner_widget' );

//call functions for the theme
add_filter('the_content_more_link', 'avia_remove_more_jump_link');
add_post_type_support('page', 'excerpt');


//allow mp4, webm and ogv file uploads
add_filter('upload_mimes','avia_upload_mimes');
function avia_upload_mimes($mimes){ return array_merge($mimes, array ('mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm')); }




