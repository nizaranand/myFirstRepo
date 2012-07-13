<?php global $cssPath, $jsPath, $themePath, $theLayout, $theHeader;

// Login popup window 
// - Call with link: <a href="#LoginPopup" class="inlinePopup">Login</a>  ?>

<div class="hidden">
	<div id="LoginPopup">
		<form class="loginForm" id="popupLoginForm" method="post" action="<?php echo wp_login_url(); // optional redirect: wp_login_url('/redirect/url/'); ?>">
			<div id="loginBg"><div id="loginBgGraphic"></div></div>
			<div class="loginContainer">
				<h3><?php _e( 'Sign in to your account', THEME_NAME ); ?></h3>
				<fieldset class="formContent">
					<legend><?php _e( 'Account Login', THEME_NAME ); ?></legend>
					<div class="fieldContainer">
						<label for="ModalUsername"><?php _e( 'Username', THEME_NAME ); ?></label>
						<input id="ModalUsername" name="log" type="text" class="textInput" />
					</div>
					<div class="fieldContainer">
						<label for="ModalPassword"><?php _e( 'Password', THEME_NAME ); ?></label>
						<input id="ModalPassword" name="pwd" type="password" class="textInput" />
					</div>
				</fieldset>
			</div>
			<div class="formContent">
				<button type="submit" class="btn signInButton"><span><?php _e( 'Sign in', THEME_NAME ); ?></span></button>
			</div>
			<div class="hr"></div>
			<div class="formContent">
				<a href="<?php bloginfo('wpurl') ?>/wp-login.php?action=lostpassword" id="popupLoginForgotPswd"><?php _e( 'Forgot your password?', THEME_NAME ); ?></a>
			</div>
		</form>
	</div>
</div>
<?php

// WordPress Footer Includes
wp_footer();

// Cufon fonts for headings
if ($theLayout['heading_font']['cufon']) : ?>
<script src="<?php echo $theLayout['heading_font']['cufon']; ?>"></script>
<script type="text/javascript">
	Cufon.replace('h1,h2,h3,h4,h5,h6');
	<?php 
	// skin specific cufon styling (footer headings)
	switch(get_theme_skin()) {
		case "style-skin-2.css" : 
		case "style-skin-5.css" : 
			echo "Cufon.replace('#Bottom h1,#Bottom h2,#Bottom h3,#Bottom h4,#Bottom h5,#Bottom h6', {textShadow: '1px 1px 0 rgba(255,255,255,.6)'});";
			break;
		default:
			echo "Cufon.replace('#Bottom h1,#Bottom h2,#Bottom h3,#Bottom h4,#Bottom h5,#Bottom h6', {textShadow: '1px 1px 0 rgba(0,0,0,.75)'});";
	}
	// skin specific cufon styling (call to action)
	switch(get_theme_skin()) {
		case "style-skin-2.css" : 
		case "style-skin-5.css" : 
			echo "Cufon.replace('.call-to-action h1, .call-to-action h2', {textShadow: '1px 1px 0 rgba(255,255,255,.75)'});";
			break;
		case "style-skin-3.css" : 
			echo "Cufon.replace('.call-to-action h1', {textShadow: '-1px -1px 0 rgba(0,0,0,.2)'});";
			echo "Cufon.replace('.call-to-action h2', {textShadow: '1px 1px 0 rgba(255,255,255,.2)'});";
			break;
		case "style-skin-6.css" : 
			echo "Cufon.replace('.call-to-action h1, .call-to-action h2', {textShadow: '-1px -1px 0 rgba(0,0,0,.3)'});";
			break;
		default:
			echo "Cufon.replace('.call-to-action h1, .call-to-action h2', {textShadow: '-1px -1px 0 rgba(0,0,0,.6)'});";
	}
	// skin specific cufon styling (impact button)
	switch(get_theme_skin()) {
		case "style-skin-4.css" : 
			echo "Cufon.replace('.impactBtn', {textShadow: '1px 1px 1px rgba(255,255,255,.5)'});";
			break;
		default:
			echo "Cufon.replace('.impactBtn', {textShadow: '-1px -1px 1px rgba(0,0,0,.3)'});";
	} ?>
	Cufon.now();
</script>
<?php endif; ?>

<?php // Main menu dropdowns  ?>
<script type="text/javascript"><?php 
	if ($theHeader['menu_left']) { echo 'ddsmoothmenu.init({ mainmenuid: "MM", orientation: "h", classname: "slideMenu", contentsource: "markup" });'; } 
	if ($theHeader['menu_right']) { echo 'ddsmoothmenu.init({ mainmenuid: "MM-Right", orientation: "h", classname: "slideMenu", contentsource: "markup" });'; }
?></script>
<script src="<?php echo $jsPath; ?>onLoad.js"></script><?php // Functions to call after page load ?>

<?php 
// Google analytics (asynchronous method from http://mathiasbynens.be/notes/async-analytics-snippet)
if (get_theme_var('options,google_analytics')) : ?>
	<script type="text/javascript">
	var _gaq = [['_setAccount', '<?php theme_var('options,google_analytics'); ?>'], ['_trackPageview']];
	(function(d, t) {
	var g = d.createElement(t),
		s = d.getElementsByTagName(t)[0];
	g.async = true;
	g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g, s);
	})(document, 'script');
	</script>
<?php endif; ?>