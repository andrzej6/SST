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
    <!-- Start Payment Pixel Call -->
    <script type="text/javascript">
    fctp_startPayment(10);
    function fctp_startPayment(max_tries) {
        if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
            setTimeout(function() {fctp_startPayment(max_tries-1)},500);
        } else {
            $(document).ready(function() {
                if ($("#HOOK_PAYMENT").length) {
                    $("#HOOK_PAYMENT a").click(function(e) {
                        fbq('track', 'AddPaymentInfo');
                    });
                } else {
                    $(".payment_module a").click(function(e) {
                        fbq('track', 'AddPaymentInfo');
                    });
                }
                // For onepagecheckout compatibilty
                var tries = 10;
                setTimeout(function() { onePageCheckoutTracking(); }, 1000);
                function onePageCheckoutTracking() {
                    console.log("Entro");
                    if ($("#payment_method_container").length == 1) {
                        console.log("OK");
                        if ($("#btn_place_order").length == 1) {
                            $("#btn_place_order").click(function() {
                                if ($("#payment_method_container .selected").length == 1) {
                                    console.log("click");
                                    fbq('track', 'AddPaymentInfo');
                                }
                            });
                        } else {
                            retry();
                        }
                    } else {
                       retry();
                    }
                    
                }
                function retry() {
                    if (tries > 0) {
                        tries--;
                        setTimeout(function() { onePageCheckoutTracking(); }, 500);
                    }
                }
            });
        }
    }
    </script>
    <!-- End Start Payment Pixel Call -->
    {/literal}