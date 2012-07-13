<?php
/**
 * button
 */
?>

<div class="wpv-config-row">
	<?php if(isset($name)): ?>
		<h4><?php echo $name?></h4>
		<p class="description"><?php echo $desc?></p>
	<?php endif ?>
	<div class="content">
		<a href="<?php echo isset($link)?$link:'#'?>" title="<?php echo $title?>" class="button-primary <?php echo isset($class)?$class:'' ?>"><?php echo $title?></a>
	</div>
</div>
