<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gilape
 */

get_header();
?>

	<main id="site-content" class="site-main container mt-5">
		<div class="row">
			<div class="col-md-8 pr-3 pl-3">
				<div id="primary" class="content-area">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

					endwhile; // End of the loop.
					?>
				</div>

			</div><!-- .col-md-8 -->

			<?php get_sidebar(); ?>

		</div><!-- .row -->
		
	</main><!-- #main -->

<?php
get_footer();
