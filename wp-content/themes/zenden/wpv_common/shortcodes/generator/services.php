<?php
return array(
	'name' => __('Services', 'wpv') ,
	'value' => 'services',
	'options' => array(
		array(
			'name' => __('Title', 'wpv') ,
			'id' => 'title',
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Image', 'wpv') ,
			'id' => 'icon',
			'default' => '',
			'type' => 'upload'
		) ,
		array(
			'name' => __('Image height', 'wpv') ,
			'id' => 'image_height',
			'default' => 100,
			'type' => 'range',
			'min' => 0,
			'max' => 500,
		) ,
		array(
			'name' => __('Description', 'wpv') ,
			'id' => 'description',
			'default' => '',
			'type' => 'textarea'
		) ,
		array(
			'name' => __('Button text', 'wpv') ,
			'id' => 'button_text',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Button link', 'wpv') ,
			'id' => 'button_link',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Text alignment', 'wpv') ,
			'id' => 'text_align',
			'default' => 'justify',
			'type' => 'select',
			'options' => array(
				'justify' => 'justify',
				'left' => 'left',
				'center' => 'center',
				'right' => 'right',
			)
		) ,
		array(
			'name' => __('Title size', 'wpv') ,
			'id' => 'title_size',
			'default' => 30,
			'type' => 'range',
			'min' => 0,
			'max' => 50,
		) ,
		array(
			'name' => __('Description size', 'wpv') ,
			'id' => 'description_size',
			'default' => 12,
			'type' => 'range',
			'min' => 8,
			'max' => 45,
		) ,
		array(
			'name' => __('Use a link instead of a button', 'wpv') ,
			'id' => 'no_button',
			'default' => false,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Use full width image', 'wpv') ,
			'id' => 'fullimage',
			'default' => false,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Class', 'wpv') ,
			'id' => 'class',
			'type' => 'text'
		) ,
	) ,
);
