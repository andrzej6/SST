 $('document').ready(function(){	



 	
if (passok=='OK')
  {
    $('#pdfs-hidden').show('slow');
    $('#enter_pass').hide();
  }
   else   
$.fancybox.open('#insert_pass');	 	
 	
 	 		
$('#enter_pass').click(function(){  
	$.fancybox.open('#insert_pass');
	});	


$('#your_pass').keypress(function (e) {
  if (e.which == 13) {
    $('#getpdfs').click();
  }
});





   

$('#getpdfs').click(function(){  
       var pass = $('#your_pass').val();
       if (pass)
       {
          if (pass == 'magicpass')
            {
            	
            	$.fancybox.close(); 
            	
            	
            	
            	
            	$.ajax({url: "./modules/blockgetdownloads/save_cookie.php",				
                        type: "POST",				
                        headers: {"cache-control": "no-cache"},				
                        data: {fname: 'zzz'},				
                        dataType: "json",				
                        success: function(result) {					
                                  $.fancybox.close();                   
                                   
                                    $('#pdfs-hidden').show('slow');
                                    $('#enter_pass').hide();
                                   			
                                    	}			
                                    	});      
            	
            	
            	
            	
            	
            	
            	
            	
            	
            }
            
            else 
            {
            	$('#insert_pass_form_error').text("Password incorrect");  
            }
            
            
       }
       
       else 
       {
       	  $('#insert_pass_form_error').text("Please insert password");  
       }   
       
       
    });	

	                    		       
    		});							