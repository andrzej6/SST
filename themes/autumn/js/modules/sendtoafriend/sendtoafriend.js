/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
$(document).ready(function(){

	if (!!$.prototype.fancybox)
	{
		$('#send_friend_button').fancybox({
			'hideOnContentClick': false
		});
		
		$('#send_us_button').fancybox({
		'hideOnContentClick': false
	});
	
	
	$('#review_button').fancybox({
			'hideOnContentClick': false
		});
	
		
		
	}	

	$('#send_friend_form_content .closefb').click(function(e) {
		$.fancybox.close();
		e.preventDefault();
	});
	
	
	$('#send_us_form_content .closefb').click(function(e) {
		$.fancybox.close();
		e.preventDefault();
	});
	
	
	

	$('#sendEmail').click(function(){
		var name = $('#friend_name').val();
		var email = $('#friend_email').val();
		if (name && email && !isNaN(id_product))
		{
			$.ajax({
				url: baseDir + 'modules/sendtoafriend/sendtoafriend_ajax.php?rand=' + new Date().getTime(),
				type: "POST",
				headers: {"cache-control": "no-cache"},
				data: {
					action: 'sendToMyFriend', 
					secure_key: stf_secure_key,
					name: name, 
					email: email, 
					id_product: id_product
				},
				dataType: "json",
				success: function(result) {
					$.fancybox.close();
					fancyMsgBox((result ? stf_msg_success : stf_msg_error), stf_msg_title);
				}
			});
		}
		else
			$('#send_friend_form_error').text(stf_msg_required);
	});
	
	
	
	$('#sendEmail1').click(function(){       $.fancybox.close();
	
	  var email1 = $('#your_email').val();
    var message = $('#message').val();
    var phone = $('#your_phone').val();
	   
		
		
		if (message && email1 && !isNaN(id_product))
		{  				            
			$.ajax({
				url: baseDir + 'modules/sendtoafriend/sendtoafriend_ajax.php?rand=' + new Date().getTime(),
				type: "POST",
				headers: {"cache-control": "no-cache"},
				data: {
					action: 'sendToUs', 
					secure_key: stf_secure_key,
					message: message, 
					email: email1,
					phone: phone, 
					id_product: id_product
				},
				dataType: "json",
				success: function(result) {
					$.fancybox.close();
					fancyMsgBox((result ? stf_msg_success : stf_msg_error), stf_msg_title);
				}
			});
		}
		else
			$('#send_us_form_error').text(stf_msg_required);
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});