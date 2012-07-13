<?php global $post ?>
<div class="wpv-config-row">

	<h4 class="clearfix">
		<?php echo $name ?>
		<a title="Add Media" class="thickbox alignright" id="add_media" href="media-upload.php?post_id=<?php echo $post->ID; ?>&amp;gallery_image_upload=1&amp;type=image&amp;TB_iframe=1&amp;width=640&amp;height=644" style="border:none;text-decoration:none;">
			<input type="button" class="button-primary" value="Add Image" id="add-image" name="add">
		</a>
	</h4>

	<div class="content">
		<div id="gallery_actions">
			
		</div>

		<div id="galleryTableWrapper">
			<table class="widefat galleryTable" cellspacing="0">
				<thead>
					<tr>
						<th style="width:10px" scope="row">&nbsp;</th>
						<th style="width:70px" scope="row"><?php _e('Thumbnail', 'wpv')?></th>
						<th style="width:160px" scope="row"><?php _e('Title', 'wpv')?></th>
						<th scope="row"><?php _e('Description', 'wpv')?></th>
						<th style="width:90px" scope="row"><?php _e('Actions', 'wpv')?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="4">
							<div>
								<ul id="imagesSortable">
								<?php
									$image_ids_str = get_post_meta($post->ID, 'gallery_ids', true);
									if(!empty($image_ids_str)):
										$image_ids = explode(',', str_replace('image-', '', $image_ids_str));
										foreach($image_ids as $image_id):
											gallery_create_image_item($image_id);
										endforeach;
									endif;
								?>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" id="gallery_image_ids" name="gallery_ids" value="<?php echo get_post_meta($post->ID, 'gallery_ids', true);?>" />
		</div>
	</div>

</div>
