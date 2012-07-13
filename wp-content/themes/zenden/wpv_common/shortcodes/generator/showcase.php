<?php
global $wpv_shortcode_slider_effects;

$slides = array();

for($i=1; $i<=25; $i++) {
	$slides[] = array(
		'name' => sprintf(__('Image %d', 'wpv') , $i) ,
		'id' => "{$i}_image",
		'class' => 'no-desc',
		'type' => 'upload',
	);
}

return array(
	"name" => __("Showcase", 'wpv') ,
	"value" => "showcase",
	"options" => array_merge(array(
		array(
			"name" => __("Number of columns", 'wpv') ,
			"id" => "columns",
			"min" => 2,
			"max" => 5,
			"step" => 1,
			"default" => 2,
			"type" => "range"
		) ,
		array(
			"name" => __("Number of slides", 'wpv') ,
			"id" => "slides",
			"min" => 1,
			"max" => 5,
			"step" => 1,
			"default" => 2,
			"type" => "range"
		) ,
		array(
			"name" => __("Width", 'wpv') ,
			"desc" => __("Set it to 0 for maximum width", 'wpv') ,
			"id" => "width",
			"min" => 0,
			"max" => 1200,
			"default" => 0,
			"type" => "range"
		) ,
		array(
			"name" => __("Height", 'wpv') ,
			"id" => "height",
			"min" => 0,
			"max" => 1200,
			"default" => 225,
			"type" => "range"
		) ,
		array(
			"name" => __("Effect", 'wpv') ,
			"id" => "effect",
			"default" => "random",
			"type" => "select",
			'options' => $wpv_shortcode_slider_effects,
		) ,
		array(
			"name" => __("Animation speed", 'wpv') ,
			"id" => "animspeed",
			"min" => 0,
			"max" => 60000,
			"default" => 1000,
			"type" => "range"
		) ,
		array(
			"name" => __("Pause time", 'wpv') ,
			"id" => "pausetime",
			"min" => 0,
			"max" => 60000,
			"default" => 5000,
			"type" => "range"
		) ,
		array(
			"name" => __("Pause on hover", 'wpv') ,
			"id" => "pauseonhover",
			"default" => true,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Annotation", 'wpv') ,
			'desc' => __('If anything is entered in this field, it will be displayed as a static first column', 'wpv'),
			"id" => "annotation",
			"type" => "textarea"
		) ,
		array(
			"name" => __("Highlight", 'wpv') ,
			"id" => "highlight",
			"type" => "toggle"
		) ,
		), $slides) ,
);
