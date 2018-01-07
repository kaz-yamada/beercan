<?php
/**
 * Tmeplate part for header navigation bar.
 *
 * @package beercan
 */

?>
<div id="site-navigation" class="sticky-container" data-sticky-container>
	<nav class="main-navigation top-bar sticky" data-sticky data-options="marginTop: 0">
		<div class="top-bar-left">
			<h4 class="site-title menu"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h4>
		</div>
		<div class="top-bar-right">
		<div class="menu-toggle-wrapper hide-for-large">
			<button class="menu-toggle" type="button" aria-expanded="false">
				<span class="menu-toggle-icon"></span>
			</button>
		</div>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top-menu',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu vertical large-horizontal',
				)
			);
			?>
		</div><!--.top-bar-right-->
	</nav><!--.main-navigation-->
</div><!-- #site-navigation -->
