{if $createTransaction}
	{if $sendFromDataBack}
		<div class="barclaycardcw-payment-form barclaycardcw-create-transaction" data-ajax-url="{$ajaxUrl}" data-send-form-back="true" id="barclaycardcw-{$paymentMachineName}-payment-form">
	{else}
		<div class="barclaycardcw-payment-form barclaycardcw-create-transaction" data-ajax-url="{$ajaxUrl}" data-send-form-back="false" id="barclaycardcw-{$paymentMachineName}-payment-form">
	{/if}
{else}
	<div class="barclaycardcw-payment-form" id="barclaycardcw-{$paymentMachineName}-payment-form">
{/if}
	<p class="payment-method-name" style="background: url({$paymentLogo}) 0px 0px no-repeat;">{$paymentMethodName}</p>
	<p class="payment-method-description">{$paymentMethodDescription}</p>

	{if isset($aliasForm)}
		{$aliasForm}
	{/if}
	
	{if isset($ajaxScriptUrl)}
		<script src="{$ajaxScriptUrl}"></script>
	{/if}

	{if isset($ajaxSubmitCallback)}
		<script type="text/javascript">
			var barclaycardcw_ajax_submit_callback_{$paymentMachineName} = {$ajaxSubmitCallback};
		</script>
	{/if}
	
	{if isset($ajaxScriptUrl)}
		<form class="barclaycardcw-ajax-authorization-form form-horizontal" data-method-name="{$paymentMachineName}">
	{elseif isset($formActionUrl)}
		<form action="{$formActionUrl}" method="POST" class="form-horizontal" data-method-name="{$paymentMachineName}">
	{elseif isset($ajaxPendingOrderSubmit) && $ajaxPendingOrderSubmit}
		<form action="#" class="form-horizontal" data-method-name="{$paymentMachineName}">
	{/if}
		

	{if isset($visibleFormFields)}
		<fieldset>
			{$visibleFormFields}
			<p><em>*</em> {lcw s='Required Fields' mod='barclaycardcw'}</p>
		</fieldset>
	{/if}

	{if isset($hiddenFields)}
		{$hiddenFields}
	{/if}
	
	{if isset($additionalOutput)}
		{$additionalOutput}
	{/if}
	
	{if isset($ajaxScriptUrl)}
		</form>
	{/if}
	
	{if isset($buttons)}
		{$buttons}
	{/if}

	{if isset($formActionUrl) || (isset($ajaxPendingOrderSubmit) && $ajaxPendingOrderSubmit)}
		</form>
	{/if}
</div>
{if isset($jsFileUrl)}
	<script type="text/javascript" src="{$jsFileUrl}"></script>
{/if}