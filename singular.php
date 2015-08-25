<?php
get_header();

if ( have_posts() ):

	while ( have_posts() ):
		
		the_post();
		get_template_part( 'templates/single', get_post_type() );

		if ( comments_open() || get_comments_number() != 0 ):
			comments_template();
		endif;

	endwhile;

else:

	get_template_part( 'templates/single', '404' );

endif;

get_footer();