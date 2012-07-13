<?php
return array(
	"name" => __("Price", 'wpv') ,
	"value" => "price",
	"options" => array(
		array(
			"name" => __("Title", 'wpv') ,
			"id" => "title",
			"default" => '',
			"type" => "text",
		) ,
		array(
			"name" => __("Price", 'wpv') ,
			"id" => "price",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Currency", 'wpv') ,
			"id" => "currency",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Duration", 'wpv') ,
			"id" => "duration",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Summary", 'wpv') ,
			"id" => "summary",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Description", 'wpv') ,
			"id" => "description",
			"default" => '',
			"type" => "textarea"
		) ,
		array(
			"name" => __("Button text", 'wpv') ,
			"id" => "button_text",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Button link", 'wpv') ,
			"id" => "button_link",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Text alignment", 'wpv') ,
			"id" => "text_align",
			"default" => 'justify',
			"type" => "select",
			'options' => array(
				'justify' => 'justify',
				'left' => 'left',
				'center' => 'center',
				'right' => 'right',
			)
		) ,
		array(
			"name" => __("Title size", 'wpv') ,
			"id" => "title_size",
			"default" => '18',
			"type" => "range",
			'min' => 0,
			'max' => 50,
		) ,
		array(
			"name" => __("Title color", 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			"id" => "title_color",
			"default" => '',
			"type" => "color"
		) ,
		array(
			"name" => __("Title background", 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			"id" => "title_background",
			"default" => 'transparent',
			"type" => "color"
		) ,
		array(
			"name" => __("Price color", 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			"id" => "price_color",
			"default" => '',
			"type" => "color"
		) ,
		array(
			"name" => __("Price background", 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			"id" => "price_background",
			"default" => '',
			"type" => "color"
		) ,
		array(
			"name" => __("Price size", 'wpv') ,
			"id" => "price_size",
			"default" => 25,
			"type" => "range",
			'min' => 8,
			'max' => 45,
		) ,
		array(
			"name" => __("Description color", 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			"id" => "description_color",
			"default" => '',
			"type" => "color"
		) ,
		array(
			"name" => __("Description background", 'wpv') ,
			'desc' => __('Please click the Preview button to see its effect', 'wpv'),
			"id" => "description_background",
			"default" => '',
			"type" => "color"
		) ,
	) ,
);
