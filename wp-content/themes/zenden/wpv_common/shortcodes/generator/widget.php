<?php
return 	array(
		"name" => __("Widget", 'wpv'),
		"value" => "widget",
		"sub" => true,
		"options" => array(
			array(
				"name" => __("Contact Form", 'wpv'),
				"value" => "contactform",
				"options" => array (
					array(
						"name" => __("email", 'wpv'),
						"id" => "email",
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __("Success Text", 'wpv'),
						"id" => "content",
						"default" => "",
						"type" => "textarea"
					),
				)
			),
			array(
				"name" => __("Twitter", 'wpv'),
				"value" => "twitter",
				"options" => array (
					array(
						"name" => __("Username", 'wpv'),
						"desc" => __("Use ',' separate multi user.<br> (e.g <code>user1,user2</code>)", 'wpv'),
						"id" => "username",
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __("Count", 'wpv'),
						"desc" => "",
						"id" => "count",
						"default" => '4',
						"min" => 0,
						"max" => 20,
						"step" => "1",
						"type" => "range"
					),
					array(
						"name" => __("Avatar Size (optional)", 'wpv'),
						"desc" => __("Height and width of avatar if displayed", 'wpv'),
						"id" => "avatarSize",
						"default" => '0',
						"min" => 0,
						"max" => 48,
						"step" => "1",
						"type" => "range"
					),
					array(
						"name" => __("Query (optional)", 'wpv'),
						"desc" => __("uses <a href='http://apiwiki.twitter.com/Twitter-Search-API-Method%3A-search' target='_blank'>Twitter's Search API</a>, so you can display any tweets you like.", 'wpv'),
						"id" => "query",
						"default" => 'null',
						"type" => "textarea"
					),
				)
			),
			array(
				"name" => __("Flickr", 'wpv'),
				"value" => "flickr",
				"options" => array (
					array(
						"name" => __("Type", 'wpv'),
						"id" => "type",
						"default" => 'page',
						"options" => array(
							"user" => __("User", 'wpv'),
							"group" => __("Group", 'wpv'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Flickr id (<a href='http://idgettr.com/' target='_blank'>idGettr</a>)", 'wpv'),
						"id" => "id",
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __("Count", 'wpv'),
						"desc" => "",
						"id" => "count",
						"default" => '4',
						"min" => 0,
						"max" => 20,
						"step" => "1",
						"type" => "range"
					),
					array(
						"name" => __("Display", 'wpv'),
						"id" => "display",
						"default" => 'latest',
						"options" => array(
							"latest" => __('Latest', 'wpv'),
							"random" => __('Random', 'wpv'),
						),
						"type" => "select",
					),
				)
			),
			array(
				"name" => __("Contact Info", 'wpv'),
				"value" => "contact_info",
				"options" => array (
					array(
						"name" => __("Color (optional)", 'wpv'),
						"id" => "color",
						"default" => "",
						"prompt" => __("Choose one..", 'wpv'),
						"options" => array(
							"black" => 'Black',
							"gray" => 'Gray',
							"red" => 'Red',
							"yellow" => 'Yellow',
							"blue" => 'Blue',
							"pink" => 'Pink',
							"green" => 'Green',
							"cyan" => 'Cyan',
							"purple" => 'Purple',
							"orange" => 'Orange',
							"magenta" => 'Magenta',
						),
						"type" => "select",
					),
					array(
						"name" => __("Phone", 'wpv'),
						"id" => "phone",
						"default" => "",
						"size" => 30,
						"type" => "text"
					),
					array(
						"name" => __("Cell Phone", 'wpv'),
						"id" => "cellphone",
						"default" => "",
						"size" => 30,
						"type" => "text"
					),
					array(
						"name" => __("email", 'wpv'),
						"id" => "email",
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __("Address", 'wpv'),
						"id" => "address",
						"default" => "",
						"size" => 30,
						"type" => "text"
					),
					array(
						"name" => __("City", 'wpv'),
						"id" => "city",
						"default" => "",
						"size" => 30,
						"type" => "text"
					),
					array(
						"name" => __("State", 'wpv'),
						"id" => "state",
						"default" => "",
						"size" => 30,
						"type" => "text"
					),
					array(
						"name" => __("Zip", 'wpv'),
						"id" => "zip",
						"default" => "",
						"size" => 30,
						"type" => "text"
					),
					array(
						"name" => __("Name", 'wpv'),
						"id" => "name",
						"default" => "",
						"size" => 30,
						"type" => "text"
					),
				)
			),
		),
	);
