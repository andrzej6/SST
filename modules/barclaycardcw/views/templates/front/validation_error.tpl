
{capture name=path}{lcw s='Payment' mod='barclaycardcw'}{/capture}

<h2>{lcw s='Validation Failed' mod='barclaycardcw'}</h2>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}
	
<h3>{$paymentMethodName}</h3>

<p class="validation-error error">
	{$error_message}
</p>

<p class="cart_navigation">
	<a href="{$link->getPageLink('order', true, NULL, "step=3")}" class="button_large">{lcw s='Other payment methods' mod='barclaycardcw'}</a>
</p>
	
