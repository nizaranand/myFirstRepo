<?php

/**
 * contact form
 */

class wpv_contactform extends WP_Widget {
	function wpv_contactform() {
		$widget_options = array(
			'classname' => 'wpv_contactform',
			'description' => __('Displays a email contact form.', 'wpv')
		);
		$this->WP_Widget('wpv_contactform', __('Vamtam - Contact Form', 'wpv') , $widget_options);
	}
	
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Email Us', 'wpv') : $instance['title'], $instance, $this->id_base);
		$email = $instance['email'];
		
		require WPV_WIDGETS_TPL . 'contactform-widget.php';
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		return $instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : get_bloginfo('admin_email');
		
		require WPV_WIDGETS_TPL . 'contactform-config.php';
	}
}
register_widget('wpv_contactform');
