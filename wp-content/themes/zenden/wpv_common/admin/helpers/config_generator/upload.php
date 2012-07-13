<?php
/**
 * upload field
 */
?>

<div class="wpv-config-row <?php if(isset($class)) echo $class ?>">
	<h4><?php echo $name?></h4>
	
	<p class="description"><?php echo $desc?></p>
	
	<div class="content">
		<?php include 'upload-basic.php' ?>
	</div>
</div>