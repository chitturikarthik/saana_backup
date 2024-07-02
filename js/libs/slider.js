$(document).ready(function() {
    // Find the slider element and initialize Owl Carousel
    var $slider = $(".owl-carousel");
    $slider.owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:1
        },
        1000:{
          items:1
        }
      }
    });
  });
  