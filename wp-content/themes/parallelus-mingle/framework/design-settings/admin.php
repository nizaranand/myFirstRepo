<?php

global $design_settings_settings, $design_settings;

//  __d($_POST);

	//echo '<pre>Post:';
	//print_r($_POST);
	//echo '</pre>';

	//echo '<pre>Keys:';
	//print_r($design_settings_settings->keys);
	//echo '</pre>';	


$required = '<em class="required">' . __('Required', THEME_NAME) . '</em>';
$_data = $design_settings_settings->data;


switch ($design_settings_settings->navigation) {
case 'design_setting':

	require_once('admin-designSettings.php');
	break;

case 'slideshow':
case 'slide':

	require_once('admin-slideshow.php');
	break;

case 'top_graphic':

	require_once('admin-topGraphic.php');
	break;

case 'sidebar':

	require_once('admin-sidebar.php');
	break;

case 'page_header':

	require_once('admin-pageHeader.php');
	break;

case 'page_footer':

	require_once('admin-pageFooter.php');
	break;

case 'layout':

	require_once('admin-pageLayout.php');
	break;

default:

	require_once('admin-default.php');
	
}  

	//echo '<pre>';
	//print_r($design_settings_settings->data);
	//echo '</pre>';

	//echo '<pre>';
	//print_r($design_settings_settings->default);
	//echo '</pre>';
?>