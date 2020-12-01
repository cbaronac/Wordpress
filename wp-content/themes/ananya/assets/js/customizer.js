/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a,.site-description,#site-navigation .nav-menu-primary > li.menu-item > a, #site-navigation .nav-menu-primary > li.page_item > a,.main-navigation a,.header-social-menu li a i' ).css( {
					'color': to
				} );
				$('.navbar-toggler').css({
					'color': to
				});
				$('.header-social-menu ul').css( {
					'border-left': '1px solid ' + to
				} );
				$( '.custom-heading, .custom-heading h1, .custom-heading .subheading, .custom-heading .hero-section-btn a, .custom-heading .hero-section-btn a:visited' ).css({
					'color': to
				});
				$( '.custom-heading .hero-section-btn ' ).css({
					'border-bottom': '1px solid' + to,
					'color': to
				});
				$( '.home #site-navigation .container' ).css({
					'border-bottom': '1px solid' + to
				});
			}
		} );
	} );


	// Accent color.
	wp.customize( 'ananya_accent_color', function( value ) {
		value.bind( function( to ) {
				$( '.entry-summary .read-more .btn, .widget a:hover, .widget a:focus, .entry-content a,.comment-form a' ).css( {
					'color': to
				});
				$( '.top-cat-link, .entry-meta .posted-on a' ).css( {
					'border-bottom': '2px solid ' + to
				});
				$( '.entry-header a:hover, blockquote:before,.footer-cotegory-links i, .footer-tag-links i,.entry-edit-link a, .entry-edit-link a:visited, .entry-edit-link a:focus, .social-share a i, .social-share a:visited, .social-share a:focus i' ).css( {
					'color': to
				});
				$( '.read-more .more-link,.read-more a:visited, .pagination .current' ).css( {
					'background-color': to,
					'border': '1px solid' + to,
					'color': '#fff'
				});
				$( '#secondary  .widget .widget-title' ).css( {
					'border-bottom': '2px solid ' + to,
					'color': to
				} );
				$( 'button:not(.hero-section-btn,.wp-custom-header-video-button), input[type=button], input[type=reset], input[type=submit],.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, #infinite-handle span' ).css( {
					'border-radius': '3px',
					'background':to,
					'color':'fff'
				});

		} );
	} );

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	//
	wp.customize( 'header_image', function( value ) {
		value.bind( function( to ) {
			
			var image = wp.customize( 'header_image' )();
			var video = wp.customize( 'header_video' )();

			if( !hasHeaderImage() && !hasHeaderVideo() ) {
				$('#masthead').removeClass( 'has-header-image' );
				$('#masthead').addClass( 'no-header-image' );
				$('.no-header-image .custom-header').css({
					'display':'none'
				});
				$('.no-header-image .default-overlay #site-navigation').css({
					'background-image': 'none'
				});
			} else if( hasHeaderVideo() && !hasHeaderImage() ) {
				$('#masthead').removeClass( 'has-header-image' );
			} else if( hasHeaderImage() ) {
				$('#masthead').addClass( 'has-header-image');
				$('#masthead').removeClass( 'no-header-image' );
				$('.has-header-image .custom-header').css({
					'display':'block'
				});
			}
		} );	
	} );

	wp.customize( 'header_video', function( value ) {
		value.bind( function( to ) {
			
			var image = wp.customize( 'header_image' )();
			var video = wp.customize( 'header_video' )();
			var externalVideo = wp.customize( 'external_header_video' )();

			if ( !hasHeaderImage() && !hasHeaderVideo() ) {
				$('#masthead').removeClass( 'has-header-video' );
				$('#masthead').addClass( 'no-header-image' );
				$('.no-header-image .custom-header').css({
					'display':'none'
				});
				$('.no-header-image .default-overlay #site-navigation').css({
					'background-image': 'none'
				});
			} else if( hasHeaderImage() ){
				$('#masthead').removeClass( 'has-header-video' );
			} else if( hasHeaderVideo() ) {
				$('#masthead').removeClass( 'no-header-image' );
				$('#masthead').addClass( 'has-header-video' );
				$('.has-header-video .custom-header').css({
					'display':'block'
				});
			}
		} );	
	} );
} )( jQuery );
