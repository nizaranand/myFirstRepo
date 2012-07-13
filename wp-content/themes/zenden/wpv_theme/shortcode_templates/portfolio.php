<?php
function pre($array){
	echo '<pre>';
		var_dump($array);
	echo '</pre>';
}

//$size[0] -= 8;

if ($sortable != 'false'):
	$nopaging = 'true';
?>
	<section class="portfolios sortable">
		<nav class="sort_by_cat">
			<span><?php _e('Show:', 'wpv') ?></span>
			<span>
				<span class="cat"><a data-value="all" href="#" class="active"><?php _e('All', 'wpv')?></a></span>
				<?php
					// show the categories present in this listing
					$terms = array();
					if ($cat != '' && $cat != 'null') {
						foreach(explode(',', $cat) as $term_slug) {
							$terms[] = get_term_by('slug', $term_slug, 'portfolio_category');
						}
					} else {
						$terms = get_terms('portfolio_category', 'hide_empty=1');
					}
					//pre($terms);
				?>
				<?php foreach($terms as $term): ?>
						 <span class="cat"><a data-value="<?php echo $term->slug?>" href="#"><?php echo $term->name?></a></span>
				<?php endforeach ?>
			</span>
		</nav>	
		<div class="clearboth"></div>
<?php else: ?>
	<section class="portfolios">
<?php endif ?>

		<ul class="inner_<?php echo $width?> portfolio_<?php echo $column_class?> clearfix" data-columns="<?php echo $column ?>">
		<?php
		
			// get the portfolio items
			
			$query = array(
				'post_type' => 'portfolio',
				'orderby'=>'menu_order', 
				'order'=>'ASC',
				'posts_per_page' => $max,
			);
			
			if(!empty($cat)) {
				$query['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'slug', 
						'terms' => explode(',', $cat),
					)
				);
			}
			
			if ($nopaging == 'false') {
				$query['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
			} else {
				$query['paged'] = 1;
			}
			
			if($ids && $ids != 'null') {
				$query['post__in'] = explode(',',$ids);
			}
			
			query_posts($query);
	
	if($column == 1) {
		global $more;
		$more = 0;
	}
	
	$i = 0;
	while(have_posts()): the_post(); $i++;
		
		$terms = get_the_terms(get_the_id(), 'portfolio_category');
		$terms_slug = $terms_name = array();
		if (is_array($terms)) {
			foreach($terms as $term) {
				$terms_slug[] = $term->slug;
				$terms_name[] = $term->name;
			}
		}
		
		$last = $clear = '';
		if($i % $column == 0) {
			$last = 'last';
		}
		if (($i-1) % $column == 0) {
			$clear = ' clearboth';
		}
		?>
		
		<li data-id="<?php the_id()?>" data-type="<?php echo implode(',', $terms_slug)?>" class="<?php echo $last.$clear?>">
		
		<?php
		if (has_post_thumbnail()):
			extract(wpv_get_portfolio_options($group, $rel_group));
?>
			<div class="portfolio_image"> 			
				<div class="thumbnail" style="height:<?php echo $size[1]?>px">

					
					<span class="graphic-label<?php if($column==1) echo '-big';?>"></span>
					<?php if($type=='gallery' && ($column == 1 || $column == 3)): ?>
						<?php echo do_shortcode('[gallery style="gallery featured" raw="false" height="'.$size[1].'" width="'.$size[0].'"]');?>
					<?php else: ?>
						<a class="<?php echo $lightbox?> thumbnail-url <?php echo $type?>" <?php if(isset($link_target)) echo 'target="'.$link_target.'"'; ?> href="<?php echo $href?>" <?php echo $rel.$width.$height.$iframe?>>
							<?php
								wpv_lazy_load( wpv_resize_image($image[0], $size[0], $size[1]), get_the_title(), array(
									'width' => (int)$size[0],//+8,
									'height' => (int)$size[1]//+8,
								));
							?>
						</a>
					<?php endif ?>
				</div><!-- / .thumbnail -->
			</div>
	<?php endif ?>

	<?php if($column == 1 || $column == 3): ?>
		<div class="portfolio_details project-info-pad folio">
			<?php if($title == 'true'): ?>
				<h2><?php the_title()?></h2>
			<?php endif ?>
			<?php if($desc == 'true' || $more == 'true'): ?>
				<div class="portfolio_desc">
					<?php if($desc == 'true'): ?>
						<?php if($long == 'true'): ?>
							<?php the_content()?>
						<?php else: ?>
							<?php echo 'Hello'; ?>
							<?php the_excerpt() ?>
						<?php endif ?>
					<?php endif ?>
					
					<?php 
						if($more == 'true'):
		
							$portfolio_more = get_post_meta(get_the_id(), 'portfolio_has_more', true);
							
							if($portfolio_more != 'true'):
								$more_link_target = get_post_meta(get_the_ID(), 'portfolio_link_target', true);
								$more_link_target = $more_link_target? $more_link_target: '_self';
							?>
								<a href="<?php the_permalink()?>" target="<?php echo $more_link_target?>" class="more-btn"><span><?php echo $moretext?></span></a>
						 	<?php endif ?>
					<?php endif ?>
				</div>
			<?php endif?>
			
		</div>
	<?php endif ?>
			
	<?php if($type == 'gallery' && !empty($image_ids) && $column != 1 && $column != 3): ?>
		<div class="hidden">'
			<?php foreach($image_ids as $image_id): ?>
				<?php $image_src = wp_get_attachment_image_src($image_id,'full');?>
				<a title="" class="lightbox" href="<?php echo $image_src[0]?>" <?php echo $rel?>">gallery-<?php echo get_the_ID()?></a>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	
	<!-- Description and title  and text box -->	
	<?php if($column != 1 && $column != 3): ?>
						<div class="info-pad">
							<div class="info">

								<?php
									if($more == 'true'):

										$portfolio_more = get_post_meta(get_the_id(), 'portfolio_has_more', true);

										if( $portfolio_more != 'true'):
											$more_link_target = get_post_meta(get_the_ID(), 'portfolio_link_target', true);
											$more_link_target = $more_link_target? $more_link_target: '_self';
								?>
									<a href="<?php the_permalink()?>" target="<?php echo $more_link_target?>" class="portfolio-read-more">

										<?php if($title == 'true'): ?>
											<strong class="title"><?php the_title()?></strong>
										<?php endif ?>
										<?php if(sizeof($terms_name) > 0):?>
											<span class="category"><?php echo implode(', ', $terms_name)?></span>
											<?php 
												if ( get_post_meta($post->ID, 'product_description', true) ) : ?>
												<p><?php echo get_post_meta($post->ID, 'product_description', true) ?></p>
												<?php endif; ?>
											
										<?php endif ?>

									</a>
								<?php endif; else: ?>

									<?php if($title == 'true'): ?>
										<strong class="title"><?php the_title()?></strong>
									<?php endif ?>
									<?php if(sizeof($terms_name) > 0):?>
										<span class="category"><?php echo implode(', ', $terms_name)?></span>
									<?php endif ?>

								<?php endif; ?>

								<?php if($desc == 'true' || $more == 'true'): ?>
									<div class="description">
										<?php if($desc == 'true'): ?>
											<div class="description-sep"></div>
											<?php if($long == 'true'): ?>
												<?php the_content()?>
											<?php else: ?>
												<?php the_excerpt() ?>
											<?php endif ?>
										<?php endif ?>
									</div>
								<?php endif ?>
							</div>
						</div>
					<?php endif ?>
	</li>
		
	<?php endwhile ?>
	
	</ul>
	<?php if ($nopaging == 'false' && function_exists('wpv_load_more'))	wpv_load_more(); ?>
</section>

<?php wp_reset_query(); ?>
