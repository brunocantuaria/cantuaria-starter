				<?php
				global $sidebar;
				if ($sidebar !== false)
					get_template_part( 'templates/sidebar', $sidebar );
				?>

			</div>

		</div> <!-- #main -->

		<footer id="footer" role="contentinfo">

			<div class="footer-container container">

				<?php get_template_part( 'templates/footer' ) ?>

			</div>

		</footer> <!-- #footer -->
		
		<?php wp_footer() ?>

	</body>

</html>