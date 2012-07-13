<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpv'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Send emails to:', 'wpv'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
</p>
		