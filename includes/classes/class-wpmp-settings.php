<?php

class Wpmp_Settings {

	function __construct() {

		if ( ! get_option( 'wpmp_settings' ) ) {

			$settings = $this->default_settings();

			add_option( 'wpmp_settings', $settings, '', 'yes' );

		}

		if ( ! get_option( 'wpmp_theme_settings' ) ) {

			add_option( 'wpmp_theme_settings', array(), '', 'yes' );

		}

		$this->hooks();

		$this->filters();

	}

	function hooks() {

		add_action( 'admin_menu', array( $this, 'add_menu' ) );

		add_action( 'init', array( $this, 'add_css_js_assets' ) );

		add_action( 'wp_ajax_wpmp_reset_settings', array( $this, 'reset_settings' ) );

		add_action( 'init', array( $this, 'plugin_activation_notice' ) );

	}

	function filters() {


	}

	function add_menu() {

		$parent_slug = 'options-general.php';

		$page_title = __( 'WP Mobile Settings', 'wpmp' );

		$menu_title = __( 'WP Mobile', 'wpmp' );

		$capability = 'manage_options';

		$menu_slug = 'wp-mobile-settings';

		add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, array( $this, 'settings_page' ) );

	}

	function add_meta_boxes() {
		
		add_meta_box( 
			'general-settings',
			__( 'General', 'wpmp' ),
			array( $this, 'general_settings_meta_box' ),
			'wpmp_settings_page',
			'normal'
		);

	}

	function add_css_js_assets() {

		if ( ! isset( $_GET['page'] ) )
			return FALSE;

		if ( ! $_GET['page'] == 'wp-mobile-settings' )
			return FALSE;

		wp_enqueue_style( 'thickbox' );

		wp_enqueue_script( 'thickbox' );

		wp_enqueue_style( 'wpmp-settings', 
			plugins_url( 'css/admin-settings.css', MOBILE_PLUGIN_MAIN_FILE ) );

		wp_enqueue_script( 'wpmp-settings', 
			plugins_url( 'js/admin-settings.js', MOBILE_PLUGIN_MAIN_FILE ) );

		$translation_array = array( 
				'confirm_reset' => __( 'Are you sure you want to reset the settings ?', 'wpmp' ),
				'successfull_reset' => __( 'The settings have been restored to the default settings', 'wpmp' ),
				'reset_nonce' => wp_create_nonce( 'wpmp_reset_nonce' ),
				'ajax_url' => admin_url( 'admin-ajax.php' )
			);
		
		wp_localize_script( 'wpmp-settings', 'wpmpjs', $translation_array );

	}

	function settings_page() {

		if ( isset( $_POST['submit'] ) )
			$this->save_settings();

		if ( ! isset( $_GET['tab'] ) )
			$this->admin_tabs();
		else
			$this->admin_tabs( $_GET['tab'] );

		$nonce = wp_create_nonce( 'wpmp_settings_page_nonce' );

		$settings = $this->get_settings();

		$themes = wpmp_get_themes();

		$this->add_meta_boxes();

		if ( ! isset( $_GET['tab'] ) )
			include wpmp_settings_part( 'settings' );
		else
			include wpmp_settings_part( $_GET['tab'] );

	}

	function save_settings() {

		if ( ! current_user_can( 'manage_options' ) )
			wp_die( 'You are not allowed to change plugin options' );

		if ( ! wp_verify_nonce( $_POST['nonce'], 'wpmp_settings_page_nonce' ) )
			wp_die( 'Invalid Nonce' );

		$tab = 'settings';

		if ( ! isset( $_GET['tab'] ) )
			$_GET['tab'] = 'settings';

		if ( $_GET['tab'] == 'tab-theme-settings' )
			$tab = 'tab-theme-settings';

		if ( $tab == 'settings' ) {

			$settings = $_POST['settings'];

			$settings = apply_filters( 'wpmp_settings_before_save', $settings );
			
			update_option( 'wpmp_settings', $settings );

		}

		if ( $tab == 'tab-theme-settings' ) {

			$theme_settings = wpmp_get_theme_settings();

			$current_theme = wpmp_get_active_theme();

			$theme_settings[$current_theme] = $_POST['theme'];

			$theme_settings = apply_filters( 'wpmp_theme_settings_before_save' , $theme_settings, $current_theme );

			update_option( 'wpmp_theme_settings', $theme_settings );

		}

		include wpmp_settings_part( 'settings-saved' );;
	}

	function reset_settings() {

		if ( ! current_user_can( 'manage_options' ) )
			exit( '1' );

		if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'wpmp_reset_nonce' ) )
			exit( '2' );

		if ( ! isset( $_REQUEST['which-settings'] ) )
			$_REQUEST['which-settings'] = 'settings';

		$which_settings = $_REQUEST['which-settings'];

		if ( $which_settings == 'settings' )
			update_option( 'wpmp_settings', $this->default_settings() );

		exit( '10' );

	}

	function default_settings() {

		$default_settings = array(
				'status' => 'disabled',
				'theme' => 'thoughts',
				'footer-text' => __( 'All content © Copyright', 'wpmp' ),
				'switch-to-desktop-text' => __( 'SWITCH TO DESKTOP SITE', 'wpmp' ),
				'switch-to-mobile-text' => __( 'SWITCH TO MOBILE SITE', 'wpmp' ),
				'custom-homepage' => ''
			);

		return apply_filters( 'wpmp_default_settings', $default_settings );

	}

	public static function get_settings() {

		$settings = get_option( 'wpmp_settings' );

		return apply_filters( 'wpmp_settings', $settings );

	}

	function admin_tabs( $current = 'settings' ) {
	    
	    $tabs = array( 
	    		'settings' => __( 'Settings', 'wpmp' ), 
	    		'tab-theme-settings' => __( 'Theme Settings', 'wpmp' )
	    	);

	    echo '<div id="icon-themes" class="icon32"><br></div>';
	    
	    echo '<h2 class="nav-tab-wrapper">';
	    
	    foreach( $tabs as $tab => $name ){
	        
	        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
	        
	        echo "<a class='nav-tab$class' href='?page=wp-mobile-settings&tab=$tab'>$name</a>";

	    }

	    echo '</h2>';
	}

	function general_settings_meta_box( $settings ) {

		$themes = wpmp_get_themes();

		$pages = get_pages();

		include wpmp_settings_part( 'general-meta-box.php' );

	}


	function plugin_activation_notice() {

		if ( get_option( 'wp-mobile-activation-notice' ) )
			return FALSE;

		if ( isset( $_REQUEST['page'] ) ) {

			if ( $_REQUEST['page'] == 'wp-mobile-settings' ) {

				add_option( 'wp-mobile-activation-notice', 'showed', '', 'yes' );

				return FALSE;

			}

		}

		$settings_link = admin_url( 'options-general.php?page=wp-mobile-settings' );

		include wpmp_view_path( 'admin-settings/plugin_actiavtion_notice' );

	}

}