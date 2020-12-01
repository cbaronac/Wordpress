<?php

/**
 * Replace parent theme admin page with child theme page to use appropriate theme labelling
 */
function verdant_replace_admin_page() {
	remove_action( 'admin_menu', 'kahuna_add_page_fn' );
} // verdant_replace_admin_page()
add_action( 'init', 'verdant_replace_admin_page', 11 );

function verdant_add_page_fn() {
	global $kahuna_page;
	$kahuna_page = add_theme_page( __( 'Verdant Theme', 'verdant' ), __( 'Verdant Theme', 'verdant' ), 'edit_theme_options', 'about-verdant-theme', 'kahuna_page_fn' );
	add_action( 'admin_enqueue_scripts', 'kahuna_admin_scripts' );
} // verdant_add_page_fn()
add_action( 'admin_menu', 'verdant_add_page_fn' );

/**
 * Add child theme version to admin page
 */
function verdant_admin_version_output( $parent ) {
	$theme = wp_get_theme();
	$name = $theme->get( 'Name' );
	$version = $theme->get( 'Version' );

	// translators: %1 is the Child theme name, %2 is the Child theme version, %3 is the Parent theme name
	return sprintf( __( '<em>%1$s v%2$s</em> &ndash; a child theme of %3$s', 'verdant' ), $theme, $version, $parent );
} // verdant_admin_version_output()
// this filter is applied in verdant_setup()

/**
 * Extend description to reference the use of the child theme
 */
function verdant_custom_description( $description ) {
	// Child theme
	$theme = wp_get_theme();
	$template = esc_html( $theme->get( 'Template' ) );
	$name = esc_html( $theme->get( 'Name' ) );

	// Parent theme
	$template_theme = wp_get_theme( $template );
	$template_desc = $template_theme->get( 'Description');

	// translators: %1 is the Child theme name, %2 is the Parent theme name
	$output = '<h3>' . sprintf( esc_html__( '%1$s is a child theme of %2$s', 'verdant' ), $name,  ucfirst( $template ) ) . '</h3>';

	return  $output . $description . '<br><br><hr><br><em>' . $template_desc . '</em>';
} // verdant_custom_description()
// this filter is added in verdant_setup()


// FIN
