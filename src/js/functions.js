var $ = require( 'jquery' );
var scrollTopButton = $( '.scroll-to-top' );

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

scrollTopButton.on( 'click', function() {
    $( "html, body" ).animate( {
        scrollTop: 0
    }, "slow" );
    return false;
} );
