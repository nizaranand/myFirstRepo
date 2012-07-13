(function($, undefined) {

$.fn.uirange = function() {
	return this.each(function() {
		this.type = 'text';
		
		var input = $(this);
		input.wrap('<div class="ui-range"></div>');
		
		var wrap = $(this).parent();
		var sl = wrap.prepend('<div class="ui-range-slider"></div>').find('.ui-range-slider');
		
		// an object with the definitions of our range
		var range = {};
		range.min = parseFloat( input.attr("min") );
		range.max = parseFloat( input.attr("max") );
		range.step = parseFloat( input.attr("step") );
		
		// initialize ui.slider
		sl.slider({
			min: range.min,
			max: range.max,
			value: parseFloat( input.val() ),
			step: range.step,
			slide: function(evt, ui) {
				input.val(ui.value).change();
			},
			change: function(evt, ui) {
				input.val(ui.value).change();
        	}
        });
        
        input.change(function() {
        	// undo the user input if it's outside the range
        	if( $(this).val() < range.min || $(this).val() > range.max) {
        		$(this).val(sl.slider('value'));
        	} else {
	        	// otherwise correct the slider's position
	        	
	        	var prev = $(this).data('prev-value');
	        	if(prev !== input.val()) {
	        		$(this).data('prev-value', input.val());
    	    		sl.slider('value', input.val());
    	    	}
    	    }
        });
	});
}

})(jQuery);
