(function($) {
    "use strict";

    // jquery document ready function
    jQuery(document).on('ready', function() {

        function custom_js_khela() {
            var windowS = $(window),
                windowH = windowS.height(),
                homeShS = $('.Modern-Slider'),
                homeSh = homeShS.height(),
                homev3  =   $('.home3'),
                menuS = $('.navbar'),
                menuH = menuS.height(),
                bannerH = (windowH - menuH),
                welcomeS = $('.welcome-text'),
                welcomeT = welcomeS.height(),
                Home3imgS = $('.home-3img'),
                home3imgH = Home3imgS.height(),
                ImgP = (windowH - home3imgH),
                verticalH = ((homeSh - welcomeT) / 2),
                shortCS = $('.screenshot-content'),
                shortimgS = $('.screenshot-slider-active'),
                shortCH = shortCS.height(),
                shortimgH = shortimgS.height(),
                shortcontentV = ((shortimgH - shortCH) / 2),
                SearchBoxS = $('.searchboxinput'),
                closebtnS = $('.closebtn'),
                searchbtnS = $('.searchbtn'),
                home3welcometext = $('.home3 .welcome-text'),
                home4welcometext = $('.corporate-4 .welcome-text'),
                home2welcometext    =   $('.corporate-2 .welcome-text'),
                verticalH2 = ((bannerH - welcomeT) / 2);
            welcomeS.css({
                paddingTop: verticalH,
                paddingBottom: verticalH

            });
            shortCS.css({
                paddingTop: shortcontentV / 2,
                paddingBottom: shortcontentV

            });
            Home3imgS.css({
                paddingTop: ImgP,
            });
           homev3.css('height', windowH);

           home2welcometext.css({
                paddingBottom: verticalH2,
                paddingTop: verticalH2 + menuH
            });
            home3welcometext.css({
                paddingTop: verticalH2 + menuH,
                paddingBottom: verticalH2,
            });
            home4welcometext.css({
                paddingTop: verticalH2 + menuH,
                paddingBottom: verticalH2,
            });

            jQuery(window).on('scroll', function() {

                if ($(this).scrollTop() > 1) {
                    menuS.addClass("sticky");
                } else {
                    menuS.removeClass("sticky");
                }
            });

            // search box code
            searchbtnS.on('click', function() {
                SearchBoxS.fadeIn();
                closebtnS.fadeIn();
                $(this).fadeOut();
            });
            closebtnS.on('click', function() {
                SearchBoxS.fadeOut();
                searchbtnS.fadeIn();
                $(this).fadeOut();
            });

        }
        $('.nav li a').on('click', function() {
            $('.collapse').removeClass('in');
        });
        // Change navbar header Icon on click
        $(".navbar-toggle").on("click", function() {
            $(this).toggleClass("active");
        });
       
        if ($.fn.magnificPopup) {
            $('.vewlrg').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },
                // other options
            });
        }
        if ($.fn.slick) {
            $(".Modern-Slider").slick({
                autoplay: true,
                autoplaySpeed: 10000,
                speed: 600,
                slidesToShow: 1,
                slidesToScroll: 1,
                pauseOnHover: false,
                dots: false,
                pauseOnDotsHover: true,
                cssEase: 'linear',
                fade: true,
                draggable: true,
                prevArrow: '<button class="PrevArrow fa fa-angle-left"></button>',
                nextArrow: '<button class="NextArrow fa fa-angle-right"></button>',
            });
        }
        if ($.fn.slick) {
            $('.blog-slider-active').slick({
                slidesToScroll: 1,
                slidesToShow: 3,
                prevArrow: '<button class="PrevArrowb fa fa-angle-left"></button>',
                nextArrow: '<button class="NextArrowb fa fa-angle-right"></button>',
                responsive: [{
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            });
        }
        if ($.fn.slick) {
            $('.testimonial-section').slick({
                slidesToScroll: 1,
                slidesToShow: 2,
                arrows: false,
                responsive: [{
                    breakpoint: 780,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 500,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }]
            });
        }
        if ($.fn.slick) {
            $('.screenshot-slider-active').slick({
                slidesToScroll: 1,
                slidesToShow: 4,
                arrows: false,
                autoplay: false,
                asNavFor: '.shortcontentS',
                responsive: [{
                    breakpoint: 1400,
                    settings: {
                        arrows: false,
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 780,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 500,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }]
            });
        }
        if ($.fn.slick) {
            $('.shortcontentS').slick({
                slidesToScroll: 1,
                slidesToShow: 1,
                asNavFor: '.screenshot-slider-active',
                arrows: false,
                dots: true,
                fade: true
            });
        }
        if ($.fn.slick) {
            $('.testimonial-section-2').slick({
                slidesToScroll: 1,
                slidesToShow: 1,
                prevArrow: '<button class="PrevArrowT fa fa-angle-left"></button>',
                nextArrow: '<button class="NextArrowT fa fa-angle-right"></button>',
                arrows: true,
                responsive: [{
                    breakpoint: 780,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 500,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }]
            });
        }
        if ($.fn.slick) {
            $('.active-brand-slider').slick({
                slidesToScroll: 1,
                slidesToShow: 4,
                prevArrow: '<button class="PrevArrowbrand fa fa-angle-left"></button>',
                nextArrow: '<button class="NextArrowbrand fa fa-angle-right"></button>',

                responsive: [{
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            });
        }
        // isotop active
        function isotop_config() {
            if ($.fn.isotope) {
                $(".isotop-active").isotope({
                    filter: '*',
                });

                $('.isotop-nav ul li').on('click', function() {

                    $(".isotop-nav ul li").removeClass("active");
                    $(this).addClass("active");

                    var selector = $(this).attr('data-filter');
                    $(".isotop-active").isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'easeOutCirc',
                            queue: false,
                        }
                    });
                    return false;
                });
            }
        }

        // jquery window load function
        jQuery(window).on('load', function() {
            isotop_config();
            custom_js_khela();
            $('.collapse.in').prev('.panel-heading').addClass('active');
            $('#accordion, #accordionGroupClosed, #bs-collapse')
                .on('show.bs.collapse', function(a) {
                    $(a.target).prev('.panel-heading').addClass('active');
                })
                .on('hide.bs.collapse', function(a) {
                    $(a.target).prev('.panel-heading').removeClass('active');
                });
            $('#preloader').fadeOut('slow', function() {
                $(this).remove();
            });


        });
        if ($.fn.onePageNav) {
            $('.menu').onePageNav({
                currentClass: 'current-menu-item',
                changeHash: false,
                scrollSpeed: 750,
                scrollThreshold: 0.5,
                filter: '',
                easing: 'swing',
                begin: function() {
                    //I get fired when the animation is starting
                },
                end: function() {
                    //I get fired when the animation is ending
                },
                scrollChange: function($currentListItem) {
                    //I get fired when you enter a section and I pass the list item of the section
                }
            });
        }
        // jquery window resize function
        jQuery(window).on('resize', function() {
            custom_js_khela();
        });

        if ($.fn.rippler) {
            $(".rippler").rippler({
                effectClass: 'rippler-effect',
                effectSize: 0 // Default size (width & height)
                    ,
                addElement: 'div' // e.g. 'svg'(feature)
                    ,
                duration: 400
            });
        }
        if ($.fn.counterUp) {
            $('.count').counterUp({
                delay: 10,
                time: 1500
            });
        }
        if ($.fn.barfiller) {
            $('#bar1').barfiller({
                barcolor: "#3498db",
                tooltip: false,
            });
        }
        if ($.fn.barfiller) {
            $('#bar2').barfiller({
                barcolor: "#3498db",
                tooltip: false,
            });
        }
        if ($.fn.barfiller) {
            $('#bar3').barfiller({
                barcolor: "#3498db",
                tooltip: false,
            });
        }
        if ($.fn.barfiller) {
            $('#bar4').barfiller({
                barcolor: "#3498db",
                tooltip: false,
            });
        }
        if ($.fn.barfiller) {
            $('#bar5').barfiller({
                barcolor: "#3498db",
                tooltip: false,
            });
        }
        if ($.fn.barfiller) {
            $('#bar6').barfiller({
                barcolor: "#3498db",
                tooltip: false,
            });
        }


    });


})(jQuery);
