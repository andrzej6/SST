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

<div class="row todisplayinline">
	<div class="col-xs-12 col-md-6">
		<p class="payment_module" style="padding: 15px;border: 1px solid #d6d4d4;;width: 300px;margin: 0 auto;">
			<a class="worldpay" href="javascript:void(0);" onclick="$('#worldpay_payment_form').submit();" title="{$request_title|escape:'html'}">
				{$request_title|escape:'html'}
			</a>
		</p>
		<form id="worldpay_payment_form" action="{$request_url|escape:'html'}" data-ajax="false" title="{$request_title|escape:'html'}" method="post">
			{foreach from=$request_parameters item=parameter name=parameter key=name}
			<input type="hidden" name="{$name|escape:'html'}" value="{$parameter|escape:'html'}" />
			{/foreach}
		</form>
	</div>
</div>
