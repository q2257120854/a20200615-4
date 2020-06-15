"use strict";
/**
 * downCount: Simple Countdown clock with offset
 * Author: Sonny T. <hi@sonnyt.com>, sonnyt.com
 */
$(".alt-clock .clock-place").append("<div class='clock-container' > <header class='c-logo-top'> <img class='logo' src='./img/logo_only.png' alt='Logo image'> </header> <div class='c-metric c-layout'> <div class='c-dot-small'> <div class='rot30 c-rect-s c-rect'> <div class='c-mes'></div> </div> <div class='rot60 c-rect-s c-rect'> <div class='c-mes'></div> </div> <div class='rot120 c-rect-s c-rect'> <div class='c-mes'></div> </div> <div class='rot150 c-rect-s c-rect'> <div class='c-mes'></div> </div> <div class='rot210 c-rect-s c-rect'> <div class='c-mes'></div> </div> <div class='rot240 c-rect-s c-rect'> <div class='c-mes'></div> </div> <div class='rot300 c-rect-s c-rect'> <div class='c-mes'></div> </div> <div class='rot330 c-rect-s c-rect'> <div class='c-mes'></div> </div> </div> <div class='c-minsec-number'> <div class='c-top c-num'>00</div> <div class='c-right c-num'>15</div> <div class='c-bottom c-num'>30</div> <div class='c-left c-num'>45</div> </div> </div> <div class='c-minute-bg c-layout'> <div class='c-circle'></div> </div> <div class='c-minute c-layout '> <div class='c-circle'></div> <div class='c-dot'></div> </div> <div class='c-second-bg c-layout'> <div class='c-circle'></div> </div> <div class='c-second c-layout '> <div class='c-circle'></div> <div class='c-dot'></div> </div> <div class='c-layout c-separator'> <div class='c-fill'> </div> </div> <div class='c-hour c-layout'> <span class='number hours'>00</span> <span class='metric'>h</span> </div> <div class='c-day c-layout'> <span class='number days'>000</span> <span class='metric'>days</span> </div> </div>");

if($(".alt-clock .clock-place").attr('data-logosrc') 
   && $(".alt-clock .clock-place").attr('data-logosrc') != ""){
	var imgUrlSrc = $(".alt-clock .clock-place").attr('data-logosrc');
	$(".alt-clock .clock-place .logo").attr("src",imgUrlSrc) ;
//	$(".alt-clock .clock-place .logo").attr("src") = $(".alt-clock .clock-place").attr('data-logosrc');
}

(function ($) {

    $.fn.downCount = function (options, callback) {
        var settings = $.extend({
                date: null,
                offset: null
            }, options);

        // Throw error if date is not set
        if (!settings.date) {
            $.error('Date is not defined.');
        }

        // Throw error if date is set incorectly
        if (!Date.parse(settings.date)) {
            $.error('Incorrect date format, it should look like this, 12/24/2012 12:00:00.');
        }

        // Save container
        var container = this;

        /**
         * Change client's local date to match offset timezone
         * @return {Object} Fixed Date object.
         */
        
        var secCount = -1;
        var minCount = -1;
            
        var timeZone = +0;  
        if($('.site-config').attr('data-date-timezone') && ($('.site-config').attr('data-date-timezone') != '')){
            timeZone = $('.site-config').attr('data-date-timezone');
        }
        
        var currentDate = function () {
            // get client's current date
            var date = new Date();
            
            // turn date to utc
//            var utc = date.getTime() + (date.getTimezoneOffset() * 60000) - (360000*100);
            var utc = date.getTime() + (date.getTimezoneOffset() * 60000) - (360000*100) +(360000*10)*timeZone;
           
//            var utc = date.getTime() + (date.getTimezoneOffset() * 60000);

            // set new Date object
            var new_date = new Date(utc + (3600000*settings.offset))
            
            return new_date;
        };

        /**
         * Main downCount function that calculates everything
         */
        function countdown () {
            var target_date = new Date(settings.date), // set target date
                current_date = currentDate(); // get fixed current date

            // difference of dates
            var difference = target_date - current_date;

            // if difference is negative than it's pass the target date
            if (difference < 0) {
                // stop timer
                clearInterval(interval);

                if (callback && typeof callback === 'function') callback();

                return;
            }

            // basic math variables
//            var _second = 1000,
            var _second = 1000,
                _minute = _second * 60,
                _hour = _minute * 60,
                _day = _hour * 24;
			var _centi = _second / 100;

            // calculate dates
            var days = Math.floor(difference / _day),
                hours = Math.floor((difference % _day) / _hour),
                minutes = Math.floor((difference % _hour) / _minute),
                seconds = Math.floor((difference % _minute) / _second),
                centis = Math.floor((difference % _minute) / _centi );

                // fix dates so that it will show two digets
                days = (String(days).length >= 2) ? days : '0' + days;
                hours = (String(hours).length >= 2) ? hours : '0' + hours;
                minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
                seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;

            // based on the date change the refrence wording
            var ref_days = (days === 1) ? 'day' : 'days',
                ref_hours = (hours === 1) ? 'hour' : 'hours',
                ref_minutes = (minutes === 1) ? 'minute' : 'minutes',
                ref_seconds = (seconds === 1) ? 'second' : 'seconds';
            if(centis == 0){
                centis = 6000;
            }
			if(seconds == 0){
                seconds = 60;
            }
            if(seconds%60 == 0){                
                secCount--;
            }
            
            if(minutes == 0){
                minutes = 60;
            }
            if((minutes%60 == 0) && (seconds == 59)){                
                minCount--;
            }

            // set to DOM class or css according to position
            container.find('.days').text(days);
            container.find('.hours').text(hours);            
            container.find('.minutes').text(minutes);            
            container.find('.seconds').text(seconds);            
			
            container.find('.days_ref').text(ref_days);
            container.find('.hours_ref').text(ref_hours);
            container.find('.minutes_ref').text(ref_minutes);
            container.find('.seconds_ref').text(ref_seconds);
			
			var minRot = (360*minCount) + minutes*6 + 'deg';
            var secRot = (360*secCount) + seconds*6 + 'deg';
            container.find('.c-minute').css({'transform':'rotate('+minRot+')','-webkit-transform':'rotate('+minRot+')','-ms-transform':'rotate('+minRot+')','-moz-transform':'rotate('+minRot+')'});
            container.find('.c-second').css({'transform':'rotate('+secRot+')','-webkit-transform':'rotate('+secRot+')','-ms-transform':'rotate('+secRot+')','-moz-transform':'rotate('+secRot+')'});

			// set knob value 
			
            $(".second .knob").val(centis).trigger("change");
		};
        
        // start
//        var interval = setInterval(countdown, 1000);
//        var interval = setInterval(countdown, 1000*0.1);
		if($(".clock-container").length || $(".alt-clock").length ){
			var interval = setInterval(countdown, 250*1);
		}
		else{
			var interval = setInterval(countdown, 250*1);
		}
    };

})(jQuery);