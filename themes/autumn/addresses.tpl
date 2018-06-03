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
{capture name=path}
    <a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">{l s='My account'}</a><span class="navigation-pipe">{$navigationPipe}</span><span class="navigation_page">{l s='My addresses'}</span>
{/capture}

<h1 class="page-header">{l s='My addresses'}</h1>

<h3 class="extra-info">{l s='Please configure your default billing and delivery addresses when placing an order. You may also add additional addresses, which can be useful for sending gifts or receiving an order at your office.'}</h3>

{if isset($multipleAddresses) && $multipleAddresses}

    <div class="addresses box">
        <h3 class="section-header">{l s='Your addresses'}</h3>
        <p class="p-indent">{l s='Be sure to update your personal information if it has changed.'}</p>

        {assign var="adrs_style" value=$addresses_style}

        <div class="bloc_adresses grid grid-3">
            {foreach from=$multipleAddresses item=address name=myLoop}
                <div class="item address">
                    <h3 class="section-header">{$address.object.alias}</h3>
                    <ul class="list-icon-arrow">
                        {foreach from=$address.ordered name=adr_loop item=pattern}
                            {assign var=addressKey value=" "|explode:$pattern}
                            <li>
                            {foreach from=$addressKey item=key name="word_loop"}
                                <span {if isset($addresses_style[$key])} class="{$addresses_style[$key]}"{/if}>
                                    {$address.formated[$key|replace:',':'']|escape:'html':'UTF-8'}
                                </span>
                            {/foreach}
                            </li>
                        {/foreach}
                    </ul>
                    <div class="t-align-center">
                        <a class="button-2 fill inline address_update" href="{$link->getPageLink('address', true, null, "id_address={$address.object.id|intval}")|escape:'html':'UTF-8'}" title="{l s='Update'}">{l s='Update'}</a>
                        <a class="button-2 fill inline address_delete" href="{$link->getPageLink('address', true, null, "id_address={$address.object.id|intval}&delete")|escape:'html':'UTF-8'}" onclick="return confirm('{l s='Are you sure?' js=1}');" title="{l s='Delete'}">{l s='Delete'}</a>
                    </div>
                </div>
            {/foreach}
            <div class="t-align-center">
                <a href="{$link->getPageLink('address', true)|escape:'html':'UTF-8'}" title="{l s='Add an address'}" class="button-1 fill inline"><span class="wpicon wpicon-plus small"></span>{l s='Add a new address'}</a>
            </div>
        </div>
    </div>

{else}

    <div class="alert alert-warning">{l s='No addresses are available.'}</div>

    <div class="box t-align-center">
        <a class="button-1 fill inline" href="{$link->getPageLink('address', true)|escape:'html':'UTF-8'}"><span class="wpicon wpicon-plus small"></span>{l s='Add a new address'}</a>
    </div>

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