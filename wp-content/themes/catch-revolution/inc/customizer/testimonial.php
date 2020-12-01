<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Catch_Revolution
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_revolution_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    catch_revolution_register_option( $wp_customize, array(
            'name'              => 'catch_revolution_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Revolution_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Catch Revolution Theme, go %1$shere%2$s', 'catch-revolution' ),
                '<a href="javascript:wp.customize.section( \'catch_revolution_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_revolution_testimonials', array(
            'panel'    => 'catch_revolution_theme_options',
            'title'    => esc_html__( 'Testimonials', 'catch-revolution' ),
        )
    );

    $action = 'install-plugin';
    $slug   = 'essential-content-types';

    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => $action,
                'plugin' => $slug
            ),
            admin_url( 'update.php' )
        ),
        $action . '_' . $slug
    );

    catch_revolution_register_option( $wp_customize, array(
            'name'              => 'catch_revolution_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Revolution_Note_Control',
            'active_callback'   => 'catch_revolution_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'catch-revolution' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'catch_revolution_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    catch_revolution_register_option( $wp_customize, array(
            'name'              => 'catch_revolution_testimonial_option',
            'default'           => 'disabled',
            'active_callback'   => 'catch_revolution_is_ect_testimonial_active',
            'sanitize_callback' => 'catch_revolution_sanitize_select',
            'choices'           => catch_revolution_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'catch-revolution' ),
            'section'           => 'catch_revolution_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    catch_revolution_register_option( $wp_customize, array(
            'name'              => 'catch_revolution_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Revolution_Note_Control',
            'active_callback'   => 'catch_revolution_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-revolution' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'catch_revolution_testimonials',
            'type'              => 'description',
        )
    );

    catch_revolution_register_option( $wp_customize, array(
            'name'              => 'catch_revolution_testimonial_number',
            'default'           => '5',
            'sanitize_callback' => 'catch_revolution_sanitize_number_range',
            'active_callback'   => 'catch_revolution_is_testimonial_active',
            'label'             => esc_html__( 'Number of items', 'catch-revolution' ),
            'section'           => 'catch_revolution_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'catch_revolution_testimonial_number', 5 );

    for ( $i = 1; $i <= $number ; $i++ ) {
        //for CPT
        catch_revolution_register_option( $wp_customize, array(
                'name'              => 'catch_revolution_testimonial_cpt_' . $i,
                'sanitize_callback' => 'catch_revolution_sanitize_post',
                'active_callback'   => 'catch_revolution_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'catch-revolution' ) . ' ' . $i ,
                'section'           => 'catch_revolution_testimonials',
                'type'              => 'select',
                'choices'           => catch_revolution_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'catch_revolution_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'catch_revolution_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since 1.0.0
    */
    function catch_revolution_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'catch_revolution_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return catch_revolution_check_section( $enable );
    }
endif;

if ( ! function_exists( 'catch_revolution_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since 1.0.0
    */
    function catch_revolution_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'catch_revolution_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since 1.0.0
    */
    function catch_revolution_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;
