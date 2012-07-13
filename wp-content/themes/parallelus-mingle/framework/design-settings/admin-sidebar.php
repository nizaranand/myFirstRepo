<?php


$keys = $design_settings_settings->keys;
$data = $design_settings_settings->data;


	
// SIDEBAR SETUP
if ( $design_settings_settings->navigation == 'sidebar') :



	// Set up the navigation
	if (!($navtext = $design_settings_settings->get_val('label'))) $navtext = __('Create new', THEME_NAME);
	$design_settings_settings->navigation_bar(array(__('Sidebar', THEME_NAME) . ': ' . $navtext));

	echo '<p>' . __('Create a new sidebar.', THEME_NAME) . '</p>';

	$form_link = array('navigation' => 'sidebars', 'action_keys' => $keys, 'action' => 'save');
	$design_settings_settings->settings_form_header($form_link);
	
	?>
	<table class="form-table">
	<?php
	
		$comment = __('This name is for reference only.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Title', THEME_NAME) . $required, $design_settings_settings->settings_input('label') . $comment);
		$design_settings_settings->setting_row($row);

		$comment = __('This ID can be used to include the widget area with a shortcode.', THEME_NAME);
		if ($val = $design_settings_settings->get_val('alias')) {
			$comment .= ' ' . sprintf ( '<br />' . __('For example, you can use %s to include the sidebar into a content area.', THEME_NAME), '<code>[sidebar alias="' . $val . '"]</code>' ); 
		}
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Alias', THEME_NAME) . $required, $design_settings_settings->settings_input('alias') . $comment);
		$design_settings_settings->setting_row($row);

	echo '</table>';

	// key for this data type is generated at random when created.
	echo '<input type="hidden" name="key" value="'. $design_settings_settings->get_val('key') .'" />'; // Normal way causes error --> $design_settings_settings->settings_hidden('index'); 

	// save button
	$design_settings_settings->settings_save_button(__('Save Sidebar', THEME_NAME), 'button-primary');	




else:	// There is no else for this yet...


	// nothing here.

	
endif;




?>