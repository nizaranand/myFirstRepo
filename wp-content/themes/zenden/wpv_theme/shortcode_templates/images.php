<?php
	$res =  '[raw]<span class="image_styled'.($align?' align'.$align:'').' '. $class .'">';
	if(!empty($link)) {
		$res .= '<a'.($group?' rel="'.$group.'"':'').' class="'.$link_class.' thumbnail '.$no_link.($lightbox =='true'?' lightbox':' no-lightbox').'" title="'.$title.'" href="'.$link.'">' ;
	}
	$res .= $image;
	if(!empty($link)) {
		$res .= '</a>';
	}
	if($underline == 'true') {
		$res .= '<span class="shadow"></span>';
	}
	$res .= '</span>[/raw]';
	
	echo $res;
