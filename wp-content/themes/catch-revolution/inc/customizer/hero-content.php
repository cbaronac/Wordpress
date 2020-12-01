<?php
/**
 * Hero Content Options
 *
 * @package Catch_Revolution
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_revolution_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_revolution_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'catch-revolution' ),
			'panel' => 'catch_revolution_theme_options',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'choices'           => catch_revolution_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-revolution' ),
			'section'           => 'catch_revolution_hero_content_options',
			'type'              => 'select',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'catch_revolution_sanitize_post',
			'active_callback'   => 'catch_revolution_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'catch-revolution' ),
			'section'           => 'catch_revolution_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_hero_content_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'active_callback'   => 'catch_revolution_is_hero_content_active',
			'choices'           => catch_revolution_content_show(),
			'label'             => esc_html__( 'Display Content', 'catch-revolution' ),
			'section'           => 'catch_revolution_hero_content_options',
			'type'              => 'select',
		)
	);
}
add_action( 'customize_register', 'catch_revolution_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_revolution_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since 1.0.0
	*/
	function catch_revolution_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_revolution_hero_content_visibility' )->value();

		return catch_revolution_check_section( $enable );
	}
endif;
