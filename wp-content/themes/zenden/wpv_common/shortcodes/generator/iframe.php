<?php
return array(
	"name" => __("Iframe", 'wpv') ,
	"value" => "iframe",
	"options" => array(
		array(
			"name" => __("Src", 'wpv') ,
			"id" => "src",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Width", 'wpv') ,
			"desc" => __("You can use % or px as units for width", 'wpv') ,
			"id" => "width",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Height", 'wpv') ,
			"desc" => __("You can use % or px as units for height", 'wpv') ,
			"id" => "height",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
	) ,
);
