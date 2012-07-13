<?php
return array(
	"name" => "Lightbox",
	"value" => "lightbox",
	"options" => array(
		array(
			"name" => __("Content", 'wpv') ,
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		) ,
		array(
			"name" => __("Href", 'wpv') ,
			"id" => "href",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Title", 'wpv') ,
			"desc" => __("The title you want to display on the bottom of the lightbox.", 'wpv') ,
			"id" => "title",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Group (optional)", 'wpv') ,
			"desc" => __("This allows the user to group any combination of elements together for a gallery.", 'wpv') ,
			"id" => "group",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Width (optional)", 'wpv') ,
			"desc" => __("Set a width. Example: '100%', '500px', or 500", 'wpv') ,
			"id" => "width",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Height (optional)", 'wpv') ,
			"desc" => __("Set a height. Example: '100%', '500px', or 500", 'wpv') ,
			"id" => "height",
			"size" => 30,
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("CSS class (optional)", 'wpv') ,
			"id" => "class",
			"default" => "",
			"type" => "text",
		) ,
		array(
			"name" => __("Iframe", 'wpv') ,
			"id" => "iframe",
			"desc" => __("If 'true' specifies that content should be displayed in an iFrame.", 'wpv') ,
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Photo", 'wpv') ,
			"id" => "photo",
			"desc" => __("If true, this setting forces Lightbox to display a link as a photo. Use this when automatic photo detection fails (such as using a url like 'photo.php' instead of 'photo.jpg', 'photo.jpg#1', or 'photo.jpg?pic=1')", 'wpv') ,
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Inline", 'wpv') ,
			"id" => "inline",
			"desc" => __("If 'true' lightbox can be used to display content from the inline html. ", 'wpv') ,
			"default" => false,
			"type" => "toggle"
		) ,
		array(
			"name" => __("Inline Id", 'wpv') ,
			"desc" => __('unique id for inline content.', 'wpv') ,
			"id" => "inline_id",
			"default" => '',
			"type" => "text"
		) ,
		array(
			"name" => __("Inline Html", 'wpv') ,
			"desc" => __('You can use shortcode here.', 'wpv') ,
			"id" => "inline_html",
			"default" => '',
			"type" => "textarea"
		) ,
		array(
			"name" => __("Display Close Button", 'wpv') ,
			"id" => "close",
			"default" => true,
			"type" => "toggle"
		) ,
	) ,
);
