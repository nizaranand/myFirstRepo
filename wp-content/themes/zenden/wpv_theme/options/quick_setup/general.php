<?php

global $wpv_slider_effects;

return array(
array(
	'name' => __('Quick setup', 'wpv'),
	'type' => 'start'
),

array(
	'name' => __('General', 'wpv'),
	'type' => 'separator',
),

array(
	'name' => __('Display "scroll to top" button', 'wpv'),
	'id' => 'show_scroll_to_top',
	'type' => 'toggle',
),

array(
	'name' => __('Feedback button', 'wpv'),
	'id' => 'feedback-type',
	'type' => 'select',
	'options' => array(
		'none' => __('None', 'wpv'),
		'link' => __('Link', 'wpv'),
		'sidebar' => __('Slide out widget area', 'wpv'),
	),
),

array(
	'name' => __('Feedback button link', 'wpv'),
	'id' => 'feedback-link',
	'type' => 'text',
),

array(
	'name' => __('RSS Button in top right corner', 'wpv'),
	'id' => 'show_rss_button',
	'type' => 'toggle',
),

array(
	'name' => __('Facebook link', 'wpv'),
	'id' => 'fb-link',
	'type' => 'text',
),

array(
	'name' => __('Twitter link', 'wpv'),
	'id' => 'twitter-link',
	'type' => 'text',
),

array(
	'name' => __('YouTube link', 'wpv'),
	'id' => 'youtube-link',
	'type' => 'text',
), 

array(
	'name' => __('Flickr link', 'wpv'),
	'id' => 'flickr-link',
	'type' => 'text',
),

array(
	'name' => __('LinkedIn link', 'wpv'),
	'id' => 'linkedin-link',
	'type' => 'text',
),

array(
	'name' => __('Top menu phone number area', 'wpv'),
	'id' => 'phone-num-top',
	'type' => 'textarea',
),

array(
	'name' => __('Custom logo picture url', 'wpv'),
	'desc' => __('Optional way to replace "heading" and "description" text for your website with an image. Leave blank if none required', 'wpv'),
	'id' => 'custom-header-logo',
	'type' => 'upload',
),

array(
	'name' => __('Copyright text (in footer)', 'wpv'),
	'desc' => __("Custom text to appear in the footer", 'wpv'),
	'id' => 'credits',
	'type' => 'textarea',
),

array(
	'name' => __('Favicon url', 'wpv'),
	'desc' => __('Upload your custom "favicon" which is visible in browser favorites and tabs.
(Must be .png or .ico file - 16px by 16px ). Leave blank if none required', 'wpv'),
	'id' => 'favicon_url',
	'type' => 'upload',
),

array(
	'name' => __('Layout', 'wpv'),
	'type' => 'separator',
),

array(
	'text' => __('Below you can set the the width of the sidebars in the body, and the height of the header and slider area by dragging the blue gutters. You can enable or disable the slider, the header widget areas, the body sidebar areas and the footer widget areas. Please note, that whether the slider, the header widget areas or any of the body sidebars are displayed is just a default setting that can be overridden for newly created pages/posts/portfolio items.', 'wpv'),
	'class' => 'sticked',
	'type' => 'info',
),

array(
	'name' => __('General layout', 'wpv'),
	'type' => 'general-layout',
	'overall' => 'content-width',
	'left' => 'left_sidebar_width',
	'right' => 'right_sidebar_width',
	'slider' => 'stage-height',
	'header' => 'header-height',
	'min_width' => 940,
	'max_width' => 940,
	'pane' => 1100,
),

array(
	'name' => __('Background slider height', 'wpv'),
	'id' => 'header-slider-height',
	'type' => 'range',
	'min' => 100,
	'max' => 1500,
),

array(
	'name' => __('Sidebar layout for new pages', 'wpv'),
	'class' => 'hidden',
	'id' => 'default-body-layout',
	'type' => 'body-layout',
),

array(
	'name' => __('Enable header slider', 'wpv'),
	'id' => 'has-header-slider',
	'type' => 'checkbox',
	'class' => 'hidden',
),

array(
	'name' => __('Enable header widget areas', 'wpv'),
	'id' => 'has-header-sidebars',
	'type' => 'checkbox',
	'class' => 'hidden',
),

array(
	'name' => __('Enable footer widget areas', 'wpv'),
	'id' => 'has-footer-sidebars',
	'type' => 'checkbox',
	'class' => 'hidden',
),

array(
	'name' => __('Enable boxed layout', 'wpv'),
	'id' => 'enable_box_layout',
	'type' => 'toggle',
),
/*
array(
	'name' => __('Enable fixed header', 'wpv'),
	'id' => 'fixed-header',
	'type' => 'toggle',
),
*/
array(
	'name' => __('Header height', 'wpv'),
	'id' => 'header-height',
	'class' => 'hidden',
	'desc' => __('This is the area above the slider', 'wpv'),
	'type' => 'range',
	'min' => 50,
	'max' => 300,
),

array(
	'name' => __('Header slider height', 'wpv'),
	'desc' => __('In pixels', 'wpv'),
	'id' => 'stage-height',
	'type' => 'range',
	'class' => 'hidden',
	'min' => 100,
	'max' => 800,
),

array(
	'name' => __('Site width', 'wpv'),
	'class' => 'hidden',
	'id' => 'content-width',
	'type' => 'range',
	'min' => 940,
	'max' => 940,
),

array(
	'name' => __('Left sidebar width', 'wpv'),
	'id' => 'left_sidebar_width',
	'type' => 'range',
	'class' => 'hidden',
	'min' => 150,
	'max' => 400,
),
array(
	'name' => __('Right sidebar width', 'wpv'),
	'id' => 'right_sidebar_width',
	'type' => 'range',
	'class' => 'hidden',
	'min' => 150,
	'max' => 400,
),

array(
	'name' => __('Styles', 'wpv'),
	'type' => 'separator',
),

array(
	'name' => __('Main background', 'wpv'),
	'id' => 'body-background',
	'type' => 'background',
),

array(
	'text' => __('You can also choose some of the preset background patterns we\'ve crafted for you', 'wpv'),
	'type' => 'info',
),

array(
	'type' => 'autofill',
	'class' => 'no-desc',
	'option_sets' => array(
		array(
			'name' => __('Pattern 00', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'default/studium-demo.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'default/studium.jpg',
				'body-background-repeat' => 'no-repeat',
				'body-background-position' => 'center bottom',
			),
		),
		array(
			'name' => __('Pattern 01', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/01.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/demo/01.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 02', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/02.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/02.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 03', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/03.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/03.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 04', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/04.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/04.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 05', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/05.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/05.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 06', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/06.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/06.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 07', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/07.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/07.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 08', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/08.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/08.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 09', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/09.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/09.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 10', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/10.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/10.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 11', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/11.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/11.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 12', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/12.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/12.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 13', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/13.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/13.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 14', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/14.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/14.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
		array(
			'name' => __('Pattern 15', 'wpv'),
			'image' => WPV_THEME_IMAGES . 'patterns/demo/15.png',
			'values' => array(
				'body-background-image' => WPV_THEME_IMAGES . 'patterns/15.png',
				'body-background-repeat' => 'repeat',
				'body-background-position' => 'center center',
			),
		),
	),
),

array(
	'name' => __('Accent color', 'wpv'),
	'id' => 'accent-color',
	'type' => 'color',
),

array(
	'name' => __('Accent color 2', 'wpv'),
	'id' => 'accent-color-2',
	'type' => 'color',
),

array(
	'name' => __('Accent color 3', 'wpv'),
	'id' => 'accent-color-3',
	'type' => 'color',
),

array(
	'name' => __('Header slider', 'wpv'),
	'type' => 'separator',
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
	'name' => __('Advanced', 'wpv'),
	'type' => 'separator',
),

array(
	'name' => __('Custom css', 'wpv'),
	'desc' => __('Quickly add some CSS to your theme by adding it to this block. It will be parsed with cssmin', 'wpv'),
	'id' => 'custom_css',
	'type' => 'textarea',
),

array(
	'type' => 'end'
)
);