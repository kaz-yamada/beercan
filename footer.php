<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beercan
 */

?>
</div><!-- #content -->
<footer id="footer" class="site-footer">
	<div class="scroll-to-top">
		<a href="#"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
	</div>
	<div class="footer-widget-area grid-container grid-x grid-padding-x grid-padding-y medium-up-3">
		<?php
		$columns = get_footer_columns();

		for ( $i = 1; $i <= $columns; $i++ ) {
			$name = 'footer-widgets-' . $i;

			if ( is_active_sidebar( $name ) ) {
				dynamic_sidebar( $name );
			}
		}
		?>
	</div>
	<div class="site-info grid-container grid-padding-x grid-padding-y">
		<div class="cell footer-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'beercan' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'beercan' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'beercan' ), 'beercan', '<a href="' . esc_url( get_theme_author_url() ) . '">Kazuki Yamada</a>' );
			?>
		</div><!--.footer-info-->
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
