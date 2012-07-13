function wpv_gallery_add(id){
	var win = window.dialogArguments || opener || parent || top;

	win.wpv_gallery.get(id);
	win.tb_remove();
}