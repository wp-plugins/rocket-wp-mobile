<?php
/**
Plugin Name: WP Mobile Plugin
Plugin URI: http://rocketplugins.com/wordpress-mobile-plugin/
Description: All in one mobile solution for your WordPress powered blog or site
Author: Muneeb
Author URI: http://rocketplugins.com/wordpress-mobile-plugin/
Version: 0.2
Copyright: 2013 Muneeb ur Rehman http://muneeb.me
**/

require plugin_dir_path( __FILE__ ) . 'config.php';

require MOBILE_PLUGIN_INCLUDE_DIRECTORY . 'functions.php';

load_wpmp();

