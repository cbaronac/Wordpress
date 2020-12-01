<?php
/**
 * Header Media Options
 *
 * @package Catch_Revolution
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_revolution_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'catch-revolution' );

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'catch-revolution' ),
				'entire-site'            => esc_html__( 'Entire Site', 'catch-revolution' ),
				'disable'                => esc_html__( 'Disabled', 'catch-revolution' ),
			),
			'label'             => esc_html__( 'Enable on', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_image_position_desktop',
			'default'           => 'center center',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'label'             => esc_html__( 'Image Position (Desktop View)', 'catch-revolution' ),
			'section'           => 'header_image',
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
			'name'              => 'catch_revolution_header_media_image_position_mobile',
			'default'           => 'center center',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'label'             => esc_html__( 'Image Position (Mobile View)', 'catch-revolution' ),
			'section'           => 'header_image',
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

	/*Overlay Option for Header Media*/
	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'catch_revolution_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_text_alignment',
			'default'           => 'text-align-left',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'catch-revolution' ),
				'text-align-right'  => esc_html__( 'Right', 'catch-revolution' ),
				'text-align-left'   => esc_html__( 'Left', 'catch-revolution' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_content_alignment',
			'default'           => 'content-align-left',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'choices'           => array(
				'content-align-center' => esc_html__( 'Center', 'catch-revolution' ),
				'content-align-right'  => esc_html__( 'Right', 'catch-revolution' ),
				'content-align-left'   => esc_html__( 'Left', 'catch-revolution' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'catch-revolution' ),
			'section'           => 'header_image',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'active_callback'   => 'catch_revolution_is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'catch-revolution' ),
				'entire-site'            => esc_html__( 'Entire Site', 'catch-revolution' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_before_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Subtitle before Title', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'catch-revolution' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'catch-revolution' ),
			'section'           => 'header_image',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'catch-revolution' ),
			'section'           => 'header_image',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_header_url_target',
			'sanitize_callback' => 'catch_revolution_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-revolution' ),
			'section'           => 'header_image',
			'custom_control'    => 'Catch_Revolution_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_revolution_header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'catch_revolution_is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since 1.0.0
	*/
	function catch_revolution_is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'catch_revolution_header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
