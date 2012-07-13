<?php

$config = array(
	'id' => 'general-post-options',
	'title' => __('Vamtam options', 'wpv'),
	'pages' => array('page', 'post', 'portfolio'),
	'context' => 'normal',
	'priority' => 'high',
);


require_once WPV_ADMIN_HELPERS . 'metaboxes_generator.php';
$options = include WPV_THEME_METABOXES . 'general.php';
new metaboxes_generator($config, $options);
