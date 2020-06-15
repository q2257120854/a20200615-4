/*------------------------------------------------------------------
 * Theme Name: Hostino Responsive Template
 * Theme URI: http://www.brandio.io/envato/hostino
 * Author: Brandio
 * Author URI: http://www.brandio.io/
 * Description: A Bootstrap Responsive HTML5 Template
 * Version: 1.0
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2017 Brandio.
 -------------------------------------------------------------------*/

"use strict";

// Add Slider functionality to the top of home page in #top-content section.
$("#main-slider","#top-content").slick({
    dots: true,
    customPaging: function(slider, i) { 
        return '<button class="tab">' + $(slider.$slides[i]).attr('title') + '</button>';
    },
    arrows: false,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1
});
// Add Slider functionality to the #testimonials section in the home page.
$("#testimonials-slider","#testimonials").slick({
    dots: false,
    arrows: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1
});
// Add Slider functionality to the images in the "Sign in" and "Sign out" pages.
$(".img-text-slider","#form-section").slick({
    dots: true,
    arrows: false,
    infinite: false,
    autoplay: true,
    speed: 200
});
// Add Slider functionality to the about page images in #about section.
$(".photo-slider","#about").slick({
    dots: true,
    arrows: false,
    infinite: false,
    autoplay: true,
    speed: 200
});
// Add Slider functionality to the about page text in #goals section.
$("#text-slider","#goals").slick({
    dots: true,
    customPaging: function(slider, i) { 
        return '<button class="tab">' + $(slider.$slides[i]).attr('title') + '</button>';
    },
    arrows: false,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1
});

$(window).on("load", function() {
    // Adding hover style for the feature box
    var featureBox = $(".mfeature-box", "#features");
    featureBox.on("mouseover",function(){
        featureBox.removeClass("active");
        $(this).addClass("active");
        return false;
    });
    // Adding hover style for the info box
    var infobox = $(".info-box", "#contact-info");
    var infoboxBorderColor = $('div[class^="col-"]:nth-child(2) .info-box','#contact-info').css("border-color");
    infobox.on("mouseover",function(){
        infobox.css("border-color","transparent");
        return false;
    });
    infobox.on("mouseout",function(){
        infobox.css("border-color",infoboxBorderColor);
        return false;
    });
    // Apps Section hover function
    var appHolder = $(".app-icon-holder", "#apps");
    
    appHolder.on("mouseover",function(){
        appHolder.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details", "#apps").removeClass("show-details");
        $(".app-details"+$(this).data("id"), "#apps").addClass("show-details");
    });
});