<?php
// Single Content
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">
		
		<?php if ( has_post_thumbnail() ): ?>

			<div class="col-12 single-thumbnail">
				<?php the_post_thumbnail() ?>
			</div>

		<?php endif; ?>

		<div class="col-12">

			<header>
		
				<div class="row">
					
					<h2 class="col-8 col-md-10"><?php the_title(); ?></h2>

					<div class="col"><?php echo get_the_date(); ?></div>

				</div>

			</header>

			<div class="single-content">
				<?php the_content(); ?>
			</div>

			<footer>

				<div class="single-author">
					<i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author"><?php echo get_the_author() ?></a>
				</div>
				
				<div class="single-terms">
					<?php echo get_the_term_list( get_the_ID(), 'category', '<i class="fa fa-archive"></i>', ' ', '' ); ?>
					<?php echo get_the_term_list( get_the_ID(), 'post_tag', '<i class="fa fa-tags"></i>', ' ', '' ); ?>
				</div>

				<?php get_template_part( 'templates/entry', 'share' ); ?>

			</footer>

		</div>

	</div>

</article><!-- #post-<?php the_ID() ?> -->