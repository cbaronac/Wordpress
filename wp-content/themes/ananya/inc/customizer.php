<?php
/**
 * Ananya Theme Customizer
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer and add other theme options in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ananya_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ananya_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ananya_customize_partial_blogdescription',
		) );
	}
	//  =======================================================================
    //  = Accent color setting           =
    //  =======================================================================
	$wp_customize->add_setting( 'ananya_accent_color', array(
		'default'           => '#057B7C',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ananya_accent_color', array(
		'label'       => __( 'Accent Color', 'ananya' ),
		'section'     => 'colors',
		'settings'    => 'ananya_accent_color',
		'description' => __( 'Applied to some of the elements.', 'ananya' ),
	) ) );

	//  =======================================================================
    //  = Add theme other options panel          =
    //  =======================================================================

	$wp_customize->add_panel( 'ananya_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Theme Other Options', 'ananya' ),
		'description'    => '',
	) );
	
	//  =======================================================================
    //  = Blog Page Layout Section       =
    //  =======================================================================
	$wp_customize->add_section( 'ananya_blog_page_options_section', array(
	  'title' 		=> 	__( 'Blog Page Settings', 'ananya' ),
	  'priority' 	=> 	1,
	  'capability' 	=> 	'edit_theme_options',
	  'panel' 		=> 	'ananya_options_panel',
	) );

	//  =======================================================================
    //  = Post content display option: Post Excerpt/Full Post            =
    //  =======================================================================
	$wp_customize->add_setting( 'ananya_post_display_type_option', array(
	    'default'        	=> 	'post-excerpt',
	    'sanitize_callback' => 	'ananya_sanitize_post_display_option',
		'transport'         => 	'refresh',
	));
	$wp_customize->add_control( 'ananya_post_display_type_option', 
		array(
		    'label'      	=>	__( 'How would you like to dispaly post content on Blog posts index page?', 'ananya' ),
		    'section'    	=> 	'ananya_blog_page_options_section',
		    'settings'   	=> 	'ananya_post_display_type_option',
		    'type'       	=> 	'radio',
		    'choices'    	=> 	array(
		        'post-excerpt'	=>	__( 'Post Excerpt', 'ananya' ),
		        'full-post'		=>	__( 'Full Post', 'ananya' ),
			),
	));

	//  =======================================================================
    //  = Disable/Hide footer on blog page           =
    //  =======================================================================
	$wp_customize->add_setting( 'ananya_hide_blog_page_post_footer_option', array(
	    'default'        	=> 	false,
	    'sanitize_callback' => 	'ananya_sanitize_checkbox',
		'transport'         => 	'refresh',
	));
	$wp_customize->add_control( 'ananya_hide_blog_page_post_footer_option', 
		array(
			'label' 		=> 	__( 'Hide footer of a post on Blog posts index page.', 'ananya' ),
			'description' 	=> 	__( 'If you select this option the blog post footer which has post\'s Categories and Social Media Sharing buttons will be removed.', 'ananya'),
		    'section'    	=> 	'ananya_blog_page_options_section',
		    'settings'   	=> 	'ananya_hide_blog_page_post_footer_option',
		    'type'       	=> 	'checkbox',
	));
	//  =======================================================================
    //  = Single Post Option: Section            =
    //  =======================================================================
	$wp_customize->add_section( 'ananya_single_post_settings_section', array(
	  'title' 		=> 	__( 'Single Post Settings', 'ananya' ),
	  'priority' 	=> 	3,
	  'capability' 	=> 	'edit_theme_options',
	  'panel' 		=> 	'ananya_options_panel',
	) );

	//  =======================================================================
    //  = Disable/Hide default social media icons on a single page           =
    //  =======================================================================
	$wp_customize->add_setting( 'ananya_hide_single_post_share_option', array(
	    'default'        	=> 	false,
	    'transport'         => 	'refresh',
	    'sanitize_callback' => 	'ananya_sanitize_checkbox',
	));
	$wp_customize->add_control( 'ananya_hide_single_post_share_option', 
		array(
		  	'label' 		=> 	__( 'Hide social media sharing icons on a single post.', 'ananya' ),
		    'section'    	=> 	'ananya_single_post_settings_section',
		    'settings'   	=> 	'ananya_hide_single_post_share_option',
		    'type'       	=> 	'checkbox',
	));
	//  ====================================================================
    //  = Social Media Options: Select any four social media services to display on home page  =
    //  ====================================================================
	$wp_customize->add_section( 'ananya_social_media_settings_section', array(
	  'title' 		=> 	__( 'Social Menu Section', 'ananya' ),
	  'priority' 	=> 	4,
	  'capability' 	=> 	'edit_theme_options',
	  'panel' 		=> 	'ananya_options_panel',
	) );
	$wp_customize->add_setting( 'ananya_social_media_menu_enable', array(
	  'capability' 	=> 	'edit_theme_options',
	  'default' 	=> 	false,
	  'transport' 	=> 	'refresh', 
	  'sanitize_callback' => 'ananya_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'ananya_social_media_menu_enable', array(
	  'type' 		=> 	'checkbox',
	  'priority' 	=> 	1, 
	  'section' 	=> 	'ananya_social_media_settings_section', 
	  'label' 		=> 	__( 'Enable Social Media Icons in top Navigation.', 'ananya' ),
	  'settings'   	=> 	'ananya_social_media_menu_enable',
	) );

	// Social Icons Array
	$social_media_names = array(
		'facebook-f' 			=> 'Facebook',
		'facebook-square' 		=> 'Facebook Square',
		'twitter' 				=> 'Twitter',
		'twitter-square' 		=> 'Twitter Square',
		'google' 				=> 'Google',
		'linkedin'				=> 'Linkedin Square',
		'linkedin-in' 			=> 'LinkedIn',
		'pinterest' 			=> 'Pinterest',
		'pinterest-square'		=> 'Pinterest Square',
		'behance' 				=> 'Behance',
		'behance-square'		=> 'Behance Square',
		'tumblr' 				=> 'Tumblr',
		'tumblr-square' 		=> 'Tumblr Square',
		'reddit' 				=> 'Reddit',
		'reddit-square' 		=> 'Reddit Square',
		'dribbble' 				=> 'Dribbble',
		'vk' 					=> 'vKontakte',
		'skype' 				=> 'Skype',
		'film' 					=> 'Film',
		'youtube' 				=> 'Youtube',
		'youtube-square' 		=> 'Youtube Square',
		'vimeo-v'				=> 'Vimeo',
		'vimeo'					=> 'Vimeo Square 1',
		'vimeo-square' 			=> 'Vimeo Square 2',
		'soundcloud' 			=> 'Soundcloud',
		'instagram' 			=> 'Instagram',
		'info' 					=> 'Info',
		'info-circle' 			=> 'Info Circle',
		'flickr' 				=> 'Flickr',
		'rss' 					=> 'RSS',
		'rss-square' 			=> 'RSS Square',
		'heart' 				=> 'Heart',
		'github' 				=> 'Github',
		'github-alt' 			=> 'Github Alt',
		'github-square' 		=> 'Github Square',
		'stack-overflow' 		=> 'Stack Overflow',
		'qq' 					=> 'QQ',
		'weibo' 				=> 'Weibo',
		'weixin' 				=> 'Weixin',
		'xing' 					=> 'Xing',
		'xing-square' 			=> 'Xing Square',
		'gamepad' 				=> 'Gamepad',
		'medium' 				=> 'Medium',
		'map-marker' 			=> 'Map Marker',
		'envelope' 				=> 'Envelope',
		'envelope-open' 		=> 'Envelope Open',
		'envelope-square' 		=> 'Envelope Square',
		'spotify'				=> 'Spotify',
		'shopping-cart'			=> __( 'Cart', 'ananya' ),
		'cc-paypal' 			=> 'PayPal',
		'credit-card' 			=> __( 'Credit Card', 'ananya' ), 
	);
	
	for( $count=1; $count<=4; $count++ ) {
		
		$wp_customize->add_setting( 'ananya_social_media_icon_'.$count, array(
			'default'	 		=> 	'facebook-f',
			'transport'	 		=> 	'refresh',
			'capability' 		=> 	'edit_theme_options',
			'sanitize_callback' => 	'ananya_sanitize_select'
		) );
		$wp_customize->add_control( 'ananya_social_media_icon_'.$count, 
			array(
				'label'			=> 	__( 'Social Media Name', 'ananya' ),
				'settings'		=> 	'ananya_social_media_icon_'.$count,
				'section'		=> 	'ananya_social_media_settings_section',
				'type'			=> 	'select',
				'choices' 		=> 	$social_media_names,
				'priority'		=> 	$count+1,
		) );
		$wp_customize->add_setting( 'ananya_social_media_url_'.$count, array(
			'default'	 		=> 	'',
			'transport'	 		=> 	'refresh',
			'capability' 		=> 	'edit_theme_options',
			'sanitize_callback' => 	'esc_url'
		) );
		$wp_customize->add_control( 'ananya_social_media_url_'.$count, 
			array(
				'label'			=> 	__( 'Social Media URL', 'ananya' ),
				'settings'		=> 	'ananya_social_media_url_'.$count,
				'section'		=> 	'ananya_social_media_settings_section',
				'type'			=> 	'text',
				'priority'		=> 	$count+1,
		) );
	}
	//  =======================================================================
    //  = Searchbox Section           =
    //  =======================================================================
	$wp_customize->add_section( 'ananya_searchbox_section', 
		array(
			'title'		=> 	__( 'Search Box', 'ananya' ),
			'panel'		=> 	'ananya_options_panel',
			'priority' 	=> 	5,
		)
	);
	//Add setting for diplaying search box to primary navigation menu.
	$wp_customize->add_setting(
		'ananya_searchbox_display_setting',
		array(
			'default'           => 	true,
			'transport'         => 	'refresh',
			'sanitize_callback' => 	'ananya_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'ananya_searchbox_display_setting',
		array(
			'type' 		=> 	'checkbox',
			'label' 	=> 	__( 'Add Search button to the Top Navigation.', 'ananya' ),
			'priority'	=> 	1,
			'settings'	=> 	'ananya_searchbox_display_setting',
			'section'	=> 	'ananya_searchbox_section',
		)
	);
	//  =======================================================================
    //  = Typography Section        =
    //  =======================================================================
	$wp_customize->add_section( 'ananya_font_family_section', array(
		'title' 		=> 	__( 'Typography', 'ananya' ),
		'priority' 	=> 	1,
		'capability' 	=> 	'edit_theme_options',
		'priority'       => 42,
	) );
	//Set recomended fonts array for body and heading
	$font_family = array(
		'Lato'		=> 'Lato',
		'Lora' 		=> 'Lora',
		'Libre Franklin' => 'Libre Franklin',
		'Open Sans' => 'Open Sans',
		'Playfair Display' => 'Playfair Display',
		'Pacifico' 	=> 'Pacifico',
	);
	//  =======================================================================
    //  = Heading Font Settings         =
    //  =======================================================================
	$wp_customize->add_setting( 'ananya_heading_font_select',
		array(
			'default'	 		=> 	'Playfair Display',
			'transport'	 		=> 	'refresh',
			'capability' 		=> 	'edit_theme_options',
			'sanitize_callback' => 	'ananya_sanitize_select'
		)
	);
	$wp_customize->add_control( 'ananya_heading_font_select',
		array(
			'type'			=> 'select',
			'label' 		=> __( 'Heading Font', 'ananya' ),
			'description' 	=> '',
			'section' 		=> 'ananya_font_family_section',
			'settings' 		=> 'ananya_heading_font_select',
			'choices'		=> $font_family,
		)
	);
	//  =======================================================================
    //  = Body Font Settings         =
    //  =======================================================================
	$wp_customize->add_setting( 'ananya_body_font_select',
		array(
			'default'	 		=> 	'Open Sans',
			'transport'	 		=> 	'refresh',
			'capability' 		=> 	'edit_theme_options',
			'sanitize_callback' => 	'ananya_sanitize_select'
		) 
	);
	$wp_customize->add_control( 'ananya_body_font_select',
		array(
			'type'	=> 'select',
			'label' => __( 'Body Font Family', 'ananya' ),
			'description' => '',
			'section' => 'ananya_font_family_section',
			'settings' => 'ananya_body_font_select',
			'choices'	=> $font_family,
		) 
	);
}
add_action( 'customize_register', 'ananya_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ananya_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ananya_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ananya_customize_preview_js() {
	wp_enqueue_script( 'ananya-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'ananya_customize_preview_js' );

/**
* This will output the custom WordPress settings to the live theme's WP head.
*
* Used by hook: 'wp_head'
*
* @see add_action('wp_head',$func)
* @since 1.0
*/
function ananya_header_output() {
	$accent_color = get_theme_mod( 'ananya_accent_color', '#057B7C' );
	$accent_color = esc_attr( $accent_color );
	$body_font = get_theme_mod( 'ananya_body_font_select', 'Open Sans' );
	$heading_font = get_theme_mod( 'ananya_heading_font_select', 'Playfair Display' );	
	?>
	<!--Customizer CSS-->
	<style type="text/css">
		.entry-summary .read-more .btn,
		.widget a:hover, .widget a:focus,
		a {
			color: <?php echo esc_attr( $accent_color ); ?>;
		}
		.top-cat-link, .entry-meta .posted-on a {
			border-bottom: 2px solid <?php echo esc_attr( $accent_color ); ?>;	
		}
		.entry-header a:hover, blockquote:before,
		.footer-cotegory-links i, .footer-tag-links i,.entry-edit-link a, .entry-edit-link a:visited, .entry-edit-link a:focus, .social-share a i, .social-share a:visited, .social-share a:focus i {
			color: <?php echo esc_attr( $accent_color ); ?>;
		}
		.read-more .more-link,
		.read-more a:visited {
			background-color: <?php echo esc_attr( $accent_color ); ?>;
			color: #fff;
		}
		.read-more .more-link {
			outline-color: <?php echo esc_attr( $accent_color ); ?>;
			outline-offset: 5px;
		}
		.pagination .current {
			background-color: <?php echo esc_attr( $accent_color ); ?>;
			border: 1px solid <?php echo esc_attr( $accent_color ); ?>;	;
			color: #fff;
		}
		#secondary .widget .widget-title {
			border-bottom: 2px solid <?php echo esc_attr( $accent_color ); ?>;
			color: <?php echo esc_attr( $accent_color ); ?>;
		}
		button, input[type=button], input[type=reset], input[type=submit],
		.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
		.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, #infinite-handle span {
			border-radius: 3px;
			background: <?php echo esc_attr( $accent_color ); ?>;
			color: #fff;
		}
		.main-navigation ul ul a:hover,
		.main-navigation ul ul a:focus {
		    color: <?php echo esc_attr( $accent_color ); ?>;
		}
		@media screen and (max-width: 992px) {
			.main-navigation ul a:hover,
			.main-navigation ul a:focus {
			    color: <?php echo esc_attr( $accent_color ); ?>;
			}
			.main-navigation ul a:focus,
			.main-navigation .dropdown-toggle:focus,
			.main-navigation ul #navbar-search-box .search-field:focus {
			  outline: 1px solid;
			  outline-offset: -2px;
			  outline-color: <?php echo esc_attr( $accent_color ); ?>;
			}
		}
		body {
			font-family: '<?php echo esc_attr($body_font);?>',sans-serif;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: '<?php echo esc_attr($heading_font);?>',serif;
		}
	</style>
	<!--/Customizer CSS-->
<?php
}
// Output custom CSS to live site
add_action( 'wp_head' ,  'ananya_header_output' );

/**
 * Sanitize Radio Control Setting
 * @since 1.0.0
 */
function ananya_sanitize_radio( $input, $setting ) {
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
 
    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
  
}

/**
 * Sanitize Checkbox Control Setting
 * @since 1.0.0
 */
function ananya_sanitize_checkbox( $input ){
     
    // Boolean check.
	return ( ( isset( $input ) && true === $input ) ? true : false );
}

/**
 * Sanitize Text Control Setting
 * @since 1.0.0
 */
function ananya_sanitize_text( $input ) {
    /**          
    * @var array[] $allowedtags Array of KSES allowed HTML elements.
    * @since 1.0.0
    */
        $allowedtags = array(
                 'a'          => array(
                         'href'  => true,
                         'title' => true,
                 ),
                 'abbr'       => array(
                         'title' => true,
                 ),
                 'acronym'    => array(
                         'title' => true,
                 ),
                 'b'          => array(),
                 'blockquote' => array(
                         'cite' => true,
                 ),
                 'br'         => array(),
                 'button'     => array(
                         'disabled' => true,
                         'name'     => true,
                         'type'     => true,
                         'value'    => true,
                 ),
                 'cite'       => array(),
                 'code'       => array(),
                 'del'        => array(
                         'datetime' => true,
                 ),
                 'em'         => array(),
                 'i'          => array(),
                 'q'          => array(
                         'cite' => true,
                 ),
                 's'          => array(),
                 'strike'     => array(),
                 'strong'     => array(),
        );
    return wp_kses( force_balance_tags( $input ), $allowedtags );
}

/**
 * Sanitize Select Control Setting
 * @since 1.0.0
 */
function ananya_sanitize_select( $input, $setting ) {
	
	// get all select options
	$options = $setting->manager->get_control( $setting->id )->choices;
	
	// return default if not valid
	return ( array_key_exists( $input, $options ) ? $input : $setting->default );
}

/**
 * Returns true if header media type is image.
 * @since 1.0.0
 */
function ananya_is_header_media_image( $control ) {
	if ( 'image' === $control->manager->get_setting( 'ananya_frontpage_header_type' )->value() ) {
		return true;
	} else {
		return false;
	}
}

if ( ! function_exists( 'ananya_sanitize_post_display_option' ) ) :
	/**
	 * Sanitization callback for post display option.
	 *
	 *
	 * @param string $value post display style.
	 * @return string $value post display style.
	 * @since 1.0
	 */

	function ananya_sanitize_post_display_option( $value ) {
	    if ( ! in_array( $value, array( 'post-excerpt', 'full-post' ) ) ) {
	        $value = 'post-excerpt';
	    }
	    return $value;
	}
endif; // ananya_sanitize_post_display_option

/**
 * Convert HEX to RGB.
 *
 * @since Ananyapro 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function ananya_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}