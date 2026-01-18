$(window).on("load", function () {
    $("#loader").fadeOut(300);
});


$(document).ready(function () {
    setTimeout(() => {
          $("#autoOpen").click();

    }, 400);

    var ContainerWidth = $('.container').width();
    var bodyWidth = $('body').width();
    var customLayout = $('.custom-layout').width();
    var LayoutMargin = (bodyWidth - ContainerWidth) / 2;

    $('.custom-layout', '').css(
        {
            marginRight: LayoutMargin,
            width: bodyWidth - LayoutMargin,
        } 
    );
  

    var dir = $('html').attr('dir');
    if (dir == 'rtl') {
        dir = true;
    } else {
        dir = false;

    }
  
    if ($('.degrees').length > 0) {
      $('.degrees').slick({
        rtl: dir,
        dots: false,
        infinite: false,
        arrows:false,
        speed: 200,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000
      });
    }
  
    // if ($('.sky').length > 0) {
    //   $('.sky').slick({
    //     rtl: dir,
    //     dots: false,
    //     infinite: false,
    //     arrows:false,
    //     speed: 200,
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     autoplay: true,
    //     autoplaySpeed: 2000
    //   });
    // }

    if ($(".items").length > 0) {
      $('.items').slick({
        rtl: dir,
        dots: true,
        arrows: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
      
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: false,
                arrows: true,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                                dots: true, 
                arrows: false,
              
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                                dots: true, 
                arrows: false,
              
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        
      });
    }

    if ($(".reviews").length > 0) {
      $('.reviews').slick({
        rtl: dir,
        dots: false,
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: true, 
                arrows: false,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                                dots: true, 
                arrows: false,
              
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                                dots: true, 
                arrows: false,
              
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        
        
      });
    }
    });

