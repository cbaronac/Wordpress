<?php
/**
 * Displays header top navigation
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<nav class="main-navigation navbar navbar-light navbar-expand-lg" id="site-navigation">
    <div class="container">
    	<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			$ananya_description = get_bloginfo( 'description', 'display' );
			if ( $ananya_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $ananya_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- site-branding -->

		
    	<button data-toggle="collapse" data-target=".collapse-grp" class="navbar-toggler" aria-controls="primary-menu navbarResponsive socialMenuResponsive" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','ananya'); ?>"><i class="fas fa-bars"></i></button>

        <?php 
			wp_nav_menu( array(
				'theme_location' 	=> 	'primary-menu',
				'menu_id'        	=> 	'primary-menu',
				'container'         => 	'div',
				'container_id'		=> 	'navbarResponsive',
				'container_class'   => 	'collapse-grp collapse navbar-collapse',
				'menu_id'			=> 	'nav-menu-primary',
				'menu_class'		=> 	'menu nav-menu-primary ml-auto',
				'fallback_cb' 		=> 	'ananya_default_menu',
			) ); 
		?>
    	
    	<?php if( true === get_theme_mod( 'ananya_social_media_menu_enable', false) || true === get_theme_mod( 'ananya_searchbox_display_setting', true )): ?>
    		<?php echo ananya_return_social_media_menu( 'collapse-grp header-social-menu collapse' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
    	<?php endif; ?>
    	
    </div><!-- container -->
</nav><!-- navbar-light -->