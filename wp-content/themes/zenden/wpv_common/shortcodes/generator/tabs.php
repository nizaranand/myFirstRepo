<?php
return array(
	'name' => __('Tabs', 'wpv') ,
	'value' => 'tabs',
	'options' => array(
		array(
			'name' => __('Number of tabs', 'wpv') ,
			"id" => "number",
			"min" => "1",
			"max" => "8",
			"step" => "1",
			"default" => "2",
			"type" => "range"
		) ,
		array(
			'name' => __('Style', 'wpv') ,
			"id" => "style",
			"default" => '',
			"type" => "select",
			'options' => array(
				'' => __('Default', 'wpv') ,
				'withbgr' => __('With background', 'wpv') ,
			) ,
		) ,
		array(
			'name' => __('Autorotate delay (in ms)', 'wpv') ,
			'desc' => __('Set to 0 for manual rotation', 'wpv') ,
			"id" => "delay",
			'min' => 0,
			'max' => 60000,
			"step" => 200,
			"default" => 0,
			"type" => "range"
		) ,
		array(
			'name' => __('Vertical tabs', 'wpv') ,
			"id" => "vertical",
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 1) ,
			"id" => "title_1",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 1) ,
			"id" => "content_1",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 2) ,
			"id" => "title_2",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 2) ,
			"id" => "content_2",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 3) ,
			"id" => "title_3",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 3) ,
			"id" => "content_3",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 4) ,
			"id" => "title_4",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 4) ,
			"id" => "content_4",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 5) ,
			"id" => "title_5",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 5) ,
			"id" => "content_5",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 6) ,
			"id" => "title_6",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 6) ,
			"id" => "content_6",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 7) ,
			"id" => "title_7",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 7) ,
			"id" => "content_7",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => sprintf(__("Tab %d Title", 'wpv') , 8) ,
			"id" => "title_8",
			"default" => "",
			"type" => "text"
		) ,
		array(
			"name" => sprintf(__("Tab %d Content", 'wpv') , 8) ,
			"id" => "content_8",
			"default" => "",
			"type" => "textarea"
		) ,
	) ,
);
