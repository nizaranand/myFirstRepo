[raw]
<div class="slogan clearfix <?php echo $nopadding ?>" style="color:<?php echo $text_color?>;background:<?php echo $background?>">
	<div class="<?php echo !empty($button_text) ? 'three_fourths' : ''?>">
		<?php echo wpv_clean_do_shortcode($content);?>
	</div> 
	<div class="button-wrp">
		<?php
			if(!empty($button_text)): 
				?><a href="<?php echo $link?>" class="button large <?php echo $carved?>" title="<?php echo $button_text?>"><?php echo $button_text?></a><?php
			endif;
		?>
	</div> 
</div>
[/raw]