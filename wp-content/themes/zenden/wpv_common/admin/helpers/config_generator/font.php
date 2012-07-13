<?php
	global $wpv_fonts;

	$current_size = wpv_get_option($id.'-size');
	$current_lheight = wpv_get_option($id.'-lheight');
	$current_face = wpv_get_option($id.'-face');
	$current_weight = wpv_get_option($id.'-weight');
	$current_color = wpv_get_option($id.'-color');
	
	$weights = array(
		'normal',
		'italic',
		'bold',
		'bold italic',
	);
	
	if(!isset($only)) {
		$only = array();
	} else {
		$only = explode(',', $only);
	}
	
	$show = new stdClass;
	$show->size = (in_array('size', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->size_lheight_sep = ( (in_array('size', $only) && in_array('lheight', $only)) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->lheight = (in_array('lheight', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->face = (in_array('face', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->weight = (in_array('weight', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->color = (in_array('color', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->size_desc = (in_array('size', $only) || sizeof($only) == 0)  ? '' : 'invisible';
	$show->lheight_desc = (in_array('lheight', $only) || sizeof($only) == 0)  ? '' : 'invisible';
?>

<div class="wpv-config-row font">

	<h4><?php echo $name?></h4>

	<select name="<?php echo $id?>-size" class="size <?php echo $show->size?> <?php wpv_static($value)?>">
		<?php for($i = $min; $i<=$max; $i++): ?>
			<option value="<?php echo $i?>" <?php selected($i, $current_size) ?>><?php echo $i?> px</option>
		<?php endfor ?>
	</select>
		
	<span class="<?php echo $show->size_lheight_sep?>">/</span>
		
	<select name="<?php echo $id?>-lheight" class="lheight <?php echo $show->lheight?> <?php wpv_static($value)?>">
		<?php for($i = $lmin; $i<=$lmax; $i++): ?>
			<option value="<?php echo $i?>" <?php selected($i, $current_lheight) ?>><?php echo $i?> px</option>
		<?php endfor ?>
	</select>
		
	<select name="<?php echo $id?>-face" class="face <?php echo $show->face?> <?php wpv_static($value)?>">
		<?php foreach($wpv_fonts as $face => $font): ?>
			<option value="<?php echo $face?>" <?php selected($face, $current_face) ?>><?php echo $face?></option>
		<?php endforeach ?>
	</select>
	
	<select name="<?php echo $id?>-weight" class="weight <?php echo $show->weight?> <?php wpv_static($value)?>">
		<?php foreach($weights as $w): ?>
			<option value="<?php echo $w?>" <?php selected($w, $current_weight) ?>><?php echo ucwords($w)?></option>
		<?php endforeach ?>
	</select>
	
	<span class="<?php echo $show->color?>">
		<input type="color" name="<?php echo $id?>-color" class="color <?php wpv_static($value)?>" data-hex="true" value="<?php echo $current_color?>" />
	</span>
	
	<div class="clearfix font-descriptions">
		<div class="font-size-desc <?php echo $show->size_desc?>"><?php _e('font size', 'wpv')?></div>
		<div class="line-height-desc <?php echo $show->lheight_desc?>"><?php _e('line height', 'wpv')?></div>
	</div>
	
	<div class="font-preview"><?php _e('The quick brown fox jumps over the lazy dog', 'wpv')?></div>
	<div class="font-styles"></div>
</div>