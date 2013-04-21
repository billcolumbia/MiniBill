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
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body class="PAGE-SLUG-HERE">
		<div class="page">
			<header>
				<nav>
					<a class="menu-toggle">Menu</a>
					<div class="screen-reader-text skip-link"><a href="#content" title="Skip to content">Skip to content</a></div>
					<?php wp_nav_menu(array('container' => '')); ?>
				</nav>
			</header>
<!-- HEADER END -->
