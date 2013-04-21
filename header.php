<!-- HEADER START -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
	</head>
	<body class="PAGE-SLUG-HERE">
		<div class="page">
			<header>
				<nav class="main-menu full">
					<div class="screen-reader-text skip-link"><a href="#UPDATE ME" title="Skip to content">Skip to content</a></div>
					<div class="compact-menu">
						<a class="menu-toggle">Menu</a>
						<?php get_search_form(); ?>
					</div>
					<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false)); ?>
				</nav>
			</header>
<!-- HEADER END -->
