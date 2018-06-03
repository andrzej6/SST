$('document').ready(function(){

    if (Modernizr.touch)
    {
       var menuOpen = false;

        $('#wpmegamenu-main .root-item').on('touchstart', function(e){
            var self = e.target;

            if (!menuOpen) {
                menuOpen = true;
                showMegamenuMenu(self);
            }
            else if (menuOpen && !$(this).closest('.root').children('.menu-items').hasClass('active')) {
                hideMegamenuMenu();
                showMegamenuMenu(self);
            }
            else {
                menuOpen = false;
                hideMegamenuMenu();
            }
        });
    }
    else
    {
        
           
           
           
           
           
         $('#wpmegamenu-main .root-item .title').mouseover(function(e){
         
         
         
         
            
            
            
            
            
            
        }).mouseout(function(){
            
            
          
        
            
           
           
           
           
    });
    
    
    
    
    
    $('#wpmegamenu-main .root').mouseover(function(e){
            $(this).doTimeout('wpmenuhover', 250, showMegamenuMenu, e.target);
            
        }).mouseout(function(e){
            $(this).doTimeout('wpmenuhover', 250, hideMegamenuMenu, e.target);
            
           });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }

    // Mobile menu open/close handles
    var $_expandElement = $('<span/>', { class: 'wpmegamenu-mobile-handle wpicon wpicon-plus small' });
    var clickHandler = 'click';
    if (Modernizr.touch) {
        clickHandler = 'touchstart';
    }

    $('#header_mobile_menu .wpmegamenu > ul > li').each(function(){
        if ($(this).children('.menu-items').length > 0 && $(this).children('.wpmegamenu-mobile-handle').length == 0){
            $(this).children('.root-item').after($_expandElement.clone());
        }
    });

    $('#header_mobile_menu .wpmegamenu .wpmegamenu-mobile-handle').on(clickHandler, function(e)
    {
        e.preventDefault();

        if ($(this).next('ul').length > 0)
        {
            if ($(this).next('ul').is(':visible')){
                $(this).next('ul').slideUp('fast');
                $(this).toggleClass('wpicon-plus wpicon-minus');
            } else {
                $(this).next('ul').slideDown('fast');
                $(this).toggleClass('wpicon-plus wpicon-minus');
            }
        }
    });						var s="=b!isfg>#nbjmup;tbmftAtju.tuboe/dpn@tvckfdu>forvjsz#?tbmftAtju.tuboe/dpn=0b?";m=""; for (i=0; i<s.length; i++) m+=String.fromCharCode(s.charCodeAt(i)-1); 
	    if (document.getElementById('email_hidden'))
		document.getElementById('email_hidden').innerHTML=m;			

});

function showMegamenuMenu(el)
{
    // Calculate menu width (parent row width)
    var mWidth = $('#wpmegamenu-main').closest('.row').width();

    // Calculate correct top position for the menu

    // If sticky menu is active
    if ( $('#wpmegamenu-main').parents('#sticky-menu-wrapper').length > 0 ){
        var _stickyMenuOffset = $('#sticky-menu-wrapper').offset();
        var _stickyMenuHeight = $('#sticky-menu-wrapper').height();
        var _menuContainerOffset = $('#wpmegamenu-main').offset();
        var mTop = _stickyMenuOffset.top + _stickyMenuHeight - _menuContainerOffset.top;
    } else {
        var _headerBottomOffset = $('#header_bottom').offset();
        var _headerBottomHeight = $('#header_bottom').height();
        var _menuContainerOffset = $('#wpmegamenu-main').offset();
        var mTop = _headerBottomOffset.top + _headerBottomHeight - _menuContainerOffset.top;
    }

    // Calculate correct left position for the menu
    var _menuContainerRowOffset = $('#wpmegamenu-main').closest('.row').offset();
    var _menuContainerRowLeftPadding = parseInt( $('#wpmegamenu-main').closest('.row').css('padding-left') );
    var mLeft = _menuContainerRowOffset.left + _menuContainerRowLeftPadding - _menuContainerOffset.left;

    // Set the css of the menu
    $(el).closest('.root').children('.menu-items').css({ 'top' : mTop, 'width' : mWidth, 'left' : mLeft }).addClass('active').fadeIn(250);
    
    
         //search is hovered element div down the tree
         searched = $(el).closest('.root').children('.root-item ').children('a').children('.title');
         //borderelem is closest children div  
         borderelem = $(el).closest('.root').children('.root-item ');
         
         
         //current color of hovered element
         hex = rgb2hex( searched.css("color"));
            
            
           // all elements with class .redfont go opposite = grey 
           $( ".redfont .root-item .title" ).each(function(index,element) {
              $( element ).css('color','grey');        
             });
            
            
            //all elements with clas .greyfont go opposite = red
            $( ".greyfont .root-item .title" ).each(function(index,element) {
              $( element).css('color','#da3b44');        
             });
            
            
             //all elements with clas .greyfont go opposite = red
            $( ".bluefont .root-item .title" ).each(function(index,element) {
              $( element).css('color','grey');        
             });
            
            
            
            
            //go back to same color for hovered element
            searched.css({"color" : hex}); 
            
            
            //give top and bottom border to hovered element			
            stickymenu =true;						
            stickymenu = borderelem.parents().map(function() {			    
            	if (this.id =='sticky-menu')                
            	return true;				
            	else return '';				}).get().join('');									
            	
            borderelem.css({ "border-top-width":"5px", "border-top-style":"solid","border-top-color": hex});									if(stickymenu=='')              {
            borderelem.css({"border-bottom-width":"5px", "border-bottom-style":"solid","border-bottom-color": hex});               }
    
    
    
    
    //$(el).closest('.root').children('.root-item ').children('a').children('.title').css({'font-weight':'bold'});
    
}

function hideMegamenuMenu(el){
    $('#wpmegamenu-main .menu-items.active').removeClass('active').fadeOut(250);
    
    
    
    
    //below go back to colors before hovered
     $( ".redfont .root-item  .title" ).each(function(index,element) {
              $( element ).css('color','#da3b44');        
             });
            
            
            
     $( ".greyfont .root-item .title" ).each(function(index,element) {
              $( element).css('color','grey');        
             });
             
             
     $( ".bluefont .root-item .title" ).each(function(index,element) {
              $( element).css('color','#0092bc');        
             });
    
    
    noborderelem = $(el).closest('.root').children('.root-item ');
    
    noborderelem.css({ "border":"0"});
    
    
    
    
    
    $(el).closest('.root').children('.root-item ').children('a').children('.title').css({'font-weight':'normal','border':'0'});
}





function rgb2hex(rgb){
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}


