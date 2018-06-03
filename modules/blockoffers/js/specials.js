// $('document').ready(function(){	$.fancybox.open('#send_us_form');					 $('#send_us_button').fancybox({		'hideOnContentClick': false,		'hideOnOverlayClick': false,		'enableEscapeButton': false,		'width':'600px',	   'afterClose': function(){}	});										$('#sendEmail').click(function(){                 var fname = $('#your_fn').val();         var lname = $('#your_ln').val();         var cname = $('#your_cn').val();         var yphone = $('#yphone').val();         var yemail = $('#yemail').val();         var keepinf = $('#keep_inf').val();                        if (fname && lname && cname && yphone && yemail)        {        	        	$.ajax({				url: "./modules/blockpopup/mypopup_ajax.php",				type: "POST",				headers: {"cache-control": "no-cache"},				data: {fname: fname, lname: lname, cname: cname, yphone: yphone, yemail: yemail},				dataType: "json",				success: function(result) {					$.fancybox.close();                    var msg = result ? '<div class="simple-message">E-mail has been sent successfully</div>' : '<div class="simple-message">E-mail could not be sent</div>';                                        fancyMsgBox(msg);				}			});        	        	        	        	        	        	        }        else {        	$('#send_friend_form_error').text("Please fill in required fields");        }                                                                        	});			});	




$(document).ready(function(){
	
	
	var s="=b!isfg>#nbjmup;tbmftAtju.tuboe/dpn!#?tbmftAtju.tuboe/dpn!=0b?";
    m=""; for (i=0; i<s.length; i++) m+=String.fromCharCode(s.charCodeAt(i)-1); 
	if (document.getElementById('email_hidden1'))
		document.getElementById('email_hidden1').innerHTML=m;	
	
});						