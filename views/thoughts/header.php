<?php
/**
 * Header.php is generally used on all the pages of your site and is called somewhere near the top
 * of your template files. It's a very important file that should never be deleted.
 * @package Thoughts WordPress Theme
 * @since 1.0
 * @author AJ Clarke : http://wpexplorer.com
 * @copyright Copyright (c) 2012, AJ Clarke
 * @link http://wpexplorer.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
global $data; // Get theme options to use throught the theme templates
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<?php wpex_hook_head_top(); ?>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    
    <!-- Mobile Specific
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    
    <!-- Title Tag
    ================================================== -->
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' -'; } ?> <?php bloginfo('name'); ?></title>
    
	<?php if( of_get_option('custom_favicon') ) { ?>
    <!-- Favicon
    ================================================== -->
    <link rel="icon" type="image/png" href="<?php echo $data['custom_favicon']; ?>" />
    <?php } ?>
    
    <!-- IE dependent stylesheets
    ================================================== -->
    <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/awesome_font_ie7.css" media="screen" />
    <![endif]-->
    
    <!-- Load HTML5 dependancies for IE
    ================================================== -->
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lte IE 7]>
        <script src="js/IE8.js" type="text/javascript"></script><![endif]-->
      
    <!-- WP Head
    ================================================== -->
    <?php wp_head(); // Very important WordPress core hook. If you delete this bad things WILL happen. ?>
    <?php wpex_hook_head_bottom(); ?>
    
</head><!-- /end head -->


<!-- Begin Body
================================================== -->
<body <?php body_class(); ?>>

<div id="wrap" class="clearfix">

	<div id="header-wrap">
    	<?php wpex_hook_header_before(); ?>
        <header id="header" class="clearfix">
       		<?php wpex_hook_header_top(); ?>
            <div id="logo">
                <?php
                // Show custom image logo if defined in the admin
                $logo_url = wpmp_get_single_theme_setting( 'logo_url');
                
                if( ! empty( $logo_url ) ) { ?>
                    <a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo $logo_url; ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
                <?php }
                // No custom img logo - show text logo
                    else { ?>
                     <h2><a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
                <?php } ?>
            </div><!-- /logo -->
            <nav id="navigation" class="clearfix">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'primary_mobile',
                        'sort_column' => 'menu_order',
                        'menu_class' => 'sf-menu',
                        'fallback_cb' => false
                    )); ?>
            </nav><!-- /navigation -->
    		<?php wpex_hook_header_bottom(); ?>
        </header><!-- /header -->
        <?php wpex_hook_header_after(); ?>
    </div><!-- /header-wrap -->
    
    <?php wpex_hook_content_before(); ?>
    <div id="main-content" class="clearfix">
    <?php wpex_hook_content_top(); ?>
	
    <?php
	if ( is_front_page() ) { 
		// Display subtitle if defined in the options panel
		if ( wpmp_get_single_theme_setting('homepage_subtitle') !== '' ) {
			// Display subtitle as long as it's not a paginated page
			if ( !is_paged() ) {
			?>
			<header id="homepage-header">
				<h1 id="homepage-title"><span class="wpex-icon-bullhorn"></span><?php echo wpmp_get_single_theme_setting('homepage_subtitle') ?></h1>
				<?php get_search_form(); ?>
			</header><!-- /homepage-header -->
		<?php }
		}
	} ?>