{** 2007-2014 PrestaShop** NOTICE OF LICENSE** This source file is subject to the Academic Free License (AFL 3.0)* that is bundled with this package in the file LICENSE.txt.* It is also available through the world-wide-web at this URL:* http://opensource.org/licenses/afl-3.0.php* If you did not receive a copy of the license and are unable to* obtain it through the world-wide-web, please send an email* to license@prestashop.com so we can send you a copy immediately.** DISCLAIMER** Do not edit or add to this file if you wish to upgrade PrestaShop to newer* versions in the future. If you wish to customize PrestaShop for your* needs please refer to http://www.prestashop.com for more information.**  @author PrestaShop SA <contact@prestashop.com>*  @copyright  2007-2014 PrestaShop SA*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*  International Registered Trademark & Property of PrestaShop SA*}{if isset($products) && $products}	<!-- Products list -->	<ul{if isset($id) && $id} id="{$id}"{/if} class="product_list {if isset($class) && $class} {$class}{/if}{if isset($active) && $active == 1} active{/if}">                            {foreach from=$products item=product name=products}                                                 <li class="ajax_block_product item">                {* Product scope (schema.org) *}                <div class="item-wrapper" itemscope itemtype="http://schema.org/Product">                    <div class="item-upper-container">                        <div class="item-image-container white-border-3px">                            <div class="item-quickview">                                <a class="quick-view" href="{$product.link|escape:'html':'UTF-8'}" rel="{$product.link|escape:'html':'UTF-8'}" title="{l s='Quick view'}">                                    <span class="wpicon wpicon-search medium"></span>                                </a>                            </div>                            {*                            {if ($product.name|in_array:['Swoppster','Freedesk'])}                                <div class="item-tag">                                    <span class="item-tag-new">{l s='SPECIAL OFFER'}</span>                                </div>                                *}                            {if ($product.name|in_array:['Yo-Yo Desk GO1', 'Yo-Yo Desk GO2','Yo-Yo Mat','QuickStand ECO'])}                                <div class="item-tag">                                    <span class="item-tag-new">{l s='New'}</span>                                </div>                            {elseif ($product.name|in_array:['DeskPro 1', 'DeskPro 2X', 'Muvman Stool',                            'IMPRINT Deluxe Mat', 'Hush Desk', 'Yo-Yo Desk MINI', 'Yo-Yo Desk 90'])}                                <div class="item-tag">                                    <span class="item-tag-bestseller">{l s='Best Seller'}</span>                                </div>                            {elseif ( (isset($product.new) && $product.new == 1) || (isset($product.on_sale) && $product.on_sale) || (isset($product.reduction) && $product.reduction) || (isset($product.online_only) && $product.online_only)   || ($product.cache_is_pack == 1) )}                                <div class="item-tag">                                                                    {if $product.cache_is_pack == 1}                                        <span class="item-tag-bundle"><img src="themes/autumn/img/mypic/Picture1a.png"/></span>                                    {/if}                                                                                                             {if (isset($product.new) && $product.new == 1) }                                                                                    <span class="item-tag-new">{l s='New'}</span>                                                                           {/if}                                    {if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}                                        <span class="item-tag-discount">{l s='On sale'}</span>                                    {elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE }                                        <span class="item-tag-discount">{l s='REDUCED'}</span>                                    {/if}                                    {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}                                        {if isset($product.online_only) && $product.online_only}                                            <span class="item-online-only">{l s='Online only'}</span>                                        {/if}                                    {/if}                                </div>                            {/if}                                                                                                                                                                                                                                <div class="item-images item-images-{$product.id_product}" data-pid="{$product.id_product}" data-linkrewrite="{$product.link_rewrite}">                                <a class="item-image-link img-wrapper" href="{$product.link|escape:'html':'UTF-8'}">                                    <img class="item-image-cover" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'atmn_normal')|escape:'html'}" alt="{if !empty($product.legend)}{$product.legend|escape:'htmlall':'UTF-8'}{else}{$product.name|escape:'htmlall':'UTF-8'}{/if}" title="{if !empty($product.legend)}{$product.legend|escape:'htmlall':'UTF-8'}{else}{$product.name|escape:'htmlall':'UTF-8'}{/if}" itemprop="image" />                                </a>                            </div>                        </div>                        <div class="item-hover {if $product.cache_is_pack == 1} productborder2 {/if}">                            <a class="item-name-link" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">                                <span class="item-name">{$product.name|truncate:45:'...'|escape:'html':'UTF-8'}</span>                            </a>                            {if isset($product.color_list)}                                <div class="item-color-options">                                    <div class="color-list-container">                                        {$product.color_list}                                    </div>                                </div>                            {/if}                            <div class="item-buttons">                                {if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}                                    {if ($product.allow_oosp || $product.quantity > 0)}                                                                                                                    <a class="button-1 fill view_product_button view-product" href="{$product.link}" title="{l s='View Product'}">                                                                                                                                        {if $product.cache_is_pack == 1}                                               <span class="wpicon wpicon-eye2 medium"></span><span>{l s='View Bundle'}</span>                                                                                         {else}                                                                                               <span class="wpicon wpicon-eye2 medium"></span><span>{l s='View Product'}</span>                                                                                        {/if}                                                                                    </a>                                    {/if}                                {/if}                                {if isset($comparator_max_item) && $comparator_max_item}                                    <a class="add_to_compare compare" href="{$product.link|escape:'html':'UTF-8'}" data-id-product="{$product.id_product}" title="{l s='Add to Compare'}">                                        <span class="wpicon wpicon-shuffle2 medium"></span>&nbsp;<span>{l s='Add to Compare'}</span>                                    </a>                                {/if}                                {hook h='displayProductListFunctionalButtons' product=$product}                            </div>                        </div>                    </div>                    <div class="item-details">                        {if isset($product.pack_quantity) && $product.pack_quantity}{$product.pack_quantity|intval|cat:' x '}{/if}                                                <div class="item-name-container">                        <a class="item-name-link" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url" >                            <div class="item-name" itemprop="name">{$product.name|truncate:45:'...'|escape:'html':'UTF-8'}</div>                        </a>                                                </div>                        {hook h='displayProductListReviews' product=$product}                        {* OFFER scope (schema.org) *}                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">                            {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}                                <div class="item-price" >                                    {if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}                                        {* Start - Invisible microdata *}                                        <meta itemprop="price" content="{if !$priceDisplay}{$product.price}{else}{$product.price_tax_exc}{/if}" />                                        {if isset($currency) && $currency}                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />                                        {/if}                                        {* End - Invisible microdata *}                                        <span class="price product-price"                                            {if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}                                           style="font-weight:bold"                                           {/if}>                                            {if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc} (Ex VAT) {/if}                                        </span>                                        {if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}                                            <div class="old-price product-price">                                                Normally {displayWtPrice p=$product.price_without_reduction}                                            </div>                                        {/if}                                    {/if}                                </div>                            {/if}                            <div class="item-description-full">                                <a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.description_short|strip_tags:'UTF-8'|truncate:300:'...'}">                                    {$product.description_short|strip_tags:'UTF-8'|truncate:300:'...'}                                </a>                            </div>                            {if isset($product.color_list)}                                <div class="item-color-options">                                    <div class="color-list-container">                                        {$product.color_list}                                    </div>                                </div>                            {/if}                            {if (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}                                {if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}                                    <div class="item-availability availability">                                        {if ($product.allow_oosp || $product.quantity > 0)}                                            <span class="{if $product.quantity <= 0}{if $product.allow_oosp}available-dif{else}out-of-stock{/if}{else}available-now{/if}">                                                {if $product.quantity <= 0}                                                    <link itemprop="availability" href="http://schema.org/OutOfStock" />                                                    {if $product.allow_oosp}                                                        <span class="wpicon wpicon-info small"></span>{$product.available_later}                                                    {else}                                                        <span class="wpicon wpicon-close small"></span>{l s='Out of stock'}                                                    {/if}                                                {else}                                                    <link itemprop="availability" href="http://schema.org/InStock" />                                                    {if isset($product.available_now) && $product.available_now}                                                        <span class="wpicon wpicon-checkmark small"></span>{$product.available_now}                                                    {else}                                                        <span class="wpicon wpicon-checkmark small"></span>{l s='In Stock'}                                                    {/if}                                                {/if}									        </span>                                        {elseif (isset($product.quantity_all_versions) && $product.quantity_all_versions > 0)}                                            <span class="available-dif">                                                <link itemprop="availability" href="http://schema.org/LimitedAvailability" />                                                <span class="wpicon wpicon-info small"></span>{l s='Product available with different options'}                                            </span>                                        {else}                                            <span class="out-of-stock">                                                <link itemprop="availability" href="http://schema.org/OutOfStock" />                                                <span class="wpicon wpicon-close small"></span>{l s='Out of stock'}                                            </span>                                        {/if}                                    </div>                                {/if}                            {/if}                            <div class="item-buttons notouch">                                {if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}                                    {if ($product.allow_oosp || $product.quantity > 0)}                                        {if isset($static_token)}                                            <a class="ajax_add_to_cart_button button-2 fill add-to-cart" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart'}" data-id-product="{$product.id_product|intval}">                                                <span class="wpicon wpicon-cart medium"></span><span>{l s='Add to cart'}</span>                                            </a>                                        {else}                                            <a class="ajax_add_to_cart_button button-2 fill add-to-cart" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart'}" data-id-product="{$product.id_product|intval}">                                                <span class="wpicon wpicon-cart medium"></span><span>{l s='Add to cart'}</span>                                            </a>                                        {/if}                                    {else}                                        <a class="button-2 fill view_product_button view-product" href="{$product.link}" title="{l s='View Product'}">                                            <span class="wpicon wpicon-eye2 medium"></span><span>{l s='View Product'}</span>                                        </a>                                    {/if}                                {/if}                            </div>                        </div>                        {* END - Offer scope (schema.org) *}                    </div>                </div>                {* END - Product scope (schema.org) *}            </li>                                                                              {/foreach}                                                                        	</ul>{addJsDefL name=min_item}{l s='Please select at least one product' js=1}{/addJsDefL}{addJsDefL name=max_item}{l s='You cannot add more than %d product(s) to the product comparison' sprintf=$comparator_max_item js=1}{/addJsDefL}{addJsDef comparator_max_item=$comparator_max_item}{addJsDef comparedProductsIds=$compared_products}{/if}