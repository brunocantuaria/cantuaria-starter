<?php
get_header();

if ( have_posts() ):
	
	theme_archive_title();

	while ( have_posts() ):
		the_post();
		get_template_part( 'templates/archive', get_post_type() );
	endwhile;

	theme_content_nav();

else:

	get_template_part( 'templates/single', '404' );

endif;

get_footer();