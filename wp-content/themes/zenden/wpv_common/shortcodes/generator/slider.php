<?php
global $wpv_slider_shortcode_styles, $wpv_shortcode_slider_effects;

$slides = array();

for($i=1; $i<=10; $i++) {
	$slides[] = array(
		'name' => sprintf(__('Slide %d', 'wpv') , $i) ,
		'id' => $i,
		'type' => 'slide'
	);
}

return array(
	"name" => __("Sliders", 'wpv') ,
	"value" => "slider",
	"options" => array_merge(array(
		array(
			"name" => __("Number of slides", 'wpv') ,
			"id" => "number",
			"min" => 1,
			"max" => 10,
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
			"desc" => __("If you set it to 0 the slider will be as high as the highest slide", 'wpv') ,
			"id" => "height",
			"min" => 0,
			"max" => 1200,
			"default" => 225,
			"type" => "range"
		) ,
		array(
			"name" => __("Caption opacity", 'wpv') ,
			"id" => "caption_opacity",
			"min" => 0,
			"max" => 1,
			'step' => 0.05,
			"default" => 1,
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
			"name" => __("Slider style", 'wpv') ,
			"id" => "style",
			"default" => 'gallery',
			"type" => "select",
			'options' => $wpv_slider_shortcode_styles
		) ,
		array(
			"name" => __("Annotation", 'wpv') ,
			'desc' => __('Some styles may use this instead of or in addition to a caption', 'wpv'),
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
