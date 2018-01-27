<?php
/**
 * Template part for displaying the page header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

$header_image = beercan_header_image_url();

?>
<header class="page-header site-branding" >
	<?php if ( $header_image ) : ?>
	<div class='header-background' style="background-image: url('<?php echo esc_attr( $header_image ); ?>')">
		<?php do_action( 'beercan_header_title' ); ?>		
	</div>
<?php endif; ?>
</header><!-- .page-header -->
