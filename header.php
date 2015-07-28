<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package spicy
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site"> <!-- Opens the page --> 
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'spicy' ); ?></a>
	<div class="header-wrapper container-fluid">
		<div class="header-content container-fluid row">
			<header id="masthead" class="site-header" role="banner">
				<div class="site-branding container-fluid col-md-4">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div><!-- .site-branding -->
				<div class="site-navigation-secondary-wrapper">
					<nav id="site-navigation-secondary" class="secondary-navigation" role="navigation">
						<!-- TODO: Figure out how to use this button <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Secondary Menu', 'spicy' ); ?></button>-->
						<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
					</nav><!-- #site-navigation-secondary -->
				</div><!-- .site-navigation-secondary-wrapper --> 
				<div class="search-form-header">
					<?php get_search_form( $echo ); ?>TEST!!!!
				</div>
				<nav id="site-navigation-primary" class="main-navigation" role="navigation">
					<!-- TODO: Figure out how to use this button <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'spicy' ); ?></button>-->
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation-primary -->
			</header><!-- #masthead -->
		</div><!-- .header-content --> 
	</div><!-- .header-wrapper --> 
	<div id="content" class="site-content">
