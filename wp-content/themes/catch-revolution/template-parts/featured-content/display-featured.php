<?php
/**
 * The template for displaying featured content
 *
 * @package Catch_Revolution
 */

$catch_revolution_enable_content = get_theme_mod( 'catch_revolution_featured_content_option', 'disabled' );

if ( ! catch_revolution_check_section( $catch_revolution_enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$catch_revolution_title     = get_option( 'featured_content_title', esc_html__( 'Contents', 'catch-revolution' ) );
$catch_revolution_sub_title = get_option( 'featured_content_content' );

$catch_revolution_classes[] = 'layout-three';
$catch_revolution_classes[] = 'featured-content';
$catch_revolution_classes[] = 'section';

if( ! $catch_revolution_title && !$catch_revolution_sub_title ) {
	$catch_revolution_classes[] = 'no-section-heading';
}
?>

<div id="featured-content-section" class="<?php echo esc_attr( implode( ' ', $catch_revolution_classes ) ); ?>">
	<div class="wrapper">
		<?php if ( '' !== $catch_revolution_title || $catch_revolution_sub_title ) : ?>
			<div class="section-heading-wrapper featured-section-headline">
				<?php if ( '' !== $catch_revolution_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $catch_revolution_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $catch_revolution_sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php echo wp_kses_post( $catch_revolution_sub_title ); ?>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<div class="section-content-wrapper featured-content-wrapper layout-three">
			<?php
			get_template_part( 'template-parts/featured-content/content-featured' );
			?>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
