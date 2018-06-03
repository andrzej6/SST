$(window).load(function(){
    $('#wpmanufacturercarousel-manufacturers').owlCarousel({
        itemsCustom: [ [0, 2], [319, 2], [419, 3], [479, 3], [639, 4], [767, 4], [959, 5], [1023, 6], [1279, 7], [1559, 7] ],
        responsiveRefreshRate: 50,
        slideSpeed: 200,
        paginationSpeed: 500,
        rewindSpeed: 600,
        autoPlay: wpmc_autoscroll,
        stopOnHover: wpmc_pauseonhover,
        rewindNav: true,
        pagination: true,
        navigation: true,
        navigationText: ['<div class="carousel-previous disable-select"><span class="wpicon wpicon-chevron-left medium"></span></div>', '<div class="carousel-next disable-select"><span class="wpicon wpicon-chevron-right medium"></span></div>']
    });
});

