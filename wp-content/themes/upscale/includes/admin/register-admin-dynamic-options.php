<?php


$elements[] =	array(	
				"dynamic"		=> 'blog',
				"name" 			=> "Blog",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_blog", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						
						array(	"name" 	=> "<strong>A Blog with sidebar will be added to the page. Bellow you can choose some blog settings:</strong><br/><br/>Which categories should be used for the blog?",
								"desc" 	=> "You can select multiple categories here. If left empty all categories will be displayed",
					            "id" 	=> "dynamic_blog_cats",
					            "type" 	=> "select",
								"slug"	=> "",
	            				"multiple"=>6,
					            "subtype" => "cat"),
					            
						array(	"name" 	=> "Show Pagination?",
								"desc" 	=> "Should the title of the entry be displayed as well?",
					            "id" 	=> "dynamic_blog_pagination",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "yes",
								"no_first"=>true,
					            "subtype" => array('yes'=>'yes','no'=>'no')),
					   
					   array(	"name" 	=> "Posts per page?",
								"desc" 	=> "How many posts should be displayed?",
					            "id" 	=> "dynamic_blog_posts_per_page",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "3",
								"no_first"=>true,
					            "subtype" => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','All'=>"-1")),       
					            
									
				)
			);


	$column_element = array();
	$columns = 5;
							
	for ($i = 1; $i <= $columns; $i++)
	{
		$requirement = $i;
		if($requirement < 2) $requirement = 2;
	
	//start column	
	$column_element[] = array(	"slug"	=> "", "type" => "visual_group_start", "id" => "vg".$i, "nodescription" => true, 'class'=>'avia_pseudo_sortable', "required" => array('dynamic_column_count','{higher_than}'.$requirement) );
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Column ".$i." Content:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i,
		"type" 	=> "select",
		"std" 	=> "page",
		"subtype" => array('Single Page'=>'page','Post from Category'=>'cat','Widget'=>'widget','Direct Text input'=>'textarea')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Page:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_page",
		"type" 	=> "select",
		"std" 	=> "",
		"required" => array('dynamic_column_content_'.$i,'page'),
		"subtype" => 'page'
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "How do you want to display the page?",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_page_display",
		"type" 	=> "select",
		"std" 	=> "img_post",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'page'),
		"subtype" => array('Preview Image and post content' => 'img_post', 'Only preview Image' => 'img', 'Only post Content' => 'post')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Post from Category:",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_cat",
		"type" 	=> "select",
		"std" 	=> "",
		"required" => array('dynamic_column_content_'.$i,'cat'),
		"subtype" => 'cat'
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "How do you want to display the post?",
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_cat_display",
		"type" 	=> "select",
		"std" 	=> "img_post",
		"no_first"=>true,
		"required" => array('dynamic_column_content_'.$i,'cat'),
		"subtype" => array('Preview Image and post content' => 'img_post', 'Only preview Image' => 'img', 'Only post Content' => 'post')
	);
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Enter a widget area name (no special characters) - Once you have saved this template head over to <a href='widgets.php'>Appearance &raquo; Widgets</a> and add some widgets to the Widget area.",
		"class" => 'avia_dynamic_template_widget',
		"desc" 	=> "",
		"id" 	=> "dynamic_column_content_".$i."_widget",
		"type" => "text",
		"required" => array('dynamic_column_content_'.$i,'widget')
		);
	
	
	$column_element[] = array(	
		"slug"	=> "",
		"name" 	=> "Enter text here:",
		"desc" 	=> "Your message to the world :)<br/>(Wordpress shortcodes and HTML allowed)",
		"id" 	=> "dynamic_column_content_".$i."_textarea",
		"required" => array('dynamic_column_content_'.$i,'textarea'),
		"type" 	=> "textarea");
		
	$column_element[] = array(	"slug"	=> "", "type" => "visual_group_end", "id" => "vg".$i."_end", "nodescription" => true );
	// end column
	
	}
	
	

	

$elements[] =	array(	
				"dynamic"		=> 'columns',
				"name" 			=> "Columns",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_columns", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  	=> 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	
								"slug"	=> "",
								"name" 	=> "Select how many columns you want to display, then choose the column width and content:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_count",
								"type" 	=> "select",
								"no_first"=>true,
								"std" 	=> "2",
								"subtype" => array('2 Columns'=>'2','3 Columns'=>'3','4 Columns'=>'4','5 Columns'=>'5')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Display column content framed or without borders?",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_boxed",
								"type" 	=> "select",
								"no_first"=>true,
								"std" 	=> "",
								"subtype" => array('Without borders'=>'','Framed'=>'boxed')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_2",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','2'),
								"no_first"=>true,
								"std" 	=> "2-2",
								"subtype" => array('50%:50%'=>'1-1', '25%:75%'=>'1-3', '75%:25%'=>'3-1', '33%:66%'=>'1-2', '66%:33%'=>'2-1', '20%:80%'=>'1-4', '80%:20%'=>'4-1')),	
								
						
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_3",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','3'),
								"no_first"=>true,
								"std" 	=> "1-1-1",
								"subtype" => array('33%:33%:33%'=>'1-1-1', '25%:25%:50%'=>'1-1-2', '25%:50%:25%'=>'1-2-1', '25%:25%:50%'=>'1-1-2', '20%:20%:60%'=>'1-1-3', '20%:60%:20%'=>'1-3-1', '60%:20%:20%'=>'3-1-1')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_4",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','4'),
								"no_first"=>true,
								"std" 	=> "1-1-1-1",
								"subtype" => array('25%:25%:25%:25%'=>'1-1-1-1','20%:20%:20%:40%'=>'1-1-1-2','20%:20%:40%:20%'=>'1-1-2-1','20%:40%:20%:20%'=>'1-2-1-1','40%:20%:20%:20%'=>'2-1-1-1')),	
								
						array(	
								"slug"	=> "",
								"name" 	=> "Choose the column width:",
								"desc" 	=> "",
								"id" 	=> "dynamic_column_width_5",
								"type" 	=> "select",
								"required" => array('dynamic_column_count','5'),
								"no_first"=>true,
								"std" 	=> "1-1-1-1-1",
								"subtype" => array('20%:20%:20%:20%:20%'=>'1-1-1-1-1')),		
								
						$column_element[0],
						$column_element[1],
						$column_element[2],
						$column_element[3],
						$column_element[4],
						$column_element[5],
						$column_element[6],
						$column_element[7],
						$column_element[8],
						$column_element[9],
						$column_element[10],
						$column_element[11],
						$column_element[12],
						$column_element[13],
						$column_element[14],
						$column_element[15],
						$column_element[16],
						$column_element[17],
						$column_element[18],
						$column_element[19],
						$column_element[20],
						$column_element[21],
						$column_element[22],
						$column_element[23],
						$column_element[24],
						$column_element[25],
						$column_element[26],
						$column_element[27],
						$column_element[28],
						$column_element[29],
						$column_element[30],
						$column_element[31],
						$column_element[32],
						$column_element[33],
						$column_element[34],
						$column_element[35],
						$column_element[36],
						$column_element[37],
						$column_element[38],
						$column_element[39],
						$column_element[40],
						$column_element[41],
						$column_element[42],
						$column_element[43],
						$column_element[44]
							
							
			
				)
			);


$elements[] = 	array(	
				"dynamic"=> 'hr',
				"name" 	=> "Horizontal Ruler",
				"desc" 	=> "Adds a horizontal ruler to the template. You can either choose the default styling, the default styling with less padding at the top and bottom, a ruler with 'top' link or an invisible ruler that just adds whitespace",
				"id" 	=> "dynamic_hr",
				"type" 	=> "select",
				"std" 	=> "default",
				"no_first"=>true,
				"subtype" => array('Default Ruler'=>'default', 'Ruler with Top link'=>'top','Whitespace'=>'whitespace'),
				"slug"  => '',
				"removable"  => 'remove element'
				);

	
$elements[] = 	array(	
				"dynamic"=> 'slideshow',
				"name" 	=> "Slideshow",
				"desc" 	=> "The slideshow settings of the post or page that are used to display this template will be applied with all its options. You can modify the slideshow for each post/page when editing that post",
				"id" 	=> "dynamic_slideshow",
				"type" 	=> "heading",
				"nodescription"=>true,
				"slug"  => '',
				"removable"  => 'remove element',
				"label"	=> "Use Image as logo");
				

$elements[] =	array(	
				"dynamic"		=> 'textarea',
				"name" 			=> "Text Area",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_text_area", 
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Text Styling",
								"desc" 	=> "Chosose which text styling should be applied. You can either add a default paragraph or callout style",
					            "id" 	=> "dynamic_text_styling",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "p",
								"no_first"=>true,
					            "subtype" => array('Paragraph Style'=>'p','Blockquote Style'=>'blockquote')),
					    
					    array(	"slug"	=> "", "type" => "visual_group_start", "id" => "visual_group_dyn_callout", "nodescription" => true, "required" => array('dynamic_text_styling','blockquote') ),
        
					    array(	
								"slug"	=> "",
								"name" 	=> "Callout Button Label",
								"desc" 	=> "Add the label text of the call to action button. If left empty no button will be displayed",
								"id" 	=> "dynamic_text_button",
								"type" => "text"
								),
								
						array(	"name" 	=> "Callout Button link",
								"desc" 	=> "",
								"slug"  => "",
					            "id" 	=> "dynamic_text_button_link",
					            "type" 	=> "select",
					            "std" 	=> "",
					            "subtype" => array('Link manually'=>'url','Link to Page'=>'page','Link to Category'=>'cat'),
					            ),
					   
								array(	"name" 	=> "",
										"desc" 	=> "",
										"slug"  => "",
										"id"   	=> "dynamic_text_button_link_url",
										"std"  	=> "http://",
										"type" 	=> "text",
										"required" => array('dynamic_text_button_link','url') ),
										
								array(	"name" 	=> "",
										"desc" 	=> "",
										"slug"  => "",
								        "id" 	=> "dynamic_text_button_link_page",
								        "type" 	=> "select",
								        "subtype" => "page",
								        "required" => array('dynamic_text_button_link','page') ),
								        
								array(	"name" 	=> "",
										"desc" 	=> "",
										"slug"  => "",
								        "id" 	=> "dynamic_text_button_link_cat",
								        "type" 	=> "select",
								        "subtype" => "cat",
								        "required" => array('dynamic_text_button_link','cat') ),
					            
					    array(	
								"slug"	=> "",
								"name" 	=> "Callout title",
								"desc" 	=> "The title of your message",
								"id" 	=> "dynamic_text_title",
								"type" => "text"
								),
						
						array(	"slug"	=> "", "type" => "visual_group_end", "id" => "visual_group_dyn_callout_end", "nodescription" => true),
					            
						array(	
								"slug"	=> "",
								"name" 	=> "The text message that should be displayed",
								"desc" 	=> "Your message to the world :)<br/>(Wordpress shortcodes and HTML allowed)",
								"id" 	=> "dynamic_text",
								"type" 	=> "textarea"),
		
				)
			);
			
				
$elements[] =	array(	
				"dynamic"		=> 'post_page',
				"name" 			=> "Post/Page Content",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_post_page", 
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Which Content?",
								"desc" 	=> "Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.",
					            "id" 	=> "dynamic_which_post_page",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "self",
								"no_first"=>true,
					            "subtype" => array('Display the content of this post/page'=>'self','Choose a post'=>'post','Choose a Page'=>'page')),
					    
					   	array(	
								"slug"	=> "",
								"name" 	=> "Select Page",
								"desc" 	=> "",
								"id" 	=> "dynamic_page_id",
								"type" 	=> "select",
								"subtype" => 'page',
								"required" => array('dynamic_which_post_page','page')
							),
							
						
						 array(	
								"slug"	=> "",
								"name" 	=> "Select Post",
								"desc" 	=> "",
								"id" 	=> "dynamic_post_id",
								"type" 	=> "select",
								"subtype" => 'post',
								"required" => array('dynamic_which_post_page','post')
							),
							
						array(	"name" 	=> "Display Title?",
								"desc" 	=> "Should the title of the entry be displayed as well?",
					            "id" 	=> "dynamic_which_post_page_title",
					            "type" 	=> "select",
								"slug"	=> "",
								"std"	=> "yes",
								"no_first"=>true,
					            "subtype" => array('yes'=>'yes','no'=>'no')),
					            

				)
			);
			
$itemcount = array('All'=>'-1');
for($i = 1; $i<101; $i++) $itemcount[$i] = $i;				

$elements[] =	array(	
				"dynamic"		=> 'portfolio',
				"name" 			=> "Portfolio",
				"slug"			=> "",
				"type" 			=> "group", 
				"id" 			=> "dynamic_portfolio", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"removable"  => 'remove element',
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Which categories should be used for the portfolio?",
								"desc" 	=> "You can select multiple categories here. The Portfolio Page that you choose below will then show all posts from those categories, along with a sort option for each category.",
					            "id" 	=> "portfolio_cats_dynamic",
					            "type" 	=> "select",
								"slug"	=> "",
	            				"multiple"=>6,
	            				"taxonomy" => "portfolio_entries",
					            "subtype" => "cat"),
					            
						array(	
								"slug"	=> "",
								"name" 	=> "Portfolio Columns",
								"desc" 	=> "How many columns should be displayed?",
								"id" 	=> "portfolio_columns",
								"type" 	=> "select",
								"std" 	=> "4",
								"no_first"=>true,
								"subtype" => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4')),
						
						array(	
								"slug"	=> "",
								"name" 	=> "Portfolio Style",
								"desc" 	=> "How should the entries be displayed?",
								"id" 	=> "portfolio_style",
								"type" 	=> "select",
								"std" 	=> "portfolio_entries_boxed",
								"subtype" => array('Boxed'=>'portfolio_entries_boxed','Open'=>'portfolio_entries_open')),
								
						array(	
								"slug"	=> "",
								"name" 	=> "Portfolio Post Number",
								"desc" 	=> "How many items should be displayed?",
								"id" 	=> "portfolio_item_count",
								"type" 	=> "select",
								"std" 	=> "16",
								"no_first"=>true,
								"subtype" => $itemcount),
								
												
						array(	
								"slug"	=> "",
								"name" 	=> "Portfolio Excerpt",
								"desc" 	=> "Should a small text excerpt of the portfolio entry be displayed?",
								"id" 	=> "portfolio_text",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"subtype" => array('yes'=>'yes','no'=>'no')),	
								
						array(	
								"slug"	=> "",
								"name" 	=> "Portfolio Pagination",
								"desc" 	=> "Should a portfolio pagination be displayed?",
								"id" 	=> "portfolio_pagination",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"subtype" => array('yes'=>'yes','no'=>'no'))
	
				)
			);