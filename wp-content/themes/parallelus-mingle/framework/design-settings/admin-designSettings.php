<style type="text/css">
	form textarea.input-textarea { width: 100% !important; height: 200px !important; }
</style>
<?php

$keys = $design_settings_settings->keys;
$data = $design_settings_settings->data;

// Setup defaults from other areas
$page_headers = $design_settings_settings->get_val('page_headers', '_plugin');
$page_headers_saved = $design_settings_settings->get_val('page_headers', '_plugin_saved');
if (!empty($page_headers_saved)) {
	$page_headers = array_merge((array)$page_headers_saved, (array)$page_headers);
}

$page_footers = $design_settings_settings->get_val('page_footers', '_plugin');
$page_footers_saved = $design_settings_settings->get_val('page_footers', '_plugin_saved');
if (!empty($page_footers_saved)) {
	$page_footers = array_merge((array)$page_footers_saved, (array)$page_footers);
}

$page_layouts = $design_settings_settings->get_val('layouts', '_plugin');
$page_layouts_saved = $design_settings_settings->get_val('layouts', '_plugin_saved');
if (!empty($page_layouts_saved)) {
	$page_layouts = array_merge((array)$page_layouts_saved, (array)$page_layouts);
}

$sidebars = $design_settings_settings->get_val('sidebars', '_plugin');
$sidebars_saved = $design_settings_settings->get_val('sidebars', '_plugin_saved');
if (!empty($sidebars_saved)) {
	$sidebars = array_merge((array)$sidebars_saved, (array)$sidebars);
}

$select_header = array();
foreach ($page_headers as $item) {
	$select_header[$item['key']] = $item['label'];
}
$select_footer = array();
foreach ($page_footers as $item) {
	$select_footer[$item['key']] = $item['label'];
}
$select_layout = array();
foreach ($page_layouts as $item) {
	$select_layout[$item['key']] = $item['label'];
}
$select_sidebar = array();
foreach ($sidebars as $item) {
	$select_sidebar[$item['key']] = $item['label'];
}

	
// DEFAULT DESIGN SETTINGS
if ( $design_settings_settings->navigation == 'design_setting') :



	// Set up the navigation
	$design_settings_settings->navigation_bar(array(__('Defaults', THEME_NAME)));

	echo '<p>' . __('Configure the themes default design settings and options.', THEME_NAME) . '</p>';

	$form_link = array('navigation' => 'design_settings', 'action_keys' => $keys, 'action' => 'save');
	$design_settings_settings->settings_form_header($form_link);
	
	?>
	<table class="form-table">
	<?php
	

		// Logo
		$comment = __('Enter the full URL to your logo file. For example: ', THEME_NAME) . 
					'<br /><code>'. trailingslashit(get_bloginfo('url')) .'wp-content/uploads/'. date('Y') .'/'. date('m') .'/logo.png</code>';
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Logo', THEME_NAME), $design_settings_settings->settings_input('logo') . $comment);
		$design_settings_settings->setting_row($row);

		$comment = __('The width of the logo file.', THEME_NAME); 
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Logo width', THEME_NAME), $design_settings_settings->settings_input('logo_width') . $comment);
		$design_settings_settings->setting_row($row);

		$comment = __('The height of the logo file.', THEME_NAME); 
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Logo height', THEME_NAME), $design_settings_settings->settings_input('logo_height') . $comment);
		$design_settings_settings->setting_row($row);
		
		// Skin
		$skins = $design_settings_settings->get_skin_css();
		asort($skins);
		$select = $skins;
		$comment = __('Default skin for the theme.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Skin', THEME_NAME), $design_settings_settings->settings_select('skin', $select) . $comment );
		$design_settings_settings->setting_row($row);


		// Font
		$select = array(
			'cufon:aller' => 'Aller (cufon)',
			'cufon:blackjack' => 'BlackJack (cufon)',
			'cufon:cabin' => 'Cabin (cufon)',
			'cufon:calluna' => 'Calluna (cufon)',
			'cufon:cantarell' => 'Cantarell (cufon)',
			'cufon:capsuula' => 'Capsuula (cufon)',
			'cufon:chunkfive' => 'ChunkFive (cufon)',
			'cufon:colaborate' => 'Colaborate (cufon)',
			'cufon:daniel' => 'Daniel (cufon)',
			'cufon:droid-sans' => 'Droid Sans (cufon)',
			'cufon:droid-sans-mono' => 'Droid Sans Mono (cufon)',
			'cufon:droid-serif' => 'Droid Serif (cufon)',
			'cufon:fff-tusj' => 'FFF Tusj (cufon)',
			'cufon:journal' => 'Journal (cufon)',
			'cufon:lane' => 'Lane - Narrow (cufon)',
			'cufon:liberation-sans' => 'Liberation Sans (cufon)',
			'cufon:marketing-script' => 'Marketing Script (cufon)',
			'cufon:mentone' => 'Mentone (cufon)',
			'cufon:mido' => 'Mido (cufon)',
			'cufon:museo' => 'Museo (cufon)',
			'cufon:museo-sans' => 'Museo Sans (cufon)',
			'cufon:otari' => 'Otari (cufon)',
			'cufon:quicksand' => 'Quicksand (cufon)',
			'cufon:sansation' => 'Sansation (cufon)',
			'cufon:santana' => 'Santana (cufon)',
			'cufon:share' => 'Share (cufon)',
			'cufon:titillium-text' => 'Titillium Text (cufon)',
			'cufon:ubuntu-title' => 'Ubuntu-Title (cufon)',
			'cufon:yanone-kaffeesatz' => 'Yanone Kaffeesatz (cufon)',
			
			'standard:Arial|Helvetica|Garuda|sans-serif' => 'Arial',
			'standard:"Arial Black"|Gadget|sans-serif' => 'Arial Black',
			'standard:"Courier New"|Courier|monospace' => 'Courier New',
			'standard:Georgia|"Times New Roman"|Times| serif' => 'Georgia',
			'standard:"Lucida Console"|Monaco|monospace' => 'Lucida Console',
			'standard:"Lucida Sans Unicode"|"Lucida Grande"|sans-serif' => 'Lucida Sans Unicode',
			'standard:"Palatino Linotype"|"Book Antiqua"|Palatino|serif' => 'Palatino Linotype',
			'standard:Tahoma|Geneva|sans-serif' => 'Tahoma',
			'standard:"Times New Roman"|Times|serif' => 'Times New Roman',
			'standard:"Trebuchet MS"|Arial|Helvetica|sans-serif' => 'Trebuchet MS',
			'standard:Verdana|Geneva|sans-serif' => 'Verdana',
			
			'custom:cufon' => 'Custom - Cufon File',
			'custom:standard' => 'Custom - Font'
		);
		$comment = __('Default heading font.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$comment_custom_cufon = __('Enter the file name for your custom Cufon font.', THEME_NAME) .'<br />'. __('If saved in a different folder include the path to the file. For example: ', THEME_NAME) . 
					'<br /><code>'. trailingslashit(get_bloginfo('template_url')) .'assets/js/my-font.js</code>';
		$comment_custom_cufon = $design_settings_settings->format_comment($comment_custom_cufon);
		$comment_custom_standard =	__('Enter a font name. This should be a standard web-safe font or it may not display for all viewers.', THEME_NAME) .
									'<br /><a href="http://en.wikipedia.org/wiki/Web_typography#Web-safe_fonts" target="_blank">'. 
										__('What is a web-safe font?', THEME_NAME) . 
									'</a>';
		$comment_custom_standard = $design_settings_settings->format_comment($comment_custom_standard);
		$font_setting = $design_settings_settings->get_val('fonts,heading');
		$display_custom_cufon = ($font_setting == 'custom:cufon') ? 'block' : 'none';
		$display_custom_standard = ($font_setting == 'custom:standard') ? 'block' : 'none';
		$custom_field_cufon = '<div id="heading_cufon" style="display: '.$display_custom_cufon.';"><br />'. $design_settings_settings->settings_input('fonts,heading_cufon') . $comment_custom_cufon .'</div>';
		$custom_field_standard = '<div id="heading_standard" style="display: '.$display_custom_standard.';"><br />'. $design_settings_settings->settings_input('fonts,heading_standard') . $comment_custom_standard .'</div>';
		$row = array(__('Heading font', THEME_NAME), $design_settings_settings->settings_select('fonts,heading', $select) . $comment . $custom_field_cufon . $custom_field_standard);
		$design_settings_settings->setting_row($row);

		$select = array(
			'standard:Arial|Helvetica|Garuda|sans-serif' => 'Arial',
			'standard:"Arial Black"|Gadget|sans-serif' => 'Arial Black',
			'standard:"Courier New"|Courier|monospace' => 'Courier New',
			'standard:Georgia|"Times New Roman"|Times| serif' => 'Georgia',
			'standard:"Lucida Console"|Monaco|monospace' => 'Lucida Console',
			'standard:"Lucida Sans Unicode"|"Lucida Grande"|sans-serif' => 'Lucida Sans Unicode',
			'standard:"Palatino Linotype"|"Book Antiqua"|Palatino|serif' => 'Palatino Linotype',
			'standard:Tahoma|Geneva|sans-serif' => 'Tahoma',
			'standard:"Times New Roman"|Times|serif' => 'Times New Roman',
			'standard:"Trebuchet MS"|Arial|Helvetica|sans-serif' => 'Trebuchet MS',
			'standard:Verdana|Geneva|sans-serif' => 'Verdana',
			'custom:standard' => 'Custom'
		);
		$comment = __('Select the default font for the page body.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$comment_custom =	__('Enter a font name. This should be a standard web-safe font or it may not display for all viewers.', THEME_NAME) .
							'<br /><a href="http://en.wikipedia.org/wiki/Web_typography#Web-safe_fonts" target="_blank">'. 
								__('What is a web-safe font?', THEME_NAME) . 
							'</a>';
		$comment_custom = $design_settings_settings->format_comment($comment_custom);
		$display_custom = ($design_settings_settings->get_val('fonts,body') == 'custom:standard') ? 'block' : 'none';
		$custom_field = '<div id="custom_body_font" style="display: '.$display_custom.';"><br />'. $design_settings_settings->settings_input('fonts,body_custom') . $comment_custom .'</div>';
		$row = array(__('Body font', THEME_NAME), $design_settings_settings->settings_select('fonts,body', $select) . $comment . $custom_field);
		$design_settings_settings->setting_row($row);

	echo '</table>';

	echo '<a name="layouts"></a>';
	echo '<div class="hr"></div> <h3>'. __('Default Layout Options', THEME_NAME) .'</h3>';
	echo '<table class="form-table">';

		$select = $select_header;
		$comment = __('This header will be used for layouts without a header specified.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Header', THEME_NAME), $design_settings_settings->settings_select('layout,header', $select) . $comment);
		$design_settings_settings->setting_row($row);

		$select = $select_footer;
		$comment = __('This footer will be used for layouts without a footer specified.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Footer', THEME_NAME), $design_settings_settings->settings_select('layout,footer', $select) . $comment);
		$design_settings_settings->setting_row($row);

		$select = $select_layout;
		$comment = __('This layout will be used for any content without a layout specified.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Main Layout', THEME_NAME), $design_settings_settings->settings_select('layout,default', $select) . $comment);
		$design_settings_settings->setting_row($row);

	echo '</table>';
	
	echo '<div class="hr"></div> <h3>'. __('Templates', THEME_NAME) .'</h3>';
	echo '<table class="form-table">';

		// Home page
		$select = $select_layout;
		$comment = __('The default layout to use for the home page of the site. Only applies for "<code>Front page displays > Your latest posts</code>" (<a href="options-reading.php">Reading Settings</a>). If using "A static page" you should set your home page from the "Layout Options" box for that specific page.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Home page', THEME_NAME), $design_settings_settings->settings_select('layout,home', $select) . $comment);
		$design_settings_settings->setting_row($row);

		// Pages
		$select = $select_layout;
		$comment = __('The default layout to use for new pages.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Pages', THEME_NAME), $design_settings_settings->settings_select('layout,page', $select) . $comment);
		$design_settings_settings->setting_row($row);

		// Posts
		$select = $select_layout;
		$comment = __('The default layout to use for new posts.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Posts', THEME_NAME), $design_settings_settings->settings_select('layout,post', $select) . $comment);
		$design_settings_settings->setting_row($row);

		// Blog
		$blog_select = $select_layout;
		$blog_comment = __('This is the WordPress version of a "blog page". Used when a category, author, or date is queried. Note that this layout will be overridden by selections for "Category", "Author", "Tag" and "Date" for their respective query types.', THEME_NAME);
		$blog_comment = $design_settings_settings->format_comment($blog_comment);
	
			$select = $select_layout;
			array_unshift($select, __('Category (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
			$comment = __('<strong>Category layout:</strong> Used when a category is queried. Typically the same layout as "Blog".', THEME_NAME);
			$comment = $design_settings_settings->format_comment($comment);
			$category_row = '<br />' . $design_settings_settings->settings_select('layout,category', $select) . $comment;
	
			$select = $select_layout;
			array_unshift($select, __('Author (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
			$comment = __('<strong>Author layout:</strong> Used when posts for a specific author are queried. Typically the same layout as "Blog".', THEME_NAME);
			$comment = $design_settings_settings->format_comment($comment);
			$author_row = '<br />' . $design_settings_settings->settings_select('layout,author', $select) . $comment;
	
			$select = $select_layout;
			array_unshift($select, __('Tag (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
			$comment = __('<strong>Tag layout:</strong> Used when a tag is queried. Typically the same layout as "Blog".', THEME_NAME);
			$comment = $design_settings_settings->format_comment($comment);
			$tag_row = '<br />' . $design_settings_settings->settings_select('layout,tag', $select) . $comment;
	
			$select = $select_layout;
			array_unshift($select, __('Date (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
			$comment = __('<strong>Date layout:</strong> Used when posts for a specific date or time are queried. Typically the same layout as "Blog".', THEME_NAME);
			$comment = $design_settings_settings->format_comment($comment);
			$date_row = '<br />' . $design_settings_settings->settings_select('layout,date', $select) . $comment;
		
			// Output completed blog row
			$row = array(__('Blog', THEME_NAME), $design_settings_settings->settings_select('layout,blog', $blog_select) . $blog_comment . $category_row . $author_row . $tag_row . $date_row);
			$design_settings_settings->setting_row($row); 
		

		// Search
		$select = $select_layout;
		$comment = __('The layout to use for search results.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Search', THEME_NAME), $design_settings_settings->settings_select('layout,search', $select) . $comment);
		$design_settings_settings->setting_row($row);

		// Error
		$select = $select_layout;
		$comment = __('The layout to use for error pages.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Error', THEME_NAME), $design_settings_settings->settings_select('layout,error', $select) . $comment);
		$design_settings_settings->setting_row($row);


		// BuddyPress layouts
		if (bp_plugin_is_active()) {

			$BP_select = $select_layout;
			$BP_comment = __('The default layout for your BuddyPress pages.', THEME_NAME);
			$BP_comment = $design_settings_settings->format_comment($BP_comment);
		
				$select = $select_layout;
				array_unshift($select, __('Activity (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Activity</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_activity_row = '<br />' . $design_settings_settings->settings_select('layout,bp-activity', $select) . $comment;
		
				$select = $select_layout;
				array_unshift($select, __('Blogs (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Blogs</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_blogs_row = '<br />' . $design_settings_settings->settings_select('layout,bp-blogs', $select) . $comment;
		
				$select = $select_layout;
				array_unshift($select, __('Forums (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Forums</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_forums_row = '<br />' . $design_settings_settings->settings_select('layout,bp-forums', $select) . $comment;
		
				$select = $select_layout;
				array_unshift($select, __('Groups (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Groups</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_groups_row = '<br />' . $design_settings_settings->settings_select('layout,bp-groups', $select) . $comment;
				
				$select = $select_layout;
				array_unshift($select, __('Groups - single (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Groups - single</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_groups_single_row = '<br />' . $design_settings_settings->settings_select('layout,bp-groups-single', $select) . $comment;
				
				$select = $select_layout;
				array_unshift($select, __('Groups - single plugins (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Groups - single plugins</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_groups_single_plugins_row = '<br />' . $design_settings_settings->settings_select('layout,bp-groups-single-plugins', $select) . $comment;
				
				$select = $select_layout;
				array_unshift($select, __('Members (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Members</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_members_row = '<br />' . $design_settings_settings->settings_select('layout,bp-members', $select) . $comment;

				$select = $select_layout;
				array_unshift($select, __('Members - single (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Members - single</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_members_single_row = '<br />' . $design_settings_settings->settings_select('layout,bp-members-single', $select) . $comment;
				
				
				$select = $select_layout;
				array_unshift($select, __('Members - single plugins (optional)', THEME_NAME)); // add blank value to start (this option can have a "none" setting)
				$comment = __('<strong>Members - single plugins</strong>', THEME_NAME);
				$comment = $design_settings_settings->format_comment($comment);
				$bp_members_single_plugins_row = '<br />' . $design_settings_settings->settings_select('layout,bp-members-single-plugins', $select) . $comment;
				
				//$bp_members_single_plugins_row = $design_settings_settings->settings_hidden('layout,bp-members-single-plugins');
				
				// Output completed blog row
				$row = array(__('BuddyPress', THEME_NAME), $design_settings_settings->settings_select('layout,bp', $BP_select) . $BP_comment . $bp_activity_row . $bp_blogs_row . $bp_forums_row . $bp_groups_row . $bp_groups_single_row . $bp_groups_single_plugins_row . $bp_members_row . $bp_members_single_row . $bp_members_single_plugins_row );
				$design_settings_settings->setting_row($row); 

		}  // end BuddyPress layouts


	echo '</table>';

	echo '<a name="other"></a>';
	echo '<div class="hr"></div> <h3>'. __('Other Defaults', THEME_NAME) .'</h3>';
	echo '<table class="form-table">';

		$select = $select_sidebar;
		$comment = __('The default sidebar to use when not specified.', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Sidebar', THEME_NAME), $design_settings_settings->settings_select('sidebar', $select) . $comment);
		$design_settings_settings->setting_row($row);

	echo '</table>';

	echo '<a name="css"></a>';
	echo '<div class="hr"></div> <h3>'. __('Styles', THEME_NAME) .'</h3>';
	echo '<table class="form-table">';

		$select = $select_sidebar;
		$comment = __('Add custom CSS directly to the <code>&lt;head&gt;</code> section of the site. For example, you could change the color of your links to red by entering: <code>a:link, a:visited { color: #C00; }</code>', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Custom CSS', THEME_NAME), $design_settings_settings->settings_textarea('css_custom') . $comment);
		$design_settings_settings->setting_row($row);

	echo '</table>';

	echo '<a name="js"></a>';
	echo '<div class="hr"></div> <h3>'. __('Scripts', THEME_NAME) .'</h3>';
	echo '<table class="form-table">';

		$select = $select_sidebar;
		$comment = __('Add custom JavaScript directly to the <code>&lt;head&gt;</code> section of the site. For example, you could add an alert by entering: <code>alert(\'Welcome!\');</code>', THEME_NAME);
		$comment = $design_settings_settings->format_comment($comment);
		$row = array(__('Custom JavaScript', THEME_NAME), $design_settings_settings->settings_textarea('js_custom') . $comment);
		$design_settings_settings->setting_row($row);

	echo '</table>';

	// key for this data type is generated at random when adding new slides.
	echo '<input type="hidden" name="key" value="'. $design_settings_settings->get_val('key') .'" />'; // Normal way causes error --> $design_settings_settings->settings_hidden('index'); 

	// save button
	$design_settings_settings->settings_save_button(__('Save Settings', THEME_NAME), 'button-primary');	

	?>
	<br /><br />


	
	<script type="text/javascript">
	
	jQuery(document).ready(function($) {
		
		// show/hide custom skin input
		jQuery("select[name='skin']").change( function() {
			var $custom = jQuery("#custom_skin_input");
			if (jQuery(this).val() == 'custom') {
				$custom.slideDown();
			} else {
				$custom.slideUp();
			}
		});
		
		// show/hide custom heading font
		jQuery("select[name='fonts,heading']").change( function() {
			var $custom_cufon = jQuery("#heading_cufon");
			var $custom_standard = jQuery("#heading_standard");

			if (jQuery(this).val() == 'custom:cufon') {
				$custom_cufon.slideDown();
			} else {
				$custom_cufon.slideUp();
			}

			if (jQuery(this).val() == 'custom:standard') {
				$custom_standard.slideDown();
			} else {
				$custom_standard.slideUp();
			}
		});
		
		// show/hide custom body font
		jQuery("select[name='fonts,body']").change( function() {
			var $custom = jQuery("#custom_body_font");
			if (jQuery(this).val() == 'custom:standard') {
				$custom.slideDown();
			} else {
				$custom.slideUp();
			}
		});


	});
	
	</script> 
	
	<?php




else:	// There is no else for this yet...


	// nothing here.

	
endif;




?>