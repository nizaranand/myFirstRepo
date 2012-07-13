<?php
/**
 * general site layout tool
 */
?>

<?php
	$overall = wpv_get_option($overall);
	$left = wpv_get_option($left);
	$right = wpv_get_option($right);
	$header = wpv_get_option($header);
	$slider_selector = $slider;
	$slider = wpv_get_option($slider);
?>

<script>
	WPV_LAYOUT_TRANSLATIONS = {
		enable: '<?php _e('Enabled', 'wpv') ?>',
		disable: '<?php _e('Disabled', 'wpv') ?>'
	}
</script>

<div class="wpv-config-row no-desc">
	<h4><?php echo $name?></h4>
	
	<div class="content">
		<div class="wpv-layout-wrap" 
			 data-min="<?php echo $min_width?>" 
			 data-max="<?php echo $max_width?>" 
			 data-pane="<?php echo $pane?>"
			 data-site="<?php echo $overall?>"
			 data-left="<?php echo $left?>"
			 data-right="<?php echo $right?>"
			 data-header="<?php echo $header?>"
			 data-slider="<?php echo $slider?>"
			 data-slider-selector="<?php echo $slider_selector?>"
		>
			<div class="layout-inner-content" >
				<div class="ui-layout-west innerwest loelement locontent left-sidebar">
					<div class="lo-info">
						<?php _e('Left body sidebar', 'wpv') ?>
						<div class="size"><?php echo $left?>px</div>
					</div>
					<div class="lo-toggle bottom" data-type="body-sidebars-left"></div>
				</div>

				<div class="ui-layout-center loelement locontent innercenter center-width">
					<div class="lo-info">
						<div <?php if($min_width==$max_width) echo 'style="display:none"'?>>
							<?php _e('Site width:', 'wpv') ?>
							<span class="size-none"><?php echo $overall?>px</span>
							<br />
						</div>

						<?php _e('Body content width:', 'wpv') ?>
						<span class="size-both"><?php echo $overall-$left-$right?>px</span>
					</div>
				</div>

				<div class="ui-layout-east innereast loelement locontent right-sidebar">
					<div class="lo-info">
						<?php _e('Right body sidebar', 'wpv') ?>
						<div class="size"><?php echo $right?>px</div>
					</div>
					<div class="lo-toggle bottom" data-type="body-sidebars-right"></div>
				</div>
	
				<div class="footer-wrapper ui-layout-south loelement locontent">
					<div class="footer-widgets">
						<div class="lo-info">
							<?php _e('Footer widget areas', 'wpv') ?>
						</div>
						<div class="lo-toggle" data-for="has-footer-sidebars"></div>
					</div>
					<div class="footer-credits">
						<div class="lo-info"><?php _e('Subfooter', 'wpv') ?></div>
					</div>
				</div>

				<div class="layout-header-wrapper ui-layout-north loelement locontent">
					<div class="layout-header loelement locontent header-height">
						<div class="lo-info">
							<?php _e('Header height:', 'wpv') ?>
							<span class="size"><?php echo $header?>px</span>
						</div>
					</div>
						
					<div class="layout-slider loelement locontent slider-height">
						<div class="lo-info">
							<?php _e('Slider height:', 'wpv') ?>
							<span class="size"><?php echo $slider?>px</span>
						</div>
						<div class="lo-toggle" data-for="has-header-slider"></div>
					</div>
		
					<div class="layout-header-widgets loelement locontent">
						<div class="lo-info"><?php _e('Header widget areas', 'wpv')?></div>
						<div class="lo-toggle" data-for="has-header-sidebars"></div>
					</div>
				</div>
			</div>
			
			<div class="margin-west loelement">
			</div>
			
			<div class="margin-east loelement">
			</div>

		</div>	
	</div>
</div>