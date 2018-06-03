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

<div class="alert alert-info">
	<h2 style="margin-top: 0px;">{l s='The Merchant Interface configuration guide:' mod='worldpay'}</h2>
	<h4>1: {l s='copy this URL %s into "Payment Response URL" field' sprintf="<strong>{$payment_response_url}</strong>" mod='worldpay'}</h4>
	<p style="margin: 0px 0px 8.5px 15px;">{l s='For more information please visit: %s' sprintf="<a href={$worldpay_help_url} target=_blank>{$worldpay_help_url}</a>" mod='worldpay'}</p>
	<h4>2: {l s='check "Payment Response Enabled" checkbox.' mod='worldpay'}</h4>
	<h4>3: {l s='make sure field "Shopper Redirect URL" is empty.' mod='worldpay'}</h4>
	<h4>4: {l s='make sure field "Shopper Redirect Button Enabled" is not checked.' mod='worldpay'}</h4>
	<h4>5: {l s='make sure field "Enable the Shopper Response" is checked.' mod='worldpay'}</h4>
	<h4>6: {l s='copy "Installation ID" value from the Merchant Interface into the module configuration below.' mod='worldpay'}</h4>
</div>
