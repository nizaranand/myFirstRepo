<?php

class avia_slideshow
{

	var $type; 				// 3d, 3d, fullsize, small tablet?
	var $slideshow_xml = "";// xml config file
	var $post_id;			// post id of the post containing the slider
	var $slidecount = 0;	//number of slides
	var $slide_duration = 0;    //how long to display a slide
	var $autoplay;    		//start autorotation?
	var $showcaption = true;		//show caption?
	var $slides_xml;
	var $transitions_xml;
	var $image_size_video;
	
	function avia_slideshow($post_id = false, $overwrite_small = false)
	{
		global $avia_config;
		///if no id was passed get it 
		if(!$post_id) $post_id = get_the_ID();
		
		
		$this->post_id = $post_id;
		$this->slides = avia_post_meta($this->post_id, 'slideshow');
		$this->slidecount = count($this->slides);
		
		if(empty($this->slides[0]['slideshow_image'])) return;
		
		$this->type = avia_post_meta($this->post_id, '_slideshow_type');
		if($overwrite_small && $this->type == '2D_small') $this->type = $overwrite_small;
		
		$this->autoplay = avia_post_meta($this->post_id, '_slideshow_autoplay');
		
		if($this->autoplay == "true") $this->slide_duration = avia_post_meta($this->post_id, '_slideshow_duration');

	}
	
	/*
	* Display the small slideshow within the content area
	*/
	function display_small($size = 'page', $force_display = false, $showcaption = true)
	{

		if(($force_display || $this->type == '2D_small'|| $this->type == '' ) && is_array($this->slides) && !empty($this->slides[0]['slideshow_image']))
		{
			$this->type = '2D_small';
			$this->imagesize = $size;
			$this->image_size_video = $size;
			$this->showcaption = $showcaption;
			
			return $this->slideshow();
		}
	}


	
	function description($slide)
	{
		$output = "";
		$buttonclass = 'dual_buttons';
		extract($slide);
		
		$button_url = avia_get_link($slide, 'slideshow_', false, $this->post_id);
		
		$output .= "<div class='slideshow_welcome slideshow_welcome_".$this->type."'>";
		$output .= "	<div class='slideshow_welcome_align'>";
		if($slideshow_caption_title) $output .= "		<h1 class='extra_movement slideshow_welcome_title'>".$slideshow_caption_title."</h1>";
		if($slideshow_caption) 		 $output .= "		<div class='extra_movement slideshow_welcome_text'>".  wpautop( avia_remove_autop( nl2br( $slideshow_caption )))."</div>";
		if($slideshow_button && $button_url) $output .= "	    <span class='extra_movement style_wrap'><a class='big_button big_button_grey noLightboxGroup' href='".$button_url."'>".$slideshow_button."</a></span>";
		$output .= "	</div>";
		$output .= "</div>";
		return $output;
	}
	
		
	function display()
	{
		
		if(!$this->type  || $this->type == '2D_small') return;
		//if(!is_singular() && !(is_front_page() && avia_post_meta('dynamic_templates'))) return;
		
		$output = '';
		
		//add the piecemaker javascript
		if(strpos($this->type, '3D') !== false)
		{
			$output = $this->activate_piecemaker();
		}
		
		
		//add the slide container
		$output .= "<div class='slideshow_container_featured slideshow_container".$this->type."'>";
				
		//add javascript slider eiter because the user chose it and also as fallback if the user doesnt have flash
		
		$output .= $this->slideshow();
		$output .= "</div>";
		
		return $output;
	}
	

	function slideshow()
	{
		$counter = 1;
		$js_controller  = 'autoslide_'.$this->autoplay;
		$js_controller .= ' autoslidedelay__'.$this->slide_duration;
		$description = false;
		$extraid = "";
		$type = 'transition_slide';
		if($this->type == '2D_small') $type = 'transition_fade';
		if($this->type == '3D') $extraid = "id='slideshow_".$this->type."'";
		
		$output  = "<div class='preloading slideshow_container $js_controller $type' $extraid >";
		$output .= "<ul class='slideshow'>";
		
		if(is_array($this->slides) && !empty($this->slides[0]['slideshow_image']))
		{
			foreach($this->slides as $slide)
			{	
				$multipleImages = "";
				$image_size_video = $this->image_size_video;
				if($this->type == '2D_small')
				{
					$image_size = $this->imagesize;
					if(empty($image_size)) $image_size = "page";
				}
				else
				{
					if(empty($slide['slideshow_image_type'])) $slide['slideshow_image_type'] = "";
					$image_size = $image_size_video = 'featured';
					switch($slide['slideshow_image_type'])
					{
						case 'small_left': 
						case 'small_right': 
							$image_size = 'portrait';
							$image_size_video = 'portfolio2';
							$this->showcaption = false;
							$description = true;
							$multipleImages = 'multi_images';
						break;
						
						case 'fullsize':
						default:
							$this->showcaption = true;
							$description = false;
						break;
	
					}
				}
			
				if($slide['slideshow_image'] != "")
				{	
					if(!is_numeric($slide['slideshow_image'])) $type = 'video_slide';
					if(empty($slide['slideshow_image_type'])) $slide['slideshow_image_type'] = "";
					
					//check if we got an image or a video
					$output .= "<li class='$type ".$slide['slideshow_image_type']." featured featured_container".$counter++."' >";
					
					global $avia_config, $wp_embed;
					
					if(!is_numeric($slide['slideshow_image']))
					{
						### render a  video ###
						$width = $widthstyle =  "";
						if(isset($avia_config['imgSize'][$image_size_video]['width'])) 
						{
							$width  = "width='".$avia_config['imgSize'][$image_size_video]['width']."'";
							$widthstyle = "style ='width: ".$avia_config['imgSize'][$image_size_video]['width']."px;' ";
						}
						
						
						if(avia_backend_is_file($slide['slideshow_image'], 'html5video'))
						{
							$output .= '<div '.$widthstyle.'class="video_container html5container extra_movement video_container'.$slide['slideshow_image_type'].'"><div '.$widthstyle.'class="featured_shadow">';
							$output .= avia_html5_video_embed($slide['slideshow_image']);
							$output .= '</div></div>';
						}
						else
						{
							$output .= '<div class="video_container oembed_container extra_movement"><div class="featured_shadow">';
							$output .= $wp_embed->run_shortcode("[embed $width ]".$slide['slideshow_image']."[/embed]");
							$output .= '</div></div>';
						}
						
					}
					else
					{
						### render an image ###
				
						//get the image by passing the attachment id.
						$image_string = avia_image_by_id($slide['slideshow_image'], $image_size);
						
						//if we didnt get a valid image from the above function set it directly
						if(!$image_string) $image_string = $slide['slideshow_image'];
						
						//apply links to the image if thats what the user wanted
						$image = avia_get_link($slide, 'slideshow_', $image_string, $this->post_id);
						$image = '<div class="featured_shadow">'.$image.'</div>';
						
						
						$output .= "<div class='image_container $multipleImages'> ";
						if($multipleImages)
						{
							$image2  = '<div class="featured_shadow">'.$image_string.'</div>';
							$output .= "<div class='featured_image2 featured_image_portrait extra_movement'><div class='featured_image2_darken'></div>".$image2."</div>";
						}
						
						$output .= "<div class='featured_image1 featured_image_portrait extra_movement'>".$image."</div>";
						$output .= "</div>";
						//check if the user has set either a title or a caption that we can display
						if($this->showcaption)
						{
							if((!empty($slide['slideshow_caption_title']) || !empty($slide['slideshow_caption']) || (!empty($slideshow_options_show_controlls) && !empty($slides[1]['slideshow_image']))))
							{
								$output .= '<div class="feature_excerpt">';
								if(!empty($slide['slideshow_caption_title'])) 	$output .= '<h1>'.$slide['slideshow_caption_title'].'</h1>';
								if(!empty($slide['slideshow_caption'])) 		$output .= '<div class="featured_caption">'.$slide['slideshow_caption'].'</div>';
								$output .= '</div>';
							}
						}
						
					}
					if($description) $output .= $this->description($slide);
					$output .= "</li>";
					
				}
			}
		}
		$output .= "</ul>";
		$output .= '</div>';
		
		
		
		return $output;
	}
	

	
	
	
	
	
######################################################################
# XML & piecemaker related functions
######################################################################

	function generate_xml()
	{
		if(strpos($this->type, '3D') !== false)
		{
			foreach($this->slides as $slide_element)
			{
				$this->_build_xml_slides($slide_element);
				$this->_build_xml_transition($slide_element);
			}
			
			$this->_build_xml_file();
		}		
	}
	
	

	function activate_piecemaker()
	{
		global $avia_config;
	
		$output  = "";
		$output .= '<script type="text/javascript" src="'.AVIA_BASE_URL.'slideshow/scripts/swfobject/swfobject.js"></script>'."\n";
		$output .= '
					<script type="text/javascript">
					
				      var flashvars = {};
				      flashvars.cssSource = "'.AVIA_BASE_URL.'slideshow/piecemaker.css";
				      flashvars.xmlSource = "'.AVIA_BASE_URL.'slideshow/piecemaker.xml.php?post_id='.$this->post_id.'";
						
				      var params = {};
				      params.play = "true";
				      params.menu = "false";
				      params.scale = "showall";
				      params.wmode = "transparent";
				      params.allowfullscreen = "true";
				      params.allowscriptaccess = "always";
				      params.allownetworking = "all";
					  
				      swfobject.embedSWF("'.AVIA_BASE_URL.'slideshow/piecemaker.swf", "slideshow_3D", "'.($avia_config['imgSize']['featured']['width']+12).'", "'.($avia_config['imgSize']['featured']['height']+70).'", "10", null, flashvars,    
				      params, null);
				    
				    </script>';
					
		return $output;
		
	}
	
	
	
	function _build_xml_slides($element)
	{
		global $avia_config;
		$text = $url = $title = "";
		
		if(!empty($element['slideshow_caption'])) 
		{
			if(!empty($element['slideshow_caption_title'])) $title = '&lt;h1&gt;'.$element['slideshow_caption_title'].'&lt;/p&gt;';
			$text = "<Text>".$title."&lt;p&gt;".strip_tags($element['slideshow_caption'])."&lt;/p&gt;</Text>";
		}
	
	
		if(is_numeric($element['slideshow_image']))
		{
		
			$this->slides_xml .= '<Image Source="'.avia_image_by_id($element['slideshow_image'], 'featured', 'url').'" Title="'.$element['slideshow_caption_title'].'">';
			$this->slides_xml .= $text.$url;
			$this->slides_xml .= '</Image>';
		}
		else
		{
			if(avia_backend_is_file($element['slideshow_image'], 'html5video') || avia_backend_is_file($element['slideshow_image'], array('swf')))
			{
				preg_match("!^(.+?)(?:\.([^.]+))?$!", $element['slideshow_image'], $path_split);
				
				$tag = 'Video';
				if($path_split[2] == 'swf') $tag = 'Flash';
				
				
				$this->slides_xml .= '<'.$tag.' Source="'.$element['slideshow_image'].'" Title="'.$element['slideshow_caption_title'].'" Width="'.$avia_config['imgSize']['featured']['width'].'" Height="'.$avia_config['imgSize']['featured']['height'].'" Autoplay="true" >';
				
				$image = $path_split[1].'.jpg';
				$checkpath = $path_split[1].'-'.$avia_config['imgSize']['featured']['width'].'x'.$avia_config['imgSize']['featured']['height'].'.jpg';
				if(@file_get_contents($checkpath,0,NULL,0,1))
				{
					$image = $checkpath;
				}
				
				$this->slides_xml .= '<Image Source="'.$image.'" />';
				$this->slides_xml .= '</'.$tag.'>';
			}
		}
	}
	
	
	
	
	function _build_xml_transition($element)
	{
	
		$this->transitions_xml .= '<Transition ';
		if(empty($element['slice_vertical'])) 	$element['slice_vertical']	= '3';
		if(empty($element['sideward'])) 		$element['sideward']		= '20';
		if(empty($element['flip_depth'])) 		$element['flip_depth']		= '250';
		if(empty($element['easing'])) 			$element['easing']			= '';

		$this->transitions_xml .= 'Pieces="'.$element['slice_vertical'].'" ';
		$this->transitions_xml .= 'DepthOffset="'.$element['flip_depth'].'" ';
		$this->transitions_xml .= 'CubeDistance="'.$element['sideward'].'" ';
		$this->transitions_xml .= 'Transition="'.$element['easing'].'" ';
		$this->transitions_xml .= 'Delay="0.1" Time="0.7" />';
	}
	
	
	
	
	
	function _build_xml_file()
	{
		global $avia_config;
		$color_1 = substr(avia_get_option('color_1','#555555'),1);
		$color_3 = substr(avia_get_option('color_3','#ffffff'),1);
				
		//gerneric mask with defaults. the slider specific vars are filled in here
		$this->slideshow_xml .= '<?xml version="1.0" encoding="utf-8"?>
								<Piecemaker>
								  <Contents>'.$this->slides_xml.'</Contents>
								  <Settings ImageWidth="'.$avia_config['imgSize']['featured']['width'].'" ImageHeight="'.$avia_config['imgSize']['featured']['height'].'" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.3" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="30" MenuColor1="0x'.$color_1.'" MenuColor2="0x999999" MenuColor3="0x'.$color_3.'" ControlSize="100" ControlDistance="20" ControlColor1="0x'.$color_1.'" ControlColor2="0x'.$color_3.'" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="450" ControlsY="280&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x'.$color_1.'" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0x'.$color_3.'" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0x333333" InfoBackgroundAlpha="0.95" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="'.$this->slide_duration.'" FieldOfView="45"></Settings>
								  <Transitions>'.$this->transitions_xml.'</Transitions>
								</Piecemaker>';	
				}
	
	
	
	
	
}