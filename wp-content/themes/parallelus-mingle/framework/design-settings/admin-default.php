<?php
// DEFAULT - Theme Settings Page

	$keys = $design_settings_settings->keys;
	$importing = ($keys[0] == '_plugin_saved') ? true : false; // are we trying to import saved settings?

	
	
	// Check for saved data to import
	//................................................................

	/*  
	// Commented out because we're not going to be using a master import file for this area currently. 
	// Instead, each area will handle it's saved data individualy.
	
	$current_import_key = $design_settings_settings->get_val('import_key', $keys);
	$current_version_key = $design_settings_settings->get_val('version_key', $keys);

	if ( !empty($_data['_plugin_saved']) && $keys[0] != '_plugin_saved' ) {

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
				$message = __('A saved data file was found. What would you like to do? &nbsp; %s', THEME_NAME);
				//$message = __('A saved data file was found. What would you like to do? &nbsp; %s &nbsp; | &nbsp; %s', THEME_NAME);
				$option_1 = $design_settings_settings->settings_link(__('View data for import', THEME_NAME), $import_link);
				//$option_2 = $design_settings_settings->settings_link(__('Ignore and hide this message', THEME_NAME), $import_link);
				echo '<div class="updated fade"><p><strong>' . sprintf( $message, $option_1 ) . '</strong></p></div>';
				//echo '<div class="updated fade"><p><strong>' . sprintf( $message, $option_1, $option_2 ) . '</strong></p></div>';
			}
		}
	}*/

	if (!$importing) {
		echo '<p>' . __('Configure the options below to set the theme-specific functionality as needed for your site.') . '</p>';
	}




#-----------------------------------------------------------------
# Lists for each configurable area
#-----------------------------------------------------------------


	// Default Design Settings
	//................................................................

	?>
	<a name="default_settings"></a>
	<div class="meta-box-sortables metabox-holder">
		<div class="postbox">
			<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php _e('Default Design Settings', THEME_NAME); ?></span></h3>
			<div class="inside">
				<?php
					$options = array('action' => 'edit', 'navigation' => 'design_setting', 'keys' => '_plugin,design_setting', 'class' => 'button');
				?>
				<table class="form-table">
					<tbody>
						<tr>
							<td colspan="2">
								<p>The basic design defaults including:</p>
							</td>
						</tr>
						<tr>
							<td style="padding: 0 10px; width: 125px;"><p><strong>Logo</strong></p></td>
							<td style="padding: 0 10px;"> <?php echo $design_settings_settings->settings_link('Set default Logo', $options) ;?></td>
						</tr>
						<tr>
							<td style="padding: 0 10px; width: 125px;"><p><strong>Skin</strong></p></td>
							<td style="padding: 0 10px;"> <?php echo $design_settings_settings->settings_link('Set default skin', $options) ;?></td>
						</tr>
						<tr>
							<td style="padding: 0 10px; width: 125px;"><p><strong>Font selections</strong></p></td>
							<td style="padding: 0 10px;"> <?php echo $design_settings_settings->settings_link('Select default fonts', $options) ;?></td>
						</tr>
						<tr>
							<td style="padding: 0 10px; width: 125px;"><p><strong>Default layouts</strong></p></td>
							<td style="padding: 0 10px;"><?php 
								echo $design_settings_settings->settings_link('Select default layouts', $options) ;
							?></td>
						</tr>
						<tr>
							<td style="padding: 0 10px; width: 125px;"><p><strong>and more...</strong></p></td>
							<td style="padding: 0 10px;"><?php 
								echo $design_settings_settings->settings_link('Other default settings', $options) ;
							?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
						<th colspan="2">
							<p>To modify these settings click the "Edit Default Design Settings" button below.</p> 
							<?php
								echo '<p>' . $design_settings_settings->settings_link('Edit All Default Design Settings', $options) . '</p>';
							?>
						</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>


	<a name="slide_shows"></a>
	<?php
	echo	'<br />' .
			'<h2>'. __('Design Elements', THEME_NAME) .'</h2>' . 
			'<div class="hr"></div>';


	// Slideshow list
	//................................................................

	$titles = array(
				__('Slideshow', THEME_NAME), 
				__('Shortcode', THEME_NAME),
				__('Actions', THEME_NAME)
			);

	$title = __('Slide shows', THEME_NAME);
	$caption = __('Create and manage your slide shows.', THEME_NAME);
	echo '<h3>' . $title . '</h3><p>' . $caption . '</p>';
	
	$ancestor_keys = array();
	$design_settings_settings->table_header($titles);
	
	$nbr = 0;
	
	// Look up slide shows
	$slideshows = $design_settings_settings->get_val('slideshows', '_plugin');
	$saved_slideshows = $design_settings_settings->get_val('slideshows', '_plugin_saved');
	if (!empty($slideshows) || !empty($saved_slideshows)) {
		
		// User created slide shows
		if (!empty($slideshows)) {
			foreach ((array) $slideshows as $key => $item) {
				if ($a = $item['ancestor_key']) $ancestor_keys[] = $a;
				$navKeys = '_plugin,slideshows,' . $key;
				$label = stripslashes($item['label']);
				$shortcode = '<span>[slideshow alias="'. $item['key'] .'" ]</span>';
				$edit_link = array('navigation' => 'slideshow', 'action' => 'edit', 'keys' => $navKeys);
				$delete_link = array('action' => 'delete', 'action_keys' => $navKeys, 'class' => 'common-delete');
				$export_link = array('navigation' => 'export', 'keys' => $navKeys);
	
				$row = array(	
						$design_settings_settings->settings_link($label, $edit_link) . $warning,
						$shortcode,
						$design_settings_settings->settings_link(__('Edit', THEME_NAME), $edit_link) . ' | ' .
						$design_settings_settings->settings_link(__('Delete', THEME_NAME), $delete_link) //. ' | ' .
					);
				$design_settings_settings->table_row($row, $nbr++);
			}
		} else {
			$row = array(__('No slide shows created.', THEME_NAME), '', '');
			$design_settings_settings->table_row($row, $nbr++);
		}
		
		// Saved slides 
		if (!empty($saved_slideshows)) {
			foreach ($saved_slideshows as $key => $item) {
				$label = $item['label'];
	
				// Is this overwritten?
				$class = (in_array($key, $ancestor_keys)) ? 'disabled' : false;
				if (!$class && $_data['_plugin']['slideshows']) $class = (array_key_exists($key, $_data['_plugin']['slideshows'])) ? 'disabled' : false ;
	
				$label = stripslashes($item['label']);
				$shortcode = '<span>[slideshow alias="'. $item['key'] .'" ]</span>';
				$edit_link = array('navigation' => 'slideshow', 'action' => 'edit', 'keys' => '_plugin_saved,slideshows,'.$key);
				$export_link = array('navigation' => 'export', 'keys' =>  '_plugin_saved,'.$key);

				$row = array(	
						$label,
						$shortcode,
						 $design_settings_settings->settings_link(__('Override', THEME_NAME), $edit_link) . '&nbsp; <span>('.__('from save file', THEME_NAME).')</span>' //. ' | ' .
					);
				if (!$class) { //$row = array($label, '',  __('Overridden above', THEME_NAME));
					// only show saved if not overriden
					$design_settings_settings->table_row($row, $nbr++, 'disabled');
				}
			}
		}
	}
	?>
	</tbody>
		<tfoot>
			<tr>
			<th colspan="<?php echo count($titles); ?>">
			<?php
				$new_key = '_plugin,slideshows,'. $design_settings_settings->add_key;
				$options = array('action' => 'add', 'navigation' => 'slideshow', 'keys' => $new_key, 'class' => 'button');
				echo '<p>' . $design_settings_settings->settings_link('Add new Slide Show', $options) . '</p>';
			?>
			</th>
			</tr>
		</tfoot>
	</table>
	<?php

	
	$options = array('navigation' => 'export', 'keys' => '_plugin,slideshows', 'class' => 'button');
	echo '<br /><div>' . $design_settings_settings->settings_link(__('Export Slide Shows', THEME_NAME), $options) . '</div><br />';

	
	?>
	<a name="top_graphics"></a>
	<?php
	// Top Graphics (sub-header shown on sub-pages)
	//................................................................

	$titles = array(
				__('Top Graphic', THEME_NAME), 
				'&nbsp;',
				__('Actions', THEME_NAME)
			);

	$title = __('Top Graphics', THEME_NAME);
	$caption = __('Optional graphic elements designed to appear on sub-pages below the main navigation. Interchangable with slide shows in page headers.', THEME_NAME);
	echo '<h3>' . $title . '</h3><p>' . $caption . '</p>';
	
	$ancestor_keys = array();
	$design_settings_settings->table_header($titles);
	
	$nbr = 0;
	
	// Look up top graphics
	$top_graphics = $design_settings_settings->get_val('top_graphics', '_plugin');
	$saved_top_graphics = $design_settings_settings->get_val('top_graphics', '_plugin_saved');

	if (!empty($top_graphics) || !empty($saved_top_graphics)) {
		
		// User created
		if (!empty($top_graphics)) {

			foreach ((array) $top_graphics as $key => $item) {
				if ($a = $item['ancestor_key']) $ancestor_keys[] = $a;
				$aKeys = '_plugin,top_graphics,' . $key;
				$label = stripslashes($item['label']);
				$edit_link = array('navigation' => 'top_graphic', 'action' => 'edit', 'keys' => $aKeys);
				$delete_link = array('action' => 'delete', 'action_keys' => $aKeys, 'class' => 'common-delete');
				$export_link = array('navigation' => 'export', 'keys' => $aKeys);
				
				$row = array(	
						$design_settings_settings->settings_link($label, $edit_link) . $warning,
						'&nbsp;', // blank //$shortcode,
						$design_settings_settings->settings_link(__('Edit', THEME_NAME), $edit_link) . ' | ' .
						$design_settings_settings->settings_link(__('Delete', THEME_NAME), $delete_link) //. ' | ' .
					);
				$design_settings_settings->table_row($row, $nbr++);
			}
		} else {
			$row = array(__('No top graphics created.', THEME_NAME), '', '');
			$design_settings_settings->table_row($row, $nbr++);
		} // END "User created"
		
		// Saved file 
		if (!empty($saved_top_graphics)) {
			foreach ($saved_top_graphics as $key => $item) {
				$label = $item['label'];
	
				// Is this overwritten?
				$class = (in_array($key, $ancestor_keys)) ? 'disabled' : false;
				if (!$class && $_data['_plugin']['top_graphics']) $class = (array_key_exists($key, $_data['_plugin']['top_graphics'])) ? 'disabled' : false ;
	
				$label = stripslashes($item['label']);
				$shortcode = '<span>[slideshow alias="'. $item['key'] .'" ]</span>';
				$edit_link = array('navigation' => 'top_graphic', 'action' => 'edit', 'keys' => '_plugin_saved,top_graphics,'.$key);

				$row = array(	
						$label,
						'&nbsp;', // blank //$shortcode,
						 $design_settings_settings->settings_link(__('Override', THEME_NAME), $edit_link) . '&nbsp; <span>('.__('from save file', THEME_NAME).')</span>'
					);

				if (!$class) { 
					// only show saved if not overriden
					$design_settings_settings->table_row($row, $nbr++, 'disabled'); // added disabled class to lower visual priority
				}
			}
		} // END "Saved"

	} // END (!empty( "user created") || !empty( "saved" ))
	?>
	</tbody>
		<tfoot>
			<tr>
			<th colspan="<?php echo count($titles); ?>">
			<?php
				$new_key = '_plugin,top_graphics,'. $design_settings_settings->add_key;
				$options = array('action' => 'add', 'navigation' => 'top_graphic', 'keys' => $new_key, 'class' => 'button');
				echo '<p>' . $design_settings_settings->settings_link('Add new Top Graphic', $options) . '</p>';
			?>
			</th>
			</tr>
		</tfoot>
	</table>
	<?php 
	
	$options = array('navigation' => 'export', 'keys' => '_plugin,top_graphics', 'class' => 'button');
	echo '<br /><div>' . $design_settings_settings->settings_link(__('Export Top Graphics', THEME_NAME), $options) . '</div><br />';
	


	?>
	<a name="sidebars"></a>
	<?php	
	
	// Sidebars
	//................................................................

	$titles = array(
				__('Sidebar', THEME_NAME), 
				__('Shortcode', THEME_NAME),
				__('Actions', THEME_NAME)
			);

	$title = __('Sidebars', THEME_NAME);
	$caption = __('Create sidebars which you can include in layouts, insert with shortcodes and add widgets to from the "Widgets" page.', THEME_NAME);
	echo '<h3>' . $title . '</h3><p>' . $caption . '</p>';
	
	$ancestor_keys = array();
	$design_settings_settings->table_header($titles);
	
	$nbr = 0;


	// Look up sidebars
	$sidebars = $design_settings_settings->get_val('sidebars', '_plugin');
	$saved_sidebars = $design_settings_settings->get_val('sidebars', '_plugin_saved');

	if (!empty($sidebars) || !empty($saved_sidebars)) {
		
		// User created
		if (!empty($sidebars)) {

			foreach ((array) $sidebars as $key => $item) {
				if ($a = $item['ancestor_key']) $ancestor_keys[] = $a;
				$aKeys = '_plugin,sidebars,' . $key;
				$label = stripslashes($item['label']);
				$shortcode = '<span>[sidebar alias="'. $item['alias'] .'" ]</span>';

				$edit_link = array('navigation' => 'sidebar', 'action' => 'edit', 'keys' => $aKeys);
				$delete_link = array('action' => 'delete', 'action_keys' => $aKeys, 'class' => 'common-delete');
				$export_link = array('navigation' => 'export', 'keys' => $aKeys);

				$row = array(	
					$design_settings_settings->settings_link($label, $edit_link) . $warning,
					$shortcode,
					$design_settings_settings->settings_link(__('Edit', THEME_NAME), $edit_link) . ' | ' .
					$design_settings_settings->settings_link(__('Delete', THEME_NAME), $delete_link)
				);
				$design_settings_settings->table_row($row, $nbr++);
			}
		} else {
			$row = array(__('No sidebars created.', THEME_NAME), '', '');
			$design_settings_settings->table_row($row, $nbr++);
		} // END "User created"
		
		// Saved file 
		if (!empty($saved_sidebars)) {
			foreach ($saved_sidebars as $key => $item) {
				$label = $item['label'];
	
				// Is this overwritten?
				$class = (in_array($key, $ancestor_keys)) ? 'disabled' : false;
				if (!$class && $_data['_plugin']['sidebars']) $class = (array_key_exists($key, $_data['_plugin']['sidebars'])) ? 'disabled' : false ;
	
				$label = stripslashes($item['label']);
				$shortcode = '<span>[sidebar alias="'. $item['alias'] .'" ]</span>';
				$edit_link = array('navigation' => 'sidebar', 'action' => 'edit', 'keys' => '_plugin_saved,sidebars,'.$key);
				$row = array(	
						$label,
						$shortcode,
						$design_settings_settings->settings_link(__('Override', THEME_NAME), $edit_link) . '&nbsp; <span>('.__('from save file', THEME_NAME).')</span>'
					);

				if (!$class) { 
					// only show saved if not overriden
					$design_settings_settings->table_row($row, $nbr++, 'disabled'); // added disabled class to lower visual priority
				}
			}
		} // END "Saved"

	} // END (!empty( "user created") || !empty( "saved" ))
	
	?>
	</tbody>
		<tfoot>
			<tr>
			<th colspan="<?php echo count($titles); ?>">
			<?php
				$new_key = '_plugin,sidebars,'. $design_settings_settings->add_key;
				$options = array('action' => 'add', 'navigation' => 'sidebar', 'keys' => $new_key, 'class' => 'button');
				echo '<p>' . $design_settings_settings->settings_link('Add new Sidebar', $options) . '</p>';
			?>
			</th>
			</tr>
		</tfoot>
	</table>
	<?php 
	
	$options = array('navigation' => 'export', 'keys' => '_plugin,sidebars', 'class' => 'button');
	echo '<br /><div>' . $design_settings_settings->settings_link(__('Export Sidebars', THEME_NAME), $options) . '</div><br />';
	

		
	echo	'<br /><br />' .
			'<h2>'. __('Layouts', THEME_NAME) .'</h2>' . 
			'<div class="hr"></div>';


	?>
	<a name="page_headers"></a>
	<?php
	// Page Headers
	//................................................................

	$titles = array(
				__('Header', THEME_NAME), 
				'&nbsp;',
				__('Actions', THEME_NAME)
			);

	$title = __('Page Headers', THEME_NAME);
	$caption = __('Select the elements to use in your header including slide shows, top graphics, menus, top content area and showcase content. The headers created here are available to add to any page layout.', THEME_NAME);
	echo '<h3>' . $title . '</h3><p>' . $caption . '</p>';
	
	$ancestor_keys = array();
	$design_settings_settings->table_header($titles);
	
	$nbr = 0;
	
	// Look up page headers
	$page_headers = $design_settings_settings->get_val('page_headers', '_plugin');
	$saved_page_headers = $design_settings_settings->get_val('page_headers', '_plugin_saved');

	if (!empty($page_headers) || !empty($saved_page_headers)) {
	
		// User created
		if (!empty($page_headers)) {

			foreach ((array) $page_headers as $key => $item) {
				if ($a = $item['ancestor_key']) $ancestor_keys[] = $a;
				$aKeys = '_plugin,page_headers,' . $key;
				$label = stripslashes($item['label']);

				$edit_link = array('navigation' => 'page_header', 'action' => 'edit', 'keys' => $aKeys);
				$delete_link = array('action' => 'delete', 'action_keys' => $aKeys, 'class' => 'common-delete');
				$export_link = array('navigation' => 'export', 'keys' => $aKeys);
			
				$row = array(	
					$design_settings_settings->settings_link($label, $edit_link) . $warning,
					'&nbsp;',
					$design_settings_settings->settings_link(__('Edit', THEME_NAME), $edit_link) . ' | ' .
					$design_settings_settings->settings_link(__('Delete', THEME_NAME), $delete_link)
				);
				$design_settings_settings->table_row($row, $nbr++);
			}
		} else {
			$row = array(__('No page headers created.', THEME_NAME), '', '');
			$design_settings_settings->table_row($row, $nbr++);
		} // END "User created"
		
		// Saved file 
		if (!empty($saved_page_headers)) {
			foreach ($saved_page_headers as $key => $item) {
				$label = $item['label'];
	
				// Is this overwritten?
				$class = (in_array($key, $ancestor_keys)) ? 'disabled' : false;
				if (!$class && $_data['_plugin']['page_headers']) $class = (array_key_exists($key, $_data['_plugin']['page_headers'])) ? 'disabled' : false ;
	
				$label = stripslashes($item['label']);
				$edit_link = array('navigation' => 'page_header', 'action' => 'edit', 'keys' => '_plugin_saved,page_headers,'.$key);

				$row = array(	
						$label,
						'&nbsp;',
						$design_settings_settings->settings_link(__('Override', THEME_NAME), $edit_link) . '&nbsp; <span>('.__('from save file', THEME_NAME).')</span>'
					);

				if (!$class) { 
					// only show saved if not overriden
					$design_settings_settings->table_row($row, $nbr++, 'disabled'); // added disabled class to lower visual priority
				}
			}
		} // END "Saved"

	} // END (!empty( "user created") || !empty( "saved" ))
	
	?>
	</tbody>
		<tfoot>
			<tr>
			<th colspan="<?php echo count($titles); ?>">
			<?php
				$new_key = '_plugin,page_headers,'. $design_settings_settings->add_key;
				$options = array('action' => 'add', 'navigation' => 'page_header', 'keys' => $new_key, 'class' => 'button');
				echo '<p>' . $design_settings_settings->settings_link('Add new Header', $options) . '</p>';
			?>
			</th>
			</tr>
		</tfoot>
	</table>
	<?php 
	
	$options = array('navigation' => 'export', 'keys' => '_plugin,page_headers', 'class' => 'button');
	echo '<br /><div>' . $design_settings_settings->settings_link(__('Export Page Headers', THEME_NAME), $options) . '</div><br />';
	

	?>
	<a name="page_footers"></a>
	<?php
	
	// Page Footers
	//................................................................

	$titles = array(
				__('Footer', THEME_NAME), 
				'&nbsp;',
				__('Actions', THEME_NAME)
			);

	$title = __('Page Footers', THEME_NAME);
	$caption = __('Configure the options for the content and layout of page footers. The footers created here are available to add to page layouts.', THEME_NAME);
	echo '<h3>' . $title . '</h3><p>' . $caption . '</p>';
	
	$ancestor_keys = array();
	$design_settings_settings->table_header($titles);
	
	$nbr = 0;
	
	// Look up page footers
	$page_footers = $design_settings_settings->get_val('page_footers', '_plugin');
	$saved_page_footers = $design_settings_settings->get_val('page_footers', '_plugin_saved');

	if (!empty($page_footers) || !empty($saved_page_footers)) {
	
		// User created
		if (!empty($page_footers)) {

			foreach ((array) $page_footers as $key => $item) {
				if ($a = $item['ancestor_key']) $ancestor_keys[] = $a;
				$aKeys = '_plugin,page_footers,' . $key;
				$label = stripslashes($item['label']);

				$edit_link = array('navigation' => 'page_footer', 'action' => 'edit', 'keys' => $aKeys);
				$delete_link = array('action' => 'delete', 'action_keys' => $aKeys, 'class' => 'common-delete');
				$export_link = array('navigation' => 'export', 'keys' => $aKeys);
			
				$row = array(	
					$design_settings_settings->settings_link($label, $edit_link) . $warning,
					'&nbsp;',
					$design_settings_settings->settings_link(__('Edit', THEME_NAME), $edit_link) . ' | ' .
					$design_settings_settings->settings_link(__('Delete', THEME_NAME), $delete_link)
				);
				$design_settings_settings->table_row($row, $nbr++);
			}
		} else {
			$row = array(__('No page footers created.', THEME_NAME), '', '');
			$design_settings_settings->table_row($row, $nbr++);
		} // END "User created"
		
		// Saved file 
		if (!empty($saved_page_footers)) {
			foreach ($saved_page_footers as $key => $item) {
				$label = $item['label'];
	
				// Is this overwritten?
				$class = (in_array($key, $ancestor_keys)) ? 'disabled' : false;
				if (!$class && $_data['_plugin']['page_footers']) $class = (array_key_exists($key, $_data['_plugin']['page_footers'])) ? 'disabled' : false ;
	
				$label = stripslashes($item['label']);
				$edit_link = array('navigation' => 'page_footer', 'action' => 'edit', 'keys' => '_plugin_saved,page_footers,'.$key);
				
				$row = array(	
						$label,
						'&nbsp;',
						$design_settings_settings->settings_link(__('Override', THEME_NAME), $edit_link) . '&nbsp; <span>('.__('from save file', THEME_NAME).')</span>'
					);

				if (!$class) { 
					// only show saved if not overriden
					$design_settings_settings->table_row($row, $nbr++, 'disabled'); // added disabled class to lower visual priority
				}
			}
		} // END "Saved"

	} // END (!empty( "user created") || !empty( "saved" ))
	
	?>
	</tbody>
		<tfoot>
			<tr>
			<th colspan="<?php echo count($titles); ?>">
			<?php
				$new_key = '_plugin,page_footers,'. $design_settings_settings->add_key;
				$options = array('action' => 'add', 'navigation' => 'page_footer', 'keys' => $new_key, 'class' => 'button');
				echo '<p>' . $design_settings_settings->settings_link('Add new Footer', $options) . '</p>';
			?>
			</th>
			</tr>
		</tfoot>
	</table>
	<?php 
	
	$options = array('navigation' => 'export', 'keys' => '_plugin,page_footers', 'class' => 'button');
	echo '<br /><div>' . $design_settings_settings->settings_link(__('Export Page Footers', THEME_NAME), $options) . '</div><br />';


	?>
	<a name="page_layouts"></a>
	<?php
	
	// Layouts list
	//................................................................

	$titles = array(
				__('Template', THEME_NAME), 
				'&nbsp;',
				__('Actions', THEME_NAME)
			);

	$title = __('Page Layouts', THEME_NAME);
	$caption = __('Create and manage the templates available for your content.', THEME_NAME);
	echo '<h3>' . $title . '</h3><p>' . $caption . '</p>';
	
	$ancestor_keys = array();
	$design_settings_settings->table_header($titles);
	
	$nbr = 0;

	// Look up layouts
	$layouts = $design_settings_settings->get_val('layouts', '_plugin');
	$saved_layouts = $design_settings_settings->get_val('layouts', '_plugin_saved');

	if (!empty($layouts) || !empty($saved_layouts)) {
	
		// User created
		if (!empty($layouts)) {

			foreach ((array) $layouts as $key => $item) {
				if ($a = $item['ancestor_key']) $ancestor_keys[] = $a;
				$aKeys = '_plugin,layouts,' . $key;
				$label = stripslashes($item['label']);

				$edit_link = array('navigation' => 'layout', 'action' => 'edit', 'keys' => $aKeys);
				$delete_link = array('action' => 'delete', 'action_keys' => $aKeys, 'class' => 'common-delete');
				$export_link = array('navigation' => 'export', 'keys' => $aKeys);
			
				$row = array(	
					$design_settings_settings->settings_link($label, $edit_link) . $warning,
					'&nbsp;',
					$design_settings_settings->settings_link(__('Edit', THEME_NAME), $edit_link) . ' | ' .
					$design_settings_settings->settings_link(__('Delete', THEME_NAME), $delete_link)
				);
				$design_settings_settings->table_row($row, $nbr++);
			}
		} else {
			$row = array(__('No layouts created.', THEME_NAME), '', '');
			$design_settings_settings->table_row($row, $nbr++);
		} // END "User created"
		
		// Saved file 
		if (!empty($saved_layouts)) {
			foreach ($saved_layouts as $key => $item) {
				$label = $item['label'];
	
				// Is this overwritten?
				$class = (in_array($key, $ancestor_keys)) ? 'disabled' : false;
				if (!$class && $_data['_plugin']['layouts']) $class = (array_key_exists($key, $_data['_plugin']['layouts'])) ? 'disabled' : false ;
	
				$label = stripslashes($item['label']);
				$edit_link = array('navigation' => 'layout', 'action' => 'edit', 'keys' => '_plugin_saved,layouts,'.$key);

				$row = array(	
						$label,
						'&nbsp;',
						$design_settings_settings->settings_link(__('Override', THEME_NAME), $edit_link) . '&nbsp; <span>('.__('from save file', THEME_NAME).')</span>'
					);

				if (!$class) { 
					// only show saved if not overriden
					$design_settings_settings->table_row($row, $nbr++, 'disabled'); // added disabled class to lower visual priority
				}
			}
		} // END "Saved"

	} // END (!empty( "user created") || !empty( "saved" ))
	
	?>
	</tbody>
		<tfoot>
			<tr>
			<th colspan="<?php echo count($titles); ?>">
			<?php
				$new_key = '_plugin,layouts,'. $design_settings_settings->add_key;
				$options = array('action' => 'add', 'navigation' => 'layout', 'keys' => $new_key, 'class' => 'button');
				echo '<p>' . $design_settings_settings->settings_link('Add new Layout', $options) . '</p>';
			?>
			</th>
			</tr>
		</tfoot>
	</table>
	<?php 
	
	$options = array('navigation' => 'export', 'keys' => '_plugin,layouts', 'class' => 'button');
	echo '<br /><div>' . $design_settings_settings->settings_link(__('Export Layouts', THEME_NAME), $options) . '</div><br />';


	echo '<br /><br />';
		
	// export button
	if (!$importing) {
		$options = array('navigation' => 'export', 'keys' => '_plugin', 'class' => 'button');
	}
	
	echo '<br /><br />';

?>