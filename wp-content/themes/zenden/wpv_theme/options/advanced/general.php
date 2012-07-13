<?php

return array(
array(
	'name' => __('General Settings', 'wpv'),
	'type' => 'start'
),

array(
	'name' => __('Custom logo picture', 'wpv'),
	'desc' => __('Optional way to replace "heading" and "description" text for your website with an image. Leave blank if none required', 'wpv'),
	'id' => 'custom-header-logo',
	'type' => 'upload',
	'static' => true,
),

array(
	'name' => __('Copyright text (in footer)', 'wpv'),
	'desc' => __("Custom text to appear in the footer", 'wpv'),
	'id' => 'credits',
	'type' => 'textarea',
	'static' => true,
),

array(
	'name' => __('Favicon', 'wpv'),
	'desc' => __('Upload your custom "favicon" which is visible in browser favorites and tabs.
(Must be .png or .ico file - preferably 16px by 16px ). Leave blank if none required', 'wpv'),
	'id' => 'favicon_url',
	'type' => 'upload',
	'static' => true,
),
		
array(
	'name' => __('Google Maps API Key', 'wpv'),
	'desc' => __("Paste your Google Maps API Key here. If you don't have one, please sign up for a <a href='http://code.google.com/intl/en-US/apis/maps/signup.html'>Google Maps API key</a>.", 'wpv'),
	'id' => 'gmap_api_key',
	'type' => 'textarea',
	'rows' => 2,
	'static' => true,
),

array(
	'name' => __('Google Analytics Key', 'wpv'),
	'desc' => __("Paste your key here. It should be something like UA-XXXXX-X. We're using the faster asynchronous loader, so you don't need to worry about speed :)", 'wpv'),
	'id' => 'analytics_key',
	'type' => 'text',
	'static' => true,
),

array(
	'name' => __('Custom javascript (in footer)', 'wpv'),
	'id' => 'custom_js',
	'type' => 'textarea',
	'static' => true,
),

array(
	'name' => __('Custom css', 'wpv'),
	'desc' => __('Put your css modifications here', 'wpv'),
	'id' => 'custom_css',
	'type' => 'textarea',
	'static' => true,
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
	'name' => __('Share icons', 'wpv'),
	'desc' => __('Select the social medias you want enabled and for which parts of the website', 'wpv'),
	'type' => 'social',
),

array(
	'name' => __('Disable image lazy loading', 'wpv'),
	'desc' => __('While this is not recommended you may want to have all your images on the site start loading at the same time and not on demand', 'wpv'),
	'type' => 'toggle',
	'id' => 'disable-lazy-load',
),

array(
	'type' => 'end'
)
);