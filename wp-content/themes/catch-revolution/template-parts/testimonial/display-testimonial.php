<?php
/**
 * The template for displaying testimonial items
 *
 * @package Catch_Revolution
 */

$catch_revolution_enable = get_theme_mod( 'catch_revolution_testimonial_option', 'disabled' );

if ( ! catch_revolution_check_section( $catch_revolution_enable ) ) {
	// Bail if featured content is disabled
	return;
}

// Get Jetpack options for testimonial.
$catch_revolution_jetpack_defaults = array(
	'page-title' => esc_html__( 'Testimonials', 'catch-revolution' ),
);

// Get Jetpack options for testimonial.
$catch_revolution_jetpack_options = get_theme_mod( 'jetpack_testimonials', $catch_revolution_jetpack_defaults );

$catch_revolution_headline    = isset( $catch_revolution_jetpack_options['page-title'] ) ? $catch_revolution_jetpack_options['page-title'] : esc_html__( 'Testimonials', 'catch-revolution' );
$catch_revolution_subheadline = isset( $catch_revolution_jetpack_options['page-content'] ) ? $catch_revolution_jetpack_options['page-content'] : '';

$catch_revolution_classes[] = 'section testimonial-content-section';

if ( ! $catch_revolution_headline && ! $catch_revolution_subheadline ) {
	$catch_revolution_classes[] = 'no-section-heading';
}
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $catch_revolution_classes ) ); ?>">
	<div class="wrapper">

	<?php if ( $catch_revolution_headline || $catch_revolution_subheadline ) : ?>
		<div class="section-heading-wrapper testimonial-content-section-headline">
		<?php if ( $catch_revolution_headline ) : ?>
			<div class="section-title-wrapper">
				<h2 class="section-title"><?php echo wp_kses_post( $catch_revolution_headline ); ?></h2>
			</div><!-- .section-title-wrapper -->
		<?php endif; ?>

		<?php if ( $catch_revolution_subheadline ) : ?>
			<div class="section-description">
				<?php echo wp_kses_post( $catch_revolution_subheadline ); ?>
			</div><!-- .section-description-wrapper -->
		<?php endif; ?>
		</div><!-- .section-heading-wrapper -->
	<?php endif;
	get_template_part( 'template-parts/testimonial/post-types-testimonial' );
	?>
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
