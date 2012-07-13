<?php
	$width_divisors = array(
		'full' => array(1, 1),
		'one_half' => array(1, 2),
		'one_third' => array(1, 3),
		'two_thirds' => array(2, 3),
		'one_fourth' => array(1, 4),
		'three_fourths' => array(3, 4),
		'one_fifth' => array(1, 5),
		'two_fifths' => array(2, 5),
		'three_fifths' => array(3, 5),
		'four_fifths' => array(4, 5),
		'one_sixth' => array(1, 6),
		'five_sixths' > array(5, 6)
	);
	
	if(isset($width_divisors[0])) {
		unset($width_divisors[0]);
	}
?>

.portfolio_one_column .portfolio_image {
	float: left;
}

.portfolio_one_column .portfolio_details {
	float: right;
}

<?php foreach($page_content_widths as $class=>$width): ?>
	
	.<?php echo $class?>,
	.<?php echo $class?> .entry-content,
	.<?php echo $class?> .page-content {
		width: <?php echo $width?>px;
	}
	
	.<?php echo $class?> .post-article {
		width: <?php echo $width-41-10?>px;
	}
	
	.one_half .<?php echo $class?> .post-article, 
	.one_third .<?php echo $class?> .post-article, 
	.two_thirds .<?php echo $class?> .post-article, 
	.three_fourths .<?php echo $class?> .post-article, 
	.one_fourth .<?php echo $class?> .post-article, 
	.one_fifth .<?php echo $class?> .post-article, 
	.two_fifths .<?php echo $class?> .post-article, 
	.three_fifths .<?php echo $class?> .post-article, 
	.four_fifths .<?php echo $class?> .post-article, 
	.one_sixth .<?php echo $class?> .post-article, 
	.five_sixths .<?php echo $class?> .post-article, 
	.full .<?php echo $class?> .post-article {
		width: <?php echo $width-10?>px;	
	}
	
	.<?php echo $class?> .post-content.sideimage {
		width: <?php echo max(($width - 21-10) - (int) wpv_get_option('post-thumbnail-width') - 58, 0) ?>px;
	}
	
	.<?php echo $class?> .jp-audio {
		max-width: <?php echo $width-21-10?>px;
	}
	
	<?php foreach($width_divisors as $div_class=>$div_fraction): ?>
		
		<?php
			$level_1 = ($width - ($div_fraction[1]-1)*20)/$div_fraction[1]*$div_fraction[0] + ($div_fraction[0]-1)*20;
		?>
		
		<?php
			$column_class = array('one_column', 'two_columns', 'three_columns', 'four_columns');
			foreach($column_class as $col=>$col_class):
		?>
		
			<?php if($col == 0): ?>
				.<?php echo $class?> .portfolios .portfolio_<?php echo $col_class?>.inner_<?php echo $div_class?> li {
					width: <?php echo $level_1?>px;
				}
				
				<?php if($div_class == 'full'): ?>
					.<?php echo $class?>.type-portfolio .portfolio_image_wrapper,
				<?php endif ?>
				.<?php echo $class?> .portfolios .portfolio_<?php echo $col_class?>.inner_<?php echo $div_class?> .portfolio_image {
					width: <?php echo max(intval(0.7*$level_1)-20, 0)?>px;
				}
				
				<?php if($div_class == 'full'): ?>
					.<?php echo $class?>.type-portfolio .portfolio_details,
				<?php endif ?>
				.<?php echo $class?> .portfolios .portfolio_<?php echo $col_class?>.inner_<?php echo $div_class?> .portfolio_details {
					width: <?php echo (intval(0.3*$level_1))+10?>px; <?php // + 10px to fit to 940px ?>
				}
			<?php else: ?>
				.<?php echo $class?> .portfolios .portfolio_<?php echo $col_class?>.inner_<?php echo $div_class?> li {
					width: <?php echo max(intval( ($level_1 - 20*$col)/($col+1) ), 0)?>px;
				}
			<?php endif ?>
		
		<?php endforeach ?>
		
		.<?php echo $class ?> .page-content > .<?php echo $div_class?>,
		.<?php echo $class ?> .post-content > .<?php echo $div_class?>,
		.<?php echo $class ?> .entry-content > .<?php echo $div_class?> {
			margin-right: 20px;
			width: <?php echo $level_1 ?>px;
		}
		
		.<?php echo $class ?> .post-article .post-content > .<?php echo $div_class?> {
			margin-right: 20px;
			width: <?php echo $level_1-20 ?>px;
		}
		
		.<?php echo $class?> .loop-wrapper.<?php echo $div_class?> > * {
			width: <?php echo $level_1?>px;
		}
		
		.<?php echo $class?> .loop-wrapper.<?php echo $div_class?> .post-article {
			<?php if($div_class == 'full'): ?>
				width: <?php echo $level_1-10-10?>px;
			<?php else: ?>
				width: <?php echo $level_1-10-10?>px;
			<?php endif ?>
		}
		
		.<?php echo $class?> .loop-wrapper.<?php echo $div_class?> .post-content-outer.sideimage {
			<?php if($div_class == 'full'): ?>
				width: <?php echo max(($level_1 - 21-10) - (int) wpv_get_option('post-thumbnail-width') - 28, 0) ?>px;
			<?php else: ?>
				width: <?php echo max($level_1 - (int) wpv_get_option('post-thumbnail-width') - 28, 0) ?>px;
			<?php endif ?>
		}
		
		.<?php echo $class?> .loop-wrapper.<?php echo $div_class?> .jp-audio {
			<?php if($div_class == 'full'): ?>
				max-width: <?php echo $level_1-21-10?>px;
			<?php else: ?>
				max-width: <?php echo $level_1?>px;
			<?php endif ?>
		}
		
		<?php foreach($width_divisors as $div_class_2=>$div_fraction_2): ?>
			
			<?php $level_2 = max(($level_1 - ($div_fraction_2[1]-1)*20)/$div_fraction_2[1]*$div_fraction_2[0] + ($div_fraction_2[0]-1)*20, 0) ?>
			
			<?php if($div_class == 'four_fifths'): ?>
				.<?php echo $class ?> .slider-shortcode-wrapper.style-showcase .wpv-slide > .<?php echo $div_class_2?>,
			<?php endif ?>
			.<?php echo $class ?> .page-content > .<?php echo $div_class?> > .<?php echo $div_class_2?>,
			.<?php echo $class ?> .page-content > .<?php echo $div_class?> > .<?php echo $div_class_2?>,
			.<?php echo $class ?> .post-content > .<?php echo $div_class?> > .<?php echo $div_class_2?>,
			.<?php echo $class ?> .entry-content > .<?php echo $div_class?> > .<?php echo $div_class_2?>,
			.<?php echo $class ?> .loop-wrapper.<?php echo $div_class?> .page-content > .<?php echo $div_class_2?> {
				margin-right: 20px;
				width: <?php echo $level_2?>px;
			}
			
			.<?php echo $class ?> .post-article .post-content > .<?php echo $div_class?> > .<?php echo $div_class_2?>, {
				margin-right: 20px;
				width: <?php echo $level_2 ?>px;
			}
		<?php endforeach ?> 
		 
	<?php endforeach?>
<?php endforeach ?>
