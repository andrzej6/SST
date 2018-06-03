{*
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
*}

{capture name=path}{l s='Guest Tracking'}{/capture}

<h1 class="page-header">{l s='Guest Tracking'}</h1>

{if isset($order_collection)}
	{foreach $order_collection as $order}
		{assign var=order_state value=$order->getCurrentState()}
		{assign var=invoice value=$order->invoice}
		{assign var=order_history value=$order->order_history}
		{assign var=carrier value=$order->carrier}
		{assign var=address_invoice value=$order->address_invoice}
		{assign var=address_delivery value=$order->address_delivery}
		{assign var=inv_adr_fields value=$order->inv_adr_fields}
		{assign var=dlv_adr_fields value=$order->dlv_adr_fields}
		{assign var=invoiceAddressFormatedValues value=$order->invoiceAddressFormatedValues}
		{assign var=deliveryAddressFormatedValues value=$order->deliveryAddressFormatedValues}
		{assign var=currency value=$order->currency}
		{assign var=discounts value=$order->discounts}
		{assign var=invoiceState value=$order->invoiceState}
		{assign var=deliveryState value=$order->deliveryState}
		{assign var=products value=$order->products}
		{assign var=customizedDatas value=$order->customizedDatas}
		{assign var=HOOK_ORDERDETAILDISPLAYED value=$order->hook_orderdetaildisplayed}
		{if isset($order->total_old)}
			{assign var=total_old value=$order->total_old}
		{/if}
		{if isset($order->followup)}
			{assign var=followup value=$order->followup}
		{/if}
		
		<div id="block-history">
			<div id="block-order-detail" class="std">
			{include file="./order-detail.tpl"}
			</div>
		</div>
	{/foreach}

	<h3 id="guestToCustomer" class="section-header secondary">{l s='For more advantages...'}</h3>

	{include file="$tpl_dir./errors.tpl"}
	
	{if isset($transformSuccess)}
		<p class="alert alert-success">{l s='Your guest account has been successfully transformed into a customer account. You can now login as a registered shopper: '} <a href="{$link->getPageLink('authentication', true)|escape:'html':'UTF-8'}">{l s='Login'}</a></p>
	{else}
		<form method="post" action="{$action|escape:'html':'UTF-8'}#guestToCustomer" class="box">
            <div class="form-group">
                {l s='Transform your guest account into a customer account'}
            </div>

            <div class="text form-group">
                <label><strong class="dark">{l s='Set your password:'}</strong></label>
                <input type="password" name="password" class="form-control" />
            </div>

            <input type="hidden" name="id_order" value="{if isset($order->id)}{$order->id}{else}{if isset($smarty.get.id_order)}{$smarty.get.id_order|escape:'html':'UTF-8'}{else}{if isset($smarty.post.id_order)}{$smarty.post.id_order|escape:'html':'UTF-8'}{/if}{/if}{/if}" />
            <input type="hidden" name="order_reference" value="{if isset($smarty.get.order_reference)}{$smarty.get.order_reference|escape:'html':'UTF-8'}{else}{if isset($smarty.post.order_reference)}{$smarty.post.order_reference|escape:'html':'UTF-8'}{/if}{/if}" />
            <input type="hidden" name="email" value="{if isset($smarty.get.email)}{$smarty.get.email|escape:'html':'UTF-8'}{else}{if isset($smarty.post.email)}{$smarty.post.email|escape:'html':'UTF-8'}{/if}{/if}" />

            <div class="form-group submit">
                <button type="submit" name="submitTransformGuestToCustomer" class="button-1 fill">
                    {l s='Send'}
                </button>
            </div>
		</form>
	{/if}
{else}
	{include file="$tpl_dir./errors.tpl"}
	{if isset($show_login_link) && $show_login_link}
		<div>
            <br />
            <a class="button-1 fill" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">
                {l s='Click here to login to your customer account.'}
            </a>
            <br />
        </div>
	{/if}
	<form method="post" action="{$action|escape:'html':'UTF-8'}" class="std" id="guestTracking">
		<fieldset class="description_box box">
			<h3 class="section_header">{l s='To track your order, please enter the following information:'}</h3>
                <div class="text form-group">
                    <label>{l s='Order Reference:'} </label>
                    <input class="form-control" type="text" name="order_reference" value="{if isset($smarty.get.id_order)}{$smarty.get.id_order|escape:'html':'UTF-8'}{else}{if isset($smarty.post.id_order)}{$smarty.post.id_order|escape:'html':'UTF-8'}{/if}{/if}" size="8" />
                    <span class="form_info">{l s='For example: QIIXJXNUI or QIIXJXNUI#1'}</span>
                </div>
                <div class="text form-group">
                    <label>{l s='Email:'}</label>
                    <input class="form-control" type="text" name="email" value="{if isset($smarty.get.email)}{$smarty.get.email|escape:'html':'UTF-8'}{else}{if isset($smarty.post.email)}{$smarty.post.email|escape:'html':'UTF-8'}{/if}{/if}" />
                </div>
                <div class="form-group submit">
                    <button type="submit" name="submitGuestTracking" class="button-1 fill">
                        {l s='Send'}
                    </button>
                </div>
		</fieldset>
	</form>
{/if}