<?php

define( 'MOBILE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'MOBILE_PLUGIN_DIR_NAME', dirname( plugin_basename( __FILE__ ) ) );

define( 'MOBILE_PLUGIN_PREFIX', 'wpmp' ); //WP Mobile Plugin

define( 'MOBILE_PLUGIN_MOBILE_POST_TYPE', MOBILE_PLUGIN_PREFIX . '_post' );

define( 'MOBILE_PLUGIN_INCLUDE_DIRECTORY_NAME', 'includes' );

define( 'MOBILE_PLUGIN_VIEW_DIRECTORY_NAME', 'views' );

define( 'MOBILE_PLUGIN_CSS_DIRECTORY_NAME', 'css' );

define( 'MOBILE_PLUGIN_JS_DIRECTORY_NAME', 'js' );

define( 'MOBILE_PLUGIN_INCLUDE_DIRECTORY', MOBILE_PLUGIN_PATH .
									  	MOBILE_PLUGIN_INCLUDE_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'MOBILE_PLUGIN_VIEW_DIRECTORY', MOBILE_PLUGIN_PATH .
									  	MOBILE_PLUGIN_VIEW_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'MOBILE_PLUGIN_CSS_DIRECTORY', MOBILE_PLUGIN_PATH .
									  	MOBILE_PLUGIN_CSS_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'MOBILE_PLUGIN_JS_DIRECTORY', MOBILE_PLUGIN_PATH .
									  	MOBILE_PLUGIN_JS_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'MOBILE_PLUGIN_MAIN_FILE', MOBILE_PLUGIN_PATH . 'wp-mobile.php' );

define( 'MOBILE_PLUGIN_MOBILE_ONLY_SHORTCODE', 'mobile_only' );

define( 'MOBILE_PLUGIN_VERSION', '0.3' );