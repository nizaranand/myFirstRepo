<style type="text/css">
	form textarea.input-textarea { width: 100% !important; height: 200px !important; }
</style>
<?php


$keys = $design_settings_settings->keys;
$data = $design_settings_settings->data;

// Setup defaults from other areas
$slideshows = $design_settings_settings->get_val('slideshows', '_plugin');
$slideshows_saved = $design_settings_settings->get_val('slideshows', '_plugin_saved');
$slideshows = array_merge((array)$slideshows_saved, (array)$slideshows);

$top_graphics = $design_settings_settings->get_val('top_graphics', '_plugin');
$top_graphics_saved = $design_settings_settings->get_val('top_graphics', '_plugin_saved');
$top_graphics = array_merge((array)$top_graphics_saved, (array)$top_graphics);

$sidebars = $design_settings_settings->get_val('sidebars', '_plugin');
$sidebars_saved = $design_settings_settings->get_val('sidebars', '_plugin_saved');
$sidebars = array_merge((array)$sidebars_saved, (array)$sidebars);


$select_header_content = array('' => 'None');
if (!empty($slideshows)) {
	foreach ($slideshows as $ss) {
		$select_header_content['ss,'.$ss['key']] = __('Slide show: ', THEME_NAME).$ss['label'];
	}
}
if (!empty($top_graphics)) {
	foreach ($top_graphics as $hg) {
		$select_header_content['hg,'.$hg['index']] = __('Top graphic: ', THEME_NAME).$hg['label'];
	}
}

$select_sidebar = array();
if (!empty($sidebars)) {
	foreach ($sidebars as $item) {
		$select_sidebar[$item['key']] = $item['label'];
	}
}


// PAGE HEADER SETUP
if ( $design_settings_settings->navigation == 'page_header') :



	// Set up the navigation
	if (!($navtext = $design_settings_settings->get_val('label'))) $navtext = __('Create new', THEME_NAME);
	$design_settings_settings->navigation_bar(array(__('Page header', THEME_NAME) . ': ' . $navtext));

	echo '<p>' . __('Create a new page header.', THEME_NAME) . '</p>';

	$form_link = array('navigation' => 'page_headers', 'action_keys' => $keys, 'action' => 'save');
	$design_settings_settings->settings_form_header($form_link);
	
	?>
	<table class="form-table">
	<?php
	
		$comment = __('This name is for reference only.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Title', THEME_NAME) . $required, $design_settings_settings->settings_input('label') . $comment);
		$design_settings_settings->setting_row($row);

		$comment = __('Optional. Override your default logo for this header. Enter full image URL.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Alternate logo', THEME_NAME), $design_settings_settings->settings_input('logo') . $comment);
		$design_settings_settings->setting_row($row);

		$option_set = array( 
			'left' => __('Left', THEME_NAME), 
			'right' => __('Right', THEME_NAME) 
		);
		$option_comments = array();
		$comment = __('The main menu supports 2 menus, one on either side. Enable or disable the desired locations. ', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Menus', THEME_NAME) . $comment, $design_settings_settings->checkbox_list('menus', $option_set, $option_comments));
		$design_settings_settings->setting_row($row);

		$field_set = array( 
			'page' => __('Page width (default)', THEME_NAME), 
			'full' => __('Full width', THEME_NAME)
		);
		$field_comments = array();
		$comment = __('The menu container can be page width or span the full browser width. ', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Menu width', THEME_NAME) . $comment, $design_settings_settings->settings_radiobuttons('menu_width', $field_set, $field_comments));
		$design_settings_settings->setting_row($row);
		
		$select = $select_sidebar;
		$comment = __('The top right area of the header is widget ready. Select the sidebar to populate this content area..', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Top sidebar', THEME_NAME), $design_settings_settings->settings_select('top_sidebar', $select) . $comment);
		$design_settings_settings->setting_row($row);

		$headerContent = $select_header_content;
		$comment = __('The header area can display slide shows, top graphics or nothing. Select the source for this header. ', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Primary content', THEME_NAME), $design_settings_settings->settings_select('content', $headerContent));
		$design_settings_settings->setting_row($row);

		$field_set = array( 
			'curve' => __('Curve', THEME_NAME), 
			'curve-showcase' => __('Curve - showcase only', THEME_NAME), 
			'straight' => __('Straight', THEME_NAME), 
			'full-width' => __('Full width', THEME_NAME)
		);
		$field_comments = array(
			'curve' => __('Adds a curved effect between the primary header content and showcase area. The curve extends into the page background.', THEME_NAME), 
			'curve-showcase' => __('The curve effect, but does not extend into page background.', THEME_NAME), 
			'straight' => __('No curve.', THEME_NAME), 
			'full-width' => __('Showcase and header area spans the full browser width. No curve.', THEME_NAME)
		);
		$comment = __('The look to use for this header. Curve effect, full width, etc?', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Page style', THEME_NAME) . $comment, $design_settings_settings->settings_radiobuttons('curve_style', $field_set, $field_comments));
		$design_settings_settings->setting_row($row);

		$field_set = array( 
			'closed' => __('Use background contaner', THEME_NAME), 
			'open' => __('No container', THEME_NAME)
		);
		$field_comments = array();
		$comment = __('Use a container (background graphic) or leave content "open" as part of the page.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Showcase background', THEME_NAME) . $comment, $design_settings_settings->settings_radiobuttons('showcase_background', $field_set, $field_comments));
		$design_settings_settings->setting_row($row);

		$comment = __('The showcase area appears immediately below the slide show. This may include any text or images you choose. HTML and shortcodes are allowed.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Showcase content', THEME_NAME), $design_settings_settings->settings_textarea('showcase_content', $keys) . $comment);
		$design_settings_settings->setting_row($row);


	echo '</table>';

	// key for this data type is generated at random when adding new slides.
	echo '<input type="hidden" name="key" value="'. $design_settings_settings->get_val('key') .'" />'; // Normal way causes error --> $design_settings_settings->settings_hidden('index'); 

	// save button
	$design_settings_settings->settings_save_button(__('Save Header', THEME_NAME), 'button-primary');	

	?>
	<br /><br />
	
	<script type="text/javascript">
	
	jQuery(document).ready(function($) {
		

		// enable/disable background options for conflicting showcase setting
		jQuery("input[name='curve_style']").change( function() {
			var $style = jQuery("input[name='showcase_background'][value='open']");
			if (jQuery(this).val() == 'curve-showcase') {
				$style.attr("disabled", "disabled").parent('label').addClass('disabled');
				if ($style.is(':checked')) {
					jQuery("input[name='showcase_background'][value='closed']").attr('checked', true);
				}
			} else {
				$style.removeAttr("disabled").parent('label').removeClass('disabled');
			}
		});
		// enable/disable showcase options for conflicting background setting
		jQuery("input[name='showcase_background']").change( function() {
			var $style = jQuery("input[name='curve_style'][value='curve-showcase']");
			if (jQuery(this).val() == 'open') {
				$style.attr("disabled", "disabled").parent('label').addClass('disabled');
				if ($style.is(':checked')) {
					jQuery("input[name='curve_style'][value='straight']").attr('checked', true);
				}
			} else {
				$style.removeAttr("disabled").parent('label').removeClass('disabled');
			}
		});


	});
	
	</script> 

	<?php


else:	// There is no else for this yet...


	// nothing here.

	
endif;



?>