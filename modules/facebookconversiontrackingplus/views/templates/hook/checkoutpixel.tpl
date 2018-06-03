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
<!-- Facebook Register Checkout Pixel -->
{literal}
<script type="text/javascript">
// Prevent error throwing on purchases
trackPurchase(10);
function trackPurchase(tries)
{
    if (typeof fbq != 'undefined') {
        fbq('track', 'Purchase', {
            'value':'{/literal}{$ordervars.ordervalue|floatval}{literal}',
            'currency':'{/literal}{$ordervars.currency|escape:'htmlall':'UTF-8'}{literal}',
            'order_id':'{/literal}{$ordervars.order_id|intval}{literal}',
            'num_items':'{/literal}{$ordervars.product_quantity|intval}{literal}',{/literal}
            {if $dynamic_ads}'content_type' : 'product',
            'content_ids' : [{foreach from=$ordervars.product_list item=id_product}'{$id_product|intval}'{if !$id_product@last},{/if}{/foreach}],
            {if isset($fpf_id)}product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
            {/if}{/if}{literal}
        });
        {/literal}
        // ***** {$ordervars.aurl}
        {if isset($ordervars.aurl) && $ordervars.aurl != ''}
        $.ajax('{$ordervars.aurl}');
        {/if}
        {literal}
    } else {
        if (tries > 0) {
            setTimeout(function() { trackPurchase(tries-1) }, 500);
        }
    }
}
</script>
{/literal}
<!-- END Facebook Register Checkout Pixel -->