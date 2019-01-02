<?php
/**
 * Tmeplate part for top navigation bar.
 *
 * @package beercan
 */

?>
<div id="site-navigation" class="">
	<div class="title-bar" data-responsive-toggle="main-navigation" data-hide-for="medium" >
		<button id="main-navigation-button" class="menu-icon" data-toggle="main-navigation" type="button" >
		</button>
	</div>
	<div id="main-navigation" class="top-bar">
		<div class="top-bar-left">
			<div class="site-title menu"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
		</div>
		<div class="top-bar-right">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top-menu',
					'container'      => '',
					'items_wrap'     => '<ul id="primary-menu" class="%2$s vertical medium-horizontal" data-submenu-toggle="true" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
					'walker'         => new Foundation_Nav_Walker(),
				)
			);
			?>
		</div><!--.top-bar-right-->
	</div><!--#main-navigation-->
</div><!-- #site-navigation -->
