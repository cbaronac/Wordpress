<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ananya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	} ?>	
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ananya' ); ?></a>

	<?php
		$header_overlay_type = get_theme_mod( 'ananya_header_overlay_type', 'default' );

		if( 'default' === $header_overlay_type ) {
			$overlay_type_class = 'default-overlay';
		} elseif( 'color' === $header_overlay_type ) {
			$overlay_type_class  = 'color-overlay';
		} elseif( 'no_overlay' === $header_overlay_type ){
			$overlay_type_class = 'no-overlay';
		} else {
			$overlay_type_id  = '';
		} 
	?>
	<?php 
		$header_media_class = '';
		$header_image_on_only_frontpage = get_theme_mod( 'ananya_use_header_image_only_on_front_page_setting', false ); 
		if( has_header_image() || has_header_video() ) {
			if( ( is_front_page() ) && has_header_image() && has_header_video() ) {
				$header_media_class = 'has-header-image has-header-video';
			} elseif ( ( is_front_page() ) && has_header_image() ) {
				$header_media_class = 'has-header-image';
			} elseif ( ( is_front_page() ) && has_header_video() ) {
				$header_media_class = 'has-header-video';
			} else {
				if( !$header_image_on_only_frontpage && has_header_image() ){
					$header_media_class = 'has-header-image';
				} else { 
					$header_media_class = 'no-header-image';
				}
			} 
		} else {
			$header_media_class = 'no-header-image';
		}
	?>

	<header id="masthead" class="site-header <?php echo esc_attr( $overlay_type_class ); ?> <?php echo esc_attr( $header_media_class );?>">
		
		<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
		
		<?php if ( is_front_page() ) { 
			
			get_template_part( 'template-parts/header/header-media', 'front-page' );
			
		} else { 

			get_template_part( 'template-parts/header/header-media', 'other-page' );
		} ?>
	</header>
	
	<div class="ananya-popup-search-form">
        <div class="container">            
                <?php get_search_form(); ?>
        </div>
        <button class="ananya-close-popup"><span class="screen-reader-text"><?php esc_html_e( 'Close Search','ananya' ); ?></span><i class="fas fa-times"></i></button>
    </div>
	<div id="content" class="site-content">