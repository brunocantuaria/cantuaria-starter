<?php
/*
 * Essential function for theme structure
 */



//Theme elements supports
add_action( 'after_setup_theme', 'theme_prep_support' );
function theme_prep_support() {

	// RSS Support
	add_theme_support( 'automatic-feed-links' );

	// Translation
	load_theme_textdomain( THEMENAME, get_template_directory() . '/lang' );

	// HTML5 Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'thumbnail', 150, 150, array('center', 'center') );

	// Menus
	register_nav_menu( 'topmenu', __( 'Header menu', THEMENAME ) );
	register_nav_menu( 'bottommenu', __( 'Footer menu', THEMENAME ) );

	// Shortcode on Sidebar
	add_filter( 'widget_text', 'do_shortcode' );

}



//Sidebar Support
add_action( 'widgets_init', 'theme_prep_sidebar' );
function theme_prep_sidebar() {

	register_sidebar( 
		array(
			'name' => __( 'Sidebar', THEMENAME ),
			'id' => 'sidebar'
		) 
	);

}



//Print favicons on site Head tag
add_action( 'wp_head', 'theme_favicon_print', 2 );
function theme_favicon_print() {

	$url = get_template_directory_uri() . '/assets/img/favicon';
	?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $url; ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $url; ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $url; ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo $url; ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo $url; ?>/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="<?php echo $url; ?>/favicon.ico">
	<meta name="msapplication-TileColor" content="#603cba">
	<meta name="msapplication-config" content="<?php echo $url; ?>/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<?php

}



//Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'theme_scripts_and_styles' );
function theme_scripts_and_styles() {

	wp_enqueue_style( 'fontawesome' , '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_register_style( 'bootstrap-reboot' , get_template_directory_uri() . '/assets/css/vendor/bootstrap-reboot.css', '', '1.0' );
	wp_register_style( 'bootstrap' , get_template_directory_uri() . '/assets/css/vendor/bootstrap.css', array('bootstrap-reboot'), '1.0' );
	wp_register_style( 'theme-style' , get_template_directory_uri() . '/assets/css/theme.css', array('bootstrap'), THEMEVERSION );

	wp_enqueue_style( 'theme-style' );
	
	wp_enqueue_script( 'bootstrap-js' , get_template_directory_uri() . '/assets/js/vendor/bootstrap.js' );
	wp_register_script( 'theme-script' , get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), THEMEVERSION );
	wp_localize_script( 'theme-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	wp_enqueue_script( 'theme-script' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

}



//Cleaning Header
add_action( 'init', 'theme_clear_head' );
function theme_clear_head() {

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'the_generator', '__return_false' );
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

}



//Search Permalink
add_action( 'template_redirect', 'theme_search_permalink' );
function theme_search_permalink() {
	global $wp_rewrite;

	if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() ) {
		return;
	}

	$search_base = $wp_rewrite->search_base;

	if ( is_search() && !is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
		wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var('s') ) ) );
		exit();
	}
}