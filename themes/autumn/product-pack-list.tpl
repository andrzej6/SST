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
{if isset($products) && $products}

	<!-- Pack list -->
	<ul{if isset($id) && $id} id="{$id}"{/if} class="product_list {if isset($class) && $class} {$class}{/if}{if isset($active) && $active == 1} active{/if} grid grid-5">
        {foreach from=$products item=product name=products}

            <li class="ajax_block_product item">
                <div class="item-wrapper">

                    <div class="item-upper-container">

                        <div class="item-image-container white-border-3px">
                            {if isset($quick_view) && $quick_view}
                                <div class="item-quickview">
                                    <a class="quick-view" href="{$product.link|escape:'html':'UTF-8'}" rel="{$product.link|escape:'html':'UTF-8'}" title="{l s='Quick view'}">
                                        <span class="wpicon wpicon-search medium"></span>
                                    </a>
                                </div>
                            {/if}

                            {if ( (isset($product.new) && $product.new == 1) || (isset($product.on_sale) && $product.on_sale) || (isset($product.reduction) && $product.reduction) || (isset($product.online_only) && $product.online_only) )}
                                <div class="item-tag">
                                    {if isset($product.new) && $product.new == 1}
                                        <span class="item-tag-new">{l s='New'}</span>
                                    {/if}

                                    {if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
                                        <span class="item-tag-discount">{l s='On sale!'}</span>
                                    {elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
                                        <span class="item-tag-discount">{l s='Discount!'}</span>
                                    {/if}

                                    {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
                                        {if isset($product.online_only) && $product.online_only}
                                            <span class="item-online-only">{l s='Online only'}</span>
                                        {/if}
                                    {/if}
                                </div>
                            {/if}

                            <div class="item-images item-images-{$product.id_product}" data-pid="{$product.id_product}" data-linkrewrite="{$product.link_rewrite}">
                                <a class="item-name-link" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
                                    <img class="item-image-cover" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'atmn_normal')|escape:'html'}" alt="{if !empty($product.legend)}{$product.legend|escape:'htmlall':'UTF-8'}{else}{$product.name|escape:'htmlall':'UTF-8'}{/if}" title="{if !empty($product.legend)}{$product.legend|escape:'htmlall':'UTF-8'}{else}{$product.name|escape:'htmlall':'UTF-8'}{/if}" />
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="item-details">

                        {if isset($product.pack_quantity) && $product.pack_quantity}{$product.pack_quantity|intval|cat:' x '}{/if}

                        <a class="item-name-link" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
                            <span class="item-name">{$product.name|truncate:45:'...'|escape:'html':'UTF-8'}</span>
                        </a>

                        <div>

                            {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
                                <div class="item-price" >
                                    {if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}

                                        <span class="price product-price">
                                            {if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
                                        </span>

                                        {if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction}
                                            <span class="old-price product-price">
                                                {displayWtPrice p=$product.price_without_reduction}
                                            </span>
                                        {/if}

                                    {/if}
                                </div>
                            {/if}

                        </div>

                    </div>
                </div>

            </li>
        {/foreach}
	</ul>

{/if}