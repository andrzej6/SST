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

{if $can_capture}
<br/>
<fieldset>
	<legend><img src="{$this_path|escape:'html':'UTF-8'}logo.gif" alt="" />{l s='WorldPay Capture' mod='worldpay'}</legend>
	<p><b>{l s='Information:' mod='worldpay'}</b> {l s='Funds ready to be captured before shipping' mod='worldpay'}</p>
	<form method="post" action="{$smarty.server.REQUEST_URI|escape:htmlall}">
		<input type="hidden" name="id_order" value="{$params.id_order|intval}" />
		<p class="center"><input type="submit" class="button" name="submitWorldPayCapture" value="{l s='Get the money' mod='worldpay'}" /></p>
	</form>
</fieldset>
{/if}
{if $can_refund}
<br />
<fieldset>
	<legend><img src="{$this_path|escape:'html':'UTF-8'}logo.gif" alt="" />{l s='WorldPay Refund' mod='worldpay'}</legend>
	<form method="post" action="{$smarty.server.REQUEST_URI|escape:htmlall}">
		<input type="hidden" name="id_order" value="{$params.id_order|intval}" />
		<p><b>{l s='Transaction amount:' mod='worldpay'}</b> {displayPrice price=$transaction_amount currency=$transaction_currency}</p>
		<p><b>{l s='Transaction date:' mod='worldpay'}</b> {dateFormat date=$transaction_time full=true}</p>
		<p>
		<strong>{l s='Change order status' mod='worldpay'}:</strong>
		<select id="order_state" name="order_state">
			<option value="0">--</option>
			{foreach from=$order_states item='state'}
				<option value="{$state.id_order_state|intval}" {if $current_state == $state.id_order_state}selected="selected"{/if}>{$state.name|escape:'html':'UTF-8'}</option>
			{/foreach}
		</select>
		</p>
		<p>
		<strong>{l s='Refund amount' mod='worldpay'}:</strong>
		{if $currencyFormat eq 1}
		<span id="spm_currency_sign_pre_0" style="font-weight: bold; color: #000000; font-size: 12px; margin-left: 0.7em">{$currencySign|escape:'html':'UTF-8'}</span>
		{/if}
		<input type="text" name="amount" value="{$current_amount|escape:'html'}" />
		{if $currencyFormat eq 2}
		<span id="spm_currency_sign_post_0"	style="font-weight: bold; color: #000000; font-size: 12px">{$currencySign|escape:'html':'UTF-8'}</span>
		{/if}
		</p>
		<p class="center">
			<input type="submit" class="button" name="submitWorldPayRefund" value="{l s='Refund' mod='worldpay'}" onclick="if (!confirm('{l s='Are you sure?' mod='worldpay'}'))return false;" />
		</p>
	</form>
</fieldset>
{/if}