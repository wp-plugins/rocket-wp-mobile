<?php

function load_wpmp() {

	load_wpmp_classes();

	//Plugin loaded
	do_action( 'wpmp_loaded' );

}

function load_wpmp_classes() {

	wpmp_include( 'classes/class-wpmp-theme-handler.php' );
	wpmp_include( 'classes/class-wpmp-default-mobile-theme.php' );
	wpmp_include( 'classes/class-wpmp-settings.php' );

	new Wpmp_Settings();

	if ( ! class_exists( 'Mobile_Detect' ) )
		wpmp_include( 'libs/Mobile_Detect.php' );

	//Register and init the default popup theme
	new Wpmp_Default_Mobile_Theme();

}

function wpmp_include( $file_name, $require = true ) {

	if ( $require )
		require MOBILE_PLUGIN_INCLUDE_DIRECTORY . $file_name;
	else
		include MOBILE_PLUGIN_INCLUDE_DIRECTORY . $file_name;

}

function wpmp_view_path( $view_name, $is_php = true ) {

	if ( strpos( $view_name, '.php' ) === FALSE && $is_php )
		return MOBILE_PLUGIN_VIEW_DIRECTORY . $view_name . '.php';

	return MOBILE_PLUGIN_VIEW_DIRECTORY . $view_name;

}

function wpmp_settings_part( $view_name, $is_php = true ) {

	return wpmp_view_path( 'admin-settings/' . $view_name, $is_php );

}

function wpmp_image_url( $image_name ) {

	return plugins_url( 'images/' . $image_name, MOBILE_PLUGIN_MAIN_FILE );

}

function wpmp_get_themes() {

	$themes = array();

	return apply_filters( 'wpmp_themes' , $themes );

}

function wpmp_get_settings() {

	return Wpmp_Settings::get_settings();

}

function wpmp_get_single_setting( $key ) {

	$settings = wpmp_get_settings();

	if ( ! isset( $settings[$key] ) )
		return apply_filters( 'wpmp_get_single_setting', NULL );

	return apply_filters( 'wpmp_get_single_setting', $settings[$key] ); 

}

function wpmp_get_active_theme() {

	$theme = wpmp_get_single_setting( 'theme' );

	return apply_filters( 'wpmp_get_active_theme', $theme );
	
}

function wpmp_get_theme_settings() {

	$settings = get_option( 'wpmp_theme_settings' );

	return apply_filters( 'wpmp_get_theme_settings', $settings );

}

function wpmp_get_active_theme_settings() {

	$settings = wpmp_get_theme_settings();

	$active_theme = wpmp_get_active_theme();

	if ( isset( $settings[$active_theme] ) )
		return apply_filters( 'wpmp_get_active_theme_settings',
							  $settings[$active_theme], $active_theme );

	return apply_filters( 'wpmp_get_active_theme_settings', NULL, $active_theme );

}

function wpmp_get_single_theme_setting( $key ) {

	$settings = wpmp_get_theme_settings();

	$active_theme = wpmp_get_active_theme();

	if ( isset( $settings[$active_theme][$key] ) )
		return apply_filters( 'wpmp_get_single_theme_setting', $settings[$active_theme][$key], $active_theme );

	return apply_filters( 'wpmp_get_single_theme_setting', NULL, $active_theme );

}