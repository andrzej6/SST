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

{capture name=path}{l s='Manufacturers'}{/capture}

<h1 class="page-header">{l s='Brands'}</h1>

{strip}
    <div class="nbr_manufacturer">
        {if $nbManufacturers == 0}{l s='There are no manufacturers.'}
        {else}
            {if $nbManufacturers == 1}
                {l s='There is 1 brand'}
            {else}
                {l s='There are %d brands' sprintf=$nbManufacturers}
            {/if}
        {/if}
    </div>
{/strip}

{if isset($errors) AND $errors}

    {include file="$tpl_dir./errors.tpl"}

{else}

    {if $nbManufacturers > 0}
        <ul id="manufacturers_list" class="grid grid-{if ($WPAC_categoryViewType == "grid")}{$WPAC_gridColumnSize}{elseif ($WPAC_categoryViewType == "list")}1 list{/if}">
            {foreach from=$manufacturers item=manufacturer name=manufacturers}
                <li class="item t-align-center white-border-3px">
                    <div class="left_side">
                        <!-- logo -->
                        <div class="logo">
                            {if $manufacturer.nb_products > 0}<a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'htmlall':'UTF-8'}" title="{$manufacturer.name|escape:'htmlall':'UTF-8'}" class="lnk_img">{/if}
                                <img src="{$img_manu_dir}{$manufacturer.image|escape:'htmlall':'UTF-8'}-atmn_medium.jpg" />
                                {if $manufacturer.nb_products > 0}</a>{/if}
                        </div>
                        <!-- name -->
                        <h3>
                            {if $manufacturer.nb_products > 0}<a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'htmlall':'UTF-8'}">{/if}
                                {$manufacturer.name|truncate:60:'...'|escape:'htmlall':'UTF-8'}
                                {if $manufacturer.nb_products > 0}</a>{/if}
                        </h3>

                        <p class="description rte">
                            {if $manufacturer.nb_products > 0}
                            <a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'htmlall':'UTF-8'}">
                                {/if}
                                <span>{if $manufacturer.nb_products == 1}{l s='%d product' sprintf=$manufacturer.nb_products|intval}{else}{l s='%d products' sprintf=$manufacturer.nb_products|intval}{/if}</span>

                                {if $manufacturer.nb_products > 0}
                            </a>
                            {/if}
                        </p>
                    </div>

                    <div class="right_side">
                        {if $manufacturer.nb_products > 0}
                            <a class="button-2 fill inline" href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'htmlall':'UTF-8'}">{l s='View products'}</a>
                        {else}
                            <a class="button-2 fill inline disabled" >{l s='View products'}</a>
                        {/if}
                    </div>
                </li>
            {/foreach}
        </ul>

        <div class="content_sortPagiBar bottom row">
            <div class="bottom-pagination-content column col-12-12">
                {include file="./pagination.tpl" paginationId='bottom'}
            </div>
        </div>
    {/if}

{/if}