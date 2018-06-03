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

<!-- Search Pixel Call -->
{if isset($products) && $products}
    <script type="text/javascript">
    var content_ids_list = [{foreach from=$products item=product name=sproducts}'{$id_prefix|escape:'htmlall':'UTF-8'}{$product.id_product|intval}'{if !$smarty.foreach.sproducts.last}, {/if}{/foreach}];
    </script>
{/if}

{literal}
<script type="text/javascript">
fctp_search(10);
function fctp_search(max_tries) {
    if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
        setTimeout(function() {fctp_search(max_tries-1)},500);
    } else {
        $(document).ready(function() {
            fbq('track', 'Search', {
                'search_string' : '{/literal}{if isset($search_query) && $search_query != ''}{$search_query|escape:'htmlall':'UTF-8'}{else}{$search_keywords|escape:'htmlall':'UTF-8'}{/if}',
                content_ids : content_ids_list,
                content_type : 'product',
        {if isset($fpf_id)}
                product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
        {/if}
        
            });
        });
    }
}
</script>
<!-- End Search Pixel Call -->

