<div class="wpv-config-row">
	<h4><?php echo $name ?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		<select id="import-config-available" class="static">
			<option value=""><?php _e('Available skins', 'wpv')?></option>
		</select>
		<input type="button" id="import-config" class="button static" value="<?php echo $name ?>" />
		<input type="button" id="delete-config" class="button static" value="<?php _e('Delete', 'wpv') ?>" />
	</div>
</div>