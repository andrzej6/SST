{capture name=path}{l s='Invoice payment.' mod='invoicepayment'}{/capture}
<h1 class="page-heading">{l s='Order summary' mod='invoicepayment'}</h1>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

<form action="{$path_validation}" method="post">
<div class="box cheque-box">
<h3 class="page-subheading">{l s='Invoice payment' mod='invoicepayment'}</h3>
	<input type="hidden" name="confirm" value="1" />
	<p class="cheque-indent"><strong class="dark">{l s='You have chosen to pay by INVOICE.' mod='invoicepayment'}</strong></p>
	<p>- {l s='The total amount of your order is' mod='invoicepayment'} <b id="amount_{$currencies.0.id_currency}" class="price">{convertPrice price=$total}</b> {l s='(inc VAT)' mod='invoicepayment'}</p>
	<p>- {l s='Please confirm your order by clicking \'Confirm Order\'' mod='invoicepayment'}.</p>
</div>
    <p class="cart_navigation clearfix" id="cart_navigation">
        <a class="button-exclusive btn btn-default sit-stand-pb" href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}">		<i class="icon-chevron-left"></i>{l s='Other payment methods' mod='invoicepayment'}</a>
        <button class="button btn btn-default button-medium sit-stand-pb"  type="submit">		<span>{l s='Confirm Order' mod='invoicepayment'}<i class="icon-chevron-right right"></i></span>		</button>
    </p>
</form>
