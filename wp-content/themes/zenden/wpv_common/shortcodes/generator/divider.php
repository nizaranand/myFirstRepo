<?php
return array(
	"name" => __("Divider", 'wpv') ,
	"value" => "divider",
	"options" => array(
		array(
			"name" => __("Type", 'wpv') ,
			"id" => "type",
			"default" => 'divider_top',
			"options" => array(
				"divider_1" => __("Divider Line (1)", 'wpv') ,
				"divider_2" => __("Divider Line (2)", 'wpv') ,
				"divider_3" => __("Divider Line (3)", 'wpv') ,
				"clearboth" => __("Clear Both", 'wpv') ,
			) ,
			"type" => "select",
		) ,
	) ,
);
