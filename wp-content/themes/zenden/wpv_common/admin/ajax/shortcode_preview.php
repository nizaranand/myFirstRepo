<!doctype html>
<?php
	global $is_shortcode_preview;
	$is_shortcode_preview = true;

	require_once( '../../../../../../wp-load.php' );
?>
<html>
<head>
	<?php
		add_filter('show_admin_bar' , '__return_false');
		add_filter('wpv_show_buttons' , '__return_false');
		/*wp_deregister_script('admin-bar');
		wp_deregister_style('admin-bar');
		remove_action('wp_footer', 'wp_admin_bar_render', 1000);*/
	?>
	<?php wp_head() ?>
	<?php $shortcode = stripslashes($_POST['data']); // why do we need stripslashes to make it work? we don't post it with slashes...?>
	<style>
		html, body {
			background: transparent;
		}
		body {
			<?php // nasty fix, can we do better? ?> 
			<?php if(strpos($shortcode, '[tooltip') !== false):?>
				padding: 100px 10px 10px 150px;
			<?php else: ?>
				padding: 10px;
			<?php endif ?>
		}
	</style>
</head>
<body>
	<?php echo apply_filters('the_content', do_shortcode($shortcode)) ?>
	<?php wp_footer() ?>
</body>	
</html>
