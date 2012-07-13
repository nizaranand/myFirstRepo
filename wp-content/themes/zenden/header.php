<?php
/**
* @package WordPress
* @subpackage zenden
*/
?><!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-ie no-js"> <!--<![endif]-->
	
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged, $post;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'wpv' ), max( $paged, $page ) );
	
	?></title> 
		
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php wpvge('favicon_url')?>"/>
	
	<script>
		WPV_THEME_URI = '<?php echo WPV_THEME_URI ?>';  
	</script>
	
	<?php wp_head(); ?>
	<?php
		if(is_object($post) && get_post_meta($post->ID, 'use-global-options', true) === 'false') {
			$bgcolor = get_post_meta($post->ID, 'background-color', true);
			$bgimage = get_post_meta($post->ID, 'background-image', true);
			$bgrepeat = get_post_meta($post->ID, 'background-repeat', true);
			$bgattachment = get_post_meta($post->ID, 'background-attachment', true);
			$bgposition = get_post_meta($post->ID, 'background-position', true);
			
			$page_style = '';
			if(!empty($bgcolor)) {
				$page_style .= "background-color:$bgcolor;";
			}
			if(!empty($bgimage)) {
				$page_style .= "background-image:url('$bgimage');";
			}
			if(!empty($bgrepeat)) {
				$page_style .= "background-repeat:$bgrepeat;";
			}
			if(!empty($bgattachment)) {
				$page_style .= "background-attachment:$bgattachment;";
			}
			if(!empty($bgposition)) {
				$page_style .= "background-position:$bgposition;";
			}
			
			if(!empty($page_style) && (is_single() || is_page())) {
				echo "<style>body{ $page_style }</style>";
			} 
		}
	?>
</head>
	<?php
		global $post, $wpv_has_header_sidebars;
	
		$has_header_slider = !is_404() && wpv_post_default('show_header_slider', 'has-header-slider');
		$wpv_has_header_sidebars = wpv_post_default('show_header_sidebars', 'has-header-sidebars');
		$has_page_header = is_singular(array('post', 'portfolio')) || (is_page() && wpv_post_default('show_page_header', 'has-page-header') || is_category() || is_archive() || is_search() || is_home());
			
		$body_class = array();
		
		$body_class_conditions = array(
			'no-page-header' => !$has_page_header,
			'has-page-header' => $has_page_header, 
			'cbox-share-twitter' => wpv_get_option('share-lightbox-twitter'),
			'cbox-share-facebook' => wpv_get_option('share-lightbox-facebook'),
			'boxed' => wpv_post_default('boxed-layout', 'enable_box_layout'),
			'narrow-slider' => ! wpv_get_option('has-fullwidth-slider'),
			'fixed-header' => wpv_get_option('fixed-header'),
			'has-header-slider' => $has_header_slider,
			'has-header-sidebars' => $wpv_has_header_sidebars,
			'no-header-slider' => !$has_header_slider,
			'no-header-sidebars' => !$wpv_has_header_sidebars,
			'no-footer-sidebars' => !wpv_get_option('has-footer-sidebars'),
		);
		
           
            
                  

		foreach($body_class_conditions as $class=>$cond) {
			if($cond) {
				$body_class[] = $class;
			}
		}

		if(is_archive() || is_search() || get_query_var('format_filter'))
			define('WPV_ARCHIVE_TEMPLATE', true);
		
	?>
	
	<?php 
	$slider_style = '';
	$slider_effect = '';
	?>
<body <?php body_class(implode(' ', $body_class)); ?>>
	
	<div id="container" class="main-container">
		<?php
			/*
			 * some pages may not have a slider enabled, check for that
			 */
		$pageHeaderStyle = '';
		if( $has_header_slider ):
			//$slider_effect = wpv_post_default('slider-effect', 'header-slider-effect');
			//$slider_style = get_slider_design($slider_effect);
			
			//$visiblegrid = wpv_get_option('header-slider-visiblegrid') ? ' visiblegrid' : '';
			//$halfwidth = intval( wpv_post_default('slider-fullwidth', 'has-fullwidth-slider') == 'true' ) ? ' fullwidth' : ' halfwidth';
			//$position = wpv_post_default('slider-position', 'header-slider-position');
		?> 
<!--
		<div class="dgrid <?php //echo $halfwidth.$visiblegrid?>">
			<div class="header-slider-wrapper style-<?php //echo $slider_style ?> animation-<?php //echo $slider_effect?> <?php //echo $halfwidth.$visiblegrid?> slider-helper <?php //echo wpv_get_option('slider-helper-style')?> <?php //if(wpv_get_option('slider-helper-classic')) echo 'classic'?> <?php //echo $position?>">
				<?php //get_template_part('slider', 'header') ?>
			</div>
		</div>
-->
		
		<?php 
		else:
			$title_bgimage = wpv_post_default('local-title-background-image', 'title-background-image');
			$pageHeaderStyle = ' style="background-image:url(\'' . $title_bgimage . '\');';

			$bgopts = array('color', 'repeat', 'attachment', 'position');
			foreach($bgopts as $opt) {
				$opt_value = wpv_post_default('local-title-background-'.$opt, 'title-background-'.$opt);
				$pageHeaderStyle .= "background-$opt: $opt_value;";
			}
			$pageHeaderStyle .= '"';
		endif 
		?>
		<div class="boxed-layout">
			<div class="page-dash-wrapper" <?php echo $pageHeaderStyle?>>
				<div class="page-dash">
					<div class="fixed-header-box">
						<header>
							<div class="container_16">
								<div class="fl">
					
                                            <?php $logo = wpv_get_option('custom-header-logo')?>

                                      
	<a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>"  >
<?php 
		if($logo):
		?>
					<img src="<?php echo $logo;?>" alt="<?php bloginfo('name')?>"/>
										<?php
										else:
											bloginfo( 'name' );
										endif;
										?>
									</a>
								</div>
									
								<div class="fr outset"> 
									<div class="top-nav-box outset <?php echo wpv_get_option('header-helper-style')?> <?php if(wpv_get_option('header-helper-classic')) echo 'classic'?>">
										<nav class="top-nav">
											<?php wp_nav_menu(array('fallback_cb' => '', 'theme_location' => 'menu-top' )); ?>
										</nav>
										<?php if(wpv_get_option('phone-num-top') != ''): ?>
											<div id="phone-num"><?php wpvge('phone-num-top')?></div>
										<?php endif ?> 
									</div> 
								</div>
							</div>
							<div class="clearfix"></div>
						</header>
							
					</div><!-- / .fixed-header-box -->
					
					
					
					<div class="pane-wrapper outset">

							<div class="main-menu">
								<nav>
									<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
									<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wpv' ); ?>" class="visuallyhidden"><?php _e( 'Skip to content', 'wpv' ); ?></a>
									<?php
								    	if(has_nav_menu('menu-header')) {
								    		wp_nav_menu(array('theme_location' => 'menu-header', 'walker' => new description_walker() ));
								    	} else {
								    		wp_page_menu();
							    		}
								    ?>
									<div class="search-extend fr">
										<?php get_search_form(); ?>
									</div>
								</nav>
							</div>
							
							<!-- Slider goes here -->
							<?php if(is_page('home') || is_front_page()) { ?>
								<div id="slider_wrapper">
									<?php get_template_part('slider','slides'); ?>
								</div><!-- Slider -->
							<?php } else if(is_page('our-advantage')){ ?>
								<div id="slider_wrapper">
									<?php get_template_part('slider','advantage'); ?>
								</div><!-- Slider -->
                            <?php } else if(is_page('who-we-are')){ ?>
								<div id="slider_wrapper">
									<?php get_template_part('slider','who'); ?>
								</div><!-- Slider -->
							<?php } else { ?>
								<div id="mast_wrapper">
									<?php get_template_part('mast','static'); ?>
								</div><!-- Slider -->
							<?php } ?>
							
						<!-- #main (do not remove this comment) -->
						<div id="main" role="main" class="body-helper <?php echo wpv_get_option('body-helper-style')?> <?php if(wpv_get_option('body-helper-classic')) echo 'classic'?>">
						