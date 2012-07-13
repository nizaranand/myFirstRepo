<?php
/**
 * color input
 */
?>
<div class="wpv-config-row">
	<h4><?php echo $name ?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		<div class="color-input-wrap">
			<input name="<?php echo $id ?>" id="<?php echo $id ?>" type="color" data-hex="true" value="<?php echo wpv_get_option($id, $default) ?>" class="<?php wpv_static($value)?>" />
		</div>
	
	</div>
</div>