<!doctype html>  
<?php global $theLayout; //require_once( FRAMEWORK_DIR . 'utilities/ti/ti.php'); ?>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<?php get_header('default'); ?>
</head>

<body <?php body_class(); ?>>

<div id="Wrapper">
	<div id="Top">
		<div class="clearfix">
		
			<?php get_template_part( 'design', 'header' ); //emptyblock('top') ?>
			
		</div> <!--! end of .pageWrapper -->
	</div> <!--! end of #Top -->
	
	<div id="Middle">
		<div class="pageWrapper theContent clearfix">
			
			<?php generate_content_layout($theLayout); //emptyblock('middle') ?>
			
		</div> <!--! end of .pageWrapper -->
	</div> <!--! end of #Middle -->
	
	<div id="Bottom">		

		<?php get_template_part( 'design', 'footer' ); //emptyblock('bottom') ?>
		
	</div> <!--! end of #Bottom -->
</div> <!--! end of #Wrapper -->

<?php get_footer('default'); ?>
  
</body>
</html>