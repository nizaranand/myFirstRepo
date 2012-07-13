<?php
/**
 * textarea
 */

 $rows = isset($rows) ? $rows : 5;
?>

<div class="wpv-config-row <?php echo $class ?> <?php echo empty($desc) ? 'no-desc':''?>">
	
	<h4>
		<label for="<?php echo $id?>"><?php echo $name?></label>
	</h4>
	
	<?php if(!empty($desc)): ?>
		<p class="description"><?php echo $desc?></p>
	<?php endif ?>
	
	<div class="content">
		<textarea id="<?php echo $id?>" rows="<?php echo $rows ?>" name="<?php echo $id?>" class="large-text code <?php wpv_static($value)?>"><?php echo wpv_get_option($id, $default);?></textarea>
		<br />
	
	</div>
</div>
