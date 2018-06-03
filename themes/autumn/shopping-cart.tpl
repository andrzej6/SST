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

{capture name=path}{l s='Your shopping cart'}{/capture}

<h1 id="cart_title" class="page-header">{l s='Shopping-cart summary'}</h1>

{if !isset($empty) && !$PS_CATALOG_MODE}
    <h3 class="shopping-cart-count">{l s='Your shopping cart contains'}<span class="bold colored-text"> {$productNumber} {if $productNumber == 1}{l s='product'}{else}{l s='products'}{/if}</span></h3>
{/if}

{if isset($account_created)}
	<p class="alert alert-success">
		{l s='Your account has been created.'}
	</p>
{/if}

{assign var='current_step' value='summary'}
{include file="$tpl_dir./order-steps.tpl"}
{include file="$tpl_dir./errors.tpl"}

{if isset($empty)}
	<p class="alert alert-warning">{l s='Your shopping cart is empty.'}</p>
{elseif $PS_CATALOG_MODE}
	<p class="alert alert-warning">{l s='This store has not accepted your new order.'}</p>
{else}
	<p style="display:none" id="emptyCartWarning" class="alert alert-warning">{l s='Your shopping cart is empty.'}</p>
	{*{if isset($lastProductAdded) AND $lastProductAdded}
		<div class="cart_last_product">
			<div class="cart_last_product_header">
				<div class="left">{l s='Last product added'}</div>
			</div>
			<a class="cart_last_product_img" href="{$link->getProductLink($lastProductAdded.id_product, $lastProductAdded.link_rewrite, $lastProductAdded.category, null, null, $lastProductAdded.id_shop)|escape:'html':'UTF-8'}">
				<img src="{$link->getImageLink($lastProductAdded.link_rewrite, $lastProductAdded.id_image, 'atmn_small')|escape:'html':'UTF-8'}" alt="{$lastProductAdded.name|escape:'html':'UTF-8'}"/>
			</a>
			<div class="cart_last_product_content">
				<p class="product-name">
					<a href="{$link->getProductLink($lastProductAdded.id_product, $lastProductAdded.link_rewrite, $lastProductAdded.category, null, null, null, $lastProductAdded.id_product_attribute)|escape:'html':'UTF-8'}">
						{$lastProductAdded.name|escape:'html':'UTF-8'}
					</a>
				</p>
				{if isset($lastProductAdded.attributes) && $lastProductAdded.attributes}
					<small>
						<a href="{$link->getProductLink($lastProductAdded.id_product, $lastProductAdded.link_rewrite, $lastProductAdded.category, null, null, null, $lastProductAdded.id_product_attribute)|escape:'html':'UTF-8'}">
							{$lastProductAdded.attributes|escape:'html':'UTF-8'}
						</a>
					</small>
				{/if}
			</div>
		</div>
	{/if}*}

    <!-- Shopping Cart -->
    <div id="order-detail-content" class="table_block">
		<table id="cart_summary" class="table table-bordered wpresponsive">
			<thead>
				<tr>
					<th class="cart_product first_item">{l s='Product'}</th>
					<th class="cart_description item">{l s='Description'}</th>
					{if $PS_STOCK_MANAGEMENT}
						<th class="cart_avail item">{l s='Avail.'}</th>
					{/if}
					<th class="cart_unit item">{l s='Unit price'}</th>
					<th class="cart_quantity item">{l s='Qty'}</th>
					<th class="cart_total item">{l s='Total'}</th>					{* was with ex VAT <th class="cart_total item">{l s='Total(ex VAT)'}</th> *}					                    
					<th class="cart_delete last_item">&nbsp;</th>
				</tr>
			</thead>

			<tfoot>
                <tr class="cart_voucher">

                </tr>

				{if $use_taxes}
					{if $priceDisplay}
						<tr class="cart_total_price">
							<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{if $display_tax_label}{l s='Total products'}{else}{l s='Total products'}{/if}</td>                       {* <td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{if $display_tax_label}{l s='Total products (ex VAT)'}{else}{l s='Total products'}{/if}</td> *}
							<td colspan="3" class="special-alcels">
							<div id="total_product" class="price">{displayPrice price=$total_products} (ex VAT) </div>
							
							<div id="total_productincvat" class="tot-prod-incvat">{displayPrice price=$total_products_wt} (inc VAT)</div>
							
							
							</td>
						</tr>
					{else}
						<tr class="cart_total_price">
							<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{if $display_tax_label}{l s='Total products (ex VAT)'}{else}{l s='Total products'}{/if}</td>
							<td colspan="3" class="special-alcels">
							<div id="total_product" class="price">{displayPrice price=$total_products} (ex VAT)</div>
							
							<div id="total_productincvat" class="tot-prod-incvat">{displayPrice price=$total_products_wt} (inc VAT)</div>
							
							
							</td>
						</tr>
					{/if}
				{else}
					<tr class="cart_total_price">
						<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{l s='Total products'}</td>
						<td colspan="3" class="price" id="total_product">{displayPrice price=$total_products}</td>
					</tr>
				{/if}

				<tr{if $total_wrapping == 0} style="display: none;"{/if}>
					<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">
						{if $use_taxes}
							{if $display_tax_label}{l s='Total gift wrapping (inc VAT):'}{else}{l s='Total gift-wrapping cost:'}{/if}
						{else}
							{l s='Total gift-wrapping cost:'}
						{/if}
					</td>
					<td colspan="3" class="price-discount price" id="total_wrapping">
						{if $use_taxes}
							{if $priceDisplay}
								{displayPrice price=$total_wrapping_tax_exc}
							{else}
								{displayPrice price=$total_wrapping}
							{/if}
						{else}
							{displayPrice price=$total_wrapping_tax_exc}
						{/if}
					</td>
				</tr>

				{if $total_shipping_tax_exc <= 0 && !isset($virtualCart)}
					<tr class="cart_total_delivery" style="{if !isset($carrier->id) || is_null($carrier->id)}display:none;{/if}">
						<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{l s='Shipping'}</td>
						<td colspan="3" class="price" id="total_shipping">{l s='Free Shipping'}</td>
					</tr>
				{else}
					{if $use_taxes && $total_shipping_tax_exc != $total_shipping}
						{if $priceDisplay}
							<tr class="cart_total_delivery" {if $total_shipping_tax_exc <= 0} style="display:none;"{/if}>
								<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{if $display_tax_label}{l s='Total shipping'}{else}{l s='Total shipping'}{/if}</td>                            {* <td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{if $display_tax_label}{l s='Total shipping (ex VAT)'}{else}{l s='Total shipping'}{/if}</td> *}
								<td colspan="3" class="special-alcels">
								     <div id="total_shipping" class="price"> {displayPrice price=$total_shipping_tax_exc} (ex VAT)</div>
								
								    <div id="tot-ship-incvat">{displayPrice price=$total_shipping} (inc VAT)</div>
								
								</td>
							</tr>
						{else}
							<tr class="cart_total_delivery"{if $total_shipping <= 0} style="display:none;"{/if}>
								<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{if $display_tax_label}{l s='Total shipping'}{else}{l s='Total shipping'}{/if}</td>                                  {* <td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{if $display_tax_label}{l s='Total shipping (ex VAT)'}{else}{l s='Total shipping'}{/if}</td> *}
								<td colspan="3" class="special-alcels">
								     <div id="total_shipping" class="price"> {displayPrice price=$total_shipping_tax_exc} (ex VAT)</div>
								
								    <div id="tot-ship-incvat">{displayPrice price=$total_shipping} (inc VAT)</div>
								
								</td>
							</tr>
						{/if}
					{else}
						<tr class="cart_total_delivery"{if $total_shipping_tax_exc <= 0} style="display:none;"{/if}>
							<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{l s='Total shipping'}</td>
							<td colspan="3" class="price" id="total_shipping" >{displayPrice price=$total_shipping_tax_exc}</td>
						</tr>
					{/if}
				{/if}

				<tr class="cart_total_voucher" {if $total_discounts == 0}style="display:none"{/if}>
					<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">
						{if $display_tax_label}
							{if $use_taxes && $priceDisplay == 0}
								{l s='Total vouchers:'}								{* l s='Total vouchers (inc VAT):' *}
							{else}
								{l s='Total vouchers'}								{* l s='Total vouchers (ex VAT)' *}
							{/if}
						{else}
							{l s='Total vouchers'}
						{/if}
					</td>
					<td colspan="3" class="price-discount price" id="total_discount">
						{if $use_taxes && $priceDisplay == 0}
							{assign var='total_discounts_negative' value=$total_discounts * -1}
						{else}
							{assign var='total_discounts_negative' value=$total_discounts_tax_exc * -1}							
						{/if}												{assign var='total_discounts_incvat' value=$total_discounts * -1}                      <div id="total_discounts">
						{displayPrice price=$total_discounts_negative} (ex VAT)                      </div>                                                                                        <div id="total_discounts_incv">						{displayPrice price=$total_discounts_incvat} (inc VAT)                      </div>
					</td>
				</tr>

				{if $use_taxes && $show_taxes}
					<tr class="cart_total_price">
						<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{l s='Total'}</td>						{* <td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{l s='Total (ex VAT)'}</td> *}
						<td colspan="3" class="price" id="total_price_without_tax">{displayPrice price=$total_price_without_tax} (ex VAT)</td>
					</tr>
					<tr class="cart_total_tax">
						<td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" class="text-right">{l s='Total VAT'}</td>
						<td colspan="3" class="price" id="total_tax">{displayPrice price=$total_tax}</td>
					</tr>
				{/if}

				<tr class="cart_total_price">
                    <td colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}" id="cart_voucher2" class="cart_voucher">
                        {if $voucherAllowed}
                            {if isset($errors_discount) && $errors_discount}
                                <ul class="alert alert-danger">
                                    {foreach $errors_discount as $k=>$error}
                                        <li>{$error|escape:'html':'UTF-8'}</li>
                                    {/foreach}
                                </ul>
                            {/if}
                            <form action="{if $opc}{$link->getPageLink('order-opc', true)}{else}{$link->getPageLink('order', true)}{/if}" method="post" id="voucher">                                {if $logged}
                                   <h3 class="vouchers-red">{l s='Vouchers'}</h3>                                {else}                                    <h3 class="vouchers-red">Vouchers (Please <a href="/my-account" class="link-register"><u>register</u></a> to get £25 OFF your First Order):</h3>                                {/if}                                
                                <input type="text" class="discount_name form-control" id="discount_name" name="discount_name" value="{if isset($discount_name) && $discount_name}{$discount_name}{/if}" />
                                <input type="hidden" name="submitDiscount" />
                                <button type="submit" name="submitAddDiscount" class="button-1 fill"><span>{l s='OK'}</span></button>
                            </form>
                            {if $displayVouchers}
                                <div id="title" class="title-offers">{l s='Take advantage of our exclusive offers:'}</div>
                                <div id="display_cart_vouchers">
                                    {foreach $displayVouchers as $voucher}
                                        {if $voucher.code != ''}<span class="voucher_name" data-code="{$voucher.code|escape:'html':'UTF-8'}">{$voucher.code|escape:'html':'UTF-8'}</span> - {/if}{$voucher.name}<br />
                                    {/foreach}
                                </div>
                            {/if}
                        {/if}
                    </td>

					{if $use_taxes}
						<td colspan="3" class="special-alcels" id="total_price_container">
						    <div id="total_price_label">{l s='Total'}</div>
							
							
							{* repeat from above so commented <div id="total_price" class="price">{displayPrice price=$total_price_without_tax} </div>  *}
							
							<div id="total_priceincvat" class="tot-cost-incvat">{displayPrice price=$total_price} (inc VAT)</div>
							
							</div>
						</td>
					{else}
						<td colspan="3" id="total_price_container">
						    <div id="total_price_label">{l s='Total'}</div>
							<div id="total_price" class="price">{displayPrice price=$total_price_without_tax}</div>
						</td>
					{/if}
				</tr>
			</tfoot>

			<tbody>
				{assign var='odd' value=0}
				{assign var='have_non_virtual_products' value=false}
				{foreach $products as $product}
					{if $product.is_virtual == 0}
						{assign var='have_non_virtual_products' value=true}						
					{/if}
					{assign var='productId' value=$product.id_product}
					{assign var='productAttributeId' value=$product.id_product_attribute}
					{assign var='quantityDisplayed' value=0}
					{assign var='odd' value=($odd+1)%2}
					{assign var='ignoreProductLast' value=isset($customizedDatas.$productId.$productAttributeId) || count($gift_products)}
					{* Display the product line *}
					{include file="$tpl_dir./shopping-cart-product-line.tpl" productLast=$product@last productFirst=$product@first}
					{* Then the customized datas ones*}
					{if isset($customizedDatas.$productId.$productAttributeId)}
						{foreach $customizedDatas.$productId.$productAttributeId[$product.id_address_delivery] as $id_customization=>$customization}
							<tr id="product_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}" class="product_customization_for_{$product.id_product}_{$product.id_product_attribute}_{$product.id_address_delivery|intval}{if $odd} odd{else} even{/if} customization alternate_item {if $product@last && $customization@last && !count($gift_products)}last_item{/if}">
								<td colspan="2">
									{foreach $customization.datas as $type => $custom_data}
										{if $type == $CUSTOMIZE_FILE}
											<div class="customizationUploaded">
												<ul class="customizationUploaded">
													{foreach $custom_data as $picture}
														<li><img src="{$pic_dir}{$picture.value}_small" alt="" class="customizationUploaded" /></li>
													{/foreach}
												</ul>
											</div>
										{elseif $type == $CUSTOMIZE_TEXTFIELD}
											<ul class="typedText">
												{foreach $custom_data as $textField}
													<li>
														{if $textField.name}
															{$textField.name}
														{else}
															{l s='Text #'}{$textField@index+1}
														{/if}
														: {$textField.value}
													</li>
												{/foreach}
											</ul>
										{/if}
									{/foreach}
								</td>
								<td class="cart_quantity" colspan="{if $PS_STOCK_MANAGEMENT}4{else}3{/if}">
									{if isset($cannotModify) AND $cannotModify == 1}
										<span>{if $quantityDisplayed == 0 AND isset($customizedDatas.$productId.$productAttributeId)}{$customizedDatas.$productId.$productAttributeId|@count}{else}{$product.cart_quantity-$quantityDisplayed}{/if}</span>
									{else}
										<input type="hidden" value="{$customization.quantity}" name="quantity_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}_hidden"/>
										<input type="text" value="{$customization.quantity}" class="cart_quantity_input form-control grey" name="quantity_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}"/>
										<div class="cart_quantity_button clearfix">
											{if $product.minimal_quantity < ($customization.quantity -$quantityDisplayed) OR $product.minimal_quantity <= 1}
												<a id="cart_quantity_down_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}" class="cart_quantity_down button-minus button-2 fill icon-only sharp-corners" href="{$link->getPageLink('cart', true, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_address_delivery={$product.id_address_delivery}&amp;id_customization={$id_customization}&amp;op=down&amp;token={$token_cart}")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Subtract'}">
													<span class="wpicon wpicon-minus small"></span>
												</a>
											{else}
												<a id="cart_quantity_down_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}" class="cart_quantity_down button-minus button-2 fill icon-only sharp-corners disabled" href="#" title="{l s='Subtract'}">
                                                    <span class="wpicon wpicon-minus small"></span>
												</a>
											{/if}
											<a id="cart_quantity_up_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}" class="cart_quantity_up button-plus button-2 fill icon-only sharp-corners" href="{$link->getPageLink('cart', true, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_address_delivery={$product.id_address_delivery}&amp;id_customization={$id_customization}&amp;token={$token_cart}")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add'}">
												<span class="wpicon wpicon-plus small"></span>
											</a>
										</div>
									{/if}
								</td>
								<td class="cart_delete">
									{if isset($cannotModify) AND $cannotModify == 1}                                       {$cannotModify}
									{else}
										<div>
											<a id="{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}" class="cart_quantity_delete" href="{$link->getPageLink('cart', true, NULL, "delete=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_customization={$id_customization}&amp;id_address_delivery={$product.id_address_delivery}&amp;token={$token_cart}")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Delete'}">
                                                <span class="wpicon wpicon-remove medium"></span>
											</a>
										</div>
									{/if}
								</td>
							</tr>
							{assign var='quantityDisplayed' value=$quantityDisplayed+$customization.quantity}
						{/foreach}

						{* If it exists also some uncustomized products *}
						{if $product.quantity-$quantityDisplayed > 0}{include file="$tpl_dir./shopping-cart-product-line.tpl" productLast=$product@last productFirst=$product@first}{/if}
					{/if}
				{/foreach}

				{assign var='last_was_odd' value=$product@iteration%2}
				{foreach $gift_products as $product}
					{assign var='productId' value=$product.id_product}
					{assign var='productAttributeId' value=$product.id_product_attribute}
					{assign var='quantityDisplayed' value=0}
					{assign var='odd' value=($product@iteration+$last_was_odd)%2}
					{assign var='ignoreProductLast' value=isset($customizedDatas.$productId.$productAttributeId)}
					{assign var='cannotModify' value=1}
					{* Display the gift product line *}
					{include file="$tpl_dir./shopping-cart-product-line.tpl" productLast=$product@last productFirst=$product@first}
				{/foreach}

                {if sizeof($discounts)}
                    {foreach $discounts as $discount}
                        <tr class="cart_discount" id="cart_discount_{$discount.id_discount}">
                            <td class="cart_discount_name" colspan="{if $PS_STOCK_MANAGEMENT}3{else}2{/if}">{$discount.name}</td>
                            <td class="cart_discount_price">
                                <span class="price-discount">
                                {if !$priceDisplay}{displayPrice price=$discount.value_real*-1}{else}{displayPrice price=$discount.value_tax_exc*-1} (ex VAT){/if}
                                </span>
                            </td>
                            <td class="cart_discount_delete">1</td>
                            <td class="cart_discount_price">
                                <span class="price-discount price">{if !$priceDisplay}{displayPrice price=$discount.value_real*-1}{else}{displayPrice price=$discount.value_tax_exc*-1} (ex VAT){/if}</span>
                            </td>
                            <td class="price_discount_del text-center">
                                {if strlen($discount.code)}
                                    <a href="{if $opc}{$link->getPageLink('order-opc', true)}{else}{$link->getPageLink('order', true)}{/if}?deleteDiscount={$discount.id_discount}" class="price_discount_delete" title="{l s='Delete'}">
                                        <span class="wpicon wpicon-remove medium"></span>
                                    </a>
                                {/if}
                            </td>
                        </tr>
                    {/foreach}
                {/if}
            </tbody>
		</table>
	</div>
    <!-- End - Shopping Cart -->

	{if $show_option_allow_separate_package}
	<p>
		<input type="checkbox" name="allow_seperated_package" id="allow_seperated_package" {if $cart->allow_seperated_package}checked="checked"{/if} autocomplete="off"/>
		<label for="allow_seperated_package">{l s='Send available products first'}</label>
	</p>
	{/if}

	{* Define the style if it doesn't exist in the PrestaShop version*}
	{* Will be deleted for 1.5 version and more *}
	{if !isset($addresses_style)}
		{$addresses_style.company = 'address_company'}
		{$addresses_style.vat_number = 'address_company'}
		{$addresses_style.firstname = 'address_name'}
		{$addresses_style.lastname = 'address_name'}
		{$addresses_style.address1 = 'address_address1'}
		{$addresses_style.address2 = 'address_address2'}
		{$addresses_style.city = 'address_city'}
		{$addresses_style.country = 'address_country'}
		{$addresses_style.phone = 'address_phone'}
		{$addresses_style.phone_mobile = 'address_phone_mobile'}
		{$addresses_style.alias = 'address_title'}
	{/if}
	<div id="HOOK_SHOPPING_CART">
        {$HOOK_SHOPPING_CART}
    </div>

	<div class="cart_navigation">
		<a href="{if (isset($smarty.server.HTTP_REFERER) && strstr($smarty.server.HTTP_REFERER, 'order.php')) || isset($smarty.server.HTTP_REFERER) && strstr($smarty.server.HTTP_REFERER, 'order-opc') || !isset($smarty.server.HTTP_REFERER)}{$link->getPageLink('index')}{else}{$smarty.server.HTTP_REFERER|escape:'html':'UTF-8'|secureReferrer}{/if}" class="button-2 fill inline" title="{l s='Continue shopping'}">
            <span class="wpicon wpicon-arrow-left3 small"></span>{l s='Continue shopping'}
		</a>
		{if !$opc}
			<a href="{if $back}{$link->getPageLink('order', true, NULL, 'step=1&amp;back={$back}')|escape:'html':'UTF-8'}{else}{$link->getPageLink('order', true, NULL, 'step=1')|escape:'html':'UTF-8'}{/if}" class="standard-checkout button-1 fill inline" title="{l s='Proceed to checkout'}">
                <span>{l s='Proceed to checkout'}</span>
			</a>
		{/if}
	</div>

	{if !empty($HOOK_SHOPPING_CART_EXTRA)}
		<div class="cart_navigation_extra">
			<div id="HOOK_SHOPPING_CART_EXTRA">
                {$HOOK_SHOPPING_CART_EXTRA}
            </div>
		</div>
	{/if}

{strip}
{addJsDef currencySign=$currencySign|html_entity_decode:2:"UTF-8"}
{addJsDef currencyRate=$currencyRate|floatval}
{addJsDef currencyFormat=$currencyFormat|intval}
{addJsDef currencyBlank=$currencyBlank|intval}
{addJsDef deliveryAddress=$cart->id_address_delivery|intval}
{addJsDefL name=txtProduct}{l s='product' js=1}{/addJsDefL}
{addJsDefL name=txtProducts}{l s='products' js=1}{/addJsDefL}
{/strip}
{/if}{literal}<script language="JavaScript" src="https://secure.worldpay.com/wcc/logo?instId=1249706"></script>{/literal}