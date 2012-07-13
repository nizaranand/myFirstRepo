<?php
/**
 * display an editor
 */
?>

<?php
	$rows = isset($rows) ? $rows : 7;
	$text = wpv_get_option($id);
?>
		
<div class="wpv-config-row editor">
	<h4><?php echo $name?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		<div id="poststuff">
			<div id="post-body">
				<div id="post-body-content">
					<div class="postarea" id="postdivrich">
						<textarea id="<?php echo $id?>" class="<?php echo $id?> <?php wpv_static($value)?>" name="<?php echo $id?>"><?php echo $text ?></textarea>
						<?php
							function wpv_remove_tinymce_link_form($init) {
								$init['plugins'] = str_replace(',wplink', '', $init['plugins']);
								return $init;
							}
							add_filter('tiny_mce_before_init', 'wpv_remove_tinymce_link_form', 1000);
						
							wp_tiny_mce(false, array(
								'editor_selector' => $id,
							));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>