/* global screenReaderText */
/**
 * Theme navigation configuration
 *
 * Contains handlers for navigation.
 */

( function( $ ) {
    function initMainNavigation( container ) {
        $( '#primary-menu' ).attr( {
            'data-responsive-menu': 'large-dropdown'
        } );

        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $( '<button />', {
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
            .addClass( 'toggled-on' )
            .attr( 'aria-expanded', 'true' )
            .find( '.screen-reader-text' )
            .text( screenReaderText.collapse );

        // Set the active submenu initial state.
        container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

        container.find( '.dropdown-toggle' ).click(
            function( e ) {
                var _this = $( this ),
                    screenReaderSpan = _this.find( '.screen-reader-text' );

                e.preventDefault();
                _this.toggleClass( 'toggled-on js-dropdown-active' );
                _this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on js-dropdown-active' );

                _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

                screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
            }
        );

        $( '.menu-toggle' ).on( 'click', function() {
            $( '#primary-menu' ).toggleClass( 'toggled-on' );
            $( this ).toggleClass( 'menu-active' );
        } );
    }

    initMainNavigation( $( '.main-navigation' ) );
} )( jQuery );
