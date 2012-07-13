<style type="text/css">
	form textarea.input-textarea { width: 100% !important; height: 200px !important; }
</style>

<?php


$keys = $design_settings_settings->keys;
$data = $design_settings_settings->data;


	
// TOP GRAPHIC SETUP
if ( $design_settings_settings->navigation == 'top_graphic') :


	// Set up the navigation
	if (!($navtext = $design_settings_settings->get_val('label'))) $navtext = __('Create new', THEME_NAME);
	$design_settings_settings->navigation_bar(array(__('Top graphic', THEME_NAME) . ': ' . $navtext));

	echo '<p>' . __('Create a new top graphic.', THEME_NAME) . '</p>';

	$form_link = array('navigation' => 'top_graphics', 'action_keys' => $keys, 'action' => 'save');
	$design_settings_settings->settings_form_header($form_link);
	
	?>
	<table class="form-table">
	<?php
	
		$comment = __('This name is for reference only.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Title', THEME_NAME) . $required, $design_settings_settings->settings_input('label') . $comment);
		$design_settings_settings->setting_row($row);

		$comment = __('Optional', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$comment2 = __('Leave this field blank to use the default value.', THEME_NAME);
		$comment2 = $design_settings_settings->format_comment($comment2);
		$row = array(__('Width', THEME_NAME) . $comment, $design_settings_settings->settings_input('width') . $comment2);
		$design_settings_settings->setting_row($row);

		$comment = __('Optional', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$comment2 = __('Leave this field blank to use the default value.', THEME_NAME);
		$comment2 = $design_settings_settings->format_comment($comment2);
		$row = array(__('Height', THEME_NAME) . $comment, $design_settings_settings->settings_input('height') . $comment2);
		$design_settings_settings->setting_row($row);

		$comment = __('Optional', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$comment2 = __('Enter the full URL of an image to show behind your header content.', THEME_NAME);
		$comment2 = $design_settings_settings->format_comment($comment2);

			$field_set_x = array( 
				'0' => 'Left', 
				'50%' => 'Center', 
				'100%' => 'Right'
			);
			$field_comments_x = array();
			$comment_x = __('The horizontal position of the background image.', THEME_NAME);
			$comment_x = $design_settings_settings->format_comment($comment_x);
			$row_x = '<br />' . __('Horizontal position', THEME_NAME) . '<br />' . $design_settings_settings->settings_radiobuttons('bg_pos_x', $field_set_x, $field_comments_x) . $comment_x;
	
			$field_set_y = array( 
				'0' => 'Top', 
				'50%' => 'Middle', 
				'100%' => 'Bottom'
			);
			$field_comments_y = array();
			$comment_y = __('The vertical position of the background image.', THEME_NAME);
			$comment_y = $design_settings_settings->format_comment($comment_y);
			$row_y = '<br />' . __('Vertical position', THEME_NAME) . '<br />' . $design_settings_settings->settings_radiobuttons('bg_pos_y', $field_set_y, $field_comments_y) . $comment_y;

		$row = array(__('Background image', THEME_NAME) . $comment, $design_settings_settings->settings_input('background') . $comment2 . $row_x . $row_y );
		$design_settings_settings->setting_row($row);

		$comment = __('Optional', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$comment2 = __('Enter the HEX color value for an option background color.', THEME_NAME) . 
					'<br /><a href="http://www.colorpicker.com/" target="_blank">' . __('Where can I get the HEX value for my color?', THEME_NAME) . '</a>';
		$comment2 = $design_settings_settings->format_comment($comment2);
		$row = array(__('Background color', THEME_NAME) . $comment, "#" . $design_settings_settings->settings_input('background_color') . $comment2);
		$design_settings_settings->setting_row($row);

		$comment = __('Add your content. This may include any text or images you choose. HTML and shortcodes are allowed.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Content', THEME_NAME), $design_settings_settings->settings_textarea('content', $keys) . $comment);
		$design_settings_settings->setting_row($row);

	echo '</table>';

	// key for this data type is generated at random when adding new slides.
	echo '<input type="hidden" name="key" value="'. $design_settings_settings->get_val('key') .'" />'; // Normal way causes error --> $design_settings_settings->settings_hidden('index'); 

	// save button
	$design_settings_settings->settings_save_button(__('Save Top Graphic', THEME_NAME), 'button-primary');	

	echo '<br /><br />';

else:	// There is no else for this yet...


	// nothing here.

	
endif;




?>