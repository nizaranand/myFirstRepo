<?php
/**
 * adds several links that allow the user to easily set several predefined options
 */

$available_layouts = array(
	'full',
	'left-only',
	'right-only',
	'left-right',
);

$selected = wpv_get_option($id, $default);

?>

<div class="wpv-config-row body-layout <?php if(isset($class)) echo $class?>">
	<h4><?php echo $name?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		<?php foreach($available_layouts as $layout): ?>
			<input type="radio" name="<?php echo $id?>" id="<?php echo $id.$layout?>" value="<?php echo $layout?>" class="<?php wpv_static($value)?>" <?php checked($selected, $layout)?>/>
			<label for="<?php echo $id.$layout?>"><img src="<?php echo WPV_ADMIN_ASSETS_URI?>images/body-<?php echo $layout?>.png" alt="" class="<?php if($selected == $layout) echo 'selected'?>" /></label>
		<?php endforeach ?>
	</div>
</div>
