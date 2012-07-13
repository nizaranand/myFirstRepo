jQuery('document').ready(function($){
	
	if($('#slider').length >0){
		$('#slider ul#slides').cycle({
			height: '200px',
			width: '960px',
			fx: 'scrollLeft',
			speed: 700,
			timeout: 8000,
			pause: 1,
			pager: '#nav'
		});
	}
	
	if($('#slider_advantage').length > 0){
		$('#slider_advantage ul#slides').cycle({
			height: '200px',
			width: '960px',
			fx: 'scrollLeft',
			speed: 700,
			timeout: 8000,
			pause: 1,
			pager: '#nav'
		});
	}		
	
	if($('#slider_who').length > 0){
		$('#slider_who ul#slides').cycle({
			height: '200px',
			width: '960px',
			fx: 'scrollLeft',
			speed: 700,
			timeout: 8000,
			pause: 1,
			pager: '#nav'
		});
	}		
}); //ends jquery

	
