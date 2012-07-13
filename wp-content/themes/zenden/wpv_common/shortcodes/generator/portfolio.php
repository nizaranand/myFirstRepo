<?php
return array(
	'name' => __('Portfolio', 'wpv') ,
	'value' => 'portfolio',
	'options' => array(
		array(
			'name' => __('Column', 'wpv') ,
			'id' => 'column',
			'default' => '4',
			'options' => array(
				'1' => sprintf(__('%d Column', 'wpv') , 1) ,
				'2' => sprintf(__('%d Columns', 'wpv') , 2) ,
				'3' => sprintf(__('%d Columns', 'wpv') , 3) ,
				'4' => sprintf(__('%d Columns', 'wpv') , 4) ,
			) ,
			'type' => 'select',
		) ,
		array(
			'name' => __('Parent column', 'wpv') ,
			'id' => 'width',
			'desc' => __('If you have put this shortcode in a column, you need to specify the width of the parent column', 'wpv') ,
			'default' => '1',
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
			'name' => __('No Paging', 'wpv') ,
			'id' => 'nopaging',
			'desc' => __('If the option is on, it will disable pagination', 'wpv') ,
			'default' => false,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Max', 'wpv') ,
			'desc' => __('Number of item to show per page. If you set it to -1, it will display all portfolio items', 'wpv') ,
			'id' => 'max',
			'default' => '8',
			'min' => -1,
			'max' => 100,
			'step' => '1',
			'type' => 'range'
		) ,
		array(
			'name' => __('Image height', 'wpv') ,
			'id' => 'height',
			'default' => '400',
			'min' => 0,
			'max' => 1200,
			'type' => 'range'
		) ,
		array(
			'name' => __('Sortable', 'wpv') ,
			'id' => 'sortable',
			'desc' => __('If the option is on, it will disable pagination, displaying all posts by category with sortable.', 'wpv') ,
			'default' => false,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Categories (optional)', 'wpv') ,
			'id' => 'cat',
			'default' => array() ,
			'target' => 'portfolio_category',
			'type' => 'multiselect',
		) ,
		array(
			'name' => __('Ids (optional)', 'wpv') ,
			'desc' => __('The specific portfolios you want to display', 'wpv') ,
			'id' => 'ids',
			'default' => array() ,
			'target' => 'portfolio',
			'type' => 'multiselect',
		) ,
		array(
			'name' => __('Display Title', 'wpv') ,
			'id' => 'title',
			'desc' => __('If the option is on, it will display title of portfolio.', 'wpv') ,
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Display Description', 'wpv') ,
			'id' => 'desc',
			'desc' => __('If the option is on, it will display description of portfolio.', 'wpv') ,
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Display More Button', 'wpv') ,
			'id' => 'more',
			'desc' => __('If the option is on, it will display more button.', 'wpv') ,
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('More Button Text', 'wpv') ,
			'id' => 'moreText',
			'default' => __('Read more', 'wpv') ,
			'type' => 'text',
		) ,
		array(
			'name' => __('Group', 'wpv') ,
			'id' => 'group',
			'desc' => __('If the option is on, the lightbox will display left and right arrow.', 'wpv') ,
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Long description', 'wpv') ,
			'id' => 'long',
			'default' => false,
			'type' => 'toggle'
		) ,
	) ,
);
