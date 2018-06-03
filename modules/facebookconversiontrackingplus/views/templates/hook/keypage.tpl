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
{if $pixels_1|count > 0}
{assign var="keypagecount" value=0}
    <!-- Facebook Keypage -->
    {literal}
    <script type="text/javascript">
    fctp_keyPage(10);
    function fctp_keyPage(max_tries) {
        if (typeof jQuery == 'undefined' || typeof fbq != 'function') {
            setTimeout(function() {fctp_keyPage(max_tries-1)},500);
        } else {
            $(document).ready(function() {
                {/literal}
                {foreach from=$pixels_1 item=pixel1}
                    {if $extras_types[$pixel1.pixel_extras_type] == $page_name}
                        {if isset($product_id)}
                            {if $product_id == $pixel1.pixel_extras}
                                trackCode('{$entityname|escape:'htmlall':'UTF-8'}','{$entityprice|escape:'htmlall':'UTF-8'}');
                                {$keypagecount++|intval}
                            {/if}
                        {else}
                            {if $page_name == 'index' && $pixel1.pixel_extras_type == 1}
                                trackCode('{l s='Home page' mod='facebookconversiontrackingplus'}');
                                {$keypagecount++|intval}
                            {/if}
                            {if $page_name == 'contact' && $pixel1.pixel_extras_type == 5}
                                trackCode('{l s='Contact page' mod='facebookconversiontrackingplus'}');
                                {$keypagecount++|intval}
                            {/if}
                        {/if}
                    {/if}
                {/foreach}
                {if $keypagecount > 0}
                {literal}
                function trackCode(pagename,price) {
                    fbq('track', 'ViewContent', {
                        content_name : pagename,
                        content_type : 'product',
                        {/literal}
                        {if $entityprice != ''}
                        value : price,
                        {/if}
                        {if $dynamic_ads}
                        {if isset($product->id) && $product->id != ''}
                        'content_type' : 'product',
                        'content_ids' : ['{$id_prefix|escape:'htmlall':'UTF-8'}'+'{$product_id|intval}'],
                        {/if}
                        {/if}
        {if isset($fpf_id)}
                        product_catalog_id :  '{$fpf_id|escape:'htmlall':'UTF-8'}',
        {/if}
        
                        {literal}
                        
                        });
                }
                {/literal}
                {/if}
            });
        }
    }
    </script>
    <!-- End Facebook Keypage -->
{/if}