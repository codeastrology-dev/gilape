<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Gilape
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gilape_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gilape_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gilape_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gilape_pingback_header' );

/**
 * Add Image Size
 * 
 * @since 0.1
 */
function gilape_thumbsize() {
	add_image_size( 'gilape-sidebar-thumbnail', 100, 100, true );
	add_image_size( 'gilape-home-thumbnail', 370, 320, true );
	add_image_size( 'gilape-blog-thumbnail', 1200, 628, true );
}
add_action( 'after_setup_theme', 'gilape_thumbsize' );

/**
 * Custom Excerpt
 * 
 * @since 0.1
 */
add_filter( 'excerpt_length', 'gilape_get_excerpt' );

function gilape_get_excerpt( $count ) {
	global $post;
	$permalink = esc_url( get_permalink( $post->ID ) );
	$excerpt = get_the_content();
	$excerpt = strip_tags( $excerpt );
	$excerpt = substr( $excerpt, 0, $count );
	$excerpt = wp_kses_post( substr( $excerpt, 0, strripos( $excerpt, " " ) ) );
	$read_more_btn = sprintf( '<p class="read-more-button-container mb-0"><a class="read_more_btn" href="%1$s">%2$s</a></p>',
			$permalink,
			__( 'Continue reading', 'gilape' )
		);
		$excerpt = '<p>' . $excerpt . '...</p>' . $read_more_btn;
		return $excerpt;
}

if( ! function_exists( 'gilape_the_posts_pagination' ) ) {
	/**
	 * Pagination
	 * 
	 * @since 0.1
	 */
	function gilape_the_posts_pagination(){
		the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text' => __( 'Previous', 'gilape' ),
			'next_text' => __( 'Next', 'gilape' ),
		) );
	}
}

if( !function_exists( 'gilape_site_logo' ) ){
	/**
	 * Show site logo or text
	 * 
	 * @param array	$args	See $defaults array.
	 * @param bool	$echo	Should return or echo?
	 * 
	 * @since 0.1
	 */
	function gilape_site_logo( $args = array(), $echo = true ){
		$logo       = get_custom_logo();
		$site_title = get_bloginfo( 'name' );
		$contents   = '';
		$classname  = '';

		$defaults = array(
			'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
			'logo_class'  => 'site-logo',
			'title'       => '<a href="%1$s">%2$s</a>',
			'title_class' => 'site-title',
			'home_wrap'   => '<h1 class="%1$s">%2$s</h1>',
			'single_wrap' => '<h1 class="%1$s">%2$s</h1>',
			'condition'   => ( is_front_page() || is_home() ) && ! is_page(),
		);

		$args = wp_parse_args( $args, $defaults );

		/**
		 * Filters the arguments for `gilape_site_logo()`.
		 *
		 * @param array  $args     Parsed arguments.
		 * @param array  $defaults Function's default arguments.
		 * 
		 * @since 0.1
		 */
		$args = apply_filters( 'gilape_site_logo_args', $args, $defaults );

		if ( has_custom_logo() ) {
			$contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
			$classname = $args['logo_class'];
		} else {
			$contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
			$classname = $args['title_class'];
		}

		$wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';

		$html = sprintf( $args[ $wrap ], $classname, $contents );

		/**
		 * Filters the arguments for `gilape_site_logo()`.
		 *
		 * @param string $html      Compiled html based on our arguments.
		 * @param array  $args      Parsed arguments.
		 * @param string $classname Class name based on current view, home or single.
		 * @param string $contents  HTML for site title or logo.
		 * 
		 * @since 0.1
		 */
		$html = apply_filters( 'gilape_site_logo', $html, $args, $classname, $contents );

		if ( ! $echo ) {
			return $html;
		}

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped


	}
}

if( ! function_exists( 'gilape_site_description' ) ){
	/**
	 * Displays the site description.
	 *
	 * @param boolean $echo should return or echo?
	 *
	 * @return string $html The HTML to display.
	 * 
	 * @since 0.1
	 */
	function gilape_site_description( $echo = true ) {

		$description = get_bloginfo( 'description' );

		if ( ! $description ) {
			return;
		}

		$wrapper = '<div class="site-description">%s</div><!-- .site-description -->';

		$html = sprintf( $wrapper, esc_html( $description ) );

		/**
		 * Filters the html for the site description.
		 *
		 * @param string $html         The HTML to display.
		 * @param string $description  Site description via `bloginfo()`.
		 * @param string $wrapper      The format used in case you want to reuse it in a `sprintf()`.
		 * 
		 * @since 0.1
		 */
		$html = apply_filters( 'gilape_site_description', $html, $description, $wrapper );

		if ( ! $echo ) {
			return $html;
		}

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


if ( ! function_exists( 'gilape_footer' ) ) {
	function gilape_footer(){ ?>
		<!--Footer-->
		<footer class="footer">
			<div class="container">
				<div class="row text-left mt-4 mb-4">
				<?php
					if (is_active_sidebar('footer_menu')) {
						dynamic_sidebar('footer_menu');
					}
				?>
				</div>
				<hr>
				<div class="row copyright_info">
					<div class="col-md-6">
						<div class="mt-2">
							<?php
							if (!is_active_sidebar('copyright')) {
							?>
							<div class="footer-credits">
								<p class="footer-copyright powered-by-wordpress">
									&copy;
									<?php
									echo date_i18n(
										/* translators: Copyright date format, see https://secure.php.net/date */
										_x( 'Y', 'copyright date format', 'gilape' )
									);
									?>
											
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?>.</a>
									<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'gilape' ) ); ?>">
									<?php _e( 'Powered by WordPress', 'gilape' ); ?>
									</a>
								</p><!-- .powered-by-wordpress -->
							</div><!-- .footer-credits -->
							
							<?php } else{?>
							<small><?php dynamic_sidebar('copyright');?> </small>
							<?php }?>
						</div>
					</div>
					<div class="col-md-6 text-right">
						<?php 
							/**
							 * Hook - gilape_social
							 * 
							 * @hooked gilape_social - 10
							 */
							do_action('gilape_social');
						?>
					</div>
				</div>
			</div>
		</footer>
		<?php
	}
}
add_action( 'gilape_footer', 'gilape_footer', 10 );

if( ! function_exists( 'gilape_social' ) ) {
	/**
	 * Footer social links
	 * 
	 * @since 0.1
	 */
	function gilape_social(){
		$facebook	= get_theme_mod( 'facebook' );
		$twitter	= get_theme_mod( 'twitter' );
		$linkedin	= get_theme_mod( 'linkedin' );
		$pinterest	= get_theme_mod( 'pinterest' );
		$instagram	= get_theme_mod( 'instagram' );
		
		if( $facebook || $twitter || $linkedin || $pinterest || $instagram ) :
			?>
			<div class="social-network-wrap">
				<ul class="social-network">
					<?php if( $facebook ): ?>
						<li>
							<a href="<?php echo esc_url( $facebook ); ?>">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
					<?php endif; ?>
					<?php if( $twitter ): ?>
						<li>
							<a href="<?php echo esc_url( $twitter ); ?>">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
					<?php endif; ?>
					<?php if( $linkedin ): ?>
						<li>
							<a href="<?php echo esc_url( $linkedin ); ?>">
								<i class="fa fa-linkedin"></i>
							</a>
						</li>
					<?php endif; ?>
					<?php if( $pinterest ): ?>
						<li>
							<a href="<?php echo esc_url( $pinterest ); ?>">
								<i class="fa fa-pinterest"></i>
							</a>
						</li>
					<?php endif; ?>
					<?php if( $instagram ): ?>
						<li>
							<a href="<?php echo esc_url( $instagram ); ?>">
								<i class="fa fa-instagram"></i>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
			<?php 
		endif;
	}
}
// add_action( 'gilape_social', 'gilape_social', 10 );

if( ! function_exists( 'gilape_widgets_init' ) ) {

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function gilape_widgets_init() {
		register_sidebar( 
			array(
				'name'          => esc_html__( 'Sidebar', 'gilape' ),
				'id'            => 'sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'gilape' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		register_sidebar(
			array(
				'name' 			=> esc_html__('Footer Menu Widget Area','gilape'),
				'id'        	=> 'footer_menu',
				'description' 	=> esc_html__('Footer Menu Area','gilape'),
				'before_widget' => '<div class="col-md-4">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h4>',
				'after_title' 	=> '</h4>',
			));
			register_sidebar( 
			array(
				'name' 			=> esc_html__('&copy; Copyright Widget Area','gilape'),
				'id' 			=> 'copyright',
				'description' 	=> esc_html__('Add Copyright Text','gilape'),
				'before_widget' => '',
				'after_widget' 	=> '',
				'before_title' 	=> '',
				'after_title' 	=> '',
			));
	}
}
add_action( 'widgets_init', 'gilape_widgets_init' );

if( ! function_exists( 'gilape_skip_link_focus_fix' ) ) {
	/**
	 * Fix skip link focus in IE11.
	 *
	 * This does not enqueue the script because it is tiny and because it is only for IE11,
	 * thus it does not warrant having an entire dedicated blocking script being loaded.
	 *
	 * @link https://git.io/vWdr2
	 */
	function gilape_skip_link_focus_fix() {
		// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window
			.addEventListener("hashchange", function() {
				var t, e = location.hash.substring(1);
				/^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i
					.test(t.tagName) || (t.tabIndex = -1), t.focus())
			}, !1);
		</script>
		<?php
	}
}
add_action( 'wp_print_footer_scripts', 'gilape_skip_link_focus_fix' );

/**
 * Incluede skip link to top of the body
 */
function gilape_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'gilape' ) . '</a>';
}

add_action( 'wp_body_open', 'gilape_skip_link', 5 );

