<?php
/**
 * radio button
 */
?>

<?php
	$checked_key = wpv_get_option($id, $default); 
?>

<div class="wpv-config-row">
	<h4><?php $name?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		
		<p class="description"><?php echo $desc?></p>

		<?php foreach($value['config'] as $key => $option): ?>
			<input type="radio" id="<?php echo $id.'_'.$key?>" name="<?php echo $id?>" value="<?php echo $key?>" <?php checked($key, $checked_key) ?> class="<?php wpv_static($value)?>"/>
			<label for="<?php echo $id.'_'.$key?>"><?php echo $option?></label>
			<br />
		<?php endforeach ?>
		
	
	</div>
</div>