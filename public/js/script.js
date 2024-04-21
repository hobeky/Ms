(function ($) {

  "use strict";

  window.addEventListener("load", (event) => {
    //isotope
    $('.isotope-container').isotope({
      // options
      itemSelector: '.item',
      layoutMode: 'masonry'
    });

    var $grid = $('.entry-container').isotope({
      itemSelector: '.entry-item',
      layoutMode: 'masonry'
    });


    // Initialize Isotope
    var $container = $('.isotope-container').isotope({
      // options
      itemSelector: '.item',
      layoutMode: 'masonry'
    });

    $(document).ready(function () {
      //active button
      $('.filter-button').click(function () {
        $('.filter-button').removeClass('active');
        $(this).addClass('active');
      });
    });

    // Filter items on button click
    $('.filter-button').click(function () {
      var filterValue = $(this).attr('data-filter');
      if (filterValue === '*') {
        // Show all items
        $container.isotope({ filter: '*' });
      } else {
        // Show filtered items
        $container.isotope({ filter: filterValue });
      }
    });

  });

  // init Chocolat light box
  var initChocolat = function () {
    Chocolat(document.querySelectorAll('.image-link'), {
      imageSize: 'contain',
      loop: true,
    })
  }

  // init jarallax parallax
  var initJarallax = function () {
    jarallax(document.querySelectorAll(".jarallax"));

    jarallax(document.querySelectorAll(".jarallax-keep-img"), {
      keepImg: true,
    });
  }

  $(document).ready(function () {

    var swiper = new Swiper(".slider", {
      effect: "fade",
      navigation: {
        nextEl: ".main-slider-button-next",
        prevEl: ".main-slider-button-prev",
      },
    });

    var swiper = new Swiper(".classes-swiper", {
      slidesPerView: 3,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });

    var swiper = new Swiper(".testimonial-swiper", {
      slidesPerView: 1,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

    var swiper = new Swiper(".services-swiper", {
      slidesPerView: 5,
      spaceBetween: 120,
      freeMode: true,
      pagination: {
        el: ".services-pagination",
        clickable: true,
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        572: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
        1280: {
          slidesPerView: 5,
        },
      },
    });

    // Animate on Scroll
    AOS.init({
      duration: 1000,
      once: true,
    })

    $(".youtube").colorbox({
      iframe: true,
      innerWidth: 960,
      innerHeight: 585
    });

    initChocolat();
    initJarallax();


  }); // End of a document

})(jQuery);