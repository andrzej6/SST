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

<!-- MODULE Block best sellers -->
<div id="best-sellers_block_right" class="block products_block">

	<h4 class="title_block">
    	<a href="{$link->getPageLink('best-sales')|escape:'html'}" title="{l s='View a top sellers products' mod='blockbestsellers'}">{l s='Top sellers' mod='blockbestsellers'}</a>
    </h4>

	<div class="block_content">
	{if $best_sellers && $best_sellers|@count > 0}
		<ul class="block_content products-block grid grid-2">
			{foreach from=$best_sellers item=product name=myLoop}
                <li class="item t-align-center">
                    <a class="products-block-image img-wrapper" href="{$product.link|escape:'html'}" title="{$product.legend|escape:'html':'UTF-8'}">
                        <img class="replace-2x white-border-3px" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'atmn_small')|escape:'html'}" alt="{$product.legend|escape:'html':'UTF-8'}" />
                    </a>
                    <div class="product-content">
                        <h5>
                            <a class="product-name" href="{$product.link|escape:'html'}" title="{$product.legend|escape:'html':'UTF-8'}">
                                {$product.name|strip_tags:'UTF-8'|escape:'html':'UTF-8'}
                            </a>
                        </h5>

                        {if !$PS_CATALOG_MODE}
                            <div class="price-box">
                                <span class="price">{$product.price}</span>
                            </div>
                        {/if}
                    </div>
                </li>
		    {/foreach}
		</ul>

		<div class="lnk">
        	<a href="{$link->getPageLink('best-sales')|escape:'html'}" title="{l s='All best sellers' mod='blockbestsellers'}"  class="button-2 fill"><span>{l s='All best sellers' mod='blockbestsellers'}</span></a>
        </div>

	{else}
		<p>{l s='No best sellers at this time' mod='blockbestsellers'}</p>
	{/if}
	</div>

</div>
<!-- /MODULE Block best sellers -->