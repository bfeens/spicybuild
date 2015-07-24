<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shape
 * @since Shape 1.0
 */

get_header(); ?>

<!-- Using the tutorial found here: http://themeshaper.com/2012/11/01/the-wordpress-theme-index-template/ --> 

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		     <?php the_content(); /*A loop of content by full content */ ?>
		<?php endwhile; ?>
	</div><!-- #content .site-content -->


	<?php while ( have_posts() ) : the_post() ?>
		<div class="entry-summary">
		     <?php the_excerpt(); /* A loop of content by summary */ ?>  				      
		</div><!-- .entry-summary -->
	<?php endwhile; ?>
</div><!-- #primary .content-area -->