<?php
// Archive Content
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">
		
		<?php if ( has_post_thumbnail() ): ?>

			<div class="col-md-4 single-thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail() ?></a>
			</div>

			<div class="col-md-8">

		<?php else: ?>
			<div class="col-md-12">
		<?php endif ?>

				<header>

					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h2>

					<?php if ( 'page' != get_post_type() ): ?>
						<div class="published-time"><?php echo get_the_date(); ?></div>
					<?php endif; ?>

					<div class="clear"></div>

				</header>

				<div class="entry-summary">
					<?php the_content(); ?>
				</div>

				<footer>
					
					<?php if ( comments_open() || get_comments_number() != 0 ): ?>
						<div class="comments-count">
							<i class="fa fa-comments"></i>	<?php comments_popup_link( __( 'No comments.', THEMENAME ), __( '1 Comment', THEMENAME ), __( '% Comments', THEMENAME ) ) ?>
						</div> <!-- .entry-comments -->
					<?php endif; ?>

					<?php theme_share_post(); ?>

				</footer>

			</div>

	</div>

</article><!-- #post-<?php the_ID() ?> -->