<?php

function shortcodes_tinymce() {
	add_filter("mce_external_plugins", "shortcodes_tinymce_plugin");
	add_filter('mce_buttons', 'shortcodes_tinymce_button');
}

function shortcodes_tinymce_button($buttons) {
	array_push($buttons, "separator", "shortcodes");
	return $buttons;
}
 
function shortcodes_tinymce_plugin($plugin_array) {
	$plugin_array['shortcodes'] = WPV_ADMIN_ASSETS_URI . 'js/shortcodes_tinymce.js.php';
	return $plugin_array;
}
add_action('init', 'shortcodes_tinymce');

