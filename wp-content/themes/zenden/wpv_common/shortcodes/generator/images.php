<?php
return array(
	"name" => __("Images", 'wpv') ,
	"value" => "images",
	"options" => array(
		array(
			"name" => __("Image Source Url", 'wpv') ,
			"desc" => __("Please use one of: jpg, png, bmp, gif", 'wpv') ,
			"id" => "src",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		) ,
		array(
			"name" => __("Image Title (optional)", 'wpv') ,
			"id" => "title",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Align (optional)", 'wpv') ,
			"id" => "align",
			"default" => '',
			"prompt" => __("Choose one..", 'wpv') ,
			"options" => array(
				"left" => __('Left', 'wpv') ,
				"right" => __('Right', 'wpv') ,
				"center" => __('Center', 'wpv') ,
			) ,
			"type" => "select",
		) ,
		array(
			"name" => __("Lightbox", 'wpv') ,
			"id" => "lightbox",
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Lightbox group (optional)", 'wpv') ,
			"id" => "group",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Width (optional)", 'wpv') ,
			"id" => "width",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		) ,
		array(
			"name" => __("Height (optional)", 'wpv') ,
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		) ,
		array(
			"name" => __("Auto adjust Height", 'wpv') ,
			"id" => "autoHeight",
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Link (optional)", 'wpv') ,
			"size" => 30,
			"id" => "link",
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Link class (optional)", 'wpv') ,
			"size" => 30,
			"id" => "link_class",
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Quality (optional)", 'wpv') ,
			"id" => "quality",
			"default" => 75,
			"min" => 75,
			"max" => 100,
			"step" => "1",
			"type" => "range"
		) ,
		array(
			'name' => __('Frame', 'wpv') ,
			'id' => 'frame',
			'default' => false,
			'type' => 'toggle',
		) ,
		array(
			'name' => __('Underline', 'wpv') ,
			'id' => 'underline',
			'default' => true,
			'type' => 'toggle',
		) ,
	) ,
);
