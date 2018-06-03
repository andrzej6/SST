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
{if isset($orderProducts) && count($orderProducts)}
    <div id="crossselling" class="page-product-box">

        <div class="row">
            <div class="column col-12-12 title-1">
                <span class="colored-text">
                    {if $page_name == 'product'}
                        {l s='Customers who bought this product also bought' mod='crossselling'}
                    {else}
                        {l s='We recommend' mod='crossselling'}
                    {/if}
                </span>
            </div>
        </div>

    	<div id="crossselling_list" class="row">
            <div class="block_content column col-12-12">

                <div id="crossselling-carousel" class="grid carousel-grid owl-carousel">
                    {foreach from=$orderProducts item='orderProduct' name=orderProduct}
                        <div class="product-box item">
                            <div class="item-wrapper">
                                <div class="item-upper-container">
                                    <div class="item-image-container white-border-3px">
                                        <a class="img-wrapper" href="{$orderProduct.link|escape:'html':'UTF-8'}" title="{$orderProduct.name|htmlspecialchars}">
                                            <img src="{$link->getImageLink($orderProduct.link_rewrite, $orderProduct.id_image, 'atmn_normal')|escape:'html':'UTF-8'}" alt="{$orderProduct.name|htmlspecialchars}" />
                                        </a>
                                    </div>
                                </div>

                                <div class="item-details">
                                    <a class="item-name-link" href="{$orderProduct.link|escape:'html':'UTF-8'}" title="{$orderProduct.name|htmlspecialchars}">
                                        <span class="item-name">{$orderProduct.name|truncate:45:'...'|escape:'html':'UTF-8'}</span>
                                    </a>

                                    {if $crossDisplayPrice AND $orderProduct.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
                                        <span class="item-price">
                                            <span class="price">{convertPrice price=$orderProduct.displayed_price}</span>
                                        </span>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>

            </div>
        </div>

    </div>
{/if}
