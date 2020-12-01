<?php
/**
 * The template for displaying portfolio items
 *
 * @package Catch_Revolution
 */

$catch_revolution_enable = get_theme_mod( 'catch_revolution_portfolio_option', 'disabled' );

if ( ! catch_revolution_check_section( $catch_revolution_enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$catch_revolution_title     = get_option( 'jetpack_portfolio_title', esc_html__( 'Projects', 'catch-revolution' ) );
$catch_revolution_sub_title = get_option( 'jetpack_portfolio_content' );

if ( ! $catch_revolution_title && ! $catch_revolution_sub_title ) {
	$catch_revolution_classes[] = 'no-section-heading';
}

$catch_revolution_classes[] = 'layout-two';
$catch_revolution_classes[] = 'jetpack-portfolio';
$catch_revolution_classes[] = 'section';
?>

<div id="portfolio-content-section" class="<?php echo esc_attr( implode( ' ', $catch_revolution_classes ) ); ?>">
	<div class="wrapper">
		<?php if ( '' != $catch_revolution_title || $catch_revolution_sub_title ) : ?>
			<div class="section-heading-wrapper portfolio-section-headline">
				<?php if ( '' != $catch_revolution_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_revolution_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $catch_revolution_sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php echo wp_kses_post( $catch_revolution_sub_title ); ?>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper portfolio-content-wrapper layout-three">
			<div class="grid">
			<?php
				get_template_part( 'template-parts/portfolio/post-types', 'portfolio' );
			?>
			</div>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-section -->
