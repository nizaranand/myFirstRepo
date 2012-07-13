<?php

/**
 * shortcodes resembling some of the custom widgets
 */

function wpv_shortcode_contactform($atts,$content = null) {
	extract(shortcode_atts(array(
		'email' => get_bloginfo('admin_email'),
	), $atts));
	
    $content = trim($content);
	if(!empty($content))
		$success = do_shortcode($content);

	if(empty($success))
		$success = __('Your message was successfully sent. <strong>Thank You!</strong>', 'wpv');

	$name_str = __('Name *', 'wpv');
	$email_str = __('Email *', 'wpv');
	$submit_str = __('Submit', 'wpv');
	
	$include_path = WPV_INCLUDES;
	
	ob_start();
	
	include WPV_SHORTCODE_TEMPLATES . 'contactform.php';
	
	return ob_get_clean();
}
add_shortcode('contactform', 'wpv_shortcode_contactform');

function wpv_shortcode_twitter($atts) {
	extract(shortcode_atts(array(
		'username' => '',
		'count' => 3,
		'query' => 'null',
		'avatarsize' => 'null',
	), $atts));
	
	$user_array = explode(', ',$username);
	foreach($user_array as $key => $user)
		$user_array[$key] = '"'.$user.'"';
	
	$id = rand(1,1000);
	
	$seconds_ago_text = __('about %d seconds ago', 'wpv');
	$a_minutes_ago_text = __('about a minute ago', 'wpv');
	$minutes_ago_text = __('about %d minutes ago', 'wpv');
	$a_hours_ago_text = __('about an hour ago', 'wpv');
	$hours_ago_text = __('about %d hours ago', 'wpv');
	$a_day_ago_text = __('about a day ago', 'wpv');
	$days_ago_text = __('about %d days ago', 'wpv');
	$view_text = __('view tweet on twitter', 'wpv');
	
	if (!empty($user_array) || $query!='null') {
		$username = implode(',',$user_array);
		if($query != "null")
			$query = '"'.html_entity_decode($query).'"';
		$with_avatar = ($avatarsize != 'null')?' with_avatar':'';
		
		$template = wpv_get_option('twitter-template');

		wp_enqueue_script('front-jquery.tweet');

		return <<<HTML
[raw]
<div class="twitter_wrap{$with_avatar}">
<script type="text/javascript">
jQuery(function($) {
	$("#twitter_wrap_{$id}").tweet({
		username: [{$username}],
		count: {$count},
		query: {$query},
		avatar_size: {$avatarsize},
		seconds_ago_text: '{$seconds_ago_text}',
		a_minutes_ago_text: '{$a_minutes_ago_text}',
		minutes_ago_text: '{$minutes_ago_text}',
		a_hours_ago_text: '{$a_hours_ago_text}',
		hours_ago_text: '{$hours_ago_text}',
		a_day_ago_text: '{$a_day_ago_text}',
		days_ago_text: '{$days_ago_text}',
		view_text: '{$view_text}',
		template: "{$template}"
	});
});
</script>
	<div id="twitter_wrap_{$id}" class="twitter_wrap clearfix"></div>
</div>
[/raw]
HTML;
	}
	
	return '';
}
add_shortcode('twitter', 'wpv_shortcode_twitter');

function wpv_shortcode_flickr($atts) {
	extract(shortcode_atts(array(
		'id' => '',
		'type' => 'user',
		'count' => 4,
		'display' => 'latest'//lastest or random
	), $atts));
	
	return <<<HTML
[raw]
<div class="flickr_wrap clearfix">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count={$count}&amp;display={$display}&amp;size=s&amp;layout=x&amp;source={$type}&amp;{$type}={$id}"></script>
</div>
[/raw]
HTML;
}
add_shortcode('flickr', 'wpv_shortcode_flickr');

function wpv_shortcode_contact_info($atts) {
	extract(shortcode_atts(array(
		'color' => '',
		'phone' => '',
		'cellphone' => '',
		'email' => '',
		'address' => '',
		'city' => '',
		'state' => '',
		'zip' => '',
		'name' => '',
	), $atts));
	
	if(!empty($city) && !empty($state))
		$city = $city.',&nbsp;'.$state;
	elseif(!empty($state))
		$city = $state;
	
	ob_start();
	
	include WPV_SHORTCODE_TEMPLATES . 'contact_info.php';
	
	return ob_get_clean();
}
add_shortcode('contact_info', 'wpv_shortcode_contact_info');

