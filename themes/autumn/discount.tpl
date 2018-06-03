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
{capture name=path}<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">{l s='My account'}</a><span class="navigation-pipe">{$navigationPipe}</span><span class="navigation_page">{l s='My vouchers'}</span>{/capture}

<h1 class="page-header">
	{l s='My vouchers'}
</h1>

{if isset($cart_rules) && count($cart_rules) && $nb_cart_rules}
	<table class="discount table table-bordered wpresponsive">
		<thead>
			<tr>
				<th data-sort-ignore="true" class="discount_code first_item">{l s='Code'}</th>
				<th data-sort-ignore="true" class="discount_description item">{l s='Description'}</th>
				<th class="discount_quantity item">{l s='Quantity'}</th>
				<th data-sort-ignore="true" data-hide="phone,tablet" class="discount_value item">{l s='Value'}*</th>
				<th data-hide="phone,tablet" class="discount_minimum item">{l s='Minimum'}</th>
				
				<th data-hide="phone" class="discount_expiration_date last_item">{l s='Expiration date'}</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$cart_rules item=discountDetail name=myLoop}
			 {* below if condition to display only Save £25 OFF your First Order voucher /not paper old vouchers *}
			  {if $discountDetail.name == 'Save £25 OFF your First Order'}
				<tr class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if} {if $smarty.foreach.myLoop.index % 2}alternate_item{/if}">
					<td class="discount_code">{$discountDetail.code}</td>
					<td class="discount_description">{$discountDetail.name}</td>
					<td data-value="{$discountDetail.quantity_for_user}" class="discount_quantity">{$discountDetail.quantity_for_user}</td>
					<td class="discount_value price">
						{if $discountDetail.id_discount_type == 1}
							{$discountDetail.value|escape:'html':'UTF-8'}%
						{elseif $discountDetail.id_discount_type == 2}
							{convertPrice price=$discountDetail.value} ({if $discountDetail.reduction_tax == 1}{l s='Tax included'}{else}{l s='Tax excluded'}{/if})
						{elseif $discountDetail.id_discount_type == 3}
							{l s='Free shipping'}
						{else}
							-
						{/if}
					</td>
					<td class="discount_minimum" data-value="{if $discountDetail.minimal == 0}0{else}{$discountDetail.minimal}{/if}">
						{if $discountDetail.minimal == 0}
							{l s='None'}
						{else}
							{convertPrice price=$discountDetail.minimal}
						{/if}
					</td>
					
					
					
					<td class="discount_expiration_date" data-value="{$discountDetail.date_to|regex_replace:"/[\-\:\ ]/":""}">
						{dateFormat date=$discountDetail.date_to}
					</td>
				</tr>
				
				{/if}
				
			{/foreach}
		</tbody>
	</table>
{else}
	<p class="alert alert-warning">{l s='You do not have any vouchers.'}</p>
{/if}

<ul class="footer_links">
    <li class="back-to-myaccount">
        <a class="button-2 fill inline" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">
            <span class="wpicon wpicon-user"></span>{l s='Back to Your Account'}
        </a>
    </li>
    <li class="back-to-home">
        <a class="button-2 fill inline" href="{$base_dir}">
            <span class="wpicon wpicon-home2"></span>{l s='Back to Home'}
        </a>
    </li>
</ul>
