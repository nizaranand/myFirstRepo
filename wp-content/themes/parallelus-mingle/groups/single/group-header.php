<?php do_action( 'bp_before_group_header' ) ?>

<div id="item-actions">
	<?php if ( bp_group_is_visible() ) : ?>

		<h5><?php _e( 'Group Admins', 'buddypress' ) ?></h5>
		
		<?php 
		
		// Get the admin avatars
		//................................................................
		
		// Stripped from function "bp_group_list_admins()"

		$group =& $GLOBALS['groups_template']->group;
		if ( $group->admins ) : ?>
			<ul id="group-admins">
				<?php foreach( (array)$group->admins as $admin ) { ?>
					<li>
						<a href="<?php echo bp_core_get_user_domain( $admin->user_id, $admin->user_nicename, $admin->user_login ) ?>" title="<?php echo $admin->user_nicename ?>">
							<?php
							// get the avatar image
							$avatarURL = bp_theme_avatar_url(24,24,'', bp_core_fetch_avatar(array( 'item_id' => $admin->user_id, 'email' => $admin->user_email, 'type' => 'full', 'html' => 'false', 'width' => 24, 'height' => 24 )) );
							echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:24px; height:24px; "></div>';

							 //echo bp_core_fetch_avatar( array( 'item_id' => $admin->user_id, 'email' => $admin->user_email ) ) 
							 ?>
						</a>
						<div class="nickname"><?php echo $admin->user_nicename ?></div>
						<div class="clear"></div>
					</li>
				<?php } ?>
			</ul>
		<?php else: ?>
			<span class="activity"><?php _e( 'No Admins', 'buddypress' ) ?></span>
		<?php endif; ?>


		<?php do_action( 'bp_after_group_menu_admins' ) ?>


		<?php if ( bp_group_has_moderators() ) : ?>
			<?php do_action( 'bp_before_group_menu_mods' ) ?>

			<h5><?php _e( 'Group Mods' , 'buddypress' ) ?></h5>
			<?php 
			
			// Get the moderator avatars
			//................................................................

			// Stripped from function "bp_group_list_mods()"

			$group =& $GLOBALS['groups_template']->group;
			if ( $group->mods ) : ?>
				<ul id="group-mods">
					<?php foreach( (array)$group->mods as $mod ) { ?>
						<li>
							<a href="<?php echo bp_core_get_user_domain( $mod->user_id, $mod->user_nicename, $mod->user_login ) ?>">
								<?php
								// get the avatar image
								$avatarURL = bp_theme_avatar_url(24,24,'', bp_core_fetch_avatar(array( 'item_id' => $mod->user_id, 'email' => $mod->user_email, 'type' => 'full', 'html' => 'false', 'width' => 24, 'height' => 24 )) );
								echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:24px; height:24px; "></div>';
	
								 //echo bp_core_fetch_avatar( array( 'item_id' => $mod->user_id, 'email' => $mod->user_email ) ) 
								 ?>
							</a>
							<div class="nickname"><?php echo $mod->user_nicename ?></div>
							<div class="clear"></div>
						</li>
					<?php } ?>
				</ul>
			<?php else: ?>
				<span class="activity"><?php _e( 'No Mods', 'buddypress' ) ?></span>
			<?php endif ?>


			<?php do_action( 'bp_after_group_menu_mods' ) ?>
		<?php endif; ?>

	<?php endif; ?>
</div><!-- #item-actions -->

<div id="item-header-avatar">
	<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>">
		<?php 
		// get the avatar image
		$avatarURL = bp_theme_avatar_url(128,128, 'group_avatar');
		echo '<div class="avatar" style="background-image: url(\''.$avatarURL.'\'); width:128px; height:128px; "></div>'; 
		//bp_group_avatar() ?>
	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content" class="group-single-header">
	<h1 class="entry-title"><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h1>
	<span class="highlight insetBox"><?php bp_group_type() ?></span> <span class="activity"><?php printf( __( 'active %s ago', 'buddypress' ), bp_get_group_last_active() ) ?></span>

	<?php do_action( 'bp_before_group_header_meta' ) ?>

	<div id="item-meta">
		<?php bp_group_description() ?>

		<?php bp_group_join_button() ?>

		<?php do_action( 'bp_group_header_meta' ) ?>
	</div>
	
	<div class="clear"></div>

</div><!-- #item-header-content -->

<?php do_action( 'template_notices' ) ?>

<?php do_action( 'bp_after_group_header' ) ?>

