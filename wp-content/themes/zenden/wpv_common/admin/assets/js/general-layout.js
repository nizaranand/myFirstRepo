(function($, undefined) {

var down_factor, up_factor, down_factor_v, up_factor_v;

var max_slider_height = 800;
var min_slider_height = 100;

var sidebar_min_w = 150;
var sidebar_max_w = 400;

var manual_change = false;

$(function() {

var wrap = $('.wpv-layout-wrap');

if(wrap.length == 0) {
	return false;
}

down_factor = wrap.width()/wrap.attr('data-pane'); // horizontal
up_factor = 1/down_factor; //horizontal
down_factor_v = down_factor/2; // vertical
up_factor_v = 1/down_factor_v; //vertical

var margin = Math.floor( 630*( 1 - wrap.attr('data-site') / wrap.attr('data-pane'))/2 );
var margin_min = Math.floor( 630*( 1 - wrap.attr('data-max') / wrap.attr('data-pane'))/2 );
var margin_max = Math.floor( 630*( 1 - wrap.attr('data-min') / wrap.attr('data-pane'))/2 );
var innerwest = Math.floor( down_factor * wrap.attr('data-left'));
var innereast = Math.floor( down_factor * wrap.attr('data-right'));

wrap.find('.margin-east, .margin-west').width(margin);

var is_outer_resizable = (margin_min != margin_max);

var outer = wrap.layout({ 
	center__paneSelector: ".layout-inner-content",
	east__paneSelector:	".margin-east",
	west__paneSelector: ".margin-west",
	closable: false,
	resizable: true, 
	slidable: false,
	resizeWhileDragging: true,
	west__resizable: is_outer_resizable,
	east__resizable: is_outer_resizable,
	helperLimitClass: "resizer-dragging-limit",
	east__resizerClass: is_outer_resizable ? 'wpv-resizer-east' : '',
	west__resizerClass: is_outer_resizable ? 'wpv-resizer-west' : '',
	east__spacing_open: 8,
	west__spacing_open: 8,
	east__size:	margin,
	west__size:	margin,
	east__minSize: margin_min,
	west__minSize: margin_min,
	east__maxSize: margin_max,
	west__maxSize: margin_max,
	west__onresize: function (pane, $pane, paneState) {
	    var width  = paneState.innerWidth;
		var realwidth = width * 2;
		var east = wrap.find('.margin-east');
		var west = wrap.find('.margin-west');
		var resizer_west = wrap.find('.wpv-resizer-west');
		var resizer_east = wrap.find('.wpv-resizer-east');
	
		// This will fire in Firefox in strange times, make sure it's visible before doing anything
		if(east.is(':visible')) {
			east.width(width);
			resizer_east.css('right', resizer_west.position().left);
			update_dimensions();
			wrap.find('.layout-header-wrapper, .footer-wrapper').css({width: '100%'});
		}
	}, 
	east__onresize: function (pane, $pane, paneState) {
		var width  = paneState.innerWidth;
		var realwidth = width * 2;
		var east = wrap.find('.margin-east');
		var west = wrap.find('.margin-west');
		var resizer_west = wrap.find('.wpv-resizer-west');
		var resizer_east = wrap.find('.wpv-resizer-east');
						
		// This will fire in Firefox in strange times, make sure it's visible before doing anything
		if(west.is(':visible')){
			west.width(width);
			resizer_west.css('left', resizer_east.css('right'));
			update_dimensions();
			wrap.find('.layout-header-wrapper, .footer-wrapper').css({width: '100%'});
		}
	}
});

wrap.css({
	width: wrap.width()-4,
	height: wrap.height()-4
});

var center = outer.panes.center.layout({ 
	closable: false,
	resizable: true,
	slidable: false,	
	north__resizable: true,
	south__resizable: false,
	north__size: Math.round(down_factor_v * (Number(wrap.attr('data-header')) + Number(wrap.attr('data-slider'))))+50+16,
	north__minSize: Math.round(down_factor_v*150) + 50,
	north__maxSize: Math.round(down_factor_v*1100)+50,
	south__size: 80,
	resizeWhileDragging: true,
	east__resizerClass: 'gutter',
	west__resizerClass: 'gutter',
	north__resizerClass: 'inner-gutter-horizontal',
	east__minSize: Math.round(down_factor*sidebar_min_w),
	west__minSize: Math.round(down_factor*sidebar_min_w),
	east__maxSize: Math.round(down_factor*sidebar_max_w),
	west__maxSize: Math.round(down_factor*sidebar_max_w),
	east__spacing_open: 8,
	west__spacing_open: 8,
	north__spacing_open: 8,
	east__size: innereast,
	west__size: innerwest,
	west__onresize: function (pane, $pane, paneState) {
		update_dimensions();
	},
	east__onresize: function (pane, $pane, paneState) {
		update_dimensions();
	},
	north__onresize: function (pane, $pane, paneState) {
		center.options.north.minSize = 50 + Math.round(down_factor_v*min_slider_height) + $('.layout-header').height() + 16;
		center.options.north.maxSize = 50 + Math.round(down_factor_v*max_slider_height) + $('.layout-header').height() + 16;
		
		update_dimensions();
	}
});

center.panes.south.css({width: wrap.width() - 2*margin}).layout({
	closable: false,
	resizable: true,
	slidable: false,
	resizeWhileDragging: true,
	north__resizable: false,
	center__paneSelector: '.footer-credits',
	north__paneSelector: '.footer-widgets',
	north__resizerClass: 'gutter-horizontal-inactive',
	north__spacing_open: 6,
	north__size: 40
});

var header_wrap = center.panes.north.css({width: wrap.width() - 2*margin}).layout({
	closable: false,
	resizable: true,
	slidable: false,
	resizeWhileDragging: true,
	north__minSize: Math.ceil(down_factor_v*50),
	north__maxSize: Math.floor(down_factor_v*300),
	center__minHeight: Math.round(down_factor_v*min_slider_height),
	center__maxHeight: Math.floor(down_factor_v*max_slider_height),
	center__paneSelector: '.layout-slider',
	north__paneSelector: '.layout-header',
	south__paneSelector: '.layout-header-widgets',
	north__resizerClass: 'gutter-horizontal',
	south__resizerClass: 'gutter-horizontal-inactive',
	south__resizable: false,
	north__spacing_open: 8,
	south__spacing_open: 8,
	north__size: Math.floor(down_factor_v * wrap.attr('data-header')),
	south__size: 50,
	south__minSize: 50,
	north__onresize_start: function(pane, $pane, paneState) {
		$pane.data('orig_height', $pane.height());
	},
	north__onresize: function (pane, $pane, paneState) {
		// we should resize some panes and resizers manually to get the desired effect
		var delta_v = $pane.height() - $pane.data('orig_height');
		
		wrap.find('.layout-header-wrapper').height(wrap.find('.layout-header-wrapper').height() + delta_v);
		wrap.find('.left-sidebar, .center-width, .right-sidebar, .gutter-east, .gutter-west').height(wrap.find('.left-sidebar').height() - delta_v);
		wrap.find('.left-sidebar, .center-width, .right-sidebar, .gutter-east, .gutter-west').css('top', Number(wrap.find('.left-sidebar').css('top').match(/\d+/)[0]) + delta_v);
		wrap.find('.inner-gutter-horizontal').css('top', Number(wrap.find('.inner-gutter-horizontal').css('top').match(/\d+/)[0]) + delta_v);
		
		center.options.north.minSize = 50 + Math.round(down_factor_v*min_slider_height) + $('.layout-header').height() + 16;
		center.options.north.maxSize = 50 + Math.round(down_factor_v*max_slider_height) + $('.layout-header').height() + 16;
		
		update_dimensions( 'slider' );
	}
});

var update_dimensions = function( block_update ) {
	var site = Math.round(wrap.find('.footer-wrapper').width() * up_factor);
	var left_sidebar = Math.round(wrap.find('.left-sidebar').width() * up_factor);
	var right_sidebar = Math.round(wrap.find('.right-sidebar').width() * up_factor);
	var center_width = Math.round(wrap.find('.center-width').width() * up_factor);
	var header = Math.round(wrap.find('.layout-header').height() * up_factor_v);
	var slider = Math.round(wrap.find('.layout-slider').height() * up_factor_v);
	
	wrap.find('.left-sidebar .size').text(left_sidebar + 'px');
	wrap.find('.right-sidebar .size').text(right_sidebar + 'px');
	wrap.find('.layout-header .size').text(header + 'px');
	
	if(block_update != 'slider') {
		wrap.find('.layout-slider .size').text(slider + 'px');
		$('#'+wrap.attr('data-slider-selector')).val(slider).change();
	}
	
	wrap.find('.center-width .size-none').text(site + 'px');
	wrap.find('.center-width .size-both').text(center_width + 'px');
	
	$('#content-width').val(site).change();
	$('#left_sidebar_width').val(left_sidebar).change();
	$('#right_sidebar_width').val(right_sidebar).change();
	$('#header-height').val(header).change();
}

// toggles

$('.lo-toggle').each(function() {
	var tr = WPV_LAYOUT_TRANSLATIONS;
	$(this).html('<span class="enable">'+tr.enable+'</span> / <span class="disable">'+tr.disable+'</span>');
	
	var enable = $(this).find('.enable');
	var disable = $(this).find('.disable');
	var checkbox = $('#'+$(this).attr('data-for'));
	
	enable.click(function() {
		$(this).addClass('active').siblings().removeClass('active');
		$(this).closest('.ui-layout-pane').addClass('toggle-enabled').removeClass('toggle-disabled');
	});
		
	disable.click(function() {
		$(this).addClass('active').siblings().removeClass('active');
		$(this).closest('.ui-layout-pane').addClass('toggle-disabled').removeClass('toggle-enabled');
	});
	
	if(checkbox.length) {
		enable.click(function() {
			checkbox.attr('checked', true);
		});
		
		disable.click(function() {
			checkbox.attr('checked', false);
		});
		
		if( checkbox.is(':checked') ) {
			enable.click();
		} else {
			disable.click();
		}
	} else if($(this).attr('data-type') == 'body-sidebars-left') {  // is there a nicer implementation?
		var id="#default-body-layout";
		
		enable.click(function() {
			if($('.lo-toggle[data-type="body-sidebars-right"]').has('.enable.active').length) {
				$(id+'left-right').attr('checked', true);
			} else {
				$(id+'left-only').attr('checked', true);
			}
		});
		
		disable.click(function() {
			if($('.lo-toggle[data-type="body-sidebars-right"]').has('.enable.active').length) {
				$(id+'right-only').attr('checked', true);
			} else {
				$(id+'full').attr('checked', true);
			}
		});
	} else if($(this).attr('data-type') == 'body-sidebars-right') {
		
		var id="#default-body-layout";
		
		enable.click(function() {
			if($('.lo-toggle[data-type="body-sidebars-left"]').has('.enable.active').length) {
				$(id+'left-right').attr('checked', true);
			} else {
				$(id+'right-only').attr('checked', true);
			}
		});
		
		disable.click(function() {
			if($('.lo-toggle[data-type="body-sidebars-left"]').has('.enable.active').length) {
				$(id+'left-only').attr('checked', true);
			} else {
				$(id+'full').attr('checked', true);
			}
		});
	}
});


// initialize the lo-toggles for sidebars
(function() {
	var id="#default-body-layout";
		
	if($(id+'left-right').is(':checked')) {
		$('[data-type="body-sidebars-left"] .enable').click();
		$('[data-type="body-sidebars-right"] .enable').click();
	} else if ($(id+'left-only').is(':checked')) {
		$('[data-type="body-sidebars-left"] .enable').click();
		$('[data-type="body-sidebars-right"] .disable').click();
	} else if ($(id+'right-only').is(':checked')) {
		$('[data-type="body-sidebars-left"] .disable').click();
		$('[data-type="body-sidebars-right"] .enable').click();
	} else {
		$('[data-type="body-sidebars-left"] .disable').click();
		$('[data-type="body-sidebars-right"] .disable').click();
	}
})();

});

})(jQuery);
