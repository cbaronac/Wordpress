<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'ananya-footer-widget-area-left' ) || is_active_sidebar( 'ananya-footer-widget-area-center' ) || is_active_sidebar( 'ananya-footer-widget-area-right' ) ) : ?>
		<div id="footer" class="footer-widget-area">
			<div class="container">
				<div class="row">
					<div class="col-md-4"><?php dynamic_sidebar( 'ananya-footer-widget-area-left' ); ?></div>
					<div class="col-md-4"><?php dynamic_sidebar( 'ananya-footer-widget-area-center' ); ?></div>
					<div class="col-md-4"><?php dynamic_sidebar( 'ananya-footer-widget-area-right' ); ?></div>
				</div><!-- row -->
			</div><!-- container -->
		</div><!-- footer-widget-area -->
		<?php endif; ?>
		<div class="site-info">
			<div class="site-info-container">
				<a href="<?php echo esc_url(__( 'https://wordpress.org/', 'ananya' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'ananya' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s', 'ananya' ), '<a href="'.esc_url( 'https://falgunithemes.com/').'" rel="nofollow">Ananya</a>' );
				?>
			</div><!-- site-info-container -->
		</div><!-- site-info -->
	</footer><!-- #colophon -->
</div><!-- page -->

<?php wp_footer(); ?>

</body>
</html>