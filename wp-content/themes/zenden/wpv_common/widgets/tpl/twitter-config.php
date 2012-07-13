<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpv'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Usernames (separate with comas):', 'wpv'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('height and width of avatar if displayed (48px max)(optional)', 'wpv'); ?></label>
	<input id="<?php echo $this->get_field_id('avatar_size'); ?>" name="<?php echo $this->get_field_name('avatar_size'); ?>" type="text" value="<?php echo $avatar_size; ?>" size="3" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many tweets to display?', 'wpv'); ?></label>
	<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('query'); ?>"><?php _e('Query (optional):', 'wpv'); ?></label>
	<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('query'); ?>" name="<?php echo $this->get_field_name('query'); ?>"><?php echo $query; ?></textarea>
</p>
		
<p>
	<?php _e("Query uses <a href='http://apiwiki.twitter.com/Twitter-Search-API-Method%3A-search' target='_blank'>Twitter's Search API</a>, so you can display any tweets you like.", 'wpv');?>
</p>