<?php
	wp_enqueue_script('front-wpvslider.uncompressed');
	wp_enqueue_script('front-wpvslider.fx');
	wp_enqueue_script('front-jquery.easing');
	global $post;

	$slider_effect = wpv_post_default('slider-effect', 'header-slider-effect');
	$slider_style = get_slider_design($slider_effect);
	//$width = (int)wpv_get_option('content-width');
	//$width += 40;
	$width = 1060;
	
	if($slider_style == 'side-caption') {
		$width -= 300;
	}
	
	if($slider_style == 'peek') {
		$width -= 180;
	}

      $height = intval(wpv_post_default('slider-height', 'header-slider-height'));
 
	$animation_time = (int)wpv_post_default('slider-animation-time', 'header-slider-animationtime');
	$subcaption_animation_duration = min($animation_time-100, 350);
?> 

<div id="main-slider-loading-mask"></div>
<div id="header-slider-caption-wrapper"></div>
<div id="header-slider" class="invisible">
	<?php
		$query = array(
			'post_type' => 'slideshow',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		);
		
		global $post;
		$cat = wpv_post_default('slider-category' , 'default-header-slider');
		$query['tax_query'] = array(
			array(
				'taxonomy' => 'slideshow_category',
				'field' => 'slug',
				'terms' => $cat,
				'operator' => 'IN',
			)
		);
		
		query_posts($query);
		while(have_posts()): the_post();
			
				$thumbnail_id = get_post_thumbnail_id();
				$html_slide = $thumbnail_id <= 0;

				$image = '';
				if(!$html_slide) {
					$image = wp_get_attachment_image_src( $thumbnail_id, 'full');
					$slide_width = $image[1];
					$slide_height = $image[2];
					$image = $image[0];
				}

				$background = get_post_meta(get_the_id(), 'background', true);
				//$href = get_post_meta(get_the_id(), 'slide-link', true);
				$link_target = get_post_meta(get_the_id(), 'slide-link-target', true);
				
				//if(!empty($href)) {
				//	$href = "data-href='$href' data-target='$link_target'";
				//} else {
					$href = '';
				//}
				
				$style = '';
				if(!empty($background)) {
					$style .= "background:$background; ";
				}
				
				$style = "data-style='$style'";
				
				if(!$html_slide):
					$content = get_post_meta(get_the_id(), 'first-caption', true);
					$caption_id = '';
					if(!empty($content)) {
						$caption_id = '#caption-'.get_the_id();
						$captions[] = array(
							'id' => 'caption-'.get_the_id(),
							'first' => apply_filters('the_content', $content),
							'second' => apply_filters('the_content', get_post_meta(get_the_id(), 'second-caption', true)),
							'third' => apply_filters('the_content', get_post_meta(get_the_id(), 'third-caption', true)),
						);
					}
	?>
					<img src="<?php echo $image?>" data-thumb="<?php echo $image?>" alt="<?php echo $caption_id?>" class="wpv-slide" <?php echo "$style $href"?> width="<?php echo $slide_width?>" height="<?php echo $slide_height?>"/>
				<?php else: ?>
					<div class="wpv-slide" <?php echo "$style $caption_style $href"?> data-thumb="<?php echo $image?>">
						<div style="width:<?php echo $width ?>px"><?php echo apply_filters('the_content', get_post_meta(get_the_id(), 'first-caption', true)) ?></div>
					</div>
				<?php endif ?>				
	<?php
		endwhile;
		wp_reset_query();
	?>
</div>
<div class="hidden">
	<?php if(is_array($captions)): ?>
		<?php foreach($captions as $caption): ?>
			<div id="<?php echo $caption['id']?>" class="wpv-caption-origin">
				<div class="main-caption sub-caption" data-animation-duration="<?php echo $subcaption_animation_duration ?>"><?php echo $caption['first']?></div>
				<?php if(!empty($caption['second'])): ?>
					<div class="helper-caption-1 sub-caption" data-animation-duration="<?php echo $subcaption_animation_duration ?>"><?php echo $caption['second']?></div>
				<?php endif ?>
				<?php if(!empty($caption['third'])): ?>
					<div class="helper-caption-2 sub-caption" data-animation-duration="<?php echo $subcaption_animation_duration ?>"><?php echo $caption['third']?></div>
				<?php endif ?>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>

<script>
	jQuery(function($) {
	    $('#header-slider').wpvSlider({
	     //<?php echo wpv_get_option('content-width');?>
			
	    	captionContainer : "#header-slider-caption-wrapper",
			height: <?php if((int)$height): echo $height; else: ?> $(window).height() <?php endif ?>,
	    	width: <?php echo $width ?>,
	    	pause_time: <?php wpvge('header-slider-pausetime')?>,
	    	animation_time: <?php echo $animation_time ?>,
	    	effect: '<?php echo $slider_effect?>',
	    	auto_direction: '<?php wpvge('header-slider-direction')?>',
	    	caption_opacity: <?php wpvge('header-slider-captionopacity')?>,
	    	expand: <?php echo intval( wpv_post_default('slider-fullwidth', 'has-fullwidth-slider') == 'true' )?>,
	    	prev_text: '<?php wpvge('header-slider-prevtext')?>',
	    	next_text: '<?php wpvge('header-slider-nexttext')?>',
	    	autoHeight: <?php echo intval(wpv_get_option('header-slider-autoheight'))?>,
	    	pause_on_hover: <?php echo intval(wpv_get_option('header-slider-pauseonhover'))?>,
       	    	resizing: '<?php echo wpv_get_slider_resizing($slider_effect)?>',
	    	
                    resizing: 'fit',
			pagerContainer : "#stage",
			captionContainer : "#stage-caption-wrapper",
			navContainer : "#stage",
			loadingMask : "#main-slider-loading-mask",
                   
	        effect_settings: {
		        easing: '<?php echo wpv_post_default('slider-easing', 'header-slider-easing')?>',
		        waveDuration: <?php echo $animation_time?>, 
		        subslideDuration: 0,
		        waveType: '<?php wpvge('header-slider-wavetype')?>',
		        visibleGrid: <?php echo intval(wpv_get_option('header-slider-visiblegrid'))?>,
		        rows: <?php echo intval(wpv_get_option('header-slider-rows'))?>, 
		        cols: <?php echo intval(wpv_get_option('header-slider-cols'))?>, 
		        caption_animation_time: <?php wpvge('header-slider-animationtime') ?>,
		        caption_queue: false
	              }
	    });

		<?php if(!(int)$height): ?>
			$(window).bind('resize', function() {
				$('#header-slider').wpvSlider('setHeight', $(window).height());
			});
		<?php endif ?>
	});
</script>