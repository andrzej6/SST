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
    <!-- Registration Pixel Call -->
    <script type="text/javascript">
    fctp_addToWishlist(10);
    var fctp_wishlist_act = false;
    function fctp_addToWishlist(max_tries) {
        if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
            setTimeout(function() {fctp_addToWishlist(max_tries-1)},250);
        } else {
            jQuery(document).ready(function() {
                if ($("#wishlist_button").length > 0) {
                    console.log('Has length');
                    $("#wishlist_button").click(function(e) {
                        console.log('click');
                        trackWishlist();
                    });
                }
                if ($("#wishlist_button_nopop").length > 0) {
                    $("#wishlist_button_nopop").click(function(e) {
                        trackWishlist();
                    });
                }
                if ($(".addToWishlist").length > 0) {
                    $(".addToWishlist").click(function(e) {
                        trackWishlist();
                    });
                }
                function trackWishlist() {
                    if (fctp_wishlist_act == false) {
                        fbq('track', 'AddToWishlist');
                        // Prevent duplicates
                        fctp_wishlist_act = true;
                        setTimeout(function() { fctp_wishlist_act = false; }, 500);
                        
                    }
                }
            });
        }
    }
    </script>
    <!-- End Registration Pixel Call -->
{/literal}