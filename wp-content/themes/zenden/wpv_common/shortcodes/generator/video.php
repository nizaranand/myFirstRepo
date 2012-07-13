<?php
return 	array(
		"name" => __("Video", 'wpv'),
		"value" => "video",
		"sub" => true,
		"options" => array(
			array(
				"name" => "Html5",
				"value" => "html5",
				"options" => array(
					array(
						"name" => __("Poster Image", 'wpv'),
						"desc" => __("The poster image is placeholder for the video before it plays. It's also used as the image fallback for devices that don't support HTML5 Video or Flash. ", 'wpv'),
						"id" => "poster",
						"size" => 30,
						"default" => "",
						"type" => "upload",
					),
					array(
						"name" => __("MP4 Source", 'wpv'),
						"desc" => __("Supported by Webkit browsers (Safari, Chrome, iPhone/iPad) and Internet Explorer 9. Also supported by Flash 9 and higher, so can double as the Flash source.", 'wpv'),
						"id" => "mp4",
						"size" => 30,
						"default" => "",
						"type" => "text",
					),
					array(
						"name" => __("WebM Source", 'wpv'),
						"desc" => __('Supported by newer versions of Firefox, Chrome, and Opera.', 'wpv'),
						"id" => "webm",
						"size" => 30,
						"default" => "",
						"type" => "text",
					),
					array(
						"name" => __("Ogg Source", 'wpv'),
						"desc" => __("Supported by Firefox, Opera, Chrome, and newer versions of Safari. Unfortunately it's not as good as WebM and MP4.", 'wpv'),
						"id" => "ogg",
						"size" => 30,
						"default" => "",
						"type" => "text",
					),
					array (
						"name" => __("Width", 'wpv'),
						"id" => "width",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array (
						"name" => __("Height", 'wpv'),
						"id" => "height",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array(
						"name" => __("Preload", 'wpv'),
						"id" => "preload",
						"desc" => __("Select this if you want the video to start downloading as soon the user loads the page.", 'wpv'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Autoplay", 'wpv'),
						"id" => "autoplay",
						"desc" => __("Select this if you want the video to start playing as soon as the page is loaded.", 'wpv'),
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"name" => "Flash",
				"value" => "flash",
				"options" => array(
					array(
						"name" => __("Src", 'wpv'),
						"desc" => __('Specifies the location (URL) of the movie to be loaded', 'wpv'),
						"id" => "src",
						"size" => 30,
						"default" => "",
						"type" => "text",
					),
					array (
						"name" => __("Width (optional)", 'wpv'),
						"id" => "width",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array (
						"name" => __("Height (optional)", 'wpv'),
						"id" => "height",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array(
						"name" => __("Play", 'wpv'),
						"id" => "play",
						"desc" => __("Specifies whether the movie begins playing immediately on loading in the browser.", 'wpv'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("flashvars (optional)", 'wpv'),
						"desc" => __("variable to pass to Flash Player.", 'wpv'),
						"id" => "flashvars",
						"size" => 30,
						"default" => "",
						"type" => "text",
					),
				),
			),
			array(
				"name" => "YouTube",
				"value" => "youtube",
				"options" => array(
					array(
						"name" => __("Video url", 'wpv'),
						"id" => "src",
						"default" => "",
						"type" => "text",
					),
					array (
						"name" => __("Width (optional)", 'wpv'),
						"id" => "width",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array (
						"name" => __("Height (optional)", 'wpv'),
						"id" => "height",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
				),
			),
			array(
				"name" => "Vimeo",
				"value" => "vimeo",
				"options" => array(
					array(
						"name" => __("Video url", 'wpv'),
						"id" => "src",
						"default" => "",
						"type" => "text",
					),
					array (
						"name" => __("Width (optional)", 'wpv'),
						"id" => "width",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array (
						"name" => __("Height (optional)", 'wpv'),
						"id" => "height",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array(
						"name" => __("Inline", 'wpv'),
						"id" => "title",
						"desc" => __("Whether to display title on video.", 'wpv'),
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"name" => "Dailymotion",
				"value" => "dailymotion",
				"options" => array(
					array(
						"name" => __("Video url", 'wpv'),
						"id" => "src",
						"default" => "",
						"type" => "text",
					),
					array (
						"name" => __("Width (optional)", 'wpv'),
						"id" => "width",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
					array (
						"name" => __("Height (optional)", 'wpv'),
						"id" => "height",
						"default" => 0,
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"type" => "range"
					),
				),
			),
		),
	);
