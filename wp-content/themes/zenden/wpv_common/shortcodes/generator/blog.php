<?php
return array(
	'name' => 'Blog',
	'value' => 'blog',
	'options' => array(
		array(
			'name' => __('Count', 'wpv') ,
			'desc' => __('Number of posts to show per page', 'wpv') ,
			'id' => 'count',
			'default' => '3',
			'min' => 1,
			'max' => 50,
			'step' => '1',
			'type' => 'range'
		) ,
		array(
			'name' => __('Parent column', 'wpv') ,
			'id' => 'width',
			'desc' => __('If you have put this shortcode in a column, you need to specify the width of the parent column', 'wpv') ,
			'default' => 'full',
			'type' => 'select',
			'options' => array(
				'full' => 'full',
				'three_fourths' => '3/4',
				'two_thirds' => '2/3',
				'one_half' => '1/2',
				'one_third' => '1/3',
				'one_fourth' => '1/4',
			),
		) ,
		array(
			'name' => __('Split', 'wpv') ,
			'id' => 'split',
			'desc' => __('You can split the blog over several columns. This option works only if the blog shortcode is not inside a column shortcode', 'wpv') ,
			'default' => 1,
			'type' => 'select',
			'options' => array(
				1 => 'full',
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
			),
		) ,
		array(
			'name' => __('Category (optional)', 'wpv') ,
			'id' => 'cat',
			'default' => array() ,
			'target' => 'cat',
			'type' => 'multiselect',
		) ,
		array(
			'name' => __('Posts (optional)', 'wpv') ,
			'desc' => __('If you select any posts here, this option will override the category option above', 'wpv') ,
			'id' => 'posts',
			'default' => array() ,
			'target' => 'post',
			'type' => 'multiselect',
		) ,
		array(
			'name' => __('Image', 'wpv') ,
			'id' => 'image',
			'desc' => __('If the option is on, it will display Featured Image of blog post', 'wpv') ,
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Image position', 'wpv') ,
			'id' => 'img_style',
			'default' => 'side',
			'type' => 'select',
			'options' => array(
				'side' => 'Left',
				'right side' => 'Right',
				'full' => 'Full width'
			) ,
		) ,
		array(
			'name' => __('Meta Information', 'wpv') ,
			'id' => 'meta',
			'desc' => __('If the option is on, it will display Meta Information of blog post', 'wpv') ,
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Display Full Post', 'wpv') ,
			'id' => 'full',
			'desc' => __('If the option is on, it will display the content of the post, otherwise it will display the excerpt', 'wpv') ,
			'default' => false,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Nopaging', 'wpv') ,
			'id' => 'nopaging',
			'desc' => __('If the option is on, it will disable pagination', 'wpv') ,
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('News style', 'wpv') ,
			'id' => 'news',
			'default' => false,
			'type' => 'toggle'
		) ,
	) ,
);
