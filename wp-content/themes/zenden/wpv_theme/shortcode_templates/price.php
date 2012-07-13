[raw]
<div>
	<h3 style="<?php if(!empty($color)) echo "color:$title_color;"; if(!empty($title_backgorund)) echo "background-color:$title_background;"; if(!empty($title_size)) echo "font-size:$title_size".'px';?>"><?php echo $title ?></h3>
	<div class="price" style="text-align:<?php echo $text_align?>">
		<div class="value-box" style="background-color:<?php echo $price_background ?>">
			<span class="value" style="font-size:<?php echo $price_size?>px; color: <?php echo $price_color?>">
				<i><?php echo $currency?></i>
				<?php echo $price?>
			</span>
			<span class="meta"><?php echo $duration?></span>
		</div>
		
		<div class="content-box" style="<?php if(!empty($description_color)) echo "color:$description_color;"; if(!empty($description_background)) echo "background:$description_background;"?>">
			<?php echo do_shortcode($content)?>
		</div>
		<div class="meta-box">
			<?php if(!!$summary):?><p class="description"><?php echo htmlspecialchars_decode($summary)?></p><?php endif?>
			<a href="<?php echo $button_link?>" class="button small"><?php echo $button_text?></a>
		</div>
	</div>
	<div class="shadow"></div>
</div>
[/raw]