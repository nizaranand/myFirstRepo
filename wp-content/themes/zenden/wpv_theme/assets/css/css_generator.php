<?php 
	// this file generates the admin options css cache
	
	ob_start();

	global $wpv_fonts;
?>

html {
	color: <?php wpvge('primary-font-color') ?>;
	<?php wpv_background('body-background') ?>
}

/* Primary font color */
.slider-helper-dark thead th,
.body-helper-dark thead th,
.footer-helper-dark thead th,
.slider-helper-dark tfoot,
.body-helper-dark tfoot,
.footer-helper-dark tfoot {
	color: <?php wpvge('primary-font-color') ?>;
}

/* primary font */
*,
p,
.main-container,
.contact_form input[type="text"], 
.contact_form input[type="email"], 
.contact_form textarea {
	<?php wpv_font('primary-font') ?>
}

*,
p,
.main-container,
.accordion.mini .tab,
.icomment-box,
.info-pad .category,
.info-pad .info .description,
.info-pad .info .description *,
footer.main-footer,
footer.main-footer *,
.wpv-caption .helper-caption-2, 
.wpv-caption .helper-caption-2 * {
	 font-family: <?php wpv_font_family('primary-font');?>, sans-serif;
}

/* secondary font */
.form-label, label,
input[type=button], 
input[type=submit],
label,
.button,
.thumbnail-pad span,
.slogan,
.thumbnail .name,
.accordion .tab,
.tabs .ui-tabs-nav li a,
thead th,
tfoot,
.dropcap1,
.dropcap2,
.form-label,
.info-pad .title,
.info-snippet,
.info-snippet a,
.slogan,
.slogan a,
.unapproved,
.author,
#side-description {
	font-family: <?php wpv_font_family('secondary-font');?>, serif;
}

/* em font */
cite,
cite *
.cite,
.cite *,
.sort_by_cat span:first-child,
.bquote,
.slogan .description,
.info-snippet .description,
.page-header .description,
blockquote,
blockquote p,
.page-content .description,
.page-content .description p,
em {
	<?php wpv_font('em') ?>
	color: <?php wpvge('em-color') ?>;
}

.stage-wrapper {
	height: <?php wpvge('stage-height')?>px;
}

#stage {
	line-height: <?php echo ((int)wpv_get_option('stage-height') - 45)?>px;
}

.boxed-layout {
	<?php wpv_background('content-background', true) ?>
}

.has-header-slider .stage-left,
.has-header-slider .stage-right,
.has-header-slider .stage-bottom,
.boxed.has-header-slider .main-menu,
.no-header-slider .stage-wrapper,
footer.main-footer > .outset,
.page-header-t2,
#main > .pane {
	background-color: <?php wpvge('main-background-color')?>;
	background-color: <?php echo wpv_hex2rgba('main-background-color', 'main-background-opacity')?>;
}
#main-slider-loading-mask {
	background-color: <?php wpvge('main-background-color')?> !important;
	box-shadow: 0 0 1px 1px <?php wpvge('main-background-color')?>;
}

.main-pane {
	background-image: url('<?php wpvge('main-background-image') ?>') !important;
	background-repeat: <?php wpvge('main-background-repeat')?> !important;
	background-position: <?php wpvge('main-background-position')?> !important;
}

/* Peek boxed layout halfwidth slider is with !important declaration */
.header-slider-wrapper.style-peek.halfwidth {
	<?php wpv_background('main-background', true) ?>
}

<?php if((wpv_get_option('main-background-color') == '') || (wpv_get_option('main-background-color') == 'transparent')):?> 
.header-slider-wrapper.style-peek.halfwidth {
	<?php wpv_background('content-background', true) ?>
}
<?php endif; ?> 

.header-slider-wrapper.style-peek {
	background: none !important;
}

<?php
	$slider_bgcolor = wpv_get_option('slider-background-color');
	$slider_bgimage =  wpv_get_option('slider-background-image');
?>

.header-slider-wrapper,
.slider-helper {
	<?php if( ( !empty($slider_bgcolor) && $slider_bgcolor != 'transparent') || !empty($slider_bgimage)): ?>
		<?php wpv_background('slider-background') ?>
	<?php endif ?>
}

<?php if($slider_bgcolor != 'transparent'): ?>
	.header-slider-wrapper .wpv-loading-mask {
		background-color: <?php echo $slider_bgcolor?>;
	}
<?php endif ?>

<?php 
	$column_whitespace = 30;
	$contentwidth = 940;
?>

aside.left {
	margin-right: <?php echo $column_whitespace?>px;
	width: <?php echo (int)wpv_get_option('left_sidebar_width')-$column_whitespace ?>px;
}

aside.right {
	margin-left: <?php echo $column_whitespace?>px;
	width: <?php echo (int)wpv_get_option('right_sidebar_width')-$column_whitespace ?>px;
}

.portfolios > ul > li {
	margin: 20px <?php echo $column_whitespace?>px 20px 0;
}

<?php
$menuHeight = 36;
$headerHeight = (int)wpv_get_option('header-height');
?>
header.main-header {
	height: <?php echo $headerHeight ?>px !important;
	<?php wpv_background('header-background') ?>
}


.ie8 header.main-header {
	<?php wpv_background_ie8('header-background') ?>
}

.icons-top,
#style-switcher {
	top: <?php echo $headerHeight?>px !important;
}

body.admin-bar .icons-top,
body.admin-bar #style-switcher {
	top: <?php echo $headerHeight+27?>px !important;
}

header.main-header .logo {
	height: <?php echo $headerHeight - $menuHeight - 1 ?>px !important;
	line-height: <?php echo $headerHeight - $menuHeight - 1 ?>px !important;
	top: <?php echo $menuHeight ?>px !important;
}

<?php if(! ((wpv_get_option('footer-background-color') == '') || (wpv_get_option('footer-background-color') == 'transparent'))):?>
footer.main-footer {
	margin-top: 10px;
}
<?php endif; ?>

.menu-top.fixed-header { padding-top: <?php echo (int)wpv_get_option('header-height')+34?>px; }
.no-menu-top.fixed-header { padding-top: <?php echo (int)wpv_get_option('header-height')?>px; }

.visiblegrid .wpv-fx-grid-mask .wpv-fx-grid-facet {
	border-color: <?php wpvge('header-slider-gridcolor') ?> !important;
}

<?php 
	$image_sizes = array('small', 'medium', 'large');
	
	foreach($image_sizes as $size):
?>
.image_size_<?php echo $size?> {
	width: <?php wpvge("image_{$size}_width")?>px;
	height: <?php wpvge("image_{$size}_height")?>px;
}
<?php endforeach ?>

<?php
	$page_content_widths = array(
		'full'       => $contentwidth,
		'left-only'  => $contentwidth - (int)wpv_get_option('left_sidebar_width'),
		'right-only' => $contentwidth - (int)wpv_get_option('right_sidebar_width'),
		'left-right' => $contentwidth - (int)wpv_get_option('left_sidebar_width') - (int)wpv_get_option('right_sidebar_width'),
	);
	
	include 'grid.php';
?>

.post-thumb {
	width: <?php echo (int)wpv_get_option('post-thumbnail-width') ?>px
}

.logo {
	<?php wpv_font('logo') ?>
	color: <?php wpvge('logo-color') ?> !important;
}

<?php 
for($i=1; $i<=6; $i++):
	$h = "h$i";
?>
	<?php echo "$h, $h a, $h a:visited"?> {
		<?php wpv_font($h) ?>
		color: <?php wpvge("$h-color")?>;
	}
<?php endfor; ?>

<?php
	$links = array(
		'' => '',
		'#header-sidebars ' => 'header_',
		'#footer-sidebars ' => 'footer_',
	);
?>

<?php 
$underlineColor = 'transparent';
foreach($links as $selector=>$substr): 
	$underlineColor = !!wpv_get_option('css_link_underline') ? wpv_get_option('css_'.$substr.'link_color') : 'transparent';
?>
	
<?php echo $selector ?> a,
/*<?php echo $selector ?> .more-btn span,
<?php echo $selector ?> .next-btn span,
<?php echo $selector ?> .prev-btn span,*/
<?php echo $selector ?> .comments-link a b {
	color: <?php wpvge('css_'.$substr.'link_color')?>;
	border-bottom-color: <?php echo $underlineColor?>;
}

<?php echo $selector ?> a:visited {
	color: <?php wpvge('css_'.$substr.'link_visited_color')?>;
	border-bottom-color: <?php echo $underlineColor?>;
}

<?php echo $selector ?> a:hover,
<?php echo $selector ?> .more-btn:hover span,
<?php echo $selector ?> .next-btn:hover span,
<?php echo $selector ?> .prev-btn:hover span,  
/*<?php echo $selector ?> .toggle_title:hover b,
<?php echo $selector ?> .toggle_active b,
<?php echo $selector ?> .accordion.mini .tab:hover,
<?php echo $selector ?> .accordion .tab:hover,*/
<?php echo $selector ?> .comments-link a:hover b, 
<?php echo $selector ?> .sortable a.active,
<?php echo $selector ?> .vamtam_full a:hover img,
<?php echo $selector ?> .comments-link a:hover b {
	color: <?php wpvge('css_'.$substr.'link_hover_color')?> !important;
	border-bottom-color: <?php echo $underlineColor?> !important;
} 

<?php endforeach ?>



/* ------------------------------------------------------
	Top Navigation
------------------------------------------------------ */
.top-nav-box a {
	color: <?php wpvge('css_tophead_link_color')?> !important;
	border-bottom-color: <?php wpvge('css_'.$substr.'link_border_color')?>;
}

.top-nav-box a:hover {
	color: <?php wpvge('css_tophead_link_hover_color')?> !important;
	border-bottom-color: <?php wpvge('css_'.$substr.'link_hover_border_color')?> !important;
}

.top-nav-box .current_page_item > a,
.top-nav-box .current-menu-item > a {
	color: <?php wpvge('css_tophead_current_link_color')?> !important;
}

.top-nav ul > li.current_page_item > a,
.top-nav ul > li.current_page_item > ul > li > a:hover,
.top-nav ul > li.current-menu-parent > a,
.top-nav ul > li.current-menu-ancestor > a {
	color: <?php wpvge('css_header_link_hover_color')?>;
	background-color: transparent !important;
}

/* ------------------------------------------------------
	Main Navigation
------------------------------------------------------ */
nav {
	color: <?php wpvge('menu-font-color')?>;
} 

nav ul li a
/*, nav ul li a strong*/ {
	<?php wpv_font('menu-font')?>
	color: <?php wpvge('menu-font-color')?>;
}

nav ul > li > a:visited {
	color: <?php wpvge('menu-font-color')?>;
}
 
nav ul > li:hover > a,
nav ul > li > a:hover,
nav > ul > li.current_page_item > a,
nav > ul > li.current-menu-parent > a,
nav > ul > li.current-menu-ancestor > a,
nav > ul > li.current_page_item strong,
nav > ul > li.current_page_item > a,
nav > ul > li.current_page_item > ul > li > a:hover,
nav > ul > li.current-menu-parent strong,
nav > ul > li.current-menu-parent > a,
nav > ul > li.current-menu-ancestor strong,
nav > ul > li.current-menu-ancestor > a {
	color: <?php wpvge('css_menu_hover_color') ?> !important;
	background-color: <?php wpvge('css_submenu_hover_background') ?>;
} 

nav .sub-menu li > a,
nav .sub-menu li > a:visited,
nav ul li ul li > a,
nav ul li ul li > a:visited {
	color: <?php wpvge('css_submenu_color') ?>;
	background-color: <?php wpvge('css_submenu_background') ?>;
}

nav ul .sub-menu li:hover > a,
nav ul .sub-menu .current_page_item > a,
nav ul li ul li:hover > a,
nav ul li ul.current_page_item > a {
	color: <?php wpvge('css_submenu_hover_color') ?> !important; 
	background-color: <?php wpvge('css_submenu_hover_background') ?> !important;
}

nav ul.sub-menu li.current_page_item a,
nav ul.sub-menu li.current_page_item a:hover {
	background-color: <?php wpvge('css_submenu_hover_background')?> !important;
}


.top-nav ul > li,
.top-nav ul > li a,
.top-nav ul > li a:hover,
.top-nav ul > li:hover a {
	background-color: transparent !important;
}

/* ------------------------------------------------------
	Footer
------------------------------------------------------ */
footer.main-footer h4 {
	color: <?php wpvge('footer-sidebars-titles-color')?>;
	<?php wpv_font('footer-sidebars-titles', true) ?>
}



/* ------------------------------------------------------
	Buttons, Forms and Shortcodes
------------------------------------------------------ */
.button {
	color: <?php wpvge('css_button_color')?>;
	border-radius: <?php wpvge('css_button_radius')?>px;
}

.button:hover {
	color: <?php wpvge('css_button_hover_color')?> !important;
}

input[type=button],
input[type=submit],
.button:before,
input[type=button]:before,
input[type=submit]:before {
	border-radius: <?php wpvge('css_button_radius')?>px;
}

input[type=text],
input[type=email],
input[type=password],
textarea {
	background: <?php wpvge('css_input_text_background')?>;
	color: <?php wpvge('css_input_text_color')?>;
}

input[type=text]:focus,
input[type=email]:focus,
input[type=password]:focus,
textarea:focus {
	background: <?php wpvge('css_input_text_focus_background')?>;
	color: <?php wpvge('css_input_text_focus_color')?>;
}

<?php
	$tab_border        = wpv_get_option('css_tab_border_color');
	$active_tab_top    = wpv_get_option('css_tab_active_background_top');
	$active_tab_bottom = wpv_get_option('css_tab_active_background_bottom');
?>

.tabs .ui-tabs-nav li {
	border-color: <?php echo $tab_border?>;
	background-color: <?php wpvge('css_tab_background')?>; 
}

.tabs .pane {
	border: 1px solid <?php echo $tab_border?>;
	background-color: <?php echo $active_tab_bottom?>; 
}

.tabs .ui-tabs-nav .ui-state-active,
.tabs .ui-tabs-nav .ui-state-selected {
	border-bottom: 0 !important;
}

.tabs.vertical .ui-tabs-nav .ui-state-active,
.tabs.vertical .ui-tabs-nav .ui-state-selected {
	border-bottom: 1px solid <?php echo $tab_border?>;
}

.tabs .ui-tabs-nav li a,
.tabs.vertical .ui-tabs-nav li a {
	color: <?php wpvge('css_tab_color')?>;
}

.tabs .ui-tabs-nav .ui-state-active a,
.tabs .ui-tabs-nav .ui-state-selected a {
	color: <?php wpvge('css_tab_active_color')?>;
	background-color: <?php echo $active_tab_bottom?>;
	background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo $active_tab_top?>), to(<?php echo $active_tab_bottom?>));
	background-image: -webkit-linear-gradient(top, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:    -moz-linear-gradient(top, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:     -ms-linear-gradient(top, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:      -o-linear-gradient(top, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:         linear-gradient(top, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	<?php /*
	filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo wpv_grad_filter($active_tab_top)?>', EndColorStr='<?php echo wpv_grad_filter($active_tab_bottom)?>');
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo wpv_grad_filter($active_tab_top)?>', EndColorStr='<?php echo wpv_grad_filter($active_tab_bottom)?>')";*/
	?>
}

.tabs.vertical .ui-tabs-nav .ui-state-active a,
.tabs.vertical .ui-tabs-nav .ui-state-selected a {
	color: <?php wpvge('css_tab_active_color')?>;
	background-color: <?php echo $active_tab_bottom?>;
	background-image: -webkit-gradient(linear, left top, right top, from(<?php echo $active_tab_top?>), to(<?php echo $active_tab_bottom?>));
	background-image: -webkit-linear-gradient(left, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:    -moz-linear-gradient(left, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:     -ms-linear-gradient(left, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:      -o-linear-gradient(left, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
	background-image:         linear-gradient(left, <?php echo $active_tab_top?>, <?php echo $active_tab_bottom?>);
}

/* accordion */

<?php
	/*
	$acc_border = wpv_get_option('css_accordion_border_color');
	$acc_pane = wpv_get_option('css_accordion_pane_opacity');
	$acc_top = wpv_get_option('css_accordion_background_top');
	$acc_bottom = wpv_get_option('css_accordion_background_bottom');
	$acc_color = wpv_get_option('css_accordion_color');
	*/
	$acc_border = '#ccc';
	$acc_pane = 1;
	$acc_top = wpv_get_option('css_accordion_background_top');
	$acc_bottom = wpv_get_option('css_accordion_background_bottom');
	$acc_color = wpv_get_option('css_accordion_color');
?>

.accordion .tab {
}

.accordion .tab .inner {
	border: 1px solid <?php echo $acc_border?>;
}

.accordion .pane {
	background: rgba(255,255,255,<?php echo $acc_pane?>);
	border: 1px solid <?php echo $acc_border?>;
}

.ie8 .accordion .pane {
	background: #FFF;
}
 
.toggle_title b:hover,
.toggle_active b {
	border-bottom: 1px solid <?php echo $acc_border ?>;
} 

.toggle_title,
.toggle_title * {
	color: <?php wpvge('css_toggle_title_color')?> !important;
	background-color: <?php wpvge('css_toggle_title_background')?> !important;
}
.toggle_content {
	color: <?php wpvge('css_toggle_content_color')?> !important;
	background: <?php wpvge('css_toggle_content_background')?> !important;
}
.toggle_title:hover b {
	color: <?php wpvge('primary-font-color')?> !important;
}




/* ------------------------------------------------------
	Header Sliders
------------------------------------------------------ */
<?php
	$slider_height = (int)wpv_get_option('header-slider-height');
?>

#header-slider {
	height: <?php echo $slider_height?>px;
}

/*
.bgr-slider .style-caption-center .wpv-view {
	width: <?php echo (int)wpv_get_option('content-width')+140?>px !important;
}
*/ 

.style-side-caption #header-slider-caption-wrapper {
	height: <?php echo $slider_height ?>px;
}

.style-side-caption .wpv-caption {
	height: <?php echo $slider_height-40 ?>px;
}

.style-side-caption .wpv-caption .main-caption,
.style-side-caption .wpv-caption .main-caption a {
	color: <?php wpvge('accent-color')?> !important;
}

.accent-1 {
	color: <?php wpvge('accent-color')?> !important;
}

.accent-2 {
	color: <?php wpvge('accent-color-2')?> !important;
}

.accent-3 {
	color: <?php wpvge('accent-color-3')?> !important;
}

.highlight.accent,
.circle {
	background: <?php wpvge('accent-color')?>;
}

/*.entry-date {
	background: <?php wpvge('accent-color')?>;
}*/

#main h4:after {
	background-color: <?php wpvge('accent-color-2')?>;
}

.main-menu nav > div > ul > li.current_page_item,
.main-menu nav > div > ul > li.current-menu-parent {
	border-top-color: <?php wpvge('accent-color-2')?>;
}

.main-menu nav > div > ul > li:hover {
	border-top-color: <?php wpvge('accent-color-3')?>;
}

/* accent color */
/*.accordion .tab.ui-state-active,
.accordion .tab.ui-state-hover,*/
.price .value,
.info-pad .category,
.icomment-box,
.pagination ul li.current {
	color: <?php wpvge('accent-color')?>;
}

.tweet_user,
.tweet_user *,
.tweet_user:before {
	color: <?php wpvge('accent-color')?> !important;
}

::selection {
	background: <?php wpvge('accent-color')?>;
} 

.page-header .description {
	color: <?php wpvge("h1-color")?>;
	opacity: .8;
}

.info-snippet,
.slogan {
	color: <?php wpvge("h6-color")?>;
}

.thumbnail .name,
.info-snippet a,
.slogan a,
.slogan,
thead th,
tfoot,
.value-box .value i,
.form-label,
label,
.style-navigation-preview .wpv-caption .main-caption,
.style-navigation-preview .wpv-caption .main-caption a {
	color: <?php wpvge("h3-color")?>;
}

.dropcap1 {
	color: <?php wpvge("h2-color")?>;
}

.dropcap2 {
	background: <?php wpvge("h2-color")?>;
	color: #f9f9f9 !important;
}

.entry-date,
.entry-utility {
	color: <?php wpvge("h6-color")?>;
}

.entry-date,
.entry-utility a,
.author b,
.comment-meta,
.comment-meta *,
.comment-edit-link,
.comment-notes,
.comments-link a b,
.loop-wrapper.news header h2,
.loop-wrapper.news header h2 a {
	color: <?php wpvge("h5-color")?>;
	<?php wpv_font('primary-font') ?>
} 

.style-navigation-preview .wpv-caption .helper-caption-1,
.style-navigation-preview .wpv-caption .helper-caption-1 *,
.style-navigation-preview .wpv-nav-prev,
.style-navigation-preview .wpv-nav-next,
.style-caption-center .wpv-caption .main-caption,
.style-caption-center .wpv-caption .main-caption *,
.style-side-caption .wpv-caption .main-caption,
.style-side-caption .wpv-caption .main-caption * {
	font-family: <?php wpv_font_family('h1')?> !important; 
} 

.style-face .wpv-caption,
.style-face .wpv-caption *,
.slider-shortcode-wrapper.style-gallery .wpv-caption .main-caption,
.slider-shortcode-wrapper.style-gallery .wpv-caption .main-caption a {
	font-family: <?php wpv_font_family('h1')?> !important; 
}


#main h4:after {
	width: <?php wpvge('h4-size')?>px;
	height: <?php wpvge('h4-size')?>px;
	line-height: <?php wpvge('h4-lheight')?>px !important;
}

/* menu widget */

#main .widget.wpv_subpages    ul li a, 
#main .widget.widget_nav_menu ul li a, 
#main .widget.widget_pages    ul li a {
	background-color: <?php wpvge('menu-widget-background-color') ?>;
	color: <?php wpvge('menu-widget-color') ?>;
}

#main .widget.wpv_subpages    ul li a:hover, 
#main .widget.widget_nav_menu ul li a:hover, 
#main .widget.widget_pages    ul li a:hover,
#main .widget.wpv_subpages    ul li.current_page_item > a, 
#main .widget.widget_nav_menu ul li.current_page_item > a, 
#main .widget.widget_pages    ul li.current_page_item > a {
	background-color: <?php wpvge('menu-widget-active-background-color') ?>;
	color: <?php wpvge('accent-color')?> !important;
}

/* Accents */

.style-caption-center .wpv-caption .helper-caption-1,
.style-caption-center .wpv-caption .helper-caption-1 * {
	color: <?php wpvge('h1-color')?>;
}

#main .widget.widget_nav_menu ul li.current_page_item:before {
	background-color: <?php wpvge('accent-color')?> !important;
}

.post-edit-link {
	background: <?php wpvge('accent-color')?>;
}


.ie7 .bypostauthor:before,
.ie8 .bypostauthor:before,
.ie9 .bypostauthor:before {
	background-color: <?php wpvge('accent-color')?>;
}

/*.top-nav ul li a:hover {
	border-bottom-color: <?php wpvge('accent-color')?>;
}*/

.thumbnail:hover .graphic-label,
li:hover > .thumbnail > .graphic-label {
	background: <?php wpvge('accent-color')?>;
}

.main-menu,
nav .sub-menu {
/*	background-color: <?php wpvge('accent-color')?>;*/
}

/*.ie8 .sub-menu {
	border-bottom: 2px solid <?php wpvge('accent-color')?>;
} */


.ie8 .page-header:after { 
	background-color: transparent;
}

.ie8 .page-header { }

.widget_post_formats .post-format-pad {
	background-image: none !important;
	/*background: <?php echo wpv_hex2rgba('accent-color', 'css_postformat_opacity_n')?> !important;*/
}

.post-format-pad:hover,
.widget_post_formats .post-format-pad:hover,
.post-article:hover .post-format-pad { 
	background: <?php echo wpv_hex2rgba('accent-color', 'css_postformat_opacity_h')?> !important;
	box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2) inset !important;
}

.ie8 .widget_post_formats .post-format-pad {
	background-image: none;
	zoom: 1;
}

.ie8 .post-format-pad:hover,
.ie8 .widget_post_formats .post-format-pad:hover {
	background: transparent;
	zoom: 1;
}

.form-input .required:before {
	border-bottom-color: <?php wpvge('accent-color')?>;
}

.graphic-label {
	background-color: <?php wpvge('accent-color')?>;
}

.services:hover,
.services:hover *,
.team-member:hover,
.team-member:hover * {
	color: <?php wpvge('primary-font-color') ?> !important;
} 

.entry-utility .author a,
.post-cats a,
.the-tags a,
.comments-link a b {
	color: <?php wpvge('accent-color') ?> !important;
}

/*
#phone-num {
	background-color: <?php echo wpv_hex2rgba('accent-color', 'css_postformat_opacity_n')?>;
}

.ie8 #phone-num {
	background: transparent;
	
	zoom: 1;
}
*/

/* --------------------------------------------------------------------------
   Generated Inset/Outset boreder colors or shades and tints for IE.
   -------------------------------------------------------------------------- */
.ie8 .stage-wrapper,
.ie8 .outset,
.ie8 .main-footer > .outset:after,
.ie8 .has-header-slider .pane-wrapper,
.ie8 #main > .pane:after,
.ie9 #main > .pane:after,
.ie8 .no-header-slider .stage-wrapper:after {
	<?php echo wpv_outsetBorderColor(wpv_get_option('main-background-color'), 0.5);?>
}
.ie8 .no-header-slider .pane-main:after {
	display: none !important;
}
.ie8 .outset > .outset,
.ie8 .main-menu,
.ie8 .stage-right,
.ie8 .stage-left,
.ie8 .main-footer > .outset,
.ie8 #main > .pane,
.ie8 .page-header-t2 h1 {
	border-style: solid !important;
	<?php echo wpv_outsetBorderColor(wpv_get_option('main-background-color'));?>
}
.ie8 #stage {
	<?php echo wpv_insetBorderColor(wpv_get_option('main-background-color'), 0.6);?>
}

.ie8 nav ul li:first-child a,
.ie8 .search-extend,
.ie8 #phone-num {
	border-left-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.3);?> !important;
}
.ie8 nav ul li a,
.ie8 .search-extend {
	border-right-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.3);?> !important;
}

.side-post-info,
.widget_post_formats .post-format-pad {
	background-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.2);?>;
	background-color: rgba(0, 0, 0, 0.2) !important;
}

/* Buttons with generated colors -------------------------------------------- */
<?php 
$generic_buttons = array(
	'.sort_by_cat .cat a',
	'.lm-btn',
	'.services.no-image .button',
	'.more-btn'
);
echo implode(', ', $generic_buttons)?> {
	border-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.3);?> !important;
	background-color: <?php echo wpv_lightenColor(wpv_get_option('main-background-color'), 0.6);?>;
	color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.7)?>;
}
<?php echo implode(':hover, ', $generic_buttons)?>:hover,
<?php echo implode(':focus, ', $generic_buttons)?>:focus {
	border-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.5);?> !important;
	background-color: <?php echo wpv_lightenColor(wpv_get_option('main-background-color'), 0.7);?>;
	color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.8)?>;
}
<?php echo implode(':active, ', $generic_buttons)?>:active, .sort_by_cat .cat a.active {
	border-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.7);?> !important;
	background-color: <?php echo wpv_lightenColor(wpv_get_option('main-background-color'), 0.5);?> !important;
	background-color: <?php echo wpv_lightenColor(wpv_get_option('main-background-color'), 0.6, 0.6);?> !important;
	color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.9)?> !important;
}

.prev-next-posts-links a {
	background-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.1);?> !important;
	background-color: <?php echo wpv_darkenColor(wpv_get_option('main-background-color'), 0.2, 0.5);?> !important;
}
.prev-next-posts-links a:hover {
	background-color: <?php echo wpv_lightenColor(wpv_get_option('main-background-color'), 0.7);?> !important;
	background-color: <?php echo wpv_lightenColor(wpv_get_option('main-background-color'), 0.8, 0.7);?> !important;
}
<?php
$footerBg  = wpv_get_option('footer-background-color');
if (empty($footerBg)) {
	$footerBg  = wpv_get_option('main-background-color');
}
?>

footer.main-footer > .outset {
	<?php wpv_background('footer-background') ?>
}

#footer-sidebars,
#footer-sidebars p,
#footer-sidebars * {
	<?php wpv_font('footer-sidebars-font') ?>
	color: <?php wpvge('footer-sidebars-font-color') ?>;
}

.copyrights {
	<?php wpv_background('subfooter-background') ?>
}

.copyrights,
.copyrights * {
	<?php wpv_font('sub-footer') ?>
	color: <?php wpvge('sub-footer-color') ?>;
}

.copyrights > .container_16 {
	width: <?php echo (wpv_get_option('subfooter-background-color') != '' || wpv_get_option('subfooter-background-image') != '') ? 940 : 980; ?>px;

}
.no-borderimage .main-footer > .outset:after {
	<?php echo wpv_outsetBorderColor($footerBg, 0.5);?>
}
.no-borderimage .main-footer > .outset {
	<?php echo wpv_outsetBorderColor($footerBg);?>
}

<?php
$c = wpv_get_option('main-background-color');
$cA = $c;
if(wpv_is_hex($c)) {
	list($r, $g, $b) = wpv_hex2rgb($c);
	$cA = 'rgba(' . 
		round($r * 255) . ', ' . 
		round($g * 255) . ', ' . 
		round($b * 255) . ', ' . 
		max(wpv_get_option('main-background-opacity') * 0.4, 0.3) . 
	')';
}

?>

.top-nav-box {
	/*background-color: <?php echo $c?> !important;*/
	background-color: <?php echo $cA?> !important;
    /*border: 1px solid <?php echo $c?>;*/
	border: 1px solid <?php echo $cA?>;
}
.services. .button,
.services. .more-btn {
	border-radius: <?php wpvge('css_button_radius')?>px;
}
.services-1 {
	background-color: <?php wpvge('accent-color')?> !important;
	color: <?php wpvge('accent-color')?> !important;
}
.services-2 {
	background-color: <?php wpvge('accent-color-2')?> !important;
	color: <?php wpvge('accent-color-2')?> !important;
}
.services-3 {
	background-color: <?php wpvge('accent-color-3')?> !important;
	color: <?php wpvge('accent-color-3')?> !important;
}

.services-1 div div span:last-child,
.services-2 div div span:last-child,
.services-3 div div span:last-child {
	background-color: <?php wpvge('main-background-color')?> !important;
}

a, * a {
	text-decoration: <?php echo !!wpv_get_option('css_link_underline') ? 'inherit' : 'none'?> !important;
}

<?php
$button_radius = (int)wpv_get_option('css_button_radius');
if ($button_radius > 10) { ?>
.button,
.services .button,
.services .more-btn,
input[type=button],
input[type=submit],
.button:hover,
.services .button:hover,
.services .more-btn:hover,
input[type=button]:hover,
input[type=submit]:hover,
.button:before,
input[type=button]:before,
input[type=submit]:before {
	background-image: none !important;
}
<?php } ?>

/*--------------------------------------------------------------------------
	Internet Explorer
	Fixes requiring full path from html file to the used resources
--------------------------------------------------------------------------*/
.ie7 .light .style-caption-center #header-slider-caption-wrapper .wpv-caption,
.ie8 .light .style-caption-center #header-slider-caption-wrapper .wpv-caption,
.ie7 .dark .style-caption-center #header-slider-caption-wrapper .wpv-caption,
.ie8 .dark .style-caption-center #header-slider-caption-wrapper .wpv-caption  {
	background: transparent !important;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='crop',src='<?php echo WPV_THEME_URI; ?>images/slider/caption-center/caption_bgr.png') !important;
}

.cboxIE #cboxTopLeft{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderTopLeft.png, sizingMethod='scale');}
.cboxIE #cboxTopCenter{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderTopCenter.png, sizingMethod='scale');}
.cboxIE #cboxTopRight{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderTopRight.png, sizingMethod='scale');}
.cboxIE #cboxBottomLeft{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderBottomLeft.png, sizingMethod='scale');}
.cboxIE #cboxBottomCenter{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderBottomCenter.png, sizingMethod='scale');}
.cboxIE #cboxBottomRight{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderBottomRight.png, sizingMethod='scale');}
.cboxIE #cboxMiddleLeft{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderMiddleLeft.png, sizingMethod='scale');}
.cboxIE #cboxMiddleRight{background:transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?php echo WPV_THEME_CSS; ?>colorbox/images/internet_explorer/borderMiddleRight.png, sizingMethod='scale');}

<?php  	
	global $used_google_fonts, $used_local_fonts, $mocked;

	$font_imports = '';
	$font_imports_urls = array();
	
	if(is_array($used_google_fonts) && count($used_google_fonts)) {
		$used_google_fonts = array_unique($used_google_fonts);
		$font_imports .= "@import url('http://fonts.googleapis.com/css?family=".implode('|', $used_google_fonts)."&subset=cyrillic,greek,latin');\n";
		$font_imports_urls['gfonts'] = "http://fonts.googleapis.com/css?family=".implode('|', $used_google_fonts)."&subset=cyrillic,greek,latin";
	}
	
	if(is_array($used_local_fonts) && count($used_local_fonts)) {
		foreach($used_local_fonts as $font) {
			$font_imports .= "@import url('".WPV_FONTS_URI."$font/stylesheet.css');\n";
			$font_imports_urls[$font] = WPV_FONTS_URI."$font/stylesheet.css";
		}
	}

	if(!isset($mocked)) {
		wpv_update_option('external-fonts', $font_imports_urls);

		wpvge('custom_css');
		
		return ob_get_clean();
	} else {
		return array(
			'styles' => ob_get_clean(),
			'imports' => $font_imports,
		);
	}

	// hex_removal() removes hash char (#) from color hex codes; needed for IE filters
	function hex_removal($str) {
		$new_str=str_replace('#','',$str);
		echo $new_str;
	}