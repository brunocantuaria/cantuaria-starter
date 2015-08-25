<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<head>

		<meta charset="<?php bloginfo( 'charset' ) ?>">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title( '|', true, 'right' ) ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>">
		
		<!-- wp_head_starts -->
		<?php wp_head() ?>
		<!-- wp_head_ends -->

		<link rel="stylesheet" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css" />

	</head>

	<body <?php body_class() ?>>

		<header id="head" role="banner">

			<div class="head-container container">
				
				<?php get_template_part( 'templates/header' ) ?>

			</div>

		</header> <!-- #head -->

		<main id="main" role="main">

			<div class="content-container container">