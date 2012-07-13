<?php
	global $post;

	$size = isset($value['size']) ? $value['size'] : '43';
	$button = isset($value['button']) ? $value['button'] : __('Insert', 'wpv');
	$remove = isset($value['remove']) ? $value['remove'] : __('Remove', 'wpv');
	$default = isset($GLOBALS['wpv_in_metabox']) ? 
					get_post_meta($post->ID, $id, true) :
					wpv_get_option($id, $default);
?>

<div class="upload-basic-wrapper <?php echo !empty($default)?'active':'' ?>">
	<div id="<?php echo $id?>_preview" class="image-upload-preview">
		<a class="thickbox" href="<?php echo $default?>" target="_blank"><img src="<?php echo $default?>" /></a>
	</div>

	<input type="text" id="<?php echo $id?>" name="<?php echo $id?>" size="<?php echo $size?>" value="<?php echo $default?>" class="image-upload <?php wpv_static($value)?> hidden" />
	<a class="thickbox button wpv-upload-button" href="media-upload.php?&amp;post_id=0&amp;media_image_upload=1&amp;type=image&amp;TB_iframe=1&amp;width=640&amp;height=644" data-target="<?php echo $id?>">
		<?php echo $button?>
	</a>

	<a class="button wpv-upload-clear <?php if(empty($default)) echo 'hidden'?>" href="#" data-target="<?php echo $id?>"><?php echo $remove?></a>
	<a class="wpv-upload-undo hidden" href="#" data-target="<?php echo $id?>"><?php echo __('Undo', 'wpv')?></a>
</div>