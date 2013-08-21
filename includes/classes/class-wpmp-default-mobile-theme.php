<?php

class Wpmp_Default_Mobile_Theme extends Wpmp_Theme_Handler {

	protected $name = 'Thoughts - Default Theme';

	protected $description = 'Simple and Beautiful mobile theme for WP Mobile';

	protected $id = 'thoughts';

	protected $path = '';

	protected $type = 'realtheme';

	protected $template_name = 'thoughts';

	function init() {

		$this->path =  MOBILE_PLUGIN_VIEW_DIRECTORY . 'thoughts/';
	
	}

	function theme_settings() {

		$theme_settings = wpmp_get_active_theme_settings();

		if ( ! $theme_settings ) {

			$theme_settings = $this->default_settings();

		}

		include wpmp_view_path( 'thoughts/theme-settings' );

	}

	function default_settings() {

		return array(
				'logo_url' => NULL,
				'homepage_subtitle' => 'WELCOME TO BLOG OF AJ CLARKE'
			);

	}

}
