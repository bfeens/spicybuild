<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package spicy
 */

?>
<?php the_post_thumbnail('full', array('class' => 'full-canvas')); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-header-area">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
		<div class="excerpt-area">
		 <?php the_excerpt(); ?> 
		 </div><!-- .excerpt-area -->
	</div><!-- .content-header-area-->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'spicy' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'spicy' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

