<?php
/**
 * on/off toggle
 */
 
$option = $value;
$value = wpv_get_option($id, $default);
if($value == 'true')
	$value = true;
elseif($value == 'false')
	$value = false;
?>

<div class="wpv-config-row toggle">
	
	<h4><?php echo $name?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content clearfix">
		<?php if(isset($image)): ?>
			<img src="<?php echo $image?>" alt="<?php echo $name ?>" class="alignleft" />
		<?php endif ?>
		<input type="checkbox" class="toggle-button <?php wpv_static($option)?>" name="<?php echo $id?>" id="<?php echo $id?>" value="true" <?php checked($value, true) ?> />
	</div>
</div>
