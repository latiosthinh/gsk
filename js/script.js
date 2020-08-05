( function( $ ) {
	$( '.menu-item-has-children > a' ).click( function( e ) {
		e.preventDefault();
		
		$( this ).parent().toggleClass( 'active' )
	} )

	$( '.menu-toggle' ).on( 'click', () => {
		$( '.site-nav' ).toggleClass( 'toggle' )
	} )

	$( '.tabs-nav a' ).click( function( e ) {
		e.preventDefault()

		$( '.tabs-nav a' ).removeClass( 'active' )
		$( '.tabs-panel div' ).removeClass( 'active' )

		$( this ).addClass( 'active' )
		$( $( this ).attr( 'href' ) ).addClass( 'active' )
	} )

	if ( $( '.products-slider' ).length !== 0 ) {
		$( '.products-slider' ).slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			prevArrow: '<a class="slick-prev"><img src="' + php_data.img_dir + '/prev.png" /></a>',
			nextArrow: '<a class="slick-next"><img src="' + php_data.img_dir + '/next.png" /></a>',
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				}
			]
		})
	}

	if ( $( '.blog-slider' ).length !== 0 ) {
		$( '.blog-slider' ).slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			prevArrow: '<a class="slick-prev"><img src="' + php_data.img_dir + '/prev.png" /></a>',
			nextArrow: '<a class="slick-next"><img src="' + php_data.img_dir + '/next.png" /></a>',
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				}
			]
		})
	}

	if ( $( '.product-gallery' ).length !== 0 ) {
		$( '.product-gallery__panel:first-of-type' ).addClass( 'active' )
		$( '.actions-slider__name' ).html( $( '.product-gallery__link:first-of-type' ).attr( 'data-name' ) );

		$( '.product-gallery__link' ).on( 'click', function( e ) {
			e.preventDefault();
			$( '.product-gallery__link' ).removeClass( 'active' )
			$( '.product-gallery__panel' ).removeClass( 'active' )

			let slider = $( $( this ).attr( 'data-href' ) );
			slider.addClass( 'active' )

			$( '.actions-slider__name' ).html( $( this ).attr( 'data-name' ) );
			slider.find( '.product-gallery__flash' ).slick( 'resize' )
			slider.find( '.product-gallery__nav' ).slick( 'resize' )
		} )

		$( '.product-gallery__flash' ).slick({
			dots: false,
			arrows: false,
			asNavFor: $( '.product-gallery__nav' ),
		})
	
		$( '.product-gallery__nav' ).slick({
			dots: false,
			arrows: false,
			slidesToShow: 3,
			slidesToScroll: 1,
		})
	
		$( '.product-gallery__nav .slick-slide' ).click( function() {
			var slideno = $( this ).attr( 'data-slick-index' );
			$( '.product-gallery__nav' ).slick( 'slickGoTo', slideno );
			$( '.product-gallery__flash' ).slick( 'slickGoTo', slideno );
		});
	
		$( '.blog-slider' ).slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			prevArrow: '<a class="slick-prev"><img src="' + php_data.img_dir + '/prev.png" /></a>',
			nextArrow: '<a class="slick-next"><img src="' + php_data.img_dir + '/next.png" /></a>',
		})
	}

	$( '.enroll-popup__overlay' ).on( 'click', function() {
		$( '.enroll-popup' ).removeClass( 'active' )
	} )

	$( '#open-enroll-btn' ).on( 'click', function() {
		$( '.enroll-popup' ).addClass( 'active' )
	} )

	// enroll choose
	$( '.product-item-enroll' ).on( 'click', function( e ) {
		e.preventDefault();
		$( this ).toggleClass( 'active' )

		let chosen = 0;

		$( '.product-item-enroll' ).each( function( i, e ) {
			if ( $( e ).hasClass( 'active' ) ) {
				chosen = 1;
			}
		} )

		if ( 0 !== chosen ) {
			$( '#enroll-btn' ).removeClass( 'unactive' )
		} else {
			$( '#enroll-btn' ).addClass( 'unactive' )
		}
	} )

	$( '#enroll-btn' ).on( 'click', function() {
		let $this = $( this );
		let chosen = [];

		$( '.product-item-enroll' ).each( function( i, e ) {
			if ( $( e ).hasClass( 'active' ) ) {
				chosen.push( $( e ).attr( 'data-name' ) );
			}
		} )

		let _data = {
			"id"         : $this.attr( 'data-id' ),
			"chosen"     : chosen,
			"ip"         : php_data.ip,
			"email"      : php_data.email,
			"_ajax_nonce": php_data.nonce,
			"action"     : "enroll"
		};
		$.ajax({
			url: php_data.ajax_url,
			type: 'POST',
			dataType: 'json',
			data: _data,
			success:function( res ){
				$( '.enroll-alert' ).addClass( 'active' )
				$this.html( '<span class="enrolled">ENROLLED</span>' )
				$this.addClass( 'enrolled' )
			},
			error: function( err ){
				console.log( err );
			} 
		})
	} )

	$( '.enrolled-ban' ).on( 'click', function() {
		var $this = $( this );
		var _data = {
			"id"         : $this.attr( 'data-id' ),
			"banned"     : $this.attr( 'data-b' ),
			"_ajax_nonce": php_data.nonce,
			"action"     : "banned"
		};
		$.ajax({
			url: php_data.ajax_url,
			type: 'POST',
			dataType: 'json',
			data: _data,
			success:function( res ){
				$this.toggleClass( 'banned' )

				if ( $this.hasClass( 'banned' ) ) {
					$this.html( 'UN-BAN' )
					$this.parents( 'tr' ).removeClass( 'can-roll' )
				} else {
					$this.html( 'BAN' )
					$this.parents( 'tr' ).addClass( 'can-roll' )
				}
			},
			error: function( err ){
				console.log( err );
			} 
		})
	} )

	function getRandom(arr, n) {
		var result = new Array(n),
			len = arr.length,
			taken = new Array(len);
		if (n > len)
			n = len;
		while (n--) {
			var x = Math.floor(Math.random() * len);
			result[n] = arr[x in taken ? taken[x] : x];
			taken[x] = --len in taken ? taken[len] : len;
		}
		return result;
	}

	$( '.roll-btn' ).on( 'click', function() {
		let rollItem = $( this ).attr( 'data-item' )
		let items = getRandom( $( `.user-item.can-roll[data-user-items*=${rollItem}]` ), $( '#roll-number' ).val() );
		let id = [];
		$( items ).each( function( i, e ) {
			id.push( $( e ).attr( 'data-user-id' ) )
		} )
		console.log(id)

		setTimeout(() => {
			let _data = {
				"raffle_id"  : $( this ).attr( 'data-id' ),
				"raffle_item": $( this ).attr( 'data-item' ),
				"user_ids"   : id,
				"_ajax_nonce": php_data.nonce,
				"action"     : "get_raffle_winner"
			};
			$.ajax({
				url: php_data.ajax_url,
				type: 'POST',
				dataType: 'json',
				data: _data,
				success:function( res ){
					$( '.roll-result' ).html( res.data )
				},
				error: function( err ){
					console.log( err );
				} 
			})
		}, 0);
	} )

	$( '#save-result-btn' ).on( 'click', function() {
		let $this = $( this );
		let user_ids = [];

		$( '.item-to-save' ).each( function( i, e ) {
			user_ids.push( $( e ).text() )
		} )

		let _data = {
			"user_id"    : user_ids,
			"raffle_id"  : $( '.item-to-save' ).attr( 'data-raffle-id' ),
			"raffle_item": $( '.item-to-save' ).attr( 'data-raffle-item' ),
			"_ajax_nonce": php_data.nonce,
			"action"     : "add_raffle"
		};
		$.ajax({
			url: php_data.ajax_url,
			type: 'POST',
			dataType: 'json',
			data: _data,
			success:function( res ) {
				console.log(res);
			},
			error: function( err ) {
				console.log( err );
			} 
		})
	} )

	$( document ).ready( function() {
		$( 'select' ).select2()

		$( '.tabs-nav a:first-of-type' ).trigger( 'click' )
	} )

	$( document ).on( 'facetwp-refresh', function() {
		$('.facetwp-template').animate({ opacity: 0.2 }, 10);
	});
	$( document ).on( 'facetwp-loaded', function() {
		$( 'select' ).select2({})
		$( '.facetwp-template' ).animate({ opacity: 1 }, 10);
		
		$('.facetwp-facet').each(function() {
			let $facet = $(this);
			let facet_name = $facet.attr('data-name');
			let facet_label = FWP.settings.labels[facet_name];

			if ($facet.closest('.facet-wrap').length < 1 && $facet.closest('.facetwp-flyout').length < 1) {
				$facet.wrap('<div class="facet-wrap"></div>');
				$facet.find( '.fwp_label' ).html( facet_label );
			}
		});
	});
} )( jQuery )