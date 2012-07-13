<?php
return array(
	"name" => __("Buttons", 'wpv') ,
	"value" => "buttons",
	"options" => array(
		array(
			"name" => __("Text", 'wpv') ,
			"id" => "text",
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Id (optional)", 'wpv') ,
			"id" => "id",
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Class (optional)", 'wpv') ,
			"id" => "class",
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Size", 'wpv') ,
			"id" => "size",
			"default" => 'medium',
			"options" => array(
				"small" => __("Small", 'wpv') ,
				"medium" => __("Medium", 'wpv') ,
				"large" => __("Large", 'wpv') ,
			) ,
			"type" => "select",
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
			"name" => __("Link (optional)", 'wpv') ,
			"id" => "link",
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Link Target (optional)", 'wpv') ,
			"id" => "linkTarget",
			"default" => '',
			"prompt" => __("Choose one..", 'wpv') ,
			"options" => array(
				"_blank" => __('Load in a new window', 'wpv') ,
				"_self" => __('Load in the same frame as it was clicked', 'wpv') ,
				"_parent" => __('Load in the parent frameset', 'wpv') ,
				"_top" => __('Load in the full body of the window', 'wpv') ,
			) ,
			"type" => "select",
		) ,
		array(
			"name" => __("Text color (optional)", 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			"id" => "color",
			"default" => wpv_get_option('css_button_color'),
			"type" => "color",
		) ,
		array(
			"name" => __("Background Color (optional)", 'wpv') ,
			"id" => "bgColor",
			"default" => "dark",
			"options" => array(
				'dark' => __('Dark', 'wpv'),
				'light' => __('Light', 'wpv'),
				'red' => __('Red', 'wpv'),
				'green' => __('Green', 'wpv'),
				'blue' => __('Blue', 'wpv'),
			),
			"type" => "select"
		) ,
	) ,
);
