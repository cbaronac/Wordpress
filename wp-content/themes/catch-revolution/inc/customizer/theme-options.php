<?php
/**
 * Theme Options
 *
 * @package Catch_Revolution
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_revolution_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'catch_revolution_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'catch-revolution' ),
		'priority' => 130,
	) );

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_latest_posts_title',
			'default'           => esc_html__( 'News', 'catch-revolution' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'catch-revolution' ),
			'section'           => 'catch_revolution_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'catch_revolution_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'catch-revolution' ),
		'panel' => 'catch_revolution_theme_options',
		)
	);

	/* Default Layout */
	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'catch-revolution' ),
			'section'           => 'catch_revolution_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar' => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-revolution' ),
				'no-sidebar'    => esc_html__( 'No Sidebar', 'catch-revolution' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_homepage_archive_layout',
			'default'           => 'no-sidebar',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'catch-revolution' ),
			'section'           => 'catch_revolution_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar' => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-revolution' ),
				'no-sidebar'    => esc_html__( 'No Sidebar', 'catch-revolution' ),
			),
		)
	);

	/* Single Page/Post Image */
	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'catch-revolution' ),
			'section'           => 'catch_revolution_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'disabled'        => esc_html__( 'Disabled', 'catch-revolution' ),
				'post-thumbnail'  => esc_html__( 'Post Thumbnail', 'catch-revolution' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_revolution_excerpt_options', array(
		'panel'     => 'catch_revolution_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'catch-revolution' ),
	) );

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'catch-revolution' ),
			'section'  => 'catch_revolution_excerpt_options',
			'type'     => 'number',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading', 'catch-revolution' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'catch-revolution' ),
			'section'           => 'catch_revolution_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_revolution_search_options', array(
		'panel'     => 'catch_revolution_theme_options',
		'title'     => esc_html__( 'Search Options', 'catch-revolution' ),
	) );

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_search_text',
			'default'           => esc_html__( 'Search', 'catch-revolution' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'catch-revolution' ),
			'section'           => 'catch_revolution_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'catch_revolution_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'catch-revolution' ),
		'panel'       => 'catch_revolution_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'catch-revolution' ),
	) );

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'News', 'catch-revolution' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'catch-revolution' ),
			'section'           => 'catch_revolution_homepage_options',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_static_page_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'catch_revolution_is_static_page_enabled',
			'default'           => esc_html__( 'Archives', 'catch-revolution' ),
			'label'             => esc_html__( 'Posts Page Header Text', 'catch-revolution' ),
			'section'           => 'catch_revolution_homepage_options',
		)
	);

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_front_page_category',
			'sanitize_callback' => 'catch_revolution_sanitize_category_list',
			'custom_control'    => 'Catch_Revolution_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'catch-revolution' ),
			'section'           => 'catch_revolution_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'catch_revolution_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'catch-revolution' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'catch_revolution_pagination_options', array(
		'description'     => $nav_desc,
		'panel'           => 'catch_revolution_theme_options',
		'title'           => esc_html__( 'Pagination Options', 'catch-revolution' ),
		'active_callback' => 'catch_revolution_scroll_plugins_inactive'
	) );

	catch_revolution_register_option( $wp_customize, array(
			'name'              => 'catch_revolution_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'catch_revolution_sanitize_select',
			'choices'           => catch_revolution_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'catch-revolution' ),
			'section'           => 'catch_revolution_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'catch_revolution_scrollup', array(
		'panel'    => 'catch_revolution_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'catch-revolution' ),
	) );

	$action = 'install-plugin';
	$slug   = 'to-top';

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

	// Add note to Scroll up Section
    catch_revolution_register_option( $wp_customize, array(
            'name'              => 'catch_revolution_to_top_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Revolution_Note_Control',
            'active_callback'   => 'catch_revolution_is_to_top_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Scroll Up, install %1$sTo Top%2$s Plugin', 'catch-revolution' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'catch_revolution_scrollup',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    catch_revolution_register_option( $wp_customize, array(
            'name'              => 'catch_revolution_to_top_option_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Revolution_Note_Control',
            'active_callback'   => 'catch_revolution_is_to_top_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For Scroll Up Options, go %1$shere%2$s', 'catch-revolution'  ),
                 '<a href="javascript:wp.customize.panel( \'to_top_panel\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_revolution_scrollup',
            'type'              => 'description',
        )
    );
}
add_action( 'customize_register', 'catch_revolution_theme_options' );

/** Active Callback Functions */
if ( ! function_exists( 'catch_revolution_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since 1.0.0
	*/
	function catch_revolution_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'catch_revolution_is_static_page_enabled' ) ) :
	/**
	* Return true if A Static Page is enabled
	*
	* @since 1.0.0
	*/
	function catch_revolution_is_static_page_enabled( $control ) {
		$enable = $control->manager->get_setting( 'show_on_front' )->value();
		if ( 'page' === $enable ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'catch_revolution_is_to_top_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * * @since 1.0.0
    */
    function catch_revolution_is_to_top_inactive( $control ) {
        return ! ( class_exists( 'To_Top' ) );
    }
endif;

if ( ! function_exists( 'catch_revolution_is_to_top_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * * @since 1.0.0
    */
    function catch_revolution_is_to_top_active( $control ) {
        return ( class_exists( 'To_Top' ) );
    }
endif;
