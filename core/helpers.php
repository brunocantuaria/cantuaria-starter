<?php

/**
 * Pagination
 * by Hugo Wantuil (@hugw)
 */
if ( ! function_exists( 'theme_content_nav' ) ) {
	function theme_content_nav( $pages = '', $range = 3 ) {
		$showitems = ( $range * 2 ) + 1;  

		global $paged;
		if( empty( $paged ) ) $paged = 1;

		if( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;

			if( !$pages ) $pages = 1;
		}   

		if( 1 != $pages ) {
			echo '<div class="pagination">';
				if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<a href='".get_pagenum_link( 1 )."'>&laquo;</a>";
				if( $paged > 1 && $showitems < $pages ) echo "<a href='".get_pagenum_link( $paged - 1 )."' class='button'>&lsaquo;</a> ";

				for ( $i=1; $i <= $pages; $i++ ) {
					if ( 1 != $pages && ( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
						echo ( $paged == $i ) ? "<a href='javascript:void(0);' class='current button'>".$i."</a> ":"<a href='".get_pagenum_link( $i )."' class='button' >".$i."</a> ";
					}
				}

				if ( $paged < $pages && $showitems < $pages ) echo "<a href='".get_pagenum_link( $paged + 1 )."' class='button'>&rsaquo;</a> ";  
				if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) echo "<a href='".get_pagenum_link( $pages )."' class='button'>&raquo;</a> ";
			echo "</div> <!-- .pagination --> \n";
		}
	}
}



//Share Buttons
if ( ! function_exists( 'theme_share_post' ) ) {
	function theme_share_post() {

		?>
		<div class="single-share">
			<a href="https://twitter.com/intent/tweet?text=<?php the_title_attribute() ?> - <?php echo esc_attr( get_bloginfo( 'title', 'display' ) ) ?> <?php echo wp_get_shortlink() ?>" class="popup tw button icon" title="<?php echo _e( 'share it', 'rnv' ) ?>">
				<i class="fa fa-twitter"></i>
			</a>

			<a href="https://www.facebook.com/sharer.php?u=<?php echo wp_get_shortlink() ?>&t=<?php the_title_attribute() ?> - <?php echo esc_attr( get_bloginfo( 'title', 'display' ) ) ?>" class="popup fb button icon" title="<?php echo _e( 'share it', 'rnv' ) ?>">
				<i class="fa fa-facebook"></i>
			</a>

			<a href="https://plus.google.com/share?url=<?php echo wp_get_shortlink() ?>" class="popup gp button icon" title="<?php echo _e( 'share it', 'rnv' ) ?>">
				<i class="fa fa-google-plus"></i>
			</a>
		</div> <!-- .single-share -->
		<?php

	}
}



//Archive Title
if ( ! function_exists( 'theme_archive_title' ) ) {
	function theme_archive_title( $desc = false ) {

		?><header class="page-header">
			<h1 class="page-title">
				<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					printf( __( 'Author: %s', THEMENAME ), '<span class="vcard">' . get_the_author() . '</span>' );

				elseif ( is_day() ) :
					printf( __( 'Day: %s', THEMENAME ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', THEMENAME ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', THEMENAME ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				elseif ( is_search() ) :
					printf( __( 'Search Results for: %s', THEMENAME ), '<span>' . get_search_query() . '</span>' );
				else :
					_e( 'Archives', THEMENAME );
				endif;
				?>
			</h1> <!-- .page-title -->
			
			<?php
			if ($desc) {
				$term_description = term_description();
				if ( ! empty( $term_description ) ):
					printf( '<h2 class="page-description">%s</h2> <!-- .page-description -->', $term_description );
				endif;
			}
			?>
		</header> <!-- .page-header -->
		<?php
	}
}



//Print image
if ( ! function_exists( 'theme_image' ) ) {
	function theme_image( $img, $alt = false, $width = false, $height = false, $style = false, $echo = true ) {

		$return = '<img src="'. get_template_directory_uri() . '/assets/img/'. $img .'"';

		if ($width !== false)
			$return .= ' width="'. $width .'"';

		if ($height !== false)
			$return .= ' height="'. $height .'"';

		if ($style !== false)
			$return .= ' style="'. $style .'"';

		$return .= " />";

		if ($echo === true)
			echo $return;
		else
			return $return;

	}
}



//Calling Menu with Bootstrap structure
if ( ! function_exists( 'theme_menu' ) ) {
	function theme_menu( $theme_location, $append = 'pills' ) {

		wp_nav_menu( array( 
			'theme_location' => $theme_location,
			'container' => false,
			'menu_class' => 'nav nav-'. $append,
			'fallback_cb' => false,
			)
		);

	}
}