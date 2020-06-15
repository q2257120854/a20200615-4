	/*
*  File name: Scritps.js
 * CS All main scripts are here
 */


;(function($) {
  'use strict';

  /*
   * Page loading effects
   */
  if ($('.an-loader-container').length > 0 ) {
    $(window).on('load', function() {
      $(".an-loader-container").fadeOut("slow");
    });
  }


  /*
   * custom scroll scripts
   */
  if ($('.an-info-content').length > 0) {
    $('.an-info-content').perfectScrollbar({
      wheelPropagation: true,
    });
  }

  if ($('.an-customScrollbar').length > 0) {
    $('.an-customScrollbar').perfectScrollbar({
      wheelPropagation: true,
    });
  }





  /*
   * Slectize plugin call
   * customize basic select box
   */

  if ($('.an-default-select-wrapper').length > 0) {
    $('.an-default-select-wrapper select').selectize();
  }

  if ($('.js-input-tags').length > 0) {
    $('.js-input-tags').selectize({
      delimiter: ',',
      persist: true,
      create: function(input) {
        return {
          value: input,
          text: input,
        };
      },
    });
  }

  if ($('.js-input-tags.max').length > 0) {
    $('.js-input-tags.max').selectize({
      delimiter: ',',
      persist: true,
      maxItems: 3,
      create: function(input) {
        return {
          value: input,
          text: input,
        };
      },
    });
  }


  /*
   * Activate bootstrap tooptips
   */

  if ($('.js-tooltip').length > 0) {
    $('.js-tooltip').tooltip();
  }

  // if ($('.collapse').length > 0) {
  //   $('.collapse').collapse()
  // }

  if ($('.js-popover').length > 0) {
    $('.js-popover').popover();
  }

  /*
   * file input plugin install
   */

  if ($('#input-id').length > 0) {
    $("#input-id").fileinput({
      showCaption: false,
    });
  }

  if ($('#input-id2').length > 0) {
    $("#input-id2").fileinput({
      showCaption: false,
    });
  }

  /*
   * LC switch box
   */

  if ($('.an-switch-box-wrapper').length > 0) {
    $('.an-switch-box-wrapper input').lc_switch();
  }

  /*
   * Bootstrap switch box
   */

  if ($('.an-bs-switch-wrapper').length > 0) {
    $('.an-bs-switch-wrapper input').bootstrapSwitch();
  }


  /*
   * Bootstrap date time picker
   */
  // basic date time picker
  if ($('.an-date-time').length > 0) {
    $('#datetimepicker1').datetimepicker();
  }

  // Custom icon date time picker script
  if ($('.an-date-time').length > 0) {
    $('#datetimepicker2').datetimepicker({
      icons: {
        time: "ion-clock",
        date: "ion-android-calendar",
        up: "ion-ios-arrow-up",
        down: "ion-ios-arrow-down"
      }
    });
  }

  // Custom icon date time picker script
  if ($('.an-date-time').length > 0) {
    $('#datetimepicker3').datetimepicker({
      viewMode: 'months'
    });
  }

  // Custom icon date time picker script
  if ($('.an-date-time').length > 0) {
    $('#datetimepicker4').datetimepicker({
      daysOfWeekDisabled: [0, 6]
    });
  }



  /*
   * Isotope call script
   */

  if ($('.an-portfolio-section').length > 0) {
    var $grid = $('.an-portfolio-section .row').isotope({
      // options
      itemSelector: '.col-md-3',
    });

    $('.filter-button-group').on( 'click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });
  }




  /*
   * Notifications scripts
   */

  if ($('.an-notifications-container').length > 0) {
    $('.js-nofitication-body').hide();
    $('.js-an-notification-trigger').on('click', function (e) {
      e.preventDefault();
      $(this).siblings().children('.js-nofitication-body').toggle();
    });

    $('.js-nofitication-body .close').on('click', function () {
      $(this).parent().hide();
    });
  }


  if ($('.js-fixed-header').length > 0) {
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();

      // >=, not <=
      if (scroll >= 80) {
        //clearHeader, not clearheader - caps H
        $('.js-fixed-header').addClass('an-fixed-header');
      }

      if (scroll <= 0) {
        // clearHeader, not clearheader - caps H
        $('.js-fixed-header').removeClass('an-fixed-header');
      }
    });
  }

  /*
   *
   * Sidebar toggle action fires here
   *  window.resize used for tab mobile view
   */

  var toggleHandleButoon = $('.js-toggle-sidebar');
  var toggleListener = $('.js-sidebar-toggle-with-click');

  $(toggleHandleButoon).on('click', function (e) {
    e.preventDefault();
    $(toggleListener).toggleClass('collapse');

    // child menu hide when sidebar collapse
    // $(showChildNav).toggle()
    // $(navClick).removeClass('nav-open');
  });

  /*
   * Nav menu show hide
   */

  var navClick = $('.js-show-child-nav');
  var showChildNav = $('.js-open-nav');

  $(navClick).on('click', function (e) {
    e.preventDefault();
    // slideup siblings nav child menu if any open
    $(this).parent().siblings().find(showChildNav).slideUp(200);
    $(this).parent().siblings().find(navClick).removeClass('nav-open');
    // add class and slide down nav child menu when clicked
    $(this).toggleClass('nav-open');
    $(this).siblings(showChildNav).slideToggle(200);
  });

  // additional scripts for controlls sidebar nav on mobile view
  var $window = $(window);

  if (!($('.js-narrow-sidebar').length || $('.js-hover-sidebar').length)) {
    $window.resize(function resize() {
      if ($window.width() < 768) {
        return false;
      }
      if ($window.width() < 991) {
        return $(toggleListener).addClass('collapse');
      }
      $(toggleListener).removeClass('collapse');
    }).trigger('resize');

    $(document).ready(function () {
      if ($window.width() < 991) {
        $(toggleListener).addClass('collapse');
      }
      if ($window.width() > 991) {
        $(toggleListener).removeClass('collapse');
      }
    });
  }


  /*
   *
   * Search toggle when sidebar collapse
   *
   */
  var searchToggleBtn = $('.js-search-toggle');
  var searchShowWhenClicked = $('.js-search-show-clicked');

  $(searchToggleBtn).on('click', function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $(searchShowWhenClicked).toggleClass('show-search');
  });


  /*
   *
   * Default slider for every slider inside this template
   * If you want to change some slider style like increase item
   * better clone this code in the bottom then try.
   *
   */

  if ($('.default-slider').length > 0) {
    $('.default-slider').owlCarousel({
      items: 1,
      singleItem: true,
      autoPlay: true,
      navigation: true,
      navigationText: ['&#xe934', '&#xe932'],
      pagination: false,
    });
  }


  /*
  *
  * Circle progressbar configuration goes here
  * Circle progressbar not comming from chart.js
  * its from jquery plguin and the filenae circle-progressbar.min.js
  * if you want to check the source file and want to
  * customize circle progressbar please visit here
  * https://github.com/kottenator/jquery-circle-progress
  *
  */

  var circle = $('.js-circle');
  if (circle.length > 0) {
    circle.circleProgress({
      thickness: 5,
      value: 0.75,
      size: 150,
      fill: {
        gradient: ['#025d83'],
      },
    })
    .on('circle-animation-progress', function (e, p, v) {
      $(this).children('.value').children('.value-holder').text((v * 100).toFixed() + '%');
    });
  }


  var circletwo = $('.js-circle-two');
  if (circletwo.length > 0) {
    circletwo.circleProgress({
      thickness: 5,
      value: 0.85,
      size: 150,
      fill: {
        gradient: ['#70c1b3'],
      },
    })
    .on('circle-animation-progress', function (e, p, v) {
      $(this).children('.value').children('.value-holder').text((v * 100).toFixed() + '%');
    });
  }


  /*
   * Recent user short description string slice
   * for design purpose
   */

  var shortDescription = $('.short-desc');
  if (shortDescription.length > 0) {
    shortDescription.text(function (index, currentText) {
      return currentText.substr(0, 105) + '...';
    });
  }


  /*
   * ionrange slider scripts
   */
  // basic range sldier
  if ($('.an-ion-range-slider-block').length > 0) {
    $(".range_01").ionRangeSlider();
  }

  // set min max and start point
  if ($('.an-ion-range-slider-block').length > 0) {
    $(".range_02").ionRangeSlider({
      min: 100,
      max: 1000,
      from: 550
    });
  }

  // Set type to double and specify range, also showing grid and adding prefix "$"
  if ($('.an-ion-range-slider-block').length > 0) {
    $(".range_03").ionRangeSlider({
      type: "double",
      grid: true,
      min: 0,
      max: 1000,
      from: 200,
      to: 800,
      prefix: "$"
    });
  }

  // Using step 250
  if ($('.an-ion-range-slider-block').length > 0) {
    $(".range_04").ionRangeSlider({
      type: "double",
      grid: true,
      min: -1000,
      max: 1000,
      from: -500,
      to: 500,
      step: 250
    });
  }

  // Using string value
  if ($('.an-ion-range-slider-block').length > 0) {
    $(".range_05").ionRangeSlider({
      grid: true,
      from: 5,
      values: [
        "zero", "one",
        "two", "three",
        "four", "five",
        "six", "seven",
        "eight", "nine",
        "ten"
      ]
    });
  }

  // Prettify big value
  if ($('.an-ion-range-slider-block').length > 0) {
    $(".range_06").ionRangeSlider({
      grid: true,
      min: 1000,
      max: 1000000,
      from: 200000,
      step: 1000,
      prettify_enabled: true
    });
  }


  /* full calendar call
   * here using the basic calendar
   */

  var fullCalendar = $('.calendar');
  if (fullCalendar.length > 0) {
    fullCalendar.fullCalendar({
      header: {
        left: 'prev,next',
        center: 'title',
        right: 'month,agendaWeek,agendaDay',
      },
      defaultDate: '2016-06-12',
      defaultView: 'month',
      editable: true,
      events: [
        {
          title: 'All Day Event',
          start: '2016-06-01',
        },
        {
          title: 'Long Event',
          start: '2016-06-07',
          end: '2016-06-10',
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2016-06-09T16:00:00',
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2016-06-16T16:00:00',
        },
        {
          title: 'Meeting',
          start: '2016-06-12T10:30:00',
          end: '2016-06-12T12:30:00',
        },
        {
          title: 'Lunch',
          start: '2016-06-12T12:00:00',
        },
        {
          title: 'Birthday Party',
          start: '2016-06-13T07:00:00',
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2016-06-28',
        },
      ],
    });
  }
})(jQuery);


/**
 *
 * Bootstrap daterange picker customiztion
 *
 */

;(function($) {
  'use strict';

  if ($('#reportrange').length > 0) {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
      $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);

    cb(start, end);

  }


})(jQuery);


/*
 * Sweetalerts initialization
 */

function BasicAlerts(){
  swal("Here's a message!")
}

function AlertsWithTextUnder(){
  swal("Here's a message!", "It's pretty, isn't it?")
}

function AlertsSuccess(){
  swal("Good job!", "You clicked the button!", "success")
}

function AlertsWithConfirm(){
  swal({
    title: "Are you sure?",
    text: "You will not be able to recover this imaginary file!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },
  function(){
    swal("Deleted!", "Your imaginary file has been deleted.", "success");
  });
}

function AlertsWithCancel(){
  swal({
    title: "Are you sure?",
    text: "You will not be able to recover this imaginary file!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel plx!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm){
    if (isConfirm) {
      swal("Deleted!", "Your imaginary file has been deleted.", "success");
    } else {
      swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
  });
}

function AlertsWithPrompt(){
  swal({
    title: "An input!",
    text: "Write something interesting:",
    type: "input",
    showCancelButton: true,
    closeOnConfirm: false,
    animation: "slide-from-top",
    inputPlaceholder: "Write something"
  },
  function(inputValue){
    if (inputValue === false) return false;

    if (inputValue === "") {
      swal.showInputError("You need to write something!");
      return false
    }

    swal("Nice!", "You wrote: " + inputValue, "success");
  });
}



// clipboard call
//
var clipboard = document.querySelector('.js-copybtn');

if (clipboard) {
  (function(){
    new Clipboard('.js-copybtn');
  })();
}

/*
 * Initialize wow js for scrolling aniamtion
*/
new WOW().init();
