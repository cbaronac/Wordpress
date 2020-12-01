<?php
/**
 * Implementation of the Custom Header feature
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Set up the WordPress core custom header feature.
 *
 */
function ananya_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ananya_custom_header_args', array(
		'default-image'         => 	get_parent_theme_file_uri( '/assets/images/header.jpg' ),
        'header-text'			=>	true,
		'default-text-color'    => 	'ffffff',
		'width'                 => 	1920,
		'height'                => 	1080,
		'flex-height'           =>	true,
		'flex-width'			=>	true,
		'video'					=> 	true,
		'wp-head-callback'      => 	'ananya_header_style',
	) ) );

	register_default_headers(
		array(
			'default-image' => array(
				'url'           => '%s/assets/images/header.jpg',
				'thumbnail_url' => '%s/assets/images/header.jpg',
				'description'   => __( 'Default Header Image', 'ananya' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'ananya_custom_header_setup' );

if ( ! function_exists( 'ananya_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see ananya_custom_header_setup().
	 */
	function ananya_header_style() {
		$default_header_text_color = 'ffffff';
		$header_text_color   = get_header_textcolor();
		$header_text_color_rgb = ananya_hex2rgb( $header_text_color );
		$header_border_color_rgba = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $header_text_color_rgb );
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) {
			$header_width = get_custom_header()->width;
			$header_height = get_custom_header()->height;
		}
		$full_screen_header = get_theme_mod( 'ananya_full_screen_header_image_setting', true );
		?>
		<style type="text/css">
			<?php if( $default_header_text_color != $header_text_color ) { ?>
				.site-title a,.site-description, .navbar-light .navbar-toggler {
					color: #<?php echo esc_attr($header_text_color); ?>;
				}
				@media screen and (min-width: 768px) {
					#site-navigation .nav-menu-primary > li.menu-item > a,#site-navigation .nav-menu-primary > li.menu-item > a i, #site-navigation .nav-menu-primary > li.page_item > a,#site-navigation .nav-menu-primary > li.page_item > a i,.main-navigation a,.main-navigation a i,.header-social-menu li a,.header-social-menu li a i,.header-social-menu li #desktop-search-icon {
						color: #<?php echo esc_attr($header_text_color); ?>;
					}
				}
				@media screen and (min-width: 992px) {
					.header-social-menu ul {
						border-left: 1px solid <?php echo esc_attr($header_border_color_rgba); ?>;
					}
				}
				.custom-heading, .custom-heading h1, .custom-heading .subheading, .custom-heading .hero-section-btn a, .custom-heading .hero-section-btn a:visited {
					color: #<?php echo esc_attr($header_text_color); ?>;
				}
				.custom-heading .hero-section-btn {
					border-bottom: 1px solid #<?php echo esc_attr($header_text_color); ?>;
					color: #<?php echo esc_attr($header_text_color); ?>;
				}
				.home #site-navigation .container {
					border-bottom: 1px solid <?php echo esc_attr($header_border_color_rgba); ?>;
				}
			<?php } ?>
		<?php if ( !$full_screen_header ) : ?>
			.has-header-image .custom-header,
			.has-header-video .custom-header {
				display: table;
				height: 400px;
				height: 80vh;
				width: 100%;
			}
			.admin-bar .has-header-image .custom-header, 
			.admin-bar .has-header-video .custom-header {
				height: calc(80vh - 32px);
			}
			@media screen and (min-width: 768px) {
				.custom-header-media {
					height: 600px;
					height: 80vh;
					max-height: 100%;
					overflow: hidden;
					position: relative;
				}
				#masthead .custom-heading {
					bottom: 7%;
				}
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

/** 
 * Customizer setting to dispaly full screen header video/image on the front page.
 *
 * @since 1.0.0
 */
function ananya_custom_header_media_setup( $wp_customize ) {
	//  ================================
    //  = Add header section panel             =
    //  ================================
	$wp_customize->add_panel( 'header_section_panel', array(
	    'priority'       => 21,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __( 'Header Section', 'ananya'),
	    'description'    => '',
	) );
	//  ================================
    //  = Hero Header Media Type Options             =
    //  ================================
	$wp_customize->add_section( 'ananya_frontpage_header_type_section', array(
	  'title' 		=> 	__( 'Hero Section Text', 'ananya' ),
	  'panel' 		=> 	'header_section_panel', 
	  'priority' 	=> 	1,
	  'capability' 	=> 	'edit_theme_options',
	) );
	//  =============================
    //  = Hero Header/Banner Options              =
    //  =============================
	$wp_customize->add_setting( 'ananya_header_title', array(
	  'capability' 	=> 	'edit_theme_options',
	  'default' 	=>	 '',
	  'transport' 	=> 	'refresh', 
	  'sanitize_callback' => 'ananya_sanitize_text',
	) );
	$wp_customize->add_control( 'ananya_header_title', array(
	  'type' 		=> 	'text',
	  'priority' 	=> 	2, 
	  'section' 	=> 	'ananya_frontpage_header_type_section', 
	  'label' 		=> 	__( 'Enter Header/Banner Title', 'ananya' ),
	  'description' => 	__( '<i>This title will appear over the header image. Enter short title of upto two to three lines to avoid overlaping of the header title with the site title on mobile devices.</i>','ananya' ),
	  'settings'   	=> 	'ananya_header_title',
	) );

	//Hero Header/Banner Subtitle
	$wp_customize->add_setting( 'ananya_header_subtitle', array(
	  'capability' 	=> 	'edit_theme_options',
	  'default' 	=> 	'',
	  'transport' 	=> 	'refresh', 
	  'sanitize_callback' => 'ananya_sanitize_text',
	) );
	$wp_customize->add_control( 'ananya_header_subtitle', array(
	  'type' 		=> 	'text',
	  'priority' 	=> 	3, 
	  'settings'   	=> 	'ananya_header_subtitle',
	  'section' 	=> 	'ananya_frontpage_header_type_section', 
	  'label' 		=> 	__( 'Enter Header/Banner Sub Title', 'ananya' ),
	  'description' => 	__( '<i>This sub title will appear over the header image.</i>', 'ananya' ),
	) );
	$wp_customize->add_setting( 'ananya_header_button_text', array(
		'capability'=> 'edit_theme_options',
		'default'	=> '',
		'sanitize_callback' => 'ananya_sanitize_text',
    ) );
    $wp_customize->add_control( 'ananya_header_button_text', array(
        'label' 	=> 	__( 'Button text', 'ananya' ),
        'section' 	=> 	'ananya_frontpage_header_type_section',
        'settings'  =>  'ananya_header_button_text',
        'type' 		=> 	'text',
        'priority' 	=> 	4,
    ) );
    $wp_customize->add_setting( 'ananya_header_button_url', array(
    	'capability' => 'edit_theme_options',
        'default' 	 => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'ananya_header_button_url',array(
        'label' 	=> 	__( 'Button URL', 'ananya' ),
        'settings'  =>  'ananya_header_button_url',
        'section' 	=> 	'ananya_frontpage_header_type_section',
        'type' 		=> 	'text',
        'priority' 	=> 	5,
    ) );

    //  ===================================================
    //  = Move Header Image Section To Header Section Panel           =
    //  ===================================================
    $wp_customize->get_section( 'header_image' )->panel = 'header_section_panel';  
	//  ===================================================
    //  = Header Image Options section           =
    //  ===================================================
	$wp_customize->add_section( 'ananya_header_media_options_section', array(
	  'title' 		=> 	__( 'Header Media Options', 'ananya' ),
	  'panel' 		=> 	'header_section_panel', 
	  'priority' 	=> 	61,
	  'capability' 	=> 'edit_theme_options',
	) );  
	$wp_customize->add_setting( 'ananya_full_screen_header_image_setting', array(
	  'capability' 			=> 	'edit_theme_options',
	  'default' 			=> 	true,
	  'transport' 			=> 	'refresh', 
	  'sanitize_callback' 	=> 	'ananya_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'ananya_full_screen_header_image_setting', array(
	  'type' 				=> 	'checkbox',
	  'priority' 			=> 	1, 
	  'section' 			=> 	'ananya_header_media_options_section', 
	  'label' 				=> 	__( 'Full screen header', 'ananya' ),
	  'description' 		=> 	__('(Select the checkbox if you want full screen header video/image on the frontpage/homepage of your website.)', 'ananya'),
	  'settings'   			=> 	'ananya_full_screen_header_image_setting',
	) );
	$wp_customize->add_setting( 'ananya_use_header_image_only_on_front_page_setting', array(
	  'capability' 			=> 	'edit_theme_options',
	  'default' 			=> 	false,
	  'transport' 			=> 	'refresh', 
	  'sanitize_callback' 	=> 	'ananya_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'ananya_use_header_image_only_on_front_page_setting', array(
	  'type' 			=> 	'checkbox',
	  'priority' 		=> 	2, 
	  'section' 		=> 	'ananya_header_media_options_section', 
	  'label' 			=> 	__( 'Use header image only on frontpage/homepage.', 'ananya' ),
	  'description' 	=> 	__('(Select the checkbox if you do not want to use the header image on single post pages and other pages.)', 'ananya'),
	  'settings'   		=> 	'ananya_use_header_image_only_on_front_page_setting',
	) );
	//  =============================
    //  = Hero Media Overlay Options             =
    //  =============================
    $wp_customize->add_section( 'ananya_header_overlay_type_section', array(
	  'title' 		=> 	__( 'Header Media Overlay', 'ananya' ),
	  'panel' 		=> 	'header_section_panel', 
	  'priority' 	=> 	62,
	  'capability' 	=> 'edit_theme_options',
	) );
	$wp_customize->add_setting( 'ananya_header_overlay_type', array(
	  'type' 		=> 'theme_mod', 
	  'capability'	=> 'edit_theme_options',
	  'default' 	=> 'default',
	  'sanitize_callback' => 'ananya_sanitize_radio',
	) );
	$wp_customize->add_control( 'ananya_header_overlay_type', array(
	  'type' 		=> 'radio',
	  'priority' 	=> 1, 
	  'section' 	=> 'ananya_header_overlay_type_section', 
	  'label' 		=> __( 'Header Overlay Type', 'ananya' ),
	  'settings'   	=> 'ananya_header_overlay_type',
	  'choices'		=>  array(
		  	'default' 		=> 	__( 'Default', 'ananya'),
		  	'color'			=> 	__( 'Dark Color', 'ananya'),
		  	'no_overlay' 	=> 	__( 'No Overlay', 'ananya'),
	  ),
	) );
}
add_action( 'customize_register', 'ananya_custom_header_media_setup' );