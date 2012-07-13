<?php
/*
 *	Based on the work of Henrik Melin and Kal Ström's "More Fields", "More Types" and "More Taxonomies" plugins.
 *	http://more-plugins.se/
*/

// Reset
if (0) update_option('design_settings', array());

// Settings
$fields = array(
		'var' => array(),
		'array' => array(
			'page_layouts'
		)
);
$default = array();

$settings = array(
	'name' => 'Design Settings', 
	'option_key' => $shortname.'design_settings',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'appearance',
	//'menu_permissions' => 5,
	'file' => __FILE__
);

// Required components
include('object.php');

$design_settings = new design_settings_object($settings);

// Load admin components
if (is_admin()) {	
	include('settings-object.php');
	$design_settings_settings = new design_settings_admin($settings);
}

?>
