<?php 
	/**
	 * config page title
	 */
?>

<div id="wpv-ajax-overlay"></div><div id="wpv-ajax-content"><?php _e('Loading', 'wpv')?></div>

<div id="wpv-config-title">
	<h2><?php echo $name ?></h2>
	<?php if(!empty($desc)): ?><p><?php echo $desc ?></p><?php endif ?>
	<?php global $wpv_config_messages; echo $wpv_config_messages; ?>
	<div id="wpv-config-title-links" class="clearfix">
		<a href="admin.php?page=wpv_help" title="<?php _e('Documentation', 'wpv')?>"><?php _e('Documentation', 'wpv')?></a>
		<a href="http://support.vamtam.com" title="<?php _e('Support', 'wpv')?>"><?php _e('Support', 'wpv')?></a>
		
		<?php if(!isset($no_save_button) || $no_save_button == true):?>
			<input type="submit" name="save-wpv-config" class="button-primary autowidth static" value="<?php isset($_GET['allowreset']) ? _e('Delete options', 'wpv') : _e('Save Changes', 'wpv') ?>" />
		<?php endif ?>
	</div>
</div>

<div id="wpv-config" class="clearfix ui-tabs">
	<ul id="wpv-config-tabs">
		<?php
		$tabs = array();
		
		foreach($this->options as $option) {
				if($option['type'] == 'start') {
					$href = $option['name'];
					if(isset($option['sub'])) {
						$href = $option['sub']." $href";
					}
					$href = preg_replace('/[^\w]+/', '-', strtolower($href));
					$tabs[]= array(
						'href' => $href,
						'sub' => isset($option['sub']),
						'parent' => isset($option['sub']) ? $option['sub'] : '',
						'name' => $option['name'],
					);
				}
		}
		
		foreach($tabs as $i=>$tab):
			$class = array();
			if($tab['sub']) {
				$class[] = 'sub';
				if(isset($tabs[$i+1]) && !$tabs[$i+1]['sub']) {
					$class[] = 'last-sub';
				}
			}
			else {
				$class[] = 'parent';
			}
				
			if($i == 0) {
				$class[] = 'ui-tabs-selected';
			}
		?>
			<li class="<?php echo implode(' ', $class)?>">
				<a href="#<?php echo $tab['href'] ?>-tab" title=""><?php echo $tab['name'] ?></a>
				<?php if(!$tab['sub']):?><div class="arrow"></div><?php endif?>
			</li>
		<?php endforeach ?>
	</ul>
	
<?php
	global $wpv_loaded_config_groups;
	$wpv_loaded_config_groups = 0;
?>