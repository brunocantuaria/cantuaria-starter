<?php
// Page Content
?>

<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>

	<header>
		
		<div class="row">
			
			<h2 class="col-8 col-md-10"><?php the_title(); ?></h2>

			<div class="col"><?php echo get_the_date(); ?></div>

		</div>

	</header>

	<div class="page-content">
		
		<?php the_content(); ?>
		
		<?php wp_link_pages(); ?>
		
	</div>

</article><!-- #post-<?php the_ID() ?> -->