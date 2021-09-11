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
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			?>

			<h2 class="entry-title">
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
			<div class="taxonomy-meta">
				<?php gilape_entry_footer(); ?>
			</div>
			<?php 
		endif;?>

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
		

	</div><!-- .content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
