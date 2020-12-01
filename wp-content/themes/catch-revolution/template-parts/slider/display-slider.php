<?php
/**
 * The template used for displaying slider
 *
 * @package Catch_Revolution
 */

$catch_revolution_enable_slider = get_theme_mod( 'catch_revolution_slider_option', 'disabled' );

if ( ! catch_revolution_check_section( $catch_revolution_enable_slider ) ) {
	return;
}
?>

<div id="feature-slider-section" class="section">
	<div class="wrapper section-content-wrapper feature-slider-wrapper">
		<div class="main-slider owl-carousel">
			<?php
			// Select Slider
			get_template_part( 'template-parts/slider/post-type-slider' );
			?>
		</div><!-- .main-slider -->
	</div><!-- .wrapper -->
</div><!-- #feature-slider -->

