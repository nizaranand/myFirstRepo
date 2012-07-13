<?php
/**
 * @package WordPress
 * @subpackage zenden
 */
?>

												
					</div><!-- / #main (do not remove this comment) -->
				</div><!-- / .pane-wrapper -->
				<footer class="main-footer footer-helper <?php echo wpv_get_option('footer-helper-style')?> <?php if(wpv_get_option('footer-helper-classic')) echo 'classic'?>">
					<?php if(wpv_get_option('has-footer-sidebars')): ?>
						<div class="outset">
							<?php wpv_footer_sidebars(); ?>
						</div><!-- / .outset -->
					<?php endif ?>
					
					<div class="copyrights">
						<div class="container_16">
							<?php echo apply_filters('the_content', wpv_get_option( 'credits' )); ?>
						</div>
					</div><!-- / .copyrights -->
				</footer>
			</div><!-- / .page-dash -->
		</div><!-- / .page-dash-wrapper -->
	</div><!-- / .boxed-layout -->
</div><!-- / #container -->

<?php wp_footer(); ?>

</body>
</html>
