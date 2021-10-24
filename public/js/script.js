var app = {

    init: function() {
        app.core();
        app.sliders();
        app.tabs();
        // app.rangeSlider();
        app.accordions();
        app.lazyload();
        app.animation();
    }, // init END

    core: function() {

        /* SITE MOBILE MENU TRIGGER */

        $('.hamburger').on('click', function() {
            $('body').toggleClass('mobile-open');
        });


        /* SITE SELECT : input init */

        var $select = $('select');

        if (!$select) {} else {

            $('select').niceSelect();

        }


        /* SITE HEADER : SEARCH init */

        $('#header-search').on('click', function() {

            $('.header-search-panel').toggleClass('open');
            document.getElementById("header-search-field").focus();

        });

        $('#header-search-form-clear').on('click', function() {

            $(".header-search-field").val('');

        });

        $('#header-search-panel-button').on('click', function() {

            $('.header-search-panel').toggleClass('open');

        });


        /* TOGGLE CONTENT : init */

        $('.content-toggle').on('click', function() {

            var collaspe_block = $(this).parent().find('.content-block'),
                close_text = $(this).data('close'),
                open_text = $(this).data('open');

            collaspe_block.toggleClass('hide');

            if (collaspe_block.hasClass('hide')) {

                $(this).html(close_text);

            } else {

                $(this).html(open_text);

            }

            return false;
        });

    }, // core END

    lazyload: function() {

        var bLazy = new Blazy({

            success: function(element){

                setTimeout(function(){
                    // We want to remove the loader gif now.
                    // First we find the parent container
                    // then we remove the "loading" class which holds the loader image
                    var parent = element.parentNode;
                    parent.className = parent.className.replace(/\bloading\b/,'');
                }, 200);

            }

        });

    }, // lazyload END

    sliders: function() {

        /*
         * PAGE CATALOG : PRODUCT SLIDER start
         * ------------------------------------------------------------- */

        var $product_slider = $('#product-slider');
        if (!$product_slider) {} else {

			var product_thumb_carousel = new Swiper('#product-thumb-slider', {
				// Optional parameters
				slidesPerView: 3,
				spaceBetween: 10,
				freeMode: true,
				watchSlidesVisibility: true,
				watchSlidesProgress: true,
			})

			var product_carousel = new Swiper('#product-slider', {
				// Optional parameters
				speed: 1000,
				// Navigation arrows
				navigation: {
					nextEl: '#product-slider-next',
					prevEl: '#product-slider-prev',
				},
			    thumbs: {
			        swiper: product_thumb_carousel
			    }
			})

        } // PAGE CATALOG : PRODUCT SLIDER end



        /*
         * PAGE INDEX : MAIN BRANDS SLIDER start
         * ------------------------------------------------------------- */

        var $brands_slider = $('#main-brands-carousel');
        if (!$brands_slider) {} else {

            $('#main-brands-carousel').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                arrows: true,
                dots: false,
                prevArrow: false,
                nextArrow: false,
                pauseOnHover: false,
                responsive: [{
                  breakpoint: 768,
                  settings: {
                    slidesToShow: 4
                  }
                }, {
                  breakpoint: 520,
                  settings: {
                    slidesToShow: 2
                  }
                }]
              });

            // var main_brands_slider = new Swiper('#main-brands-carousel', {
            //     spaceBetween: 30,
            //     slidesPerGroup: 1,
            //     loop: true,
            //     loopFillGroupWithBlank: false,
            //     autoplay: {
            //         delay: 3000,

            //       },
            //     lazy: {
            //         //  tell swiper to load images before they appear
            //         loadPrevNext: true,
            //         // amount of images to load
            //         loadPrevNextAmount: 200,
            //       },
            //     breakpoints: {

            //         0: {
            //             slidesPerView: 2,
            //         },
            //         360: {
            //             slidesPerView: 3,
            //         },
            //         576: {
            //             slidesPerView: 4,
            //         },
            //         992: {
            //         slidesPerView: 5,
            //         },
            //         1280: {
            //             slidesPerView: 7,

            //         }
            //     },
            // })
        }

        /* #SID - 46-testimonials-slider-section-for-the-homepage */
        var $brands_slider = $('#testimonial-carousel');
        $(document).ready(function(){
            $("section#testimonial-carousel button.slick-next.slick-arrow").insertAfter("section#testimonial-carousel .slick-track");
            $("section#testimonial-carousel button.slick-prev.slick-arrow").insertAfter("section#testimonial-carousel .slick-track");
        });
        if (!$brands_slider) {} else {

            $('#testimonial-carousel').slick({
                centerMode: true,
                centerPadding: '250px',
                slidesToShow: 1,
                slidesToScroll: 1,
                //autoplay: true,
                autoplaySpeed: 1500,
                arrows: true,
                dots: true,
                arrows: true,
                pauseOnHover: false,
                responsive: [{
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
        }


		/*
		 * PAGE INDEX : MAIN SLIDER start
		 * ------------------------------------------------------------- */

        var $main_slider = $('#main-content-slider');
        if (!$main_slider) {} else {

			var main_content_slider = new Swiper('#main-content-slider', {
				// Optional parameters
				loop: false,
				speed: 500,
				slidesPerView: 1,
				autoHeight: true,
				allowTouchMove: false,
				effect: 'fade',
				fadeEffect: {
				    crossFade: true
				},
				on: {

					slideChangeTransitionStart: function () {
						$('.main-content-inner').removeClass('aos-init').removeClass('aos-animate');
						$('.main-content-inner').attr('data-aos', 'fade-in');
					},

					slideChangeTransitionEnd: function () {
						$('.main-content-inner').attr('data-aos', 'fade-in');
							AOS.init();
					},
				}
			})

            var main_gallery_slider = new Swiper('#main-gallery-slider', {
                // Optional parameters
                loop: true,
                slidesPerView: 1,
                spaceBetween: 1,
                speed: 1000,

				// Responsive breakpoints
                // breakpoints: {
                //     // when window width is >= 320px
                //     320: {
                //         slidesPerView: 1,
                //         spaceBetween: 0
                //     },
                //     576: {
                //         slidesPerView: 1,
                //         spaceBetween: 0
                //     },
                //     768: {
                //         slidesPerView: 1.3,
                //         spaceBetween: 15
                //     },
                //     992: {
                //         slidesPerView: 1,
                //         // spaceBetween: 40
                //     },
                //     1280: {
                //         slidesPerView: 1.3,
                //         spaceBetween: 40
                //     }
                // },
				breakpoints: {
					// when window width is >= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 0
					},
					576: {
						slidesPerView: 1,
						spaceBetween: 0
					},
					768: {
						slidesPerView: 1.3,
						spaceBetween: 15
					},
					992: {
						slidesPerView: 1,
						// spaceBetween: 40
					},
					1280: {
						slidesPerView: 1.6,
						spaceBetween: 20
					},
					1366: {
						slidesPerView: 1.6,
						spaceBetween: 20
					},
					1440: {
						slidesPerView: 1.6,
						spaceBetween: 20
					},
					1920: {
						slidesPerView: 1.65,
						spaceBetween: 40
					}
				},
				autoplay: {
				    delay: 5000,
				},
				// If we need pagination
				pagination: {
					el: '#main-gallery-pagination',
		    		type: 'bullets',
		    		clickable: true
				},
				// Navigation arrows
				navigation: {
					nextEl: '#main-gallery-button-next',
					prevEl: '#main-gallery-button-prev',
				},
				// And if we need scrollbar
				scrollbar: {
					el: '.swiper-scrollbar',
				},

                on: {
                    slideChange: function () {
                        main_content_slider.slideTo(this.realIndex);
                    },

                    slideChangeTransitionEnd: function () {
                        $('#main-gallery-slider .swiper-slide-next').on('click', function() {
                            main_gallery_slider.slideNext();
                        });
                    },
                }
            })

        } // PAGE INDEX : MAIN SLIDER end


        /*
         * PAGE COMPARE : COMPARE SLIDER start
         * ------------------------------------------------------------- */

        var $compare_slider = $('#compare-slider');
        if (!$compare_slider) {} else {

			var compare_carousel = new Swiper('#compare-slider', {
				// Optional parameters
				slidesPerView: 1,
				spaceBetween: 0,
				speed: 2000,

				// Responsive breakpoints
				breakpoints: {
					// when window width is >= 320px
					320: {
						slidesPerView: 1
				    },
					360: {
						slidesPerView: 2
				    },
					768: {
						slidesPerView: 2
					},
					992: {
						slidesPerView: 3
					},
					1280: {
						slidesPerView: 3
					}
				},
			})

        }  // PAGE COMPARE : COMPARE SLIDER end

	}, // sliders END

    tabs: function() {

        /* SITE TABS init */
        var $tabs_block = $('.tabs');
        if (!$tabs_block) {} else {

            $('.tabs').tabslet({
                active: 1
            });

            // Update bLazy for tab images
            $('.keyarea-tab-button').on('click', function() {
                var bLazy = new Blazy();
            });

        }

    }, // tabs END

    accordions: function() {

        var $accordion_init = $('[data-accordion]');
        if (!$accordion_init) {} else {

            $('#aside-accordion [data-accordion]').accordion({
                singleOpen: false
            });

            $('#knowledgeBase-filtrers [data-accordion]').accordion({
                singleOpen: false
            });

            $('#catalog-mobile-filters [data-accordion]').accordion({
                singleOpen: false
            });
        }

    }, // accordions END

    rangeSlider: function() {

        /* SITE TABS init */
        var $rangeSlider_widget = $('.range-inputs-group');
        if (!$rangeSlider_widget) {} else {

            var $range = $("#range-slider");
            var $inputFrom = $("#range-input-from");
            var $inputTo = $("#range-input-to");
            var instance;
            var min = 0;
            var max = 1000;
            var from = 0;
            var to = 0;

            $range.ionRangeSlider({
                type: "double",
                skin: "square",
                grid: false,
                min: $inputFrom.val(),
                max: $inputTo.val(),
                from: $inputFrom.val(),
                to: $inputTo.val(),
                grid_snap: false,
                hide_min_max: true,
                hide_from_to: true,
                onStart: updateInputs,
                onChange: updateInputs,
                onFinish: updateInputs
            });
            instance = $range.data("ionRangeSlider");

            function updateInputs (data) {
                from = data.from;
                to = data.to;

                $inputFrom.prop("value", from);
                $inputTo.prop("value", to);
            }

            $inputFrom.on("change", function () {
                var val = $(this).prop("value");

                // validate
                if (val < min) {
                    val = min;
                } else if (val > to) {
                    val = to;
                }

                instance.update({
                    from: val
                });

                $(this).prop("value", val);

            });

            $inputTo.on("change", function () {
                var val = $(this).prop("value");

                // validate
                if (val < from) {
                    val = from;
                } else if (val > max) {
                    val = max;
                }

                instance.update({
                    to: val
                });

                $(this).prop("value", val);
            });

        }

    }, // rangeSlider END

    animation: function() {

        AOS.init({
            once: true
        });

    }, // animation END
}



jQuery(document).ready(function($) {
    console.log( 'Документ и все ресурсы загружены' );
    app.init();


    $('#map-county-select').on('change', function() {
        var map_area = $(this).val();
        $('.map-area-pin').addClass('hidden');
        $('.map-area-pin[data-area="' + map_area + '"]').removeClass('hidden');
        $(this).val();
    });


	$('#catalog-filter').on('click', function() {
		$('#offcanvas-catalog').toggleClass('open');
	});


	$('#knowledge-base-filter').on('click', function() {
		$('#offcanvas-knowledge-base').toggleClass('open');
	});


	$('.close-offcanvas, .offcanvas-bg').on('click', function() {
		$('.offcanvas-aside').removeClass('open');
	});


	$(".content").mCustomScrollbar({
		theme:"dark",
	});


	$('.product-card-delete').on('click', function() {
		$(this).closest('.wishlist-column').remove();
	});


	$('#equal-types-button').on('click', function() {
		$(this).addClass('active');
		$('#all-types-button').removeClass('active');
		$('div[data-row="not-equal"]').hide();
	});

	$('#all-types-button').on('click', function() {
		$(this).addClass('active');
		$('#equal-types-button').removeClass('active');
		$('div[data-row="not-equal"]').show();
	});


    /* for distributers country */
    $(document).on('click', '.distributors-select .option',function(e){
        var country_id =  $(this).data('value');
        console.log(country_id);
        $.ajax({
            url: '/distributor-country',
            data: {country_id: country_id},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');

                $('.d-ajax').html(res);

                //app.lazyload();


            },
            error: function () {
                alert('Error!');
            }
        });
    });

    /* Agreement */
    $(".get-contacts-submit").attr("disabled", true);
    $(".about-submit").attr("disabled", true);
    $(".contactus").attr("disabled", true);
    $(document).on('click', '#agreement-checkbox',function(e){
        if($(this).prop("checked") == true){
            // console.log("Checkbox is checked.");
            $(".get-contacts-submit").attr("disabled", false);
        }
        else if($(this).prop("checked") == false){
            $(".get-contacts-submit").attr("disabled", true);
        }
    });

    $(document).on('click', '#form-agreement-checkbox',function(e){
        if($(this).prop("checked") == true){
            // console.log("Checkbox is checked.");
            $(".about-submit").attr("disabled", false);
        }
        else if($(this).prop("checked") == false){
            $(".about-submit").attr("disabled", true);
        }
    });

    $(document).on('click', '#contact-agreement-checkbox',function(e){
        if($(this).prop("checked") == true){
            // console.log("Checkbox is checked.");
            $(".contactus").attr("disabled", false);
        }
        else if($(this).prop("checked") == false){
            $(".contactus").attr("disabled", true);
        }
    });

    $(document).on('click', '#pdf-download-agreement-checkbox',function(e){
        if($(this).prop("checked") == true){
            // console.log("Checkbox is checked.");
            $(".downloadNow").attr("disabled", false);
        }
        else if($(this).prop("checked") == false){
            $(".downloadNow").attr("disabled", true);
        }
    });

    /* footer form */
    $('.loader').hide();
    $(document).on('click', '.get-contacts-submit',function(e){
        e.preventDefault();
        $(".get-contacts-submit").attr("disabled", true);
        //$('.loader').show();
        /* var country_id =  $('.country_id .option .selected').data('data-value');
         var email =  $('.email').val();*/
        var data = $( "#request" ).serialize();
        $.ajax({
            url: '/add-request',
            data: {data: data},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                //var parse_res = JSON.parse(res);

               // $('.get-contacts-inner').text(res.mess);
               // $('.email_mess').text(res.mess);
                $('.ajax_footer_form').text(res.mess);
                $(".get-contacts-submit").attr("disabled", false);
                //$('.loader').hide();

            },
            error: function () {
                alert('Error!');
            }
        });
    });

    new MiniBar('.select-box .list', {

        // or progress
        barType: "default",

        // min size
        minBarSize: 50,

        // always shows scrollbars
        // alwaysShowBars: false,

        // enables horizontal/vertical scrollbars
        scrollX: false,
        scrollY: true,

        // shows nav buttons
        // navButtons: false,

        // scroll amount in pixels
        scrollAmount: 250,

        // MutationObserver API
        mutationObserver: {
            attributes: false,
            childList: true,
            subtree: true
        }
    });

    $(document).on('click', '.contactus',function(e){
        e.preventDefault();
        $('.loader').show();
        /* var country_id =  $('.country_id .option .selected').data('data-value');
         var email =  $('.email').val();*/
        var data = $( ".contacts-form" ).serialize();
        $.ajax({
            url: '/contact-us',
            data: {data: data},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                //var parse_res = JSON.parse(res);

                $('.contact_us').html(res.mess);
                $('.loader').hide();
            },
            error: function () {
                alert('Error!');
            }
        });
    });

    $(document).on('click', '.downloadNow',function(e){
        var name = $(".download-pdf").find(".nameField").val();
        var email = $(".download-pdf").find(".emailField").val();
        // var company = $(".download-pdf").find(".companyField").val();
        var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $(".errorField").remove();
        var err = false;
        //if(name == '' || email == '' || company == '' || (!pattern.test(email)))
        if(email != '' && !pattern.test(email))
        {
            // if(name == '')
            // {
            //     $(".nameDiv").append("<span class='errorField'>Name is required!</span>");
            //     err = true;
            // }
            // if(email == '')
            // {
            //     $(".emailDiv").append("<span class='errorField'>Email is required!</span>");
            //     err = true;
            // }
            // if(email != '' && !pattern.test(email))
            if(email != '' && !pattern.test(email))
            {
                $(".emailDiv").append("<span class='errorField'>Please enter a valid email!</span>");
                err = true;
            }
            // if(company == '')
            // {
            //     $(".companyDiv").append("<span class='errorField'>Company name is required!</span>");
            //     err = true;
            // }
        }
        if(err == true)
        {
            return false;
        }
        else
        {
            $(".errorField").remove();
        }
        e.preventDefault();
        $('.loader').show();
        var data = $( ".download-pdf" ).serialize();
        $.ajax({
            url: '/download-now',
            data: {data: data},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                //var parse_res = JSON.parse(res);
                $('#downloaded_pdf').html(res.mess);
                $('.loader').hide();
                window.open ($('#download-pdf-button').attr('href'), "_blank");
            },
            error: function () {
                alert('Error!');
            }
        });
    });

    /* Wish list and compare */

    $(document).on('click', '.add-to-wishlist',function(e){
        e.preventDefault();
        var product_id =  $(this).data('product-id');
       var state = $(this).hasClass("in-active");

       if(state){
           var type='catalog';
           deleteWishList(product_id,type);
           $(this).removeClass("in-active");
           $('.add-to-wishlist').prop( "checked", false );
       }
       else{
           addToWishlist(product_id);
           $(this).addClass("in-active");
           $('.add-to-wishlist').prop( "checked", true );
       }

    });
// for detail product wishlist
    $(document).on('change', '.add-wishlist',function(e){
        e.preventDefault();
        var product_id =  $(this).data('product-id');
        var state = $(this).hasClass("in-active");

        if(state){
            var type='catalog';
            deleteWishList(product_id,type);
            $(this).removeClass("in-active");
            $('.add-wishlist').prop( "checked", false );
        }
        else{
            addToWishlist(product_id);
            $(this).addClass("in-active");
            $('.add-wishlist').prop( "checked", true );
        }

    });

    $(document).on('click', '.add-to-compare',function(e){
        e.preventDefault();
        var product_id =  $(this).data('product-id');

        var state = $(this).hasClass("in-active");

        if(state){
            var type='catalog';
            deleteCompare(product_id,type);
            $(this).removeClass("in-active");
        }
        else{
            addToCompare(product_id);
            $(this).addClass("in-active");
        }

       // addToCompare(product_id);
        //console.log(product_id);

    });
    // for detail product compare
    $(document).on('change', '.add-compare',function(e){
        e.preventDefault();
        var product_id =  $(this).data('product-id');

        var state = $(this).hasClass("in-active");

        if(state){
            var type='catalog';
            deleteCompare(product_id,type);
            $(this).removeClass("in-active");
            $('.add-compare').prop( "checked", false );
        }
        else{
            addToCompare(product_id);
            $(this).addClass("in-active");
            $('.add-compare').prop( "checked", true );
        }

        // addToCompare(product_id);
        //console.log(product_id);

    });

    $(document).on('click', '.delete-wishlist',function(e){
        e.preventDefault();
        var product_id =  $(this).data('product-id');
        //  console.log(product_id);
        deleteWishList(product_id);
    });

    $(document).on('click', '.product-type',function(e){
        e.preventDefault();
        $( ".product-type" ).removeClass( "active" );
        var product_type =  $(this).data('product-type');
        //  console.log(product_id);
        compareType(product_type);
        $(this).addClass( "active" );
    });

    function addToWishlist(product_id){
        $.ajax({
            url: '/add-wishlist',
            data: {product_id: product_id},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                //var parse_res = JSON.parse(res);
                $('.in-wishlist-count').text(res.count_wishlist);
            },
            error: function () {
                console('Error!');
            }
        });
    }

    function addToCompare(product_id){
        console.log(product_id);
        $.ajax({
            url: '/add-comparison',
            data: {product_id: product_id},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                //var parse_res = JSON.parse(res);
                $('.in-compare-count').text(res.count_comparison);
            },
            error: function () {
                console('Error!');
            }
        });
    }

    function deleteWishList(product_id,type='wishlist'){
        $.ajax({
            url: '/delete-wishlist',
            data: {product_id: product_id,type:type},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                if(type=='wishlist') {
                    $('.show-wishlist-ajax').html(res);
                }
                else{
                  //  console.log(res);
                    $('.in-wishlist-count').text(res.count_wishlist);
                }
               // app.lazyload();

                //window.location.reload();
            },
            error: function () {
                console('Error!');
            }
        });
    }

    $(document).on('click', '.delete-compare',function(e){
        e.preventDefault();
        var product_id =  $(this).data('product-id');
          console.log(product_id);
        deleteCompare(product_id,'detail');
    });

    function deleteCompare(product_id,type='compare'){
        $.ajax({
            url: '/delete-comparison',
            data: {product_id: product_id,type:type},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                //var parse_res = JSON.parse(res);
                if(type=='detail'){
                    location.reload();
                }else {
                    $('.in-compare-count').text(res.count_comparison);
                }
            },
            error: function () {
                console('Error!');
            }
        });
    }


    function compareType(product_type){

        $.ajax({
            url: '/compare-aside',
            data: {product_type: product_type},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                // if (!res) console.log('Error!');
                $('.ajax-aside').html(res);

              //  app.lazyload();

                app.sliders();
                //window.location.reload();
            },
            error: function () {
                console('Error!');
            }
        });
        $.ajax({
            url: '/compare-type',
            data: {product_type: product_type},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                if (!res) console.log('Error!');
                console.log(res);
                $('.compare-ajax').html(res);

               // app.lazyload();

                app.sliders();
                //window.location.reload();
            },
            error: function () {
                console('Error!');
            }
        });
    }
    /* End Wish list and compare */

    /* for request types*/
    $(document).on('click', '.header-contact-button',function(e){
      //  e.preventDefault();
        //var type =  $(this).data('type');
          $('.htype').val('header');

    });
    $(document).on('click', '.main-button',function(e){
        //  e.preventDefault();
        //var type =  $(this).data('type');
        $('.htype').val('index_page');

    });

    $(document).on('click', '.main-button-white',function(e){
        //  e.preventDefault();
        //var type =  $(this).data('type');
        $('.htype').val('index_page');
        console.log('index');

    });

    $(document).on('click', '.product-info-button',function(e){
        //  e.preventDefault();
        //var type =  $(this).data('type');
        $('.htype').val('product');

    });

});

// $( document ).ready(function() {
//     var title = "";
//     if(window.location.pathname == "/")
//     {
//         title = "Global IoT leader of End-to-End LoRaWAN solutions";
//     }
//     else
//     {
//         if($(".page-title").length > 0)
//         {
//             title = $(".page-title").html();
//         }
//         else
//         {
//             title = $("h1").html();
//         }
//     }
//     $("#headTitle").html("TEKTELIC | " + stripHtml(title));

//     var description = "Premier provider of Best-in-Class LoRaWAN Gateways, Sensors and End-to-End Solutions developed for reliability, scalability and cost-effective IoT deployments";
//     if(window.location.pathname.split('/').length > 2)
//     {
//         $("#metaDescription").attr('content', $(".product-post-description p:first").html());
//     }

// });

var video_wrapper = $('.youtube-video-place');
if(video_wrapper.length){
    $('.play-youtube-video, .play').on('click', function(){
        video_wrapper = $(this).parent();
        video_wrapper.html('<iframe allowfullscreen frameborder="0"width="450" height="285" allow="autoplay; accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" class="embed-responsive-item" src="' + video_wrapper.data('yt-url') + '?autoplay=1"></iframe>');
    });
}

function stripHtml(html){
    // Create a new div element
    var temporalDivElement = document.createElement("div");
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}

function filterCategory(id)
{
    document.getElementById(id).submit();
}
