( function( $ ) {
    $( '.menu-item-has-children > a' ).click( function( e ) {
        e.preventDefault();
        
        $( this ).parent().toggleClass( 'active' )
    } )

    $( '.tabs-nav a' ).click( function( e ) {
        e.preventDefault()

        $( '.tabs-nav a' ).removeClass( 'active' )
        $( '.tabs-panel div' ).removeClass( 'active' )

        $( this ).addClass( 'active' )
        $( $( this ).attr( 'href' ) ).addClass( 'active' )
    } )
} )( jQuery )