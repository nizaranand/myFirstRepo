<?php

require_once( '../../../../../../wp-load.php' );

$config = array(
	'title' => __('Shortcodes', 'wpv'),
	'id' => 'shortcode',
);

require_once WPV_ADMIN_HELPERS . 'shortcodes_generator.php';
$shortcodes = include(WPV_SHORTCODES_GENERATOR . $_GET['slug'] .'.php');
$generator = new shortcodes_generator($config, $shortcodes);

$generator->render();