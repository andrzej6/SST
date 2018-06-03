{*
 * Facebook Conversion Pixel Tracking Plus
 *
 * NOTICE OF LICENSE
 *
 * @author    Pol Rué
 * @copyright Smart Modules 2014
 * @license   One time purchase Licence (You can modify or resell the product but just one time per licence)
 * @version 1.8.0
 * @category Marketing & Advertising
 * Registered Trademark & Property of Smart-Modules.pro
 *
 * **************************************************
 * *     Facebook Conversion Trackcing Pixel Plus    *
 * *          http://www.smart-modules.pro           *
 * *                     V 1.8.0                     *
 * **************************************************
 *
*}
<!-- Add To cart Pixel Call -->
{literal}
<script type="text/javascript">
fctp_addToCart(10);
function fctp_addToCart(max_tries) {
    if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
        setTimeout(function() {fctp_addToCart(max_tries-1)},250);
    } else {
        jQuery(document).ready(function($) {
            var sent = false;
            var values = '';
            {/literal}
            {if $entity == 'index' || $entity == 'search' || $entity == 'category'}
            {literal}
            $(document).on('click', '.ajax_add_to_cart_button', function(e){
             pixelCall(getpixelvalueslist($(this)));
            });
            $(document).on('click', 'button.add-to-cart', function(e){
             pixelCall(getpixelvalueslist17($(this)));
            });
            {/literal}
            {/if}
            {if $custom_add_to_cart != ''}
                init_cust_add_to_cart(5);
            {/if}
            {if $entity == 'product'}
            {literal}
            if ($("#add_to_cart button, #add_to_cart a, #add_to_cart input").length > 0) {
                $('#add_to_cart button, #add_to_cart a, #add_to_cart input').click(function(e){
                    pixelCall(getpixelvalue($(this)));
                });
                $('#add_to_cart button, #add_to_cart a, #add_to_cart input').mousedown(function(e){
                    pixelCall(getpixelvalue($(this)));
                });
            } else {
                if ($("button#add_to_cart").length == 1) {
                    $('#add_to_cart').click(function() {
                        pixelCall(getpixelvalue($(this)));
                    });
                    $("button#add_to_cart").mousedown(function(e){
                        pixelCall(getpixelvalue($(this)));
                    });
        
                } else {
                    // Last resort
                    if ($('.ajax_add_to_cart_button').length > 0) {
                        $('.ajax_add_to_cart_button').click(function(e) {
                            console.log(5);
                            pixelCall(getpixelvalueslist($(this)));
                        });
                        $(".ajax_add_to_cart_button").mousedown(function(e){
                            console.log(6);
                            pixelCall(getpixelvalue($(this)));
                        });
        
                    } else {
                        // 1.7 Versions
                        if ($('button.add-to-cart').length != 0) {
                            $(document).on('click', 'button.add-to-cart', function(e){
                                console.log(7);
                                pixelCall(getpixelvalueslist17($(this)));
                            });
                        } else {
                            console.log('AddToCart not found, customizations may be needed');
                        }
                    }
                }
            }
            {/literal}
            {/if}
            {literal}
            // 1.5.X versions
            $("#add_to_cart input").click(function() { 
                pixelCall(getpixelvalue($(this)));
            });
            function pixelCall(values) {
        {/literal}
                if (sent == false) {
                    fbq('track', 'AddToCart',values);
                    console.log('addToCart Event Registered');
                    sent = true;
                    // Enable again the addToCart event
                    setTimeout(function() { sent = false; }, 1000);
                }
        {literal}
            }
            function getpixelvalueslist(object) {
                var iv = 0;
                if (typeof productPrice != 'undefined') {
                    iv = productPrice
                } else {
                    iv = getPriceRecursive(6, object);
                    if (iv !== false) {
                        iv = iv.slice(0,-2)+'.'+ iv.slice((iv.slice(0,-2).length));
                    } else {
                        iv = null;
                    }
                }
                productname = getNameRecursive(6, object);
                if (productname === false) {
                    // Last try only for Product page
                    productname = $("#bigpic").attr('title');
                }
                values = {
                    content_name : productname,
                    value: iv,
                    currency: '{/literal}{$fctp_currency|escape:'htmlall':'UTF-8'}{literal}',
        {/literal}
        {if $dynamic_ads}
                    content_ids : ['{$id_prefix|escape:'htmlall':'UTF-8'}'+gup('id_product',object.attr('href'))],
                    content_type: 'product',
        {if isset($fpf_id)}
                    product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
        {/if}
        {/if}
        {literal}
                };
                return values;
            }

            // for 1.7 version
            function getpixelvalueslist17(object) {
                // Navigate untill we find the product container
                object = object.parents('.row').first();
                var iv = 0;
                if (typeof productPrice != 'undefined') {
                    iv = productPrice
                } else {
                    iv = object.find('.current-price span').text().replace(/\D/g,'');
                    iv = iv.slice(0,-2)+'.'+ iv.slice((iv.slice(0,-2).length));
                }
                productname = object.find('h1').first().html();
                
                values = {
                    content_name : productname,
                    value: iv,
                    //currency: object.find('meta[itemprop="priceCurrency"]').attr('content'),
                    currency: '{/literal}{$fctp_currency|escape:'htmlall':'UTF-8'}{literal}',
        {/literal}
        {if $dynamic_ads}
                    content_ids : [object.find('input#product_page_product_id').val()],
                    content_type: 'product',
        {if isset($fpf_id)}
                    product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
        {/if}
        {/if}
        {literal}
                };
                return values;
            }
            
            function getPriceRecursive(tries, object)
            {
                var res = '';
                if (object.parent().find('.price:eq(0)').length > 0) {
                    res = object.parent().find('.price:eq(0)').text().replace(/\D/g,'');
                } else {
                    if (tries > 0) {
                        res = getPriceRecursive(tries-1, object.parent());
                    } else {
                        return false;
                    }
                }
                if (res != '') {
                    return res;
                }
            }
            function getNameRecursive(tries, object)
            {
                var res = '';
                if (object.parent().find('.product-name, itemprop[name]').length > 0) {
                    res = object.parent().find('.product-name, itemprop[name]').first().text().trim();
                } else {
                    if (tries > 0) {
                        res = getNameRecursive(tries-1, object.parent());
                    } else {
                        return false;
                    }
                }
                if (res != '') {
                    return res;
                }
            }
            function getpixelvalue(object) {
                var productname = '';
                var iv = 0;
                iv = object.parents('#center_column').find('#our_price_display:eq(0)').text().replace(/\D/g,'');
                if (typeof iv == 'undefined') {
                    iv = object.parents('#center_column').find('.price:eq(0)').text().replace(/\D/g,'');
                }
                if (typeof iv == 'undefined' || iv == '') {
                    // Last call look for #our_price_display
                    iv = $('#our_price_display:eq(0)').text().replace(/\D/g,'');
                }
                if (typeof iv != 'undefined') {
                    iv = iv.slice(0,-2)+'.'+ iv.slice((iv.slice(0,-2).length));
                } else {
                    if (typeof productPrice != 'undefined') {
                        iv = productPrice;
                    }
                }

                if (typeof object.parents('.ajax_block_product').find('.product-name:eq(0)').attr('title') != 'undefined') {
                    productname = object.parents('.ajax_block_product').find('.product-name:eq(0)').attr('title');
                } else {
                    productname = $("#bigpic").attr('title');
                }
                values = {
                    content_name : productname,
                    value: iv,
                    currency: '{/literal}{$fctp_currency|escape:'htmlall':'UTF-8'}{literal}',
        {/literal}
        {if $dynamic_ads}
                {if isset($hascombi) && $hascombi == 1 && $combi == 1}
                /*content_type : 'product_group',*/
                content_type : 'product',
                content_ids : [{if $id_prefix|escape:'htmlall':'UTF-8' != ''} '{$id_prefix|escape:'htmlall':'UTF-8'}'+$("#buy_block").find("input[name=id_product]:eq(0)").val(){else}$("#buy_block").find("input[name=id_product]:eq(0)").val(){/if}+ (combination != '' ? '{$combi_prefix|escape:'htmlall':'UTF-8'}'+combination : '')],
        
                {else}
                content_type : 'product',
                content_ids : [{if $id_prefix|escape:'htmlall':'UTF-8' != ''} '{$id_prefix|escape:'htmlall':'UTF-8'}'+$("#buy_block").find("input[name=id_product]:eq(0)").val(){else}$("#buy_block").find("input[name=id_product]:eq(0)").val(){/if}],
        
                {/if}
        {if isset($fpf_id)}
                    product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
        {/if}
        {/if}
        {literal}
                };
                return values;
            }
        
            function gup( name, url ) {
                if (!url) url = location.href;
                name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
                var regexS = "[\\?&]"+name+"=([^&#]*)";
                var regex = new RegExp( regexS );
                var results = regex.exec( url );
                return results == null ? null : results[1];
            }
            function init_cust_add_to_cart(tries)
            {
            {/literal}
                if ($('{$custom_add_to_cart|escape:'htmlall':'UTF-8'}').length > 0) {
                console.log('Custom Add To Cart detected');
                $('{$custom_add_to_cart|escape:'htmlall':'UTF-8'}').click(function() {
                    console.log('Custom Add To Cart clicked');
                    pixelCall(getpixelvalueslist($(this)));
                });
                } else {
                    if (tries > 0) {
                        setTimeout(function() { init_cust_add_to_cart(tries-1); }, 250);
                    }
                }
            {literal}
            }
        });
    }
}
</script>
{/literal}
<!-- End Add to cart pixel call -->