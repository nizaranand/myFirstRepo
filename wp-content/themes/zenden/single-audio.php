<?php

extract(wpv_post_info());
        
if(defined('WPV_ARCHIVE_TEMPLATE'))
	$fullpost = false;
?>
<div class="post-article">
	<div class="side-post-info audio">
		<a class="post-format-pad" href="<?php echo add_query_arg( 'format_filter', 'audio',home_url()) ?>"><span class="audio"></span></a>
		<?php edit_post_link('Edit') ?>
	</div>
	<article class="audio-post-format">
		<?php if($news != 'true'): ?>
			<div class="post-audio">
				<?php
					$source = get_post_meta($post->ID, 'post-link', true);
					preg_match('/\.(\w+)$/i', $source, $matches);
					$file_type = $matches[1];
				?> 
				<div id="jquery_jplayer_<?php the_id()?>" class="jp-jplayer"></div>
				<div id="jp_interface_<?php the_id()?>" class="jp-audio">
					<div class="jp-type-single">
						<div class="jp-gui jp-interface">
							<ul class="jp-controls">
									<li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('play', 'wpv')?></a></li>
									<li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('pause', 'wpv')?></a></li>
									<li><a href="javascript:;" class="jp-stop" tabindex="1"><?php _e('stop', 'wpv')?></a></li>
									<li><a href="javascript:;" class="jp-mute" tabindex="1"><?php _e('mute', 'wpv')?></a></li>
									<li><a href="javascript:;" class="jp-unmute" tabindex="1"><?php _e('unmute', 'wpv')?></a></li>
									<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume"><?php _e('max volume', 'wpv')?></a></li>
							</ul>
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							<div class="jp-time-holder">
								<div class="jp-current-time"></div>
								<div class="jp-duration"></div>
								<ul class="jp-toggles">
									<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
									<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
								</ul>
							</div>
						</div>
						<div class="jp-title">
							<ul>
								<li><?php the_title()?></li>
							</ul>
						</div>
						<div class="jp-no-solution">
							<span>Update Required</span>
							To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
						</div>
					</div>
				</div>
				
				<?php if(!empty($file_type)): ?>
					<?php wp_enqueue_script('front-jquery.jplayer.min') ?>
					<script type="text/javascript">
						jQuery(function($){
							$("#jquery_jplayer_<?php the_id()?>").jPlayer({
								ready: function () {
									console.log('jplayer is ready');
									var self = this;
									setTimeout(function() {
										$(self).jPlayer("setMedia", {
											<?php echo $file_type?>: "<?php echo $source?>"
										});
									}, 10);
								},
								swfPath: "<?php echo WPV_SWF ?>jplayer.swf",
								supplied: "<?php echo $file_type?>",
								cssSelectorAncestor: '#jp_interface_<?php the_id()?>'
								//,errorAlerts: true
							});
						});
					</script>
				<?php endif ?>
			</div>
		<?php endif ?>

		<?php if(!is_single()) po_post_header($meta, $news) ?>

		<?php
			$content = get_the_content();
			if(!empty($content)):
		?>
			<div class="post-content">
				<?php
					if(is_single()) {
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpv' ), 'after' => '</div>' ) );
						wpv_share('post');
					} else {
						if($fullpost) {
							global $more;
							$more = 0;
							the_content(__("Read More", 'wpv'),false);
						} elseif(!defined('WPV_ARCHIVE_TEMPLATE')) {
							the_excerpt();
						}
					}
				?>
			</div>
		<?php endif ?>
		
		<footer class="entry-utility">
			<?php if($meta && wpv_get_option('meta_posted_in')): ?>
				<span><?php _e('Categories:', 'wpv')?></span> <span><?php echo get_the_category_list(', '); ?></span>
				<span class="the-tags"><?php the_tags('<span>Tags: </span><span>',', ','</span>')?></span>
			<?php endif ?>
			<?php if(wpv_get_option('meta_comment_count')): ?>
				<span class="comments-link fr"><?php comments_popup_link('<b>Leave a comment</b> <span class="icomment-box">?</span>', '<b>Comment</b> <span class="icomment-box">1</span>', '<b>Comments</b> <span class="icomment-box">%</span>'); ?></span>
			<?php endif ?>
		</footer>
		
	</article>
</div>

