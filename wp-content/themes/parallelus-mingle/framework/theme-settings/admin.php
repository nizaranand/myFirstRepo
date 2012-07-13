<?php

global $theme_settings_settings, $theme_settings;

//	echo '<pre>Post:';
//	print_r($_POST);
//	echo '</pre>';

$required = '<em class="required">' . __('Required', THEME_NAME) . '</em>';
$_data = $theme_settings_settings->data;


switch ($theme_settings_settings->navigation) {
case 'contact_field':

	$keys = $theme_settings_settings->keys;
		
	
	// Set up the navigation
	if (!($navtext = $theme_settings_settings->get_val('label'))) $navtext = __('Create new', THEME_NAME);
	$theme_settings_settings->navigation_bar(array(__('Contact Field', THEME_NAME) . ': ' . $navtext));

	echo '<p>' . __('You can create new fields to add to your contact form.', THEME_NAME) . '</p>';

	$form_link = array('navigation' => 'options', 'keys' => $keys[0] . ',options', 'action_keys' => $keys, 'action' => 'save');
	$theme_settings_settings->settings_form_header($form_link);
	
	?>
	
	<h3><?php _e('Field Options', THEME_NAME); ?></h3>
	<table class="form-table">
	<?php
		$comment = __('The name of the field as it will be displayed in the form.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Field title', THEME_NAME) . $required, $theme_settings_settings->settings_input('label') . $comment);
		$theme_settings_settings->setting_row($row);
	
		$comment = __('This key is used to add the field to contact forms.', THEME_NAME);
		if ($val = $theme_settings_settings->get_val('key')) {
			$comment .= ' ' . sprintf( __('For example, you can use %s to include the field in a form.', THEME_NAME), '<code>[contact_form fields="' . $val . '" ]</code>' ); 
		}
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Field key (unique identifier)', THEME_NAME) . $required, $theme_settings_settings->settings_input('key') . $comment);
		$theme_settings_settings->setting_row($row);

		$comment = __('You can add instructions or information for the user about this field. HTML code is allowed.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Caption', THEME_NAME), $theme_settings_settings->settings_textarea('caption') . $comment);
		$theme_settings_settings->setting_row($row);
	
		$field_set = array( 
			'text' => 'Text', 
			'textarea' => 'Textarea', 
			'select' => 'Select', 
			'radio' => 'Radio button (set)', 
			'checkbox' => 'Checkbox',
			'hidden' => 'Hidden'
		);
		$field_comments = array(
			'text' => 'A simple one line text input.', 
			'textarea' => 'Plain text box for multiple lines fo text.', 
			'select' => 'A select list (drop down), using the names/values specified in the "Values" field below.', 
			'radio' => 'A radio button set, where the user can select a single option. The list of values is specifed below.', 
			'checkbox' => 'Single checkbox.',
			'hidden' => 'A hidden field not seen by the user. Specify the value in the field below.'
		);
		$comment = '';
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Field type', THEME_NAME) . $comment, $theme_settings_settings->settings_radiobuttons('field_type', $field_set, $field_comments));
		$theme_settings_settings->setting_row($row);
		
		$comment = __('Set the value of hidden fields here or they will contain no information.<br /><br />If your selected field type requires pre-defined options, such as radio buttons or select boxes, enter the values here as a comma separated list. For example, your values could be entered as <code>Good, Better, Best</code>.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Values (if applicable)', THEME_NAME), $theme_settings_settings->settings_input('values') . $comment);
		$theme_settings_settings->setting_row($row);

		$comment = __('Require users to enter a value?', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Required', THEME_NAME), $theme_settings_settings->settings_bool('required', $keys) . $comment);
		$theme_settings_settings->setting_row($row);

		$comment = __('Enter an optional error message for empty fields that are required.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Required error message', THEME_NAME) . $required, $theme_settings_settings->settings_input('error_required') . $comment);
		$theme_settings_settings->setting_row($row);

		$comment = __('You can optionally specify a minimum number of characters allowed for this field.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Minimum length', THEME_NAME), $theme_settings_settings->settings_input('minlength') . $comment);
		$theme_settings_settings->setting_row($row);

		$comment = __('You can optionally specify a maximum number of characters allowed for this field.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Maximum length', THEME_NAME), $theme_settings_settings->settings_input('maxlength') . $comment);
		$theme_settings_settings->setting_row($row);

		$field_set = array( 
			'' => '', 
			'email' => 'Email address', 
			'url' => 'Website address (URL)', 
			'date' => 'Date',
			'digits' => 'Numbers only'
		);
		$comment = __('You can apply validation to some fields to ensure valid entries.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Validation', THEME_NAME) . $comment, $theme_settings_settings->settings_select('validation', $field_set));
		$theme_settings_settings->setting_row($row);
		
		$comment = __('Enter an optional error message for fields that fail validation.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Validation error message', THEME_NAME) . $required, $theme_settings_settings->settings_input('error_validation') . $comment);
		$theme_settings_settings->setting_row($row);
		
		$comment = __('Optional. You can specify the width of the field in pixels. Does not apply to some input types.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Input width', THEME_NAME), $theme_settings_settings->settings_input('size,width') . $comment);
		$theme_settings_settings->setting_row($row);

		$comment = __('Optional. You can specify the height of the field in pixels. Does not apply to some input types.', THEME_NAME);
		$comment = $theme_settings_settings->format_comment($comment);
		$row = array(__('Input height', THEME_NAME), $theme_settings_settings->settings_input('size,height') . $comment);
		$theme_settings_settings->setting_row($row);

	?>
	</table>

	<?php
	
	// Save button
	$theme_settings_settings->settings_save_button(__('Save Settings', THEME_NAME), 'button-primary');	
	
	echo '<br /><br />';
	
		
// END - case 'contact_form'
break;  
default:
// DEFAULT - Theme Settings Page

	$keys = $theme_settings_settings->keys;
	$importing = ($keys[0] == '_plugin_saved') ? true : false; // are we currently trying to import saved settings?
	
	// Check for saved data to import
	$current_import_key = $theme_settings_settings->get_val('import_key', $keys);
	$current_version_key = $theme_settings_settings->get_val('version_key', $keys);

	if ( !empty($_data['_plugin_saved']) && $keys[0] != '_plugin_saved' ) {

		//$title = __('Saved data', THEME_NAME);
		//echo '<h3>' . $title . '</h3>';
		
		foreach ($_data['_plugin_saved'] as $key => $item) {
			$import_version_key = $item['version_key'];
			// Is this overwritten?
			if ( $current_import_key == $import_version_key ) {
				$importStatus = 'old'; // already imported or chose to ignore saved file
			}else {
				if ( $current_version_key == $import_version_key ) {
					$importStatus = 'same'; // probably just created a saved file and the person wants to test if it was recognized. 
				} else {
					$importStatus = 'new'; // we have a new saved file that needs to be imported or discarded
				}
			}
			if ($importStatus == 'same' || $importStatus == 'new') {
				$import_link = array('navigation' => 'options', 'action' => 'edit', 'keys' => '_plugin_saved,'.$key);
				//$ignore_link = array('navigation' => 'options', 'action' => 'edit', 'keys' => '_plugin_saved,'.$key);
				//$message = __('A saved data file was found. What would you like to do? &nbsp; %s &nbsp; | &nbsp; %s', THEME_NAME);
				$message = __('A saved data file was found. What would you like to do? &nbsp; %s', THEME_NAME);
				$option_1 = $theme_settings_settings->settings_link(__('View data for import', THEME_NAME), $import_link);
				//$option_2 = $theme_settings_settings->settings_link(__('Ignore and hide this message', THEME_NAME), $import_link);
				//echo '<div class="updated fade"><p><strong>' . sprintf( $message, $option_1, $option_2 ) . '</strong></p></div>';
				echo '<div class="updated fade"><p><strong>' . sprintf( $message, $option_1 ) . '</strong></p></div>';
			}
		}
	}


	if (!$importing) {
		echo '<p>' . __('Configure the options below to set the theme-specific functionality as needed for your site.') . '</p>';
	}

	$theme_settings_settings->settings_form_header(array('action' => 'save', 'keys' => '_plugins,options', 'action_keys' => '_plugins,options'));
	
?>


	<a name="options_blog"></a>
	<h3><?php _e('Blog', THEME_NAME); ?></h3>
	<p><?php _e('Control the display of blog pages, posts and the content of these pages.' ,THEME_NAME); ?></p>
	<!--<div class="meta-box-sortables metabox-holder">
		<div class="postbox">
			<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Options', THEME_NAME); ?></span></h3>
			<div class="inside" style="display: none;">-->
				<table class="form-table">
				<?php
					$comment = __('Include the author name in blog posts.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Show author name', THEME_NAME), $theme_settings_settings->settings_bool('show_author_name', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment = __('Include the posted date in blog posts.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Show post date', THEME_NAME), $theme_settings_settings->settings_bool('show_post_date', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Include the comment count and a link to the form in blog posts.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Show comments link', THEME_NAME), $theme_settings_settings->settings_bool('show_comments_link', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment = __('Include a list of categories for each post in its description.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Show categories', THEME_NAME), $theme_settings_settings->settings_bool('show_categories', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment = __('Include a list of tags for each post in its description.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Show tags', THEME_NAME), $theme_settings_settings->settings_bool('show_tags', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Show featured image for each article on the blog page?', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Images on blog lists', THEME_NAME), $theme_settings_settings->settings_bool('blog_show_image', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Show featured image for current post on the single post page. Some content may not display properly using this setting, such as bulleted lists at the very beginning of your post. If this happens, disable the setting and add images to the page from the content editor.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Featured image on post', THEME_NAME), $theme_settings_settings->settings_bool('post_show_image', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('The default post image width. This can also be set from the blog shortcode or in a single post.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Post image width', THEME_NAME), $theme_settings_settings->settings_input('post_image_width', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('The default post image height. This can also be set from the blog shortcode or in a single post.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Post image height', THEME_NAME), $theme_settings_settings->settings_input('post_image_height', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Show content excerpts on your blog pages. Selecting "No" will display the full post in your post list.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Use post excerpts', THEME_NAME), $theme_settings_settings->settings_bool('use_post_excerpt', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('The number of words in post excerpts, 250 max. Custom excerpts are not restricted by this setting.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Post excerpt length', THEME_NAME), $theme_settings_settings->settings_input('excerpt_length', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Optional link after post excerpts. Enter desired text for the link or for no link, leave blank or set to "-1".', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('"Read more..." link', THEME_NAME), $theme_settings_settings->settings_input('read_more_text', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
				?>
				</table>
			<!--</div>
		</div>
	</div>-->
	<div class="hr"></div>



	<a name="options_contact"></a>
	<h3><?php _e('Contact Form', THEME_NAME); ?></h3>
	<p><?php _e('Display your form with the <code>[contact_form]</code> shortcode. You can customize each instance with unique values for <code>to</code>, <code>subject</code> and <code>thankyou</code> in the form. Empty fields use the default settings established in the fileds below.' ,THEME_NAME); ?></p>
	<!--<div class="meta-box-sortables metabox-holder">
		<div class="postbox">
			<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Options', THEME_NAME); ?></span></h3>
			<div class="inside" style="display: none;">-->
				<table class="form-table">
				<?php
					$comment = __('The default address to deliver messages sent from contact forms. For example: ', THEME_NAME) . '<code>' . get_option('admin_email') . '</code>';
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Email To', THEME_NAME), $theme_settings_settings->settings_input('contact_form,to', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Enter the default email subject for contact form messages.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Subject', THEME_NAME), $theme_settings_settings->settings_input('contact_form,subject', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment = __('The "thank you" message visitors will see after sending. HTML is allowed.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Thank You Message', THEME_NAME), $theme_settings_settings->settings_textarea('contact_form,thankyou', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment = __('The text to appear on the send button. Default: "Send"', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Button text', THEME_NAME), $theme_settings_settings->settings_input('contact_form,button', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Require CAPTCHA image verification?', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$sample = '<p><img src="'. FRAMEWORK_URL .'/utilities/captcha/captcha.php?_'. base_convert(mt_rand(0x1679616, 0x39AA3FF), 10, 36) .'" id="captcha" /></p>' . __('Sample image. <a href="#" onclick="document.getElementById(\'captcha\').src=\''. FRAMEWORK_URL .'/utilities/captcha/captcha.php?_\'+Math.random(); return false;" id="refreshCaptcha">Refresh?</a>', THEME_NAME);
					$row = array(__('Use CAPTCHA', THEME_NAME), $theme_settings_settings->settings_bool('contact_form,captcha', $keys) . $comment . $sample);
					$theme_settings_settings->setting_row($row);
			
					// Look up user created fields
					$fields = $theme_settings_settings->get_val('contact_fields', $keys);
					
					// Create sample shortcodes
					$code  = 	'<p><code>[contact_form]</code></p>';
					$code .=	'<p><code>[contact_form '.
								'to="'. str_replace('"', '\"', $theme_settings_settings->get_val('contact_form,to', $keys)) . '" ' .
								'subject="'. str_replace('"', '\"', $theme_settings_settings->get_val('contact_form,subject', $keys)) . '" ' .
								'thankyou="'. str_replace('"', '\"', $theme_settings_settings->get_val('contact_form,thankyou', $keys)) . '" ' .
								'button="'. str_replace('"', '\"', $theme_settings_settings->get_val('contact_form,button', $keys)) . '" ';
								// check for captcha
								$hasCaptcha = $theme_settings_settings->get_val('contact_form,captcha', $keys);
								if ($hasCaptcha) {
									$code .= 'captcha="yes" ';
								}
					$code .=	']</code></p>';
								
					// If we have user created fields...
					if (!empty($fields)) {
						// Print another shortcode sample with ALL custom fields
						$field_keys = array();
						foreach((array) $fields as $key => $item) {
							if (!$key) continue;
							array_push($field_keys, $item['key']);
						}
						// Add another shortcode
						$code .=	'<p><code>[contact_form fields="'. implode(",", $field_keys) . '"]</code></p>';
					}
					$comment = __('Above are examples of how you can add the shortcode to your content. ', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Shortcodes', THEME_NAME), $code . $comment);
					$theme_settings_settings->setting_row($row);
				?>
				</table>
			<!--</div>
		</div>
	</div>-->

	<table class="form-table no-last-width first-width-">
		<?php 
		$titles = array(
					__('Field', THEME_NAME), 
					__('Shortcode key', THEME_NAME), 
					__('Type', THEME_NAME), 
					__('Required', THEME_NAME), 
					__('Actions', THEME_NAME)
					);
		$theme_settings_settings->table_header($titles);
		$nbr = 0;
		
		// Show "no fields" message if data is empty.
		if (empty($fields)) {
			$data = array(__('No fields created.', THEME_NAME), '', '', '', '');//, '');
			$theme_settings_settings->table_row($data, $nbr);
		}
		
		// Loop through the fileds and print the rows
		$total = count($fields);
		foreach((array) $fields as $key => $item) {
			if (!$key) continue;
			$label = stripslashes($item['label']);
			//$keys = $theme_settings_settings->keys;  // should be a problem. probably need to specify the keys.
			$akeys = $keys[0] . ',' . $keys[1] . ',contact_fields,' . $key; // '_plugin,options,contact_fields,' .  $key;
			$edit_link = array('navigation' => 'contact_field', 'action' => 'edit', 'keys' => $akeys);
			$delete_link = array('navigation' => 'options', 'action' => 'delete','keys' => $keys, 'class' => 'more-common-delete', 'action_keys' => $akeys);
			$row = array(	
					$theme_settings_settings->settings_link($label, $edit_link) . $warning,
					$item['key'],
					ucfirst($item['field_type']),
					($item['required'] == 1) ? 'Yes' : "&nbsp;",
					$theme_settings_settings->settings_link('Edit', $edit_link) . ' | ' .
					$theme_settings_settings->settings_link('Delete', $delete_link) . 
					$theme_settings_settings->updown_link($nbr, $total, array('keys' => $keys, 'action_keys' => '_plugin,options,contact_fields')) //array($box, 'fields')))
			);
	
			$theme_settings_settings->table_row($row, $nbr);
			$nbr++;				
		}
		?>
		</tbody>
			<tfoot>
				<tr>
				<th colspan="<?php echo count($titles); ?>">
				<?php
					$new_key = array('_plugin', 'options', 'contact_fields', $theme_settings_settings->add_key);
					$options = array('action' => 'add', 'navigation' => 'contact_field', 'keys' => $new_key, 'class' => 'button');
					echo '<p>' . $theme_settings_settings->settings_link('Add new Field', $options) . '</p>';
				?>
				</th>
				</tr>
			</tfoot>
		</table>
		
	<?php echo $theme_settings_settings->settings_hidden('contact_fields'); ?>
	<div class="hr"></div>
	
	

	<a name="options_special"></a>
	<h3><?php _e('Special Features', THEME_NAME); ?></h3>
	<p><?php _e('The theme has optional settings for advanced functionality and effects. These can be configured as desired using the settings below. Some options can be enabled/disabled for specific browsers that don\'t support advanced functionality. If you are having performance issues on your site you may be able to fix them by modifying the settings below.' ,THEME_NAME); ?></p>
	<!--<div class="meta-box-sortables metabox-holder">
		<div class="postbox">
			<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Options', THEME_NAME); ?></span></h3>
			<div class="inside" style="display: none;">-->
				<table class="form-table">
				<?php
					$field_set = array( 
						'all' => 'Full Page', 
						'content' => 'Content Area Only (middle)',
						'none' => 'Disabled'
					);
					$filed_comments = array(
						//'all' => 'The entire page will fade in quickly.', 
						//'content' => 'Only the content area in the middle of the page.',
						//'none' => 'Do not fade in page content.'
					);
					$comment = __('Page loading effect. Not available for IE6-8.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Fade In Page Content', THEME_NAME) . $comment, $theme_settings_settings->settings_radiobuttons('fade_in_content', $field_set, $filed_comments));
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Adds support for rounded corners, shadows, etc. in IE6-8.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$comment_2 = __('Page loading will be slower in IE6-8. If you experience errors try disable this setting.', THEME_NAME);
					$comment_2 = $theme_settings_settings->format_comment($comment_2);
					$row = array(__('Advanced IE Styling', THEME_NAME) . $comment, $theme_settings_settings->settings_bool('advanced_ie_styles', $keys) . $comment_2);
					$theme_settings_settings->setting_row($row);
				?>
				</table>
			<!--</div>
		</div>
	</div>-->
	<div class="hr"></div>



	<a name="options_misc"></a>
	<h3><?php _e('Miscellaneous', THEME_NAME); ?></h3>
	<p><?php _e('Various settings related to your site setup and functionality.' ,THEME_NAME); ?></p>
	<!--<div class="meta-box-sortables metabox-holder">
		<div class="postbox">
			<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Options', THEME_NAME); ?></span></h3>
			<div class="inside" style="display: none;">-->
				<table class="form-table">
				<?php
					$comment =	__('Enter the full URL to your favorites (shortcut) icon file. For example: ', THEME_NAME) . 
								'<br /><code>'. trailingslashit(get_bloginfo('url')) .'wp-content/uploads/'. date('Y') .'/'. date('m') .'/favicon.ico</code>';
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Favorites Icon', THEME_NAME), $theme_settings_settings->settings_input('favorites_icon', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment =	__('This icon is used by Android (v2.1+) and iPhones to display home screen bookmarks.<br />Recommended image size ' .
								'<code>129 x 129</code>, saved in <code>PNG</code> format.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Mobile Bookmark Icon', THEME_NAME), $theme_settings_settings->settings_input('apple_touch_icon', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment =	__('Optional text appended to browser titlebar. Should start with separator, e.g., " - My Site Name".' . 
								'<br /><strong>Note:</strong> This text will only apear on sub-pages and not the home page of your site.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Append to Browser Title', THEME_NAME), $theme_settings_settings->settings_input('append_to_title', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
			
					$comment = __('Show placeholder images for posts and portfolio items without images attached.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Placeholder Images', THEME_NAME), $theme_settings_settings->settings_bool('placeholder_images', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment =	__('Enter the full image URL, for example: ', THEME_NAME) . 
								'<br /><code>'. trailingslashit(get_bloginfo('url')) .'wp-content/uploads/'. date('Y') .'/'. date('m') .'/placeholder.jpg</code>';
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Custom Placeholder Image', THEME_NAME), $theme_settings_settings->settings_input('custom_placeholder', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment = __('Select the page to display for "404" or  "Not Found" errors.', THEME_NAME);
					$comment = $theme_settings_settings->format_comment($comment);
					$pages = $theme_settings_settings->get_pages('Select a page');
					$row = array(__('Error Page (404)', THEME_NAME), $theme_settings_settings->settings_select('404_page', $pages));
					$theme_settings_settings->setting_row($row);
			
					$comment =	__('Enter your Google Analytics tracking ID. For example: <code>UA-XXXXX-X</code>', THEME_NAME) .'<br />'.
								'<a href="http://www.google.com/support/analytics/bin/answer.py?hl=en&answer=55603">'. __('Where can I find my tracking code?', THEME_NAME) .'</a> ' .
								__('Don\'t have a Google Analytics account? ', THEME_NAME) .'<a href="http://www.google.com/analytics/">'. __('Sign up free', THEME_NAME) .'.</a>';
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Google Analytics', THEME_NAME), $theme_settings_settings->settings_input('google_analytics', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
					
					$comment = sprintf(__('Enable auto paragraph and break tags on WordPress editor content (%swpautop%s). Turning this off may solve common layout and vertical spacing issues.', THEME_NAME), '<a href="http://codex.wordpress.org/Function_Reference/wpautop" target="blank">', '</a>');
					$comment = $theme_settings_settings->format_comment($comment);
					$row = array(__('Auto Paragraphs (wpautop)', THEME_NAME), $theme_settings_settings->settings_bool('wpautop', $keys) . $comment);
					$theme_settings_settings->setting_row($row);
				?>
				</table>
			<!--</div>
		</div>
	</div>-->
	<!--<div class="hr"></div>-->




	<?php 
	// Developer theme options. These can be disabled from the theme "functions.php" by setting "$developer_options = false;"
	if ( $GLOBALS['developer_options'] === false) :		// ($ == false) default OFF, ($ === false) default ON 
	
		// Developer options disabled
		// --------------------------
		// to prevent losing the data field values must be inserted in a hidden field.	

		// developer fields
		echo $theme_settings_settings->settings_hidden('developer_custom_fields'); 
		echo $theme_settings_settings->settings_hidden('developer_custom_fields_access'); 
		echo $theme_settings_settings->settings_hidden('access_theme_design'); 
		// branding fields
		echo $theme_settings_settings->settings_hidden('branding_admin_logo'); 
		echo $theme_settings_settings->settings_hidden('branding_admin_help_tab_content'); 
		echo $theme_settings_settings->settings_hidden('branding_admin_custom_right_column_title'); 
		echo $theme_settings_settings->settings_hidden('branding_admin_custom_right_column'); 
		echo $theme_settings_settings->settings_hidden('branding_admin_right_column_theme_settings'); 
		echo $theme_settings_settings->settings_hidden('branding_admin_right_column_design_settings'); 
		
		
	else :

		echo	'<br />' .
				'<h2>'. __('Developer Features', THEME_NAME) .'</h2>' . 
				'<div class="hr"></div>';
				
		echo	'<p>'.__('The features below are provided for developers to customize the theme options panels as needed. This area can be hidden from users by setting <code>$developer_options = false;</code> in the file <code>function.php</code>.', THEME_NAME).'</p>';
	
	
		// Developer optons enabled
		// ------------------------	 ?>
		
		<a name="options_dev"></a>
		<h3><?php _e('Developer', THEME_NAME); ?></h3>
		<p><?php _e('Advanced options for admin permissions and theme setup. After making changes to these settings it may require an additional refresh of the page before you see the changes.' ,THEME_NAME); ?></p>
		<div class="meta-box-sortables metabox-holder">
			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Developer Options', THEME_NAME); ?></span></h3>
				<div class="inside" style="display: none;">
					<table class="form-table">
					<?php
						$roles = $theme_settings_settings->get_roles();
	
						// Section title
						$warning =  __('<strong>WARNING</strong>: These options are for advanced users only. Changes made using the features in this area, or the tools they enable are your responsability. If you experience problems <u>no support will be provided</u>.', THEME_NAME);
						$warning = '<span class="warning">'. $theme_settings_settings->format_comment($warning) .'</span>';
						$row = array(__('<strong>Developer Tools</strong>', THEME_NAME), $warning);
						$theme_settings_settings->setting_row($row);
						
						$comment = __('Create and edit custom fields in posts and pages from your admin.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Custom Fields Manager', THEME_NAME), $theme_settings_settings->settings_bool('developer_custom_fields', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
		
							$comment = __('Minimum access level required. All roles above selection will also have access to Custom Fields Manager.', THEME_NAME);
							$comment = $theme_settings_settings->format_comment($comment);
							$row = array('', $theme_settings_settings->settings_radiobuttons('developer_custom_fields_access', $roles) . $comment);
							$theme_settings_settings->setting_row($row);
	
						/*$comment = __('Create and edit custom "post types" from your admin.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Content Types Manager', THEME_NAME), $theme_settings_settings->settings_bool('developer_custom_content_types', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
	
							$comment = __('Minimum access level required. All roles above selection will also have access to Content Types Manager.', THEME_NAME);
							$comment = $theme_settings_settings->format_comment($comment);
							$row = array('', $theme_settings_settings->settings_radiobuttons('developer_custom_content_types_access', $roles) . $comment);
							$theme_settings_settings->setting_row($row);
		
						$comment = __('Create and edit post taxonomies (categories, tags, etc.) from your admin.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Taxonomies Manager', THEME_NAME), $theme_settings_settings->settings_bool('developer_custom_taxonomies', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
	
							$comment = __('Minimum access level required. All roles above selection will also have access to Taxonomies Manager.', THEME_NAME);
							$comment = $theme_settings_settings->format_comment($comment);
							$row = array('', $theme_settings_settings->settings_radiobuttons('developer_custom_taxonomies_access', $roles) . $comment);
							$theme_settings_settings->setting_row($row);*/
	
						// Section title
						$row = array(__('<strong>User Permissions</strong>', THEME_NAME), '&nbsp;');
						$theme_settings_settings->setting_row($row);
	
						/*$comment = __('<code>Settings &raquo; Theme Settings</code><br />Roles allowed to manage theme settings.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$roles = $theme_settings_settings->get_roles();
						$row = array(__('Theme settings', THEME_NAME) . $comment, $theme_settings_settings->checkbox_list('access_theme_settings', $roles));
						$theme_settings_settings->setting_row($row);*/
	
						$comment = __('<code>Appearance &raquo; Design</code><br />Roles allowed to manage design and layout settings.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$comment_2 = __('Minimum access level required. All roles above selection will also have access.', THEME_NAME);
						$comment_2 = $theme_settings_settings->format_comment($comment_2);
						$row = array(__('Design settings', THEME_NAME) . $comment, $theme_settings_settings->settings_radiobuttons('access_theme_design', $roles) . $comment_2);
						$theme_settings_settings->setting_row($row);
					?>
					</table>
				</div>
			</div>
		</div>
		<div class="hr"></div>
	
	
		
		<a name="options_branding"></a>
		<h3><?php _e('Branding and Admin', THEME_NAME); ?></h3>
		<p><?php _e('Features to enable re-branding of theme options, help content, etc. After making changes to these settings it may require an additional refresh of the page before you see the changes.' ,THEME_NAME); ?></p>
		<div class="meta-box-sortables metabox-holder">
			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Branding Options', THEME_NAME); ?></span></h3>
				<div class="inside" style="display: none;">
					<table class="form-table">
					<?php
						$comment = __('For branding the top right area of theme options pages.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Theme Options Logo', THEME_NAME), $theme_settings_settings->settings_input('branding_admin_logo', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
		
						//$comment = __('Replaces the  WordPress logo in the admin header.', THEME_NAME);
						//$comment = $theme_settings_settings->format_comment($comment);
						//$row = array(__('Admin Logo', THEME_NAME), $theme_settings_settings->settings_input('branding_admin_header_logo', $keys) . $comment);
						//$theme_settings_settings->setting_row($row);
	
						//$comment = __('The title of the "Theme Help" tab on the top right.', THEME_NAME);
						//$comment = $theme_settings_settings->format_comment($comment);
						//$row = array(__('Theme Help Tab - Title', THEME_NAME), $theme_settings_settings->settings_input('branding_admin_help_tab_title', $keys) . $comment);
						//$theme_settings_settings->setting_row($row);
	
						$comment = __('The content of the "Theme Help" tab on the top right. HTML is allowed.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Theme Help Tab - Content', THEME_NAME), $theme_settings_settings->settings_textarea('branding_admin_help_tab_content', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
	
						$comment = __('The title for an optional custom right column container for you to add your own information.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Right container title', THEME_NAME), $theme_settings_settings->settings_input('branding_admin_custom_right_column_title', $keys) . $comment);
						$theme_settings_settings->setting_row($row);

						$comment = __('The content for an optional custom right column container for you to add your own information. HTML is allowed.', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Right container content', THEME_NAME), $theme_settings_settings->settings_textarea('branding_admin_custom_right_column', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
						
						$comment = __('Do you want the default theme settings container to show in the right column?', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Show theme settings<br />(right column)', THEME_NAME), $theme_settings_settings->settings_bool('branding_admin_right_column_theme_settings', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
						
						$comment = __('Do you want the default design settings container to show in the right column?', THEME_NAME);
						$comment = $theme_settings_settings->format_comment($comment);
						$row = array(__('Show design settings<br />(right column)', THEME_NAME), $theme_settings_settings->settings_bool('branding_admin_right_column_design_settings', $keys) . $comment);
						$theme_settings_settings->setting_row($row);
					?>
					</table>
				</div>
			</div>
		</div>
		<div class="hr"></div>

		<?php 
		
	endif; // developer otions on/off
			
	// export button
	if (!$importing) {
		$options = array('navigation' => 'export', 'keys' => $keys, 'class' => 'button');
		echo '<div style="float: right;">' . $theme_settings_settings->settings_link(__('Export Settings', THEME_NAME), $options) . '</div>';
	}
	
	// save button
	$buttonLabel = ($importing) ? __('Import Settings', THEME_NAME) : __('Save Settings', THEME_NAME);
	$theme_settings_settings->settings_save_button($buttonLabel, 'button-primary');	

	
	echo '<br /><br />';


// END - DEFAULT
break; }  
// END - switch ($theme_settings_settings->navigation) 

	//echo '<pre>';
	//print_r($theme_settings_settings->data);
	//echo '</pre>';

?>