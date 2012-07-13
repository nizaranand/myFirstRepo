jQuery.WPV = jQuery.WPV || {}; // Namespace

(function ($, undefined) {
	
	$(function () {

		$(window).bind('resize.narrowResolution', function() {
			$("body").toggleClass("narrow", $(window).width() < 1080);
		}).triggerHandler('resize.narrowResolution');
		
		function stripShareButtons(html) {
			var shareStart = "<!-- Starts share-btns (do not remove this comment) -->";
			var shareEnd = "<!-- Ends share-btns (do not remove this comment) -->";
			var start = html.indexOf(shareStart);
			var end   = html.indexOf(shareEnd);
			if (start > -1 && end > -1) {
				html = html.substring(0, start) + html.substr(end + shareEnd.length);
			}
			return html;
		}
		
		// Load More Button
		// ---------------------------------------------------------------------
		$(".load-more").die("click.pagination").live("click.pagination", function(e) {

			// Skip if alredy started
			if ($(this).is(":animated")) {
				return false;
			}
			
			var $currentLink = $(this);
			var $currentList = $currentLink.prev();
			
			var containerSelector = $currentList.is("section.portfolios > ul")
			? "section.portfolios > ul"
			: $currentList.is(".loop-wrapper") 
				? ".loop-wrapper:first"
				: null;

			if (containerSelector) {
				// Start loading indicator
				$(this).addClass("loading").find("> *").animate({opacity: 0});
				
				$.ajax({
					url      : $("a.lm-btn", this).attr("href"),
					dataType : "text",
					success  : function(html) {
						
						html = stripShareButtons(html);
						
						var article = $('<div/>').html(
							html.replace(/[\s\S]*?<article\b[^>]*>([\s\S]*)<\/article>[\s\S]*/i, "$1")
							.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi, '<span class="script" style="display:none">$1</span>')
						);
						
						var newContainer = $(containerSelector, article);
						if (newContainer.length) {
							
							// get the height to start from
							var startHeight = $currentList.height();
							
							// Append the new items as transparent ones
							var newItems = newContainer.children().css("opacity", 0);
							$currentList.append(newItems);
							
							$("span.script", $currentList).each(function(i, o) {
								$.globalEval($(o).text());
							}).remove();
							
							$currentList.trigger("rawContent", newItems.get());
							
							// Get the final height
							var endHeight = $currentList.height();
							
							// Expand the container 
							$currentList.height(endHeight);
							$currentList.css("height", "auto").children().animate({opacity: 1}, 1000);
							jQuery.WPV.initHoverFX($currentList);
							
							var newPager = $(".load-more", article);
							
							if (newPager.length) {
								$currentLink.html(newPager.html()).find("> *").animate({opacity: 1}, 600, "linear", function() {
									$currentLink.removeClass("loading");
								});
							}
							else {
								$currentLink.slideUp().remove();
							}
							$(window).trigger("resize").trigger("scroll");
							article = newContainer = startHeight = endHeight = newPager = null;
						}
					}
				});
			}
			return false;
		});
		
		// Prev/Next Pagination
		// ---------------------------------------------------------------------
		$(".next-post a, .prev-post a").die("click.pagination").live("click.pagination", function(e) {
			e.preventDefault();
			e.stopPropagation();
			var thisContainer = $("#main").find(".page-wrapper:first");
			
			if (thisContainer.css("position") == "static") {
				thisContainer.css("position", "relative");
			}
			
			//thisContainer.css("overflow", "hidden").height(thisContainer.height());
			
			$(this).addClass("loading").css({ 
				color : "transparent !important"
			});
			
			var markerStart = "<!-- #main (do not remove this comment) -->";
			var markerEnd   = "<!-- / #main (do not remove this comment) -->";
			var shareStart  = "<!-- Starts share-btns (do not remove this comment) -->";
			var shareEnd    = "<!-- Ends share-btns (do not remove this comment) -->";
			
			var newUrl = $(this).attr("href");
			$.ajax({
				url      : newUrl,
				dataType : "text",
				success  : function(html) {
					
					document.title = html.match(/<title>(.*?)<\/title>/i)[1];

					var start = html.indexOf(markerStart);
					var end = html.indexOf(markerEnd);
					if (start < 0 || end <= start) {
						return;
					}
					start += markerStart.length;
					html = html.substring(start, end); 
					
					// Extract the header and save it to an empty div
					var header = $("<div />");
					html = html.replace(/<header\b[\s\S]*?<\/header>/i, function(all) {
						header.html(all);
					});
					
					// Go 3 DIVs deeper
					html = html.replace(/^[\s\S]*?<div\b[^<]+/i, '').replace(/([\s\S]*)<\/div>[\s\S]*?$/i, '$1')
							   .replace(/^[\s\S]*?<div\b[^<]+/i, '').replace(/([\s\S]*)<\/div>[\s\S]*?$/i, '$1')
							   .replace(/^[\s\S]*?<div\b[^<]+/i, '').replace(/([\s\S]*)<\/div>[\s\S]*?$/i, '$1');
							   
					html = html.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi, '<span class="script" style="display:none">$1</span>');
					
					html = stripShareButtons(html);
					
					var oldChildren = thisContainer.children();

					var page = $('<div/>').css({
						height : "auto",
						opacity: 0
					}).appendTo(thisContainer).html(html);
					
					$(".page-wrapper:first", page).removeClass("page-wrapper");
					
					var newTitle = $("h1", header).html();
					var newBtns  = $(".prev-next-posts-links", header).html();
					
					$(".share-btns, #header-sidebars, .load-more, .widget.wpv_flickr", page).remove();
					
					$("span.script", page).each(function(i, o) {
						$.globalEval($(o).text());
					}).remove();
					
					page.trigger("rawContent");
					
					var _done = 0;
					function commonCallback() {
						if (++_done == 2) {
							jQuery.WPV.initPortfolioGallery(page);
							$('#commentform').validator();
							$(window).trigger("resize").trigger("scroll");
						}
					}
					
					oldChildren.animate({opacity: 0}, 800, "linear", function() {
						$(this).find("*").unbind().removeData().end().remove();
						commonCallback();
					});

					jQuery.WPV.initHoverFX(page);
					$("header h1").html(newTitle);
					$(".prev-next-posts-links").html(newBtns);
					
					page.animate({opacity : 1}, 1000, "linear", commonCallback);

					if(window.history.pushState) {
						history.pushState( { location: newUrl }, newTitle, newUrl );
					}
				}
			});
		});
		
		$('#commentform, .searchform').validator();

		$("nav > div > ul > li:last").css("paddingRight", 0);

		$("nav ul li").each(function (i, o) {

			$(this).find("ul").css({
				visibility: "hidden",
				display: "none",
				opacity: 0
			});

			$(this).hover(

			function () {

				$('ul:first', this).stop(1, 1).delay(200).queue(function () {

					if ($(o).is(".hover")) {
						return;
					}

					var submenu = $('ul:first', o);
					var thisOffset = $(o).offset();
					var vw = $(window).width();
					var isFirst = submenu.is("nav > div > ul > li > ul");

					submenu.css({
						visibility: "hidden",
						display: "inline-block"
					});

					$(o).addClass("hover");

					if (thisOffset.left + $(o).outerWidth({margin: true}) + submenu.outerWidth({margin: true}) > vw) {
						submenu.css({
							right: isFirst ? 0 : "100%",
							left: "auto"
						});
					} else {
						submenu.css({
							left: isFirst ? 0 : "100%",
							right: "auto"
						});
					}

					$(this).css({
						opacity: 0,
						visibility: "visible"
					}).animate({
						opacity: 1
					}, 200, "linear").dequeue();
				});
			}, function () {
				$('ul:first', this).stop(1, 0).delay(200).queue(function () {
					$(this).animate({
						opacity: 0
					}, 100, "linear", function () {
						$(this).css({
							display: "none"
						});
						$(o).removeClass("hover");
					}).dequeue();
				});
			});
		});

		$("nav ul li ul li:has(ul)").find("a:first").append(" &raquo; ");

		$('.post-head a img').parent().addClass('a-reset');

		$('.sitemap li:not(:has(.children))').addClass('single');

		var tooltip_animation = 250;
		$('.shortcode-tooltip').hover(function () {
			$(this).find('.tooltip').fadeIn(tooltip_animation).animate({
				bottom: 25
			}, tooltip_animation);
		}, function () {
			$(this).find('.tooltip').animate({
				bottom: 35
			}, tooltip_animation).fadeOut(tooltip_animation);
		});

		// Starts hover effect -------------------------------------------------
		(function() {
			
			// These params must match the ones used in for CSS 
			// transition based hover efect (in layout.css)
			var scaleDuration = 300,
				scaleFactor = 1.2,
				scaleDelay = 0,
				scaleEasing = "easeInOutSine",
				fadeDuration = 800,
				fadeDelay = 0,
				fadeEasing = "swing";
			
			jQuery.WPV.initHoverFX = function(context) {
				var hasTransitions = $("html").hasClass("csstransitions"),
					isWebkit = $.browser.webkit;
				if (!hasTransitions || isWebkit) {
					
					$(".portfolios .thumbnail:not(.hoverable), .services .thumbnail:not(.hoverable)", context)
					.bind("jailComplete", function() {
						var $thumb = $(this), 
							$info  = $(".thumbnail-pad, .info-pad", this),
							$img   = $("img.lazy", this);
						$thumb.addClass("hoverable").css("height", $img.attr("height"));
						$img.width($thumb.width()).height($thumb.height());
						$thumb.height($thumb.height());
						
						var w1 = $img.width(),
							h1 = $img.height(),
							w2 = scaleFactor * w1,
							h2 = scaleFactor * h1,
							x  = (w1-w2)/2,
							y  = (h1-h2)/2;
						
						$img.css({ 
							width     : w1,
							height    : h1,
							maxWidth  : w1,
							maxHeight : h1 
						});
						
						$thumb
						.die ("mouseenter.thumbnailHover")
						.live("mouseenter.thumbnailHover", function(e) {
							$img
							.stop(1, 0)
							.delay(scaleDelay)
							.animate({ 
								width      : w2,
								height     : h2,
								maxWidth   : w2,
								maxHeight  : h2,
								marginLeft : x,
								marginTop  : y
							}, scaleDuration, scaleEasing);
							
							if ( !isWebkit ) {
								$info
								.stop(1, 0)
								.delay(fadeDelay)
								.css("height", "auto")
								.animate({ opacity : 1 }, fadeDuration, fadeEasing);
							}
						})
						.die ("mouseleave.thumbnailHover")
						.live("mouseleave.thumbnailHover", function(e) {
							$img
							.stop(1, 0)
							.delay(scaleDelay)
							.animate({ 
								width : w1,
								height: h1,
								maxWidth : w1,
								maxHeight: h1,
								marginLeft  : 0,
								marginTop   : 0
							}, scaleDuration, scaleEasing);
							
							if ( !isWebkit ) {
								$info
								.stop(1, 0)
								.delay(fadeDelay)
								.animate({ opacity : 0 }, fadeDuration, fadeEasing, function() {
									$info.css("height", 0);
								});
							}
						});
					});
				}
			};
			
			jQuery.WPV.initHoverFX(); 
		})();
		// Ends hover effect ---------------------------------------------------

		// Starts Portfolio ----------------------------------------------------
		jQuery.WPV.initPortFolio = function(context) {
			
			var portfolioImages = $('.portfolios.sortable', context).not(".jail-started").find("img.lazy");
			
			function callback() {
				jQuery.WPV.initHoverFX(portfolioImages);
				setTimeout(function () {
					$(".portfolios.sortable").each(function () {

						var list  = $('> ul', this);//.css("WebkitTransform", "translate3d(0, 0, 0)");
						var items = $("> ul > li", this);
						var links = $('.sort_by_cat a', this);

						list.css({
							position: "relative",
							overflow: "hidden",
							width   : list.width(),
							height  : list.height()
						});

						var places = [];
						items.each(function (i, item) {
							var box = {
								top : $(item).position().top,//  - parseInt($(item).css("marginTop" ), 10),
								left: $(item).position().left// - parseInt($(item).css("marginLeft"), 10)
							};

							box.height = $(item).height();
							box.width  = $(item).width();
							$(this).css(box);
							places.push(box); //console.log(box);
						});
						//console.dir(places);
						var columns = {
							portfolio_two_columns: 2,
							portfolio_three_columns: 3,
							portfolio_four_columns: 4
						};

						items.css({
							position: "absolute"
						});
						
						links.each(function (i, link) {

							var cat, toShow, toHide;
							
							function getNewPanelHeight() {
								var H = 0;
								toShow.each(function (j) {
									H = Math.max(H, places[j].top + $(this).outerHeight(true));
								});
								return H;
							}
							
							function updatePanelHeight(callback) {
								list.css("height", getNewPanelHeight());
								callback();
							}
							
							function updateThumbnailPositions(callback) {
								toShow.each(function (j) {
									var cssFrom = {
										//"-webkit-transform": "none",
										display: "block",
										zIndex : 200,
										opacity : 0.01
									};
									var cssTo = {
										top : places[j].top,
										left: places[j].left,
										opacity : .99
									};
									$(this)
									.css(cssFrom)
									.delay(cat == 'all' ? Math.max(0, (j - 3) * 100) : j * 200)
									.animate(cssTo, {
										duration : cat == 'all' ? 800 : 600, 
										easing   : "swing", //"easeInOutExpo", 
										complete : function() {
											$(this).css("zIndex", 2).addClass("no-filter");
											if (j == toShow.length - 1) {
												callback();
											}
										}
									});
								});
								
								toHide.filter(":visible")
								.css({ zIndex: 1 })
								.removeClass("no-filter")
								.animate({ opacity: 0 }, cat == 'all' ? 1000 : 600, "swing");
							}
							
							$(this).click(function (e) {
								links.removeClass('active');
								$(this).addClass('active');
								cat = $(this).attr('data-value');
								toShow = cat == 'all' ? items : items.filter('[data-type*=' + cat + ']');
								toHide = cat == 'all' ? $()   : items.not('[data-type*=' + cat + ']');
								
								toShow.stop(1, 0);
								toHide.stop(1, 0);
								list  .stop(1, 0);
								
								if (cat == 'all') {
									updatePanelHeight(function() {
										updateThumbnailPositions(function() {
											//$(window).trigger("scroll").trigger("resize");
										});
									});
								}
								else {
									updateThumbnailPositions(function() {
										updatePanelHeight(function() {
											//$(window).trigger("scroll").trigger("resize");
										});
									});
								}
								return false;
							});
						});
					});
				}, 0);
			}
			
			if (portfolioImages.length) {
				portfolioImages.addClass("jail-started").jail({
					speed: 1400,
					event: "load",
					callback: callback
				});
			}
			else {
				callback();
			}
		}
		jQuery.WPV.initPortFolio(document);
		// Ends Portfolio ------------------------------------------------------

		// scroll to top button
		$(window).bind('resize scroll', function () {
			if (window.pageYOffset > 0) $('#scroll-to-top').fadeIn('normal');
			else $('#scroll-to-top').fadeOut('normal');
		});

		$('#scroll-to-top').click(function () {
			$('html,body').animate({
				scrollTop: 0
			}, 300);
		});

		/* header slider */

		function getThumbSrc(dir, slider) {
			var src = "about:blank";
			var nextSlide = slider.wpvSlider(dir == "next" ? "getNextSlide" : "getPreviousSlide");
			if (nextSlide.length) {
				src = nextSlide = nextSlide.find("> .wpv-slide").data("thumb") || "";
			}
			return src;
		}

		function setThumb(dir, slider) {
			var btn = $(dir == "next" ? ".wpv-nav-next" : ".wpv-nav-prev", slider.parent());
			var thumb = btn.find("> img.wpv-preview-thumb");
			var thumbSrc = getThumbSrc(dir, slider);
			if (thumbSrc) {
				if (!thumb.length) {
					thumb = $('<img class="wpv-preview-thumb" />').appendTo(btn);
				}
				thumb.attr("src", thumbSrc).css({
					visibility: "visible"
				});
			} else {
				thumb.css({
					visibility: "hidden"
				});
			}
		}

		$("#header-slider, .slider-shortcode").bind("afterChange sliderload", function () {
			setThumb("next", $(this));
			setThumb("prev", $(this));
		});

		// slide the nav buttons with the navigation-preview design
		$(".style-navigation-preview .wpv-nav-next").live("mouseenter", function () {
			$(this).stop(1, 0).animate({
				marginLeft: -$(this).outerWidth(),
				opacity: 1
			});
		}).live("mouseleave", function () {
			$(this).stop(1, 0).animate({
				marginLeft: -40,
				opacity: 0.3
			});
		});

		$(".style-navigation-preview .wpv-nav-prev").live("mouseenter", function () {
			$(this).stop(1, 0).animate({
				marginRight: -$(this).outerWidth(),
				opacity: 1
			});
		}).live("mouseleave", function () {
			$(this).stop(1, 0).animate({
				marginRight: -40,
				opacity: 0.3
			});
		});

		// helpers for the peek slider design
		$(".style-peek .wpv-nav-next").live("mouseenter", function () {
			$(this).stop(1, 0).animate({
				width: 50
			}, 130);
		}).live("mouseleave", function () {
			$(this).stop(1, 0).animate({
				width: 40
			}, 130);
		});

		$(".style-peek .wpv-nav-prev").live("mouseenter", function () {
			$(this).stop(1, 0).animate({
				marginLeft: 0
			}, 130);
		}).live("mouseleave", function () {
			$(this).stop(1, 0).animate({
				marginLeft: -10
			}, 130);
		});

		$(".style-peek #header-slider").one("sliderload", function (e, slider) {

			$(".wpv-slide-wrapper", slider.view).each(function (i, o) {
				$.data(o, "Slide").getCaption();

				// Click to scroll 
				$(o).click(function () {
					if (!$(o).is(".active")) {
						slider.goTo(i);
						return false;
					}
				})
			});

			$("#header-slider-caption-wrapper").show();
		});

		$(".style-peek #header-slider").one("beforeChange", function (e, slider, slideToShow, slideToHide) {
			var cur = slideToHide || slideToShow;
			var next = cur.next(".wpv-slide-wrapper");
			if (!next.length) {
				next = cur.parent().find(".wpv-slide-wrapper:first");
			}
			next.show().css({
				left: cur.position().left + cur.width() + 20
			});
		});
	}); 
	
	
	// Share buttons -----------------------------------------------------------
	//$(function() { 
		// Fake buttons fix 
	//	$(".page-outer-wrapper").append($(".share-btns.vertical")); 
	//});
	
	$(".share-btns").css({ 
		overflow: "hidden", 
		left: -80 });
	
	$('.real-btns').css({
		zIndex   : 100,
		padding  : 2,
		position : "relative",
		width	 : 64,
		left     : -90
	}).show();
	
	$('.fake-btns').css({ right: 16 }).bind("mouseenter", function() {
		$('.real-btns').stop(1, 0).animate({ left: 0 }, 400);
	});
	
	$('.real-btns').bind("mouseleave", function() {
	  $('.real-btns').stop(1, 0).animate({ left: -90 }, 400);
	}).find("iframe").css({
		width : 65,
		height: 140
	});
	
	$(".fake-btns > span").css({
		top: 2,
		right: 2
	});
	
	(function() {
		var btns = $(".share-btns");
		
		if (!btns.length) {
			return;
		}
		
		// Store some data about the initial position
		btns.each(function(i, o) {
			$(o).data("original-offset", {
				styleLeft  : $(o).css("left"),
				left	   : $(o).offset().left,
				offsetTop : $(o).offset().top
			}).css("top", 0);
		});
		
		function _repositionButtons(e) {
			btns.each(function(i, o) {
				var oot = $(o).data("original-offset"), fy = 20;
				if (oot) {
					if (oot.offsetTop < $(window).scrollTop()) {
						if ($(o).css("position") != "fixed") {
							$(o).css({
								left: $(o).offset().left,
								position: "fixed"
							});
						}
						else {
							if ( e && e.type == "resize") {
								$(o).css(
									"left",
									$(o).parent().offset().left + parseFloat(oot.styleLeft)
								);
							}
						}
					}
					else {
						$(o).css({
							position: "absolute",
							left: oot.styleLeft
						});
					}
					
					if ( e && e.type == "resize") {
						oot.offsetTop = $(o).offset().top;
					}
				}
			});		
		}
		
		$(window)
		.unbind("scroll.sharebtns")
		.unbind("resize.sharebtns")
		.bind("scroll.sharebtns resize.sharebtns", _repositionButtons);
		
		_repositionButtons();
	})();
	
	// Portfolio - detail page -------------------------------------------------
	jQuery.WPV.initPortfolioGallery = function(context) {
		$("article.portfolio", context || document).each(function(i, o) {
			var viewer	 = $("> .portfolio_image_wrapper", this),
				thumbs	 = $("> .portfolio_details a.portfolio-small", this);
			
			if (viewer.css("position") == "static") {
				viewer.css("position", "relative");
			}
			
			viewer.css({
				width  : viewer.width(),
				height : viewer.height()
			});
			
			thumbs.removeClass("lightbox").unbind("click").bind("click.portfolioGallery", function(e) {
				var oldView = $("> a.portfolio_image, > img", viewer).css({ zIndex : 1 }),
					newView = $('<img />').css({
					maxWidth: "100%",
					maxHeight: "100%",
					position : "absolute",
					zIndex : 3,
					left: "50%",
					top : "50%",
					opacity  : 0
				}).attr({
					alt : $("> img", this).attr("alt")
				})
				.appendTo(viewer);
				
				newView.bind("load error", function(e) {
					$(this).css({
						marginLeft: -this.offsetWidth  / 2,
						marginTop : -this.offsetHeight / 2
					});
					
					oldView.animate({opacity:0}, 400, "linear");
					newView.animate({opacity:1}, 400, "linear", function() {
						newView.css({
							zIndex   : 1,
							position : "relative"
						});
						oldView.unbind().remove();
					});
				}).attr("src", this.href);
				
				return false;
			});
		});
	};
	jQuery.WPV.initPortfolioGallery();
		
	// Internet Explorer fixes -------------------------------------------------
	if ($.browser.msie && $.browser.version == 8) { 
		$('p:empty').hide(); 
		$('p:last-child, ul li:last-child, ol li:last-child, .widget:last-child, .accordion:last-child, .toggle:last-child, .toggle_content:last-child, .main-footer .clearboth.push:last-child, .services-1 div div span:last-child, .services-2 div div span:last-child, .services-3 div div span:last-child').addClass('last');
		$('.services-1 div span:last-child, .services-2 div div span:last-child, .services-3 div div span:last-child').css({
			background: $("#main > .pane").css("backgroundColor"),
			padding: "3px 6px"
		});
	}  
 
	// -------------------------------------------------------------------------
	$.rawContentHandler(function() {
		$(".loop-wrapper.news .page-content", this).equalHeight();
	});
	
	////////////////////////////////////////////////////////////////////////////
	/*
	var bgAnimationImages = [
		"http://images.fanpop.com/images/image_uploads/Lightning-McQueen-disney-pixar-cars-772510_1700_1100.jpg",
		"http://freeimagesarchive.com/data/media/27/14_cars.jpg",
		"http://www.carwashpictures.com/wp-content/uploads/2011/08/used-cars-for-sale-by-owner.jpg"
	];
	if ($.isArray(bgAnimationImages)) {
		
		
		var pos = 0,
		speed = 2000,
		paused = false,
		loop = 0,
		cicles = 0;

		$(window).bind("resize.centerBgImage", function(e) {
			$("img.page-bg-image").each(function() {
				var _img       = $(this),
					_imgWidth  = _img.width(),
					_imgHeight = _img.height(),
					_winWidth  = $(window).width(),
					_winHeight = $(window).height();
					
				if (_imgWidth < _winWidth) {
					_img.css({
						height: "auto",
						width : "100%"
					});
					_imgWidth = _img.width();
					_imgHeight = _img.height();
				}
				
				if (_imgHeight < _winHeight) {
					_img.css({
						height: "100%",
						width : "auto"
					});
					_imgWidth = _img.width();
					_imgHeight = _img.height();
				}
					
				_img.css({
					marginLeft: (_winWidth  - _imgWidth ) / 2,
					marginTop : (_winHeight - _imgHeight) / 2
				});
			});
		});


		function next() {
			
			if (paused) {
				setTimeout(next, speed);
				return;
			}
			if (pos >= bgAnimationImages.length) {
				pos = 0;
				if (loop > 0 && ++cicles > loop) return;
			}
			var img = new Image();		
			img.onload = function() {
				var _img = $('<img class="page-bg-image"/>').appendTo("body").css("opacity", 0).attr("src", this.src);
				$(window).triggerHandler("resize.centerBgImage");
				_img.animate({opacity: 1}, 3000, "swing", function() {
					$(".page-bg-image.ready").remove();
					_img.addClass("ready");
					setTimeout(next, speed);
					img = null;
				});
			};
			img.src = bgAnimationImages[pos++];
		}

		next();
	}*/
})(jQuery);

