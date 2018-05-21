/* global screenReaderText */
/**
 * Theme navigation configuration
 *
 * Contains handlers for navigation.
 */
import $ from "jquery";
import MotionUI from "motion-ui";

let primaryMenu = $( '#primary-menu' );

function initMainNavigation( container ) {
    primaryMenu.attr( {
        'data-responsive-menu': 'accordion large-dropdown',
        'data-submenu-toggle': "true"
    } );

    $( '.menu-toggle' ).on( 'click', function() {
        let _this = $( this );
        $( '.main-navigation' ).toggleClass( 'toggled-on' );
        toggleAnimation( primaryMenu, _this, 'slide-in-down', 'slide-out-up' );
    } );

}

/**
 *
 */
function toggleAnimation( ele, button, showAnimation, hideAnimation ) {
    if ( ele.hasClass( 'is-active' ) ) {
        button.removeClass( 'menu-active' );
        MotionUI.animateOut( ele, hideAnimation, function() {
            button.removeClass( 'toggled-on' );
            ele.removeClass( 'is-active' );
            ele.attr( 'style', '' );
        } );
    } else {
        button.addClass( 'menu-active' );
        MotionUI.animateIn( ele, showAnimation, function() {
            button.addClass( 'toggled-on' );
            ele.addClass( 'is-active' );
            ele.attr( 'style', '' );
        } );
    }
}

initMainNavigation( $( '.main-navigation' ) );
