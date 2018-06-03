{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License 
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
{if count($categoryProducts) > 0 && $categoryProducts !== false}
    <div id="productscategory" class="page-product-box blockproductscategory">

        <div class="row">
            <div class="column col-12-12 title-1">
                <span class="colored-text"> {l s='Similar products' mod='productscategory'}</span>
            </div>
        </div>

        <div id="productscategory_list" class="row">
            <div class="block_content column col-12-12">

                <div id="blockproductscategory-carousel" class="grid carousel-grid owl-carousel">
                    {foreach from=$categoryProducts item='categoryProduct' name=categoryProduct}
                        <div class="product-box item">
                            <div class="item-wrapper">
                                <div class="item-upper-container">
                                    <div class="item-image-container white-border-3px">
                                        <a class="img-wrapper" href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category, $categoryProduct.ean13)}" title="{$categoryProduct.name|htmlspecialchars}">
                                            <img src="{$link->getImageLink($categoryProduct.link_rewrite, $categoryProduct.id_image, 'atmn_normal')|escape:'html':'UTF-8'}" alt="{$categoryProduct.name|htmlspecialchars}" />
                                        </a>
                                    </div>
                                </div>

                                <div class="item-details">
                                    <a class="item-name-link" href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category, $categoryProduct.ean13)|escape:'html':'UTF-8'}" title="{$categoryProduct.name|htmlspecialchars}">
                                        <span class="item-name">{$categoryProduct.name|truncate:45:'...'|escape:'html':'UTF-8'}</span>
                                    </a>

                                    {if $ProdDisplayPrice AND $categoryProduct.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
                                        <span class="item-price">
                                            <span class="price">{convertPrice price=$categoryProduct.displayed_price}</span>

                                            {if isset($categoryProduct.specific_prices) && $categoryProduct.specific_prices}
                                                <span class="old-price">{displayWtPrice p=$categoryProduct.price_without_reduction}</span>
                                            {/if}
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