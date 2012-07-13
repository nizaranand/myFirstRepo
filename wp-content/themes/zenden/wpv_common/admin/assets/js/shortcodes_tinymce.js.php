<?php

	header('Content-type: text/javascript');

?>
/**
 * @author Nikolay Yordanov
 */
<?php
	require_once( '../../../../../../../wp-load.php' ); 
?>

(function($, undefined) {

tinymce.create('tinymce.plugins.Shortcodes', {
	init : function(ed, url) {
	},
	createControl: function(n, cm) {
		if(n == 'shortcodes') {
			function open_shortcode(v) {
				if($('#shortcodes').length == 0) {
					$('body').append('<div id="shortcodes">');
				}
				
				$('body').attr('data-wpvshortcode', v);

				$.get('<?php echo WPV_ADMIN_AJAX ?>get_shortcodes.php', {
					slug: v,
					nocache: (new Date()).getTime()
				}, function(data) {
					$('#shortcodes').html(data);
					
					$(window).trigger('wpv_shortcodes_loaded');
					
					$.colorbox({
						href: '#shortcode_'+v,
						title: '<?php __('Vamtam.com shortcodes', 'wpv')?>',
						inline: true,
						width: '80%',
						maxHeight: '95%',
						overlayClose: false
					});
						
					$('.shortcode_sub_selector select').change(function() {
						$.colorbox.resize({
							width: '80%',
							maxHeight: '95%'
						});
					});
				});
			}
			
			var c = cm.createMenuButton('wpv_shortcodes', {
				title : 'Vamtam.com shortcodes',
				image : '<?php echo WPV_ADMIN_ASSETS_URI . 'images/shortcodes_icon.png' ?>'
			});


			
			c.onRenderMenu.add(function(c, m) {
				m.add({title : 'Shortcodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
				
				var menu_media = m.addMenu({title:"Media"});
				var menu_layouts = m.addMenu({title:"Layouts and skins"});
				var menu_elements = m.addMenu({title:"Page(HTML) elements"});

				<?php
					$shortcodes = include WPV_THEME_METABOXES . 'shortcode.php';
					$available_shortcodes = include WPV_HELPERS . 'available_shortcodes.php';
					
					sort($shortcodes);
					
					foreach($shortcodes as $slug) {
						if(isset($available_shortcodes[$slug])):
							$shortcode_options = include WPV_SHORTCODES_GENERATOR . $slug . '.php';
						?>
							menu_<?php echo $available_shortcodes[$slug]?>.add({title:'<?php echo $shortcode_options['name'] ?>', onclick:function(){open_shortcode('<?php echo $slug ?>')}});
						<?php
						endif;
					}
				?>
			});

			return c;
        }

        return null;
    }

});

tinymce.PluginManager.add('shortcodes', tinymce.plugins.Shortcodes);

})(jQuery);
