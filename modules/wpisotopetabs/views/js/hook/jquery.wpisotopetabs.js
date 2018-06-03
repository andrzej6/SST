$(window).load(function() {		var boxwidth = $(".item-upper-container").width();	    //below changes to button positioning in isotope tabs to have on the picture    cleft = (boxwidth - 132.13)/2;    left = cleft.toString()+'px';        ctop = boxwidth/2 + 34.2;    vtop = '-'+ ctop.toString()+ 'px';    	//console.log( "left:"+left+",top:"+vtop );	$(".item-buttons").css({            position: 'absolute',            top: vtop,            left: left    });            window.onresize = function(event) {    boxwidth = $(".item-upper-container").width();        cleft = (boxwidth - 132.13)/2;    left = cleft.toString()+'px';        ctop = boxwidth/2 + 34.2;    vtop = '-'+ ctop.toString()+ 'px';    	//console.log( "left:"+left+",top:"+vtop );	$(".item-buttons").css({            position: 'absolute',            top: vtop,            left: left    });};            	
   
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