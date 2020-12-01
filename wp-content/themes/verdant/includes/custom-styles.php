<?php
/**
 * Master generated style function
 *
 * @package Verdant
 */

/**
 * Add body classes to identify the child theme
 */
function verdant_body_classes( $classes ) {
	$classes[] = strtolower( wp_get_theme() ) . '-child';
	return $classes;
}
add_filter( 'body_class', 'verdant_body_classes', 15 );

/**
 * Dynamic styles for the frontend
 */
function verdant_custom_styling() {
    $options = cryout_get_option();
    extract($options);

    ob_start(); ?>

    /* Verdant custom style */

	.post-thumbnail-container .featured-image-link::before,
	.post-thumbnail-container .entry-meta > span {
		background-color: <?php echo esc_html( $kahuna_overlaybackground ) ?>;
	}

	#header-page-title {
		background-color: rgba(<?php echo esc_html( cryout_hex2rgb( $kahuna_overlaybackground ) ) ;?>, <?php echo esc_html( $kahuna_overlayopacity/100 ); ?>);
	}

	#header-page-title-inside {
		max-width: calc(<?php echo esc_html( $kahuna_sitewidth ) ?>px - 4em);
	}

	.lp-block:hover i[class^="blicon"]::before {
		background-color: <?php echo esc_html( $kahuna_accent2 ) ?>;
	}

	.lp-boxes-static .lp-box-title a,
	.lp-boxes-static .lp-box-title a:hover {
		color: <?php echo esc_html( $kahuna_accent2 ) ?>;
	}

	.lp-boxes-static .lp-box-image .box-overlay {
		background-color: <?php echo esc_html( $kahuna_accent2 ) ?>;
	}

	.continue-reading-link::before {
		background-color: <?php echo esc_html( $kahuna_accent2 ) ?>;
	}

	nav#mobile-menu a {
		font-family: <?php echo cryout_font_select( $kahuna_fmenu, $kahuna_fmenugoogle ) ?>;
	}

	.lp-staticslider .staticslider-caption-text,
	.seriousslider.seriousslider-theme .seriousslider-caption-text {
		font-family: <?php echo cryout_font_select( $kahuna_ftitles, $kahuna_ftitlesgoogle ) ?>;
	}

    /* end Verdant custom style */
    <?php
    return preg_replace( '/((background-)?color:\s*?)[;}]/i', '', ob_get_clean() );

} // verdant_custom_styling()


/**
 * Load custom styles
 */
function verdant_custom_styles( $style = '' ) {

	return $style . verdant_custom_styling();

} // verdant_custom_styles()
// this filer is applied in verdant_setup()


/* FIN */
