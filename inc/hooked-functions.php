<?php
if ( ! function_exists( 'gilape_header' ) ) :
	function gilape_header(){ 
		$enable_header_search = get_theme_mod( 'enable_header_search', true );
		?>

		<header class="site-header">
			<div class="header-inner section-inner">
				<!--Navbar -->
				<nav class="navbar navbar-expand-lg">
					<div class="container">
						<div class="site-info">
							<?php gilape_site_logo();?>
							<?php gilape_site_description();?>
						</div>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
							aria-controls="navbar-collapse" aria-expanded="false"
							aria-label="<?php esc_attr_e( 'Toggle navigation', 'gilape' ); ?>">
							<span class="toggle-menu fa fa-bars"></span>
						</button>
						<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
							<span class="toggle-inner">
								<span class="toggle-menu fa fa-bars"></span>
								<!-- <span class="toggle-icon">
									<?php //twentytwenty_the_theme_svg( 'ellipsis' ); ?>
								</span> -->
								<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
							</span>
						</button><!-- .nav-toggle -->
						
					</div>
				</nav>

				<div class="header-navigation-wrapper">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>" role="navigation">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}

					if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<div class="header-toggles hide-no-js">

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
										<!-- <span class="toggle-icon">
											<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
										</span> -->
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

							<?php
						}

						if ( true === $enable_header_search ) {
							?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php //twentytwenty_the_theme_svg( 'search' ); ?>
										<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

							<?php
						}
						?>

						</div><!-- .header-toggles -->
						<?php
					}

					?>

				</div><!-- .header-navigation-wrapper -->
			</div>
		</header>
<?php
}
endif;
add_action( 'gilape_header', 'gilape_header', 10 );