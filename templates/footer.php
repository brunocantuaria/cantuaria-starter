<?php
//Footer content
?>

<div class="row">

	<div class="col col-md-4">
		<nav role="navigation">
			<?php theme_menu('bottommenu', 'stacked'); ?>
		</nav>
	</div>

	<div class="col copy">
		<p>&copy; <?php echo date('Y') ?> - <?php _e( 'All rights reserved.', THEMENAME ); ?></p>
	</div>

</div>