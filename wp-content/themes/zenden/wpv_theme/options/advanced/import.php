<?php
return array(

array(
	'name' => __('Quick import', 'wpv'),
	'type' => 'start',
),
array(
	'name' => __('Content import', 'wpv'),
	'desc' => __('You are advised to use this importer only on new WordPress sites, as in doing so you will end up with quite a lot of example posts, pages, slides and portfolio items.', 'wpv'),
	'title' => __('Import dummy content', 'wpv'),
	'link' => wp_nonce_url(admin_url('admin.php?import=wpv&step=2&file='.WPV_THEME_SAMPLE_CONTENT), 'wpv-import'),
	'type' => 'button',
),

array(
	'name' => __('Widget import', 'wpv'),
	'desc' => __('Using this importer will overwrite your current sidebar settings', 'wpv'),
	'title' => __('Import widgets', 'wpv'),
	'link' => wp_nonce_url(admin_url('admin.php?import=wpv_widgets&file='.WPV_THEME_SAMPLE_WIDGETS), 'wpv-import'),
	'type' => 'button',
),
	array(
		'type' => 'end',
	),

);
