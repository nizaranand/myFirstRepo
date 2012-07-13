<?php	
	$fields = array(
		'color' => __('color', 'wpv'),
		'image' => __('image', 'wpv'),
		'repeat' => __('repeat', 'wpv'),
		'attachment' => __('attachment', 'wpv'),
		'position' => __('position', 'wpv'),
	);

	$current = array();
	$show = array();

	if(!isset($only)) {
		$only = array();
	} else {
		$only = explode(',', $only);
	}

	global $post;
	foreach($fields as $field=>$fname) {
		if(isset($GLOBALS['wpv_in_metabox'])) {
			$current[$field] = get_post_meta($post->ID, "$id-$field", true);
		} else {
			$current[$field] = wpv_get_option("$id-$field");
		}
		$show[$field] = (in_array($field, $only) || sizeof($only) == 0)  ? '' : 'hidden';
	}

	$selects = array(
		'repeat' => array(
			'no-repeat' => __('No repeat', 'wpv'),
			'repeat-x' => __('Repeat horizontally', 'wpv'),
			'repeat-y' => __('Repeat vertically', 'wpv'),
			'repeat' => __('Repeat both', 'wpv'),
		),
		'attachment' => array(
			'scroll' => __('scroll', 'wpv'),
			'fixed' => __('fixed', 'wpv'),
		),
		'position' => array(
			'left center' => __('left center', 'wpv'),
			'left top' => __('left top', 'wpv'),
			'left bottom' => __('left bottom', 'wpv'),
			'center center' => __('center center', 'wpv'),
			'center top' => __('center top', 'wpv'),
			'center bottom' => __('center bottom', 'wpv'),
			'right center' => __('right center', 'wpv'),
			'right top' => __('right top', 'wpv'),
			'right bottom' => __('right bottom', 'wpv'),
		),
	);
?>

<div class="wpv-config-row background top-desc">

	<h4><?php echo $name?></h4>

	<p class="description"><?php echo $desc ?></p>

	<div class="content">
		<input name="<?php echo $id ?>-color" id="<?php echo $id ?>-color" type="color" data-hex="true" value="<?php echo $current['color'] ?>" class="<?php echo $show['color']; wpv_static($value)?>" />

		<?php $_id = $id;	$id .= '-image'; // temporary change the id so that we can reuse the upload field ?>
		<div class="image <?php echo $show['image']; wpv_static($value) ?>">
			<?php include 'upload-basic.php'; ?>
		</div>
		<?php $id = $_id; unset($_id); ?>

		<?php foreach($selects as $s=>$options): ?>
			<select name="<?php echo "$id-$s" ?>" class="<?php echo $s.' '.$show[$s]?> <?php wpv_static($value)?>">
				<?php foreach($options as $val=>$opt): ?>
					<option value="<?php echo $val?>" <?php selected($val, $current[$s]) ?>><?php echo $opt?></option>
				<?php endforeach ?>
			</select>
		<?php endforeach ?>
		
		<div class="clearfix background-descriptions">
			<?php foreach($fields as $field=>$fname): ?>
				<div class="<?php echo $field?>-desc <?php echo $show[$field]?>"><?php echo $fname?></div>
			<?php endforeach ?>
		</div>
	</div>
</div>