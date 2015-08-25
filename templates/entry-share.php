<?php
/**
 * Entry share template
 */
?>

<div class="entry-share">
	<a href="https://twitter.com/intent/tweet?text=<?php the_title_attribute() ?> - <?php echo esc_attr( get_bloginfo( 'title', 'display' ) ) ?> <?php echo wp_get_shortlink() ?>" class="popup tw button icon" title="<?php echo _e( 'share it', 'rnv' ) ?>">
		<i class="fa fa-twitter"></i>
	</a>

	<a href="https://www.facebook.com/sharer.php?u=<?php echo wp_get_shortlink() ?>&t=<?php the_title_attribute() ?> - <?php echo esc_attr( get_bloginfo( 'title', 'display' ) ) ?>" class="popup fb button icon" title="<?php echo _e( 'share it', 'rnv' ) ?>">
		<i class="fa fa-facebook"></i>
	</a>

	<a href="https://plus.google.com/share?url=<?php echo wp_get_shortlink() ?>" class="popup gp button icon" title="<?php echo _e( 'share it', 'rnv' ) ?>">
		<i class="fa fa-google-plus"></i>
	</a>
</div> <!-- .entry-share -->