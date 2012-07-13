	
	
	<!-- Framework CSS -->
	<link rel="stylesheet" href="<?php echo WPV_THEME_URI?>docs/style/screen.css" type="text/css" media="screen, projection">
	<style type="text/css" media="screen">
		#wpv-config p, #wpv-config table, #wpv-config hr, #wpv-config .box { margin-bottom:25px; }
		#wpv-config .box p { margin-bottom:10px; }
		#wpv-config .panel_title { color: #21759b;text-decoration:underline;}
	</style>

	<div class="container">
	
		
		
		<hr>
		
		<h1 class="center">“Zenden”</h1>
		
		<div class="borderTop">
			<div class="span-6 colborder info prepend-1">
				<p class="prepend-top">
					<strong>
					Created: 14.03.2012<br>
					By: <a href="http://vamtam.com/" target="_blank">Vamtam</a><br>
					Email: <a href="mailto:office@vamtam.com">office@vamtam.com</a>
					</strong>
				</p>
			</div><!-- end div .span-6 -->		
	
			<div class="span-12 last">
				<p class="prepend-top append-0">Thank you for purchasing our theme. If you have any questions that are beyond the scope of this help file, please feel free to <a href="mailto:office@vamtam.com">email us</a>. And You should <a href="http://twitter.com/vamtam" target=_blank>follow us on twitter</a> to get the updates. Thanks so much!</p>
			</div>
		</div><!-- end div .borderTop -->
		
		<hr>
		<h2 id="toc" class="alt">20 + "How to" Video Tutorials available <a href="http://zenden.vamtam.com/video-tutorials/">here</a>!</h2>
		<h2 id="toc" class="alt">Table of Contents</h2>
		<ol class="alpha">
			<li>
				<a href="#zendeninstallation">Zenden Installation</a>
			</li>
			<li>
				<a href="#quicksetup">Quick Setup</a>
			</li>
			<li>
				<a href="#themeoptions">Advanced Options</a>
				<ol>
					<li><a href="#themeoptionsgeneralsettings">General Settings</a></li>
					<li>
						<a href="#themeoptionslayout">Layout</a>
						<ol>
							<li><a href="#themeoptionslayoutheader">Header Layout</a></li>
							<li><a href="#themeoptionslayoutfooter">Footer Layout</a></li>
						</ol>
					</li>
					<li>
						<a href="#themeoptionsstyles">Styles</a>
						<ol>
							<li><a href="#themeoptionsstylesgeneraltypography">General Typography</a></li>
							<li><a href="#themeoptionsstylesheader">Header</a></li>
							<li><a href="#themeoptionsstylesbody">Body</a></li>
							<li><a href="#themeoptionsstylesfooter">Footer</a></li>
							<li><a href="#themeoptionsstylesforms">Forms</a></li>
							<li><a href="#themeoptionsstylestabsaccordionstoggles">Tabs, accordions and toggles</a></li>
							<li><a href="#themeoptionsstylesposts">Posts</a></li>
							
						</ol>
					</li>
					<li>
						<a href="#themeoptionsheaderslider">Header Slider</a>
						<ol>
							<li><a href="#themeoptionsheadersliderdescription">Sliders description</a></li>
						</ol>
					</li>
					<li><a href="#themeoptionssaveimportskin">Save/Import Skin</a></li>
					<li><a href="#themeframeworkoptionsmanagesidebars">Manage Sidebars</a></li>
					<li><a href="#themeframeworkoptionsquickimport">Quick Import</a></li>					
				</ol>
			<li>
				<a href="#themeportfolios">Portfolios</a>
				<ol>
					<li><a href="#themeportfoliovamtamoptions">Portfolio Vamtam options</a></li>
					<li><a href="#themeportfoliovamtamtemplates">Portfolio Vamtam templates</a></li>				
				</ol>
			</li>
			<li>
				<a href="#themeposts">Posts</a>
				<ol>
					<li><a href="#themepostsvamtamoptions">Posts Vamtam options</a></li>
					<li><a href="#themepoststemplates">Posts Vamtam templates</a></li>
				</ol>		
			</li>
			<li>
				<a href="#themepages">Pages</a>
				<ol>
					<li><a href="#themepagesvamtamoptions">Pages Vamtam options</a></li>
					<li><a href="#themepagestemplates">Pages Vamtam templates</a></li>
				</ol>
			</li>
			<li>
				<a href="#progressiovideos">Vamtam Videos</a>
			</li>
			<li>
				<a href="#credits">Credits</a>			
			</li>
		</ol>	
		
		<hr>
		
		<h3 id="zendeninstallation"><strong>A) Zenden Installation</strong> - <a href="#toc">back to TOC</a></h3>
		<p>
		Download <strong>Zenden</strong> theme to a separate folder and unzip the package file.
		</p>
		
		<p>
			Note: the following theme is Wordpress 3.3+ compatible. Use your ftp or ssh client to copy the 
			“zenden” folder in your WordPress installation: <strong><em>[WP-Install]/wp-content/themes/</em></strong> . 
			All other resource folders are not required for theme installation.
		</p> 

		<p>
			Note: The zenden/cache folder (as well as the other cache files inside) need 755 privileges though some server configuration may require that you set them to 777. This could be done with FileZilla or another FTP 
			client where you open <strong>your-wordpress-install/wp-content/themes/zenden</strong> and right click on cache and select 755 for privileges plus the
			tick for recursive permission inheritance to the other files and folders inside. With plain console/shell it would be:
		</p>
		
		<p>
			<code>chmod 755 -R cache</code>
		</p>
		
		<p> 
		for the cache folder. For more permission details please refer to <a href="http://buddingbloggers.com/2009/04/changing-file-permissions-via-filezilla/" target="_blank">Changing file permissions via FileZilla</a>
		</p>
		
		<p>
		If you are experiencing troubles with the css caches (broken layout, missing backgrounds), please set the priviliges of /cache/ to 777 and reactivate the theme.
		</p>
		
		<p>
		After the transfer is complete, visit the <strong><em>WordPress administration</em></strong> => <strong><em>Appearance</em></strong> => 
		<strong><em>Themes</em></strong>. Find the “<strong><em>Zenden</em></strong>” theme and activate it as your new website layout. In the 
		sidebar you will see your new theme panels for <strong><em>Portfolios</em></strong> and <strong><em>Vamtam options</em></strong>:
		</p>

		<img src="<?php echo WPV_THEME_URI?>docs/images/dashboard_slides_portfolio_vamtam.png">
		
		<br /><br />
		
		<p>
		If you need help installing <strong>Zenden</strong> you can see our <a href="http://support.vamtam.com/solution/categories/2296/folders/4678/articles/1796-install-guide" target="_blank">Install guide</a> or this <a href="http://www.youtube.com/watch?feature=player_embedded&v=LCEOLNZIAuQ" target="_blank">How to install the theme via ftp? </a>. All of our themes are based on the Vamtam framework so the procedure of installing any of our themes is the same.
		</p>
		
		<p>If you need help installing Wordpress see the link below:<br />
		<a target="_blank" href="http://codex.wordpress.org/Installing_WordPress">http://codex.wordpress.org/Installing_WordPress</a>
		</p>
		
		<h3 id="quicksetup"><strong>B) Quick Setup</strong> - <a href="#toc">back to TOC</a></h3>
		
		<p>
			We realize that <strong>Zenden</strong> is very powerful and provides tons of useful options. However we are aware of the fact that some of our clients need the basic setup only. That's why we present you the new admin tab named "Quick Setup". It is designed for your own convenience in order to provide the most common and important options for a site setup. If you need to get into some deep setup configuration, you could use the <strong>Advanced options</strong> panel that adds a variety of options tuning even the tiniest bit of your installation. <br />
			For further reference of the Quick Setup features please review the full set of options in the <a href="#themeoptions">advanced sections</a> in order to be able to distinct the specifics better.
		</p>

		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_quick_setup.png">
		<br /><br />
		
		<h3 id="themeoptions"><strong>C) Advanced options</strong> - <a href="#toc">back to TOC</a></h3>
		
		<p>
		The <strong><em>Vamtam</em></strong> panel in your admin sidebar will help you to polish and configure your theme. There are 
		different sets of options separated by type and area for your convenience. For quicker website build, use the <a href="#quicksetup">Quick Setup</a> instead. 
		</p>
		
		<img src="<?php echo WPV_THEME_URI?>docs/images/dashboard_vamtam.png">
		
		<br /><br />
		<h3 id="themeoptionsgeneralsettings"><strong>C 1) General Settings</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_general_settings.png">
		
		<p>
		This is the first advanced tab to be revealed when working on your Zenden-based website. All the marketing and content details are to be found in this tab. Your <em>theme logo</em>, the <em>footer copyright text</em>, <em>favicons</em>, <em>script settings</em> and more are in this panel. If you are willing to use the <em>Google Maps</em> or <em>Google Analytics</em> services, here is the place to <strong>add the API keys</strong>. The <em>phone number</em> in the top section is the next thing to be modified out there. If you want to style the phone number on the top, check out <a href="http://support.vamtam.com/solution/categories/2315/folders/4715/articles/2119-change-the-top-right-phone-area-font-properties-" target="_blank">this guide</a> from our <a href="http://support.vamtam.com/" target="_blank">Help desk system</a> that you could use for any questions regarding the theme options, settings and feedback on the theme as well.
		</p>
		<p>
			<strong>Note to both advanced and standard users:</strong> There are two sections here for external snippets - <strong>Custom javascript (in footer)</strong> and <strong>Custom css</strong>. For any visual modification of the website not included in the admin options please use these areas.We are always going to advice you adding your code snippets in one of these areas for JS or CSS respectively.<br />
			Here is video tutorial with more information about this options: <a href="http://www.youtube.com/watch?feature=player_embedded&v=eZy_29aI-S0" target="_blank">How to use the external css area?</a>.
		</p>
		<p>
			We issue regular updates on our themes which apply hundreds of lines of code updated in tens of files from our install. Doing manual updates in the theme files without using these areas will lead to overriding you custom changes when update is released. There is a minority of settings that require custom file changes and they are always beyond the standard modifications of a theme.
		</p>
		<p>
		The <em>General Settings</em> tab also includes the basic settings for your pages. Here you could enable or disable
		some of the visible panels for your website: the “<em>Scroll to top</em>” button in the right section 
		of the website when you scroll down, the <em>RSS button</em>, <em>Facebook button</em>, <em>Twitter button</em>, <em>YouTube button</em> and <em>Flick button</em> in the top right corner and the <em>Feedback button link</em> as well.  
		All of these elements could be set <em>visible</em> or <em>hidden</em> state according to your preferences. In <em>Share icons</em> you can select the social medias you want enabled.
		</p>

		<h3 id="themeoptionslayout"><strong>C 2) Layout</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_layout.png">
		<br /><br />
		
		<p>
		In <em>Layout</em> you can set the the width of the sidebars in the main body area (if any) and the height of the header and slider zones, sidebars and body content, footer widgets areas and subfooter area by dragging the blue sliders. You can enable or disable <em>Boxed layout</em>.</p>
		<p><strong>Zenden</strong> allows you to choose between the <em>boxed</em> or <em>full width</em> layout. In other words your website could be strictly wide a given amount of pixels
		or instead fill the whole width of your monitor. This is up to you - and in combination with the sliders this could give you infinite
		power to create a beautiful and powerful site with a great usability.
	    </p>
	    <p>
		You can adjust Header height, Header slider height, Left and Right sidebars widths with more precise parameters or setting a specific value based on your end design. This could be useful working after a PSD having the exact dimensions and sizes to be set on your Zenden install.
		</p>
		
		<h5 id="themeoptionslayoutheader"><strong>C 2.1) Header Layout</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_layout_header_layout.png">
		<br /><br />
		
		<p>
		In <em>Header Layout</em> you can adjust the widget areas. They are placed between the slider and the body of the site. By default 
		these areas are disabled. They can be enabled on every single page or post. You can either choose one of the predefined layouts or 
		configure your own in the "Advanced" section.
		</p>
		<p>
		Widget areas are a special Zenden feature whenever you need to use widgets in the content area. If you use some third party plugins with powerful widgets and want them to be visible in the actual content area, just enable them here and add your widgets.
		</p>
		
		<h5 id="themeoptionslayoutfooter"><strong>C 2.2) Footer Layout</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_layout_footer_layout.png">
		
		<p>
		In <em>Footer Layout</em> the footer widget areas are positioned after the body of the site. You can either choose one of 
		the predefined layouts or configure your own in the "Advanced" section if you want.
		</p>
		 
		
		<h3 id="themeoptionsstyles"><strong>C 3) Styles</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles.png">
		<br />
		
		<p>
		In <em>Styles</em> you can style <em>General backgrounds</em>, <em>General links</em> and <em>General colors</em>.
		In <em>General backgrounds</em> you can set background color or insert custom background picture or choose some of the preset 
		background patterns we have created for you! Also you can set colors for different links. 
		</p>
		
		
		<h5 id="themeoptionsstylesgeneraltypography"><strong>C 3.1) General Typography</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles_general_typography.png">
		<br />
		
		<p>
		In <em>Typography</em> you can configure font size, line height for the fonts. You can choose for different font types, set font style
		and font color. Please keep in mind that CSS3 fonts and Google fonts use a technique which is not supported in IE7/8.
		</p>
		<p>
		Different text sizes are to be modified in this areas. You could apply styling to titles, subtitles, general text and other basic font areas.
		</p>
		
		<h5 id="themeoptionsstylesheader"><strong>C 3.2) Header</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles_header.png">
		<br />
		
		<p>
		In <em>Header</em> you can set custom background color or insert a picture for your header background. In addition to that you can set the background color for the slider or insert a background image. You can adjust font for your Site title and set colors for links in you header. There are plenty of settings here for precise adjustment of your background or font settings.</p>
		<p>
		<strong>Zenden</strong> provides support for <em>two menus</em> - <strong>Top Menu</strong> and <strong>Header Menu</strong>. Both are using the Custom Menu feature introduced in <strong>WordPress 3</strong>. Setting a specific menu element for these areas can be done in <strong>Appearance</strong> => <strong>Menus</strong>. See this resource for additional details on menu management - <a href="http://www.wproots.com/the-ultimate-guide-to-wordpress-menus/" target="_blank">The Ultimate Guide to WordPress menus</a> and our video - <a href="http://www.youtube.com/watch?feature=player_embedded&v=kzImtlFsIPI" target="_blank">How to set up the menu? </a>.
		</p>
		
		<h5 id="themeoptionsstylesbody"><strong>C 3.3) Body</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles_body.png">
		<br />
		
		<p>
		In <em>Body</em> you are able to set the background color from a color picker and if you want to go any further, you could also insert an image for background. Color pickers will assist you to select the appropriate color through the RGB color schemes. There are additional options for background positioning and layout.
		</p>
		<p>
			Note that the background image could be set for the site generally. For each page you have an extra option in <em>Add/Edit Page</em> screen to set a specific image background with unique positioning. 
		</p>
		
		<h5 id="themeoptionsstylesfooter"><strong>C 3.4) Footer</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles_footer.png">
		
		
		<p>
		In the <em>Footer</em> section there are options for the custom background colors or background images for Footer and Sub-footer backgrounds. You can
		set color values for widget areas and select general footer font-size. Go to the Link section to adjust footer widget link colors to your taste.
		</p>
		<p>
			<strong>Vamtam</strong> defines two areas - the footer and the subfooter that could be managed separately. If you want to change your copyright text defined at the very bottom, you need to <a href="http://support.vamtam.com/solution/categories/2296/folders/4678/articles/2124-edit-the-copyright-text-in-theme-footer" target="_blank">navigate to the Copyright area</a>.
		</p>
		
        <h5 id="themeoptionsstylestabsaccordionstoggles"><strong>C 3.5) Forms</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles_forms.png">
		<br />		
		<p>
		In <em>Forms</em> section you can adjust Buttons text and hover text colors and buttons border radius. Also you can set custom colors for text fields.
		</p>
		
		<h5 id="themeoptionsstylestabsaccordionstoggles"><strong>C 3.6) Tabs, accordions and toggles</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles_tabs_accordions_and_toggles.png">
		<br />
		
		<p>
		Here you can customize different color settings for Tabs, accordions and toggles.
		</p>
			
		<h5 id="themeoptionsstylesposts"><strong>C 3.7) Posts</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_styles_posts.png">
		
		</p>
		In <em>Posts</em> you can set width and height for "Side image" and "Full image" dimensions. Also in the Meta portion of this admin tab you can choose whether to show or not categories and tabs, timestamp and comment count. 
		</p>
		
		<h3 id="themeoptionsheaderslider"><strong>C 4) Header Slider</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_header_slider.png">
		<br /><br />

		<p>
	Please check out our video tutorials: <a href="http://zenden.vamtam.com/video-tutorials" target="_blank">How to add slideshow with images to a page?</a> , <a href="http://zenden.vamtam.com/video-tutorials" target="_blank">How to add slideshow with video to a page?</a>, <a href="http://zenden.vamtam.com/video-tutorials" target="_blank">How to use multiple captions for a slide?</a>
		</p>		

		
		<h5 id="themeoptionsheadersliderdescription">C 4.1) <strong>Sliders description</strong> - <a href="#toc">back to TOC</a></h5>
		
		<p>
			<strong>Zenden</strong> is created with plenty of slider types and options and you are able to test them on our demo installation. The variety of effects and settings will let you polish your overall website vision.<br />
			If you need more information, here you can see <a href="http://support.vamtam.com/solution/categories/2315/folders/5816/articles/2347-how-to-enable-disable-slider-in-page-post" target="_blank">How to enable/disable Slider in Page/Post</a> in our <a href="http://support.vamtam.com/solution/categories" target="_blank">Solutions</a> section or <a href="http://www.screenr.com/6cLs" target="_blank">this Sliders video tutorial</a>.
		</p> 
		
	
		

		<p>
		It is important to say that while most of the settings for the <em> Header Slider</em> in <em>Theme options</em> are global, you are able to override some 
		in the <em>Post/Page settings</em>, for example, <em>Slider style</em>. This gives you an opportunity 
		to have different styles for your <em>Header Slider</em> in different Posts/Pages.<br />
		To see how, check <a href="#themepagesvamtamoptions">Pages Vamtam options</a> or <a href="#themepostsvamtamoptions">Posts Vamtam options</a>		
		</p>
		
		
		<h3 id="themeoptionssaveimportskin"><strong>C 5) Save/Import Skin</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_save_import_skin.png">
		<br /><br />
		
		<p>
		<strong>The Vamtam theme</strong> allows you to <em>Save current skin</em> or <em>Import saved skin</em> that you saved before.	The saved skin persists all of the options from the Theme options including colors, dimensions, slider settings etc. This is an easy way for you to create the winter and summer versions of your website without any design requirements. 
		</p>
		
		<p>
		In <a href="http://www.youtube.com/watch?feature=player_embedded&v=Bhob0QQ6Gxg" target="_blank">this video</a> you can see how to work with skins.
		</p>

		<h3 id="themeframeworkoptionsmanagesidebars"><strong>C 6) Manage Sidebars</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_manage_sidebars.png">
		<br />
		
		<p>
		Here you can add new sidebars or delete already exists if you have added before. When you add new sidebar, you will be able 
		to manage it from <em>Widgets</em> in your theme.
		</p>

		<h3 id="themeframeworkoptionsquickimport"><strong>C 7) Quick Import</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_advanced_options_quick_import.png">
		
		<p>
		<strong>Vamtam</strong> gives you option to <em>Import dummy content</em> that we have prepared for you. You can edit content
		in any time you want. This is the perfect chance for you to install WordPress and Zenden and get all the existing demo content we provide on the demo site and only replace the text and images as you would do in your website assignment. Quick and clean solution combining all the shortcode combinations and skins that you have already seen on the demo.
		</p>

		<p>
		In this video you can see how to install demo content: <a href="http://www.youtube.com/watch?feature=player_embedded&v=tnlCw8pPiVY" target="_blank">How to import demo content and widgets?</a>
		</p>

		<h3 id="themeportfolios"><strong>D) Portfolios</strong> - <a href="#toc">back to TOC</a></h3>
		<img src="<?php echo WPV_THEME_URI?>docs/images/vamtam_portfolios.png">		
		
		<p>
		You can add <em>Portfolios</em> and categories for them.<br />
		For more information about Portfolios watch these videos: <a href="http://www.youtube.com/watch?feature=player_embedded&v=hX-n_hKgzFk" target="_blank">How to set up a portfolio page?</a> , <a href="http://www.youtube.com/watch?feature=player_embedded&v=AqX2COGngCo" target="_blank">How to add and visualize a portfolio item in a new category?</a> and <a href="http://www.youtube.com/watch?v=3QKS1Z5qKF0" target="_blank">How to add a portfolio item to a portfolio page?</a>
		</p>
		
		<h5 id="themeportfoliovamtamoptions"><strong>D 1) Portfolio Vamtam options</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/portfolio_vamtam_options.png">
		
		<br /><br />
		<p>In <em>Porftolios</em> page you can adjust <em>Layout type</em> for your porftolio and set options for <em>Left</em> and <em>Right</em> sidebars on the portfolio page. You can enable or disable <em>Header widget areas</em> and choose <em>Custom background color</em> or <em>Insert custom image</em> for portfolio background. So you could list your portfolio items in a grid and present a beautiful background image or color that suits your overall outlook. </p>
		<p>
		You have additional settings for the <em>Header slider</em>. Here you can enable or disable slider and set a <em>Slider style</em> - as you could just hide the slider for that portfolio page or want to change the effects and appearance options. You can turn on or off <em>Full width slider</em> and choose to show slides only from specific <em>slides categories</em> (for better filtering).</p>
		<p>
		You can select <em>Portfolio data type</em> from dropdown and insert <em>Portfolio data url</em>. Portfolios could embed different images, videos or other documents. An item can adjust width and height for <em>Portfolio video</em> and choose <em>Portfolio link target</em>. Also you can add images for <em>Portfolio gallery</em>.
		</p>
		
		<h5 id="themeportfoliovamtamtemplates"><strong>D 2) Portfolio Vamtam templates</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/portfolio_vamtam_template.png">
		
		<p>
		After styled your Portfolio from <em>Vamtam options</em> you can save current template or choose from saved templates for your porftolio. The template is an overall structure of your portfolio with the options and outlook and theme settings that you would normally use on another page. This makes it easier to replicate without the repetitive clicking of all options around the page.
		</p>
		
		<h3 id="themeposts"><strong>F) Posts</strong> - <a href="#toc">back to TOC</a></h3>
		
		<h5 id="themepostsvamtamoptions"><strong>F 1) Posts Vamtam options</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/post_vamtam_options.png">

		<p>  
		After the standard <strong>Zenden</strong> installation your <em>Post editor</em> for every post will attain the <em>Vamtam options</em> panel
		form where you can personalize every single post.</p>
		<p>
		You can adjust <em>Layout type</em> for your post and set options for <em>Left</em> and/or <em>Right</em> sidebars. You can enable or disable the <em>Header widget areas</em> (in order to add some widgets in the content part of your single post view) and choose <em>Custom background color</em> or <em>Insert custom image</em> for post background.</p>
		<p>Also, there are the standard settings for the <em>Header slider</em>. Here you can enable or disable slider and set <em>Slider style</em>.
		You can turn on or off the <em>Full width slider</em> if you need some specific header layout for that post view and prefer to show slides only from specific <em>slides categories</em>.</p>
		<p>Check the settings for <em>Post format</em> as this is a supported feature of Zenden based on the newest WordPress improvements. <em>Link</em> is to be set when you set "quote", "link", "audio" and "video" formats and <em>Quote author</em>
		for the "quote" post format. There are different layout and preview visibility settings for each post format supported by our theme.
		</p>		
		
		<h5 id="themepoststemplates"><strong>F 2) Posts Vamtam templates</strong> - <a href="#toc">back to TOC</a></h5>
		<img src="<?php echo WPV_THEME_URI?>docs/images/posts_vamtam_templates.png">
		
		<p>
		After the final styling of your post from <em>Vamtam options</em> you can save current template or choose from saved templates for your post.
		</p>

		<h3 id="themepages"><strong>G) Pages</strong> - <a href="#toc">back to TOC</a></h3>
		
		<h5 id="themepagesvamtamoptions"><strong>G 1) Pages Vamtam options</strong> - <a href="#toc">back to TOC</a></h5>		
		<img src="<?php echo WPV_THEME_URI?>docs/images/page_vamtam_options.png">
		
		<p>
		After <strong>Zenden</strong> is installed bellow <em>Page editor</em> for each page will show <em>Vamtam options</em> panel
		form which you can personalize every single page. You can add <em>Descriptions</em> for your page. You can adjust
		<em>Layout type</em> for your page and set options for <em>Left</em> and <em>Right</em> sidebars. You can enable or disable
		<em>Header widget areas</em> and choose <em>Custom background color</em> or <em>Insert custom image</em> for page background.
		You have settings for <em>Header slider</em>. Here you can enable or disable slider and set <em>Slider style</em>.
		You can turn on or off <em>Full width slider</em> and choose to show slides only from specific <em>slides categories</em>.
		</p>		
		
		<h5 id="themepagestemplates"><strong>G 2) Pages templates</strong> - <a href="#toc">back to TOC</a></h5> 
		<img src="<?php echo WPV_THEME_URI?>docs/images/pages_vamtam_templates.png">
		
		<p>
		When your page is styled from <em>Vamtam options</em> you can save current template or choose from saved templates for your page.
		</p>
		
		<h3 id="progressiovideos"><strong>H) Vamtam Videos</strong> - <a href="#toc">back to TOC</a></h3>
		<p>
		Here you can find 20 + "How to" Video Tutorials for the <em>Vamtam</em> framework - video tutorials are valid for all Vamtam themes.<a href="http://zenden.vamtam.com/video-tutorials" target="_blank">Vamtam Videos</a>.
		<br />
		</p>
		
		
		<br />
		<hr>
		<h3 id="credits"><strong>I) CREDITS</strong> - <a href="#toc">back to TOC</a></h3>
		
		<p>
		<strong>Photos</strong>
		
		<br />
		Please note that the images on the demo site are not included in the dummy content of the site.
		These are stock images from Photodune.net
		</p>
		
		<p>
		<strong>Patterns</strong> 
		<br />
		<a href="http://subtlepatterns.com" target="_blank">http://subtlepatterns.com</a>
		</p>
		
		<p>
		<strong>Icons</strong>
		<br />
		<a href="http://www.iconsweets2.com/" target="_blank">http://www.iconsweets2.com/</a>
		</p>
		
		<strong>Others</strong>
		HTML5 Boilerplate - <a href="http://html5boilerplate.com/" target="_blank">http://html5boilerplate.com/</a><br />
		960 Grid System - <a href="http://960.gs/" target="_blank">http://960.gs/</a><br />
		jQuery mColorPicker - <a href="https://github.com/meta100/mColorPicker" target="_blank">https://github.com/meta100/mColorPicker</a><br />
		jQuery colorbox - <a href="http://colorpowered.com/colorbox/" target="_blank">http://colorpowered.com/colorbox/</a><br />
		jQuery corner - <a href="http://jquery.malsup.com/corner/" target="_blank">http://jquery.malsup.com/corner/</a><br />
		jQuery gmap - <a href="http://gmap.nurtext.de/" target="_blank">http://gmap.nurtext.de/</a><br />
		jplayer - <a href="http://jplayer.org" target="_blank">http://jplayer.org</a><br />
		jQuery swfobject - <a href="http://jquery.thewikies.com/swfobject/" target="_blank">http://jquery.thewikies.com/swfobject/</a><br />
		jQuery tweet - <a href="http://tweet.seaofclouds.com/" target="_blank">http://tweet.seaofclouds.com/</a><br />
		jQuery UI - <a href="http://jqueryui.com/" target="_blank">http://jqueryui.com/</a><br />
		VideoJS - <a href="http://videojs.com/" target="_blank">http://videojs.com/</a><br />
		</p>
		
		<hr>
		
		<p>
		Once again, thank you so much for purchasing this theme. As we said at the beginning, we'd be glad to help you if you have any questions relating to this theme. 
		</p> 
		
		<p class="append-bottom alt large"><strong>Vamtam</strong></p>
		<p><a href="#toc">Go To Table of Contents</a></p>
		
		<hr class="space">
	</div><!-- end div .container -->
