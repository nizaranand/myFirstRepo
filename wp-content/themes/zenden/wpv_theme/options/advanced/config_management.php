<?php

return array(
	array(
		'name' => __('Save/Import Skin', 'wpv'),
		'type' => 'start',
	),
	
	array(
		'name' => sprintf(__('Last active skin: %s', 'wpv'), wpv_get_option('last-active-skin')),
		'type' => 'separator',
	),

	array(
		'name' => __('Save current skin', 'wpv'),
		'desc' => __('If you use the same name as a previously saved skin it will overwrite the latter.', 'wpv'),
		'type' => 'config-export',
		'prefix' => 'theme',
	),
	array(
		'name' => __('Import saved skin', 'wpv'),
		'desc' => __('If you have made changes on the active skin, please save it before activating another skin. Otherwise you will lose these changes.', 'wpv'),
		'type' => 'config-import',
		'prefix' => 'theme',
	),
	
		array(
			'type' => 'end',
		),
);
