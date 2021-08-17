(function(jQuery) {
    'use strict';
    jQuery(document).ready(function($) {
	
  
	if( $("#newsTicker") .length ){
		$("#newsTicker").bootstrapNews({
			newsPerPage: 1,
			autoplay: true,
			pauseOnHover: true,
			//direction: 'up',
			newsTickerInterval: 2500,
			onToDo: function () {
			}
		});
	}
	// ===== Scroll to Top ==== 
	$(window).scroll(function() {
		if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
			$('#return-to-top').fadeIn(200);    // Fade in the arrow
		} else {
			$('#return-to-top').fadeOut(200);   // Else fade out the arrow
		}
	});
	if( $("#return-to-top") .length ){
		$('#return-to-top').click(function() {      // When arrow is clicked
			$('body,html').animate({
				scrollTop : 0                       // Scroll to top of body
			}, 500);
		});
	}
 
	 if( $(".pp-featured-caro") .length ){
		
	  // featured post carousel 
		$('.pp-featured-caro').owlCarousel({
			stagePadding: 250,
			loop: true,
			autoplay: true,
			autoplayTimeout: 2000,
			margin: 10,
			nav: false,
			dots: false,
			smartSpeed: 2000,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	 }
	if( $(".gallery-media .gallery") .length ){
	  // featured post carousel 
		$('.gallery-media .gallery').owlCarousel({
			stagePadding: 0,
			loop: true,
			autoplay: true,
			autoplayTimeout: 2000,
			margin: 10,
			nav: true,
			dots: false,
			smartSpeed: 1000,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	 }
	  /*-----------------------------------------------------------------
     * Magnific
     *-----------------------------------------------------------------*/
	if( $('.image-popup').length ){
		$('.image-popup').magnificPopup({
			closeBtnInside : true,
			type           : 'image',
			mainClass      : 'mfp-with-zoom'
		});
	}
	
	if( $("#popup-search").length){
		$('#popup-search').on('click', function(e) {
			e.preventDefault();
			$('.popup-search').fadeIn();
		});
	}
	if( $(".close-popup").length){
		$('.close-popup').on('click', function(e) {
			e.preventDefault();
			$('.popup-search').hide();
		});
	}
	//Header Search Desktop
    $('a.header-search').on('click', function (e) {
        $('.search-here').addClass('active');
        return false;
    });
    $('.search-here > i').on('click', function () {
        $('.search-here').removeClass('active');
        return false;
    });

 });
})(jQuery);
