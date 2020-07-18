
(function( $ ) {

	function countToEnding() {
		let countEndDate = new Date( $( '.countdown' ).attr( 'data-end' )  ).getTime();

		const x = setInterval(() => {
			let now = new Date().getTime();
	
			let distance = countEndDate - now;
	
			let days = Math.floor(distance / (1000 * 60 * 60 * 24));
			let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			let seconds = Math.floor((distance % (1000 * 60)) / 1000);
	
			let html = `<span>${days} <i>DAYS</i></span>
						<span>${hours} <i>HOURS</i></span>
						<span>${minutes} <i>MINUTES</i></span>
						<span>${seconds} <i>SECONDS</i></span>`;
	
			$( '.countdown' ).html( html )
			$( '.time-out' ).html( 'ENROLL' ).css( 'pointer-events', '' );
	
			if (distance < 0) {
				clearInterval(x);
				$( '.raffle-countdown__title' ).html( 'ENDING IN' )
				$( '.countdown' ).html( 'EXPIRED' )
				$( '.time-out' ).html( 'TIME OUT' ).css( 'pointer-events', 'none' );

				// let _data = {
				// 	"post_id"    : $( '.countdown' ).attr( 'data-id' ),
				// 	"_ajax_nonce": php_data.nonce,
				// 	"action"     : "off_raffle"
				// };
				// $.ajax({
				// 	url: php_data.ajax_url,
				// 	type: 'POST',
				// 	dataType: 'json',
				// 	data: _data,
				// 	success:function( res ){
				// 	},
				// 	error: function( err ){
				// 		console.log( err );
				// 	} 
				// })
			}
		}, 1000);
	}
	
	function countToOpening() {
		let countDownDate = new Date( $( '.countdown' ).attr( 'data-date' )  ).getTime();

		const y = setInterval(() => {
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
				clearInterval(y);
				$( '.raffle-countdown__title' ).html( 'RAFFLE ENDING' )
				$( '.time-out' ).html( 'UPCOMING' ).css( 'pointer-events', 'none' );
				countToEnding();
			}
		}, 1000);
	}
	
	countToOpening();
})( jQuery )