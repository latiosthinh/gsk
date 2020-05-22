( function( $ ) {
    $( '.menu-item-has-children' ).click( function() {
        $( this ).toggleClass( 'active' )
    } )

    $( '.tabs-nav a' ).click( function() {
        $( '.tabs-nav a' ).removeClass( 'active' )
        $( '.tabs-panel div' ).removeClass( 'active' )

        $( this ).addClass( 'active' )
        $( $( this ).attr( 'href' ) ).addClass( 'active' )
    } )
} )( jQuery )