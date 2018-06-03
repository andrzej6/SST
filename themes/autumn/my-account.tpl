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

{capture name=path}{l s='My account'}{/capture}

<h1 class="page-header">{l s='My account'}</h1>

{if isset($account_created)}
	<p class="alert alert-success">
		{l s='Your account has been created.'}
	</p>
{/if}

<h3 class="extra-info">{l s='Welcome to your account. Here you can manage all of your personal information and orders.'}</h3>

<ul class="myaccount-link-list grid grid-4">

    {if $has_customer_an_address}
        <li class="item">
            <a href="{$link->getPageLink('address', true)|escape:'html':'UTF-8'}" title="{l s='Add my first address'}">
                <span class="wpicon wpicon-address-book xlarge"></span>
                <span>{l s='Add my first address'}</span>
            </a>
        </li>
    {/if}

    <li class="item">
        <a href="{$link->getPageLink('history', true)|escape:'html':'UTF-8'}" title="{l s='Orders'}">
            <span class="wpicon wpicon-cart xlarge"></span>
            <span>{l s='Order history and details'}</span>
        </a>
    </li>

    {if $returnAllowed}
        <li class="item">
            <a href="{$link->getPageLink('order-follow', true)|escape:'html':'UTF-8'}" title="{l s='Merchandise returns'}">
                <span class="wpicon wpicon-undo xlarge"></span>
                <span>{l s='My merchandise returns'}</span>
            </a>
        </li>
    {/if}

    <li class="item">
        <a href="{$link->getPageLink('order-slip', true)|escape:'html':'UTF-8'}" title="{l s='Credit slips'}">
            <span class="wpicon wpicon-file xlarge"></span>
            <span>{l s='My credit slips'}</span>
        </a>
    </li>

    <li class="item">
        <a href="{$link->getPageLink('addresses', true)|escape:'html':'UTF-8'}" title="{l s='Addresses'}">
            <span class="wpicon wpicon-address-book xlarge"></span>
            <span>{l s='My addresses'}</span>
        </a>
    </li>

    <li class="item">
        <a href="{$link->getPageLink('identity', true)|escape:'html':'UTF-8'}" title="{l s='Information'}">
            <span class="wpicon wpicon-vcard xlarge"></span>
            <span>{l s='My personal information'}</span>
        </a>
    </li>

    

</ul>

<ul class="footer_links">
    <li class="back-to-home">
        <a class="button-2 fill inline" href="{$base_dir}">
            <span class="wpicon wpicon-home2"></span>{l s='Back to Home'}
        </a>
    </li>
</ul>
