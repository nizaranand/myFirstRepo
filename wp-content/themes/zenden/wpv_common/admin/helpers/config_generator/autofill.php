<?php
/**
 * adds several links that allow the user to easily set several predefined options
 */
?>

<div class="wpv-config-row autofill <?php if(isset($class)) echo $class?>">
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		
		<?php foreach($option_sets as $set): ?>
			<?php
				if(isset($set['image'])) {
					$content = "<img src='{$set['image']}' alt=''/>";
				} else {
					$content = $set['name'];
				}
				
				$fields = str_replace('"', '&quot;', json_encode($set['values']));
			?>
			<a href="#" title="<?php echo $set['name']?>" class="wpv-autofill" data-fields="<?php echo $fields?>"><?php echo $content?></a>
		<?php endforeach; ?>
	
	</div>
</div>
