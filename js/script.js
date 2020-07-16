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

	if ( $( '.products-slider' ).length !== 0 ) {
		$( '.products-slider' ).slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			prevArrow: '<a class="slick-prev"><img src="' + php_data.img_dir + '/prev.png" /></a>',
			nextArrow: '<a class="slick-next"><img src="' + php_data.img_dir + '/next.png" /></a>',
		})
	}

	if ( $( '.blog-slider' ).length !== 0 ) {
		$( '.blog-slider' ).slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			prevArrow: '<a class="slick-prev"><img src="' + php_data.img_dir + '/prev.png" /></a>',
			nextArrow: '<a class="slick-next"><img src="' + php_data.img_dir + '/next.png" /></a>',
		})
	}

	if ( $( '.product-gallery' ).length !== 0 ) {
		$( '.product-gallery__panel:first-of-type' ).addClass( 'active' )

		$( '.product-gallery__link' ).on( 'click', function( e ) {
			e.preventDefault();
			$( '.product-gallery__panel' ).removeClass( 'active' )

			let slider = $( $( this ).attr( 'data-href' ) );
			slider.addClass( 'active' )

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

	$( '#enroll-btn' ).on( 'click', function() {
		var $this = $( this );
		var _data = {
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

	$( '#roll-btn' ).on( 'click', function() {
		let items = getRandom( $( '.user-item.can-roll' ), $( '#roll-number' ).val() );

		$( '.roll-result' ).html( items )
	} )

	$( '#save-result-btn' ).on( 'click', function() {
		var $this = $( this );
		var _data = {
			"title"      : $( '.site-raffle h2' ).text(),
			"html"       : $( '.table-roll-result' ).html(),
			"_ajax_nonce": php_data.nonce,
			"action"     : "add_raffle"
		};
		$.ajax({
			url: php_data.ajax_url,
			type: 'POST',
			dataType: 'json',
			data: _data,
			success:function( res ){
				console.log(res);
				$this.html( 'SAVED' )
			},
			error: function( err ){
				console.log( err );
			} 
		})
	} )

	$( document ).ready( function() {
		$( 'select' ).select2()
	} )

	$( document ).on( 'facetwp-refresh', function() {
		$('.facetwp-template').animate({ opacity: 0.2 }, 10);
	});
	$( document ).on( 'facetwp-loaded', function() {
		$( 'select' ).select2({})
		$( '.facetwp-template' ).animate({ opacity: 1 }, 10);
		
		$('.facetwp-facet').each(function() {
			var $facet = $(this);
			var facet_name = $facet.attr('data-name');
			var facet_label = FWP.settings.labels[facet_name];

			if ($facet.closest('.facet-wrap').length < 1 && $facet.closest('.facetwp-flyout').length < 1) {
				$facet.wrap('<div class="facet-wrap"></div>');
				$facet.find( '.fwp_label' ).html( facet_label );
			}
		});
	});
} )( jQuery )