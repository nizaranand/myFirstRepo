<?php global $cssPath, $jsPath, $themePath, $theLayout; ?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><?php // Force latest IE rendering engine ?>
<title><?php
	if (is_home()) { bloginfo('name'); echo " - "; bloginfo('description'); }
	elseif (is_category() || is_tag()) { single_cat_title(); }
	elseif (is_single() || is_page()) { single_post_title(); }
	elseif (is_search()) { _e('Search Results', THEME_NAME); echo " ".wp_specialchars($s); }
	else { echo trim(wp_title(' ',false)); }
	if (!is_home()) { theme_var('options,append_to_title'); }
	?></title>

<?php // Favorites and mobile bookmark icons ?>
<link rel="shortcut icon" href="<?php theme_var('options,favorites_icon','http://para.llel.us/favicon.ico'); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php theme_var('options,apple_touch_icon','http://para.llel.us/apple-touch-icon.png'); ?>">

<?php // JS variables needed to trigger theme functionality ?>
<script type="text/javascript"> var fadeContent = '<?php theme_var('options,fade_in_content','none'); ?>'; </script>

<?php 
// WordPress headers.
// This includes all theme CSS files. Add or modify the list from "functions.php" 
wp_head();

// Feed link / Pingback link ?>
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php // jQuery fallback. Will load a local copy if WP Head fails to load. ?>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo $jsPath; ?>libs/jquery-1.6.2.min.js"%3E%3C/script%3E'))</script>

<!--[if lte IE 8]>
<?php 
// IE (6-8) only - PIE.htc styles for rounded corners, gradients, etc.
if (get_theme_var('options,advanced_ie_styles',false)) : ?>
<style type="text/css">
.wp-caption, .boxLink, .btn, .btn span, .messageBox, .insetBox, textarea, input, .textInput, #Bottom footer .main, #MainMenu .inner-1, #MainMenu .inner-2, .slideMenu a, .framedImage img, .styled-image, .the-post-image figure, .gallery-icon a, .styled-image img, .the-post-image figure img, .gallery-icon img, .the-post-container, .the-comment-container, .avatar, .pagination a {
	position: relative;
	behavior: url(<?php echo THEME_URL; ?>assets/css/PIE.htc);}
.invisibleMiddle #Middle, .invisibleAll #Top, .invisibleAll #Middle, .invisibleAll #Bottom { visibility: visible; }
</style>
<?php endif; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>ie.css" />
<![endif]-->

<style type="text/css">
<?php 
// Body font
if ($theLayout['body_font']) : 
	echo 'body, select, input, textarea {  font-family: '. $theLayout['body_font'] .'; } ';
endif;
	
// Heading font
if ($theLayout['heading_font']['standard']) : 
	echo 'h1, h2, h3, h4, h5, h6 {  font-family: '. $theLayout['heading_font']['standard'] .'; } ';
endif;

// Custom CSS entered in design settings
if ($customCSS = get_theme_var('design_setting,css_custom')) :
	echo prep_content($customCSS); 
endif;
?>
</style> <?php 

 
// Custom JavaScript entered in design settings
if ($customJS = get_theme_var('design_setting,js_custom')) : ?>
<script type="text/javascript">
	<?php echo prep_content($customJS); ?>
</script>
<?php endif; ?>