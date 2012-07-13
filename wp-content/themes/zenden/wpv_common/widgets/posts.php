<?php

/**
 * posts widget
 */

class wpv_posts extends WP_Widget {
	
	public function wpv_posts() {
		$widget_options = array(
			'classname' => 'wpv_posts',
			'description' => __("Displays a list of posts/comments", 'wpv')
		);
		$this->WP_Widget('wpv_posts', __('Vamtam - Posts/Comments', 'wpv') , $widget_options);
		$this->alt_option_name = 'wpv_posts';
		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}
	
	public function widget($args, $instance) {
		$cache = wp_cache_get('theme_wpv_posts', 'widget');
		
		if (!is_array($cache))
			$cache = array();
			
		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}
		
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Posts', 'wpv') : $instance['title'], $instance, $this->id_base);
		
		if(!$number = (int) $instance['number'])
			$number = 10;
		elseif ($number < 1)
			$number = 1;
		elseif ($number > 15)
			$number = 15;
			
		if(!$desc_length = (int)$instance['desc_length'])
			$desc_length = 0;
		elseif($desc_length < 1)
			$desc_length = 1;
		$disable_thumbnail = $instance['disable_thumbnail'];
		$display_extra_type = $instance['display_extra_type'];
		
		$orderby = is_string($instance['orderby']) ? array($instance['orderby']) :   // backwards compatible with non-tabbed widget
					(is_array($instance['orderby']) ? $instance['orderby'] : array()); // just in case if orderby is not an array - pass an empty array
		
		$img_size = apply_filters('wpv_posts_widget_img_size', 50);

		ob_start();
		require WPV_WIDGETS_TPL . 'posts-widget.php';
		$cache[$args['widget_id']] = ob_get_flush();
		
		wp_cache_set('theme_wpv_posts', $cache, 'widget');
	}
	
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['desc_length'] = (int) $new_instance['desc_length'];
		$instance['disable_thumbnail'] = !empty($new_instance['disable_thumbnail']);
		$instance['display_extra_type'] = $new_instance['display_extra_type'];
		$instance['cat'] = $new_instance['cat'];
		
		$this->flush_widget_cache();
		
		return $instance;
	}
	
	public function flush_widget_cache() {
		wp_cache_delete('theme_wpv_posts', 'widget');
	}

	private function get_section_title($orderby) {
		if($orderby == 'comment_count')
			return __('Popular', 'wpv');
		if($orderby == 'date')
			return __('Newest', 'wpv');
		if($orderby == 'comments')
			return __('Comments', 'wpv');
	}
	
	public function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumbnail = isset($instance['disable_thumbnail']) ? (bool)$instance['disable_thumbnail'] : false;
		$display_extra_type = isset($instance['display_extra_type']) ? $instance['display_extra_type'] : 'time';
		$orderby = isset($instance['orderby']) ?
					(is_string($instance['orderby']) ? array($instance['orderby']) :   // backwards compatible with non-tabbed widget
						(is_array($instance['orderby']) ? $instance['orderby'] : array()) // just in case if orderby is not an array - pass an empty array
					) : array('comment_count');
		$cat = isset($instance['cat']) ? $instance['cat'] : array();
		
		if (!isset($instance['number']) || !$number = (int)$instance['number']) 
			$number = 5;
			
		$desc_length = isset($instance['desc_length']) ? $instance['desc_length'] : 80;
		$categories = get_categories('orderby=name&hide_empty=0');
		
		require WPV_WIDGETS_TPL . 'posts-config.php';
	}
}
register_widget('wpv_posts');

