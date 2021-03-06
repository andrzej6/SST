{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- MODULE Block cart -->
{if isset($blockcart_top) && $blockcart_top}
<div id="header_shopping_cart" class="{if $PS_CATALOG_MODE} header_user_catalog{/if}">
{/if}
	<div id="shopping_cart_block_container" class="shopping_cart">
		<div class="cart_info">
		          
		          <a class="button-1 fill" href="{$link->getPageLink($order_process, true)|escape:'html':'UTF-8'}" title="{l s='View my shopping cart' mod='blockcart'}" rel="nofollow">
                                    <span>{l s='My Basket' mod='blockcart'}</span>
               </a>
		          
		          
		          
            <a href="{$link->getPageLink($order_process, true)|escape:'html':'UTF-8'}" title="{l s='View my shopping cart' mod='blockcart'}" rel="nofollow">
                <div class="cart_info_inner">
                    <span class="wpicon wpicon-cart medium"></span>
                    <span class="ajax_cart_quantity{if $cart_qties == 0} unvisible{/if}">{$cart_qties}</span>
                    <span class="ajax_cart_product_txt{if $cart_qties != 1} unvisible{/if}">{l s='Product' mod='blockcart'}</span>
                    <span class="ajax_cart_product_txt_s{if $cart_qties < 2} unvisible{/if}">{l s='Products' mod='blockcart'}</span>
                    <span class="ajax_cart_total{if $cart_qties == 0} unvisible{/if}">
                        {if $cart_qties > 0}
                            {if $priceDisplay == 1}
                                {assign var='blockcart_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
                                ({convertPrice price=$cart->getOrderTotal(false, $blockcart_cart_flag)})
                            {else}
                                {assign var='blockcart_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
                                ({convertPrice price=$cart->getOrderTotal(true, $blockcart_cart_flag)})
                            {/if}
                        {/if}
                    </span>
                    <span class="ajax_cart_no_product{if $cart_qties > 0} unvisible{/if}">{l s='Empty' mod='blockcart'}</span>
                    <span class="wpicon-arrow-down-3"></span>
                </div>
            </a>
        </div>

		{if !$PS_CATALOG_MODE}
			<div id="header_cart_block" class="cart_block">
				<div class="block_content">

					<!-- block list of products -->
					<div class="cart_block_list {if isset($blockcart_top) && !$blockcart_top}{if isset($colapseExpandStatus) && $colapseExpandStatus eq 'expanded' || !$ajax_allowed || !isset($colapseExpandStatus)} expanded{else} collapsed unvisible{/if}{/if}">

                        {if $products}
							<div class="products">
								{foreach from=$products item='product' name='myLoop'}
									{assign var='productId' value=$product.id_product}
									{assign var='productAttributeId' value=$product.id_product_attribute}

                                    <div class="product row parent">

                                        <div data-id="cart_block_product_{$product.id_product}_{if $product.id_product_attribute}{$product.id_product_attribute}{else}0{/if}_{if $product.id_address_delivery}{$product.id_address_delivery}{else}0{/if}">

                                            <div class="row valign-middle">
                                                <div class="column col-2-16 fixed">
                                                    <a class="cart-images img-wrapper" href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
                                                        <img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'atmn_xsmall')}" alt="{$product.name|escape:'html':'UTF-8'}" />
                                                    </a>
                                                </div>

                                                <div class="cart-info column col-7-16 fixed">
                                                    <div class="product-name">
                                                        <a class="cart_block_product_name" href="{$link->getProductLink($product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute)|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
                                                            {$product.name|truncate:40:'...'|escape:'html':'UTF-8'}
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="column col-2-16 fixed t-align-right">
                                                    <span class="quantity-formated"><span class="quantity">{$product.cart_quantity}</span></span>
                                                </div>

                                                <div class="column col-4-16 fixed t-align-center">
                                                    <span class="price">
                                                        {if !isset($product.is_gift) || !$product.is_gift}
                                                            {if $priceDisplay == $smarty.const.PS_TAX_EXC}{displayWtPrice p="`$product.total`"}{else}{displayWtPrice p="`$product.total_wt`"}{/if}
                                                        {else}
                                                            {l s='Free!' mod='blockcart'}
                                                        {/if}
                                                    </span>
                                                </div>

                                                <div class="remove_link column col-1-16 fixed t-align-right">
                                                    {if !isset($customizedDatas.$productId.$productAttributeId) && (!isset($product.is_gift) || !$product.is_gift)}
                                                        <a class="ajax_cart_block_remove_link" href="{$link->getPageLink('cart', true, NULL, 'delete=1&amp;id_product={$product.id_product}&amp;ipa={$product.id_product_attribute}&amp;id_address_delivery={$product.id_address_delivery}&amp;token={$static_token}', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='remove this product from my cart' mod='blockcart'}"><span class="wpicon wpicon-close small"></span></a>
                                                    {/if}
                                                </div>
                                            </div>

                                            {if isset($product.attributes_small)}
                                                <div class="row">
                                                    <div class="product-atributes column col-16-16 fixed">
                                                        <a href="{$link->getProductLink($product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='blockcart'}">{$product.attributes_small}</a>
                                                    </div>
                                                </div>
                                            {/if}

                                        </div>

                                        <!-- Customizable datas -->
                                        {if isset($customizedDatas.$productId.$productAttributeId[$product.id_address_delivery])}
                                            <div data-id="cart_block_combination_of_{$product.id_product}_{if $product.id_product_attribute}{$product.id_product_attribute}{else}0{/if}_{if $product.id_address_delivery}{$product.id_address_delivery}{else}0{/if}" class="row">
                                                <ul class="cart_block_customizations" data-id="customization_{$productId}_{$productAttributeId}">
                                                    {foreach from=$customizedDatas.$productId.$productAttributeId[$product.id_address_delivery] key='id_customization' item='customization' name='customizations'}
                                                        <li name="customization">
                                                            <div class="column col-15-16 fixed">
                                                                {if isset($customization.datas.$CUSTOMIZE_TEXTFIELD.0)}
                                                                    {$customization.datas.$CUSTOMIZE_TEXTFIELD.0.value|replace:"<br />":" "|truncate:28:'...'|escape:'html':'UTF-8'}
                                                                {else}
                                                                    {l s='Customization #%d:' sprintf=$id_customization|intval mod='blockcart'}
                                                                {/if}
                                                            </div>
                                                            <div data-id="deleteCustomizableProduct_{$id_customization|intval}_{$product.id_product|intval}_{$product.id_product_attribute|intval}_{$product.id_address_delivery|intval}" class="column col-1-16 fixed t-align-right deleteCustomizableProduct">
                                                                <a class="ajax_cart_block_remove_link" href="{$link->getPageLink("cart", true, NULL, "delete=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_customization={$id_customization}&amp;token={$static_token}", true)|escape:"html":"UTF-8"}" rel="nofollow"><span class="wpicon wpicon-close small"></span></a>
                                                            </div>
                                                        </li>
                                                    {/foreach}
                                                </ul>
                                            </div>
                                        {/if}

                                    </div>

								{/foreach}
							</div>
						{/if}

						<p class="cart_block_no_products{if $products} unvisible{/if}">
							{l s='No products' mod='blockcart'}
						</p>

						{if $discounts|@count > 0}
							<div class="vouchers"{if $discounts|@count == 0} style="display:none;"{/if}>
								{foreach from=$discounts item=discount}
									{if $discount.value_real > 0}
										<div class="bloc_cart_voucher row" data-id="bloc_cart_voucher_{$discount.id_discount}">
											<span class="name column col-11-16 fixed" title="{$discount.description}">
												{$discount.name|truncate:18:'...'|escape:'html':'UTF-8'}
											</span>
											<span class="price column col-4-16 fixed">
												-{if $priceDisplay == 1}{convertPrice price=$discount.value_tax_exc}{else}{convertPrice price=$discount.value_real}{/if}
											</span>
											<span class="delete column col-1-16 fixed t-align-right">
												{if strlen($discount.code)}
													<a class="delete_voucher" href="{$link->getPageLink("$order_process", true)}?deleteDiscount={$discount.id_discount}" title="{l s='Delete' mod='blockcart'}" rel="nofollow">
														<span class="wpicon wpicon-close small"></span>
													</a>
												{/if}
											</span>
										</div>
									{/if}
								{/foreach}
							</div>
						{/if}

						<div class="cart-prices row parent">

							<div class="cart-prices-line row">
							    <div class="column col-12-12 fixed">
                                    <span>{l s='Shipping:' mod='blockcart'}</span>
                                    <span class="price cart_block_shipping_cost ajax_cart_shipping_cost">
                                        {if $shipping_cost_float == 0}
                                            {l s='Free shipping!' mod='blockcart'}
                                        {else}
                                            {$shipping_cost}
                                        {/if}
                                    </span>
							    </div>
							</div>

							{if $show_wrapping}
								<div class="cart-prices-line row">
                                    <div class="column col-12-12 fixed">
                                        {assign var='cart_flag' value='Cart::ONLY_WRAPPING'|constant}
                                        <span>{l s='Wrapping:' mod='blockcart'}</span>
                                        <span class="price cart_block_wrapping_cost">
                                            {if $priceDisplay == 1}
                                                {convertPrice price=$cart->getOrderTotal(false, $cart_flag)}{else}{convertPrice price=$cart->getOrderTotal(true, $cart_flag)}
                                            {/if}
                                        </span>
							        </div>
							    </div>
							{/if}

							{if $show_tax && isset($tax_cost)}
								<div class="cart-prices-line row">
                                    <div class="column col-12-12 fixed">
                                        <span>{l s='Tax:' mod='blockcart'}</span>
                                        <span class="price cart_block_tax_cost ajax_cart_tax_cost">{$tax_cost}</span>
								    </div>
								</div>
							{/if}

							{if $use_taxes && $display_tax_label == 1 && $show_tax}
                                <div class="cart-prices-line row">
                                    <div class="column col-12-12 fixed">
                                        {if $priceDisplay == 0}
                                            {l s='Prices are tax included' mod='blockcart'}
                                        {elseif $priceDisplay == 1}
                                            {l s='Prices are tax excluded' mod='blockcart'}
                                        {/if}
								    </div>
								</div>
							{/if}

						</div>

                        <div class="row row-divider">
                            <div class="column col-12-12">
                                <div class="divider"></div>
                            </div>
                        </div>

                        <div class="cart-buttons row valign-middle">
                            <div class="column col-7-12 fixed">
                                <span class="price cart_block_total ajax_block_cart_total">{$total}</span>
                            </div>

                            <div class="column col-5-12 fixed">
                                <a id="button_order_cart" class="button-1 fill" href="{$link->getPageLink("$order_process", true)|escape:"html":"UTF-8"}" title="{l s='Checkout' mod='blockcart'}" rel="nofollow">
                                    <span>{l s='Checkout' mod='blockcart'}</span>
                                </a>
                            </div>
						</div>

					</div>
				</div>
			</div><!-- .cart_block -->
		{/if}
	</div>
{if isset($blockcart_top) && $blockcart_top}
</div>
{/if}

{counter name=active_overlay assign=active_overlay}
{if !$PS_CATALOG_MODE && $active_overlay == 1}
	<div id="layer_cart">
		<div class="row">
			<div class="layer_cart_product column col-6-12 t-align-center">
				<h2>
					{l s='Product successfully added to your shopping cart' mod='blockcart'}
				</h2>
				<div class="product-image-container layer_cart_img white-border-3px">
				</div>
				<div class="layer_cart_product_info">
					<span id="layer_cart_product_title" class="product-name"></span>
					<span id="layer_cart_product_attributes"></span>
					<div>
						<strong>{l s='Quantity' mod='blockcart'} :</strong>
						<span id="layer_cart_product_quantity"></span>
					</div>
					<div>
						<strong>{l s='Total' mod='blockcart'} :</strong>
						<span id="layer_cart_product_price" class="price bold"></span>
					</div>
				</div>
			</div>

			<div class="layer_cart_cart column col-6-12 t-align-center">
                <div class="cross" title="{l s='Close window' mod='blockcart'}"><span class="wpicon wpicon-close"></span></div>
                <h2>
					<!-- Plural Case [both cases are needed because page may be updated in Javascript] -->
					<span class="ajax_cart_product_txt_s {if $cart_qties < 2} unvisible{/if}">
						{l s='There are [1]%d[/1] items in your cart.' mod='blockcart' sprintf=[$cart_qties] tags=['<span class="ajax_cart_quantity">']}
					</span>
					<!-- Singular Case [both cases are needed because page may be updated in Javascript] -->
					<span class="ajax_cart_product_txt {if $cart_qties > 1} unvisible{/if}">
						{l s='There is 1 item in your cart.' mod='blockcart'}
					</span>
				</h2>

				<div class="layer_cart_row">
					<strong>
						{l s='Total products' mod='blockcart'}
						{if $priceDisplay == 1}
							{l s='(tax excl.)' mod='blockcart'}
						{else}
							{l s='(tax incl.)' mod='blockcart'}
						{/if}
                        :
					</strong>
					<span class="ajax_block_products_total">
						{if $cart_qties > 0}
							{convertPrice price=$cart->getOrderTotal(false, Cart::ONLY_PRODUCTS)}
						{/if}
					</span>
				</div>
	
				{if $show_wrapping}
					<div class="layer_cart_row">
						<strong>
							{l s='Wrapping' mod='blockcart'}
							{if $priceDisplay == 1}
								{l s='(tax excl.)' mod='blockcart'}
							{else}
								{l s='(tax incl.)' mod='blockcart'}
							{/if}
                            :
						</strong>
						<span class="price cart_block_wrapping_cost">
							{if $priceDisplay == 1}
								{convertPrice price=$cart->getOrderTotal(false, Cart::ONLY_WRAPPING)}
							{else}
								{convertPrice price=$cart->getOrderTotal(true, Cart::ONLY_WRAPPING)}
							{/if}
						</span>
					</div>
				{/if}
				<div class="layer_cart_row">
					<strong>
						{l s='Total shipping' mod='blockcart'}&nbsp;{l s='(tax excl.)' mod='blockcart'} :
					</strong>
					<span class="ajax_cart_shipping_cost">
						{if $shipping_cost_float == 0}
							{l s='Free shipping!' mod='blockcart'}
						{else}
							{$shipping_cost}
						{/if}
					</span>
				</div>
				{if $show_tax && isset($tax_cost)}
					<div class="layer_cart_row">
						<strong>{l s='Tax' mod='blockcart'} :</strong>
						<span class="cart_block_tax_cost ajax_cart_tax_cost">{$tax_cost}</span>
					</div>
				{/if}
				<div class="layer_cart_row">	
					<strong>
						{l s='Total' mod='blockcart'}
						{if $priceDisplay == 1}
							{l s='(tax excl.)' mod='blockcart'}
						{else}
							{l s='(tax incl.)' mod='blockcart'}
						{/if}
                        :
					</strong>
					<span class="ajax_block_cart_total price">
						{if $cart_qties > 0}
							{if $priceDisplay == 1}
								{convertPrice price=$cart->getOrderTotal(false)}
							{else}
								{convertPrice price=$cart->getOrderTotal(true)}
							{/if}
						{/if}
					</span>
				</div>
				<div class="button-container">	
					<span class="continue button-2 fill" title="{l s='Continue shopping' mod='blockcart'}">
				        <span class="wpicon wpicon-chevron-left medium"></span>{l s='Continue shopping' mod='blockcart'}
					</span>
					<a class="button-1 fill" href="{$link->getPageLink("$order_process", true)|escape:"html":"UTF-8"}" title="{l s='Proceed to checkout' mod='blockcart'}" rel="nofollow">
                        <span class="wpicon wpicon-cart medium"></span>{l s='Proceed to checkout' mod='blockcart'}
					</a>
				</div>
			</div>
		</div>
		<div id="blockcart-crossselling" class="crossseling"></div>
	</div> <!-- #layer_cart -->
	<div class="layer_cart_overlay"></div>
{/if}

{strip}
{addJsDef CUSTOMIZE_TEXTFIELD=$CUSTOMIZE_TEXTFIELD}
{addJsDef img_dir=$img_dir|addslashes}
{addJsDef ajax_allowed=$ajax_allowed|boolval}

{addJsDefL name=customizationIdMessage}{l s='Customization #' mod='blockcart' js=1}{/addJsDefL}
{addJsDefL name=removingLinkText}{l s='remove this product from my cart' mod='blockcart' js=1}{/addJsDefL}
{addJsDefL name=freeShippingTranslation}{l s='Free shipping!' mod='blockcart' js=1}{/addJsDefL}
{addJsDefL name=freeProductTranslation}{l s='Free!' mod='blockcart' js=1}{/addJsDefL}
{addJsDefL name=delete_txt}{l s='Delete' mod='blockcart' js=1}{/addJsDefL}
{/strip}
<!-- /MODULE Block cart -->