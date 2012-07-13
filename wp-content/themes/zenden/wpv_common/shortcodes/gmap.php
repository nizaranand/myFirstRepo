<?php

/**
 * displays a google map
 */

function theme_shortcode_googlemap($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		"width" => false,
		"height" => '400',
		"address" => '',
		"latitude" => 0,
		"longitude" => 0,
		"zoom" => 1,
		"html" => '',
		"popup" => 'false',
		"controls" => '[]',
		"scrollwheel" => 'true',
		"maptype" => 'G_NORMAL_MAP',
		"marker" => 'true',
		'align' => false,
	), $atts));
	
	$width = ($width && is_numeric($width)) ? 'width:'.$width.'px;' : '';
	$height = ($height && is_numeric($height)) ? 'height:'.$height.'px;' : '';
	$align = $align ? ' align'.$align : '';
	$id = rand(100,1000);
	$inline_html = $html;
	
	if(empty($controls)) {
		$controls = '[]';
	}
	
	if(empty($latitude)) {
		$latitude = 0;
	}
	
	if(empty($longitude)) {
		$longitude = 0;
	}
	
	$html = <<<HTML
[raw]
<div class="frame"><div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	jQuery("#google_map_{$id}").gMap({
	    zoom: {$zoom},
HTML;
	
	if($marker != 'false')
		$html .= <<<HTML
	    markers:[{
	    	address: "{$address}",
			latitude: {$latitude},
	    	longitude: {$longitude},
	    	html: "{$inline_html}",
	    	popup: {$popup}
		}],
		
HTML;

	else
			 
		$html .= <<<HTML
	    latitude: {$latitude},
	    longitude: {$longitude},
	    address: "{$address}",
HTML;
	
	$html .= <<<HTML
		controls: {$controls},
		maptype: {$maptype},
	    scrollwheel:{$scrollwheel}
	});
});
</script>
[/raw]
HTML;

	return $html;
}

add_shortcode('gmap', 'theme_shortcode_googlemap');