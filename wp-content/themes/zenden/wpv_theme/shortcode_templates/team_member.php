<div class="team-member">
	<a href="mailto:<?php echo $email ?>" class="thumbnail">
		<span class="name"><?php echo $name?></span>
		<b class="description small clearfix"><?php echo $position ?></b>
		<?php if(!empty($picture)): ?>
			<span class="team-member-wrapper">
				<?php wpv_lazy_load($picture, $name)?>
				<span class="graphic-label"></span>
			</span>
		<?php endif ?>
	</a>
	<div class="clearboth"></div>
	<div class="shadow"></div>
	<div>
		<div class="team-member-info">
			<?php if(!empty($content)): ?>
				<div class="description"><?php echo trim(do_shortcode($content)) ?></div>
			<?php endif ?>
			<?php if(!empty($email) || !empty($phone)): ?>
				<div class="contact">
					<?php if(!empty($email)):?>
						<div><a href="mailto:<?php echo $email ?>" title="<?php printf(__('email %s', 'wpv'), $name)?>"><?php echo do_shortcode('[icon style="mail" color="black"]'.$email.'[/icon]')?></a></div>
					<?php endif ?>
					<?php if(!empty($phone)):?>
						<div><?php echo do_shortcode('[icon style="phone" color="black"]'.$phone.'[/icon]')?></div>
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>
