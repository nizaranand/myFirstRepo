<?php
?>

<div class="wpv-config-row">
	<h4><?php _e('Current sidebars', 'wpv')?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content clearfix">

		<ul id="registered-sidebars">
			<?php
				$values = explode(',', trim(wpv_get_option($id), ',')); // some magic - remove trailing commas
				foreach($values as $row):
					if(!empty($row)):
			?>
					<li data-id="<?php echo $row?>"><?php echo str_replace('wpv_sidebar-', '', $row) ?><span class="delete-sidebar">[delete]</span></li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
		
		<input type="text" id="new-sidebar-id" class="regular-text <?php wpv_static($value)?>" />
		<input type="button" id="add-new-sidebar" class="button <?php wpv_static($value)?>" value="Add new sidebar" />
		
		<input type="hidden" name="<?php echo $id ?>" value="<?php wpvge($id)?>" id="<?php echo $id?>" class="<?php wpv_static($value)?>" />
	
	</div>
</div>

