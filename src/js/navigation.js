/* global screenReaderText */
/**
 * Theme navigation configuration
 *
 * Contains handlers for navigation.
 */
let $ = require( 'jquery' );
let MotionUI = require( 'motion-ui' );

let primaryMenu = $( '#primary-menu' );

function initMainNavigation( container ) {
    primaryMenu.attr( {
        'data-responsive-menu': 'large-dropdown'
    } );

    // Add dropdown toggle that displays child menu items.
    let dropdownToggle = $( '<button />', {
            'class': 'dropdown-toggle',
            'aria-expanded': false,
        } )
        .append( screenReaderText.icon )
        .append( $( '<span />', {
            'class': 'screen-reader-text',
            text: screenReaderText.expand
        } ) );

    container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

    // Set the active submenu dropdown toggle button initial state.
    container.find( '.current-menu-ancestor > button' )
        .attr( 'aria-expanded', 'true' )
        .find( '.screen-reader-text' )
        .text( screenReaderText.collapse );

    // Set the active submenu initial state.
    container.find( '.dropdown-toggle' ).click(
        function( e ) {
            let _this = $( this );
            let screenReaderSpan = _this.find( '.screen-reader-text' );
            let subMenu = _this.next( '.children, .sub-menu' );

            e.preventDefault();
            _this.toggleClass( 'toggled-on' );
            subMenu.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' )
                .toggleClass( 'is-active' );

            screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
        }
    );

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
