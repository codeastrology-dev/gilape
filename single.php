<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Gilape
 */

get_header();
?>

	<main id="site-content" class="site-main container mt-5">
		<div class="row">
			<div id="primary" class="content-area col-md-8 pr-3 pl-3">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'single' );

					if ( is_singular( 'post' ) ) {
						// Post navigation
						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'gilape' ) . '</span> <span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'gilape' ) . '</span> <span class="nav-title">%title</span>',
							)
						);
					}

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!-- .row -->
	</main><!-- #main -->

<?php
get_footer();
