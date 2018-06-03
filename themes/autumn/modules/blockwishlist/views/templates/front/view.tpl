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
<div id="view_wishlist">
    {capture name=path}
        <a href="{$link->getPageLink('my-account', true)|escape:'html'}">{l s='My account' mod='blockwishlist'}</a>
        <span class="navigation-pipe">{$navigationPipe}</span>
        <a href="{$link->getModuleLink('blockwishlist', 'mywishlist')|escape:'html'}">{l s='My wishlists' mod='blockwishlist'}</a>
        <span class="navigation-pipe">{$navigationPipe}</span>
        {$current_wishlist.name}
    {/capture}

    <h1 class="page-header">
        {l s='Wishlist' mod='blockwishlist'}
    </h1>

    {if $wishlists}
        <h3 class="extra-info">
            <strong>
                {l s='Other wishlists of %1s %2s:' sprintf=[$current_wishlist.firstname, $current_wishlist.lastname] mod='blockwishlist'}
            </strong>
            {foreach from=$wishlists item=wishlist name=i}
                {if $wishlist.id_wishlist != $current_wishlist.id_wishlist}
                    <a href="{$link->getModuleLink('blockwishlist', 'view', ['token' => $wishlist.token])|escape:'html':'UTF-8'}" rel="nofollow" title="{$wishlist.name}">
                        {$wishlist.name}
                    </a>
                    {if !$smarty.foreach.i.last}
                        /
                    {/if}
                {/if}
            {/foreach}
        </h3>
    {/if}

    <div class="wlp_bought">
        <ul class="wlp_bought_list grid grid-4">
            {foreach from=$products item=product name=i}
                <li id="wlp_{$product.id_product}_{$product.id_product_attribute}" class="ajax_block_product item box">
                    <div class="product_image">
                        <a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='blockwishlist'}">
                            <img class="replace-2x" src="{$link->getImageLink($product.link_rewrite, $product.cover, 'atmn_normal')|escape:'html':'UTF-8'}" alt="{$product.name|escape:'html':'UTF-8'}"/>
                        </a>
                    </div>
                    <div class="product_infos">
                        <div id="s_title" class="product-name">
                            {$product.name|truncate:30:'...'|escape:'html':'UTF-8'}
                            {if isset($product.attributes_small)}
                                <a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='blockwishlist'}">
                                    <small>{$product.attributes_small|escape:'html':'UTF-8'}</small>
                                </a>
                            {/if}
                        </div>
                        <div class="wishlist_product_detail">
                            <div class="quantity">
                                <label for="quantity_{$product.id_product}_{$product.id_product_attribute}">
                                    {l s='Quantity' mod='blockwishlist'}:
                                </label>
                                <input class="form-control grey" type="text" id="quantity_{$product.id_product}_{$product.id_product_attribute}" value="{$product.quantity|intval}" size="3"/>
                            </div>

                            <div class="priority selector1">
                                <span><strong>{l s='Priority' mod='blockwishlist'}:</strong> {$product.priority_name}</span>
                            </div>

                            <div class="btn_action">
                                {if isset($product.attribute_quantity) AND $product.attribute_quantity >= 1 OR !isset($product.attribute_quantity) AND $product.product_quantity >= 1}
                                    {if !$ajax}
                                        <form id="addtocart_{$product.id_product|intval}_{$product.id_product_attribute|intval}" action="{$link->getPageLink('cart')|escape:'html':'UTF-8'}" method="post">
                                            <p class="hide">
                                                <input type="hidden" name="id_product" value="{$product.id_product|intval}" id="product_page_product_id"/>
                                                <input type="hidden" name="add" value="1"/>
                                                <input type="hidden" name="token" value="{$token}"/>
                                                <input type="hidden" name="id_product_attribute" id="idCombination" value="{$product.id_product_attribute|intval}"/>
                                            </p>
                                        </form>
                                    {/if}
                                    <a href="javascript:void(0);" class="ajax_add_to_cart_button button-1 fill" onclick="WishlistBuyProduct('{$token|escape:'html':'UTF-8'}', '{$product.id_product}', '{$product.id_product_attribute}', '{$product.id_product}_{$product.id_product_attribute}', this, {$ajax});" title="{l s='Add to cart' mod='blockwishlist'}" rel="nofollow">
                                        <span class="wpicon wpicon-cart medium"></span>{l s='Add to cart' mod='blockwishlist'}
                                    </a>
                                {else}
                                    {*<a class="ajax_add_to_cart_button button-1 fill disabled">
                                        <span class="wpicon wpicon-cart medium"></span>{l s='Add to cart' mod='blockwishlist'}
                                    </a>*}
                                {/if}

                                <a class="lnk_view button-2 fill" href="{$link->getProductLink($product.id_product,  $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='View' mod='blockwishlist'}" rel="nofollow">
                                    {l s='View' mod='blockwishlist'}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}
        </ul>
    </div>
</div>