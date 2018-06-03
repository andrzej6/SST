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
{if isset($registeron) && $registeron == 1}
    {literal}
    <!-- Registration Pixel Call -->
    <script type="text/javascript">
    fctp_registration(10);
    function fctp_registration(max_tries) {
        if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
            setTimeout(function() {fctp_registration(max_tries-1)},500);
        } else {
            $(document).ready(function() {
                fbq('track', 'CompleteRegistration', {'content_name' : '{/literal}{l s='Registered Customer' mod='facebookconversiontrackingplus'}{literal}'});
            });
        }
    }
    </script>
    <!-- End Registration Pixel Call -->
    {/literal}
{/if}