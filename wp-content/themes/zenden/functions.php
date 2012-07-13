<?php
//Zenden Specific Stuff
require_once('wpv_common/wpv_framework.php');
new Wpv_Framework(array(
	'name' => 'zenden',
	'slug' => 'zenden'
));

//My Stuff
if(!is_admin()){
	add_action('wp_enqueue_scripts','id_load_scripts');
}

function id_load_scripts(){
	$dir = get_bloginfo('stylesheet_directory').'/';
	$js = $dir.'js/';

	//wp_register_script( $handle, $src, $deps, $ver, $in_footer );
	//wp_enqueue_script( $handle,$src,$deps,$ver,$in_footer );
	wp_register_script( 'cycle', $js.'/cycle.js',array('jquery'), false,false);
	wp_register_script( 'global', $js.'/global.js',array('jquery'), false, false);
	
	wp_enqueue_script('cycle');
	wp_enqueue_script('global');

}
