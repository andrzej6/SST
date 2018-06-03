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
{if isset($oldps) && $oldps == 1}
<fieldset id="configuration_fieldset">
<legend>{l s='Basic module information' mod='facebookconversiontrackingplus'}</legend>
{else}
<div id="fcp" class="panel">
<div class="panel-heading"><i class="icon-facebook"> </i> {l s='Basic module information' mod='facebookconversiontrackingplus'}</div>
{/if}
    <div class="col-lg-6">
    <h2>{l s='How this module works?' mod='facebookconversiontrackingplus'}</h2>
    <p>To start tracking conversions and start growing your custom audience you just have to follow one of those steps</p>
    <p>&nbsp;</p>
        <h4>1.- {l s='On Facebook Ads Manager' mod='facebookconversiontrackingplus'}</h4>
        <p>1.1 {l s='To get it go to' mod='facebookconversiontrackingplus'} <a href="https://www.facebook.com/ads/manager/pixel/facebook_pixel/" title="{l s='Get Facebook Pixel\'s ID' mod='facebookconversiontrackingplus'}"> {l s='Facebook\'s Pixel Manager' mod='facebookconversiontrackingplus'}</a> {l s='and find the pixel id on the right sidebar of the screen, below your account name.' mod='facebookconversiontrackingplus'}</p>
        <p>1.2 {l s='Copy and paste the code on the form below and save' mod='facebookconversiontrackingplus'}</p>
        <p>&nbsp;</p>
        <h4>2.- {l s='On Facebook Power Editor' mod='facebookconversiontrackingplus'}</h4>
        <p>2.1 {l s='Go to' mod='facebookconversiontrackingplus'} <a href="https://www.facebook.com/ads/manage/powereditor"> {l s='Facebook\'s Power Editor' mod='facebookconversiontrackingplus'}</a></p>
        <p>2.2 {l s='Click on Tools -> Pixels' mod='facebookconversiontrackingplus'}.</p>
        <p>2.3 {l s='Find the pixel id on the right sidebar of the screen, below your account name.' mod='facebookconversiontrackingplus'}</p>
        <p>2.4 {l s='Copy and paste the code on the form below and save' mod='facebookconversiontrackingplus'}</p>
    </div>
    <div class="col-lg-6">
        <h2>{l s='How to use the Custom Audiences?' mod='facebookconversiontrackingplus'}</h2>
        <h4>{l s='There are two types of Audiences, Visitors and Customers' mod='facebookconversiontrackingplus'}</h4>
        <p><strong>{l s='Visitors' mod='facebookconversiontrackingplus'}: </strong>{l s='After setting you Pixel\'s ID Facebook will start building your audience to be used later in your remarketing / retargeting campaigns' mod='facebookconversiontrackingplus'}.</p>
        <p>{l s='Your audicences will grow with every visit on your website (if they are logged to Facebook)' mod='facebookconversiontrackingplus'}.</p>
        <p>{l s='Once your audience has grown enough you can start creating your own Custom Audiences, from your Audience data. You can create a big Audience or create a specific audience (for exemple people who have visited the XXX category). You can create as many Custom Audiences as you wisah to have. To do that you should go to Ads Manager > Tools > Audiences' mod='facebookconversiontrackingplus'}.</p>
        <p>{l s='After having created the audiences you can use them in the campaign creation on the "Audiences" section' mod='facebookconversiontrackingplus'}.</p>
        <p>{l s='There is algo a special feature called Lookalike audiences that creates an audience by selecting people with the same habits and behaviours as your Audiences, letting you focus on advertising to you potential customers' mod='facebookconversiontrackingplus'}.</p>
        <p>{l s='You can find more information on' mod='facebookconversiontrackingplus'} <a href="https://www.facebook.com/business/help/341425252616329" target="_blank" title="{l s='What are the custom audiences' mod='facebookconversiontrackingplus'}">{l s='Facebook' mod='facebookconversiontrackingplus'}</a></p>
        <p>&nbsp;</p>
        <p><strong>{l s='Customers' mod='facebookconversiontrackingplus'}: </strong>{l s='Export your costumers to a CSV file and import it later to Facebook' mod='facebookconversiontrackingplus'}.</p>
        <ul>
             <li><a href="{$myurl|escape:'htmlall':'UTF-8'}&typexp=1&token={$mytoken|escape:'htmlall':'UTF-8'}">{l s='Export Customers' mod='facebookconversiontrackingplus'}</a></li>
        {if $newsletter == 1}
            <li><a href="{$myurl|escape:'htmlall':'UTF-8'}&typexp=2&token={$mytoken|escape:'htmlall':'UTF-8'}">{l s='Export Newsletter Users' mod='facebookconversiontrackingplus'}</a></li>
            <li><a href="{$myurl|escape:'htmlall':'UTF-8'}&typexp=3&token={$mytoken|escape:'htmlall':'UTF-8'}">{l s='Export All' mod='facebookconversiontrackingplus'}</a></li>
        </ul>
        {else}
        </ul>
        <p>{l s='If you enable and use BlockNewsletter module from Prestashop you will also be able to export your newsletter users to make an Audience' mod='facebookconversiontrackingplus'}</p>{/if}
    </div>
    <div class="clearfix"></div>
    </div>
{if isset($oldps) && $oldps == 1}
<fieldset id="configuration_fieldset">
<legend>{l s='Test Pixels' mod='facebookconversiontrackingplus'}</legend>
{else}
    <div id="fcp2" class="panel">
    <div class="panel-heading"><i class="icon-facebook"> </i> {l s='Test Pixels' mod='facebookconversiontrackingplus'}</div>
{/if}
    <div class="col-lg-12">
        <h2>{l s='Testing Pixels' mod='facebookconversiontrackingplus'}</h2>
        <p>{l s='To test pixels you should install Pixel Helper, an extension for Google Chrome' mod='facebookconversiontrackingplus'}. {l s='This extension can tell you what information is being passed to Facebook from your pixels' mod='facebookconversiontrackingplus'}.</p>
        <p>{l s='Most of the events fire immediately a pixel once the page loads, but there are two special cases' mod='facebookconversiontrackingplus'} AddToCart {l s='and' mod='facebookconversiontrackingplus'} AddToWhishlistTo {l s='If you activate the tracking for those events, and you have ajax enabled you will see a red message on Pixel Helper saying' mod='facebookconversiontrackingplus'} "Facebook Pixel did not load" {l s='that\'s because nobody added any product to the cart/wishlist yet' mod='facebookconversiontrackingplus'} .{l s='once you hit the add to cart / whishlist button the message will problably turn blue saying' mod='facebookconversiontrackingplus'} "Facebook Pixel took too long to load" {l s=' thats because it took the time the user needed to hit the button' mod='facebookconversiontrackingplus'}.</p>
        <p>{l s='So either a green or a blue message is a success message from Facebook and all necessary information has been passed to it' mod='facebookconversiontrackingplus'}.</p>
    <p>{l s='You may need to spend some time until Facebook verifies your pixels, ex. waiting for a conversion, fire an add to cart event' mod='facebookconversiontrackingplus'}... {l s='Here you can send test pixels to Facebook' mod='facebookconversiontrackingplus'}</p>
    {if $pixelsetup}
    <ul id="test_pixels">
    <li><a href="#" class="firePixel" data-type="ViewContent">ViewContent</a></li>
    <li><a href="#" class="firePixel" data-type="Purchase">Purchase</a></li>
    <li><a href="#" class="firePixel" data-type="Search">Search</a></li>
    <li><a href="#" class="firePixel" data-type="AddToCart">AddToCart</a></li>
    <li><a href="#" class="firePixel" data-type="AddToWishlist">AddToWishlist</a></li>
    <li><a href="#" class="firePixel" data-type="InitiateCheckout">InitiateCheckout</a></li>
    <li><a href="#" class="firePixel" data-type="AddPaymentInfo">AddPaymentInfo</a></li>
    <li><a href="#" class="firePixel" data-type="CompleteRegistration">CompleteRegistration</a></li>
    </ul>
    
    <p>{l s='We do recommend installing' mod='facebookconversiontrackingplus'} <a href="https://chrome.google.com/webstore/detail/fb-pixel-helper/fdgfkebogiimcoedlicjlajpkdmockpc" target="_blank">Pixel Helper</a> {l s='for Google Chrome to test Facebook Pixels. Also note that pixels won\'t reflect immediatlely on your Facebook account, it may take some time' mod='facebookconversiontrackingplus'} ({l s='between 1 and 2 hours' mod='facebookconversiontrackingplus'}).</p>

    <!-- Basic Pixel Loading -->
    <style>
    #test_pixels {
        display:block;
        width:100%;
        padding:0;
        margin-top:20px;
    }
    #test_pixels li {
        display:inline-block;
    }
    #test_pixels li a {
        padding: 10px 16px;
        margin: 0 2px;
        border-radius: 3px;
        border: 1px solid #ccc;
        text-align: center;
        line-height: 50px;
    }
    #test_pixels li a:hover, .fired {
        background:#00aff0;
        color:#fff !important;
    }
    </style>
    <script>
    {literal}
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','//connect.facebook.net/en_US/fbevents.js');
    fbq('init', '{/literal}{$fctpid|escape:'htmlall':'UTF-8'}{literal}');
    fbq('track', 'PageView');
    $(document).ready(function() {
        var number = 1;
        $('#fcp2').after('<div id="fb_messages" style="position:absolute; left:35%; width:50%; z-index:100;"></div>');
        $(".firePixel").click(function(e) {
            var type = $(this).data('type');
            var values = [];
            values['content_name'] = type+' test';
            values['content_type'] = 'product';
            if (type != 'CompleteRegistration') {
                values['content_ids'] = [1,2,3,4];
            }
            if (type == 'Purchase') {
                values['num_items'] = '100';
            }
            if (type == 'Search') {
                values['search_string'] = '{/literal}{l s='This is an example of a search' mod='facebookconversiontrackingplus'}{literal}';
            }
            values['value'] = 1;
            values['currency'] = 'EUR';
            fbq('track', type, values);;
            e.preventDefault();

            $("#fb_messages").append('<div id="fb_message_'+number+'" class="module_confirmation conf confirm alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'+type+' {/literal}{l s='Pixel Fired' mod='facebookconversiontrackingplus'}{literal}</div>');
            $("#fb_message_"+number).delay(1500).fadeOut(500);
            number++;
            $(this).addClass('fired');
        });
    }); 
    {/literal}
    </script>
    {else}
    <p>{l s='Insert a Facebook Pixel ID to be able to test the pixels' mod='facebookconversiontrackingplus'} </p>
    {/if}
    </div>
    <div class="clearfix"></div>
    </div>
{if isset($oldps)}
</fieldset>
<br />
<br />
<br />
<br />

{else}
</div>
{/if}