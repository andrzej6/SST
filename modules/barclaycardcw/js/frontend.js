/**
  * You are allowed to use this API in your web application.
 *
 * Copyright (C) 2015 by customweb GmbH
 *
 * This program is licenced under the customweb software licence. With the
 * purchase or the installation of the software in your application you
 * accept the licence agreement. The allowed usage is outlined in the
 * customweb software licence which can be found under
 * http://www.sellxed.com/en/software-license-agreement
 *
 * Any modification or distribution is strictly forbidden. The license
 * grants you the installation in one application. For multiuse you will need
 * to purchase further licences at http://www.sellxed.com/shop.
 *
 * See the customweb software licence agreement for more details.
 *
 */

(function ($) {
	
	var attachEventHandlers = function() {
		
		var buildHiddenFormFields = function (fields) {
			var output = '';
			for (var key in fields) {
				if (fields.hasOwnProperty(key)) {
					output += '<input type="hidden" value="' + fields[key].replace('"', '&quot;') + '" name="' + key + '" />';
				}
			}
			return output;
		};

		$('.barclaycardcw-alias-form').submit(function(event) {
			var form = $(this);
			var completeForm = form.parents('.barclaycardcw-payment-form');
			var completeFormId = completeForm.attr('id');
			
			$("#" + completeFormId).animate({
				opacity : 0.3,
				duration: 30, 
			});
			
			$.ajax({
				type: 		'POST',
				url: 		form.attr('action'),
				data: 		form.serialize() + '&ajaxAliasForm=true',
				success: 	function( response ) {
					
					var newPane = $("#" + completeFormId, $(response));
					if (newPane.length > 0) {
						var newContent = newPane.html();
						$("#" + completeFormId).html(newContent);
						
						// Execute the JS to make sure any JS inside newContent is executed
						$(response).each(function(k, e) {
							if(typeof e === 'object' && e.nodeName == 'SCRIPT') {
								jQuery.globalEval(e.innerHTML);
							}
						});
						attachEventHandlers();
					}
					
					$("#" + completeFormId).animate({
						opacity : 1,
						duration: 100, 
					});
				},
			});
			
			return false;
		});
		$('.barclaycardcw-alias-form').find("input[type='checkbox']").change(function(event) {
			$(this).parents('form').submit();
		});
		$('.barclaycardcw-alias-form').find("select").change(function(event) {
			$(this).parents('form').submit();
		});
		$('.barclaycardcw-alias-form').find("input[type='submit']").click(function(event) {
			$(this).parents('form').append('<input type="hidden" name="' + $(this).attr('name') + '" value="' + $(this).val() + '" />');
		});
		
		$('.barclaycardcw-ajax-authorization-form').each(function() {
			
			var ajaxForm = $(this);
			ajaxForm.parents('.barclaycardcw-payment-form').find('[name="processPayment"]').click(function(event) {
				var methodName = ajaxForm.attr('data-method-name');
				var callback = window['barclaycardcw_ajax_submit_callback_' + methodName];
				var hasNoErrors = false;
				
				var validationCallback = window['barclaycardcw_' + methodName + '_validatePaymentFormElements'];
				var rs = true;
				if (typeof validationCallback != 'undefined') {
					rs = validationCallback();
				}
				if (rs != false) {
					if (typeof callback == 'undefined') {
						alert("No Ajax callback found.");
					}
					else {
						var fields = {};
						var data = ajaxForm.serializeArray();
						$(data).each(function(index, value) {
							fields[value.name] = value.value;
						});
						callback(fields);
					}
				}
				else {
					$('.barclaycardcw-payment-form').find('[name="processPayment"]').each(function() {
						$(this).show();
					});
				}
			});
			
		});
		
		$('.barclaycardcw-create-transaction').each(function() {
			var ajaxUrl = $(this).attr('data-ajax-url');
			var sendFormDataBack = $(this).attr('data-send-form-back') == 'true' ? true : false;
			var form = $(this).children('form[data-method-name]');
			var methodName = form.attr('data-method-name');
			form.submit(function() {
				if (window.barclaycardcwAjaxRequestInProgress === true) {
					return false;
				}
				window.barclaycardcwAjaxRequestInProgress = true;
				var formData = null;
				if (sendFormDataBack) {
					formData = form.serialize()
				}
				
				var validationCallback = window['barclaycardcw_' + methodName + '_validatePaymentFormElements'];
				var rs = true;
				if (typeof validationCallback != 'undefined') {
					rs = validationCallback();
				}
				if (rs != false) {
					var fields = {};
					$(form.serializeArray()).each(function(index, value) {
						fields[value.name] = value.value;
					});
					
					form.animate({
						opacity : 0.3,
						duration: 30, 
					});
					$.ajax({
						type: 		'POST',
						url: 		ajaxUrl,
						data: 		formData,
						success: 	function( response ) {
							var error = response;
							try {
								var data = $.parseJSON(response);
								
								if (data.status == 'success') {
									var func = eval('[' + data.callback + ']')[0];
									func();
									return;
								}
								else {
									error = data.message;
								}
							}
							catch(e) {
								console.log(e);
							}
							
							form.animate({
								opacity : 1,
								duration: 100, 
							});
							form.prepend("<div class='barclaycardcw-error-message-inline alert alert-danger'>" + error + "</div>");
							window.barclaycardcwAjaxRequestInProgress = false;
						},
					});
				}
				else {
					$('.barclaycardcw-payment-form').find('[name="processPayment"]').each(function() {
						$(this).show();
					});
					window.barclaycardcwAjaxRequestInProgress = false;
				}
				return false;
			});
		});
		
		$('.barclaycardcw-payment-form').find('[name="processPayment"]').click(function(event) {
			// here we comment out to avoid hiding button $(this).hide();
			return true;
		});
		
	};
	
	$( document ).ready(function() {
		
		// Make JS required section visible
		$('.barclaycardcw-javascript-required').show();
		
		attachEventHandlers();
	});
	
}(jQuery));