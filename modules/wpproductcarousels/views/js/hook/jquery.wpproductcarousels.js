$(window).load(function()
{
    $('.wpproductcarousel-carousel').each(function(){
        var self = $(this);

        self.owlCarousel({
            itemsCustom: [ [0, 1], [379, 2], [419, 2], [479, 2], [639, 3], [767, 3], [959, 4], [1023, 4], [1279, 5], [1559, 5] ],
            responsiveRefreshRate: 50,
            slideSpeed: 200,
            paginationSpeed: 500,
            rewindSpeed: 600,
            autoPlay: wppc_autoscroll,
            stopOnHover: wppc_pauseonhover,
            rewindNav: true,
            pagination: true,
            navigation: true,
            navigationText: ['<div class="carousel-previous disable-select"><span class="wpicon wpicon-chevron-left medium"></span></div>', '<div class="carousel-next disable-select"><span class="wpicon wpicon-chevron-right medium"></span></div>']
        });

    });

});