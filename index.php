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
 */

get_header(); ?>
<!-- NEW COMMENT --> 

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>		    
			<?php the_content(); /*A loop of content by full content */ ?>
		<?php endwhile; ?>
	</div><!-- #content .site-content -->


	<?php while ( have_posts() ) : the_post() ?>
		<div class="entry-summary">
		     <?php the_excerpt(); /* A loop of content by summary */ ?>  				      
		</div><!-- .entry-summary -->
	<?php endwhile; ?>
</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
