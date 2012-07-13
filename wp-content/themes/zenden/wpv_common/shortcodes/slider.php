<?php

function wpv_shortcode_slider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 0,
		'effect' => 'random',
		'caption_opacity' => 1,
		'animspeed' => 400,
		'pausetime' => 5000,
		'pauseonhover' => 'true',
		'style' => '',
		'annotation' => '',
		'highlight' => 'false',
	), $atts));
	
	if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches))
		return 'error parsing slider shortcode';

	wp_enqueue_script('front-wpvslider.uncompressed');
	wp_enqueue_script('front-wpvslider.fx');
	wp_enqueue_script('front-jquery.easing');

	$params = array();
	for($i=0; $i < count($matches[0]); $i++)
		$params[$i] = shortcode_parse_atts($matches[3][$i]);

	$id = md5(uniqid('', true));
	
	ob_start();
	
	$captions = array();
	
	$height = ($height == 'auto' || strval($height) == '0') ? $height : $height . 'px';
	
?>
[raw]
	<div class="slider-shortcode-wrapper style-<?php echo $style?> <?php if($highlight=='true') echo 'highlight'?>" style="height:<?php echo $height?>; <?php if($width>0): ?>width:<?php echo $width?>px<?php endif ?>">
		<div class="annotation"><?php echo $annotation?></div>
		<div id="slider-caption-wrapper-<?php echo $id?>" class="slider-caption-wrapper"></div>
		<div id="slider-<?php echo $id?>" class="slider-shortcode">
			<?php for($i=0; $i < count($matches[0]); $i++): ?>
				<?php if(!empty($params[$i]['img'])): ?>
					<?php
						$capt_id = '';
						
						if(!preg_match('/^\s*$/', $matches[5][$i])) {
							$capt_id = 'slider-'.$id.'-caption-'.$i;
							
							$captions[] = array(
								'id' => $capt_id,
								'content' => $matches[5][$i],
							); 
						}
					?>
					<img src="<?php echo $params[$i]['img'] ?>" <?php if(!empty($capt_id)) echo 'alt="#'.$capt_id.'"'; ?> class="wpv-slide" data-thumb="<?php echo $params[$i]['img'] ?>"/>
				<?php elseif(!empty($matches[5][$i])): ?>
					<?php $html_slide_width = !empty($width)?'style="width:'.apply_filters('wpv_shortcode_slider_width', $width, $style).'px"' : '';?>
					<div class="wpv-slide"><div <?php echo $html_slide_width?>><?php echo wpv_clean_do_shortcode($matches[5][$i]) ?></div></div>
				<?php endif ?>
			<?php endfor; ?> 
		</div>
	</div>
	<div class="hidden">
		<?php foreach($captions as $capt): ?>
			<div id="<?php echo $capt['id']?>"><div class="main-caption"><?php echo wpv_clean_do_shortcode($capt['content'])?></div></div>
		<?php endforeach ?>
	</div>
	<script>
		jQuery(function($) {
		    $('#slider-<?php echo $id?>').wpvSlider({
		    	captionContainer : "#slider-caption-wrapper-<?php echo $id?>",
		    	height: "<?php echo $height?>",
		    	width: <?php echo apply_filters('wpv_shortcode_slider_width', $width, $style)?>,
		    	pause_time: <?php echo $pausetime?>,
		    	animation_time: <?php echo $animspeed?>,
		    	effect: '<?php echo $effect?>',
		    	auto_direction: 'right',
		    	caption_opacity: <?php echo $caption_opacity?>,
		    	expand: false,
		    	prev_text: '<?php _e('Previous', 'wpv')?>',
		    	next_text: '<?php _e('Next', 'wpv')?>',
		    	pause_on_hover: <?php echo $pauseonhover?>,
		    	resize: 'fit',
		    	effect_settings: {
			        waveDuration: <?php echo $animspeed?>, 
			        subslideDuration: <?php echo intval(1.5*$animspeed) ?>,
			        rows: <?php echo $height == 'auto' ? 4 : ceil(intval($height)/100)?>, 
			        cols: <?php echo ceil($width/100)?>
		        }
		    });
		});
	</script>
[/raw]	
<?php
	return ob_get_clean();
}
add_shortcode('slider', 'wpv_shortcode_slider');
