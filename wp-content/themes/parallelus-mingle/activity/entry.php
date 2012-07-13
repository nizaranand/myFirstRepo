<?php /* This template is used by activity-loop.php and AJAX functions to show each activity */ ?>

<?php do_action( 'bp_before_activity_entry' ) ?>

<li class="<?php bp_activity_css_class() ?>" id="activity-<?php bp_activity_id() ?>">
	<article>
		<div class="activity-avatar">
			<?php
			/*	Hey, what's the weird ID in the the container above? It looks like the word "activity" spelled backwards?
				Why yes, it is. I wonder why that's there...
				
				IT'S A FIX FOR BP 1.5!!!!
				
				The stupid JavaScript code uses a call to "var parent = target.parent().parent().parent();" as method of getting "parent_id" of the Favorites 
				link which means that it must have that ID exactly 3 parent containers before the actual link. What is so crazy about this is the actual 
				favorite link contains the ID we're looking in it's URL. So if you're going to do something like this to hunt for the ID at least go somewhere 
				that does not have any impact on the design or HTML code structure. Use a damn regular expressing to strip the ID from the URL or better yet, 
				put it in the link as another attribute like "rel='bp_activity_id()'". What's even better about this is it strips the first 9 characters from 
				the ID so we need to exactly replicat that but not duplicate ID's or it's invalid code. 
				
				WTP - THIS IS INSANE!!!			
			*/
			?>
			<a href="<?php bp_activity_user_link() ?>">
				<?php 
				// get the avatar image, get the default, resize default, replace URL of default with resized, insert new URL.
				$avatarURL = bp_theme_avatar_url(80,80);
				echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); "></div>';  // bp_activity_avatar( 'type=full&width=100&height=100' ) ?>
			</a>
		</div>
	
		<div class="activity-content item-content-container <?php if ( !bp_get_activity_content_body() ) : echo 'no-inner-content'; endif; ?>" id="ytivitca-<?php bp_activity_id() ?>">
			<div class="post-bubble-arrow"></div>
	
			<header class="comment-header">
				
				<div class="activity-meta item-meta">
		
					<?php if ( is_user_logged_in() ) : ?>
						<span class="sep">&nbsp;&nbsp;/&nbsp;&nbsp;</span>
						<?php if ( !bp_get_activity_is_favorite() ) : ?>
							<a href="<?php bp_activity_favorite_link() ?>" class="fav" title="<?php _e( 'Mark as Favorite', 'buddypress' ) ?>"><?php _e( 'Favorite', 'buddypress' ) ?></a>
						<?php else : ?>
							<a href="<?php bp_activity_unfavorite_link() ?>" class="unfav" title="<?php _e( 'Remove Favorite', 'buddypress' ) ?>"><?php _e( 'Remove Favorite', 'buddypress' ) ?></a>
						<?php endif; ?>
					<?php endif;?>
					
					<?php if ( is_user_logged_in() && bp_activity_can_comment() ) : ?>
						<span class="sep">&nbsp;&nbsp;/&nbsp;&nbsp;</span>
						<a href="<?php bp_activity_comment_link() ?>" class="acomment-reply" id="acomment-comment-<?php bp_activity_id() ?>"><?php _e( 'Reply', 'buddypress' ) ?> (<span><?php bp_activity_comment_count() ?></span>)</a>
					<?php endif; ?>
		
					<?php do_action( 'bp_activity_entry_meta' ) ?>
				</div>
				
				<div class="date"><?php echo bp_core_time_since( bp_get_activity_date_recorded() ); ?></div>
				
				<h4 class="poster-name"><a href="<?php bp_activity_user_link() ?>" title="<?php _e( 'Go to '.$GLOBALS['activities_template']->activity->user_nicename. '\'s member page.', 'buddypress' ); ?>"><?php echo $GLOBALS['activities_template']->activity->user_nicename; ?></a></h4>
				
			</header>
			
			<?php if ( bp_get_activity_content_body() ) : ?>
				<div class="activity-inner">
					<?php bp_activity_content_body() ?>
				</div>
			<?php endif; ?>
	
			<?php do_action( 'bp_activity_entry_content' ) ?>
	
			<footer class="activity-footer item-footer">
				<?php custom_bp_activity_action() ?>
			</footer>
			
		</div>
	
		<?php if ( 'activity_comment' == bp_get_activity_type() ) : ?>
			<div class="activity-inreplyto">
				<strong><?php _e( 'In reply to', 'buddypress' ) ?></strong> - <?php bp_activity_parent_content() ?> &middot;
				<a href="<?php bp_activity_thread_permalink() ?>" class="view" title="<?php _e( 'View Thread / Permalink', 'buddypress' ) ?>"><?php _e( 'View', 'buddypress' ) ?></a>
			</div>
		<?php endif; ?>
	
		<?php do_action( 'bp_before_activity_entry_comments' ) ?>
	
		<?php if ( bp_activity_can_comment() ) : ?>
			<div class="activity-comments">
				<?php bp_activity_comments() ?>
	
				<?php if ( is_user_logged_in() ) : ?>
				<form action="<?php bp_activity_comment_form_action() ?>" method="post" id="ac-form-<?php bp_activity_id() ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display() ?>>
					<div class="ac-reply-avatar">
						<?php 
						// get the avatar image, get the default, resize default, replace URL of default with resized, insert new URL.
						$avatarURL = bp_theme_avatar_url(64,64);
						echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); "></div>';  ?>
					</div>
					<div class="ac-reply-content">
						<div class="ac-textarea">
							<textarea id="ac-input-<?php bp_activity_id() ?>" class="ac-input" name="ac_input_<?php bp_activity_id() ?>"></textarea>
						</div>
						<input type="submit" name="ac_form_submit" value="<?php _e( 'Post', 'buddypress' ) ?> &rarr;" /> &nbsp; <?php _e( 'or press esc to cancel.', 'buddypress' ) ?>
						<input type="hidden" name="comment_form_id" value="<?php bp_activity_id() ?>" />
					</div>
					<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ) ?>
				</form>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	
		<?php do_action( 'bp_after_activity_entry_comments' ) ?>	</article>

</li>

<?php do_action( 'bp_after_activity_entry' ) ?>

