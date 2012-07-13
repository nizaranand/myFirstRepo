
/*
 *	Dynamic design functions and onLoad events
 *	----------------------------------------------------------------------
 * 	This file initializes many of the dynamic features after page load.
*/


// 
//	On document ready functions
// ======================================================================

jQuery(document).ready(function($) {

		
	// Fade in content (requires adding class="invisible" to page element
	// -------------------------------------------------------------------
	if (fadeContent !== 'none' && !oldIE) {
		// A little bit fancy... reveals the top, middle & bottom of the page in sequence
		elems = (fadeContent === 'all') ? '#Top, #Middle, #Bottom' : '#Middle';
		hiddenClass = (fadeContent === 'all') ? 'invisibleAll' : 'invisibleMiddle';
		if (fadeContent === 'all' || fadeContent === 'content') {
			$('#Wrapper').children(elems).css('opacity','0').end().parent('body').removeClass(hiddenClass);
			setTimeout(function() {	$('#Middle').animate({'opacity':'1'}, 250); }, 100); // fade in 2nd section, after 100 millisecond delay
			if (fadeContent === 'all') { 
				setTimeout(function() {	$('#Top').animate({'opacity':'1'}, 200); },	0); // fade in 1st section, no delay
				setTimeout(function() {	$('#Bottom').animate({'opacity':'1'}, 300);	},	200); // fade in 3rd section, after 200 millisecond delay  
			}
		}
	}
	
	// a small style fix to prevent blank space at bottom of page. (don't apply to small screens, such as mobile devices)
	if (screen.width > 990) {
		$('body').css('background',jQuery('#Bottom .sub-footer').css('background-color'));
	}
	
	// Check the position of background elements (like the curve)
	// -------------------------------------------------------------------
	 postitionCurveBg(jQuery);
	 // sometimes elements "shift" after page load. This catches those instances.
	 setTimeout('postitionCurveBg(jQuery)', 90);
	 setTimeout('postitionCurveBg(jQuery)', 500);
	
	
	
	// Styling buttons (needs condition from theme options for on/off)
	// -------------------------------------------------------------------
	var $buttonElement = $('input[type="submit"]:not(.noStyle), input[type="button"]:not(.noStyle), input[type="reset"]:not(.noStyle), button:not(.noStyle)');
	$($buttonElement).addClass('btn');
	
	
	// input lable replacement
	// -------------------------------------------------------------------
	$("label.overlabel").overlabel();


	// page style adjustments 
	// (sizes set by users ometimes need minor adjusts, etc)
	// -------------------------------------------------------------------
		// content layout - style-image-left (BLOG)
		var article = $('.posts-list .style-image-left');
		if (article.length > 0 ) {
			// for each 
			article.each( function() {
				var w = jQuery(this).children('.the-post-image').outerWidth(true); // image width including padding, border and margin
				if (w) {
					jQuery(this).children('.the-post-container').css('margin-left', w + 'px');
				}
			});
		}
		// content layout - style-image-left (SINGLE POST)
		var article = $('.content-post-single .style-image-left');
		if (article.length > 0 ) {
			// for each 
			article.each( function() {
				var w = jQuery(this).find('.the-post-image').outerWidth(true); // image width including padding, border and margin
				if (w) {
					jQuery(this).find('header.entry-header').css('margin-left', w + 'px');
				}
			});
		}
	
	
	// Lightbox (colorbox)
	// -------------------------------------------------------------------
		
	// Lightbox for WP [gallery] (groups items for lightbox next/prev) 
	$(".gallery .gallery-item a").attr('rel','gallery');

	// Lightbox for YouTube 
	$("a.popup[href*='http://www.youtube.com/watch?']").colorbox({
		href: function() {
			var id = /[\?\&]v=([^\?\&]+)/.exec(this.href);  // get video id
			url = 'http://www.youtube.com/embed/' + id[1] ;
			if (!id[1]) url = this.href; // if no id was found return original URL
			return url;
		},
		iframe:true,
		innerWidth: function() {
			// get width from url (if entered)
			w = $.getUrlVars(this.href)['width'] || 640;
			return w;
		}, 
		innerHeight: function() {
			h = $.getUrlVars(this.href)['height'] || 390;
			return h;
		}
	});

	// Lightbox for Vimeo
	$("a.popup[href*='http://www.vimeo.com/'], a.popup[href*='http://vimeo.com/']").colorbox({
		href: function() {
			//var id = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/.exec(this.href);  // get video id
			var id = /vimeo\.com\/(\d+)/.exec(this.href);  // get video id
			url = 'http://www.vimeo.com/moogaloop.swf?clip_id=' + id[1] ;
			if (!id[1]) url = this.href; // if no id was found return original URL
			return url;
		},
		iframe:true,
		innerWidth: function() {
			// get width from url (if entered)
			w = $.getUrlVars(this.href)['width'] || 640;
			return w;
		}, 
		innerHeight: function() {
			h = $.getUrlVars(this.href)['height'] || 360;
			return h;
		}
	});
	
	// generic all links to images selector
	$("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],a[href$='.tif'],a[href$='.tiff'],a[href$='.bmp']").colorbox({
		maxWidth: '95%', maxHeight: '95%'
	});

	// specific target links using "popup" class with "#TartetElement" as href, for opening inline HTML content
	$("a.popup[href$='#LoginPopup'], .popup > a[href$='#LoginPopup']").each( function() {
		// Quick fix for URL with a path before "#LoginPopup"
		this.href = this.hash;
	});
	$("a.popup[href^='#'], .popup > a[href^='#']").colorbox({ maxWidth: '95%', maxHeight: '95%', inline: true, href: this.href }).removeClass('popup');	// remove class to prevent duplication 
	$(".popup > a[href^='#']").parent().removeClass('popup');	// remove class (from parent for WP menu LI's) to prevent duplication 

	
	// specific target links using "popup" class or "#popup" in URL
	$(".popup").colorbox({ maxWidth: '95%', maxHeight: '95%' });
	$("a[href$='#popup']").colorbox({
		maxWidth: '95%', maxHeight: '95%',
		href: function() { if (this.href) { return this.href.replace('#popup',''); }}
	});

	// specific target links using "iframe" class or "#iframe" in URL (non-ajax content)
	$(".iframe").colorbox({ width:"80%", height:"80%", iframe:true });
	$("a[href$='#iframe']").colorbox({
		width:"80%", height:"80%", iframe:true,
		href: function() { if (this.href) { return this.href.replace('#iframe',''); }}
	});


	// portfolio item height fix (height adjust for alignment)
	// -------------------------------------------------------------------
	if ($('.portfolio-list').length > 0 ) {
		var pGroup = $('.portfolio-list');
		// for each portfolio instance
		pGroup.each( function() {
			var h = 0;
			// get all items in the group
			pItems = jQuery(this).find('.the-post-container');
			pItems.each( function(i, val) {
				if (jQuery(this).height() > h) {
					// get the greatest height value
					h = jQuery(this).height();
				}
			});
			pItems.css('height',h+'px'); // set all to max height
			
		});
	}
	
	
	// Message box - close buttons
	// -------------------------------------------------------------------
	$(".messageBox .closeBox").click( function() {
		jQuery(this).parent('.messageBox').fadeTo(400, 0.001).slideUp();
	});


	// Fix those styled buttons on Safari for Windows!
	// -------------------------------------------------------------------
	if (BrowserDetect.browser == "Safari" && BrowserDetect.OS == "Windows") {
		// fixes the mysterious extra padding on buttons (Safari for Windows only)
		$('button.btn span').css('margin','-1px -3px');
	}
	
	
	// Tabs
	// -------------------------------------------------------------------
	if (jQuery('.tabList').length > 0 ) {
		$('.tabList').sTabs();
	};


	// Toggle (show/hide)
	// -------------------------------------------------------------------
	if (jQuery('.toggleItem').length > 0 ) {
		$('.toggleItem').simpleToggle();
	};
	
	// BuddyPress related helpers
	// -------------------------------------------------------------------
	if (typeof jq == 'function' && typeof Cufon == 'function') {
		jq('#BP-Content').ajaxComplete(function(evt, request, settings){
			setTimeout( function(){Cufon.refresh();}, 250 );
		});
	}
	
});	





//	Design functions
// ======================================================================


// Set background curve position (or fix it)
// -------------------------------------------------------------------
function postitionCurveBg($) {
	var $curveElement = $('.curve #Wrapper');
	if ($curveElement.length > 0) {
		var wrapper = $curveElement.offset(); // if wrapper isn't at the top of the page we adjust for that (wp admin bar fix)
		var showcase = $("#Showcase").offset();
		var bgOffset = 266; // Background is offset -266px from showcase top (this is for default 500px curve bg)
		var defaulPos = 119;
		var currentPos = showcase.top - wrapper.top - bgOffset;
		if ( currentPos != defaulPos ) {
			$curveElement.css('background-position','50% '+ currentPos + 'px' );
		}
	}
}



//	Other functions
// ======================================================================


// Get parameters from URL or string
// -------------------------------------------------------------------
// Usage:
// ------
// Get object of URL parameters:	allVars = $.getUrlVars();
// Getting URL var by its name:		byName = $.getUrlVar('name');
// Getting alternate URL var:		customURL = $.getUrlVar('name','http://mysite.com/?query=string');
// -------------------------------------------------------------------
jQuery.extend({
  getUrlVars: function(url){
    var vars = [], hash;
	if (!url) {
		url = window.location.href;
	}
    var hashes = url.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name, url){
	if (!url) {
		url = window.location.href;
	}
    return jQuery.getUrlVars(url)[name];
  }
});



// Browser detect
// -------------------------------------------------------------------

/* 
	Browser Detect - http://www.quirksmode.org/js/detect.html

	We're only interested in detecting 1 browser, Safari on Windows, so most of the script is 
	commented out except what's needed for this. We need this to fix a bug in Safari's <button> 
	element which addes a few pixels of extra padding that cannot be removed with CSS.
	
	The commented out code will get stripped by using a minification tool.
*/

var oldIE  = false;

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		}/*,
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}*/
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		}/*,
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}*/
	]

};
BrowserDetect.init();

// Handle some IE specific issues (mostly to disable special features, only IE 6, 7 and 8)
if (BrowserDetect.browser == "Explorer" && BrowserDetect.version < 9) {
	oldIE = BrowserDetect.version; // set to version number. used later detect unsupported features.
}



/*
 *  sTabs - simple tabs jQuery plugin
 *  http://labs.smasty.net/jquery/stabs/
 *
 *  Copyright (c) 2010 Martin Srank (http://smasty.net)
 *  Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php).
 *
 *  Built for jQuery library
 *  http://jquery.com
 *
 */
(function($) {
  $.fn.sTabs = function(opts) {
  
  var options = $.extend({}, $.fn.sTabs.defaults, opts);
  
    return this.each(function() {
      $(this).addClass('tabs');
      $(this).find('a').each(function(){

        $($(this).attr('href')).addClass('tab').hide();

        $(this).bind(options.eventType, function(e){
          e.preventDefault();
          
          $(this).addClass('active');
          
          options.animate ? $($(this).attr('href')).fadeIn(options.duration) : $($(this).attr('href')).show();
          
          $($(this).parent().siblings().find('a')).each(function(){
            $(this).removeClass('active');
            $($(this).attr('href')).hide();
          });
        })
      });

      var first = $(this).find('li:nth-child(' + options.startWith + ')').children('a');
      $(first).addClass('active');
      $($(first).attr('href')).show();
    });
  }
   $.fn.sTabs.defaults = {animate: false, duration: 300, startWith: 1, eventType: 'click'}
})(jQuery);



/*
 * Toggle show/hide content (FAQs)
 *
 */
(function($) {
	$.fn.simpleToggle = function(opts) {
	
		var options = $.extend({}, $.fn.simpleToggle.defaults, opts);
		
		return this.each(function() {
			$title = $(this).children('.togTitle');
			$title.each(function() {
				$(this).click( function() {
					$item = $(this);
					$item.next('.togDesc').slideToggle('fast', function() {
						$icon = $item.children('.iconSymbol');
						if ($(this).css('display') == 'block') {
							$icon.removeClass('plus').addClass('minus');
						} else {
							$icon.removeClass('minus').addClass('plus');
						}
					});
				});
			});
		});
	
	}
	$.fn.simpleToggle.defaults = {}
   
})(jQuery);



// A little error checking...
// This helps prevents a blank page if a JS error occurs and "fade in content" is active
// -------------------------------------------------------------------------------------
if (fadeContent !== 'none' && !oldIE) {
	setTimeout(function() {	jQuery('body').removeClass('invisibleAll invisibleMiddle'); }, 1000);
}