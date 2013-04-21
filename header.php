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
					<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', '_s' ); ?>"><?php _e( 'Skip to content', '_s' ); ?></a></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav>
			</header>
<!-- HEADER END -->
