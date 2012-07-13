<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpv'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'wpv'); ?></label>
	<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Display:', 'wpv'); ?></label>
	<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>[]" multiple="multiple">
		<option value="comment_count" <?php selected(in_array('comment_count', $orderby), true); ?>"><?php _e('Popular posts', 'wpv') ?></option>
		<option value="date" <?php selected(in_array('date', $orderby), true); ?>"><?php _e('Recent posts', 'wpv') ?></option>
		<option value="comments" <?php selected(in_array('comments', $orderby), true); ?>"><?php _e('Recent Comments', 'wpv') ?></option>
	</select>
</p>

<p>
	<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumbnail'); ?>" name="<?php echo $this->get_field_name('disable_thumbnail'); ?>"<?php checked($disable_thumbnail); ?> />
	<label for="<?php echo $this->get_field_id('disable_thumbnail'); ?>"><?php _e('Disable Post Thumbnail?', 'wpv'); ?></label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('desc_length'); ?>"><?php _e('Length of Description to show:', 'wpv'); ?></label>
	<input id="<?php echo $this->get_field_id('desc_length'); ?>" name="<?php echo $this->get_field_name('desc_length'); ?>" type="text" value="<?php echo $desc_length; ?>" size="3" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Categories:', 'wpv'); ?></label>
	<select style="height:5.5em" name="<?php echo $this->get_field_name('cat'); ?>[]" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat" multiple="multiple">
		<?php foreach ($categories as $category): ?>
			<option value="<?php echo $category->term_id; ?>"<?php echo in_array($category->term_id, $cat) ? ' selected="selected"' : ''; ?>><?php echo $category->name; ?></option>
		<?php endforeach; ?>
	</select>
</p>