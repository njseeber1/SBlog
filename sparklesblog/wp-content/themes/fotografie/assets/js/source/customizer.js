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
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );

( function( api ) {
	// Pagination: Show description only when Infinite Scroll is selected.
    wp.customize( 'fotografie_pagination_type', function( setting ) {
        setting.bind( function( value ) {
        	alert(value);
            if( 'infinite-scroll' == value ) {
                jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').show();
            }else{
                jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').hide();
            }
        } );
    } );
} )( wp.customize );

jQuery( document ).ready(function() {
    // Check and hide or show description as per the options.

    var pagination_type = jQuery('#customize-control-fotografie_pagination_type select').val();
    if( 'infinite-scroll' == pagination_type ) {
        jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').show();
    }else{
        jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').hide();
    }

} );
