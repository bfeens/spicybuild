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
	<div class="header-wrapper">
		<div class="header-content container">
			<header id="masthead" class="site-header" role="banner">
					<div class="site-branding col-md-4">
								<?php if ( get_theme_mod( 'spicy_logo' ) ) : ?><!-- The logo --> 
							    <div class='site-logo'>
							        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'spicy_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
							    </div>
							<?php else : ?>
							    <hgroup>
							        <h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
							        <h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
							    </hgroup>
							<?php endif; ?>
					</div><!-- .site-branding -->
					<div class="site-navigation-secondary-wrapper col-md-4">
						<nav id="site-navigation-secondary" class="secondary-navigation" role="navigation">
							<!-- TODO: Figure out how to use this button <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Secondary Menu', 'spicy' ); ?></button>-->
							<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
						</nav><!-- #site-navigation-secondary -->
					</div><!-- .site-navigation-secondary-wrapper --> 
					<div class="search-form-header col-md-4">
						<?php get_search_form(); ?> 
					</div>
				</div>
				<div class="site-navigation-primary-wrapper row">
				<nav id="site-navigation-primary" class="main-navigation" role="navigation">
					<!-- TODO: Figure out how to use this button <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'spicy' ); ?></button>-->
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation-primary -->
				</div><!-- .site-navigation-primary-wrapper -->
			</header><!-- #masthead -->
		</div><!-- .header-content --> 
	</div><!-- .header-wrapper --> 
	<div id="content" class="site-content">
