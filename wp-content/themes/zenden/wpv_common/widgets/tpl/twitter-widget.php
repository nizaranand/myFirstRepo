<?php

wp_enqueue_script('front-jquery.tweet');

if(!empty($user_array) || $query != "null"):
	echo $before_widget;

	if ($title)
		echo $before_title . $title . $after_title;

	$id = rand(1, 1000);
?>
		
<script type="text/javascript">
	jQuery(function($) {
		$("#twitter_wrap_<?php echo $id; ?>").tweet({
			username: [<?php echo implode(',', $user_array); ?>],
			count: <?php echo $count; ?>,
			query: <?php echo $query; ?>,
			avatar_size: <?php echo $avatar_size; ?>,
			seconds_ago_text: '<?php _e('about %d seconds ago', 'wpv'); ?>',
			a_minutes_ago_text: '<?php _e('about a minute ago', 'wpv'); ?>',
			minutes_ago_text: '<?php _e('about %d minutes ago', 'wpv'); ?>',
			a_hours_ago_text: '<?php _e('about an hour ago', 'wpv'); ?>',
			hours_ago_text: '<?php _e('about %d hours ago', 'wpv'); ?>',
			a_day_ago_text: '<?php _e('about a day ago', 'wpv'); ?>',
			days_ago_text: '<?php _e('about %d days ago', 'wpv'); ?>',
			view_text: '<?php _e('view tweet on twitter', 'wpv'); ?>',
			template: "<?php wpvge('twitter-template')?>"
		});
	});
</script>
<div id="twitter_wrap_<?php echo $id; ?>" class="twitter_wrap clearfix <?php if ($avatar_size != 'null'):?>with_avatar<?php endif; ?>"></div>

<?php

echo $after_widget;
endif; 
