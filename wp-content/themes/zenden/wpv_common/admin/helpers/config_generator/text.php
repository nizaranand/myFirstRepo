<?php
/**
 * text input
 */
?>

<div class="wpv-config-row clearfix <?php echo empty($desc) ? 'no-desc':''?>">
	
	<h4>
		<label for="<?php echo $id?>"><?php echo $name?></label>
	</h4>
	
	<?php if(!empty($desc)): ?>
		<p class="description"><?php echo $desc?></p>
	<?php endif ?>
	
	<div class="content">
		<input name="<?php echo $id?>" id="<?php echo $id?>" type="text" class="large-text <?php wpv_static($value)?>" size="<?php echo wpv_default($size, 10)?>" value="<?php echo esc_attr(wpv_get_option($id, $default))?>" />
		<br />
	</div>
</div>
