<?php

class Wpmp_Theme_Handler {

	protected $name;

	protected $description;

	protected $id;

	protected $path;

	protected $type;

	protected $template_name;

	protected $stylesheet_path = null;

	function __construct() {

		$this->_hooks();

		$this->_filters();

		$this->hooks();

		$this->filters();

		$this->init();

	}

	function init() {


	}

	function hooks() {



	}

	function filters() {


	}

	private function _filters() {

		add_filter( 'wpmp_themes', array( $this, 'register_theme' ) );

		add_filter( 'option_show_on_front', array( $this, 'set_show_on_front_option' ), 1, 99 );

		add_filter( 'option_page_on_front', array( $this, 'set_page_on_front_option' ), 1, 99 );

		if ( $this->is_activated() && $this->check_rules() 
			&& $this->type === 'realtheme' )
				$this->theme_change();

		if ( $this->is_activated() && $this->check_rules() 
			&& $this->type === 'plugintheme' )
				add_filter( 'template_include', 
					array( $this, 'template_include' ) );

	}

	private function _hooks() {

		register_nav_menu( 'primary_mobile', 'Primary WP Mobile Theme Menu' );

		$this->handle_theme_switch();

		add_action( 'wp_footer', array( $this, 'switch_to_mobile_link' ) );

		if ( $this->is_activated() )
			add_action( 'wpmp_current_theme_settings', array( $this, 'theme_settings' ) );
 
	}

	public function name( $name = '' ) {

		if (  empty( $name ) )
			return $this->name;

		$this->name = $name;

	}

	public function description( $description = '' ) {

		if (  empty( $description ) )
			return $this->description;

		$this->description = $description;

	}

	public function id( $id = '' ) {

		if (  empty( $id ) )
			return $this->id;

		$this->id = $id;

	}

	function register_theme( $themes ) {

		if ( isset( $themes[$this->id] ) )
			return $themes;

		$themes[$this->id] = $this;

		return $themes;

	}

	public function is_activated( $theme_id = '' ) {

		if ( empty( $id ) )
			$id = $this->id();

		$theme = wpmp_get_active_theme( $theme_id );

		return $theme == $id;

	}

	public function check_rules( $theme_id = '' ) {
		
		if ( empty( $id ) )
			$id = $this->id();

		$is_mobile = $this->is_mobile();

		if ( ! $is_mobile )
			return apply_filters( 'wpmp_check_rules', FALSE, 'is_mobile' );

		if ( isset( $_COOKIE['wpmp-desktop-mode'] ) )
			return apply_filters( 'wpmp_check_rules', FALSE, 'desktop_mode' );

		$settings = wpmp_get_settings();

		if ( $settings['status'] !== 'enabled' )
			return apply_filters( 'wpmp_check_rules', FALSE, 'disabled' );

		return apply_filters( 'wpmp_check_rules', TRUE, 'success' );

	}

	public function is_mobile() {

		$detect = new Mobile_Detect;

		return $detect->isMobile() && !$detect->isTablet();

	}

	function theme_change() {

		if ( is_admin() )
			return FALSE;

		add_filter( 'theme_root', array( $this, 'change_theme_root' ) );

		add_filter( 'stylesheet_directory_uri', array( $this, 'change_stylesheet_directory_uri' ) );

		add_filter( 'template_directory_uri', array( $this, 'change_stylesheet_directory_uri' ) );

		add_filter( 'template', array( $this, 'template_filter' ) );
		
		add_filter( 'stylesheet', array( $this, 'template_filter' ) );

	}

	function theme_settings() {

		_e( 'The current selected/activated mobile theme do not have any settings or the theme might not have support for this feature.', 'wpmp' );

	}

	function switch_to_mobile_link() {

		/*Footer message with link asking to switch to mobile site 
		will be shown on the desktop theme for mobile visitors only*/

		if ( ! isset( $_COOKIE['wpmp-desktop-mode'] ) )
			return FALSE;

		$settings = wpmp_get_settings();

		if ( $settings['status'] !== 'enabled' )
			return FALSE;

		if ( ! $this->is_mobile() )
			return FALSE;
		
		$footer_text = wpmp_get_single_setting( 'switch-to-mobile-text' );

		if ( empty( $footer_text ) )
			return FALSE;
		
		include wpmp_view_path( 'switch-to-mobile' ); 
	
	}

	function change_theme_root() {
		
		return MOBILE_PLUGIN_VIEW_DIRECTORY;

	}

	function change_stylesheet_directory_uri() {

		return plugins_url( 'views/thoughts', MOBILE_PLUGIN_MAIN_FILE );

	}

	function handle_theme_switch() {

		if ( isset( $_GET['wp-mobile-switch'] ) ) {

			if ( $_GET['wp-mobile-switch'] === 'desktop' ) {

				setcookie( 'wpmp-desktop-mode', true, time()+3600*6, '/' );

				$_COOKIE['wpmp-desktop-mode'] = true;

			}

			if ( $_GET['wp-mobile-switch'] === 'mobile' ) {

				setcookie( 'wpmp-desktop-mode', true, time()-100, '/' );

				unset( $_COOKIE['wpmp-desktop-mode'] );

			}
		
		}


	}

	function set_show_on_front_option( $option ) {

		if ( ! $this->is_mobile() )
			return $option;
		
		$settings = wpmp_get_settings();

		if ( $settings['status'] !== 'enabled' )
			return FALSE;

		if ( empty( $settings['custom-homepage'] ) || isset( $settings['custom-homepage'] ) )
			return $option;

		return 'page';

	}

	function set_page_on_front_option( $option ) {

		if ( ! $this->is_mobile() )
			return $option;

		$settings = wpmp_get_settings();

		if ( $settings['status'] !== 'enabled' )
			return FALSE;

		if ( empty( $settings['custom-homepage'] ) || isset( $settings['custom-homepage'] ) )
			return $option;

		$page_id = $settings['custom-homepage'];

		if ( ! get_post( $page_id ) )
			return $option;

		return $page_id;

	}


	function template_filter() {

		return $this->template_name;

	}

	function template_include( $template ) {

		return $template;

	}

	function get_header() {

		include $this->path . 'header.php';

	}

	function get_footer() {

		include $this->path . 'footer.php';

	}

	function get_sidebar() {

		include $this->path . 'sidebar.php';

	}

	function comments_template() {

		include $this->path . 'comments.php';

	}

	function get_template_part( $template_name ) {

		include $this->path . $template_name;

	}

	function get_search_form() {

		include $this->path . 'searchform.php';

	}

	function get_404_template() {

		include $this->path . '404.php';

	}

	function get_home_template() {

		include $this->path . 'home.php';

	}

	function get_front_page_template() {

		include $this->path . 'front_page.php';
		
	}

}