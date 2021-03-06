<div id="message-thread">

	<?php do_action( 'bp_before_message_thread_content' ) ?>

	<?php if ( bp_thread_has_messages() ) : ?>

		<h3 id="message-subject"><?php bp_the_thread_subject() ?></h3>

		<div id="message-recipients">
			<span class="highlight">
				<?php printf( __('Sent between %s and %s', 'buddypress'), '<strong>'.bp_get_the_thread_recipients().'</strong>', '<a href="' . bp_get_loggedin_user_link() . '" title="' . bp_get_loggedin_user_fullname() . '"><strong>' . bp_get_loggedin_user_fullname() . '</strong></a>' ) ?>
			</span>
		</div>

		<?php do_action( 'bp_before_message_thread_list' ) ?>

		<div id="MessageContainers">
			<?php while ( bp_thread_messages() ) : bp_thread_the_message(); ?>
	
				<div class="message-box">
	
					<div class="message-metadata envelope-info">
						<?php do_action( 'bp_before_message_meta' ) ?>
						
						<span class="activity message-date"><?php bp_the_thread_message_time_since() ?></span>
						
						<div class="message-sender">
							<?php 
	
							// get the avatar image
							$avatarURL = bp_theme_avatar_url( 28,28,'',bp_core_fetch_avatar(array( 'item_id' => $GLOBALS['thread_template']->message->sender_id,  'type' => 'full', 'html' => 'false', 'width' => 28, 'height' => 28 )) );
							echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:28px; height:28px; "></div>';
	
							//bp_the_thread_message_sender_avatar( 'type=thumb&width=30&height=30' ) ?>
							<strong><a href="<?php bp_the_thread_message_sender_link() ?>" title="<?php bp_the_thread_message_sender_name() ?>"><?php bp_the_thread_message_sender_name() ?></a></strong>
						</div>
						
						<?php do_action( 'bp_after_message_meta' ) ?>
						<div class="clear"></div>
						
					</div><!-- .message-metadata -->
	
					<?php do_action( 'bp_before_message_content' ) ?>
	
					<div class="message-content">
	
						<?php bp_the_thread_message_content() ?>
	
					</div><!-- .message-content -->
	
					<?php do_action( 'bp_after_message_content' ) ?>
	
					<div class="clear"></div>
	
				</div><!-- .message-box -->
	
			<?php endwhile; ?>
		</div>

		<?php do_action( 'bp_after_message_thread_list' ) ?>

		<?php do_action( 'bp_before_message_thread_reply' ) ?>

		<form id="send-reply" action="<?php bp_messages_form_action() ?>" method="post" class="standard-form">

			<div class="message-box">

				<div class="message-metadata">

					<?php do_action( 'bp_before_message_meta' ) ?>

					<div class="avatar-box">
						<?php 
						// get user avatar
						$avatarURL = bp_theme_avatar_url(28,28, '', bp_core_fetch_avatar( array( 'item_id' => $GLOBALS['bp']->loggedin_user->id, 'type' => 'full', 'html' => 'false', 'width' => 28, 'height' => 28 ) ));
						echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width: 28px; height: 28px; "></div>';
						
						//bp_loggedin_user_avatar( 'type=thumb&height=30&width=30' ) ?>

						<strong><?php _e( 'Send a Reply', 'buddypress' ) ?></strong>
					</div>

					<?php do_action( 'bp_after_message_meta' ) ?>

				</div><!-- .message-metadata -->

				<div class="message-content">

					<?php do_action( 'bp_before_message_reply_box' ) ?>

					<textarea name="content" id="message_content" rows="15" cols="40"></textarea>

					<?php do_action( 'bp_after_message_reply_box' ) ?>

					<div class="submit">
						<input type="submit" name="send" value="<?php _e( 'Send Reply', 'buddypress' ) ?> &rarr;" id="send_reply_button"/>
						<span class="ajax-loader"></span>
					</div>

					<input type="hidden" id="thread_id" name="thread_id" value="<?php bp_the_thread_id(); ?>" />
					<?php wp_nonce_field( 'messages_send_message', 'send_message_nonce' ) ?>

				</div><!-- .message-content -->

			</div><!-- .message-box -->

		</form><!-- #send-reply -->

		<?php do_action( 'bp_after_message_thread_reply' ) ?>

	<?php endif; ?>

	<?php do_action( 'bp_after_message_thread_content' ) ?>

</div>