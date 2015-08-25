<?php
// Page Content
?>

<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>

	<header>
		<h2 class="page-header"><?php the_title() ?></h2>
		<div class="clear"></div>
	</header>

	<div class="page-content">
		
		<?php the_content(); ?>
		
		<?php wp_link_pages(); ?>
		
	</div>

</article><!-- #post-<?php the_ID() ?> -->