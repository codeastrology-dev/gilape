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
	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', _x( 'Featured', 'post', 'astha' ) );
	}

	if ( 'post' === get_post_type() ) : ?>
		<header class="entry-header mb-4">
			<?php
			if( has_post_thumbnail() ): ?>
				<div class="caption">
					<?php gilape_post_thumbnail('gilape-blog-thumbnail'); ?>
				</div>
				<?php
			else: ?>
				<div class="caption">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/no-thumb.png' ); ?>">
				</div>
				<?php 
			endif; ?>
		</header>
		<?php
	endif; ?>

	<div class="search content-wrapper">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				gilape_posted_on();
				gilape_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; 
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
		
		<div class="search-content clearfix">
			<?php echo gilape_get_excerpt(60); ?>
		</div>
	</div><!-- .search.entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
