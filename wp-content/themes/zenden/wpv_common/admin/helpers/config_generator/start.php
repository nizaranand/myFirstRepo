<?php
/**
 * begin section
 */

$id = $name;
if(isset($sub)) {
	$id = "$sub $id";
}
$id = preg_replace('/[^\w]+/', '-', strtolower($id));

global $wpv_loaded_config_groups;
?>
<div class="wpv-config-group <?php if($wpv_loaded_config_groups++ > 0):?>ui-tabs-hide<?php endif?>" id="<?php echo $id?>-tab">
