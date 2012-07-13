<?php

$options = array(
	'name' => __('Vamtam | advanced options', 'wpv'),
	'auto' => true,
	'config' => array(
		array(
			'name' => __('Vamtam | advanced options', 'wpv'),
			'type' => 'title',
			'desc' => '',
		)
	)
);

$tabs = include WPV_THEME_OPTIONS . 'advanced.php';

foreach($tabs as $tab) {
	$tab_contents = include WPV_THEME_OPTIONS."$tab.php";
	
	$options['config'] = array_merge($options['config'], $tab_contents);
}

return $options;