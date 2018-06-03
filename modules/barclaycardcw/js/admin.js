
jQuery(document).ready(function() {
	
	jQuery('.barclaycardcw-transaction-table .barclaycardcw-more-details-button').each(function() {
		jQuery(this).click(function() {
			
			// hide all open 
			jQuery('.barclaycardcw-transaction-table').find('.active').removeClass('active');
			
			// Get transaction ID
			var mainRow = jQuery(this).parents('.barclaycardcw-main-row');
			var transactionId = mainRow.attr('id').replace('barclaycardcw-_main_row_', '');
			
			var selector = '.barclaycardcw-transaction-table #barclaycardcw_details_row_' + transactionId;
			jQuery(selector).addClass('active');
			jQuery(mainRow).addClass('active');
		})
	});
	
	jQuery('.barclaycardcw-transaction-table .barclaycardcw-less-details-button').each(function() {
		jQuery(this).click(function() {
			// hide all open 
			jQuery('.barclaycardcw-transaction-table').find('.active').removeClass('active');
		})
	});
	
	jQuery('.barclaycardcw-transaction-table .transaction-information-table .description').each(function() {
		jQuery(this).mouseenter(function() {
			jQuery(this).toggleClass('hidden');
		});
		jQuery(this).mouseleave(function() {
			jQuery(this).toggleClass('hidden');
		})
	});
	
});