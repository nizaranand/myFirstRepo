	<?php do_action( 'bp_before_directory_forums_content' ) ?>

	<div id="BP-Container">
		<div id="BP-Content">

			<form action="" method="post" id="forums-search-form" class="dir-form">
				<header class="entry-header clearfix">

					<div id="forums-dir-search" class="dir-search">
						<?php bp_directory_forums_search_form() ?>
					</div>
					
					<!-- Title / Page Headline -->
					<h1 class="entry-title forumTitle"><?php _e( 'Forums Directory', 'buddypress' ) ?></h1>
					<?php if ( is_user_logged_in() ) : ?><div class="createForumButton"> &nbsp; <span class="sep">|</span> &nbsp; <a class="button show-hide-new boxLink" href="#new-topic" id="new-topic-button"><?php _e( 'New Topic', 'buddypress' ) ?></a></div><?php endif; ?>
					
				</header>
	
			</form>
	
			<div id="new-topic-post">
	
				<?php if ( is_user_logged_in() ) : ?>
	
					<?php if ( bp_is_active( 'groups' ) && bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100' ) ) : ?>
	
						<form action="" method="post" id="forum-topic-form" class="standard-form">
	
							<?php do_action( 'groups_forum_new_topic_before' ) ?>
	
							<a name="post-new"></a>
							<h5><?php _e( 'Create New Topic:', 'buddypress' ); ?></h5>
	
							<?php do_action( 'template_notices' ); ?>
	
							<label><?php _e( 'Title:', 'buddypress' ); ?></label>
							<input type="text" name="topic_title" id="topic_title" value="" />
	
							<label><?php _e( 'Content:', 'buddypress' ); ?></label>
							<textarea name="topic_text" id="topic_text"></textarea>
	
							<label><?php _e( 'Tags (comma separated):', 'buddypress' ); ?></label>
							<input type="text" name="topic_tags" id="topic_tags" value="" />
	
							<label><?php _e( 'Post In Group Forum:', 'buddypress' ); ?></label>
							<select id="topic_group_id" name="topic_group_id">
	
								<option value=""><?php /* translators: no option picked in select box */ _e( '----', 'buddypress' ); ?></option>
	
								<?php while ( bp_groups() ) : bp_the_group(); ?>
	
									<?php if ( bp_group_is_forum_enabled() && ( is_super_admin() || 'public' == bp_get_group_status() || bp_group_is_member() ) ) : ?>
	
										<option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>
	
									<?php endif; ?>
	
								<?php endwhile; ?>
	
							</select><!-- #topic_group_id -->
	
							<?php do_action( 'groups_forum_new_topic_after' ); ?>
	
							<div class="submit">
								<input type="submit" name="submit_topic" id="submit" value="<?php _e( 'Post Topic', 'buddypress' ); ?>" onclick="if(jQuery('#topic_group_id').val()==''){alert('<?php _e( 'Please pick a group forum to post this topic.', 'buddypress' ); ?>'); return false;}" />
								<input type="button" name="submit_topic_cancel" id="submit_topic_cancel" value="<?php _e( 'Cancel', 'buddypress' ); ?>" />
							</div>
	
							<?php wp_nonce_field( 'bp_forums_new_topic' ); ?>
	
						</form><!-- #forum-topic-form -->
	
					<?php elseif ( bp_is_active( 'groups' ) ) : ?>
	
						<div id="message" class="info">
	
							<p><?php printf( __( "You are not a member of any groups so you don't have any group forums you can post in. To start posting, first find a group that matches the topic subject you'd like to start. If this group does not exist, why not <a href='%s'>create a new group</a>? Once you have joined or created the group you can post your topic in that group's forum.", 'buddypress' ), site_url( bp_get_groups_root_slug() . '/create/' ) ) ?></p>
	
						</div>
	
					<?php endif; ?>
	
				<?php endif; ?>
			</div><!-- #new-topic-post -->
	
			<form action="" method="post" id="forums-directory-form" class="dir-form">
	
				<div class="item-list-tabs bp-content-tabs">
					<ul>
						<li class="selected" id="forums-all"><a href="<?php bp_root_domain() ?>"><?php printf( __( 'All Topics (%s)', 'buddypress' ), bp_get_forum_topic_count() ) ?></a></li>
	
						<?php if ( is_user_logged_in() && bp_get_forum_topic_count_for_user( bp_loggedin_user_id() ) ) : ?>
							<li id="forums-personal"><a href="<?php echo bp_loggedin_user_domain() . BP_GROUPS_SLUG . '/' ?>"><?php printf( __( 'My Topics (%s)', 'buddypress' ), bp_get_forum_topic_count_for_user( bp_loggedin_user_id() ) ) ?></a></li>
						<?php endif; ?>
	
					</ul>
				</div>

				<div class="item-list-tabs" id="subnav">
					<ul>	
						<?php do_action( 'bp_forums_directory_group_types' ) ?>
	
						<li id="forums-order-select" class="last filter">
	
							<?php _e( 'Order By:', 'buddypress' ) ?>
							<select>
								<option value="active"><?php _e( 'Last Active', 'buddypress' ) ?></option>
								<option value="popular"><?php _e( 'Most Posts', 'buddypress' ) ?></option>
								<option value="unreplied"><?php _e( 'Unreplied', 'buddypress' ) ?></option>
	
								<?php do_action( 'bp_forums_directory_order_options' ) ?>
							</select>
						</li>
					</ul>
				</div>

	
				<div id="forums-dir-list" class="forums dir-list">
					<?php locate_template( array( 'forums/forums-loop.php' ), true ) ?>
				</div>
	
				<?php do_action( 'bp_directory_forums_content' ) ?>
	
				<?php wp_nonce_field( 'directory_forums', '_wpnonce-forums-filter' ) ?>
	
				<?php do_action( 'bp_after_directory_forums_content' ) ?>
	
			</form>
	
		</div><!-- #content -->
	</div><!-- #container -->

	<?php //locate_template( array( 'sidebar.php' ), true ) ?>
