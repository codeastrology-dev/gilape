<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gilape
 */

get_header();
?>

	<main id="site-content" class="site-main">
		<div id="primary" class="content-area">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="error-message"><?php esc_html_e( '404', 'gilape' ); ?></h1>
					<h3 class="page-title"><?php esc_html_e( 'Oops! Looks like this is a dead end. And we know that.', 'gilape' ); ?></h3>
				</header><!-- .page-header -->

				<div class="page-content row">
					<div class="col-md-6 offset-3">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gilape' ); ?></p>

						<?php get_search_form(); ?>
						<a class="btn btn-default"
                        href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'gilape' ); ?></a>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div>
	</main><!-- #main -->
<?php
get_footer();
