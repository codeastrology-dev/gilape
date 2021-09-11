<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gilape
 */

get_header();
?>

	<main id="site-content" class="site-main container mt-5">
		<div class="row">
			<div class="col-md-8 pr-3 pl-3 bp-order-1">
				<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) :
							?>
							<header>
								<h1 class="page-title screen-reader-text entry-title mb-3"><?php single_post_title(); ?></h1>
							</header>
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
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

						if( function_exists( 'gilape_the_posts_pagination' ) ) :
							gilape_the_posts_pagination();
						endif;

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
				?>
			</div><!-- .col-md-8 -->
			<?php
				get_sidebar();
			?>
		</div><!-- .row -->
	</main><!-- #main -->

<?php
get_footer();
