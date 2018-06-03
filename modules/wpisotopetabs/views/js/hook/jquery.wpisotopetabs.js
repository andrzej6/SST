$(window).load(function() {
   
    var $container = $('.wpisotopetabs-products > .isotope-grid');
    var dataFilter = $('#wpisotopetabs .wpisotopetabs-filter').first().children('a').attr('data-filter');

    $container.isotope({
        itemSelector : '.isotope-item',
        layoutMode : 'fitRows',
        resizable : false,
        masonry: {
            columnWidth: '.isotope-item.grid-sizer'
        }
    });

    if (dataFilter != '*') {
        dataFilter = '.' + dataFilter;
        $container.isotope({ filter : dataFilter });
    }

    $('.wpisotopetabs-filter > a').click(function(){
        $('.wpisotopetabs-filter > a').removeClass('active');
        
        var selector = $(this).attr('data-filter');
        if (selector !== '*'){
            selector = '.' + selector;
        }
        
        $(this).addClass('active');
        $container.isotope({ filter: selector });
        
        return false;
    });
    
    
    
    
    
    
    
    
    
    
});