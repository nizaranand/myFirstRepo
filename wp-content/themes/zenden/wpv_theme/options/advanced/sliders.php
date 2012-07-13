<?php
global $wpv_slider_styles, $wpv_slider_effects, $wpv_slider_wavetypes, $wpv_slider_resizing;

return array(
array(
	'name' => __('Header Slider', 'wpv'),
	'type' => 'start'
),

array(
	'name' => __('Slider editor', 'wpv'),
	'desc' => __("Create a new slider, drag some images, set their captions and you'll have a nice looking slider", 'wpv'),
	'type' => 'slider-editor',
),

array(
	'name' => __('Default slider', 'wpv'),
	'id' => 'default-header-slider',
	'type' => 'select',
	'default' => '',
	'options' => array(),
	'target' => 'slideshow_category',
),

array(
	'name' => __('Full width header slider', 'wpv'),
	'desc' => __('Fullwidth option works only when Boxed Layout is set to "OFF"', 'wpv'),
	'id' => 'has-fullwidth-slider',
	'type' => 'toggle',
),

array(
	'name' => __('Slider style', 'wpv'),
	'id' => 'header-slider-effect',
	'type' => 'select',
	'options' => $wpv_slider_effects,
),

array(
	'name' => __('Pause time', 'wpv'),
	'id' => 'header-slider-pausetime',
	'type' => 'range',
	'min' => 500,
	'max' => 60000
),
array(
	'name' => __('Pause on hover', 'wpv'),
	'id' => 'header-slider-pauseonhover',
	'type' => 'toggle',
),
array(
	'name' => __('Animation time', 'wpv'),
	'id' => 'header-slider-animationtime',
	'type' => 'range',
	'min' => 0,
	'max' => 10000
),
array(
	'name' => __('Autostart', 'wpv'),
	'id' => 'header-slider-direction',
	'type' => 'select',
	'options' => array(
		'none' => __('Disable autostart', 'wpv'),
		'left' => __('Left (backwards)', 'wpv'),
		'right' => __('Right (forwards)', 'wpv'),
	)
),

array(
	'name' => __('Easing', 'wpv'),
	'desc' => __('Animation easings are most pronounced with sliding type effects', 'wpv'),
	'id' => 'header-slider-easing',
	'type' => 'select',
	'options' => array(
		'linear' => 'linear',
		'easeInQuint' => 'easeInQuint',
		'easeOutQuint' => 'easeOutQuint',
		'easeInOutQuint' => 'easeInOutQuint',
		'easeInElastic' => 'easeInElastic',
		'easeOutElastic' => 'easeOutElastic',
		'easeInOutElastic' => 'easeInOutElastic',
		'easeInBack' => 'easeInBack',
		'easeOutBack' => 'easeOutBack',
		'easeInOutBack' => 'easeInOutBack',
	)
),

array(
	'name' => __('Grid options', 'wpv'),
	'type' => 'separator',
),

array(
	'text' => __('For optimum performance, please mind that rows*cols should not exceed 50', 'wpv'),
	'type' => 'info',
	'class' => 'sticked'
),

array(
	'name' => __('Visible grid', 'wpv'),
	'id' => 'header-slider-visiblegrid',
	'type' => 'toggle',
),

array(
	'name' => __('Grid color', 'wpv'),
	'id' => 'header-slider-gridcolor',
	'type' => 'color',
),

array(
	'name' => __('Grid rows', 'wpv'),
	'id' => 'header-slider-rows',
	'type' => 'range',
	'min' => 1,
	'max' => 10
),
array(
	'name' => __('Grid cols', 'wpv'),
	'id' => 'header-slider-cols',
	'type' => 'range',
	'min' => 1,
	'max' => 10
),

array(
	'name' => __('Wave type', 'wpv'),
	'id' => 'header-slider-wavetype',
	'type' => 'select',
	'options' => $wpv_slider_wavetypes
),

	array(
		'type' => 'end'
	),
);