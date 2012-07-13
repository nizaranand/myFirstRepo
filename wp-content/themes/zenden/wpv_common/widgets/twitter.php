<?php

/**
 * twitter widget
 */

class wpv_twitter extends WP_Widget {
	
	public function wpv_twitter() {
		$widget_ops = array(
			'classname' => 'wpv_twitter',
			'description' => __('Displays a twitter feed', 'wpv')
		);
		$this->WP_Widget('wpv_twitter', __('Vamtam - Twitter', 'wpv') , $widget_ops);
	}
	
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Tweets', 'wpv') : $instance['title'], $instance, $this->id_base);
		$username = $instance['username'];
		$user_array = explode(',', $username);
		foreach ($user_array as $key => $user)
			$user_array[$key] = '"' . $user . '"';

		$query = empty($instance['query']) ? 'null' : '"' . $instance['query'] . '"';
		$avatar_size = (int)$instance['avatar_size'];
		
		if (empty($avatar_size))
			$avatar_size = 'null';

		$count = (int)$instance['count'];
		if ($count < 1)
			$count = 1;
		
		require WPV_WIDGETS_TPL . 'twitter-widget.php';
	}
	
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['avatar_size'] = $new_instance['avatar_size'] ? (int)$new_instance['avatar_size'] : '';
		$instance['count'] = (int)$new_instance['count'];
		$instance['query'] = strip_tags($new_instance['query']);
		return $instance;
	}
	
	public function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$avatar_size = isset($instance['avatar_size']) ? absint($instance['avatar_size']) : '';
		$query = isset($instance['query']) ? esc_attr($instance['query']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		$display = isset($instance['display']) ? $instance['display'] : 'latest';
		require WPV_WIDGETS_TPL . 'twitter-config.php';
	}
}

register_widget('wpv_twitter');