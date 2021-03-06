<?php
	/**
	 * used in header/footer advanced sidebar editor
	 */
	
	$active = wpv_get_option($id_prefix, $default);
	$min_str = isset($min) ? "min='$min' " : '';
	$max_str = isset($max) ? "max='$max' " : '';
	$step_str = isset($step) ? "step='$step' " : '';
	
	global $wpv_hsidebars_widths;
	$widths = $wpv_hsidebars_widths;
?>

<div class="wpv-config-row horizontal_blocks no-desc">
	<div class="content">
		<input name="<?php echo $id_prefix?>-max" type="hidden" value="<?php echo $max?>" class="static" />
		<input name="<?php echo $id_prefix?>" id="<?php echo $id_prefix?>" type="range" value="<?php echo $active?>" <?php echo $min_str.$max_str.$step_str ?> class="wpv-range-input <?php wpv_static($value)?>" />
		
		<div class="blocks clearboth">
			<?php 
				for($i=1; $i<=$max; $i++):
					$is_last = wpv_get_option($id_prefix . "-$i-last");
					$width = wpv_get_option($id_prefix . "-$i-width");
					
					$class = array();
					if($is_last) {
						$class[] = 'last';
					}
					$class[] = $width;
					
					if($i<=$active) {
						$class[] = 'active';
					}
			?>
				<div class="<?php echo implode(' ', $class)?>" rel="<?php echo $id_prefix ?>" data-width="<?php echo $width?>">
					<div class="block">
						<div class="options">
							<select name="<?php echo "$id_prefix-$i-width"?>" id="<?php echo "$id_prefix-$i-width"?>" class="<?php wpv_static($value)?>">
								<?php foreach($widths as $key => $option): ?>
									<option value="<?php echo $key?>" <?php selected($width, $key) ?>><?php echo $option?></option>
								<?php endforeach ?>
							</select>
							
							<label <?php if($width == 'full'):?>style="display:none"<?php endif?>>
								<input type="checkbox" name="<?php echo "$id_prefix-$i-last"?>" id="<?php echo "$id_prefix-$i-last"?>" value="true" class="<?php wpv_static($value)?>" <?php checked($is_last, true) ?> />&nbsp;<?php _e('last?', 'wpv') ?>
							</label>
						</div>
					</div>
				</div>
				<?php if($is_last): ?>
					<div class="clearboth"></div>
				<?php endif ?>
			<?php endfor ?>
		</div>
	</div>
</div>

