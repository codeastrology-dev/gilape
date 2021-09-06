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

	<main id="site-content" class="site-main mt-5">
		
		<?php if ( have_posts() ) : ?>

			<header class="container-fluid breadcumbs page-header">
				<div class="container mb-5">
					<div class="row">
						<div class="col-md-12">
							<h1 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'gilape' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
						</div>
					</div>
				</div>
			</header><!-- .page-header -->
			<section class="container">
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
			<?php
			// the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
