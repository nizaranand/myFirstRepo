<?php

//avia pages holds the data necessary for backend page creation
$boxes = array( 

	array( 'title' =>  'Top Callout', 'id'=>'page_callout', 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Slideshow Options', 'id'=>'slideshow_meta', 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Add featured media', 'id'=>'slideshow' , 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  'Dynamic Templates', 'id'=>'dynamic_templates' , 'page'=>array('post','page','portfolio'), 'context'=>'side', 'priority'=>'low' )
					 
);


$elements = array(

	array(	
	"name" 	=> "Show Callout af the op of the page?",
	"desc" 	=> "",
	"id" 	=> "display_callout",
	"type" 	=> "select",
	"std" 	=> "false",
	"slug"  => "page_callout",
	"subtype" => array('yes'=>'true','no'=>'false')),
	
	array(	"slug"	=> "page_callout", "type" => "visual_group_start", "id" => "visual_group_callout", "nodescription" => true, 'class'=>'avia_meta_description', "required" => array('display_callout','true') ),
	
	array(	"name" 	=> "Callout Title",
			"slug"  => "page_callout",
			"desc" 	=> "Enter a title for the welcome message",
			"id" 	=> "callout_title",
			"type" 	=> "text" ),
			
	array(	"name" 	=> "CalloutText",
			"slug"  => "page_callout",
			"desc" 	=> "Enter the static welcome message",
            "id" 	=> "callout_text",
            "type" 	=> "textarea" ),

	array(	"name" 	=> "Callout Button Text",
			"slug"  => "page_callout",
			"desc" 	=> "(leave empty if you dont want to display a button)",
            "id" 	=> "callout_button",
            "type" 	=> "text" ),
	
	 array(	"name" 	=> "Callout Button link",
			"desc" 	=> "",
			"slug"  => "page_callout",
            "id" 	=> "callout_link",
            "type" 	=> "select",
            "std" 	=> "",
            "subtype" => array('Link manually'=>'url', 'Link to this Post'=>'self','Link to Page'=>'page','Link to Category'=>'cat'),
            ),
   
			array(	"name" 	=> "",
					"desc" 	=> "",
					"slug"  => "page_callout",
					"id"   	=> "callout_link_url",
					"std"  	=> "http://",
					"type" 	=> "text",
					"required" => array('callout_link','url') ),
					
			array(	"name" 	=> "",
					"desc" 	=> "",
					"slug"  => "page_callout",
			        "id" 	=> "callout_link_page",
			        "type" 	=> "select",
			        "subtype" => "page",
			        "required" => array('callout_link','page') ),
			        
			array(	"name" 	=> "",
					"desc" 	=> "",
					"slug"  => "page_callout",
			        "id" 	=> "callout_link_cat",
			        "type" 	=> "select",
			        "subtype" => "cat",
			        "required" => array('callout_link','cat') ),
	
	array(	"slug"	=> "page_callout", "type" => "visual_group_end", "id" => "visual_group_callout_end", "nodescription" => true),

	array(	
		"name" 	=> "Dynamic Template",
		"desc" 	=> "Select a dynamic template for this entry. If you haven't created one yet you can do so at <a href='admin.php?page=templates'>the Template Builder</a>",
		"id" 	=> "dynamic_templates",
		"type" 	=> "select",
		"std" 	=> "",
		"slug"  => "dynamic_templates",
		"subtype" => avia_backend_get_dynamic_templates()),	

	array(	
		"name" 	=> "Autorotation active?",
		"desc" 	=> "Check if the slideshow should rotate by default",
		"id" 	=> "_slideshow_autoplay",
		"type" 	=> "select",
		"std" 	=> "false",
		"slug"  => "slideshow_meta",
		"subtype" => array('yes'=>'true','no'=>'false')),	
			
	array(	
		"name" 	=> "Duration each image gets displayed",
		"desc" 	=> "Each image will be shown X seconds, where X is the number you choose at the dropdown menu",
		"id" 	=> "_slideshow_duration",
		"type" 	=> "select",
		"std" 	=> "5",
		"slug"  => "slideshow_meta",
		"required" => array('_slideshow_autoplay','true'),
		"subtype" => 
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','60'=>'60','100'=>'100')),

	array(	
		"name" 	=> "Image slideshow?",
		"desc" 	=> "How to display the featured images bellow on a single post or page?",
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"std" 	=> "2D_small",
		"slug"  => "slideshow_meta",
		"subtype" => array('2D Fade Slideshow Small'=>'2D_small', '2D Featured Slideshow'=>'2D','3D Featured Slideshow'=>'3D')),
			 
		 
		/*Featue Image & slideshow */
		
		array(
			"type" 			=> "group", 
			"id" 			=> "slideshow", 
			"linktext" 		=> "Add another Slide",
			"deletetext" 	=> "Remove Slide",
			"slug"  		=> "slideshow",
			"blank" 		=> true, 
			"nodescription" => true,
			'subelements' 	=> array(	
			
					array(	"name" 	=> "Featured Media",
							"desc" 	=> "Upload an image or video or choose one from the Media Library",
							"id" 	=>  "slideshow_image",
							"type" 	=> "upload",
							"slug"  => "slideshow",
							"subtype" => "advanced",
							"label"	=> "Use Image as featured Image"),
					
					array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta1_start", "nodescription" => true, 'class'=>'avia_meta_default'),
					
							array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta2_start", "nodescription" => true, 'class'=>'avia_meta_block avia_wrap'),
		
									array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_sie_and_pos", "nodescription" => true, "required" => array('_slideshow_type','2D')),
				
											 array(	"name" 	=> "Image Size and Position",
													"desc" 	=> "",
													"slug"  => "slideshow",
										            "id" 	=> "slideshow_image_type",
										            "type" 	=> "select",
										            "std" 	=> "small_left",
										            "subtype" => array('Small Images on the Left'=>'small_left','Small Images on the right'=>'small_right','Full Size Images'=>'fullsize')),
										     
										      array(	"name" 	=> "Call to Action Button Label",
														"desc" 	=> "",
														"slug"  => "slideshow",
											            "id" 	=> "slideshow_button",
											            "type" 	=> "text",
											            "std" 	=> "",
														"required" => array('slideshow_image_type','{contains}small') ),
								            
									array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_sie_and_pos_end", "nodescription" => true),
							
							
							
							array(	"name" 	=> "Apply link?",
									"desc" 	=> "",
									"slug"  => "slideshow",
						            "id" 	=> "slideshow_link",
						            "type" 	=> "select",
						            "std" 	=> "self",
						            "subtype" => array('No link'=>'','Lightbox'=>'lightbox','Link to this Post'=>'self','Link to Page'=>'page','Link to Category'=>'cat','Link manually'=>'url'),
						           ),
						           
							array(	"name" 	=> "",
									"desc" 	=> "",
									"slug"  => "slideshow",
									"id"   	=> "slideshow_link_url",
									"std"  	=> "http://",
									"type" 	=> "text",
									"required" => array('slideshow_link','url') ),
									
							array(	"name" 	=> "",
									"desc" 	=> "",
									"slug"  => "slideshow",
						            "id" 	=> "slideshow_link_page",
						            "type" 	=> "select",
						            "subtype" => "page",
						            "required" => array('slideshow_link','page') ),
						            
						    array(	"name" 	=> "",
									"desc" 	=> "",
									"slug"  => "slideshow",
						            "id" 	=> "slideshow_link_cat",
						            "type" 	=> "select",
						            "subtype" => "cat",
						            "required" => array('slideshow_link','cat') ),
									
							array(	"name" 	=> "Slide Title",
									"slug"  => "slideshow",
									"desc" 	=> "Depending on your slide will be displayed as caption title or as title beside the image",
									"id" 	=> "slideshow_caption_title",
									"type" 	=> "text"),
									
							array(	"name" 	=> "Slide Text",
									"slug"  => "slideshow",
									"desc" 	=> "Depending on your slide will be displayed as caption text or as text beside the image",
						            "id" 	=> "slideshow_caption",
						            "type" 	=> "textarea" ),
						   								       
						           
						   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta1_end", "nodescription" => true, ),
							
						   array(	"slug"	=> "slideshow", "type" => "visual_group_start", "id" => "visual_group_meta3_start", "nodescription" => true, 'class'=>'avia_meta_block avia_wrap', "required" => array('_slideshow_type','{contains}3D') ),
						           
						   array(	"name" 	=> "Transition Type (a.k.a easing)",
									"desc" 	=> "",
									"slug"  => "slideshow",
						            "id" 	=> "easing",
						            "type" 	=> "select",
						            "std" 	=> "linear",
						            "subtype" => array('Linear'=>'linear', 'easeInSine'=>'easeInSine', 'easeOutSine'=>'easeOutSine', 'easeInOutSine'=>'easeInOutSine', 'easeInQuad'=>'easeInQuad', 'easeOutQuad'=>'easeOutQuad', 'easeInOutQuad'=>'easeInOutQuad', 'easeInQuart'=>'easeInQuart', 'easeOutQuart'=>'easeOutQuart', 'easeInOutQuart'=>'easeInOutQuart', 'easeInBack'=>'easeInBack', 'easeOutBack'=>'easeOutBack', 'easeInOutBack'=>'easeInOutBack', 'easeInBounce'=>'easeInBounce', 'easeOutBounce'=>'easeOutBounce', 'easeInOutBounce'=>'easeInOutBounce', 'easeInCirc'=>'easeInCirc', 'easeOutCirc'=>'easeOutCirc', 'easeInOutCirc'=>'easeInSine', 'easeInElastic'=>'easeInElastic', 'easeOutElastic'=>'easeOutElastic', 'easeInOutElastic'=>'easeInOutElastic' ) ),
 
									        
						    array(	
									"name" 	=> "Flip Depth",
									"desc" 	=> "",
									"id" 	=> "flip_depth",
									"type" 	=> "select",
									"std" 	=> "250",
									"slug"  => "slideshow",
									"subtype" => 
									array('none'=>'0','little'=>'100','normal'=>'250','deep'=>'500','deepest'=>'1000')),     
									
							 array(	
									"name" 	=> "Flip Sideward Movement",
									"desc" 	=> "",
									"id" 	=> "sideward",
									"type" 	=> "select",
									"std" 	=> "1",
									"slug"  => "slideshow",
									"subtype" => 
									array('none'=>'1','normal'=>'20','a lot'=>'40')),   
									
		
											            
							array(	
									"name" 	=> "vertical slicing",
									"desc" 	=> "",
									"id" 	=> "slice_vertical",
									"type" 	=> "select",
									"std" 	=> "3",
									"slug"  => "slideshow",
									"subtype" => 
									array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','15'=>'15','20'=>'20')),
									
				
					
									
						   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta2_end", "nodescription" => true),
						   
						   
				   array(	"slug"	=> "slideshow", "type" => "visual_group_end", "id" => "visual_group_meta_default_end", "nodescription" => true),
				   
				   )
				   
			)

);

