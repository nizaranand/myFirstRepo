<?php
return array(
	"name" => __("Google Map", 'wpv') ,
	"value" => "gmap",
	"options" => array(
		array(
			"name" => __("Width (optional)", 'wpv') ,
			"desc" => __("set to 0 is the full width", 'wpv') ,
			"id" => "width",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		) ,
		array(
			"name" => __("Height", 'wpv') ,
			"id" => "height",
			"default" => '400',
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		) ,
		array(
			"name" => __("Address (optional)", 'wpv') ,
			"id" => "address",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Latitude", 'wpv') ,
			"id" => "latitude",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("longitude", 'wpv') ,
			"id" => "longitude",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Zoom", 'wpv') ,
			"id" => "zoom",
			"default" => '14',
			"min" => 1,
			"max" => 19,
			"step" => "1",
			"type" => "range"
		) ,
		array(
			"name" => __("Marker", 'wpv') ,
			"id" => "marker",
			"default" => true,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Html", 'wpv') ,
			"id" => "html",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Popup Marker", 'wpv') ,
			"id" => "popup",
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Controls (optional)", 'wpv') ,
			"id" => "controls",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Scrollwheel", 'wpv') ,
			"id" => "scrollwheel",
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Maptype (optional)", 'wpv') ,
			"id" => "maptype",
			"default" => 'G_NORMAL_MAP',
			"prompt" => __("Choose one..", 'wpv') ,
			"options" => array(
				"G_NORMAL_MAP" => __('Default road map', 'wpv') ,
				"G_SATELLITE_MAP" => __('Google Earth satellite', 'wpv') ,
				"G_HYBRID_MAP" => __('Mixture of normal and satellite', 'wpv') ,
				"G_DEFAULT_MAP_TYPES" => __('Mixture of above three maps', 'wpv') ,
				"G_PHYSICAL_MAP" => __('Physical map', 'wpv') ,
			) ,
			"type" => "select",
		) ,
	) ,
);
