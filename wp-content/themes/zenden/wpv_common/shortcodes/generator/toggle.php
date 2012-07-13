<?php
return array(
		"name" => __("Toggle", 'wpv'),
		"value" => "toggle",
		"options" => array(
			array(
				"name" => __("Title", 'wpv'),
				"id" => "title",
				"default" => "",
				"type" => "text"
			),
			array(
				"name" => __("Content", 'wpv'),
				"id" => "content",
				"default" => "",
				"type" => "textarea"
			),
			array(
				'name' => __('Load closed', 'wpv'),
				'id' => 'hidden',
				'default' => 'true',
				'type' => 'toggle'
			),
		),
);
