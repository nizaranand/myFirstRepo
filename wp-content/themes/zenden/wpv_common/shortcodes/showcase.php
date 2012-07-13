<?php

function wpv_shortcode_showcase($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 225,
		'effect' => 'random',
		'animspeed' => 400,
		'pausetime' => 5000,
		'pauseonhover' => 'true',
		'annotation' => '',
		'columns' => 3,
	), $atts));
	
	if (!wpv_sub_shortcode('image', $content, $params, $sub_contents))
		return 'error parsing slider shortcode';

	wp_enqueue_script('front-wpvslider.uncompressed');
	wp_enqueue_script('front-wpvslider.fx');
	wp_enqueue_script('front-jquery.easing');

	$id = md5(uniqid('', true));
	
	ob_start();
	
	$columns = (int)$columns;
	$an_width = $an_margin = 0;
	$slider_an_width = (intval($width) == 0 ? (1-1/($columns)) : floor((1-1/$columns)*$width));
	if(!empty($annotation)) {
		$columns--;
		$col_width = 100/$columns - 3*($columns-1)/$columns;
		
		$an_margin = (0.03*($columns-1)/$columns)*($columns/($columns+1))*100;
		$an_width = 100/($columns+1)-$an_margin;
	} else {
		$col_width = 100/$columns - 3*($columns-1)/$columns;
	}
	
	$html_slide_style = "style='height:{$height}px;".(!empty($width)?'width:'.$width.'px' : '')."'";
?>
[raw]
	<div class="slider-shortcode-wrapper style-showcase-new" style="height:<?php echo $height?>px; <?php if($width>0): ?>width:<?php echo $width?>px<?php endif ?>">
		<?php if(!empty($annotation)): ?>
			<div class="annotation" style="width:<?php echo $an_width?>%;margin-right:<?php echo $an_margin?>%"><div class="annotation-inside"><?php echo $annotation?></div></div>
		<?php endif ?>

		<div id="slider-<?php echo $id?>" class="slider-shortcode">
			<?php $i=0; while($i < count($sub_contents)): ?>
				<div class="wpv-slide"><div class="clearfix" <?php echo $html_slide_style?>>
					<?php for($j=0; $j<$columns && $i < count($sub_contents); $j++, $i++): ?>
						<?php $margin = ($j<$columns-1)?3:0?>
						<img src="<?php echo $sub_contents[$i] ?>" style="float:left;margin-right:<?php echo $margin?>%;width:<?php echo $col_width?>%"/>
					<?php endfor ?>
				</div></div>
			<?php endwhile; ?> 
		</div>
	</div>
	
	<script>
		jQuery(function($) {
		    $('#slider-<?php echo $id?>').wpvSlider({
		    	height: <?php echo $height?>,
		    	width: <?php echo (!empty($annotation) ? 
		    							$slider_an_width :
									$width)?>,
		    	pause_time: <?php echo $pausetime?>,
		    	animation_time: <?php echo $animspeed?>,
		    	effect: '<?php echo $effect?>',
		    	auto_direction: 'right',
		    	expand: false,
		    	prev_text: '<?php _e('Previous', 'wpv')?>',
		    	next_text: '<?php _e('Next', 'wpv')?>',
		    	pause_on_hover: <?php echo $pauseonhover?>,
		    	resize: 'stretch',
		    	effect_settings: {
			        waveDuration: <?php echo $animspeed?>, 
			        subslideDuration: <?php echo intval(1.5*$animspeed) ?>,
			        rows: <?php echo ceil($height/100)?>, 
			        cols: <?php echo ceil($width/100)?>
		        }
		    });
		});
	</script>
[/raw]	
<?php
	return ob_get_clean();
}
add_shortcode('showcase', 'wpv_shortcode_showcase');
