[raw] 
<?php if (!empty($class)):?>
	<div class="services small clearfix <?php echo $class?>" style="text-align:<?php echo $text_align?>;">
		<div class="services-dash">
			<div class="services-content"><?php echo wpv_clean_do_shortcode($content)?></div>
		</div>
	</div>
<?php else: ?>
	<?php if($fullimage == 'true'): ?>
		<div class="services has-image clearfix <?php echo $class?>" style="text-align:<?php echo $text_align?>;">
			<div class="services-dash">
				<?php if($no_button == 'true'): ?>
					<?php if($title != ''):?>
					<div class="services-inset mb">
						<h3 style="font-size:<?php echo $title_size?>px;line-height:1em"><?php echo $title ?></h3>
					</div>
					<?php endif ?>
					<div class="thumbnail"><?php wpv_lazy_load($icon, '', array('height' => $image_height)) ?></div>
				<?php else: ?> 
					<a href="<?php echo $button_link?>" class="thumbnail no-lightbox" style="margin: -10px;">
						<strong class="thumbnail-pad">
							<span class="title" style="font-size:<?php echo $title_size?>px;line-height:1.4em"><?php echo $title?></span>
						</strong>
						<?php wpv_lazy_load($icon, '', array('height' => $image_height)) ?>
						<span class="graphic-label"></span>
					</a>
				<?php endif ?>
			</div>
			<div class="services-content">
				<?php echo wpv_clean_do_shortcode($content)?>
			</div>
			
			<?php if($button_text != ''): ?>
			<div class="services-dash">
				<a class="clearboth <?php echo ($no_button != 'true') ? 'button' : 'more-btn' ?>" href="<?php echo $button_link?>"><span><?php echo $button_text?></span></a>
			</div>
			<?php endif ?>
		</div>
		<?php else: /* No image below ------------------------------------ */ ?>
			<div class="services no-image clearfix <?php echo $class?>" style="text-align:<?php echo $text_align?>;">
				<div class="services-dash">
					<div class="services-inset">
						<h3 style="font-size:<?php echo $title_size?>px;line-height:1.4em;<?php echo ($icon != '') ? "background-image:url('$icon');padding-top:".(55 - (int)$title_size).'px;' :'';?><?php echo ($icon=='') ? 'padding-left: 0px;' : ''; ?>" class="title clearfix"><?php echo $title ?></h3>
						<div class="services-content">
							<?php echo wpv_clean_do_shortcode($content)?>
						</div>
					</div>
					<?php if($button_text != ''): ?>
						<a class="clearboth <?php echo ($no_button != 'true') ? 'button' : 'more-btn' ?>" href="<?php echo $button_link?>"><span><?php echo $button_text?></span></a>
					<?php endif ?>
				</div>
			</div>
		<?php endif ?>
<?php endif ?>
[/raw] 