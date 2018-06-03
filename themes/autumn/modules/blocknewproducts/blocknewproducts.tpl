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
<!-- MODULE Block new products -->
<div id="new-products_block_right" class="block products_block">

	<h4 class="title_block">
    	<a href="{$link->getPageLink('new-products')|escape:'html'}" title="{l s='New products' mod='blocknewproducts'}">{l s='New products' mod='blocknewproducts'}</a>
    </h4>

    <div class="block_content products-block">
        {if $new_products !== false}
            <ul class="products grid grid-2">
                {foreach from=$new_products item=newproduct name=myLoop}
                    <li class="item t-align-center">

                        <a class="products-block-image img-wrapper" href="{$newproduct.link|escape:'html'}" title="{$newproduct.legend|escape:html:'UTF-8'}">
                            <img class="replace-2x white-border-3px" src="{$link->getImageLink($newproduct.link_rewrite, $newproduct.id_image, 'atmn_small')|escape:'html'}" alt="{$newproduct.name|escape:html:'UTF-8'}" />
                        </a>

                        <div class="product-content">
                        	<h5>
                            	<a class="product-name" href="{$newproduct.link|escape:'html'}" title="{$newproduct.name|escape:html:'UTF-8'}">{$newproduct.name|strip_tags|escape:html:'UTF-8'}</a>
                            </h5>

                            {if (!$PS_CATALOG_MODE AND ((isset($newproduct.show_price) && $newproduct.show_price) || (isset($newproduct.available_for_order) && $newproduct.available_for_order)))}
                            	{if isset($newproduct.show_price) && $newproduct.show_price && !isset($restricted_country_mode)}
                                    <div class="price-box">
                                        <span class="price">
                                        	{if !$priceDisplay}{convertPrice price=$newproduct.price}{else}{convertPrice price=$newproduct.price_tax_exc}{/if}
                                        </span>
                                    </div>
                                {/if}
                            {/if}
                        </div>

                    </li>
                {/foreach}
            </ul>
            <div>
                <a href="{$link->getPageLink('new-products')|escape:'html'}" title="{l s='All new products' mod='blocknewproducts'}" class="button-2 fill"><span>{l s='All new products' mod='blocknewproducts'}</span></a>
            </div>
        {else}
        	<p>{l s='Do not allow new products at this time.' mod='blocknewproducts'}</p>
        {/if}
    </div>
</div>
<!-- /MODULE Block new products -->