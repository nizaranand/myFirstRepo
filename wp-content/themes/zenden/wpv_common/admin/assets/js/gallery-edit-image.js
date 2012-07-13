jQuery(function($) {
	$('form').submit(function() {
		$.ajax({
			type: "POST",
			data: $(this).serializeArray(),
			success: function(msg){
				var win = window.dialogArguments || opener || parent || top;
				win.wpv_gallery.edit_complete($('#attachment_id').val());
				win.tb_remove();
			}
		}); 
		return false;
	});
});
