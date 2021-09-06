<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gilape
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
	<header class="entry-header col-md-12">
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', _x( 'Featured', 'post', 'astha' ) );
		}
		
		?>
	</header><!-- .entry-header -->

	<div class="search entry-content col-md-12">
		<div class="row">
			<div class="col-md-6">
				<div class="search-thumb">
					<?php gilape_post_thumbnail(); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="search-content">
					<?php
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
					echo gilape_get_excerpt(60);
					?>
					<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php
						gilape_posted_on();
						gilape_posted_by();
						?>
					</div><!-- .entry-meta -->
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div><!-- .search.entry-content -->

	<footer class="entry-footer col-md-12">
		<?php gilape_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
