<?php

/**
 * displays some video
 * 
 * we support youtube, vimeo and dailymotion
 * you can also use mp4, webm, ogg or swf files
 */

function wpv_shortcode_video($atts){
	$tmp = new shortcode_video;
	return $tmp->get_html($atts);
}
add_shortcode('video', 'wpv_shortcode_video');

class shortcode_video {
	public function get_html($atts) {
		if(!isset($atts['type']))
			return '';
			
		$size = shortcode_atts(array(
			'width' => false,
			'height' => false
		), $atts);
		
		if($size['height'] && !$size['width']) 
			$size['width'] = intval($size['height'] * 16 / 9);
		if(!$size['height'] && $size['width']) 
			$size['height'] = intval($size['width'] * 9 / 16);
		
		return $this->$atts['type']($atts, $size); // use the correct parser for this type of video
	}
	
	private function html5($atts, $size){
		$atts = shortcode_atts(array(
			'mp4' => '',
			'webm' => '',
			'ogg' => '',
			'src' => '',
			'poster' => '',
			'preload' => false,
			'autoplay' => false,
		), $atts);
		extract($atts);
		extract($size);
		
		// if the correct file type is not specified - we will try to guess it
		if(preg_match('/\.mp4$/i', $src)) {
			$atts['mp4'] = $src;
		} elseif(preg_match('/\.webm$/i', $src)) {
			$atts['webm'] = $src;
		} elseif(preg_match('/\.og(g|v)/i', $src)) {
			$atts['ogg'] = $src;
		}
	
		$sources = array();
		$available_sources = array(
			'mp4',
			'webm',
			'ogg',
		);
		foreach($available_sources as $source) {
			$sources[$source.'_source'] = $atts[$source] ? '<source src="'.$atts[$source].'" type="video/'.$source.'">' : '';
			$sources[$source.'_link'] = $atts[$source] ? '<a href="'.$source.'">'.$source.'</a>' : '';
		}
		
		if($poster) {
			$poster_attribute = 'poster="'.$poster.'"';
			$image_fallback = wpv_get_lazy_load($poster, __('No video playback capabilities.', 'wpv'));
		}
	
		if($preload == "true") {
			$preload_attribute = 'preload="auto"';
			$flow_player_preload = ',"autoBuffering":true';
		} else {
			$preload_attribute = 'preload="none"';
			$flow_player_preload = ',"autoBuffering":false';
		}
	
		if($autoplay == "true") {
			$autoplay_attribute = "autoplay";
			$flow_player_autoplay = ',"autoPlay":true';
		} else {
			$autoplay_attribute = "";
			$flow_player_autoplay = ',"autoPlay":false';
		}
	
		$uri = WPV_URI;

		wp_enqueue_script('video-js');

		$output = <<<HTML
		<video id="my_video_1" class="video-js vjs-default-skin" {$poster_attribute} controls {$preload_attribute} width="{$width}" height="{$height}" {$autoplay_attribute} data-setup="{}">
  			{$sources['mp4_source']}
			{$sources['webm_source']}
			{$sources['ogg_source']}
		</video>
HTML;
	
		return '[raw]'.$output.'[/raw]';
	}

	private function flash($atts, $size) {
		extract(shortcode_atts(array(
			'src' 	=> '',
			'play'			=> 'false',
			'flashvars' => '',
		), $atts));
		extract($size);
	
		$uri = WPV_URI;
		if(!empty($src))
			return <<<HTML
	<div class="video_frame clearfix">
	<object width="{$width}" height="{$height}" type="application/x-shockwave-flash" data="{$src}">
		<param name="movie" value="{$src}" />
		<param name="allowFullScreen" value="true" />
		<param name="allowscriptaccess" value="always" />
		<param name="expressInstaller" value="{$uri}/swf/expressInstall.swf"/>
		<param name="play" value="{$play}"/>
		<param name="wmode" value="opaque" />
		<embed src="$src" type="application/x-shockwave-flash" wmode="opaque" allowscriptaccess="always" allowfullscreen="true" width="{$width}" height="{$height}" />
	</object>
	</div>
HTML;
	}

	private function vimeo($atts, $size) {
		extract(shortcode_atts(array(
			'clip_id' 	=> '',
			'src' => '',
			'title' => 'false',
		), $atts));
		extract($size);
	
		if($title!='false')
			$title = 1;
		else
			$title = 0;
		
		// if a full url is provided, get the clip_id
		if(empty($clip_id)) {
			preg_match('%vimeo\.com/(?:.*#|.*videos?/)?([0-9]+)%', $src, $matches);
			
			if(isset($matches[1])) {
				$clip_id = $matches[1];
			}
		}
	
		if(!empty($clip_id) && is_numeric($clip_id)) {
			return 
				"<div class='video_frame clearfix'>
					<iframe src='http://player.vimeo.com/video/$clip_id?title={$title}&amp;byline=0&amp;portrait=0' width='$width' height='$height' style='border:0'></iframe>
				</div>";
		}
	}
	
	private function youtube($atts, $size) {
		extract(shortcode_atts(array(
			'clip_id' 	=> '',
			'src' => '',
		), $atts));
		extract($size);
		
		// if a full url is provided, get the clip_id
		if(empty($clip_id)) {
			preg_match('%youtu(?:\.be|be\.com)/(?:.*v(?:/|=)|(?:.*/)?)([a-zA-Z0-9-_]+)%', $src, $matches);
			
			if(isset($matches[1])) {
				$clip_id = $matches[1];
			}
		}
		
		if(!empty($clip_id)) {
			return 
				"<div class='video_frame clearfix'>
					<iframe src='http://www.youtube.com/embed/{$clip_id}?wmode=opaque' width='$width' height='$height' style='border:0'></iframe>
				</div>";
		}
	}
	
	private function dailymotion($atts, $size) {
		extract(shortcode_atts(array(
			'clip_id' => '',
			'src' => '',
		), $atts));
		extract($size);
		
		// if a full url is provided, get the clip_id
		if(empty($clip_id)) {
			preg_match('%dailymotion\.com/video/([a-z\d]+)_%', $src, $matches);
			
			if(isset($matches[1])) {
				$clip_id = $matches[1];
			}
		}
	
		if(!empty($clip_id)) {
			return 
				"<div class='video_frame clearfix'>
					<iframe src='http://www.dailymotion.com/embed/video/$clip_id?width=$width&theme=none&foreground=%23F7FFFD&highlight=%23FFC300&background=%23171D1B&start=&animatedTitle=&iframe=1&additionalInfos=0&autoPlay=0&hideInfos=0&wmode=transparent' width='$width' height='$height' style='border:0'></iframe>
				</div>";
		}
	}
}
