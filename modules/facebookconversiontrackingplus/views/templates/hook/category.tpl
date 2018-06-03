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
{if isset($products) && $products}
<!-- Facebook ViewCategory event tracking -->
{if isset($top_sell_ids) && $top_sell_ids}
    <script type="text/javascript">
    var content_ids_list = [{foreach from=$top_sell_ids item=product name=top_sell}{if $smarty.foreach.top_sell.iteration < $max_cat_items}'{$id_prefix|escape:'htmlall':'UTF-8'}{$product.product_id|intval}',{/if}{/foreach}];
    </script>
{else}
    <script type="text/javascript">
    var content_ids_list = [{foreach from=$products item=product name=products}{if $smarty.foreach.products.iteration < $max_cat_items}'{$id_prefix|escape:'htmlall':'UTF-8'}{$product.id_product|intval}',{/if}{/foreach}];
    </script>
{/if}
{literal}
<script type="text/javascript">
var combination = '';
fctp_categoryView(10);
function fctp_categoryView(max_tries) {
    if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
        setTimeout(function() {fctp_categoryView(max_tries-1)},500);
    } else {
        jQuery(document).ready(function() {
                fbq('track', 'ViewCategory', {
                    content_name : '{/literal}{$name|escape:'htmlall':'UTF-8'}{literal}',
               {/literal}
                    {if $dynamic_ads}
                        content_type : 'product',
                        content_ids : content_ids_list,
                    {if isset($fpf_id)}
                        product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
                    {/if}
                    {/if}
            {literal}
                    });
        });
    }
}
</script>
{/literal}
<!-- END Facebook ViewCategory event tracking -->
{/if}

