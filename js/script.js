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

    $( '.woocommerce-ordering select' ).select2()

    $( '.products-slider' ).slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<a class="slick-prev"><img src="' + php_data.img_dir + '/prev.png" /></a>',
        nextArrow: '<a class="slick-next"><img src="' + php_data.img_dir + '/next.png" /></a>',
    })

    $( '.blog-slider' ).slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<a class="slick-prev"><img src="' + php_data.img_dir + '/prev.png" /></a>',
        nextArrow: '<a class="slick-next"><img src="' + php_data.img_dir + '/next.png" /></a>',
    })
} )( jQuery )