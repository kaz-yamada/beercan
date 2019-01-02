<?php
/**
 * Template part for displaying the page title bar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

?>
<header class="page-title-bar grid-container grid-padding-y">
	<div class='title-bar-content cell'>
		<?php
		beercan_get_post_title( 'h1', 'page-title' );
        beercan_post_subtitle();
		?>
	</div><!--.title-bar-content -->
</header><!-- .page-title-bar -->
