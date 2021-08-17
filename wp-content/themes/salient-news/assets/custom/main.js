
jQuery(document).ready(function(){
	/* responsive nav */
  jQuery('#site-navigation').salientMobileMenu ();
  
	jQuery('.left-slider-init').slick({
    dots: true,
    infinite: true,
    slidesToShow: 1,
    adaptiveHeight: false,
    arrows: true,
    autoplay: true,
    fade: true,
    cssEase: 'linear',
    responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  }); 

  jQuery('.st-recent-slider').slick({
    dots: false,
    infinite: true,
    slidesToShow: 1,
    adaptiveHeight: false,
    arrows: true,
    autoplay: true,
    fade: false,
    cssEase: 'linear',
    responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  }); 

  jQuery('.st-trending-news-slider').slick({
    dots: true,
    infinite: true,
    slidesToShow: 3,
    adaptiveHeight: false,
    arrows: true,
    autoplay: true,
    responsive: [{
        breakpoint: 769,
        settings: {
          arrows: false,
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  }); 

  jQuery('.full-width-news-slider-init').slick({
    dots: true,
    infinite: true,
    slidesToShow: 5,
    adaptiveHeight: false,
    arrows: true,
    autoplay: true,
    responsive: [{
        breakpoint: 769,
        settings: {
          arrows: false,
          slidesToShow: 4
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  }); 

  jQuery('.st-sidebar-slider-init').slick({
    dots: false,
    infinite: true,
    slidesToShow: 1,
    adaptiveHeight: false,
    arrows: true,
    autoplay: false,
    responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  });


  // salient tab widget script
  jQuery('.clickme a').click(function(){
    jQuery('.clickme a').removeClass('activelink');
    jQuery(this).addClass('activelink');
    var tagid =jQuery(this).data('tag');
    jQuery('.list').removeClass('active').addClass('hide');
    jQuery('#'+tagid).addClass('active').removeClass('hide');
  });


  //salient scroll to top
   jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() >= 50) {      
        jQuery('#return-to-top').fadeIn(200);  
    } else {
        jQuery('#return-to-top').fadeOut(200); 
    }
  });


  jQuery('#return-to-top').click(function() {      // When arrow is clicked
      jQuery('body,html').animate({
          scrollTop : 0                       // Scroll to top of body
      }, 500);
  });

  //salient top search 
  jQuery("#search-header i").click(function(){
    jQuery(".top-search-form").slideToggle();
    jQuery("#search-header i").toggleClass('fa-close');
  });

  jQuery("#st-main-navbar").sticky({topSpacing:0});
});

/* preloader */
jQuery(window).on('load', function() { // makes sure the whole site is loaded 
  jQuery('#status').fadeOut(); // will first fade out the loading animation 
  jQuery('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  jQuery('body').delay(350).css({'overflow':'visible'});
})

