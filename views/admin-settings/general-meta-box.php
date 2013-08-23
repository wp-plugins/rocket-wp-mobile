<table class="wpmp_input widefat" id="wpmp_options">

	<tbody>
		
		<?php do_action( 'wpmp_general_meta_box_start', $settings ); ?>

		<tr id="status">
			
			<td class="label">
				<label>
					<?php _e( 'Status', 'wpmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<p><label><input type="radio" value="disabled" name="settings[status]" <?php checked( $settings['status'], 'disabled' ) ?> /><span><?php _e( 'Disabled', 'wpmp' ) ?></span><label></p>
				<p><label><input type="radio" value="enabled" name="settings[status]" <?php checked( $settings['status'], 'enabled' ) ?> /><span><?php _e( 'Enabled', 'wpmp' ) ?></span><label></p>
			</td>
			
		</tr>

		<tr id="theme">
			
			<td class="label">
				<label>
					<?php _e( 'Theme', 'wpmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<select name="settings[theme]">
					<?php foreach ( $themes as $theme ): ?>
						<option value="<?php echo $theme->id() ?>" <?php selected( $theme->id(), $settings['theme'] ) ?>>
							<?php echo $theme->name() ?>
						</option>
					<?php endforeach; ?>
				</select>
			</td>
			
		</tr>

		<tr id="menu-info">
			
			<td class="label">
				<label>
					<?php _e( 'Mobile Menu', 'wpmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				A new menu location <strong><em>Primary WP Mobile Theme Menu </em></strong>is added for custom mobile menu in <a href="<?php echo admin_url( 'nav-menus.php' ); ?>">menu admin page</a>. Place your existing or newly created menu on this location
			</td>
			
		</tr>

		<tr id="custom-homepage">
			
			<td class="label">
				<label>
					<?php _e( 'Mobile Homepage', 'wpmp' ); ?>
				</label>
				<p class="description"><?php _e( 'Set a custom page to be used as a homepage for mobile visitors', 'wpmp' ); ?></p>
			</td>
			<td>
				<select name="settings[custom-homepage]">
					<option value='' <?php selected( '', $settings['custom-homepage'] ) ?>><?php _e( 'WordPress Reading Settings', 'wpmp' ) ?></option>
					<?php foreach ( $pages as $page ): ?>
						<option value="<?php echo $page->ID ?>" <?php selected( $page->ID, $settings['custom-homepage'] ) ?>>
							<?php echo $page->post_title ?>
						</option>
					<?php endforeach; ?>
				</select>
			</td>
			
		</tr>

		<tr id="footer-text">
			
			<td class="label">
				<label>
					<?php _e( 'Footer Text', 'wpmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<input type="text" name="settings[footer-text]" value="<?php echo $settings['footer-text'] ?>" />
			</td>
			
		</tr>

		<tr id="switch-to-desktop-text">
			
			<td class="label">
				<label>
					<?php _e( 'Switch To Desktop Text', 'wpmp' ); ?>
				</label>
				<p class="description"><?php _e( 'The text link will be shown in the footer of the mobile site only to mobile visitors', 'wpmp' ) ?></p>
			</td>
			<td>
				<input type="text" name="settings[switch-to-desktop-text]" value="<?php echo $settings['switch-to-desktop-text'] ?>" />
			</td>
			
		</tr>

		<tr id="switch-to-mobile-text">
			
			<td class="label">
				<label>
					<?php _e( 'Switch To Mobile Text', 'wpmp' ); ?>
				</label>
				<p class="description"><?php _e( 'The text link will only be shown on the desktop site visited by mobile visitors', 'wpmp' ) ?></p>
			</td>
			<td>
				<input type="text" name="settings[switch-to-mobile-text]" value="<?php echo $settings['switch-to-mobile-text'] ?>" />
			</td>
			
		</tr>

		<?php do_action( 'wpmp_general_meta_box_end', $settings ); ?>

	</tbody>

</table>