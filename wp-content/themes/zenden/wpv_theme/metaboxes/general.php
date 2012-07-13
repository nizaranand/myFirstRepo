<?php
global $wpv_slider_effects;

return array(

array(
	'name' => __('Use global options', 'wpv'),
	'desc' => __('If this option is enabled, some of the local options which have global equivalents will not be taken into account. Hence, if this option is disabled, these local options will overwrite the global settings for this post', 'wpv'),
	'id' => 'use-global-options',
	'type' => 'toggle',
	'default' => true,
),

array(
	'name' => __('Layout and styles', 'wpv'),
	'type' => 'separator'
),

array(
	'name' => __('Layout type', 'wpv'),
	'id' => 'layout-type',
	'type' => 'body-layout',
	'only' => 'page,post,portfolio',
	'default' => wpv_get_option('default-body-layout'),
),
array(
	'name' => __('Left sidebar', 'wpv'),
	'id' => 'left_sidebar_type',
	'type' => 'select',
	'prompt' => __('Default', 'wpv'),
	'target' => 'sidebars',
	'default' => false,
),
array(
	'name' => __('Right sidebar', 'wpv'),
	'id' => 'right_sidebar_type',
	'type' => 'select',
	'prompt' => __('Default', 'wpv'),
	'target' => 'sidebars',
	'default' => false,
),

array(
	'name' => __('Show header widget areas', 'wpv'),
	'desc' => __('These can be configured from "Vamtam" -> "Theme options" -> "Header"', 'wpv'),
	'image' => WPV_ADMIN_ASSETS_URI.'images/header-sidebars-1.png',
	'id' => 'show_header_sidebars',
	'type' => 'toggle',
	'default' => wpv_get_option('has-header-sidebars'),
),

array(
	'name' => __('Show page title header', 'wpv'),
	'id' => 'show_page_header',
	'type' => 'toggle',
	'default' => true,
),

array(
	'name' => __('Enable boxed layout', 'wpv'),
	'id' => 'boxed-layout',
	'type' => 'toggle',
	'default' => wpv_get_option('enable_box_layout')
),

array(
	'name' => __('Custom background', 'wpv'),
	'id' => 'background',
	'type' => 'background',
),

array(
	'name' => __('Title background', 'wpv'),
	'id' => 'local-title-background',
	'type' => 'background',
),

array(
	'name' => __('Featured image position', 'wpv'),
	'id' => 'img_style',
	'only' => 'post',
	'type' => 'select',
	'default' => 'fullimage',
	'options' => array(
		'fullimage' => __('Full width', 'wpv'),
		'sideimage' => __('Left', 'wpv'),
		'right sideimage' => __('Right', 'wpv'),
	)
),

array(
	'name' => __('Slider', 'wpv'),
	'type' => 'separator'
),

array(
	'name' => __('Slider', 'wpv'),
	'id' => 'slider-category',
	'type' => 'select',
	'default' => '',
	'options' => array(),
	'target' => 'slideshow_category',
),

array(
	'name' => __('Show slider in header', 'wpv'),
	'id' => 'show_header_slider',
	'type' => 'toggle',
	'default' => wpv_get_option('has-header-slider'),
),
array(
	'name' => __('Slider style', 'wpv'),
	'id' => 'slider-effect',
	'type' => 'select',
	'default' => wpv_get_option('header-slider-effect'),
	'options' => $wpv_slider_effects,
),
array(
	'name' => __('Show full width slider', 'wpv'),
	'id' => 'slider-fullwidth',
	'type' => 'toggle',
	'default' => wpv_get_option('has-fullwidth-slider'),
),
array(
	'name' => __('Slider position', 'wpv'),
	'id' => 'slider-position',
	'type' => 'select',
	'options' => array(
		'static' => 'static',
		'fixed' => 'fixed',
	),
),
array(
	'name' => __('Animation time', 'wpv'),
	'id' => 'slider-animation-time',
	'default' => wpv_get_option('header-slider-animationtime'),
	'type' => 'range',
	'min' => 0,
	'max' => 10000,
),
array(
	'name' => __('Easing', 'wpv'),
	'id' => 'slider-easing',
	'type' => 'select',
	'default' => wpv_get_option('header-slider-easing'),
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
	'name' => __('Slider height', 'wpv'),
	'desc' => __('You can set it to 0 if you want the slider to be as high as the browser window', 'wpv'),
	'id' => 'slider-height',
	'type' => 'range',
	'min' => 0,
	'max' => 1500,
),

array(
	'name' => __('Post format settings', 'wpv'),
	'only' => 'post',
	'type' => 'separator',
),

array(
	'name' => __('Link', 'wpv'),
	'desc' => __('Used in the "quote", "link", "audio" and "video" formats', 'wpv'),
	'id' => 'post-link',
	'only' => 'post',
	'type' => 'text',
	'default' => '',
),

array(
	'name' => __('Quote author', 'wpv'),
	'desc' => __('Used in the "quote" format', 'wpv'),
	'id' => 'quote-author',
	'only' => 'post',
	'type' => 'text',
	'default' => '',
),

array(
	'name' => __('Portfolio', 'wpv'),
	'only' => 'portfolio',
	'type' => 'separator',
),

array(
	'name' => __('Portfolio data type', 'wpv'),
	'desc' => __('Image - uses the featured image (default)<br />
				  Gallery - use the featured image as a title image, but add more image via the form below 
				  Video/Link - uses the "portfolio data url" setting<br />
				  Document - acts like a normal post
				', 'wpv'),
	'id' => 'portfolio_type',
	'only' => 'portfolio',
	'type' => 'select',
	'options' => array(
		'image' => 'Image',
		'gallery' => 'Gallery',
		'video' => 'Video',
		'link' => 'Link',
		'document' => 'Document',
	),
	'default' => 'image',
),
array(
	'name' => __('Portfolio data url', 'wpv'),
	'id' => 'portfolio_data_url',
	'type' => 'text',
	'only' => 'portfolio',
	'default' => '',
),
array(
	'name' => __('Portfolio video width', 'wpv'),
	'desc' => __('Only applicable if the Portfolio data type is "Video"', 'wpv'),
	'id' => 'portfolio_video_width',
	'type' => 'range',
	'min' => 0,
	'max' => 1200,
	'only' => 'portfolio',
	'default' => 640,
),
array(
	'name' => __('Portfolio video height', 'wpv'),
	'desc' => __('Only applicable if the Portfolio data type is "Video"', 'wpv'),
	'id' => 'portfolio_video_height',
	'type' => 'range',
	'min' => 0,
	'max' => 1200,
	'only' => 'portfolio',
	'default' => 360,
),
array(
	'name' => __('Portfolio link target', 'wpv'),
	'desc' => __('Only applicable if the Portfolio data type is "Link"', 'wpv'),
	'id' => 'portfolio_link_target',
	'type' => 'select',
	'options' => array(
		'_self' => 'Same window',
		'_blank' => 'New window',
	),
	'only' => 'portfolio',
),
);
