/* -------------------------------------------------- *
 * JS Imports 

@codekit-prepend "vendors/jquery.fitvids.js"
@codekit-prepend "vendors/jquery.fancybox.js"
@codekit-prepend "vendors/layzr.js"
@codekit-prepend "vendors/js.cookie.js"

** -------------------------------------------------- */


//////////////////////////////////////////////////////////////////////////////////////////////////
////// FancyBox
$( window ).ready(function() {
	$('[data-fancybox]').fancybox({
	    loop     : true,
		//buttons: [ "zoom", "thumbs", "close" ],
		transitionEffect: "zoom-in-out",
	});
});


//////////////////////////////////////////////////////////////////////////////////////////////////
////// Set PDF links to open in new window
$(function() {
    $('a[href$=".pdf"]').attr('target', '_blank');  
});


//////////////////////////////////////////////////////////////////////////////////////////////////
////// Layzr image lazy loading
var layzr = new Layzr({
	threshold: 25,
});


//////////////////////////////////////////////////////////////////////////////////////////////////
////// FitVids
$(".fitvid,.fitvids").fitVids();


//////////////////////////////////////////////////////////////////////////////////////////////////
////// Menu
$(function () {
    $('.menu-toggle').click(function(){
        $('body').addClass('open-overlay');
    });
    $('.overlay-close').click(function(){
        $('body').removeClass('open-overlay');
    });
    
    //// Recommendations
    $('.callout-toggle').click(function(){
        $('body').addClass('callout-on');
    });
    $('.close-callout').click(function(){
        $('body').removeClass('callout-on');
    });
    
    //// Smooth Scrolling
    $('a[href*="#"]:not([href="#"])').not('.tab-labels a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });
    
    //// Download Actions dropdown
    $('.download h5').click(function(){
        $(this).next().slideToggle('fast');
    });
    
    //// Actions Link
    $('.actions .listen').click(function(){
        $(this).fadeOut('normal');
        $('.plyr--audio').slideDown('normal');
    });
    
    //Remove link from header menu items with no-link class
    $('#header-menu li.no-link a').first().click(function(e){
	    e.preventDefault();
    });
});


//////////////////////////////////////////////////////////////////////////////////////////////////
////// Close Menu and Recommendations Field with "ESC"
$(document).keyup(function(e) {
     if (e.keyCode === 27) {
        $('body').removeClass('callout-on');
        $('body').removeClass('open-overlay');
    }
});


//////////////////////////////////////////////////////////////////////////////////////////////////
////// Hide/Show Header
var headerTop = $('.header-wrapper').position();
var previousScroll = 0;
var headerOffset = headerTop.top;
$(window).scroll(function() {
    var currentScroll = $(this).scrollTop();
    if(currentScroll > headerOffset) {
        if (currentScroll > previousScroll) {
            $('.header-wrapper, .campus-menu').removeClass('slide-down');
			$('.header-wrapper, .campus-menu').addClass('slide-up');
        } else {
            $('.header-wrapper, .campus-menu').addClass('slide-down');
			$('.header-wrapper, .campus-menu').removeClass('slide-up');
        }
    } else {
        $('.header-wrapper, .campus-menu').removeClass('slide-down');
    }
    previousScroll = currentScroll;
});
