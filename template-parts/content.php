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
	<header class="entry-header list">
        <?php 
            if ( 'post' === get_post_type() ) :
                if( has_post_thumbnail() ):
                    gilape_post_thumbnail('gilape-blog-thumbnail');
                else: ?>
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/no-thumb.png' ); ?>">
                    <?php 
                endif;
            endif;
            gilape_posted_on();
        ?>
    </header><!-- .entry-header -->

	<div class="entry-content-wrapper">
		
		<?php
		
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title mb-3 mt-4">', '</h1>' );
		else :
		?>
		<h2 class="entry-title mb-3 mt-4">
			<a href="<?php the_permalink() ?>" rel="bookmark">
				<?php
					$the_title = $post->post_title; /* or you can use get_the_title() */
					$get_length = strlen( $the_title );
					$the_length = 25;
					echo substr( $the_title, 0, $the_length );
					if ( $get_length > $the_length ) echo "...";
				?>
			</a>
		</h2>
		<?php 
		endif;?>
		
		<div class="blog_post_meta mb-2 mt-2">
			<?php
                gilape_posted_by();
                gilape_posted_on();
                gilape_get_category();
			?>
		</div>

		<div class="entry-content">
			<?php
			echo gilape_get_excerpt(100);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gilape' ),
					'after'  => '</div>',
				)
			);
			
			?>
		</div><!-- .entry-content -->

	</div><!-- .entry-content-wrapper -->

	<footer class="entry-footer">
		<?php gilape_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
