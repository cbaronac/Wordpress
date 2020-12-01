<?php
/**
 * The template for displaying service content
 *
 * @package Catch_Revolution
 */

$catch_revolution_enable_content = get_theme_mod( 'catch_revolution_service_option', 'disabled' );

if ( ! catch_revolution_check_section( $catch_revolution_enable_content ) ) {
	// Bail if service content is disabled.
	return;
}

$catch_revolution_title     = get_option( 'ect_service_title', esc_html__( 'Services', 'catch-revolution' ) );
$catch_revolution_sub_title = get_option( 'ect_service_content' );

$catch_revolution_classes[] = 'service-section';
$catch_revolution_classes[] = 'section';

if ( ! $catch_revolution_title && ! $catch_revolution_sub_title ) {
	$catch_revolution_classes[] = 'no-section-heading';
}
?>

<div id="service-section" class="<?php echo esc_attr( implode( ' ', $catch_revolution_classes ) ); ?>">
	<div class="wrapper">
		<?php if ( '' !== $catch_revolution_title || $catch_revolution_sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( '' !== $catch_revolution_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_revolution_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $catch_revolution_sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php echo wp_kses_post( $catch_revolution_sub_title ); ?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper service-content-wrapper layout-three">
			<?php
			get_template_part( 'template-parts/service/content-service' );
			?>
		</div><!-- .service-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #service-section -->
