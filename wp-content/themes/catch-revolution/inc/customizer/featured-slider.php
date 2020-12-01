<?php
/**
 * Featured Slider Options
 *
 * @package Catch_Revolution
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_revolution_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_revolution_featured_slider', array(
			'panel' => 'catch_revolution_theme_options',
			'title' => esc_html__( 'Featured Slider', 'catch-revolution' ),
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'choices'           => catch_revolution_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-revolution' ),
			'section'           => 'catch_revolution_featured_slider',
			'type'              => 'select',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_slider_image_position_desktop',
			'default'           => 'center center',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'active_callback'   => 'catch_revolution_is_slider_active',
			'label'             => esc_html__( 'Image Position (Desktop View)', 'catch-revolution' ),
			'section'           => 'catch_revolution_featured_slider',
			'type'              => 'select',
			'choices'           => array(
				'left top'      => esc_html__( 'Left Top', 'catch-revolution' ),
				'left center'   => esc_html__( 'Left Center', 'catch-revolution' ),
				'left bottom'   => esc_html__( 'Left Bottom', 'catch-revolution' ),
				'right top'     => esc_html__( 'Right Top', 'catch-revolution' ),
				'right center'  => esc_html__( 'Right Center', 'catch-revolution' ),
				'right bottom'  => esc_html__( 'Right Bottom', 'catch-revolution' ),
				'center top'    => esc_html__( 'Center Top', 'catch-revolution' ),
				'center center' => esc_html__( 'Center Center', 'catch-revolution' ),
				'center bottom' => esc_html__( 'Center Bottom', 'catch-revolution' ),
			),
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_slider_image_position_mobile',
			'default'           => 'center center',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'active_callback'   => 'catch_revolution_is_slider_active',
			'label'             => esc_html__( 'Image Position (Mobile View)', 'catch-revolution' ),
			'section'           => 'catch_revolution_featured_slider',
			'type'              => 'select',
			'choices'           => array(
				'left top'      => esc_html__( 'Left Top', 'catch-revolution' ),
				'left center'   => esc_html__( 'Left Center', 'catch-revolution' ),
				'left bottom'   => esc_html__( 'Left Bottom', 'catch-revolution' ),
				'right top'     => esc_html__( 'Right Top', 'catch-revolution' ),
				'right center'  => esc_html__( 'Right Center', 'catch-revolution' ),
				'right bottom'  => esc_html__( 'Right Bottom', 'catch-revolution' ),
				'center top'    => esc_html__( 'Center Top', 'catch-revolution' ),
				'center center' => esc_html__( 'Center Center', 'catch-revolution' ),
				'center bottom' => esc_html__( 'Center Bottom', 'catch-revolution' ),
			),
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'catch_revolution_sanitize_number_range',

			'active_callback'   => 'catch_revolution_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'catch-revolution' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'catch-revolution' ),
			'section'           => 'catch_revolution_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'catch_revolution_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		catch_revolution_register_option( $wp_customize, array(
				'name'              => 'catch_revolution_slider_page_' . $i,
				'sanitize_callback' => 'catch_revolution_sanitize_post',
				'active_callback'   => 'catch_revolution_is_slider_active',
				'label'             => esc_html__( 'Page', 'catch-revolution' ) . ' # ' . $i,
				'section'           => 'catch_revolution_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'catch_revolution_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'catch_revolution_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since 1.0.0
	*/
	function catch_revolution_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_revolution_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return catch_revolution_check_section( $enable );
	}
endif;
