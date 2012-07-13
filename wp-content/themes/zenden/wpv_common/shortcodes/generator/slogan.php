<?php
return array(
	"name" => __("Slogan", 'wpv') ,
	"value" => "slogan",
	"options" => array(
		array(
			"name" => __("Text", 'wpv') ,
			"id" => "text",
			"default" => '',
			"type" => "textarea",
		) ,
		array(
			"name" => __("Button text", 'wpv') ,
			"id" => "button_text",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Button link", 'wpv') ,
			"id" => "link",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Use 'carved' button", 'wpv') ,
			"id" => "carved",
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("No padding", 'wpv') ,
			"id" => "nopadding",
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			'name' => __('Background', 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			'id' => 'background',
			'type' => 'color',
			'default' => '#ededed'
		) ,
		array(
			'name' => __('Text color', 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			'id' => 'text_color',
			'type' => 'color',
			'default' => '#333333'
		) ,
	) ,
);
