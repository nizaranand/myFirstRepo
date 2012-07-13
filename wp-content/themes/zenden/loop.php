<?php

// display full post/image or thumbs
if(!isset($called_from_shortcode)) {
	$image = $meta = 'true';
	$full = 'true';
	$nopaging = 'false';
	$img_style = 'full';
	$width = 'full';
	$news = 'false';
	$split = 1;
}

$img_style = $img_style.'image';

global $wpv_loop_vars;
$old_wpv_loop_vars = $wpv_loop_vars;
$wpv_loop_vars = array(
	'image' => $image,
	'meta' => $meta,
	'fullpost' => $full,
	'img_style' => $img_style,
	'width' => $width,
	'news' => $news,
);

?>
<div class="loop-wrapper clearfix <?php echo $width?> <?php if($news=='true') echo 'news'?> force-full-width <?php if((int)$split>1) echo 'split'?>">
<?php
$i = 0;
if(have_posts()) while(have_posts()): the_post();

$post_class = !(($i+1)%$split) ? 'last' :
			(!($i%$split) ? 'clearboth' : '');
?>
	<div class="page-content post-head clearfix <?php echo get_post_type()?> <?php echo $post_class ?>">
		<?php
			wpv_post_template(array('video', 'audio'));

			comments_template();
		?>
	</div>
<?php
	$i++;
endwhile;
?>
</div>

<?php $wpv_loop_vars = $old_wpv_loop_vars; ?>
<?php if($nopaging != 'true' && function_exists('wpv_load_more') && $news!='true') wpv_load_more() ?>
