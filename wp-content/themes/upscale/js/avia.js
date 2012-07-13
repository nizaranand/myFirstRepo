/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += 'js_active';
/*end dom flickering =) */

//global path: avia_framework_globals.installedAt

jQuery.noConflict();
jQuery(document).ready(function(){

	//activates the prettyphoto lightbox
	if(jQuery.fn.avia_activate_lightbox)		
	jQuery('body').avia_activate_lightbox();
	
	//activates the hover effect for image links
	if(jQuery.fn.avia_activate_hover_effect)		
	jQuery('#main').avia_activate_hover_effect();

	//activates the mega menu javascript
	if(jQuery.fn.aviaMegamenu)		
	jQuery(".main_menu .megaWrapper").aviaMegamenu({modify_position:true});
	
	//activates the broadscope slider
	if(jQuery.fn.avia_fade_slider)		
	jQuery(".slideshow_container").avia_fade_slider();
		
	// enhances contact form with ajax capabilities
	if(jQuery.fn.kriesi_ajax_form)
	jQuery('.ajax_form').kriesi_ajax_form();
	
	//smooth scrooling
	if(jQuery.fn.avia_smoothscroll)
	jQuery('a[href*=#]').avia_smoothscroll();
	
	//activates the shortcode content slider
	if(jQuery.fn.avia_sc_slider)								
	jQuery(".content_slider").avia_sc_slider({appendControlls:{}});
	
	//activates the toggle shortcode
	if(jQuery.fn.avia_sc_toggle)
	jQuery('.togglecontainer').avia_sc_toggle();
	
	//activates the tabs shortcode
	if(jQuery.fn.avia_sc_tabs)
	jQuery('.tabcontainer').avia_sc_tabs();
	
	//activate html5 video player
	if(jQuery.fn.avia_video_activation)
	jQuery(".avia_video").avia_video_activation({ratio:'16:9'});
	
	//activate tooltips for social icons
	if(jQuery.fn.avia_static_tooltips)
	jQuery("#header .social_bookmarks li").avia_static_tooltips();
	
	//activate equal height for boxed portfolio items
	if(jQuery.fn.avia_portfolio_equal_height)
	{
		jQuery(".portfolio_entries_boxed .post-entry").not('.post-entry-first').avia_portfolio_equal_height({el:'.post-entry'});
		//jQuery(".template-dynamic .dynamic_column_boxed").avia_portfolio_equal_height({el:'.dynamic_column_boxed'}); //uncomment the previous line if you want dynamic template boxed columns to adjust their height as well
	}
	avia_cufon_helper();
	avia_ie_comp();
	avia_iframe_fix();
});

/*fixes some visual IE glitches*/
function avia_ie_comp()
{
	if(jQuery.browser.msie && jQuery.browser.version < 9 )
	{
		jQuery('.featured_image2_darken').css({'opacity': "0.2"});
		jQuery('#top').addClass('old_ie');
	}
}

function avia_iframe_fix()
{
	var iframe 	= jQuery('.slideshow iframe'),
		youtubeEmbed = jQuery('.slideshow object, .slideshow embed').attr('wmode','opaque');
		
		iframe.each(function()
		{
			var current = jQuery(this),
				src 	= current.attr('src');
			
			if(src)
			{
				if(src.indexOf('?') !== -1)
				{
					src += "&wmode=opaque";
				}
				else
				{
					src += "?wmode=opaque";
				}
				
				current.attr('src', src);
			}
		});
}


// -------------------------------------------------------------------------------------------
// Portfolio & Column Boxed equal height
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_portfolio_equal_height = function(options) 
	{
		var tallest = 0,
			subset = $(),
			defaults = 
			{
				el: '.post-entry'
			};
		
		var options = $.extend(defaults, options);
	
		return this.each(function(i)
		{
			var el = $(this),
				elHeight = el.height(),
				nextEl = el.next(),
				next_is_same_group = nextEl.is(options.el);
				
			subset = subset.add(el);
				
			if(elHeight > tallest) tallest = elHeight;
			
			if(!next_is_same_group)
			{
				subset.css('min-height',tallest);
				subset = $();
				tallest = 0;
			}
			
		});
	};
})(jQuery);


// -------------------------------------------------------------------------------------------
// Tooltip plugin
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_static_tooltips = function(options) 
	{
		var defaults = 
		{
			start: 40,
			active: 23,
			end: 40
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var element = $(this),
				tooltipClass = 'tooltip_' + element.attr('class'),
				label = $.trim(element.text()),
				form = $('form', element),
				modifier = 0;
				
			if($('#wpadminbar').length > 0) modifier = -28;
			
			if(form.length)	{ label = form.wrap('<div></div>').parent().html(); form.parent().remove(); }
				
			var	tooltip = $('<div class="avia_tooltip '+tooltipClass+'"><div class="avia_tooltip_inner"><div class="avia_tooltip_content">'+label+'</div></div></div>').css('opacity',0).appendTo('body'),
				position = "";
			
			tooltip.bind('mouseleave', function()
			{
				tooltip.stop().animate({opacity: 0, top: (position.top + options.end)}, function()
				{
					tooltip.css('display','none');
				});
			})
				
			element.hover(
				function()
				{
					position = element.offset();
					tooltip.css({display:'block', left: position.left, top: (position.top + options.start) }).stop().animate({opacity: 1, top: position.top + modifier + options.active});
				},
				function(eventObj)
				{					
					if(eventObj.relatedTarget != tooltip.get(0))
					{
						tooltip.stop().animate({opacity: 0, top: (position.top + options.end)}, function()
						{
							tooltip.css('display','none');
						});
					}
				}
			);
		});
	};
})(jQuery);



// -------------------------------------------------------------------------------------------
// HTML 5 // Flash self hosted video
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_video_activation = function(options) 
	{
		var defaults = 
		{
			ratio: '16:9'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var fv = $(this),
		      	fv_width = fv.width();
		      	
		    
			if(!fv.is(':visible') && fv.parents('.slideshow_container_featured').length == 0)
		    {
		      	fv_width = fv.parents(':visible:eq(0)').width();
		    }
		    else if(fv.parents('.slideshow_container_featured').length >= 1)
		    {
		    	fv_width = fv.parents('.video_container:eq(0)').width();
		    }
 	
		      	
		    var ratio = options.ratio.split(':'),
		      	fv_height = Math.round((fv_width / ratio[0]) * ratio[1]),
		      	id_to_apply = '#' + $(this).attr('id'),
		      	posterImg = fv.attr('poster');
		      		
		    fv.height(fv_height);
		    

		    		    
		     projekktor(id_to_apply, {
				 plugins: ['Startbutton', 'Controlbar', 'Bufferingicon'],
				 debug: false, //'console',
				 controls: true,
				 playerFlashMP4: avia_framework_globals.installedAt + 'js/projekktor/jarisplayer.swf',
				 height: fv_height,
				 width: fv_width,
				 poster: posterImg
			});

		});
	};
})(jQuery);
//.ppfsenter, .ppfsexit


// -------------------------------------------------------------------------------------------
// Tab shortcode javascript
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_sc_tabs= function(options) 
	{
		var defaults = 
		{
			heading: '.tab',
			content:'.tab_content'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var container = $(this),
				tabs = $(options.heading, container),
				content = $(options.content, container),
				initialOpen = 1;
			
			// sort tabs
			
			if(tabs.length < 2) return;
			
			if(container.is('.tab_initial_open'))
			{
				var myRegexp = /tab_initial_open__(\d+)/;
				var match = myRegexp.exec(container[0].className);
				
				if(match != null && parseInt(match[1]) > 0)
				{
					initialOpen = parseInt(match[1]);
				}
			}
			
			if(!initialOpen || initialOpen > tabs.length) initialOpen = 1;
			
			tabs.prependTo(container).each(function(i)
			{
				var tab = $(this);
				
				//set default tab to open
					if(initialOpen == (i+1))
					{
						tab.addClass('active_tab');
						content.filter(':eq('+i+')').addClass('active_tab_content');
					}
			
				tab.bind('click', function()
				{
					if(!tab.is('.active_tab'))
					{
						$('.active_tab', container).removeClass('active_tab');
						$('.active_tab_content', container).removeClass('active_tab_content');
						
						tab.addClass('active_tab');
						content.filter(':eq('+i+')').addClass('active_tab_content');
					}
					return false;
				});
			});
		
		});
	};
})(jQuery);


// -------------------------------------------------------------------------------------------
// Toggle shortcode javascript
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_sc_toggle = function(options) 
	{
		var defaults = 
		{
			heading: '.toggler',
			content: '.toggle_wrap'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var container = $(this),
				heading   = $(options.heading, container),
				allContent = $(options.content, container),
				initialOpen = '';
			
			//check if the container has the class toggle initial open. 
			// if thats the case extract the number from the following class and open that toggle	
			if(container.is('.toggle_initial_open'))
			{
				var myRegexp = /toggle_initial_open__(\d+)/;
				var match = myRegexp.exec(container[0].className);
				
				if(match != null && parseInt(match[1]) > 0)
				{
					initialOpen = parseInt(match[1]);
				}
			}	
			
			heading.each(function(i)
			{
				var thisheading =  $(this),
					content = thisheading.next(options.content, container);
				
				if(initialOpen == (i+1)) { content.css({display:'block'}); }
				
					
				if(content.is(':visible'))
				{
					thisheading.addClass('activeTitle');
				}
				
				thisheading.bind('click', function()
				{	
					if(content.is(':visible'))
					{
						content.slideUp(300);
						thisheading.removeClass('activeTitle');
					}
					else
					{
						if(container.is('.toggle_close_all'))
						{
							allContent.slideUp(300);
							heading.removeClass('activeTitle');
						}
						content.slideDown(300);
						thisheading.addClass('activeTitle');
					}
				});
			});
		});
	};
})(jQuery); 



function avia_cufon_helper()
{
	var elString = 'h1, h2, h3, h4, h5, h6, .custom_button';
	var els = jQuery(elString);
	if(jQuery.browser.msie && jQuery.browser.version < 9)
	{
		els = els.not('.feature_excerpt h1');
	} 
	
	
	
	if(typeof avia_cufon_size_mod == 'string' && avia_cufon_size_mod != "1")
	{
		avia_cufon_size_mod = parseFloat(avia_cufon_size_mod);
		els.each(function()
		{
			$size = parseInt(jQuery(this).css('fontSize'));	
			jQuery(this).css('fontSize', $size * avia_cufon_size_mod)
		});
	}
	
	
	els.addClass('cufon_headings');
}

// -------------------------------------------------------------------------------------------
// Smooth scrooling when clicking on anchor links
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_smoothscroll = function(variables) 
	{
		return this.each(function()
		{
			$(this).click(function() {
		
			   var newHash=this.hash;
			   
			   if(newHash != '' && newHash != '#' && !$(this).is('.comment-reply-link, #cancel-comment-reply-link'))
			   {
				   var container = $(this.hash);
				   
				   if(container.length)
				   {
					   var target = container.offset().top,
						   oldLocation=window.location.href.replace(window.location.hash, ''),
						   newLocation=this,
						   duration=800,
						   easing='easeOutQuint';
			
					   // make sure it's the same location      
					   if(oldLocation+newHash==newLocation)
					   {
					      // animate to target and set the hash to the window.location after the animation
					      $('html:not(:animated),body:not(:animated)').animate({ scrollTop: target }, duration, easing, function() {
					
					         // add new hash to the browser location
					         window.location.href=newLocation;
					      });
					
					      // cancel default click action
					      return false;
					   }
					}
				}
			});
		});
	};
})(jQuery);	


// -------------------------------------------------------------------------------------------
// Ligthbox activation
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_activate_lightbox = function(variables) 
	{
		var defaults = 
		{
			autolinkElements: 'a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"] , a[href*="screenr.com"]'
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			var elements = $(options.autolinkElements, this),
				lastParent = "",
				counter = 0;
		
			elements.each(function()
			{
				var el = $(this),
					parentPost = el.parents('.post-entry:eq(0)'),
					group = 'auto_group';
				
				if(parentPost.get(0) != lastParent)
				{
					lastParent = parentPost.get(0);
					counter ++;
				}
					
				if((el.attr('rel') == undefined || el.attr('rel') == '') && !el.hasClass('noLightbox')) 
				{ 
					if(el.hasClass('noLightboxGroup'))
					{
						el.attr('rel','lightbox'); 
					}
					else
					{
						el.attr('rel','lightbox['+group+counter+']'); 
					}
					
					//manipulate the link in case we got a screenr video
					if(el.is('a[href*="screenr.com"]'))
					{
						var currentlink = el.attr('href');
						
						if(currentlink.indexOf('embed') !== -1)
						{
							el.attr('href', currentlink + '?iframe=true&width=650&height=396');
						}
						else
						{
							var append =  currentlink.substring(currentlink.lastIndexOf('/') + 1,currentlink.length);
							el.attr('href', 'http://www.screenr.com/embed/' + append + '?iframe=true&width=650&height=396');
						}
					}
				}
			});
			
			if($.fn.prettyPhoto)
			elements.prettyPhoto({ "theme": 'premium_photo', 'slideshow': 5000 }); /* facebook /light_rounded / dark_rounded / light_square / dark_square */								
		});
	};
})(jQuery);	




// -------------------------------------------------------------------------------------------
// Hover effect activation
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_activate_hover_effect = function(variables) 
	{
		var defaults = 
		{
			autolinkElements: 'a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"]'
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			$(options.autolinkElements, this).contents('img').each(function()
			{
				var img = $(this),
					a = img.parent(),
					preload = img.parents('.preloading'),
					$newclass = 'lightbox_video';
					
				if(a.attr('href').match(/(jpg|gif|jpeg|png|tif)/)) $newclass = 'lightbox_image';
				
				var bg = $("<span class='"+$newclass+" '></span>").appendTo(a);
				
				//bind
				img.hover(function()
				{					
					var height = img.outerHeight(), width = img.outerWidth(), pos =  img.position();			
					bg.css({height:height, width:width, top:pos.top, left:pos.left, display:'block', zIndex:5, opacity:0});
				});
				
				bg.hover(function()
				{					
					var height = img.outerHeight(), width = img.outerWidth(), pos =  img.position();			
					bg.css({height:height, width:width, top:pos.top, left:pos.left, display:'block'});
					
					bg.stop().animate({opacity:0.6},400);
				},
				function()
				{
					bg.stop().animate({opacity:0},400);
				});
				
				
				
			});						
		});
	};
})(jQuery);	













// -------------------------------------------------------------------------------------------
// content slider
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_sc_slider = function(variables, callback) 
	{
		var defaults = 
		{
			slidePadding: 40,
			appendControlls: {'h1':'pos_h1', 'h2':'pos_h2', 'h3':'pos_h3', 'h4':'pos_h4', 'h5':'pos_h5', 'h6':'pos_h6'},
			controllContainerClass: 'contentSlideControlls',
			transitionDuration: 800,								//how fast should images crossfade
			autorotation: true,										//autorotation true or false? (this setting gets overwritten by the class autoslide_true and autoslide_false if applied to the container. easier for shortcode management)
			autorotationInterval: 3000,								//interval between transition if autorotation is active ()also gets overwritten by autoslidedelay__(number)
			transitionEasing: 'easeOutQuint'
		};
		
		var options = $.extend(defaults, variables);
				
		return this.each(function()
		{
			var container = $(this),
				slides = $('.single_slide', container),
				slideCount = slides.length,
				firstSlide = slides.filter(':eq(0)'),
				followslides = $('.single_slide:not(:first)', container),
				innerContainer = "",
				innerContainerWidth = (container.width() * slideCount) + (options.slidePadding * slideCount),
				i = 0,
				interval = "",
				controlls = $();
				
			container.methods = 
			{
				preload: function()
				{
					followslides.css({display:"none"});
										
					
					if(!slideCount)
					{
						container.methods.init();
					}
					else
					{
						container.aviaImagePreloader(container.methods.init);
					}
				},
				
				init: function()
				{
					if(slideCount > 1)
					{
						//set container height to match the first slide
						container.height(firstSlide.height());
						
						//wrap additional container arround slides and align slides within that container
						slides.wrapAll('<div class="inner_slide_container" />').css({float:'left', 
																					 width:container.width(), 
																					 display:'block', 
																					 paddingRight:options.slidePadding
																					 });
																					 
						innerContainer = $('.inner_slide_container', container).width(innerContainerWidth);
						
						//attach controll elements
						container.methods.appenControlls();
						
						//start autoslide
						container.methods.autoRotation();
					}
				},
				
				change: function()
				{
					//move inner container
					var moveTo = ((-i * container.width()) - (i * options.slidePadding));
					innerContainer.stop().animate({left: moveTo}, options.transitionDuration, options.transitionEasing);
					
					//change height of outer container
					var nextSlideHeight = slides.filter(':eq('+i+')').height();
					container.stop().animate({height: nextSlideHeight}, options.transitionDuration, options.transitionEasing);
					
					//change active state of controlls
					var controlllinks = $('a', controlls);
					controlllinks.removeClass('activeItem');
					controlllinks.filter(':eq('+i+')').addClass('activeItem');
				},
				
				setSlideNumber: function(event)
				{
				
					var stop = false;
					
					if(event)
					{ 
						clearInterval(interval);
						
						if(event.data.show == 'next') i++;
						if(event.data.show == 'prev') i--;
						if(typeof(event.data.show) == 'number') 
						{
							//check if next slide is the same as current slide
							if(i != event.data.show) 
							{
								i = event.data.show;
							}
							else
							{
								stop = true;
							}
						}
					}
					else
					{
						i++;
					}
					
					if(i+1 > slideCount) { i = 0; } else
					if(i < 0) {i = slideCount-1; }
					
					if(!stop) // prevents transition if the next slide and the current slide are the same
					{
					    container.methods.change();
					}

					
					
					return false;
				},
				
				appenControlls: function()
				{
					//if controlls should be added by javascript and we got more than 1 slide 
					if(options.appendControlls && slideCount > 1)
					{	
						//check where to position the controll element, depending on the first element within the slide
						var positioningClass = '';
						
						for (var key in options.appendControlls)
						{
							if(!positioningClass)
							{
								if($(':first', firstSlide).is(key))
								{
									positioningClass = options.appendControlls[key];
								}
								
							}
						}
						
						
						//append the controlls
						var firstClass = 'class="activeItem"';
						
						controlls = $('<div></div>').addClass(options.controllContainerClass)
													.addClass(positioningClass)
													.css({visibility:'hidden', opacity:0});
														
							if(positioningClass)
							{
								controlls.appendTo(container);
							}							
							else
							{
								controlls.insertAfter(container);
							}
														
						slides.each(function(i)
						{ 
							var link = $('<a '+firstClass+' href="#"></a>').appendTo(controlls); firstClass = ""; 
								link.bind('click', {show: i}, container.methods.setSlideNumber);
						});
						
						controlls.css({visibility:'visible', opacity:0}).animate({opacity:1},400);
					}
				},
				
				autoRotation: function()
				{
					if(container.is('.autoslide_true'))
					{
						options.autorotation = true;
						
					var myRegexp = /autoslidedelay__(\d+)/g;
					var match = myRegexp.exec(container[0].className);
					
					if(parseInt(match[1]) > 0)
					{
						options.autorotationInterval = parseInt(match[1]) * 1000;
					}
					

						
					}
					else if(container.is('.autoslide_false'))
					{
						options.autorotation = false;
					}
				
				
					if(options.autorotation)
					{
						interval = setInterval(function()
						{ 	
							container.methods.setSlideNumber();
						},
						options.autorotationInterval);
					}
				}
			};
			
			
			container.methods.preload();
		});
	};
})(jQuery);



// -------------------------------------------------------------------------------------------
// image preloader
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.aviaImagePreloader = function(variables, callback) 
	{
		var defaults = 
		{
			fadeInSpeed: 800,
			maxLoops: 10
		};
		
		var options = $.extend(defaults, variables);
			
		return this.each(function()
		{
			var container 	= $(this),
				images		= $('img', this).css({opacity:1, visibility:'visible', display:'block'}),
				parent = images.parent().addClass('preloading'),
				imageCount = images.length,
				interval = '',
				allImages = images ;
							
			
			var methods = 
			{
				checkImage: function()
				{
					images.each(function(i)
					{
						if(this.complete == true) images = images.not(this);
					});
					
					if(images.length && options.maxLoops >= 0)
					{
						options.maxLoops--;
						setTimeout(methods.checkImage, 500);
					}
					else
					{
						methods.showImages();
					}
				},
				
				showImages: function()
				{
					allImages.each(function(i)
					{
						var currentImage = $(this);
						currentImage.animate({opacity:1}, options.fadeInSpeed, function()
						{
							currentImage.parents().removeClass('preloading');
							if(allImages.length == i+1) 
							{
								methods.callback(i);
							}
						});
					});
				},
				
				callback: function()
				{				
					if (variables instanceof Function) { callback = variables; }
					if (callback  instanceof Function) { callback.call(this);  }
				}
			};
			
			if(!images.length) { methods.callback(); return }
			methods.checkImage();

		});
	};
})(jQuery);
		
		
// -------------------------------------------------------------------------------------------
// Main Slideshow
// -------------------------------------------------------------------------------------------		

(function($)
{
	$.fn.avia_fade_slider = function(variables) 
	{
		var defaults = 
		{
			slides:'.featured',										//which elements should serve as slide
			transitionDuration: 800,								//how fast should images crossfade
			transitionEasing: 'easeOutQuint',						//easing for the container movement if images got different sizes
			firstFadeInOfElements: 800,								// after preloading how fast should elements be displayed
			appendControlls: true,									//attach controlls via javascript (set to false if JS should not add them)
			appendAutoSlideshowControlls: 'autoslidecontrolls',		//attach play pause fwd and back bitton for the dia show (set to false if you dont want to add them)
			controllContainerClass:'slidecontrolls',				//container class for slidecontrolls. <a> tags within this container serve as slide controll
			appendCaption: 'feature_excerpt',						//caption div class name. change to false if you dont want to display caption
			convertAttributes: false								// should the image title and alt tag be converted into caption and headlines?		
		},
		
		options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			var container = $(this),
				slideshow_container = $('.slideshow', this),
				slides = $(options.slides, container).css({position:'relative'}),
				currentSlide = slides.filter(':eq(0)'),
				slideCount = slides.length,
				interval = "",
				i = 0,
				animating = false,
				captions = $(),
				controlls = $(),
				slideControlls = $(),
				nextSlide = $(),
				transition_direction = 'higher',
				no_png_fade = false;	
				
			if($.browser.msie && $.browser.version < 9) no_png_fade = true;
			
			
			//helper contains functions that need to be done over and over again
			var helper = 
			{ 				
				autoRotation: function()
				{
					if(options.autorotation && slideCount > 1)
					{
						interval = setInterval(function()
						{ 	
							helper.setSlideNumber();
						},
						options.autorotationInterval);
					}
				},
				
				toggleAutoRotation: function(deactivate)
				{
					var button = $('.ctrl_play, .ctrl_pause', slideControlls);
					if (button.is('.ctrl_play') || deactivate == 'deactivate')
					{
						clearInterval(interval);
						button.removeClass('ctrl_play');
					}
					else
					{
						options.autorotation = true;
						helper.setSlideNumber();
						helper.autoRotation();
						button.addClass('ctrl_play');
					}
					return false;
				},
				
				newChangePossible: function()
				{
					animating = false;
				},
			
				setSlideNumber: function(event)
				{
					//stop in case of hidden portfolio items
					if(container.is(':hidden')) return false;
				
					var stop = false;
					if(event) helper.toggleAutoRotation('deactivate');
					
					if(!animating) //prevents transition if slides are already changing
					{
						var restore = i;
						
						if(event)
						{ 
							if(event.data.show == 'next') { i++; transition_direction = 'higher'; }
							if(event.data.show == 'prev') { i--; transition_direction = 'lower'; }
							if(typeof(event.data.show) == 'number') 
							{
								//check if next slide is the same as current slide
								if(i != event.data.show) 
								{
									transition_direction = 'lower';
									if(event.data.show > i)
									{
										transition_direction = 'higher';
									}
								
									i = event.data.show;
								}
								else
								{
									stop = true;
								}
							}
						}
						else
						{
							i++;
						}
						
						if(i+1 > slideCount) { i = 0; } else
						if(i < 0) {i = slideCount-1};
						
						//check if next Slide is animating, if so stop and reset i
						if(slides.filter(':eq('+(i)+')').is(':animated')) { stop = true; i = restore;}
			
											
						if(!stop) // prevents transition if the next slide and the current slide are the same
						{
							animating = true;
							animatingTimeout = setTimeout(helper.newChangePossible, (options.transitionDuration + 100)/(slideCount-1));
							
							helper.change();
						}
					}
					return false;
				},
				
				change: function()
				{	
					//set controll status
					var activeControll = controlls.find('a:eq('+(i)+')'),
						newHeight = currentSlide.height();
						
							
					$('.activeItem', controlls).removeClass('activeItem');
					activeControll.addClass('activeItem');
					
					
					//prepare container
					slideshow_container.height(newHeight);
					nextSlide = slides.filter(':eq('+(i)+')');
					
					
					if(container.is('.transition_slide'))
					{
						helper.slide(nextSlide);
					}
					else
					{
						helper.fade(nextSlide);
					}

				},
				
				slide: function()
				{
					var viewport = $(window).width() * 2,
						extraEls = $('.extra_movement', currentSlide),
						modifier = 1;
							
						if(transition_direction == 'higher')
						{
							modifier = -1;
							extraEls = $(extraEls.get().reverse());
						}
						
					currentSlide.css({display:"block", position:'absolute', zIndex:3});
					nextSlide.css({display:"block", zIndex:2, position:'absolute', top:'0px', left:viewport * modifier});
					
					
					extraEls.each(function(i)
					{
						var el = $(this),
							this_css_left = el.css("left");
						if(this_css_left == 'auto')	this_css_left = "0";
							
						var	pos_left = parseInt(this_css_left.replace(/px/g, "")),
							adjust_left = pos_left + (((i+1) * 35) * modifier );
							
							el.animate({left:adjust_left}, 450 ,"linear").animate({left:pos_left},300);
					});
					
					
					
					currentSlide.animate({left: -viewport * modifier}, 800, "easeInQuint", function()
					{
						nextSlide.animate({left: 0 }, 800, 'easeOutBackMod');
						currentSlide = nextSlide;
						helper.adjust_size(currentSlide);
					});

					
				},
				
				fade: function(nextSlide)
				{
					//check for video content
					var videoContentCurrent = currentSlide.find('object, embed, iframe, video, .avia_video'),
						videoContentNext = nextSlide.find('object, embed, iframe, video, .avia_video'),
						video_slide_helper = $("<li class='video_slide_helper'></li>").css({opacity:0});
						
					if(videoContentCurrent.length || videoContentNext.length)
					{

						video_slide_helper.appendTo(slideshow_container).animate({opacity:1}, function()
						{
							currentSlide.css('display','none');
							nextSlide.css({display:"block", zIndex:2, position:'absolute', top:'0px'});
							currentSlide = nextSlide;
							
							
							helper.adjust_size(currentSlide, function()
							{
								video_slide_helper.fadeOut(options.transitionDuration, function()
								{
									video_slide_helper.remove();
								});
							});
						});
					}
					else
					{
						//prepare slides
						currentSlide.css({display:"block", position:'absolute', zIndex:3});
						nextSlide.css({display:"block", zIndex:2, position:'absolute', top:'0px'});
					
						currentSlide.fadeOut( options.transitionDuration );
						currentSlide = nextSlide;
						helper.adjust_size(currentSlide);
					}
				},
		
				
				adjust_size: function(element, callback)
				{	
					var newHeight = element.height();
					
					
					slideshow_container.animate({height:newHeight}, options.transitionDuration, function()
					{
						if(container.is('.transition_slide')) 
						{ 
							slides.css('position','absolute'); 
						}
						else
						{
							element.css('position','relative');
							slideshow_container.css('height', 'auto');
						}
						if (callback  instanceof Function) { callback.call(this);  }
					});
				}

			};
			
			
			//methods holds one time executions
			var methods = 
			{
				preload : function(container)
				{
					if($.fn.aviaImagePreloader) 
					{ 
						container.aviaImagePreloader({fadeInSpeed: options.firstFadeInOfElements}, methods.init);
					}
					else
					{
						methods.init();
					}
				},
				
				init: function()
				{
					//adjust the height of the first slide
					helper.adjust_size(slides.filter(':eq(0)'));
					
					//get settings for autorotation
					methods.set_autorotation();
					
					//append slidecontrolls
					methods.appendControlls();
					
					//check and add slideshow Captions
					methods.appendCaption();
						
					//show appended elemens
					methods.showAppended();
					
					//init autorotation
					helper.autoRotation();
				},
				
				set_autorotation: function()
				{
					if(container.is('.autoslide_true'))
					{
						options.autorotation = true;
						
						var myRegexp = /autoslidedelay__(\d+)/g;
						var match = myRegexp.exec(container[0].className);
						
						if(match != null && parseInt(match[1]) > 0)
						{
							options.autorotationInterval = parseInt(match[1]) * 1000;
						}
					}
					else
					{
						options.autorotation = false;
					}
				},
				
				appendControlls: function()
				{
					//if controlls should be added by javascript and we got more than 1 slide 
					if(slideCount > 1)
					{ 
					
						var firstClass = 'class="activeItem"';
						
						controlls = $('<div></div>').appendTo(container)
													.addClass(options.controllContainerClass)
													.css({visibility:'hidden', opacity:0});
												
						slides.each(function(i){ $('<a '+firstClass+' href="#"></a>').appendTo(controlls); firstClass = ""; });
					}
					
					if(!options.appendControlls)
					{
						controlls.css({display:'none'});
					}
					
					//if we got controlls (either added by js above, or already available within the html source code add the click behaviour:
					if(options.controllContainerClass)
					{
						var links = $('.'+options.controllContainerClass, container).find('a');							
						links.each(function(i)
						{
							$(this).bind('click', {show: i}, helper.setSlideNumber);
						});
					}
					
					//slideshow controll buttons
					if(options.appendAutoSlideshowControlls && options.appendControlls && slideCount > 1)
					{
						slideControlls = $('<div></div>').appendTo(container)
														 .addClass(options.appendAutoSlideshowControlls)
														 .css({visibility:'hidden', opacity:0});
						var	status = 'ctrl_pause';
						
						if(options.autorotation) status += ' ctrl_play';
						
						slideControlls.html('<a class="ctrl_fwd" href=""></a><a class="'+status+'" href=""></a><a class="ctrl_back" href=""></a>');
						
						$('.ctrl_back', slideControlls).bind('click', {show: 'prev'}, helper.setSlideNumber);
						$('.ctrl_fwd', slideControlls).bind('click', {show: 'next'}, helper.setSlideNumber);
						$('.ctrl_pause, .ctrl_play', slideControlls).bind('click', helper.toggleAutoRotation);
					}
					
					if(!container.is('.transition_slide'))
					{
						slideControlls.css('visibility','visible')
						container.hover(
						function()
						{	
							slideControlls.stop().animate({opacity:1});
						},
						
						function()
						{
							slideControlls.stop().animate({opacity:0});			
						});
					}
					
				},
				
				appendCaption: function()
				{
					if(options.appendCaption && jQuery.fn.aviaConvertAttribute2HTML)
					{
						if(options.convertAttributes) // if we want to use the image data convert it, otherwise check if there is already a caption available and hide it 
						{
							slides.aviaConvertAttribute2HTML({newContainerClass: options.appendCaption});
						}
						captions = $('.'+options.appendCaption).css({visibility:'hidden', opacity:0});
					}
				},
				
				showAppended: function()
				{
					var opa = 0.8;
					//if($.browser.msie && $.browser.version < 9) opa = 0.8;
				
					$('.'+options.appendCaption+', .'+options.controllContainerClass).css('visibility','visible').animate({opacity:opa}, options.firstFadeInOfElements );
					
					if(container.is('.transition_slide'))
					{
						$('.'+ options.appendAutoSlideshowControlls ).css('visibility','visible').animate({opacity:opa}, options.firstFadeInOfElements );
					}
					
				}
					
					
			}; // end methods
			
			
			methods.preload(container);
			

		});
	
	}
	
})(jQuery);


// -------------------------------------------------------------------------------------------
// Slideshow supporting function that adds captions
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.aviaConvertAttribute2HTML = function(variables) 
	{
		var defaults = 
		{
			elements: 'img',
			newContainer:'div',
			newContainerClass: 'feature_excerpt',
			sets: {title: 'h1', alt: 'p'},
			split: '::',
			splitWrap: 'h1'
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			var container = $(this),
				elements = $(options.elements, container);
				
			elements.each(function()
			{
				var element = $(this),
					newContainer = $('<'+options.newContainer+'>').addClass(options.newContainerClass).appendTo(container);
			
				for (var key in options.sets)
				{
					var description = "";
					
					//check if the attribute got a value
					if(element.attr(key))
					{
						description = element.attr(key);
					}
					
					//if value is set and wrapping element is defined
					if(options.sets[key] && description)
					{
						description = '<'+options.sets[key]+'>'+description+'</'+options.sets[key]+'>';
					}
					
					//split option
					var splitdesc = description.split(options.split);
							
					if(splitdesc[0] != "" )
					{
						if(splitdesc[1] != undefined )
						{
							description = "<"+options.splitWrap+">"+splitdesc[0] +"</"+options.splitWrap+">"+splitdesc[1]; 
						}
						else
						{
							description = splitdesc[0];
						}
					}
					
					newContainer.html(newContainer.html() + description);
				}
				
			});	
			
		});
		
	};
	
})(jQuery);	


// -------------------------------------------------------------------------------------------
// Mega Menu
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.aviaMegamenu = function(variables) 
	{
		var defaults = 
		{
			modify_position:true,
			delay:300
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			var wrapper = $(this),
				menu = wrapper.find('>.avia_mega'),
				menuItems = menu.find(">li"),
				megaItems = menuItems.find(">div").parent().css({overflow:'hidden'}),
				dropdownItems = menuItems.find(">ul").parent(),
				parentContainerWidth = wrapper.width(),
				wrapperParentContainerWidth = wrapper.parent().width(),
				delayCheck = {};
				
			// add dropdown arrow, change cursor behaviour			
			menuItems.each(function()
			{
				var item = $(this),
					subitem = item.find("div:first, >ul");					
					
				if(subitem.length)
				{
					var link = item.find('>a');
					link.html("<span class='dropdown_link'>"+link.html()+"</span>").append('<span class="dropdown_available"></span>');

					if(typeof link.attr('href') != 'string'){ link.css('cursor','default'); }
					if(subitem.is('ul'))
					{
						subitem.css('background-position',(link.width()/2) + 'px 0px')
					}
				}
			});	
			
			// get correct position
			wrapperPos = wrapper.position();
			
			//correct the positin of the mega menu
			menuItems.each(function()
			{
				var item = $(this),
					pos = item.position(),
					megaDiv = item.find("div:first").css({opacity:0, display:"none", visibility:"visible"});


				if(options.modify_position && megaDiv.length)
				{										
					if(megaDiv.width() > pos.left + wrapperPos.left)
					{
						//var newLeft = pos.left;
						var newLeft = (megaDiv.width() - wrapperParentContainerWidth + pos.left + wrapperPos.left + parseInt(wrapper.css('padding-left')));
						megaDiv.css({left: newLeft * -1});
						megaDiv.css('background-position', megaDiv.width() - wrapperParentContainerWidth + pos.left + wrapperPos.left + (item.width()/2) + 'px 0px');
					}
					else if(pos.left + megaDiv.width() > parentContainerWidth)
					{
						//megaDiv.css({left: (megaDiv.width() - pos.left) * -1 });
						megaDiv.css({left: (megaDiv.width() - wrapperParentContainerWidth + pos.left + wrapperPos.left + parseInt(wrapper.css('padding-left'))) * -1 });
						megaDiv.css('background-position', megaDiv.width() - wrapperParentContainerWidth + pos.left + wrapperPos.left + (item.width()/2) + 'px 0px');
					}
				}
				
			});	
				
			
			function megaDivShow(i)
			{
				if(delayCheck[i] == true)
				{
					var item = megaItems.filter(':eq('+i+')').css({overflow:'visible'}).find("div:first"),
						link = megaItems.filter(':eq('+i+')').find("a:first");
						
						
						item.stop().css('display','block').animate({opacity:1},300);
						
						if(item.length)
						{
							link.addClass('open-mega-a');
						}
				}
			}
			
			function megaDivHide (i)
			{
				if(delayCheck[i] == false)
				{
					megaItems.filter(':eq('+i+')').find(">a").removeClass('open-mega-a');
					
					var listItem = megaItems.filter(':eq('+i+')'),
						item = listItem.find("div:first");
					
										
					item.stop().css('display','block').animate({opacity:0},300, function()
					{
						$(this).css('display','none');
						listItem.css({overflow:'hidden'});
					});
				}
			}


			//bind event for mega menu
			megaItems.each(function(i){
			
				$(this).hover(
				
					function()
					{	
						delayCheck[i] = true;
						setTimeout(function(){megaDivShow(i); },options.delay);
					},
					
					function()
					{
						delayCheck[i] = false;
						setTimeout(function(){megaDivHide(i); },options.delay);					
					}
				);
			});
			
			
			// bind events for dropdown menu
			dropdownItems.find('li').andSelf().each(function()
			{	
				var currentItem = $(this),
					sublist = currentItem.find('ul:first');
				
				if(sublist.length) sublist.css({display:'none'});
				
				currentItem.hover(
				function()
				{	
					sublist.fadeIn();

				},
				function()
				{	
					sublist.fadeOut();
				});	
			});
			
		});
	};
})(jQuery);	




// -------------------------------------------------------------------------------------------
// contact form ajax improvements
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.kriesi_ajax_form = function(variables) 
	{
		var defaults = 
		{
			sendPath: 'send.php',
			responseContainer: '#ajaxresponse'
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			var form = $(this),
				form_sent = false,
				send = 
				{
					formElements: form.find('textarea, select, input[type=text], input[type=hidden]'),
					validationError:false,
					button : form.find('input:submit'),
					dataObj : {}
				};
			
			responseContainer = $(options.responseContainer+":eq(0)");
			
			send.button.bind('click', checkElements);
			
			function send_ajax_form()
			{
				if(form_sent){ return false; }
				
				form_sent = true;
				send.button.fadeOut(300);	
				
				responseContainer.load(form.attr('action')+' '+options.responseContainer, send.dataObj, function()
				{
					responseContainer.find('.hidden').css({display:"block"});
					form.slideUp(400, function(){responseContainer.slideDown(400); send.formElements.val('');});
				});
									
				
			}
			
			function checkElements()
			{	
				// reset validation var and send data
				send.validationError = false;
				send.datastring = 'ajax=true';
				
				send.formElements.each(function(i)
				{
					var currentElement = $(this),
						surroundingElement = currentElement.parent(),
						value = currentElement.val(),
						name = currentElement.attr('name'),
					 	classes = currentElement.attr('class'),
					 	nomatch = true;
					 	
					 	send.dataObj[name] = encodeURIComponent(value);
					 	
					 	if(classes && classes.match(/is_empty/))
						{
							if(value == '')
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}
							nomatch = false;
						}
						
						if(classes && classes.match(/is_email/))
						{
							if(!value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/))
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}	
							nomatch = false;
						}
						
						if(nomatch && value != '')
						{
							surroundingElement.attr("class","").addClass("valid");
						}
				});
				
				if(send.validationError == false)
				{
					send_ajax_form();
				}
				return false;
			}
		});
	};
})(jQuery);












jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeOutBackMod: function (x, t, b, c, d, s) {
		if (s == undefined) s = 0.6;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});


function avia_console(text) {
  ((window.console && console.log) ||
   (window.opera && opera.postError) ||
   window.alert).call(this, text);
}






