<?php
/**
 * Ananya functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ananya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ANANYA_PHP_INCLUDE', trailingslashit( get_template_directory() ) . 'inc/' );
define( 'ANANYA_CUSTOMIZER_INCLUDES', ANANYA_PHP_INCLUDE . 'customizer/includes/' );


if ( ! function_exists( 'ananya_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ananya_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ananya, use a find and replace
		 * to change 'ananya' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ananya', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'ananya' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ananya_custom_background_args', array(
			'default-color' => '#f8f8f8',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_image_size( 'ananya-prevnext-thumbnail', 80, 80, true );              /* Previous/Next Post navigation */
	}
endif;
add_action( 'after_setup_theme', 'ananya_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ananya_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ananya_content_width', 640 );
}
add_action( 'after_setup_theme', 'ananya_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ananya_widgets_init() {
	//Register for sidebar widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ananya' ),
		'id'            => 'ananya-sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ananya' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	//Regsiger fotter widget area left
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area - Left', 'ananya' ),
		'id'            => 'ananya-footer-widget-area-left',
		'description'   => esc_html__( 'Add widgets here.', 'ananya' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	//Regsiger fotter widget area center
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area - Center', 'ananya' ),
		'id'            => 'ananya-footer-widget-area-center',
		'description'   => esc_html__( 'Add widgets here.', 'ananya' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	//Regsiger fotter widget area Right
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area - Right', 'ananya' ),
		'id'            => 'ananya-footer-widget-area-right',
		'description'   => esc_html__( 'Add widgets here.', 'ananya' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '<span></h2>',
	) );
}
add_action( 'widgets_init', 'ananya_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ananya_scripts() {
	//Enqueue bootstrap style
	wp_enqueue_style( 'bootstrap-style',  get_template_directory_uri().'/assets/bootstrap/css/bootstrap.min.css' );
	//Enqueue fontawesome style
	wp_enqueue_style( 'ananya-fontawesome-style',  get_template_directory_uri().'/assets/font-awesome/css/all.min.css' );
	//Enqueue v4 compatibility fontawesome style 
	wp_enqueue_style( 'ananya-fontawesome-style',  get_template_directory_uri().'/assets/font-awesome/css/v4-shims.min.css' );
	
	//Enqueue Ananya style
	wp_enqueue_style( 'ananya-style', get_stylesheet_uri() );


	//Enqueue navigation script
	wp_enqueue_script( 'ananya-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20151215', true );
	wp_enqueue_script( 'ananya-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), '20151215', true );

	//Enqueue bootstrap js
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), false, true );	
	wp_enqueue_script( 'ananya-functions-js', get_template_directory_uri() . '/assets/js/ananya.js', array( 'jquery' ), false, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script(
		'ananya-navigation',
		'ananya_screenReaderText',
		array(
			'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'ananya' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'ananya' ) . '</span>',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'ananya_scripts' );

/**
 * Load google fornts selected by user.
 * @since 1.0
 *
 */
function ananya_google_fonts() {

	$fonts_url = '';
	
	$body_font = get_theme_mod( 'ananya_body_font_select', 'Open Sans' );
	$heading_font = get_theme_mod( 'ananya_heading_font_select', 'Playfair Display' );	
	
	$fonts_url = '';
	
	if ( '' !== $body_font ) {
		$body_font = esc_html( $body_font );
	} 
	if ( '' !== $heading_font ) {
		$heading_font = esc_html( $heading_font );
	}

	/** Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$body_font_on = _x( 'on', 'Google font for body text: on or off', 'ananya' );

	/* Translators: If there are characters in your language that are not
	* supported by heading font, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$heading_font_on = _x( 'on', ' Gogle font for heading text: on or off', 'ananya' );

	// Construct url query based on chosen fonts
	if ( 'off' !== $body_font_on || 'off' !== $heading_font_on ) {
		$font_families = array();
		if ( 'off' !== $body_font_on ) {
			$font_families[] = $body_font;
		}
		if ( 'off' !== $heading_font_on ) {
			$font_families[] = $heading_font;
		}
		
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			//'subset' => urlencode( 'cyrillic,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	wp_register_style( 'ananya-google-fonts', $fonts_url, array(), null );
	wp_enqueue_style( 'ananya-google-fonts' );
}

add_action( 'wp_enqueue_scripts', 'ananya_google_fonts' );

/**
 * Change Read More link.
 */
function ananya_excerpt_more( $more ) {
	if ( is_admin() ) { return $more; }
	$read_more_markup = ananya_more_link();
	return $read_more_markup;
}
add_filter( 'excerpt_more', 'ananya_excerpt_more' );

function ananya_modify_read_more_link() {
    $read_more_markup = ananya_more_link();
	return $read_more_markup;
}
add_filter( 'the_content_more_link', 'ananya_modify_read_more_link' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Functions to add header video settings.
 * @since 1.0
 */
function ananya_header_video_settings( $settings ) {
  $settings['minWidth'] = 680;
  $settings['minHeight'] = 400;
  return $settings;
}
add_filter( 'header_video_settings', 'ananya_header_video_settings' );

/**
 * Function which returns social media menu.
 * @since 1.0
 */
if ( ! function_exists( 'ananya_return_social_media_menu' ) ) {

	function ananya_return_social_media_menu( $social_class='' ) {

		$social_media_icons_html = '';
		$show_serchbox = get_theme_mod( 'ananya_searchbox_display_setting', true );
		
		//array of focial media icons which uses 'fas' class
		$fas_elements = array('envelope','envelope-open','envelope-square','shopping-cart','credit-card','gamepad','map-marker','heart','rss','rss-square','info-circle','info','film');

		$social_media_icons_html .= '<div id="socialMenuResponsive" class="'.esc_attr( $social_class ).'">';
			$social_media_icons_html .= '<ul>';
			if( true === get_theme_mod( 'ananya_social_media_menu_enable', false) ) {
				for($i=1; $i<=4; $i++ ){
					$social_media_icon[$i] = get_theme_mod( 'ananya_social_media_icon_'.$i, 'facebook-f' );
					$social_media_url[$i] = get_theme_mod( 'ananya_social_media_url_'.$i, '' );

					//find the fontawesome icon class
					if( in_array( $social_media_icon[$i], $fas_elements ) ){
						$icon_class[$i] = 'fas';	
					} else {
						$icon_class[$i] = 'fab';
					}
					
					if ( '' !== $social_media_url[$i]  ) :
						$social_media_icons_html .= '<li class="menu-item page-item"><a href="'.esc_url( $social_media_url[$i] ).'" target="_blank">
						<i class="'.esc_attr( $icon_class[$i] ).' fa-'.esc_attr( $social_media_icon[$i] ).'"></i></a></li>';
					endif;
				} //for loop end	
			} 

			if( true == $show_serchbox ) {
				$social_media_icons_html .= '<li  class="menu-item page-item menu-item-search" id="nav-search">
					<a id="desktop-search-icon" href="#"><span class="screen-reader-text">'. __( 'Search Icon','ananya' ).'</span><i class="fas fa-search"></i></a>
		        <div id="navbar-search-box">'.get_search_form( false ).'</div></li>';
		    } 

		$social_media_icons_html.= '</ul></div>';
		return $social_media_icons_html;
	} 
}