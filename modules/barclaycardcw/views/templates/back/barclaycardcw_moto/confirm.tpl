<h2>{lcw s='Mail Order / Telephone Order %s' mod='barclaycardcw' sprintf=$paymentMethodName}</h2>

{if isset($error_message) && !empty($error_message)}
	<p class="payment-error error">
		{$error_message}
	</p>
{/if}



{if $isMotoSupported}
	
	<form action="{$form_target_url}" method="post" class="form-horizontal barclaycardcw-payment-form">
	
		{$hidden_fields}
		
		{if isset($visible_fields) && !empty($visible_fields)}
			<p>{lcw s='You are along the way to create a new order.' mod='barclaycardcw'} 
			{lcw s='With the following form you can debit the customer:' mod='barclaycardcw'}</p>
			<fieldset>
				{$visible_fields}
			</fieldset>
		{else}
			<p>{lcw s='You are along the way to create a new order.' mod='barclaycardcw'}</p>
		{/if}

		<p>
			<input type="submit" class="button btn btn-default" name="submitBarclaycardCwDebit" value="{lcw s='Debit the Customer' mod='barclaycardcw'}" />
		</p>
	
	</form>
{else}
	<p>{lcw s='The payment method %s does not support mail order / telephone order.' mod='barclaycardcw' sprintf=$paymentMethodName}</p>
{/if}


<p>
	<form action="{$normalFinishUrl}" method="POST">
		{$normalFinishHiddenFields}	
		<input type="submit" class="button btn btn-default" name="submitBarclaycardCwNormal" value="{lcw s='Continue without debit the customer' mod='barclaycardcw'}" />
	</form>
</p>
