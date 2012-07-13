<?php global $theLayout, $theFooter; ?>
<footer>
	<?php if ($theFooter['top']) { ?>
	<div class="main">
		<div class="pageWrapper theContent ugc clearfix">
			<?php echo $theFooter['top']; ?>
		</div> <!--! end of .pageWrapper -->
	</div>
	<?php } ?>
	<?php if ($theFooter['bottom']) { ?>
	<div class="sub-footer">
		<div class="pageWrapper theContent ugc clearfix">
			<?php echo $theFooter['bottom']; ?>
		</div> <!--! end of .pageWrapper -->
	</div>
	<?php } ?>
</footer>