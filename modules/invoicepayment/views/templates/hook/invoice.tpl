{if isset($shipping_date)}
<p>{l s='To be paid due' mod='invoicepayment'}: {$shipping_date}</p>
{/if}
{if isset($payment_info)}
<h3>{l s='Payment info' mod='invoicepayment'}</h3>
<p>{$payment_info|nl2br}</p>
{/if}