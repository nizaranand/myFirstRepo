<?php
/**
 * range input
 */
?>

<?php
	$min = isset($min) ? "min='$min' " : '';
	$max = isset($max) ? "max='$max' " : '';
	$step = isset($step) ? "step='$step' " : '';
	$unit = isset($unit) ? $unit : '';
	$class = isset($class) ? $class : '';
?>

<div class="wpv-config-row <?php echo $class?>">
	<h4><?php echo $name?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		<div class="range-input-wrap clearfix">
			<input name="<?php echo $id?>" id="<?php echo $id?>" type="range" value="<?php echo wpv_get_option($id, $default)?>" <?php echo $min.$max.$step ?> class="wpv-range-input <?php wpv_static($value)?>" />
			<span><?php echo $unit?></span>
		</div>
	
	</div>
</div>