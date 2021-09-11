<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Gilape
 */

get_header();
?>

	<main id="site-content" class="site-main container mt-5">
		
		<div class="row">
			<?php 
			if ( have_posts() ) : ?>
				<div id="primary" class="content-area col-md-8 pr-3 pl-3">
					<h1 class="page-title mb-5">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'gilape' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
					<section class="search-results">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;
						?>
					</section>
				</div><!-- #primary -->

				<?php get_sidebar(); 

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div><!-- .row -->
	</main><!-- #main -->

<?php
get_footer();
