<table class="form-table" style="display: table;">
	<tbody>

		<tr valign="top">
			<th scope="row"><?php _e( 'Logo', 'wpmp' ) ?></th>
			<td>

				<input type="text" id="logo_url" value="<?php echo $theme_settings['logo_url'] ?>" name="theme[logo_url]">

				<a class="button" id="add_logo_image" href="#logo">
					<?php _e( 'Add Image', SLIDER_PLUGIN_PREFIX ) ?>
				</a>
				<p class="description"><?php _e( 'Set the logo field empty to show text based logo', 'wpmp' ); ?></p>
				
			</td>
		 </tr>

		 <tr valign="top">
			<th scope="row"><?php _e( 'Homepage subtitle', 'wpmp' ) ?></th>
			<td>

				<input type="text" size="33" id="homepage_subtitle" value="<?php echo $theme_settings['homepage_subtitle'] ?>" name="theme[homepage_subtitle]">
				
			</td>
		 </tr>

		 <tr valign="top">
		 	<th scope="row"><?php submit_button( __( 'Save Settings', 'wpmp' ), 'primary large', 'submit', false ) ?></th>
		 	<td></td>
		 </tr>


	</tbody>
</table>

<script>
jQuery(function ($) {
	window.send_to_editor = function(html) {

		var image_url = $('img',html).attr('src');

		if ( image_url === undefined  )
			image_url = $(html).attr('src');

		$('#logo_url').attr('value', image_url);

		tb_remove();

	}

	$('#add_logo_image').click(function(e) {

		e.preventDefault();

		var image_input = $(this).attr('href');

		tb_show('Add Image', 'media-upload.php?referer=post.php&post_id=0&type=image&TB_iframe=true', false);

	});
});
</script>