<?php
global $avia_config;

//calculates a second color for hover effects based on the primary color choosen in the backend
$modify = 2;
if(avia_get_option('stylesheet') == 'dark-skin.css') $modify = 5;


$primary_addapted = avia_backend_calculate_similar_color(avia_get_option('color_1'), 'lighter', $modify);

$avia_config['style'] = array(
		
		array(
		'elements'	=>'html, .big_button, .dropcap2, #top .contentSlideControlls a.activeItem, .boxed #wrap_all',
		'key'		=>'background-color',
		'value'		=> avia_get_option('color_1')
		),
		
		
		
		array(
		'elements'	=>'.big_button',
		'key'		=>'border-color',
		'value'		=> avia_get_option('color_1')
		),
		
		array(
		'elements'	=>'a',
		'key'		=>'color',
		'value'		=> avia_get_option('color_1')
		),
		
		array(
		'elements'	=>'.big_button:hover',
		'key'		=>'background-color',
		'value'		=> $primary_addapted
		),
		
		array(
		'elements'	=>'.big_button:hover',
		'key'		=>'border-color',
		'value'		=> $primary_addapted
		),
		
		array(
		'elements'	=>'a:hover',
		'key'		=>'color',
		'value'		=> $primary_addapted
		),
		
		array(
		'elements'	=>'#footer ul a, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer_extra_text_div, #socket .container',
		'key'		=>'border-color',
		'value'		=> $primary_addapted
		),
		
		array(
		'elements'	=>'.slideshow_welcome_title, .slideshow_welcome_text, .big_button, .big_button:hover, #footer, #footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer a, #footer a:hover, #socket, #socket a, .submenu a, .dropcap2',
		'key'		=>'color',
		'value'		=> avia_get_option('color_3')
		),
		
		array(
		'key'	=>	'direct_input',
		'value'		=> avia_get_option('quick_css')
		),
		
		array(
		'elements'	=> '.cufon_headings',
		'key'	=>	'cufon',
		'value'		=> avia_get_option('font_heading')
		),
		
		
		
);	

if(avia_get_option('boxed') == 'boxed')
{
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-color',
		'value'		=> avia_get_option('bg_color')
		);
	
	$avia_config['style'][] = array(
		'elements'	=>'.boxed #wrap_all',
		'key'		=>'border-color',
		'value'		=> avia_backend_calculate_similar_color(avia_get_option('bg_color'), 'darker', 2)
		);	
		
	

if(avia_get_option('bg_image') != '')
{
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'backgroundImage',
		'value'		=> avia_get_option('bg_image')
		);
		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-position',
		'value'		=> 'top '.avia_get_option('bg_image_position')
		);

		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-repeat',
		'value'		=> avia_get_option('bg_image_repeat')
		);
		
	$avia_config['style'][] = array(
		'elements'	=>'html, body',
		'key'		=>'background-attachment',
		'value'		=> avia_get_option('bg_image_attachment')
		);
}

}



