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

	// Editor style
	add_editor_style( '/assets/css/editor.min.css' );

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
	<!-- Favicons Pack. Generated with http://realfavicongenerator.net/ -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $url; ?>/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $url; ?>/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $url; ?>/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $url; ?>/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $url; ?>/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $url; ?>/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $url; ?>/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $url; ?>/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $url; ?>/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php echo $url; ?>/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo $url; ?>/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo $url; ?>/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo $url; ?>/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo $url; ?>/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo $url; ?>/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<?php

}



//Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'theme_scripts_and_styles' );
function theme_scripts_and_styles() {

	wp_enqueue_style( 'theme-style' , get_template_directory_uri() . '/assets/css/final.min.css' );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'theme-script' , get_template_directory_uri() . '/assets/js/final.min.js' );

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