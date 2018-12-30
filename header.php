<!DOCTYPE html>
<html>
<head>
	<title><?php bloginfo('title'); ?></title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="msapplication-TileColor" content="#990100">
	<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#990100">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/manifest.json">

	<?php wp_head(); ?>
</head>
<body<?php 
	$body_classes = array();

	if (is_page_template( 'page-templates/template-sidebar-right.php' )) {
		array_push($body_classes, 'sidebar', 'sidebar-right');
	}

	if (is_page_template( 'page-templates/template-sidebar-left.php' )) {
		array_push($body_classes, 'sidebar', 'sidebar-left');
	}

	body_class($body_classes);
?>>
	<?php // include_once("analytics.php") ?>
	<div id="fb-root"></div>
	<header id="header">
		<div class="container">
			<div class="logo-wrap">
				<?php if ( function_exists( 'the_custom_logo' )) { the_custom_logo(); } ?>
			</div>
			<nav class="nav-wrap">
				<?php wp_nav_menu( array(
					'menu' => 'header_menu',
		      'theme_location' => 'header_menu',
				)); ?>
			</nav>
			<div class="search-wrap">
				<?php get_search_form(); ?>
			</div>
			<button class="menu-toggle">
				<div class="bars">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<span class="sr-only">Menu toggle</span>
				<div class="clear-fix"></div>
			</button>
		</div>
	</header>