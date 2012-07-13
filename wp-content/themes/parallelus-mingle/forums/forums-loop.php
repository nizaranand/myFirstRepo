<?php if ( bp_has_forum_topics( bp_ajax_querystring( 'forums' ) ) ) : ?>

	<div class="bp-pagination">

		<div id="post-count" class="pag-count">
			<?php if ( bp_is_group_forum() && is_user_logged_in() ) : ?>
				<a href="#post-new" class="button"><?php _e( 'New Topic', 'buddypress' ) ?></a> &nbsp;
			<?php endif; ?>

			<?php bp_forum_pagination_count() ?>
		</div>

		<div class="pagination-links" id="topic-pag">
			<?php bp_forum_pagination() ?>
		</div>

	</div>

	<?php do_action( 'bp_before_directory_forums_list' ) ?>

	<?php /*?><table class="forum">
		<!--<thead>
			<tr class="table-head">
				<th id="th-poster"><?php _e( 'Started by', 'buddypress' ) ?></th>
				<th id="th-title"><?php _e( 'Topic', 'buddypress' ) ?></th>
	
				<?php if ( !bp_is_group_forum() ) : ?>
					<th id="th-group"><?php _e( 'Group', 'buddypress' ) ?></th>
				<?php endif; ?>
	
				<th id="th-postcount"><?php _e( 'Posts', 'buddypress' ) ?></th>
				<th id="th-freshness"><?php _e( 'Freshness', 'buddypress' ) ?></th>
			</tr>
		</thead>-->
		
		<tbody>
			<?php while ( bp_forum_topics() ) : bp_the_forum_topic(); ?>
	
			<tr class="<?php bp_the_topic_css_class() ?>">
				<td class="td-poster">
					<a href="<?php bp_the_topic_permalink() ?>">
						<?php 
						// get the avatar image
						$avatarURL = bp_theme_avatar_url(64,64,'', bp_core_fetch_avatar( array( 'email' =>  bb_get_user_email($GLOBALS['forum_template']->topic->topic_poster), 'item_id' => $GLOBALS['forum_template']->topic->topic_poster, 'type' => 'full', 'html' => 'false', 'width' => 64, 'height' => 64 )) );
						echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:64px; height:64px; "></div>'; ?>
						<?php //bp_the_topic_last_poster_avatar( 'type=thumb&width=20&height=20' ) ?>
					</a>
					<!--<div class="poster-name"><?php bp_the_topic_poster_name(); //bp_the_topic_last_poster_name() ?></div>-->
				</td>
				<td class="td-title">
					<h4 class="item-title">
						<a class="topic-title" href="<?php bp_the_topic_permalink() ?>" title="<?php bp_the_topic_title() ?> - <?php _e( 'Permalink', 'buddypress' ) ?>"><?php bp_the_topic_title() ?></a>
					</h4>
					<div class="poster-name">Started by: <?php bp_the_topic_poster_name(); ?></div>
					<div class="poster-name">Latest reply: <?php bp_the_topic_last_poster_name(); ?></div>					
				</td>
	
				<td class="td-details">
					<?php if ( !bp_is_group_forum() ) : ?>
						<div class="thread-group">
							<a href="<?php bp_the_topic_object_permalink() ?>">
								<?php 
								// get the avatar image
								$avatarURL = bp_theme_avatar_url(32,32,'', bp_core_fetch_avatar( array( 'item_id' => $GLOBALS['forum_template']->topic->object_id, 'object' => 'group', 'type' => 'full', 'html' => 'false', 'width' => 32, 'height' => 32 )) );
								echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:32px; height:32px; "></div>'; ?>
								<?php //bp_the_topic_object_avatar( 'type=thumb&width=20&height=20' ) ?>
							</a>
							<div class="object-name"><a href="<?php bp_the_topic_object_permalink() ?>" title="<?php bp_the_topic_object_name() ?>"><?php bp_the_topic_object_name() ?></a></div>
						</div>
					<?php endif; ?>
					<div class="thread-postcount">
						<?php bp_the_topic_total_posts() ?> replies
					</div>
					<div class="thread-freshness">
						<?php bp_the_topic_time_since_last_post() ?>
					</div>
				</td>

				<?php do_action( 'bp_directory_forums_extra_cell' ) ?>
			</tr>
	
			<?php do_action( 'bp_directory_forums_extra_row' ) ?>
	
			<?php endwhile; ?>
		</tbody>

	</table><?php */?>

	<div class="forum forum-list-container">
		<ul class="forum-list">
			<?php while ( bp_forum_topics() ) : bp_the_forum_topic(); ?>
	
			<li class="<?php bp_the_topic_css_class() ?> forum-li">
				<div class="thread-poster">
					<a href="<?php bp_the_topic_permalink() ?>">
						<?php 
						// get the avatar image
						$avatarURL = bp_theme_avatar_url(80,80,'', bp_core_fetch_avatar( array( 'email' =>  bb_get_user_email($GLOBALS['forum_template']->topic->topic_poster), 'item_id' => $GLOBALS['forum_template']->topic->topic_poster, 'type' => 'full', 'html' => 'false', 'width' => 80, 'height' => 80 )) );
						echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:80px; height:80px; "></div>'; ?>
						<?php //bp_the_topic_last_poster_avatar( 'type=thumb&width=20&height=20' ) ?>
					</a>
					<!--<div class="poster-name"><?php bp_the_topic_poster_name(); //bp_the_topic_last_poster_name() ?></div>-->
				</div>
				
				<div class="thread-info">
					<div class="thread-title">
						<h4 class="item-title">
							<a class="topic-title" href="<?php bp_the_topic_permalink() ?>" title="<?php bp_the_topic_title() ?> - <?php _e( 'Permalink', 'buddypress' ) ?>"><?php bp_the_topic_title() ?></a>
						</h4>
					</div>
				
					<?php if ( !bp_is_group_forum() ) : ?>
						<div class="thread-group">
							<?php /*?><a href="<?php bp_the_topic_object_permalink() ?>">
								<?php 
								// get the avatar image
								$avatarURL = bp_theme_avatar_url(32,32,'', bp_core_fetch_avatar( array( 'item_id' => $GLOBALS['forum_template']->topic->object_id, 'object' => 'group', 'type' => 'full', 'html' => 'false', 'width' => 32, 'height' => 32 )) );
								echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:32px; height:32px; "></div>'; ?>
								<?php //bp_the_topic_object_avatar( 'type=thumb&width=20&height=20' ) ?>
							</a><?php */?>
							<div class="object-name"><?php _e( 'Posted in:', 'buddypress' ) ?> <a href="<?php bp_the_topic_object_permalink() ?>" title="<?php bp_the_topic_object_name() ?>"><?php bp_the_topic_object_name() ?></a></div>
						</div>
					<?php endif; ?>

					<div class="thread-post-users">
						<span class="poster-name thread-creator"><?php _e( 'Creator:', 'buddypress' ) ?> <?php bp_the_topic_poster_name(); ?></span>
						<span class="sep">/</span>
						<span class="poster-name latest-reply"><?php _e( 'Latest:', 'buddypress' ) ?> <?php bp_the_topic_last_poster_name(); ?></span>					
					</div>
				</div>
				
				<div class="thread-history">
					<div class="thread-postcount">
						<span class="postCount"><?php bp_the_topic_total_posts() ?></span>
						<span class="replies"><?php _e( 'replies', 'buddypress' ) ?></span>
						<div class="clear"></div>
					</div>
					<div class="thread-freshness"><?php bp_the_topic_time_since_last_post() ?></div>
				</div>

				<?php do_action( 'bp_directory_forums_extra_cell' ) ?>
				
				<div class="clear"></div>
			</li>
	
			<?php do_action( 'bp_directory_forums_extra_row' ) ?>
	
			<?php endwhile; ?>
		</ul>

	</div>
	<?php do_action( 'bp_after_directory_forums_list' ) ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, there were no forum topics found.', 'buddypress' ) ?></p>
	</div>

<?php endif;?>

<div class="clear"></div>