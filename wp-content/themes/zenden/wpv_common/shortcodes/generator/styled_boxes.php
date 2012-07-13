<?php
return array(
	"name" => __("Styled Boxes", 'wpv') ,
	"value" => "styled_boxes",
	"sub" => true,
	"options" => array(
		array(
			"name" => __("Framed Box", 'wpv') ,
			"value" => "framed_box",
			"options" => array(
				array(
					"name" => __("Content", 'wpv') ,
					"id" => "content",
					"default" => "",
					"type" => "textarea"
				) ,
				array(
					"name" => __("Width (optional)", 'wpv') ,
					"id" => "width",
					"default" => '0',
					"min" => 0,
					"max" => 960,
					"step" => "1",
					"type" => "range"
				) ,
				array(
					"name" => __("Height (optional)", 'wpv') ,
					"id" => "height",
					"default" => '0',
					"min" => 0,
					"max" => 960,
					"step" => "1",
					"type" => "range"
				) ,
				array(
					"name" => __("Background Color (optional)", 'wpv') ,
					"id" => "bgColor",
					"default" => "",
					"type" => "color"
				) ,
				array(
					"name" => __("Text Color (optional)", 'wpv') ,
					"id" => "textColor",
					"default" => "",
					"type" => "color"
				) ,
				array(
					"name" => __("Rounded", 'wpv') ,
					"id" => "rounded",
					"default" => false,
					"type" => "toggle"
				) ,
			)
		) ,
		array(
			"name" => __("Message Boxes", 'wpv') ,
			"value" => "messageboxes",
			"options" => array(
				array(
					"name" => __("Type", 'wpv') ,
					"id" => "type",
					"default" => 'info',
					"options" => array(
						"info" => __("Info", 'wpv') ,
						"success" => __("Success", 'wpv') ,
						"error" => __("Error", 'wpv') ,
						"notice" => __("Notice", 'wpv') ,
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Content", 'wpv') ,
					"id" => "content",
					"default" => "",
					"type" => "textarea"
				) ,
			)
		) ,
		array(
			"name" => __("Note Box", 'wpv') ,
			"value" => "note_box",
			"options" => array(
				array(
					"name" => __("Title (optional)", 'wpv') ,
					"id" => "title",
					"default" => "",
					"type" => "text"
				) ,
				array(
					"name" => __("Content", 'wpv') ,
					"id" => "content",
					"default" => "",
					"type" => "textarea"
				) ,
				array(
					"name" => __("Align (optional)", 'wpv') ,
					'desc' => __('You may not see the results in the preview if it is too narrow', 'wpv'),
					"id" => "align",
					"default" => '',
					"prompt" => __("Choose one..", 'wpv') ,
					"options" => array(
						"left" => __('left', 'wpv') ,
						"right" => __('right', 'wpv') ,
						"center" => __('center', 'wpv') ,
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Width (optional)", 'wpv') ,
					"id" => "width",
					"default" => '0',
					"min" => 0,
					"max" => 960,
					"step" => "1",
					"type" => "range"
				) ,
			)
		) ,
	) ,
);
