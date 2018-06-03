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
<div class="panel">
	<div class="panel-heading">
		<img src="{$this_path|escape:'html':'UTF-8'}logo.gif" alt="" />{l s='WorldPay Capture' mod='worldpay'}
	</div>
	<div class="form-horizontal">
		<form method="post" action="{$smarty.server.REQUEST_URI|escape:htmlall}">
			<input type="hidden" name="id_order" value="{$params.id_order|intval}" />
			<div class="form-group">
				<label class="control-label col-lg-2">{l s='Information:' mod='worldpay'}</label>
				<div class="col-lg-2">
					<p class="form-control-static">{l s='Funds ready to be captured before shipping' mod='worldpay'}</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-2 col-lg-offset-2">
					<button class="btn btn-default" name="submitWorldPayCapture" type="submit">{l s='Get the money' mod='worldpay'}</button>
				</div>
			</div>
		</form>
	</div>
</div>
{/if}
{if $can_refund}
<div class="panel">
	<div class="panel-heading">
		<img src="{$this_path|escape:'html':'UTF-8'}logo.gif" alt="" />{l s='WorldPay Refund' mod='worldpay'}
	</div>
	<div class="form-horizontal">
		<form method="post" action="{$smarty.server.REQUEST_URI|escape:htmlall}">
			<input type="hidden" name="id_order" value="{$params.id_order|intval}" />
			<div class="form-group">
				<label class="control-label col-lg-2">{l s='Transaction amount:' mod='worldpay'}</label>
				<div class="col-lg-2">
					<p class="form-control-static">{displayPrice price=$transaction_amount currency=$transaction_currency}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">{l s='Transaction date:' mod='worldpay'}</label>
				<div class="col-lg-2">
					<p class="form-control-static">{dateFormat date=$transaction_time full=true}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">{l s='Change order status' mod='worldpay'}:</label>
				<div class="col-lg-2">
					<select id="order_state" name="order_state">
						<option value="0">--</option>
						{foreach from=$order_states item='state'}
							<option value="{$state.id_order_state}" {if $current_state == $state.id_order_state}selected="selected"{/if}>{$state.name}</option>
						{/foreach}
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">{l s='Refund amount' mod='worldpay'}:</label>
				{if $currencyFormat eq 1}
				<span id="spm_currency_sign_pre_0" style="font-weight: bold; color: #000000; font-size: 12px; margin-left: 0.7em">{$currencySign|escape:'html':'UTF-8'}</span>
				{/if}
				<div class="col-lg-2">
					<input type="text" name="amount" value="{$current_amount|escape:'html'}" />
				</div>
				{if $currencyFormat eq 2}
				<span id="spm_currency_sign_post_0"	style="font-weight: bold; color: #000000; font-size: 12px">{$currencySign|escape:'html':'UTF-8'}</span>
				{/if}
			</div>
			<div class="form-group">
				<div class="col-lg-2 col-lg-offset-2">
					<button class="btn btn-default" name="submitWorldPayRefund" type="submit" onclick="if (!confirm('{l s='Are you sure?' mod='worldpay'}'))return false;">{l s='Refund' mod='worldpay'}</button>
				</div>
			</div>
		</form>
	</div>
</div>
{/if}