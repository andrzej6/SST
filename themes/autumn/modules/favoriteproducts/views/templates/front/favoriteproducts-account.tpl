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
	<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">
		{l s='My account' mod='favoriteproducts'}
	</a>
	<span class="navigation-pipe">{$navigationPipe}</span>
	<span class="navigation_page">{l s='My favorite products' mod='favoriteproducts'}</span>
{/capture}

<div id="favoriteproducts_block_account">
	<h1 class="page-header">{l s='My favorite products' mod='favoriteproducts'}</h1>

	{if $favoriteProducts}
    	<ul class="grid grid-2">
			{foreach from=$favoriteProducts item=favoriteProduct}
			<li class="item">
            	<div class="favoriteproduct inner-content box">
                    <a class="img-wrapper t-align-center" href="{$link->getProductLink($favoriteProduct.id_product, null, null, null, null, $favoriteProduct.id_shop)|escape:'html':'UTF-8'}">
                        <img class="item-image" src="{$link->getImageLink($favoriteProduct.link_rewrite, $favoriteProduct.image, 'atmn_small')|escape:'html':'UTF-8'}" alt=""/>
                    </a>
                    <div class="item-details">
                        <a class="item-name-link" href="{$link->getProductLink($favoriteProduct.id_product, null, null, null, null, $favoriteProduct.id_shop)|escape:'html':'UTF-8'}">
                            {$favoriteProduct.name|escape:'html':'UTF-8'}
                        </a>
                        <div class="item-description">
                            {$favoriteProduct.description_short|strip_tags|escape:'html':'UTF-8'}
                        </div>
                    </div>
                    <div class="remove">
                    	<a href="#" onclick="return false" rel="ajax_id_favoriteproduct_{$favoriteProduct.id_product}">
                    		<span class="wpicon wpicon-close small"></span>
                    	</a>
                    </div>
                </div>
			</li>
			{/foreach}
        </ul>
	{else}
		<p class="alert alert-warning">{l s='No favorite products have been determined just yet. ' mod='favoriteproducts'}</p>
	{/if}

    <ul class="footer_links">
        <li class="back-to-myaccount">
            <a class="button-2 fill inline" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">
                <span class="wpicon wpicon-user"></span>{l s='Back to Your Account'}
            </a>
        </li>
    </ul>
</div>