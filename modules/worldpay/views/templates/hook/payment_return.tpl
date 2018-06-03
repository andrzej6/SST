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

{if $status == $_PAYMENT_STATE_SUCCEED_}
	<p>{l s='Your order on %s is complete.' sprintf="$shop_name" mod='worldpay'}
		<br /><br />- {l s='Payment amount.' mod='worldpay'} <span class="price"><strong>{$total_to_pay|escape:'html'}</strong></span>
		<br /><br />- {l s='Your order reference is %s.' sprintf=$reference mod='worldpay'}
		<br /><br />{l s='An email has been sent to you with this information.' mod='worldpay'}
		<br /><br /><strong>{l s='Your order will be shipped as soon as possible.' mod='worldpay'}</strong>
		<br /><br />{l s='For any questions or for further information, please contact our' mod='worldpay'} <a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='customer service department.' mod='worldpay'}</a>.
	</p>
{elseif $status == $_PAYMENT_STATE_PENDING_}
	<p>{l s='Your order on %s is complete.' sprintf="<span class=\"bold\">$shop_name</span>" mod='worldpay'}
		<br /><br />- {l s='Payment amount.' mod='worldpay'} <span class="price"><strong>{$total_to_pay|escape:'html'}</strong></span>
		<br /><br />- {l s='Your order reference is %s.' sprintf=$reference mod='worldpay'}
		<br /><br />{l s='An email has been sent to you with this information.' mod='worldpay'}
		<br /><br /><strong>{l s='Your order will be sent as soon as we confirm your payment.' mod='worldpay'}</strong>
		<br /><br />{l s='For any questions or for further information, please contact our' mod='worldpay'} <a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='customer service department.' mod='worldpay'}</a>.
	</p>
{elseif $status == $_PAYMENT_STATE_CANCELED_}
	<p class="warning">
		{l s='Your order on %s was canceled.' sprintf="<span class=\"bold\">$shop_name</span>" mod='worldpay'}
		<br /><br />{l s='For any questions or for further information, please contact our' mod='worldpay'} <a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='customer service department.' mod='worldpay'}</a>.
	</p>
	<p class="cart_navigation">
		<a href="{$link->getPageLink('index', true, NULL)|escape:'html':'UTF-8'}" class="exclusive_large">{l s='Continue shopping' mod='worldpay'}</a>
		{if !$id_order}
		<a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}" class="button_large">{l s='Other payment methods' mod='worldpay'}</a>
		{else}
			{if isset($opc) && $opc}
				<a class="button_large" href="{$link->getPageLink('order-opc', true, NULL, "submitReorder&id_order={$id_order}")|escape:'html':'UTF-8'}" title="{l s='Reorder' mod='worldpay'}">{l s='Reorder' mod='worldpay'}</a>
			{else}
				<a class="button_large" href="{$link->getPageLink('order', true, NULL, "submitReorder&id_order={$id_order}")|escape:'html':'UTF-8'}" title="{l s='Reorder' mod='worldpay'}">{l s='Reorder' mod='worldpay'}</a>
			{/if}
		{/if}
	</p>
{elseif $status == $_PAYMENT_STATE_FAILED_}
	<p class="error">
		{l s='We noticed a problem with your order. If you think this is an error, you can contact our' mod='worldpay'}
		<a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='customer service department.' mod='worldpay'}</a>.
	</p>
	<p class="cart_navigation">
		<a href="{$link->getPageLink('index', true, NULL)|escape:'html':'UTF-8'}" class="exclusive_large">{l s='Continue shopping' mod='worldpay'}</a>
		{if !$id_order}
		<a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}" class="button_large">{l s='Other payment methods' mod='worldpay'}</a>
		{else}
			{if isset($opc) && $opc}
				<a class="button_large" href="{$link->getPageLink('order-opc', true, NULL, "submitReorder&id_order={$id_order}")|escape:'html':'UTF-8'}" title="{l s='Reorder' mod='worldpay'}">{l s='Reorder' mod='worldpay'}</a>
			{else}
				<a class="button_large" href="{$link->getPageLink('order', true, NULL, "submitReorder&id_order={$id_order}")|escape:'html':'UTF-8'}" title="{l s='Reorder' mod='worldpay'}">{l s='Reorder' mod='worldpay'}</a>
			{/if}
		{/if}
	</p>
{/if}
