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
<!-- Enable Facebook Pixels -->
{literal}
<script>
facebookpixelinit(10);
function facebookpixelinit() {
    if (typeof fbq != 'function') {
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','//connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{/literal}{$fctpid|escape:'htmlall':'UTF-8'}{literal}');

        // Code to avoid multiple pixels call
        // Used to make it compatible with onepagecheckout
        if (typeof window.fbq_pageview == 'undefined') {
            console.log('Header initialized');
            fbq('track', 'PageView');
            window.fbq_pageview = 1;
        }
    } else {
        if (tries > 0) {
            setTimeout(function() { facebookpixelinit(tries-1); }, 200);
        } else {
            console.log('Failed to load the Facebook Pixel');
        }
    }
}
</script>
{/literal}
<!-- End Enable Facebook Pixels -->