<p>
	<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Icons Color:', 'wpv'); ?></label>
	<select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
		<option value="black"<?php selected($color, 'black'); ?>>Black</option>
		<option value="blue"<?php selected($color, 'blue'); ?>>Blue</option>
		<option value="cyan"<?php selected($color, 'cyan'); ?>>Cyan</option>
		<option value="purple"<?php selected($color, 'purple'); ?>>Purple</option>
		<option value="red"<?php selected($color, 'red'); ?>>Red</option>
		<option value="gray"<?php selected($color, 'gray'); ?>>Gray</option>
		<option value="yellow"<?php selected($color, 'yellow'); ?>>Yellow</option>
		<option value="pink"<?php selected($color, 'pink'); ?>>Pink</option>
		<option value="green"<?php selected($color, 'green'); ?>>Green</option>
		<option value="orange"<?php selected($color, 'orange'); ?>>Orange</option>
		<option value="magenta"<?php selected($color, 'magenta'); ?>>Magenta</option>
	</select>
</p>
<?php foreach($this->fields as $name=>$field): ?>
	<p>
		<label for="<?php echo $this->get_field_id($name); ?>"><?php echo $field['description']; ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>" type="text" value="<?php echo $field['value']; ?>" />
	</p>
<?php endforeach ?>