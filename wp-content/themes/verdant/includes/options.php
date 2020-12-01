<?php

/**
 * Defaults
 */
function verdant_defaults( $defaults = array() ) {

	$verdant_defaults = array(

		"kahuna_lpsliderimage"		=> esc_url( get_stylesheet_directory_uri() . '/resources/images/slider/verdant.jpg' ),
		"kahuna_menuheight"			=> 65,
		"kahuna_headerheight"		=> 400,

		"kahuna_fheight"			=> 300,

		"kahuna_overlayopacity"		=> 60,
		"kahuna_overlaybackground"	=> "#5d71b3",

		"kahuna_sitebackground" 	=> "#ffffff",
		"kahuna_sitetext" 			=> "#777777",
		"kahuna_headingstext"		=> "#5d71b3",
		"kahuna_contentbackground"	=> "#FFFFFF",
		"kahuna_accent1" 			=> "#d40560",
		"kahuna_accent2" 			=> "#5d71b3",
		"kahuna_menubackground"		=> "#FFFFFF",
		"kahuna_menutext" 			=> "#5d71b3",
		"kahuna_submenutext" 		=> "#5d71b3",

		"kahuna_footerbackground" 	=> "#0a0908",
		"kahuna_footertext" 		=> "#FFFFFF",

		// "kahuna_fgeneral" 	=> '',
		"kahuna_fgeneralgoogle" 	=> 'Nunito',
		"kahuna_fgeneralsize" 		=> '16px',
		"kahuna_fgeneralweight" 	=> '400',

		//"kahuna_fsitetitle" 	=> '',
		"kahuna_fsitetitlegoogle"	=> 'Nunito',
		"kahuna_fsitetitlesize" 	=> '110%',
		"kahuna_fsitetitleweight"	=> '700',

		//"kahuna_fmenu" 			=> '',
		"kahuna_fmenugoogle"		=> 'Nunito',
		"kahuna_fmenusize" 			=> '90%',
		"kahuna_fmenuweight"		=> '700',

		//"kahuna_ftitles" 	=> '',
		"kahuna_ftitlesgoogle"		=> 'Nunito',
		"kahuna_ftitlessize" 		=> '220%',
		"kahuna_ftitlesweight"		=> '700',

		//"kahuna_metatitles" 	=> '',
		"kahuna_metatitlesgoogle"	=> 'Nunito',
		"kahuna_metatitlessize" 	=> '80%',
		"kahuna_metatitlesweight"	=> '400',

		//"kahuna_fheadings" 	=> '',
		"kahuna_fheadingsgoogle"	=> 'Nunito',
		"kahuna_fheadingssize" 		=> '130%',
		"kahuna_fheadingsweight"	=> '700',
		"kahuna_fheadingsvariant"	=> '',

		//"kahuna_fwtitle" 		=> '',
		"kahuna_fwtitlegoogle"	=> 'Nunito',
		"kahuna_fwtitlesize" 	=> '100%',
		"kahuna_fwtitleweight"	=> '700',

		//"kahuna_fwcontent" 	=> '',
		"kahuna_fwcontentgoogle"	=> 'Nunito',
		"kahuna_fwcontentsize" 		=> '100%',
		"kahuna_fwcontentweight"	=> '400',

		"kahuna_excerptlength"		=> 35,
		"kahuna_excerptcont"		=> __( 'Read more', 'verdant' ),
	); // verdant_defaults array

	$result = array_merge( $defaults, $verdant_defaults );

	return $result;

} // verdant_defaults()
add_filter( 'kahuna_option_defaults_array', 'verdant_defaults' );

// needed? for the .org preview
function verdant_filter_defaults(){
	add_filter( 'kahuna_option_defaults_array', 'verdant_defaults' );
} // verdant_filter_defaults()
add_action( 'customize_register', 'verdant_filter_defaults' );


/**
 * Handle theme labels in customize panels
 */
function verdant_about_theme_name( $initial ) {
	return __( 'About Verdant', 'verdant' );
} // verdant_about_theme_name()
add_filter( 'cryout_about_theme_name', 'verdant_about_theme_name' );

function verdant_about_theme_plus_desc( $initial ) {
	$theme = wp_get_theme();
	// translators: %1 is the Child theme name, %2 is the Parent theme name
	return '<h3>' . sprintf( esc_html__( '%1$s is a child theme of %2$s', 'verdant' ), esc_html( $theme->get( 'Name' ) ), ucwords( esc_html( $theme->get( 'Template' ) ) ) ) . '</h3>' . $initial;
} // verdant_about_theme_plus_desc()
add_filter( 'cryout_about_theme_plus_desc', 'verdant_about_theme_plus_desc' );

function verdant_about_theme_slug_swap( $initial ){
	return str_replace( array( 'kahuna', 'Kahuna' ), array( 'verdant', 'Verdant' ), $initial );
} // verdant_about_theme_slug_swap()
add_filter( 'cryout_about_theme_review_link', 'verdant_about_theme_slug_swap' );
add_filter( 'cryout_about_theme_manage_link', 'verdant_about_theme_slug_swap' );

// FIN
