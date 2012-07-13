<div class="wpv-config-row">
	<h4><?php echo $name ?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		<input type="hidden" id="export-config-prefix" value="<?php echo $prefix ?>" class="static" />
		<input type="text" id="export-config-name" value="" class="static" />
		<input type="button" id="export-config" class="button static" value="<?php echo $name ?>" />
	</div>
</div>