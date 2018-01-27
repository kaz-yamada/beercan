var $ = require( 'jquery' );

import MotionUI from 'motion-ui';

import Foundation from 'foundation-sites';

var scrollTopButton = $( '.scroll-to-top' );

$( document ).foundation();

$( document ).ready( function() {
    scrollTopButton.hide();
} );

$( window ).scroll( function() {
    if ( $( this ).scrollTop() > 100 ) {
        scrollTopButton.fadeIn();
    } else {
        scrollTopButton.fadeOut();
    }
} );

$( window ).on( 'changed.zf.mediaquery', function( event, newSize, oldSize ) {
    console.log( event );
    console.log( newSize );
} );

scrollTopButton.on( 'click', function() {
    $( "html, body" ).animate( {
        scrollTop: 0
    }, "slow" );
    return false;
} );
