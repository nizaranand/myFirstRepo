<?php
return array(
	"name" => __("Typography", 'wpv') ,
	"value" => "typography",
	"sub" => true,
	"options" => array(
		array(
			"name" => __("Vertical blank space", 'wpv') ,
			"value" => "push",
			"options" => array(
				array(
					"name" => __("Height", 'wpv') ,
					"id" => "h",
					"default" => 30,
					'min' => 1,
					'max' => 100,
					"type" => "range",
				) ,
			)
		) ,
		array(
			"name" => sprintf(__("Drop Cap %s", 'wpv') , 1) ,
			"value" => "dropcap1",
			"options" => array(
				array(
					"name" => __("Text", 'wpv') ,
					"id" => "text",
					"default" => "",
					"type" => "text",
				) ,
				array(
					"name" => __("Color (optional)", 'wpv') ,
					'desc' => __('Please click "Preview" to see the correct color in the preview', 'wpv'),
					"id" => "color",
					"default" => '',
					"type" => "color",
				) ,
			)
		) ,
		array(
			"name" => sprintf(__("Drop Cap %s", 'wpv') , 2) ,
			"value" => "dropcap2",
			"options" => array(
				array(
					"name" => __("Text", 'wpv') ,
					"id" => "text",
					"default" => "",
					"type" => "text",
				) ,
				array(
					"name" => __("Color (optional)", 'wpv') ,
					'desc' => __('Please click "Preview" to see the correct color in the preview', 'wpv'),
					"id" => "color",
					"default" => '',
					"type" => "color",
				) ,
			)
		) ,
		array(
			"name" => __("Block Quotes", 'wpv') ,
			"value" => "blockquote",
			"options" => array(
				array(
					"name" => __("Align (optional)", 'wpv') ,
					"id" => "align",
					"default" => '',
					"prompt" => __("Choose one..", 'wpv') ,
					"options" => array(
						"left" => __('Left', 'wpv') ,
						"right" => __('Right', 'wpv') ,
						"center" => __('Center', 'wpv') ,
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Cite (optional)", 'wpv') ,
					"id" => "cite",
					"default" => "",
					"type" => "text",
				) ,
				array(
					"name" => __("Content", 'wpv') ,
					"id" => "content",
					"default" => "",
					"type" => "textarea"
				) ,
			)
		) ,
		array(
			"name" => __("Pre & Code", 'wpv') ,
			"value" => "pre_code",
			"options" => array(
				array(
					"name" => __("Type", 'wpv') ,
					"id" => "type",
					"default" => 'code',
					"options" => array(
						"pre" => 'Pre',
						"code" => 'Code',
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Content", 'wpv') ,
					"id" => "content",
					"default" => "",
					"type" => "textarea"
				) ,
			)
		) ,
		array(
			"name" => __("Styled List", 'wpv') ,
			"value" => "styledlist",
			"options" => array(
				array(
					"name" => __("Style", 'wpv') ,
					"id" => "style",
					"default" => 'list1',
					"options" => array(
						"list1" => 'list1',
						"list2" => 'list2',
						"list3" => 'list3',
						"list4" => 'list4',
						"list5" => 'list5',
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Color (optional)", 'wpv') ,
					"id" => "color",
					"default" => "",
					"prompt" => __("Choose one..", 'wpv') ,
					"options" => array(
						"black" => 'Black',
						"gray" => 'Gray',
						"red" => 'Red',
						"yellow" => 'Yellow',
						"blue" => 'Blue',
						"green" => 'Green',
						"purple" => 'Purple',
						"orange" => 'Orange',
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Content", 'wpv') ,
					"desc" => __("Please insert a valid HTML unordered list", 'wpv') ,
					"id" => "content",
					"default" => "",
					"type" => "textarea"
				) ,
			)
		) ,
		array(
			"name" => __("Icon with text", 'wpv') ,
			"value" => "icon",
			"options" => array(
				array(
					"name" => __("Style", 'wpv') ,
					"id" => "style",
					"default" => 'mail',
					"options" => array(
						"globe" => 'globe',
						"home" => 'home',
						"mail" => 'mail',
						"user" => 'user',
						"users" => 'users',
						"info" => 'info',
						"addressbook" => 'addressbook',
						"phone" => 'phone',
						"paperclip" => 'paperclip',
						"link" => 'link',
						"file" => 'file',
						"calendar" => 'calendar',
						"chart" => 'chart',
						"download" => 'download',
						"vcard" => 'vcard',
						"rss" => 'rss',
						"tag" => 'tag',
						"map" => 'map',
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Color (optional)", 'wpv') ,
					"id" => "color",
					"default" => "",
					"prompt" => __("Choose one..", 'wpv') ,
					"options" => array(
						"black" => 'Black',
						"gray" => 'Gray',
						"red" => 'Red',
						"yellow" => 'Yellow',
						"blue" => 'Blue',
						"green" => 'Green',
						"purple" => 'Purple',
						"orange" => 'Orange',
					) ,
					"type" => "select",
				) ,
				array(
					'name' => __('Size', 'wpv'),
					'id' => 'size',
					'type' => 'select',
					'default' => 'small',
					'options' => array(
						'small' => __('Small', 'wpv'),
						'medium' => __('Medium', 'wpv'),
						'large' => __('Large', 'wpv'),
					),
				),
				array(
					"name" => __("Text", 'wpv') ,
					"id" => "text",
					"default" => "",
					"type" => "textarea"
				) ,
			)
		) ,
		array(
			"name" => __("Highlight", 'wpv') ,
			"value" => "highlight",
			"options" => array(
				array(
					"name" => __("Type (optional)", 'wpv') ,
					"id" => "type",
					"default" => '',
					"prompt" => __("Choose one..", 'wpv') ,
					"options" => array(
						"light" => __("light", 'wpv') ,
						"dark" => __("dark", 'wpv') ,
					) ,
					"type" => "select",
				) ,
				array(
					"name" => __("Content", 'wpv') ,
					"id" => "content",
					"default" => "",
					"type" => "textarea"
				) ,
			)
		)
	) ,
);
