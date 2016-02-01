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
 * Functions to add javascript page template detector to CMB
 */
function theme_admin_css() {
	?>
	<style type="text/css">
		.cmb-type-pagetemplate-show {
			display: none !important;
		}
	</style>
	<?php
}
add_action('admin_enqueue_scripts', 'theme_admin_css', 10 );

function theme_admin_scripts() {
    wp_register_script( 'cmb2-custom-theme', get_template_directory_uri() . '/assets/js/admin.min.js' );
}
add_action( 'admin_init', 'theme_admin_scripts' );

function cmb2_render_pagetemplate_show_function( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {

    ?>
    <script type="text/javascript">
    jQuery(document).ready( function($){
        var checking = "<?php echo $field->args['id']; ?>",
            block = $(".cmb2-id-"+checking).closest('.postbox');
        block.addClass( 'only-in-page-template' );
        block.addClass( 'only-in-' + checking );

        <?php if ($field->args['options']['content'] == 'hide') { ?>

        block.addClass( 'hide-content' );

        <?php } ?>

        <?php if ($field->args['options']['title'] == 'hide') { ?>

        block.addClass( 'hide-title' );

        <?php } ?>
    });
    </script>
    <?php

    wp_enqueue_script( 'cmb2-custom-theme' );
    
}
add_action( 'cmb2_render_pagetemplate_show', 'cmb2_render_pagetemplate_show_function', 10, 5 );


/*
 * Admin customize
 */
function theme_admin_footer_copy() {
	_e('<span id="footer-thankyou">Developed by <a href="http://cantuaria.net.br" target="_blank">Bruno Cantuaria</a></span>.', THEMENAME);
}
add_filter('admin_footer_text', 'theme_admin_footer_copy');