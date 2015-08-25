<?php

//Customize Login page
function theme_admin_login_logo() {
	?>
	<style type="text/css">
		.login h1 a {
			background: url(<?php echo get_template_directory_uri() . '/assets/img/logo.png'; ?>);
			background-repeat: no-repeat;
			background-position: top center;
			width: 350px;
			height: 82px;
			text-indent: 200%;
			overflow: hidden;
			margin-bottom: 15px;
			display: block; 
		}
	</style>
	<?php
}
function theme_admin_login_url() {
	return home_url(); 
}
function theme_admin_login_title() { 
	return get_option('blogname'); 
}
add_action('login_enqueue_scripts', 'theme_admin_login_logo', 10 );
add_filter('login_headerurl', 'theme_admin_login_url');
add_filter('login_headertitle', 'theme_admin_login_title');


/*
 * Admin customize
 */
function theme_admin_footer_copy() {
	_e('<span id="footer-thankyou">Developed by <a href="http://cantuaria.net.br" target="_blank">Bruno Cantuaria</a></span>.', THEMENAME);
}
add_filter('admin_footer_text', 'theme_admin_footer_copy');