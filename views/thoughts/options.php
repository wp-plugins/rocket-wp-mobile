<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = 'options_wpex_themes';
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();
	
	
	//GENERAL
	
	$options[] = array(
		'name' => __('General', 'options_framework_theme'),
		'type' => 'heading');
		
	$options['custom_logo'] = array(
		'name' => __('Custom Logo', 'options_framework_theme'),
		'desc' => __('Upload your custom logo.', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_logo',
		'type' => 'upload');
		
	$options['custom_favicon'] = array(
		'name' => __('Custom Favicon', 'options_framework_theme'),
		'desc' => __('Upload your custom site favicon.', 'options_framework_theme'),
		'id' => 'custom_favicon',
		'type' => 'upload');
	
	$options['home_subtitle'] = array(
		'name' => __('Homepage Subtitle', 'options_framework_theme'),
		'desc' => __('Check box to enable the responsive layout.', 'options_framework_theme'),
		'id' => 'home_subtitle',
		'std' => __('Welcome To Blog of AJ Clarke','wpex'),
		'type' => 'text');
		
	//ABOUT
	
	$options[] = array(
		'name' => __('About', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Theme Credit', 'options_framework_theme'),
		'desc' => 'This theme was created by AJ Clarke from <a href="http://www.wpexplorer.com">WPExplorer.com</a>.',
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Support? Donations?', 'options_framework_theme'),
		'desc' => 'If you love this free themes and wish to give back, you should consider purchasing one of my <a href="http://themeforest.net/user/WPExplorer?ref=wpexplorer">Premium Themes</a>. This way you can support me and get another great theme!<br /><br /> Thank you very much ;)',
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Newsletter', 'options_framework_theme'),
		'desc' => 'To hear about new WordPress theme releases, tutorials, guides...and other great content from WPExplorer.com, you can <a href="http://wpexplorer.com/newsletter">subscribe to our Newsletter</a>',
		'type' => 'info');


	return $options;
}


/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php } ?>