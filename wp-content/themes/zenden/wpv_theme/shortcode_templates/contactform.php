<?php $suffix = md5(uniqid('', true)); ?>[raw]
<div class="contact_form_wrap">
	<p class="success" style="display:none;"><?php echo $success?></p> 
	<form class="contact_form dynform" action="<?php echo $include_path?>sendmail.php" method="post">
		<div>
			<label for="contact_name-<?php echo $suffix?>"><?php echo $name_str?></label>
			<input type="text" required="required" id="contact_name-<?php echo $suffix?>" name="contact_name" class="text_input" value="" tabindex="5" placeholder="<?php echo $name_str ?>" />
		</div>
		<div>
			<label for="contact_email-<?php echo $suffix?>"><?php echo $email_str?></label>
			<input type="email" required="required" id="contact_email-<?php echo $suffix?>" name="contact_email" class="text_input" value="" tabindex="6" placeholder="<?php echo $email_str ?>"  />
		</div>
		<div>
			<textarea required="required" id="contact_content" name="contact_content" class="textarea" tabindex="7"></textarea>
		</div>
		<div class="wire-pad">
			<input type="submit" class="" value="<?php echo $submit_str?>" />
		</div>
		<input type="hidden" value="<?php echo $email?>" name="contact_to"/>
	</form>
</div>
[/raw]