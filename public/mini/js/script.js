$(window).scroll(function () {
  var scroll = $(window).scrollTop();
  if (scroll >= 50) {
    $("body").addClass("scroll");
  } else {
    $("body").removeClass("scroll");
  }
});

$(document).ready(function () {
  $('.successMessage').hide();
  $("#nav-our-tab").click(function () {
    $('.ourclient-tab-slider').slick('refresh');
  });

  $('.banner-slider').slick({
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    vertical: true,
    mobileFirst: true,
    verticalSwiping: true
  });

  $('.product-tab-slider').slick({
    dots: true,
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
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.product-desc-slider').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.ourclient-tab-slider').slick({
    centerMode: true,
    centerPadding: '350px',
    slidesToShow: 1,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    
    responsive: [{
      breakpoint: 3200,
      settings: {
        centerPadding: '750px',
      }
    },{
      breakpoint: 2800,
      settings: {
        centerPadding: '650px',
      }
    },{
      breakpoint: 2200,
      settings: {
        centerPadding: '550px',
      }
    },{
      breakpoint: 2000,
      settings: {
        centerPadding: '500px',
      }
    },{
      breakpoint: 1800,
      settings: {
        centerPadding: '350px',
      }
    },{
      breakpoint: 1200,
      settings: {
        centerPadding: '200px',
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        centerPadding: '50px',
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 1,
        centerPadding: '50px',
      }
    }]
  });

  $('.intresting-slider').slick({
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    vertical: true,
    mobileFirst: true,
    verticalSwiping: true
  });

  $('.doctor-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true
  });

  $('.doctor-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.doctor-slider',
    dots: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  
  // For Menu Collapse Button
  if ($(".header-menu-button").length) {
    $(".header-menu-button").on("click", function (e) {
      $("body").toggleClass("menu-active");
      $(".header-menu-button > .fa-close").toggleClass("d-none");
      $(".header-menu-button > .fa-bars").toggleClass("d-none");
    });
  }

});

$(document).on('click', '.get-in-touch',function(e){
    e.preventDefault();
    //$('.loader').show();
    /* var country_id =  $('.country_id .option .selected').data('data-value');
     var email =  $('.email').val();*/
    var err = 0;
    var nearestOffice = $(".nearest-office").val();
    $('.successMessage').html('');
    $(".errorMessageCountry").html('');
    $(".errorMessageEmail").html('');
    $(".errorMessagePP").html('');
    if(nearestOffice == '' || nearestOffice == null)
    {
      $(".errorMessageCountry").html('Please select nearest office');
      err++;
    }
    var emailID = $(".email-id").val();
    if(emailID == '' || emailID == null)
    {
      $(".errorMessageEmail").html('Please enter email');
      err++;
    }
    var checked = $("input[name='check']").prop("checked");
    if(checked == '' || checked == null || checked == false)
    {
      $(".errorMessagePP").html('Please check privacy policy');
      err++;
    }

    if(err != 0)
    {
      return false;
    }

    var data = $( ".get-in-touch-form" ).serialize();
    $.ajax({
        url: '/get-in-touch',
        data: {data: data},
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (res) {
            if (!res) console.log('Error!');
            //var parse_res = JSON.parse(res);

            $('.successMessage').html(res.mess);
            $('.successMessage').show();
            //$('.loader').hide();
        },
        error: function () {
            alert('Error!');
        }
    });
});

$(document).on('click', '.contactus',function(e){
    e.preventDefault();
    var err = 0;
    $(".errorMessageEmailContact").html('');
    $(".errorMessagePPContact").html('');
    var emailID = $(".email-id-contact").val();
    if(emailID == '' || emailID == null)
    {
      $(".errorMessageEmailContact").html('Please enter email');
      err++;
    }

    var checked = $("input[name='check_contact']").prop("checked");
    if(checked == '' || checked == null || checked == false)
    {
      $(".errorMessagePPContact").html('Please check privacy policy');
      err++;
    }

    if(err != 0)
    {
      return false;
    }

    //$('.loader').show();
    /* var country_id =  $('.country_id .option .selected').data('data-value');
     var email =  $('.email').val();*/
    var data = $( ".contacts-form" ).serialize();
    $.ajax({
        url: '/contact-us-mini',
        data: {data: data},
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (res) {
            if (!res) console.log('Error!');
            //var parse_res = JSON.parse(res);

            $('.contactUsBody').html(res.mess);
            //$('.loader').hide();
        }
    });
});