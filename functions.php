<?php
//Main Vars
define(THEMENAME, 'cantuaria');
define(THEMEVERSION, '0.1.2');

global $sidebar;
$sidebar = false;


//Theme Setup
require_once( get_template_directory() . '/core/essentials.php' );
require_once( get_template_directory() . '/core/helpers.php' );
require_once( get_template_directory() . '/core/admin.php' );


//Checking for CMB2
add_action( 'admin_notices', 'theme_check_plugin_deps');
function theme_check_plugin_deps() {
	if (!is_plugin_active( 'cmb2/init.php' )) {
		add_thickbox();
		$url = admin_url() . '/plugin-install.php?tab=plugin-information&amp;plugin=cmb2&amp;TB_iframe=true&amp;width=772&amp;height=932';
		echo '<div class="error"><p>'. sprintf(__('Our theme needs CMB2 plugin Installed. %sPlease install it.%s', THEMENAME), '<a href="'. $url .'" class="thickbox">', '</a>') .'</p></div>';
	}
}
