<?php
return array(
	"name" => __("Single column", 'wpv') ,
	"value" => "column",
	"options" => array(
		array(
			"name" => __("Type", 'wpv') ,
			"id" => "type",
			"default" => '0',
			"options" => array(
				"one_half" => 'One Half',
				"one_half_last" => 'One Half Last',
				"one_third" => 'One Third',
				"one_third_last" => 'One Third Last',
				"two_thirds" => 'Two Thirds',
				"two_thirds_last" => 'Two Thirds Last',
				"one_fourth" => 'One Fourth',
				"one_fourth_last" => 'One Fourth Last',
				"three_fourths" => 'Three Fourths',
				"three_fourths_last" => 'Three Fourths Last',
				"one_fifth" => 'One Fifth',
				"one_fifth_last" => 'One Fifth Last',
				"two_fifths" => 'Two Fifths',
				"two_fifths_last" => 'Two Fifths Last',
				"three_fifths" => 'Three Fifths',
				"three_fifths_last" => 'Three Fifths Last',
				"four_fifths" => 'Four Fifths',
				"four_fifths_last" => 'Four Fifths Last',
				"one_sixth" => 'One Sixth',
				"one_sixth_last" => 'One Sixth Last',
				"five_sixths" => 'Five Sixths',
				"five_sixths_last" => 'Five Sixths Last',
			) ,
			"type" => "select",
		) ,
		array(
			"name" => __("Content", 'wpv') ,
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		) ,
	) ,
);

