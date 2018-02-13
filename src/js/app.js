var $ = require( 'jquery' );

import MotionUI from 'motion-ui';

import Foundation from 'foundation-sites';

var scrollTopButton = $( '.scroll-to-top' );

$( document ).foundation();

$( document ).ready( function() {
    scrollTopButton.hide();

    $( '.jetpack-portfolio-shortcode' ).addClass( 'grid-x grid-margin-x' );
} );

$( window ).scroll( function() {
    if ( $( this ).scrollTop() > 100 ) {
        scrollTopButton.fadeIn();
    } else {
        scrollTopButton.fadeOut();
    }
} );

scrollTopButton.on( 'click', function() {
    $( "html, body" ).animate( {
        scrollTop: 0
    }, "slow" );
    return false;
} );
