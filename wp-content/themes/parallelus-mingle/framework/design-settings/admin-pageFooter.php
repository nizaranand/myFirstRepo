<style type="text/css">
	form textarea.input-textarea { width: 100% !important; height: 250px !important; }
</style>
<?php


$keys = $design_settings_settings->keys;
$data = $design_settings_settings->data;

	
// PAGE FOOTER SETUP
if ( $design_settings_settings->navigation == 'page_footer') :



	// Set up the navigation
	if (!($navtext = $design_settings_settings->get_val('label'))) $navtext = __('Create new', THEME_NAME);
	$design_settings_settings->navigation_bar(array(__('Page footer', THEME_NAME) . ': ' . $navtext));

	echo '<p>' . __('Create a new page footer.', THEME_NAME) . '</p>';

	$form_link = array('navigation' => 'page_footers', 'action_keys' => $keys, 'action' => 'save');
	$design_settings_settings->settings_form_header($form_link);
	
	?>
	<table class="form-table">
	<?php
	
		$comment = __('This name is for reference only.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Title', THEME_NAME) . $required, $design_settings_settings->settings_input('label') . $comment);
		$design_settings_settings->setting_row($row);


		$comment = __('The top content area of the footer. HTML and shortcodes are allowed.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Footer - top content', THEME_NAME), $design_settings_settings->settings_textarea('content_top', $keys) . $comment);
		$design_settings_settings->setting_row($row);

		$comment = __('The bottom content area of the footer. HTML and shortcodes are allowed.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Footer - bottom content', THEME_NAME), $design_settings_settings->settings_textarea('content_bottom', $keys) . $comment);
		$design_settings_settings->setting_row($row);



	echo '</table>';

	// key for this data type is generated at random when adding new slides.
	echo '<input type="hidden" name="key" value="'. $design_settings_settings->get_val('key') .'" />'; // Normal way causes error --> $design_settings_settings->settings_hidden('index'); 

	// save button
	$design_settings_settings->settings_save_button(__('Save Footer', THEME_NAME), 'button-primary');	




else:	// There is no else for this yet...


	// nothing here.

	
endif;




?>