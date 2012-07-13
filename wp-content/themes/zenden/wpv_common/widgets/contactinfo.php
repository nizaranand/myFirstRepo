<?php

class wpv_contactinfo extends WP_Widget {
	private $fields = array();
	
	function wpv_contactinfo() {
		$widget_ops = array(
			'classname' => 'wpv_contactinfo',
			'description' => __('Display contact information.', 'wpv')
		);
		$this->WP_Widget('wpv_contactinfo', __('Vamtam - Contact Info', 'wpv') , $widget_ops);
		
		$this->fields = array(
			'title' => array('description' => __('Title:', 'wpv')),
			'text' => array('description' => __('Introduction text:', 'wpv')),
			'phone' => array('description' => __('Phone:', 'wpv')),
			'cellphone' => array('description' => __('Cell phone:', 'wpv')),
			'mail' => array('description' => __('Email:', 'wpv')),
			'address' => array('description' => __('Address:', 'wpv')),
			'city' => array('description' => __('City:', 'wpv')),
			'state' => array('description' => __('State:', 'wpv')),
			'zip' => array('description' => __('ZIP/Postcode:', 'wpv')),
			'name' => array('description' => __('Name:', 'wpv')),
		);
	}
	
	public function widget($args, $instance) {
		extract($args);
		foreach($this->fields as $name=>&$field)
			$field['value'] = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
		unset($field);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'wpv') : $instance['title'], $instance, $this->id_base);
		$color = $instance['color'];
		
		if (!empty($this->fields['city']['value']) && !empty($this->fields['state']['value']))
			$this->fields['city']['value'] = $this->fields['city']['value'] . ',&nbsp;' . $this->fields['state']['value'];
		elseif (!empty($state))
			$this->fields['city']['value'] = $this->fields['state']['value'];
		unset($this->fields['state']);

		require WPV_WIDGETS_TPL . 'contactinfo-widget.php';
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach($this->fields as $name=>$field)
			$instance[$name] = strip_tags($new_instance[$name]);
		
		$instance['color'] = $new_instance['color'];
		
		return $instance;
	}
	
	public function form($instance) {
		foreach($this->fields as $name=>&$field)
			$field['value'] = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
		unset($field);
		
		$color = $instance['color'];
		
		require WPV_WIDGETS_TPL . 'contactinfo-config.php';
	}
}
register_widget('wpv_contactinfo');
