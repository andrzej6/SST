{assign var='product1' value=Product::getCover(24)}
{capture name='path'}
    Special Offers
{/capture}



<div class="specials-pic"><img src="{$img_dir}/mypic/offers.png" /></div>
<div style="clear: both;"></div>


<h1 class="bluefont">{l s='Special Offers'}</h1>


<div class="contact-us-additional">
    <div style="line-height: 20px;">Our <strong>Special Offers</strong> are subject to product availability and conditions may apply.<br/>
    It is only possible to use ONE voucher code with EACH purchase.
	</div>
	
    It is our responsibility to make sure you get the <strong>best offers available</strong>. Please contact us if you have any questions:
    <br/>

    <span  class="wpicon wpicon-envelop medium ic-red"></span>&nbsp;&nbsp;<span id="email_hidden1"><b>@</b></span> &nbsp;&nbsp;
    <span class="wpicon wpicon-phone medium2 ic-blue"></span>&nbsp;&nbsp;<span class="contact-phone phone-large"> 0333 22 00 375 </span>
</div>
<br/>

<div style="clear:both;"></div>




{foreach from=$special_prod key=header item=list}

    <div class="freetrial-col">
        <div class="freetrial-product" style="margin-bottom: 10px;">
            <a href="{$list['toplink']}" class="shown img-wrapper yy-red" title="{$list['toptext']}">
                {$list['toptext']}</a>
        </div>


        <div class="freetrial-pic" style="margin-bottom: 10px">

            <a href="{$list['toplink']}" class="shown img-wrapper" title="{$list['toptext']}">
                <img id="thumb_276" class="white-border-3px" src="https://sit-stand.com/modules/blockoffers/views/img/{$list['simage']}" width="200"
                     alt="{$list['toptext']}" title="{$list['toptext']}" />
            </a>
        </div>

        <div class="freetrial-description">
            {if !empty($list['bottomtext'])} {$list['bottomtext']}{else}&nbsp; {/if}
        </div>

        <div class="contact-us-additional1">
            <span class="button-1 fill blue"><a href="{$list['buttonlink']}">{$list['buttontext']}</a></span>
        </div>
    </div>
    {* {if $header==4}<div class="clear"></div>{/if} *}

{/foreach}


<div class="clear"></div>
<br/>

<div class="contact-us-additional">
    Please note that we are not able to provide any discounts or offers with purchases of <strong>Varidesk</strong> or <strong>Ergotron</strong>.
</div>