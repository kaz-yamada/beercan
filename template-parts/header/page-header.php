<?php
/**
 * Template part for displaying the page header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

$header_image = beercan_header_image_url();

if ( $header_image ) {
	?>
	<style>
		.site-header .header-background {
			background-image: url('<?php echo esc_attr( $header_image ); ?>');
			background-color: transparent;
		}
	</style>
	<?php
}
?>

<header class="page-header site-branding">
	<div class='header-background'>
		<?php do_action( 'beercan_header_title' ); ?>
	</div>
</header><!-- .page-header -->
