<?php
/**
 * select multiple
 */
?>

<?php
	$size = isset($size) ? $size : '5';
	if (isset($target)) {
		if (isset($options))
			$options = $options + Config_Generator::get_select_target_config($target);
		else
			$options = Config_Generator::get_select_target_config($target);
	}
	if(!is_array($default)) {
		$default = unserialize($default);
	}
	$selected = wpv_default(wpv_get_option($id, $default, false), array());
?>

<div class="wpv-config-row">
	
	<h4><?php echo $name?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		
		<select name="<?php echo $id?>[]" id="<?php echo $id?>" multiple="multiple" size="<?php echo $size?>" class="<?php wpv_static($value)?>">
		
			<?php if(!empty($options) && is_array($options)): ?>
				<?php foreach($options as $key => $option): ?>
					<option value="<?php echo $key?>" <?php echo (in_array($key, $selected)) ? 'selected="selected"' : '' ?>>
						<?php echo $option ?>
					</option>
				<?php endforeach ?>
			<?php endif ?>
		
		</select>
		<br />
	
	</div>
</div>
