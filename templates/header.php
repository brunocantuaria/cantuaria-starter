<?php
// Header Content
?>

<div class="row">

	<div class="col col-md-3">
		<div class="site-title">
			<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo( 'name', 'display' ); ?>" rel="home">
				<?php theme_image('logo.png', get_bloginfo( 'name', 'display' ) ); ?>
			</a>
		</div>
	</div>

	<div class="col">
		<nav role="navigation">
			<?php theme_menu('topmenu'); ?>
		</nav>
	</div>

</div>