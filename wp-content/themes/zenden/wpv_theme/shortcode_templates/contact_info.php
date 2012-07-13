[raw]
<div class="contact_info_wrap">
	<?php if(!empty($phone)):?>
		<p><?php echo wpv_clean_do_shortcode('[icon style="phone" color="'.$color.'"]'.$phone.'[/icon]')?></p>
	<?php endif ?>
	
	<?php if(!empty($cellphone)):?>
		<p><?php echo wpv_clean_do_shortcode('[icon style="cellphone" color="'.$color.'"]'.$cellphone.'[/icon]')?></p>
	<?php endif ?>
	
	<?php if(!empty($email)):?>
		<p><a href="mailto:<?php echo $email?>" ><?php echo wpv_clean_do_shortcode('[icon style="mail" color="'.$color.'"]'.$email.'[/icon]')?></a></p>
	<?php endif ?>
	
	<?php if(!empty($address) || !empty($city) || !empty($zip)):?>
		<p>
			<span class="contact_address"><?php echo wpv_clean_do_shortcode('[icon style="map" color="'.$color.'"]'.$address.'[/icon]')?></span>
			<?php if(!empty($city)):?>
				<span class="contact_city"><?php echo $city ?></span>
			<?php endif ?>
		
			<?php if(!empty($zip)):?>
				<span class="contact_zip"><?php echo $zip ?></span>
			<?php endif ?>
		</p>
	<?php endif ?>
	
	<?php if(!empty($name)):?>
		<p><?php echo wpv_clean_do_shortcode('[icon style="user" color="'.$color.'"]'.$name.'[/icon]')?></p>
	<?php endif ?>

</div>
[/raw]
