
<h2>{lcw s='Refund Transaction' mod='barclaycardcw'}</h2>

<p>{lcw s='You are along the way to refund the order %s.' mod='barclaycardcw' sprintf=$orderId} 
{lcw s='Do you want to send this order also the?' mod='barclaycardcw'}</p>

<p>{lcw s='Amount to refund:' mod='barclaycardcw'} {$refundAmount} {$transaction->getCurrencyCode()}</p>

{if !$transaction->isRefundClosable()}
	<p><strong>{lcw s='This is the last refund possible on this transaction. This payment method does not support any further refunds.' mod='barclaycardcw'}</strong></p>
{/if}

<form action="{$targetUrl}" method="POST">
<p>
	{$hiddenFields}	
	<a class="button" href="{$backUrl}">{lcw s='Cancel' mod='barclaycardcw'}</a>
	<input type="submit" class="button" name="submitBarclaycardCwRefundNormal" value="{lcw s='No' mod='barclaycardcw'}" />
	<input type="submit" class="button" name="submitBarclaycardCwRefundAuto" value="{lcw s='Yes' mod='barclaycardcw'}" />
</p>
</form>