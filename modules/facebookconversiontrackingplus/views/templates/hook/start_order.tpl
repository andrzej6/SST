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
    {literal}
    <!-- Initiate Checkout Pixel Call -->
    <script type="text/javascript">
    fctp_initiateCheckout(10);
    function fctp_initiateCheckout(max_tries) {
        if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
            setTimeout(function() {fctp_initiateCheckout(max_tries-1)},500);
        } else {
            $(document).ready(function() {
            {/literal}
            {if $page_name == 'order'}{literal}
                if ($(".cart_navigation a.standard-checkout").length) {
                    $(".cart_navigation a.standard-checkout").click(function(e) {
                        fbq('track', 'InitiateCheckout', {'num_items' : '{/literal}{$cart_qties|intval}{literal}','content_name' : '{/literal}{l s='Initiate Checkout' mod='facebookconversiontrackingplus'}{literal}' ,'content_category' : '{/literal}{l s='Checkout' mod='facebookconversiontrackingplus'}{literal}'});
                    });
                }
            {/literal}
            {/if}
            {if $page_name == 'order-opc'}{literal}
                fbq('track', 'InitiateCheckout', {'num_items' : '{/literal}{$cart_qties|intval}{literal}','content_name' : '{/literal}{l s='Initiate Checkout' mod='facebookconversiontrackingplus'}{literal}' ,'content_category' : '{/literal}{l s='Checkout' mod='facebookconversiontrackingplus'}{literal}'});
            {/literal}{/if}
            {if $page_name == 'order_ps_17'}
                {if isset($pcart) && $pcart != ''}
                var items = [{$pcart nofilter}]; {* Can't escape as it's a json variable*}
                    values = {
                        'content_ids' : items,
                        'num_items' : items.length,
                        'content_name' : '{l s='Initiate Checkout' mod='facebookconversiontrackingplus'}',
                        'content_category' : '{l s='Checkout' mod='facebookconversiontrackingplus'}'
                    };
                    fbq('track', 'InitiateCheckout', values);
                /*}*/
                {/if}
            {/if}

            });
        }
    }
    </script>
    <!-- End Initiate Checkout Pixel Call -->