$(window).load(function(){
    $('#wpimageslider').flexslider({
        animation: wpis_effect,
        slideshow: wpis_autoscroll,
        slideshowSpeed: wpis_autoscrolldelay,
        animationSpeed: wpis_autoscrollspeed,
        pauseOnHover: wpis_pauseonhover,
        controlNav: wpis_controlnav,
        directionNav: wpis_directionalnav,
        prevText: "",
        nextText: "",
        controlsContainer: "#wpimageslider"
    });
});