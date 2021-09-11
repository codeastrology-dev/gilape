<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gilape
 */

get_header();
?>

<main id="site-content" class="site-main container mt-5">
	<div class="row">
		<div id="primary" class="content-area col-md-8 pr-3 pl-3 bp-order-1">
			<?php 
			if ( have_posts() ) : 
				if ( is_home() && ! is_front_page() ) :
					?>

					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
				endif;
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/

					get_template_part( 'template-parts/content', 'archive' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .row -->

</main><!-- #main -->

<?php
get_footer();
