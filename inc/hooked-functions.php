<?php
if ( ! function_exists( 'gilape_header' ) ) :
	function gilape_header(){ ?>

		<header class="nav-header">
			<!--Navbar -->
			<nav id="site-navigation" class="navbar navbar-expand-lg">
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
					<?php
					if ( has_nav_menu( 'primary' ) ) :
						wp_nav_menu( array(
							'theme_location'    => 'primary',
							'depth'             => 3,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse justify-content-center',
							'container_id'      => 'navbar-collapse',
							'menu_class'        => 'nav navbar-nav',
							'items_wrap'		=> '<ul class="nav navbar-nav" data-function="navbar">%3$s</ul>',
						) );
					else:
					wp_page_menu(
						array(
							'container'  => 'div',
							'menu_id'    => 'navbar-collapse',
							'menu_class' => 'nav navbar-nav',
							'menu_class' => 'collapse navbar-collapse justify-content-center',
							'before'     => '<ul class="nav navbar-nav" data-function="navbar">',
							'after'      => '</ul>',
						)
					); 
				endif; 
				?>
				</div>
			</nav>
		</header>
<?php
}
endif;
add_action( 'gilape_header', 'gilape_header', 10 );