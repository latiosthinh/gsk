
(function( $ ) {
    let countDownDate = new Date( $( '.countdown' ).attr( 'data-date' )  ).getTime();

    var x = setInterval(() => {
        let now = new Date().getTime();

        let distance = countDownDate - now;

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        let html = `<span>${days} <i>DAYS</i></span>
                    <span>${hours} <i>HOURS</i></span>
                    <span>${minutes} <i>MINUTES</i></span>
                    <span>${seconds} <i>SECONDS</i></span>`;

        $( '.countdown' ).html( html )

        if (distance < 0) {
            clearInterval(x);
            $( '.countdown' ).html( 'EXPIRED' )
            $( '.time-out' ).html( 'TIME OUT' ).css( 'pointer-events', 'none' );
        }
    }, 1000);

    

    
})( jQuery )