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
<!-- Facebook Product Track -->
{literal}
<script type="text/javascript">
var combination = '';
fctp_viewContent(10);
function fctp_viewContent(max_tries) {
    if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
        setTimeout(function() {fctp_viewContent(max_tries-1)},500);
    } else {
        $(document).ready(function() {  
            if ($("#idCombination").length == 1) {
                combination = $("#idCombination").val();
                MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
                
                var observer = new MutationObserver(function(mutations, observer) {
                    // fired when a mutation occurs
                    var combi = $("#idCombination").val();
                    if (combination != combi) {
                        combination = combi;
                        trackViewContent();
                    }
                });
                
                // define what element should be observed by the observer
                // and what types of mutations trigger the callback
                observer.observe(document.getElementById("idCombination"), {
                  subtree: true,
                  attributes: true
                  //...
                });
                $("#idCombination").change(function() {
                    console.log('changed');
        
                });
            }

        trackViewContent();
        
        function trackViewContent() {
            fbq('track', 'ViewContent', {
                content_name : '{/literal}{$name|escape:'htmlall':'UTF-8'}{literal}',
                value : {/literal}{if isset($price)}'{$price|floatval}'{else}{literal}productPrice{/literal}{/if}{literal},
                currency :'{/literal}{$fctp_currency|escape:'htmlall':'UTF-8'}{literal}',
           {/literal}
                {if $dynamic_ads}
                    {if isset($product_id) && $product_id != ''}
                        {if isset($hascombi) && $hascombi == 1 && $combi == 1}
                            /*content_type : 'product_group',*/
                            content_type : 'product',
                            content_ids : ['{$id_prefix|escape:'htmlall':'UTF-8'}' + '{$product_id|intval}' + (combination != '' ? '{$combi_prefix|escape:'htmlall':'UTF-8'}'+combination : '')],
                        {else}
                            content_type : 'product',
                            content_ids : ['{$id_prefix|escape:'htmlall':'UTF-8'}' + '{$product_id|intval}'],
                        {/if}
                    {/if}
                    {if isset($fpf_id)}
                        product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
                    {/if}
                {/if}
        {literal}
                });
            }
        });
    }
}
</script>
{/literal}
<!-- END Facebook Product Track -->
