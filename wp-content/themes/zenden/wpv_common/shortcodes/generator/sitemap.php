<?php
return array(
	"name" => "Sitemap",
	"value" => "sitemap",
	"sub" => true,
	"options" => array(
		array(
			"name" => __("All", 'wpv') ,
			"value" => "all",
			"options" => array(
				array(
					"name" => __("Column", 'wpv') ,
					"id" => "shows",
					"default" => array() ,
					"options" => array(
						"pages" => __("Pages", 'wpv') ,
						"categories" => __("Categories", 'wpv') ,
						"posts" => __("Posts", 'wpv') ,
						"portfolios" => __("Portfolios", 'wpv') ,
					) ,
					"type" => "multiselect",
				) ,
				array(
					"name" => __("number", 'wpv') ,
					"desc" => __("Sets the number of Pages to display.<br> 0: Display all Pages.", 'wpv') ,
					"id" => "number",
					"default" => '0',
					"min" => 0,
					"max" => 200,
					"step" => "1",
					"type" => "range"
				) ,
			)
		) ,
		array(
			"name" => __("Pages", 'wpv') ,
			"value" => "pages",
			"options" => array(
				array(
					"name" => __("depth", 'wpv') ,
					"desc" => __("This parameter controls how many levels in the hierarchy of Pages are to be included. <br> 0: Displays pages at any depth and arranges them hierarchically in nested lists<br> -1: Displays pages at any depth and arranges them in a single, flat list<br> 1: Displays top-level Pages only<br> 2, 3 … Displays Pages to the given depth", 'wpv') ,
					"id" => "depth",
					"default" => '0',
					"min" => - 1,
					"max" => 5,
					"step" => "1",
					"type" => "range"
				) ,
				array(
					"name" => __("number", 'wpv') ,
					"desc" => __("Sets the number of Pages to display.<br> 0: Display all Pages.", 'wpv') ,
					"id" => "number",
					"default" => '0',
					"min" => 0,
					"max" => 200,
					"step" => "1",
					"type" => "range"
				) ,
			)
		) ,
		array(
			"name" => __("Categories", 'wpv') ,
			"value" => "categories",
			"options" => array(
				array(
					"name" => __("Show Count", 'wpv') ,
					"id" => "show_count",
					"desc" => __("Toggles the display of the current count of posts in each category.", 'wpv') ,
					"default" => true,
					"type" => "toggle"
				) ,
				array(
					"name" => __("Show Feed", 'wpv') ,
					"id" => "show_feed",
					"desc" => __("Display a link to each category's <a href='http://codex.wordpress.org/Glossary#RSS' target='_blank'>rss-2</a> feed.", 'wpv') ,
					"default" => true,
					"type" => "toggle"
				) ,
				array(
					"name" => __("depth", 'wpv') ,
					"desc" => __("This parameter controls how many levels in the hierarchy of Categories are to be included. <br> 0: Displays pages at any depth and arranges them hierarchically in nested lists<br> -1: Displays pages at any depth and arranges them in a single, flat list<br> 1: Displays top-level Pages only<br> 2, 3 … Displays Pages to the given depth", 'wpv') ,
					"id" => "depth",
					"default" => '0',
					"min" => - 1,
					"max" => 5,
					"step" => "1",
					"type" => "range"
				) ,
				array(
					"name" => __("number", 'wpv') ,
					"desc" => __("Sets the number of Categories to display.<br> 0: Display all Categories.", 'wpv') ,
					"id" => "number",
					"default" => '0',
					"min" => 0,
					"max" => 200,
					"step" => "1",
					"type" => "range"
				) ,
			)
		) ,
		array(
			"name" => __("Posts", 'wpv') ,
			"value" => "posts",
			"options" => array(
				array(
					"name" => __("Show Comment", 'wpv') ,
					"id" => "show_comment",
					"desc" => __(" ", 'wpv') ,
					"default" => true,
					"type" => "toggle"
				) ,
				array(
					"name" => __("number", 'wpv') ,
					"desc" => __("Sets the number of Pages to display.<br> 0: Display all Pages.", 'wpv') ,
					"id" => "number",
					"default" => '0',
					"min" => 0,
					"max" => 200,
					"step" => "1",
					"type" => "range"
				) ,
				array(
					"name" => __("Category (optional)", 'wpv') ,
					"id" => "cat",
					"default" => array() ,
					"target" => 'cat',
					"type" => "multiselect",
				) ,
				array(
					"name" => __("Posts (optional)", 'wpv') ,
					"desc" => __("The specific posts you want to display", 'wpv') ,
					"id" => "posts",
					"default" => array() ,
					"target" => 'post',
					"type" => "multiselect",
				) ,
			)
		) ,
		array(
			"name" => __("Portfolios", 'wpv') ,
			"value" => "portfolios",
			"options" => array(
				array(
					"name" => __("Show Comment", 'wpv') ,
					"id" => "show_comment",
					"desc" => __(" ", 'wpv') ,
					"default" => false,
					"type" => "toggle"
				) ,
				array(
					"name" => __("number", 'wpv') ,
					"desc" => __("Sets the number of Pages to display.<br> 0: Display all Pages.", 'wpv') ,
					"id" => "number",
					"default" => '0',
					"min" => 0,
					"max" => 200,
					"step" => "1",
					"type" => "range"
				) ,
				array(
					"name" => __("Category (optional)", 'wpv') ,
					"id" => "cat",
					"default" => array() ,
					"target" => 'portfolio_category',
					"type" => "multiselect",
				) ,
			)
		) ,
	) ,
);
