<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gilape
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5 home-blog' ); ?>>
	<header class="entry-header mb-4">
		<?php 
		if ( 'post' === get_post_type() ) :
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
			endif;
		endif;
		?>
    </header><!-- .entry-header -->
	
	<div class="content-wrapper">
		<div class="blog_post_meta">
			<?php
                gilape_posted_on();
                gilape_posted_by();
			?>
		</div>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title mb-3 mt-4">', '</h1>' );
		else :
			the_title( '<h1 class="entry-title mb-3 mt-4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;?>
		
		

		<div class="entry-content">
			<?php
            the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gilape' ),
					'after'  => '</div>',
				)
			);
			
			?>
		</div><!-- .entry-content -->
		
		<div class="taxonomy-meta">
			<?php gilape_entry_footer(); ?>
		</div>
	</div><!-- .entry-content-wrapper -->
	
</article>


