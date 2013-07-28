/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * since _sf 
 * Script is modified from _s
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
			if ( 'blank' == to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	//loop through all variables that need css updates customizer
	for(i=0; i<custStyle.length; i++) {
		wp.customize( custStyle[i].slug, function( value ) {
			value.bind( function( to ) {
				$(custStyle[i].selector).css(custStyle.property[i], to ? to : '' );
			});
		});
	};
	
	//console logging for testing purposes
	console.log(custStyle);
	for(i=0; i<custStyle.length; i++) {
		console.log(custStyle[i].slug);
		console.log(custStyle[i].property);
		console.log(custStyle[i].selector);
	};
} )( jQuery );