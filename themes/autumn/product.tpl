{*

* 2007-2014 PrestaShop

*

* NOTICE OF LICENSE

*

* This source file is subject to the Academic Free License (AFL 3.0)

* that is bundled with this package in the file LICENSE.txt.

* It is also available through the world-wide-web at this URL:

* http://opensource.org/licenses/afl-3.0.php

* If you did not receive a copy of the license and are unable to

* obtain it through the world-wide-web, please send an email

* to license@prestashop.com so we can send you a copy immediately.

*

* DISCLAIMER

*

* Do not edit or add to this file if you wish to upgrade PrestaShop to newer

* versions in the future. If you wish to customize PrestaShop for your

* needs please refer to http://www.prestashop.com for more information.

*

*  @author PrestaShop SA <contact@prestashop.com>

*  @copyright  2007-2014 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)

*  International Registered Trademark & Property of PrestaShop SA

*}

{include file="$tpl_dir./errors.tpl"}

{if $errors|@count == 0}

	{if !isset($priceDisplayPrecision)}

		{assign var='priceDisplayPrecision' value=2}

	{/if}

	{if !$priceDisplay || $priceDisplay == 2}

		{assign var='productPrice' value=$product->getPrice(true, $smarty.const.NULL, $priceDisplayPrecision)}

		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}

	{elseif $priceDisplay == 1}

		{assign var='productPrice' value=$product->getPrice(false, $smarty.const.NULL, $priceDisplayPrecision)}

		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(true, $smarty.const.NULL)}

	{/if}

	
	
	

	{* my customization here assign new variable with price inc tax*}

	{assign var='productPriceIncVat' value=$product->getPrice(true, $smarty.const.NULL, $priceDisplayPrecision)}
	
	
	
	{assign var='productPriceWithoutReductionIncVat' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}





    <!-- Primary Block -->

	<div class="primary_block row" itemscope itemtype="http://schema.org/Product">


		{if isset($adminActionDisplay) && $adminActionDisplay}

			<div id="admin-action">

				<p>{l s='This product is not visible to your customers.'}

					<input type="hidden" id="admin-action-product-id" value="{$product->id}" />

					<input type="submit" value="{l s='Publish'}" name="publish_button" class="exclusive" />

					<input type="submit" value="{l s='Back'}" name="lnk_view" class="exclusive" />

				</p>

				<p id="admin-action-result"></p>

			</div>

		{/if}



		{if isset($confirmation) && $confirmation}

			<p class="confirmation">

				{$confirmation}

			</p>

		{/if}



		<!-- Left Column -->

		<div class="pb-left-column column col-5-12">



			<!-- Image -->

			<div id="image-block" class="white-border-6px">



                {if $product->show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}

                    <!-- Tags -->

                    <div class="image-tags">

                        {*
                        {if ($product->name|in_array:['Freedesk','Swoppster'])}
                        <div class="new">{l s='SPECIAL OFFER'}</div>
                        *}

                        {if ($product->new) or ($product->name|in_array:['QuickStand ECO']) }
                            <div class="new">{l s='New'}</div>

                        {elseif ($product->name|in_array:['DeskPro 1','DeskPro 2X','Muvman Stool','IMPRINT Deluxe Mat',
                        'Hush Desk','Yo-Yo Desk MINI','Yo-Yo Desk 90','Yo-Yo Desk GO1', 'Yo-Yo Desk GO2','Yo-Yo Mat'])}
                            <div class="bestseller">{l s='Best Seller'}</div>


                        {elseif $product->on_sale}
                            <!-- On sale -->
                            <div class="on_sale">{l s='On sale'}</div>


                        {elseif $product->specificPrice && $product->specificPrice.reduction && $productPriceWithoutReduction > $productPrice }
                            <!-- Discount -->
                            <div class="discount">{l s='REDUCED'}</div>


                        {elseif $product->online_only}
                            <!-- Online only -->
                            <div class="online_only">{l s='Online only'}</div>

                        {/if}

                    </div>

                {/if}







                {if $have_image}

                    <div id="view_full_size">

                        {if $jqZoomEnabled}

                            <img id="imageZoom" itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'atmn_large')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name}{/if}" data-wpzoom="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'atmn_xlarge')|escape:'html'}"/>

                        {else}

                            <a class="fancybox-trigger" href="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'atmn_large')|escape:'html':'UTF-8'}">

                                <img id="bigpic" itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'atmn_large')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name}{/if}" />

                            </a>

                        {/if}

                    </div>

                {else}

                    <div id="view_full_size">

                        <img id="bigpic" itemprop="image" src="{$img_prod_dir}{$lang_iso}-default-atmn_large.jpg" alt="" title="{$product->name}" />

                    </div>

                {/if}

			</div>



			{if isset($images) && count($images) > 0}

				<!-- Thumbnails -->

                <div id="views_block" class="clearfix {if isset($images) && count($images) < 2}hidden{/if}">

                    <div id="thumbs_list">

                        <ul id="thumbs_list_frame" class="grid carousel-grid owl-carousel">

                            {if isset($images)}

                                {foreach from=$images item=image name=thumbnails}




                                    {assign var=imageIds value="`$product->id`-`$image.id_image`"}

                                    {if !empty($image.legend)}

                                        {assign var=imageTitle value=$image.legend|escape:'htmlall':'UTF-8'}

                                    {else}

                                        {assign var=imageTitle value=$product->name|escape:'htmlall':'UTF-8'}

                                    {/if}

                                    <li id="thumbnail_{$image.id_image}" class="item">

                                        {if $jqZoomEnabled}

                                            <a href="#" class="{if $smarty.foreach.thumbnails.first}shown{/if} img-wrapper" title="{$imageTitle}">

                                                <img id="thumb_{$image.id_image}" class="white-border-3px" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'atmn_xsmall')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}" data-src="{$link->getImageLink($product->link_rewrite, $imageIds, 'atmn_large')|escape:'html':'UTF-8'}" data-wpzoom="{$link->getImageLink($product->link_rewrite, $imageIds, 'atmn_xlarge')|escape:'html':'UTF-8'}" />

                                            </a>

                                        {else}

                                            <a href="{$link->getImageLink($product->link_rewrite, $imageIds, 'atmn_large')|escape:'html':'UTF-8'}" data-fancybox-group="other-views" class="{if $smarty.foreach.thumbnails.first}shown{/if} img-wrapper fancybox no-wpzoom" title="{$imageTitle}">

                                                <img id="thumb_{$image.id_image}" class="white-border-3px" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'atmn_xsmall')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}" data-src="{$link->getImageLink($product->link_rewrite, $imageIds, 'atmn_large')|escape:'html':'UTF-8'}" data-wpzoom="{$link->getImageLink($product->link_rewrite, $imageIds, 'atmn_xlarge')|escape:'html':'UTF-8'}" />

                                            </a>

                                        {/if}

                                    </li>

                                {/foreach}

                            {/if}

                        </ul>

                    </div>

                </div>

			{/if}



			{if isset($images) && count($images) > 1}

				<p class="resetimg clear no-print">

					<span id="wrapResetImages" style="display: none;">


                        <a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" name="resetImages">
                        <span class="wpicon wpicon-image medium"></span>

						<a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" name="resetImages">{l s='Display all pictures'}</a>

					</span>

				</p>

			{/if}


		<div>



		<div style="clear:both;"></div>

		</div>







					

					   
					   
					    <!-- OUR ADVICE -->

		{if ($category->name)=='Desk Risers'}

            <div style="clear: both;"></div>
            <div class="riser-advice">

            {if ($product->name|in_array:['Yo-Yo Desk MINI', 'Yo-Yo Desk 90', 'Yo-Yo Desk 120'])}

            <strong>OUR ADVICE</strong>:
            {if ($product->name=='Yo-Yo Desk MINI')}Yo-Yo Desk&reg; MINI
                {elseif ($product->name=='Yo-Yo Desk 90')}Yo-Yo Desk&reg; 90
                {elseif ($product->name=='Yo-Yo Desk 120')}Yo-Yo Desk&reg; 120
            {/if}
            is suitable for users below 180cm or 5' 11'' tall when placed upon
            a standard height desk (72cm). For users above 180cm (and up to 200cm) we suggest using a
                 {if ($product->name)=='Yo-Yo Desk MINI'}
                     <a href="https://sit-stand.com/desk-risers/155-yo-yo-desk-go1.html" target="_blank" class="yy-red yy-uline">
                         Yo-Yo Desk&reg; GO</a><sup>1</sup>.
                     {else}
                     <a href="https://sit-stand.com/desk-risers/156-yo-yo-desk-go1.html" target="_blank" class="yy-red yy-uline">
                         Yo-Yo Desk&reg; GO</a><sup>2</sup>.
                 {/if}
            Need help? Please call us.

            {elseif ($product->name|in_array:['Varidesk Pro 30','Varidesk Pro Plus 30', 'Varidesk Pro 36',
            'Varidesk Pro Plus 36', 'WorkFit-T'])}

                <strong>OUR ADVICE</strong>: {$product->name} is not suitable for users above 180cm or 5' 11'' tall when placed upon a
                standard height desk (72cm). For users above 180cm (and up to 200cm) we suggest using a
                {if ($product->name|in_array:['Varidesk Pro 30', 'Varidesk Pro Plus 30'])}
                    <a href="https://sit-stand.com/desk-risers/155-yo-yo-desk-go1.html" target="_blank" class="yy-red yy-uline">
                        Yo-Yo Desk&reg; GO<sup>1</sup></a>.
                {else}
                    <a href="https://sit-stand.com/desk-risers/156-yo-yo-desk-go1.html" target="_blank" class="yy-red yy-uline">
                        Yo-Yo Desk&reg; GO<sup>2</sup></a>.
                {/if}
                Need help? Please call us.


            {elseif ($product->name|in_array:['Yo-Yo Desk GO1', 'Yo-Yo Desk GO2']) }
            <span class="yy-red"><strong>OUR ADVICE: </strong>Yo-Yo Desk<sup>&reg;</sup> GO is suitable for users up to
                193cm or 6' 4'' tall when placed upon a standard height desk (72cm). Need help? Please call us.
            </span>


            {/if}
          </div>


        {elseif ($product->name)== "DeskPro 1"}
        <div style="clear: both;"></div>
        <div class="riser-advice">
            <strong>OUR ADVICE: </strong>DeskPro 1&trade; is suitable for users below 180cm or
            5' 11'' tall. For users above 180cm (and up to 210cm) we suggest a
            <a href="https://sit-stand.com/electric-desks/95-desk-pro2x.html" target="_blank"
               class="yy-red yy-uline">DeskPro 2X&trade; </a>
            or
            <a href="https://sit-stand.com/electric-desks/147-deskpro-s.html" target="_blank"
               class="yy-red yy-uline">DeskPro S&trade;</a>.
            Need help? Please call us.

        </div>


        {/if}
					   
					   
					   


			         {if ($product->name|in_array:['Swopper CLASSIC', 'Swopper STANDARD', 'Swopper AIR',
                     'Swopper SADDLE','Swopper WORK'])}
                            <div style="margin-top: 20px">

                             <div class="yy-red yy-bold">SWOPPER RANGE:</div>

                             <div class="yy-blue"><a href="{$link->getProductLink(113)}">Swopper STANDARD</a></div>
                             <div class="yy-blue"><a href="{$link->getProductLink(112)}">Swopper CLASSIC</a></div>
                             <div class="yy-blue"><a href="{$link->getProductLink(115)}">Swopper AIR</a></div>
                             <div class="yy-blue"><a href="{$link->getProductLink(116)}">Swopper SADDLE</a></div>
                             <div class="yy-blue"><a href="{$link->getProductLink(117)}">Swopper WORK</a></div>

                            </div>

							 {elseif ($product_manufacturer->name)=='Holmris'}
                         <div style="margin-top: 20px">

                             <div class="yy-red yy-bold">HOLMRIS RANGE:</div>

                             <div class="yy-blue"><a href="{$link->getProductLink(27)}">XTable</a></div>
                             <div class="yy-blue"><a href="{$link->getProductLink(35)}">H4 Desk</a></div>
                             <div class="yy-blue"><a href="{$link->getProductLink(64)}">Genese Desk</a></div>
                             <div class="yy-blue"><a href="{$link->getProductLink(32)}">Milk Desk</a></div>

                         </div>

			        {/if}

					
					<div id="d-interaction">

					   <!-- hook_extra_left -->
					     {if $HOOK_EXTRA_LEFT}{$HOOK_EXTRA_LEFT}{/if}
                       <!-- End - hook_extra_left -->


			      </div>





		</div>

		<!-- End - Left Column -->














		<!-- Center Column -->


        <!-- Manufacturer LOGO -->
		<div id="prod-center-column" class="pb-center-column column col-4-12">

        {if ($product_manufacturer->id_manufacturer) }
            <a href="{$link->getmanufacturerLink($product_manufacturer->id_manufacturer, $product_manufacturer->link_rewrite)|escape:'htmlall':'UTF-8'}"
            title="{$product_manufacturer->name}">


                     <div class="prod-manu-pic">

                         {if ($product->name|in_array:['Yo-Yo Desk GO1','Yo-Yo Desk GO2'])}
                            <img src="{$base_dir_ssl}/img/m/yoyogo.jpg" alt="{$product_manufacturer->name}"/>

                         {elseif ($product->name|in_array:['Yo-Yo Mat'])}
                             <img src="{$base_dir_ssl}/img/m/yoyomat.jpg" alt="{$product_manufacturer->name}"/>
                         {else}

                          <img src="{$base_dir_ssl}/img/m/{$product_manufacturer->id_manufacturer}-manu-default.jpg"
                            alt="{$product_manufacturer->name}"/>
                         {/if}


                           {if ($product->name|in_array:['Muvman Stool'])}
                             <img src="{$img_dir}/mypic/muvman-1.png" />

                           {/if}

                    </div>



            </a>

        {/if}




			<h1 itemprop="name">{$product->name}</h1>



			{if $product->description_short || $packItems|@count > 0}

            <!-- Product description -->

				  <div id="short_description_block">

					   {if $product->description_short}

						      <div id="short_description_content" class="rte align_justify" itemprop="description">


                                  <!-- PRE SHORT DESCRIPTION TEXT -->
                                  {if ($product->name|in_array:['IMPRINT Deluxe Mat', 'IMPRINT Standard Mat',
                                  'Freedesk Deluxe','Freedesk', 'Steppie']) 
                                  }
                                      <p class="yy-blue yy-bold" style="text-align:left;font-size: 10px;margin-bottom: 10px;">
                                          *Sit-Stand.Com is the EXCLUSIVE

                                      {if ($product->name|in_array:['IMPRINT Deluxe Mat', 'IMPRINT Standard Mat'])}
                                               EU Distributor of Imprint® Mats<br/>(Standard and Deluxe)

                                      {elseif ($product->name|in_array:['Freedesk Deluxe','Freedesk'])}
                                               UK / IRL Distributor of Freedesk®

                                      {elseif ($product->name) =='Steppie'}
                                               UK / IRL Distributor of Steppie®
                                      {/if}
                                      </p>

                                  {/if}

						      {$product->description_short}
							  
							  


							       <!-- FREE TRIAL / VOUCHERS RESTRICTIONS , ALSO DELIVERY FOR HOLMRIS PRODUCTS-->

                                  {if ($product_manufacturer->name|in_array:['Fellowes','Metalicon','Colebrook Bosson Saunders','Lifespan','Varidesk','Ergotron' ])}

                                  <p class="yy-red yy-bold" style="margin:10px 0px">
								  {$product_manufacturer->name|upper} items do <u>not</u> qualify for Free Trial
                                      {if ($product_manufacturer->name|in_array:['Varidesk','Ergotron' ])} or Voucher Codes. {else}. {/if}
                                        Once ordered this item may only be returned in the unlikely case that it is faulty.
                                  </p>


                                  {elseif ($product->name|in_array:['XTable', 'H4 Desk', 'Genese Desk', 'Milk Classic',
                                  'Milk Grande', '4Milk'])}
                                      <p style="margin:15px 0px" class="yy-red">
                                        <span>UK Mainland delivery takes 4 - 5 weeks. </span>
                                          <br/><br/>
                                        <span>
                                            This product will be delivered on a pallet. Customer is required to store the
                                            items for a further 3 working days until our installer arrives at your premises.
                                        </span>
                                        <br/><br/>
                                        <span class="yy-bold">Delivery and Installation costs £100 ex VAT.</span>
                                      </p>

                                      {elseif substr_count($product->name, 'Swopper')== 1}
                                  <p style="margin:15px 0px" class="yy-red">
                                      <span><strong>EU / UK DELIVERY £12.50 ex VAT.</strong> {*10 - 15 working days *}4 - 6 weeks </span><br/><br/>
                                      <span class="yy-bold">Free Trial offer of Swopper subject to colour availability. <br/>Please call us for details.</span>
                                  </p>


                                  {/if}
								  
								  {if (isset($ad_extrafields['ad_extrafield1']) && !empty($ad_extrafields['ad_extrafield1']))}
								  <div style="margin:15px 0px;">
							         {$ad_extrafields['ad_extrafield1']}
								  </div>	 
							      {/if}


                                  {if ($category->name|in_array:['Desk Risers', 'Electric Desks', 'Manual Lift']) || ($product->name=='Yo-Yo Mat')}

                                      <div style="margin:15px 0px;">
									  
									      {if ($product->name|in_array:['Yo-Yo Mat','Yo-Yo Desk GO1', 'Yo-Yo Desk GO2'])}
										
										  <a href="https://sit-stand.com/free-mat-offer" class="yy-bold yy-uline yy-blue">FREE Yo-Yo Mat® (Large)</a>&nbsp;&nbsp;
										  <a href="https://sit-stand.com/free-mat-offer" class="yy-bold yy-uline yy-blue">(SAVE £71.94)</a>
										  &nbsp;&nbsp;| <a href="https://sit-stand.com/free-mat-offer" class="yy-bold yy-uline yy-blue"> Offer Terms</a>

										  
										  
										  
                                           
										  {else}
											  <a href="https://sit-stand.com/standard-comfort-mats/164-yo-yo-mat.html" class="yy-bold yy-uline yy-darkgrey">Anti-Fatigue Mat</a> |
											  
											  {if ($product->name|in_array:['Yo-Yo Desk MINI','Yo-Yo Desk 90','Yo-Yo Desk 120','Yo-Yo Desk GO1', 'Yo-Yo Desk GO2','Yo-Yo Desk CUBE']) }
											  <a href="https://sit-stand.com/mat-benefits" class="yy-bold yy-uline yy-red">Free Yo-Yo Mat</a> <span class="yy-red">(SAVE up to £71.94 inc VAT)</span>



                                              {else}
                                          
	                                          <a href="https://sit-stand.com/mat-benefits" class="yy-bold yy-uline yy-darkgrey">Free Mat Offer</a>

                                                  {if ($product->name|in_array:['Yo-Yo Desk PRO 2+','Yo-Yo Desk PRO 2'])}
                                                  <br/><br/><span class="yy-red"><strong>Pre-order by July 31st | Save 25% | Delivery Sept 30th</strong><br/>
                                                        Enter code: <strong>SEP25</strong>. <a href="#" class="yy-uline">Terms and conditions apply</a>.</span>
                                                  {/if}

  										      {/if}
										  {/if}

                                      </div>

                                  {/if}



						      </div>

					   {/if}

				  </div>

      {/if}



			<div id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>

			    <!-- hook_product_oos (out of stock) -->

				{$HOOK_PRODUCT_OOS}

			    <!-- End - hook_product_oos (out of stock) -->

			</div>


			      {if $product->show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}

                  <!-- FREE DELIVERY ICON !!!! IF statement 24 condition allowed only-->
			      {if ($product->name|in_array:['Extension Kit', 'Under Desk Management', 'Basket',
                  'QuickClick - Long Rail', 'Basic Cable Spiral', 'QuickClick - Sleigh', 'Cable Spring',
                  'Liftpipe', 'Wide CPU Holder', 'IMPRINT Standard Mat', 'IMPRINT Deluxe Mat',
                  'Lotus', 'QuickStand', 'QuickStand LITE', 'HAG Capisco Puls 8010','QuickStand ECO']) ||
                      ($category->name|in_array:['CPU Holders', 'Single Screen', 'Double Screen']) }

			               <div id="freedelivery-icon">
			                   <img src="{$img_dir}/mypic/free-delivery.png" />
			                </div>
			      {/if}


                  <!-- PRODUCT WARRANTY ICON -->
			      <div id="product-warrantyicon">
			       {if ($product->name|in_array:['Varidesk Pro 30', 'Varidesk Pro 36', 'Varidesk Pro Plus 30',
                   'Varidesk Pro Plus 36', 'Varidesk Pro Plus 48', 'Stretch Laptop Stand',
                   'Varidesk Pro Plus 36 White','Freedesk Deluxe','Freedesk'])
		                   }
		                        <img src="{$img_dir}/mypic/1Year.png" />

		                   {elseif ($product->name|in_array:['Monitor Arm - CA7', 'Monitor Arm - CA223'])
		                   }
		                       <img src="{$img_dir}/mypic/2Year.png" />

		                   {elseif ($product->name|in_array:['ONGO Classic', 'Muvman Stool', '3Dee', 'DeskPro 1',
                   'DeskPro 2X', 'DeskPro 3X', 'DeskPro 3S', 'MonoPro', 'DeskPro S', 'BenchPro Double Desk',
                   'Swopper CLASSIC', 'Swopper STANDARD', 'Swopper AIR', 'Swopper SADDLE', 'Swopper WORK',
                   'Swoppster', 'Lotus']) ||
                           (($product_manufacturer->name)=='Yo-Yo Desk' && ($product->name) !='Yo-Yo Mat' && ($product->name) !='Yo-Yo Desk PRO 2+')
		                   }
		                       <img src="{$img_dir}/mypic/3year.png" />

		                   {elseif ($product->name|in_array:['Pranamat ECO','IMPRINT Deluxe Mat',
                         'IMPRINT Standard Mat', 'Yo-Yo Mat','UP Stool','LearnFit','HAG Capisco Puls 8010','QuickStand ECO','Steppie SoftTop', 'Steppie'])
                         }
		                       <img src="{$img_dir}/mypic/10year.png" />

		                   {elseif ($product->name|in_array:['Monitor Arm - Flo', 'Monitor Arm - Flo Dual'])
		                   }
		                       <img src="{$img_dir}/mypic/LIFETIME.png" />

		                   {else}
		                       <img src="{$img_dir}/mypic/5year.png" />
		                   {/if}
			      </div>


                  <!-- EXTRA LINAK LOGO -->
			       {if ($product->name|in_array:['Hush Desk','Sohodesk'])}
						   <div id="product-linakl"><a href="http://www.linak.com/"><img src="{$img_dir}/mypic/linak.jpg" width="53" /></a></div>
				   {/if}




                <!-- Prices -->
                <div class="content_prices">

                    {* OFFER scope (schema.org) *}

                    <div class="our_price_display" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                        {if $product->quantity > 0}<link itemprop="availability" href="http://schema.org/InStock"/>{/if}

                        {if $priceDisplay >= 0 && $priceDisplay <= 2}

                            <!-- PRICE INC VAT -->
                            <div id="priceinctax" class="price price-inc">{convertPrice price=$productPriceIncVat} <div class="inc-vat">(Inc VAT)</div></div>


                            <!-- PRICE EX VAT -->
                            <div id="our_price_display" itemprop="price" class="price price-ex">{convertPrice price=$productPrice} <div class="ex-vat">(Ex VAT)</div></div>

                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />



                        {/if}

                    </div>

                    {* END - OFFER scope (schema.org) *}


                   {*
                    <div id="reduction_percent" {if !$product->specificPrice || $product->specificPrice.reduction_type != 'percentage'} style="display:none;"{/if}>

                        <span id="reduction_percent_display">

                            {if $product->specificPrice && $product->specificPrice.reduction_type == 'percentage'}-{$product->specificPrice.reduction*100}%{/if}

                        </span>

                    </div>
                        *}



                    <!-- OLD PRICE SECTION -->
                    <div id="old_price"{if (!$product->specificPrice || !$product->specificPrice.reduction) && $group_reduction == 0} class="hide"{/if}>

                        {if $priceDisplay >= 0 && $priceDisplay <= 2}

                            <span id="old_price_display">
                                {if $productPriceWithoutReduction > $productPrice}

                                        {if $product->specificPrice && $product->specificPrice.reduction_type == 'percentage'}
                                            <strong>SAVE {$product->specificPrice.reduction*100}%</strong>
                                        {/if}
                                        Standard Price {convertPrice price=$productPriceWithoutReduction} (Ex VAT)

                                {/if}
                            </span>

                        {/if}

                    </div>




                    <div id="reduction_amount" {if !$product->specificPrice || $product->specificPrice.reduction_type != 'amount' || $product->specificPrice.reduction|floatval ==0} style="display:none"{/if}>

                        <span id="reduction_amount_display">

                            {if $product->specificPrice && $product->specificPrice.reduction_type == 'amount' && $product->specificPrice.reduction|intval !=0}

                                You save: {convertPrice price=$productPriceWithoutReduction-$productPrice|floatval}

                            {/if}

                        </span>

                    </div>




                    {if $priceDisplay == 2}

                        <span id="pretaxe_price">

                            <span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL)}</span>

                            {l s='tax excl.'}

                        </span>

                    {/if}





                    {*  for pack prizes functionality included *}

                    {if $packItems|@count && $productPrice < $product->getNoPackPrice()}

                        <p class="pack_price" <span class="old-price">{l s='Normal Price'} &nbsp;&nbsp;{convertPrice price=$product->getNoPackPrice()}</span><br/>

                        <span class="yousave">Saving &nbsp; &nbsp;{convertPrice price=$product->getNoPackPrice()-$productPrice}</span>

                        </p>

                    {/if}



                    {if $product->ecotax != 0}

                        <p class="price-ecotax">{l s='Include'} <span id="ecotax_price_display" class="bold">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='for green tax'}

                            {if $product->specificPrice && $product->specificPrice.reduction}

                                <br />{l s='(not impacted by the discount)'}

                            {/if}

                        </p>

                    {/if}



                    {if !empty($product->unity) && $product->unit_price_ratio > 0.000000}

                        {math equation="pprice / punit_price"  pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}

                        <p class="unit-price"><span id="unit_price_display" class="bold">{convertPrice price=$unit_price}</span> {l s='per'} <span class="bold">{$product->unity|escape:'html':'UTF-8'}</span></p>

                    {/if}

                </div>

         {/if}











            {if $PS_STOCK_MANAGEMENT}

                  {if ($product->quantity <= 0 && !$product->available_later && $allow_oosp) || ($product->quantity > 0 && !$product->available_now) || !$product->available_for_order || $PS_CATALOG_MODE}



                  {else}

                    <!-- Stock information -->

                    <div id="availability_statut" class="iconed-text yy-red yy-bold" style="margin-top:10px">

                        <span class="wpicon wpicon-box medium"></span>

                        <span id="availability_value"{if $product->quantity <= 0} class="warning_inline"{/if}>

                            {if $product->quantity <= 0}

                                {if $allow_oosp}

                                    {$product->available_later}

                                {else}

                                    {l s='This product is no longer in stock'}

                                {/if}

                            {else}

                                {$product->available_now}

                            {/if}

                        </span>

                    </div>

                    <div class="iconed-text warning_inline" id="last_quantities"{if ($product->quantity > $last_qties || $product->quantity <= 0) || $allow_oosp || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none"{/if} >

                        <span class="wpicon wpicon-info medium"></span>

                        {l s='Warning: Last items in stock!'}

                    </div>

                    {/if}

            {/if}




            {if ($product->quantity > 0) || !$product->available_for_order || $PS_CATALOG_MODE || !isset($product->available_date) || $product->available_date < $smarty.now|date_format:'%Y-%m-%d'}

            {else}

                <!-- Availablity date -->

                <div id="availability_date" class="iconed-text">

                    <span class="wpicon wpicon-calendar medium"></span>

                    <span id="availability_date_label">{l s='AVAILABLE FROM :'}</span>

                    <span id="availability_date_value" class="bold">{dateFormat date=$product->available_date full=false}</span>

                </div>

            {/if}







			     {if ($product->show_price && !isset($restricted_country_mode)) || isset($groups) || $product->reference || (isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS)}

                <!-- Add to cart form-->

                <form id="buy_block"{if $PS_CATALOG_MODE && !isset($groups) && $product->quantity > 0} class="hide"{/if} action="{$link->getPageLink('cart')|escape:'html':'UTF-8'}" method="post">

                    <!-- hidden datas -->

                    <input type="hidden" name="token" value="{$static_token}" />

                    <input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />

                    <input type="hidden" name="add" value="1" />

                    <input type="hidden" name="id_product_attribute" id="idCombination" value="" />



                    <div class="box-info-product">





                        {if isset($groups)}

                            <!-- Attributes -->

                            <div class="product_attributes">

                                <div id="attributes">

                                    {foreach from=$groups key=id_attribute_group item=group}

                                        {if $group.attributes|@count}

                                            <fieldset class="attribute_fieldset {if ($group.group_type == 'color')}color{/if}">



                                                <label class="attribute_label" {if $group.group_type != 'color' && $group.group_type != 'radio'}for="group_{$id_attribute_group|intval}"{/if}>{$group.name} :&nbsp;</label>

                                                {assign var="groupName" value="group_$id_attribute_group"}


                                                <!-- SWOPPER ATTRIBUTES -->
                                                {if ($product->name)=='Swopper CLASSIC' && $group.name=='Fabric Colour'}

                                                   <div class="colors-show">
                                                      <ul>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/41.jpg" alt="Black" title="Black" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/45.jpg" alt="Red" title="Red" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/46.jpg" alt="Smoke Grey" title="Smoke Grey" width="20" height="20" /></li>

                                                          {*<li> <img src="/img/custom-list/swopper-standard-colours/51.jpg" alt="Sand" title="Sand" width="20" height="20" /></li>*}

                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/47.jpg" alt="Royal Blue" title="Royal Blue" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/48.jpg" alt="Terracotta" title="Terracotta" width="20" height="20" /></li>

                                                          {*<li> <img src="/img/custom-list/swopper-standard-colours/52.jpg" alt="Choco" title="Choco" width="20" height="20" /></li>*}

                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/50.jpg" alt="Violet" title="Violet" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/49.jpg" alt="Pistachio" title="Pistachio" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/41.jpg" alt="Black Leather" title="Black Leather" width="20" height="20" /></li>
                                                      </ul>
                                                   </div>


                                                 {elseif ($product->name)=='Swopper WORK' && $group.name=='Seat Cover'}

                                                   <div class="colors-show">
                                                      <ul>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/41.jpg" alt="Black" title="Black Softex" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/45.jpg" alt="Red" title="Ferraro-Red Microfibre" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/46.jpg" alt="Smoke Grey Microfibre" title="Smoke Grey Microfibre" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/47.jpg" alt="Royal Blue Microfibre" title="Royal Blue Microfibre" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/41.jpg" alt="Black" title="Black Microfibre" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-colours/41.jpg" alt="Black Leather" title="Black Leather" width="20" height="20" /></li>
                                                      </ul>
                                                   </div>


                                                 {elseif ($product->name)=='Swopper AIR' && $group.name=='Fabric Colour'}

                                                     <div class="colors-show">
                                                      <ul>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-air-colours/silver.jpg" alt="Silver" title="Silver" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-air-colours/stone-grey.jpg" alt="Stone-Grey" title="Stone-Grey" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-air-colours/lime-green.jpg" alt="Lime-Green" title="Lime-Green" width="20" height="20" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-air-colours/ruby-red.jpg" alt="Ruby-Red" title="Ruby-Red" width="20" height="20" /></li>
                                                      </ul>
                                                   </div>


                                                 {elseif (   ($product->name|in_array:['Swopper CLASSIC', 'Swopper STANDARD','Swopper AIR','Swopper SADDLE']) &&
                                                                  $group.name=='Base')}
                                                     <div class="colors-show">
                                                      <ul>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-base/black.jpg" alt="" title="Black Anthracite STANDARD" width="60" height="60" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-base/titanium.jpg" alt="" title="Titanium [extra £27.95]" width="60" height="60" /></li>
                                                      </ul>
                                                   </div>


                                                   {elseif ( ($product->name)=='Swopper WORK' ) && $group.name=='Base'}
                                                     <div class="colors-show">
                                                      <ul>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-base/black-rollers.jpg" alt="" title="Black Anthracite STANDARD" width="60" height="60" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-base/titanium-rollers.jpg" alt="" title="Titanium [extra £27.95]" width="60" height="60" /></li>
                                                      </ul>
                                                   </div>



                                                 {elseif (   ($product->name|in_array:['Swopper CLASSIC', 'Swopper STANDARD', 'Swopper AIR',
                                                             'Swopper SADDLE'] ) && $group.name=='Base Ring')}
                                                      {if ($product->name)=='Swopper CLASSIC'}
                                                          <br/>
                                                          <span style="font-size:0.9em">
                                                              (the spring will always be the same colour as the foot base)
                                                          </span>
                                                      {/if}
                                                     <div class="colors-show">
                                                      <ul>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-base/black.jpg" alt="" title="Metal and Felt Gliders STANDARD" width="60" height="60" /></li>
                                                          <li> <img src="{$base_dir_ssl}/img/custom-list/swopper-standard-base/black-rollers.jpg" alt="" title="With Rollers [extra £24.95]" width="60" height="60" /></li>
                                                      </ul>
                                                   </div>



                                                {/if}





                                                <div class="attribute_list">

                                                    {if ($group.group_type == 'select')}



                                                        <select name="{$groupName}" id="group_{$id_attribute_group|intval}" class="form-control attribute_select no-print {if (($product->name)=='Hush Desk' || ($product->name)=='Sohodesk') && $group.name=='Desk Top Dimensions' }shorter{/if}" style="white-space:pre;">

                                                            {foreach from=$group.attributes key=id_attribute item=group_attribute}

                                                                <option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute}">{$group_attribute}</option>

                                                            {/foreach}

                                                        </select>

													{if ($product->name|in_array:['Yo-Yo Desk PRO 2+', 'Yo-Yo Desk PRO 2']) && ($group.name=='Desk Top Dimensions')}
													     <span>Additional sizes for orders of 5+ units (4 - 6 weeks delivery)</span>
                                                     {/if}													
														



                                                    {elseif ($group.group_type == 'color')}


                                                         {if ($product->name|in_array:['UP Stool', 'oyo', '3Dee', 'H4 Desk']) }
                                                            <div style="height:10px">&nbsp;</div>
                                                          {elseif ($product->name)=='HAG Capisco Puls 8010'}
                                                           <div style="height:10px">&nbsp;</div>
                                                         {/if}


                                                        <!-- ZOOMING ON COLOR ATTRIBUTES CONTAINERS -->
                                                        <div id="box-cont" style="display:none;"><img src="#" width="60" height="60"></div>

                                                         <div id="box-cont-wider" style="display:none;"><img src="#" width="120" height="120"></div>
                                                         <div id="box-cont-wider1" style="display:none;"><img src="#" width="120" height="120"></div>

                                                         <div id="box-wider-descrip" style="display:none;"></div>
                                                          <div id="box-wider1-descrip" style="display:none;"></div>




                                                        <!-- GROUPING OF COLOR ATTRIBUTES -->
                                                        <ul id="color_to_pick_list" class="clearfix">

                                                            {assign var="default_colorpicker" value=""}

                                                            {foreach from=$group.attributes key=id_attribute item=group_attribute name="colors"}


                                                               {if ($product->name)=='Muvman Stool'}
                                                                   {if $smarty.foreach.colors.iteration == 1}
                                                                            <li class="standard-li">  Standard Colours: (FREE TRIAL Avail.)</li>
                                                                    {/if}

                                                                   {if $smarty.foreach.colors.iteration == 5}
                                                                          <li class="additional-li" style="clear:both">ULTRA colours:<br/>(£25 extra)</li>
                                                                    {/if}


                                                                 {elseif ($product->name)=='ONGO Classic'}
                                                                    {if $smarty.foreach.colors.iteration == 1}
                                                                            <li class="standard-li">  Standard Colours: </li>
                                                                    {/if}

                                                                    {if $smarty.foreach.colors.iteration == 7}
                                                                          <li class="additional-li" style="clear:both">&nbsp;</li>
                                                                    {/if}

                                                                {elseif ($product->name)=='Hush Desk'}

                                                                     {if $smarty.foreach.colors.iteration == 1}
                                                                            <li class="standard-li">  Frame Only: </li>
                                                                      {/if}

                                                                     {if $smarty.foreach.colors.iteration == 2}
                                                                          <li class="additional-li" style="clear:both">Standard Colours:</li>
                                                                      {/if}

                                                                      {if $smarty.foreach.colors.iteration == 5}
                                                                          <li class="additional-li" style="clear:both">Additional Colours: (£40 extra)</li>
                                                                      {/if}


                                                                  {elseif ($product->name)=='Sohodesk' && $group.name=='Desk Surface Colour'}

                                                                   {if $smarty.foreach.colors.iteration == 1}
                                                                            <li class="standard-li">  Standard Colour: </li>
                                                                    {/if}

                                                                   {if $smarty.foreach.colors.iteration == 2}
                                                                          <li class="additional-li" style="clear:both">Additional Colours: (£50 extra)</li>
                                                                    {/if}

																	{if $smarty.foreach.colors.iteration == 7}
                                                                          <li class="additional-li" style="clear:both">&nbsp;</li>
                                                                    {/if}




                                                                   {elseif (($product->name|in_array:['DeskPro 1', 'DeskPro 2X',
                                                                            'DeskPro S','MonoPro']) && $group.name=='Desk Surface Colour')}

                                                                      {if $smarty.foreach.colors.iteration == 1}
                                                                            <li class="standard-li">  Frame Only: </li>
                                                                      {/if}

                                                                     {if $smarty.foreach.colors.iteration == 2}
                                                                          <li class="additional-li" style="clear:both">Standard Colours:</li>
                                                                      {/if}

                                                                      {if $smarty.foreach.colors.iteration == 5}
                                                                          <li class="additional-li" style="clear:both">Additional Colours: (£40 extra)</li>
                                                                      {/if}
																	  
																	  
																	  {elseif (($product->name =='Yo-Yo Desk PRO 2+') && $group.name=='Desk Surface Colour')}

                                                                   {if $smarty.foreach.colors.iteration == 1}
                                                                       <li class="standard-li">  Frame Only: </li>
                                                                   {/if}

                                                                   {if $smarty.foreach.colors.iteration == 2}
                                                                       <li class="additional-li" style="clear:both">Standard Colours:</li>
                                                                   {/if}

                                                                   {if $smarty.foreach.colors.iteration == 5}
                                                                       <li class="additional-li" style="clear:both;width:100%">
                                                                           Additional Colours: (£40 extra)<br/>
                                                                           <span class="yy-red">Only for orders of 5+ units (4 -6 week delivery period)</span> </li>
                                                                       <li class="additional-li" style="clear:both">&nbsp;</li>
                                                                   {/if}



                                                                     {elseif ($product->name)=='BenchPro Double Desk'
                                                                           && $group.name=='Desk Surface Colour'}

                                                                      {if $smarty.foreach.colors.iteration == 1}
                                                                            <li class="standard-li longer">  Frame Only [recycle existing desktop]  </li>
                                                                      {/if}


                                                                      {if $smarty.foreach.colors.iteration == 2}
                                                                          <li class="additional-li" style="clear:both">Standard Colours: (£60 extra)</li>
                                                                      {/if}

                                                                     {if $smarty.foreach.colors.iteration == 5}
                                                                          <li class="additional-li" style="clear:both">Additional Colours: (£90 extra)</li>
                                                                      {/if}




                                                                      {elseif (($product->name|in_array:['DeskPro 3X','DeskPro 3S'])
                                                               && $group.name=='Desk Surface Colour')}

                                                                   {if $smarty.foreach.colors.iteration == 1}
                                                                       <li class="standard-li">  Frame Only: </li>
                                                                   {/if}


                                                                   {if $smarty.foreach.colors.iteration == 2}
                                                                       <li class="additional-li" style="clear:both">Standard Colours:</li>
                                                                   {/if}

                                                                   {if $smarty.foreach.colors.iteration == 5}
                                                                       <li class="additional-li" style="clear:both">Additional Colours: (£60 extra)</li>
                                                                   {/if}




                                                                  {elseif ($product->name)=='Swopper CLASSIC'}
                                                                       {if $smarty.foreach.colors.iteration == 6}
                                                                          <li style="clear:both;width:0;border:0;margin-left:-5px">&nbsp;</li>
                                                                      {/if}

                                                               {elseif ($product->name)=='Freedesk Deluxe'}
                                                                   {if $smarty.foreach.colors.iteration == 1}
                                                                       <li class="additional-li" style="clear:both">Standard Colour:</li>
                                                                   {/if}

                                                                   {if $smarty.foreach.colors.iteration == 2}
                                                                       <li class="additional-li" style="clear:both">Additional Colours: (£20 extra)</li>
                                                                   {/if}







                                                                {elseif ($product->name)=='Modesty Panel'
                                                                && $group.name=='Colour'}

                                                                {if $smarty.foreach.colors.iteration == 1}
                                                                    <li class="additional-li" style="clear:both">Standard Colours:</li>
                                                                {/if}

                                                                {if $smarty.foreach.colors.iteration == 4}
                                                                    <li class="additional-li" style="clear:both">Additional Colours: (£30 extra)</li>
                                                                {/if}

                                                           {/if}




                                                                <li{if $group.default == $id_attribute} class="selected"{/if}>



                                                                    <a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" id="color_{$id_attribute|intval}" name="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" class="color_pick{if ($group.default == $id_attribute)} selected{/if}" style="background: {$colors.$id_attribute.value|escape:'html':'UTF-8'};" title="{$colors.$id_attribute.name|escape:'html':'UTF-8'}">

                                                                        {if file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}

                                                                            <img src="{$img_col_dir}{$id_attribute|intval}.jpg" alt="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" width="20" height="20"
                                                                            class="{if ($product->name)=='Swopper CLASSIC'}
                                                                                     imagehov-big
                                                                                   {elseif ($product->name)=='Swopper STANDARD'}
                                                                                     imagehov-middle
                                                                                   {else}imagehov
                                                                                   {/if}"
                                                                            />

                                                                        {/if}

                                                                    </a>

                                                                </li>

                                                                {if ($group.default == $id_attribute)}

                                                                    {$default_colorpicker = $id_attribute}

                                                                {/if}

                                                            {/foreach}




                                                        </ul>

                                                        <input type="hidden" class="color_pick_hidden" name="{$groupName|escape:'html':'UTF-8'}" value="{$default_colorpicker|intval}" />


                                                    


                                                    {elseif ($group.group_type == 'radio')}



                                                        <ul class="clearfix">

                                                            {foreach from=$group.attributes key=id_attribute item=group_attribute}

                                                                <li>

                                                                    <input type="radio" class="attribute_radio" name="{$groupName|escape:'html':'UTF-8'}" value="{$id_attribute}" id="{$groupName|escape:'html':'UTF-8'}_{$id_attribute}" {if ($group.default == $id_attribute)} checked="checked"{/if} />

                                                                    <label for="{$groupName|escape:'html':'UTF-8'}_{$id_attribute}">{$group_attribute|escape:'html':'UTF-8'}</label>

                                                                </li>

                                                            {/foreach}

                                                        </ul>



                                                    {/if}

                                                </div>

                                                <!-- CUSTOM COLOURS FOR SOHODESK - TO REMOVE -->
                                                {if ($product->name)=='Sohodesk' && $group.name=='Desk Surface Colour'}
													   <div style="clear:both;"></div>
													  <div class="product-ccolours">

													      For custom colours
		                                                    <a id="ccolours"  title="Custom Colours" href="#ccolurs-d">
															    click here
													       </a>
														   (for orders of 5+ units)

                                                     </div>
												{/if}







                                            </fieldset>

                                        {/if}

                                    {/foreach}

                                </div>

                            </div>

                        {/if}



                        <!-- EXTRA OPTIONS ACCESORIES/ MODESTY PANELS -->
                       {if ($product->name)=='Collaborate Double Desk'}
													   <div style="clear:both;"></div>
													  <div class="product-accessories">
													      For extra accessories check
		                                                    <a id="p_accesories"  title="Accessories" href="#"><u>Collaborate Desk Brochure</u></a>.
                                                     </div>
                                                     <br/>

                       {elseif ($product->name|in_array:['DeskPro 1', 'DeskPro 2X', 'DeskPro 3X', 'DeskPro S', 'DeskPro 3S', 'Hush Desk'])}
													   <div style="clear:both;"></div>
													  <div class="product-accessories">

		                                                    <a title="Modesty Panel Options" class="yy-bold" target="_blank" href="https://sit-stand.com/modesty-panels/148-modesty-panel.html"><u>Modesty Panel Options</u></a>
															<br/><br/>
															
															<a title="USB Charger & Power Socket" class="yy-bold" target="_blank" href="https://sit-stand.com/deskpro-accessories/172-desk-socket.html"><u>USB Charger & Power Socket</u></a>
															<br/><br/>
															
															<a title="Privacy Panel" class="yy-bold" target="_blank" href="https://sit-stand.com/deskpro-accessories/173-privacy-panel.html"><u>Privacy Panel</u></a>
															
                                                     </div>
                                                     <br/>
                       {elseif ($product->name)=='Hush Bench'}

                            <span style="font-size:12px;color:#da3b44"><strong>Screen panels (from £199 ex VAT) :<br/></strong>
                            100 panel colour options.<br/>
                            Download our “Buyers Guide” or call us. </span><br/>


                            <div class="colors-show">
                              <ul>
                                  <li> <img src="{$base_dir_ssl}/img/custom-list/hushbench/madura.jpg" alt="Madura" title="Madura" width="30" /></li>
                                  <li> <img src="{$base_dir_ssl}/img/custom-list/hushbench/scuba.jpg" alt="Scuba" title="Scuba" width="30" /></li>
                                  <li> <img src="{$base_dir_ssl}/img/custom-list/hushbench/buru.jpg" alt="Buru" title="Buru" width="30" /></li>
                                  <li> <img src="{$base_dir_ssl}/img/custom-list/hushbench/sandstorm.jpg" alt="Sandstorm" title="Sandstorm" width="30" /></li>
                                  <li> <img src="{$base_dir_ssl}/img/custom-list/hushbench/diablo.jpg" alt="Diablo" title="Diablo" width="30" /></li>
                                  <li> <img src="{$base_dir_ssl}/img/custom-list/hushbench/tarot.jpg" alt="Tarot" title="tarot" width="30" /></li>

                              </ul>
                              </div>
                              <div style="clear:both;"></div>

                        {elseif ($product->name)=='3Dee'}
                            <div style="clear:both;"></div>
                            <div class="product-accessories">
                                If 10 units or more, additional Gabriel colours & fabric available.

                            </div>
                            <br/>


					   {/if}




                        {if !$PS_CATALOG_MODE}

                            <!-- Quantity field -->

                            <div id="quantity_wanted_p"{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>



                                <a href="#" data-field-qty="qty" class="button-2 fill icon-only sharp-corners product_quantity_down">

                                    <span class="wpicon wpicon-minus small"></span>

                                </a>

                                <input type="text" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product->minimal_quantity > 1}{$product->minimal_quantity}{else}1{/if}{/if}" />

                                <a href="#" data-field-qty="qty" class="button-2 fill icon-only sharp-corners product_quantity_up ">

                                    <span class="wpicon wpicon-plus small"></span>

                                </a>

                            </div>

                        {/if}



                        <div id="minimal_quantity_wanted_p"{if $product->minimal_quantity <= 1 || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>

                            {l s='This product is not sold individually. You must select at least'} <b id="minimal_quantity_label">{$product->minimal_quantity}</b> {l s='quantity for this product.'}

                        </div>



                        <div class="box-cart-bottom">

                            <div{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || (isset($restricted_country_mode) && $restricted_country_mode) || $PS_CATALOG_MODE} class="unvisible"{/if}>

                                <div id="add_to_cart" class="buttons_bottom_block no-print">

                                    <button type="submit" name="Submit" class="button-1 fill" style="height:42px">

                                        <span class="wpicon wpicon-cart medium" style="top:1px"></span>

                                        <span>{l s='Add to cart'}</span>

                                    </button>

                                </div>


                                <div id="combination-error">Please insert the correct combination.<br/> Or call us on  0333 22 00 375</div>





                                <input type="hidden" name="id_product_attribute" id="link_base_calc"
                                       value="{$link->getPageLink('calculator',false, NULL, "price=", false)|escape:'html':'UTF-8'}" />



                                <!-- COMPARE BUTTON -->


                                <div class="yybutton yybutton-blue yybutton-thin">

                                    <a href="/compare">
                                        <div class="yybutton-cont">
                                            <img src="/img/cms/compare.png" class="yybutton-image" width="30" />

                                            <div class="yybutton-textcont">
                                                <div class="yybutton-text">Compare Product</div><br/>
                                            </div>
                                        </div>
                                    </a>
                                </div>




                               <div style="clear: both;"></div>



                            </div>



                            {if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}

                                <!-- hook_product_actions -->

                                {$HOOK_PRODUCT_ACTIONS}

                                <!-- End - hook_product_actions -->

                            {/if}

                        </div>





                    </div>

                </form>











			{/if}









            <!-- DELIVERY, STOCK, REFERENCE CODES -->
			 <div id="prod-icon-desc">


		           <div id="deliv-time" class="iconed-text ilonger">

                    <span class="wpicon wpicon-truck medium"></span>

                    <span class="deliv-time-text">



                     Delivery Time:
					  {if (isset($ad_extrafields['ad_extrafield8']) && !empty($ad_extrafields['ad_extrafield8']))}
					    {$ad_extrafields['ad_extrafield8']}	  
                       {else}
                        2 - 3 days							  
					  {/if}
					 
					

                    </span>

                </div>


                      {if ($display_qties == 1 && !$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && $product->available_for_order)}

                        {if $product->quantity > 0}

                            <!-- Quantity -->

                            <div id="pQuantityAvailable" class="iconed-text ishorter">

                                <span class="wpicon wpicon-stack medium"></span>

                                <span id="quantityAvailable">

                                {if ($product->name)=='some products' }
                                 {l s='Pre-Order'}
                                {else}


                                {* here instead of displaying actual quantity in stock we say In Stock! $product->quantity|intval *}

                                 {l s='In Stock'}
                               {/if}


                                </span>


                            </div>

                        {/if}

                    {/if}


		            <div style="clear: both;"></div>




                    {if (isset($product->reference) && $product->reference && isset($WPAC_productShowReference) && $WPAC_productShowReference)}

                    <!-- Product reference -->

                    <div id="product_reference" class="iconed-text ilonger">

                        <span class="wpicon wpicon-barcode medium"></span>

                        <span class="product_reference_name" itemprop="sku">{if !isset($groups)}{$product->reference|escape:'html':'UTF-8'}{/if}</span>

                    </div>

                   {/if}



                    {if (isset($product_manufacturer) && $product_manufacturer->id_manufacturer != null && isset($WPAC_productShowManName) && $WPAC_productShowManName)}

                        <!-- Manufacturer Name -->

                        <div class="product_manufacturer_name iconed-text ishorter">

                            <span class="wpicon wpicon-factory medium"></span>

                            <a itemprop="brand" href="{$link->getmanufacturerLink($product_manufacturer->id_manufacturer, $product_manufacturer->link_rewrite)|escape:'htmlall':'UTF-8'}" title="{$product_manufacturer->name|escape:'htmlall':'UTF-8'}">

                                {$product_manufacturer->name}

                            </a>

                        </div>

                    {/if}



                   <div style="clear: both;"></div>

                    {capture name=condition}

                        {if $product->condition == 'new'}{l s='New'}

                        {elseif $product->condition == 'used'}{l s='Used'}

                        {elseif $product->condition == 'refurbished'}{l s='Refurbished'}

                        {/if}

                    {/capture}


             </div>



            <!-- VOUCHER BUTTON -->
            {if ($product_manufacturer->name)!='Ergotron' && ($product_manufacturer->name)!='Varidesk'}
                <div id="freetrial-register" style="width:132px;height:42px;padding-top: 10px;">
                           <a href="{$base_dir_ssl}my-account">£25 Voucher</a>
                 </div>
            {/if}


            <!-- FREETRIAL BUTTON -->

            {if ($product->name|in_array:['DeskPro 1', 'DeskPro 2X', 'Yo-Yo Desk MINI', 'Yo-Yo Desk 90', 'Yo-Yo Desk 120','Yo-Yo Desk CUBE',
            'Yo-Yo Desk GO1', 'Yo-Yo Desk GO2', 'IMPRINT Deluxe Mat', 'Yo-Yo Mat', 'Steppie',
            'Muvman Stool', 'HAG Capisco Puls 8010', 'UP Stool', 'Freedesk Deluxe','Freedesk','QuickStand ECO'])
            || substr_count($product->name, 'Swopper')== 1}
                 <div class="yybutton yybutton-red yybutton-thin" style="margin-top: 10px;letter-spacing: -0.35px;">

                     <a href="{$base_dir_ssl}freetrial">
                         <div class="yybutton-cont">
                             <img src="{$base_dir_ssl}/img/cms/freetrial.png" class="yybutton-image" width="30" />

                             <div class="yybutton-textcont">
                                 <div class="yybutton-text">
                                     {if ($product->name|in_array:['Muvman Stool', 'HAG Capisco Puls 8010', 'UP Stool',
                                     'ONGO Classic', 'Freedesk Deluxe','Freedesk']) || substr_count($product->name, 'Swopper')== 1}15{else}30{/if} Days. FREE Trial
                                 </div><br/>
                             </div>
                         </div>
                     </a>
                 </div>
            {/if}

            <div style="clear: both;"></div>



		</div>

		<!-- End - Center Column -->






<!-- Right Column -->

    <div class="pb-right-column column col-3-12 white-border-6px">

      <!-- PRODUCT BENEFITS + CALCULATE PAYBACK BUTTONS -->
      {include file="$tpl_dir./product-benefits.tpl"}

	 
	  {if (isset($ad_extrafields['ad_extrafield9']) && !empty($ad_extrafields['ad_extrafield9']))}
     <div class="block"><p class="title_block no-bmar popular-prod">
	 <a href="https://www.youtube.com/channel/UCdVRf7slI4xcALzb3I2zbRg/videos" target="_blank" class="yy-red">
	 Sit-Stand TV <img src="/img/list/sstv.png" width="27"></a>
	 </p></div>	  
	  {foreach from=$ad_extrafields['ad_extrafield9'] item=foo}
			<iframe src="{$foo}" width="100%"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
		{/foreach}
	  {/if}
	  

            <!-- SIMILAR PRODUCTS / POPULAR PRODUCTS -->
             {if isset($HOOK_EXTRA_RIGHT) && $HOOK_EXTRA_RIGHT}
				<!-- hook_extra_right -->
                {$HOOK_EXTRA_RIGHT}
				<!-- End - hook_extra_right -->
            {/if}

  	</div>


<!-- End - Right Column -->


    </div>
    <!-- End - Primary Block -->



    <!-- SPECIAL DELIVERY FOR HUSHDESK AND OTHER -->
    {if ($product->name|in_array:['Hush Desk', 'DeskPro 1', 'DeskPro 2X', 'DeskPro 3X', 'DeskPro S', 'DeskPro 3S',
        'MonoPro', 'BenchPro Double Desk'])
		}

		<div class="hushdesk-pdelivery">

		<strong>Delivery Terms</strong>
		<ul style="list-style:disc;margin-left:20px">
		   <li>
		   Standard delivery of the
               <strong>{$product->name}</strong>
		   is charged at £60 (ex VAT) per desk and includes FREE installation.

            <li>
                It will take up to 15 working days for your desk to be delivered / installed.
                <strong>Frame Only</strong> solutions can be delivered within 5 days.
            </li>


            <li>
                Our specialists assemble your desk at your own premises, install
                all the components and demonstrate all the usage features.
            </li>

            <li class="yy-red">
                It is the customers responsibility to REMOVE any desk which is being replaced,
                or DISMANTLE the desktop from existing frame if  a <strong>Frame Only</strong> solution is to be installed
            </li>

            <li>
                <span>Standard delivery is to <strong>UK Mainland only</strong>. Delivery to non-UK mainland
                    will be by application only. We confirm cost by a manual quote.</span>
            </li>

		   <li>
		    <strong>Delivery discounts</strong> are available for orders of 5+ units.  Click “<strong>Delivery & Returns</strong>” below  for full terms and conditions.
		   </li>
		</ul>

       <br/>
       <strong>Frame Only - Conditions</strong>
        <ul style="list-style:disc;margin-left:20px">
		   <li>
		   Our FRAME ONLY solutions may only be applied to existing desktops which have a <strong>minimum thickness of 18mm</strong>, and must not be made of resin.
		   </li>

		   <li>
		   It is the customer’s responsibility to dismantle & remove the old desk frame and IT equipment prior to the arrival of our installer.
		   </li>
		</ul>


		</div>
        <br/>


		{elseif ($product->name)=='Monitor Arm - Flo' }

		<div class="hushdesk-pdelivery">
		<strong>Important</strong>
        <ul style="list-style:disc;margin-left:20px">
		   <li>
		  <span style="font-style: italic;">Through desk fixing</span> requires drilling an M12 hole in the desk.
		   </li>

		   <li>
		  A <span style="font-style: italic;">Through cable port</span> attachment will be supplied with a cast iron grommet fixing to attach to the desk.
		   </li>
		</ul>
		</div>
        <br/>


		{/if}







	{if !$content_only}

        <div class="secondary_block row" id="reviews-scroll">

            <!-- Secondary Block -->

            <div class="column col-9-12">

                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab-titles">


                        {if $product->description}
                            <div class="tab-title" data-tab="product-tab-2"><span>{l s='Features'}</span></div>
                        {/if}


                        {if ($product->name|in_array:['Hush Desk','Sohodesk']) }
						    <div class="tab-title" data-tab="product-tab-10"><span>{l s='Video'}</span></div>
						{/if}


                        {if isset($features) && $features}
                            <div class="tab-title" data-tab="product-tab-1"><span>{l s='Specification'}</span></div>
                        {/if}


                        <div class="tab-title" data-tab="product-tab-9"><span>{l s='Delivery & Returns'}</span></div>

                        {if isset($accessories) && $accessories}
                            <div class="tab-title" data-tab="product-tab-3"><span>{l s='Accessories'}</span></div>
                        {/if}


                            <div class="tab-title" data-tab="product-tab-4"><span>{l s='Downloads'}</span></div>

                        {if isset($product) && $product->customizable}
                            <div class="tab-title" data-tab="product-tab-5"><span>{l s='Customization'}</span></div>
                        {/if}


                        {$HOOK_PRODUCT_TAB}



                    </div>



                    <div class="tab-contents">






                         {if $product->description}

                            <!-- More info -->

                            <div id="product-tab-2" class="page-product-box tab-content-wrapper">

                                <div class="tab-title" data-tab="product-tab-2"><span>{l s='Description'}</span></div>

                                <div class="tab-content box">

                                    {$product->description}

                                </div>

                            </div>

                        {/if}



                         {if ($product->name)=='Hush Desk'  || ($product->name)=='Sohodesk' }

                            <!-- More info -->

                            <div id="product-tab-10" class="page-product-box tab-content-wrapper">

                                <div class="tab-title" data-tab="product-tab-10"><span>{l s='Video'}</span></div>

                                <div class="tab-content box">

									<br/>
									<iframe src="//player.vimeo.com/video/115130795" width="380" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									<iframe src="//player.vimeo.com/video/115130793" width="380" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									 <br/>
									<iframe src="//player.vimeo.com/video/115130794" width="380" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									<iframe src="//player.vimeo.com/video/115130797" width="380" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

									<br/>
									<br/>
                                </div>

                            </div>



                        {/if}



                        {if isset($features) && $features}

                            <!-- Data sheet -->

                            <div id="product-tab-1" class="page-product-box tab-content-wrapper">

                                <div class="tab-title" data-tab="product-tab-1"><span>{l s='Data sheet'}</span></div>

                                <div class="tab-content">

                                    <table class="table-data-sheet">

                                        {foreach from=$features item=feature}

                                        <tr class="{cycle values="odd,even"}">

                                            {if isset($feature.value)}

                                            <td class="title">{$feature.name|escape:'html':'UTF-8'}</td>

                                           <td>{$feature.value|escape:'html':'UTF-8'}</td>

                                            {/if}

                                        </tr>

                                        {/foreach}

                                    </table>

                                </div>

                            </div>

                        {/if}






                        <div id="product-tab-9" class="tab-content-wrapper">

                                <div id="product-tab-9" class="page-product-box tab-content-wrapper">

                                <div class="tab-title" data-tab="product-tab-9"><span>{l s='Delivery & Returns'}</span></div>

                                <div class="tab-content box">

                                    <!-- SPECIAL DELIVERY TERMS -->
                                    {if (isset($ad_extrafields['ad_extrafield2']) && !empty($ad_extrafields['ad_extrafield2']))}
                                        {$ad_extrafields['ad_extrafield2']}
                                    {else}
                                        <div class="deliv-title">Delivery time:</div>
                                        <ul>
                                            <li>Please allow 2 - 3 days for delivery.</li>
                                            <li>Lead times for larger orders may result in a longer delivery period and these will be advised separately.</li>
                                        </ul>
                                        <p> </p>
                                    {/if}

                                    <div class="deliv-title">Cancellation / Re-scheduling</div>

                                    <ul>
                                        <li>
                                            Once a delivery appointment has been confirmed with you it may only be cancelled or re-scheduled subject to an additional fee being paid (ie 50% delivery charge).
                                        </li>
                                    </ul>



                                    <div class="deliv-title">Returns:</div>

                                    <ul>
                                        <li>
                                            If in the unlikely event this item arrives with any faults please inform us within 24 hours of
                                            receipt by email and photographic evidence of the damaged item to make a valid claim.
                                        </li>

                                        <li>
                                            If our initial investigation does not resolve the matter within 48 hours we will collect
                                            the faulty item and either refund it or provide you with a replacement.
                                        </li>
                                    </ul>


                                    <div class="deliv-title">EFTA Countries:[Bosnia, Iceland, Serbia, Liechtenstein, Norway & Switzerland]</div>

                                    <ul>
                                        <li>
                                            EFTA Countries are obliged to pay an additional £25 charge for <strong>Final Customs Clearance and Transit.</strong>
                                        </li>

                                        <li>
                                            We will send you by email an additional invoice for this customs fee. This invoice must be paid before we dispatch your order.
                                        </li>
                                    </ul>




                                </div>

                            </div>

                            </div>






                        {if isset($accessories) && $accessories}

                            <!--Accessories -->

                            <div id="product-tab-3" class="page-product-box tab-content-wrapper">

                                <div class="tab-title" data-tab="product-tab-3"><span>{l s='Accessories'}</span></div>

                                <div class="tab-content box">

                                    <div class="products_block accessories-block row">

                                        <div class="block_content column col-12-12">



                                            <div id="productaccessories-carousel" class="grid carousel-grid owl-carousel">

                                                {foreach from=$accessories item=accessory name=accessories_list}

                                                    {if ($accessory.allow_oosp || $accessory.quantity_all_versions > 0 || $accessory.quantity > 0) && $accessory.available_for_order && !isset($restricted_country_mode)}

                                                        {assign var='accessoryLink' value=$link->getProductLink($accessory.id_product, $accessory.link_rewrite, $accessory.category)}



                                                        <div class="item product-box ajax_block_product product_accessories_description">

                                                            <div class="item-wrapper">

                                                                <div class="item-upper-container">

                                                                    <div class="item-image-container white-border-3px">

                                                                        <a class="img-wrapper" href="{$accessoryLink}" title="{$accessory.legend|escape:'html':'UTF-8'}">

                                                                            <img src="{$link->getImageLink($accessory.link_rewrite, $accessory.id_image, 'atmn_normal')|escape:'html':'UTF-8'}" alt="{$accessory.legend|escape:'html':'UTF-8'}" />

                                                                        </a>

                                                                    </div>

                                                                </div>



                                                                <div class="item-details">

                                                                    <a class="item-name-link" href="{$accessoryLink|escape:'html':'UTF-8'}">

                                                                        <span class="item-name">{$accessory.name|truncate:45:'...':true|escape:'html':'UTF-8'}</span>

                                                                    </a>



                                                                    {if $accessory.show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}

                                                                        <span class="item-price">

                                                                            {if $priceDisplay != 1}

                                                                                {displayWtPrice p=$accessory.price}{else}{displayWtPrice p=$accessory.price_tax_exc}

                                                                            {/if}

                                                                        </span>

                                                                    {/if}



                                                                    {if !$PS_CATALOG_MODE && ($accessory.allow_oosp || $accessory.quantity > 0)}

                                                                        <div class="item-buttons">

                                                                            <a class="button-2 fill inline ajax_add_to_cart_button" href="{$link->getPageLink('cart', true, NULL, "qty=1&amp;id_product={$accessory.id_product|intval}&amp;token={$static_token}&amp;add")|escape:'html':'UTF-8'}" data-id-product="{$accessory.id_product|intval}" title="{l s='Add to cart'}">

                                                                                <span class="wpicon wpicon-cart"></span><span>{l s='Add to Cart'}</span>

                                                                            </a>

                                                                        </div>

                                                                    {/if}

                                                                </div>

                                                            </div>

                                                        </div>



                                                    {/if}

                                                {/foreach}

                                            </div>



                                        </div>

                                    </div>

                                </div>

                            </div>

                        {/if}





                            <!--Download -->

                            <div id="product-tab-4" class="page-product-box tab-content-wrapper">

                                <div class="tab-title" data-tab="product-tab-4"><span>{l s='Downloads'}</span></div>

                                <div class="tab-content box">

                                     {if ($product->name)=='Hush Desk'}

                                          <div class="product-download">
                                            <h4><a href="https://www.linak.com/products/controls.aspx?product=LINAK%20Desk%20Control%20SW&tab=resources" target="_blank">LINAK – Wellness Software</a></h4>
                                            <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="http://www.linak.com/products/controls.aspx?product=LINAK%20Desk%20Control%20SW&tab=resources" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                        </div>


                                         <div class="product-download">
                                               <h4><a href="https://pdfdata.sit-stand.com/colours_and_dimensions.pdf" target="_blank">Colours and Desktop Dimensions</a></h4>
                                               <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/colours_and_dimensions.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                           </div>


                                     {elseif ($product->name)=='Collaborate Double Desk'}

                                          <div class="product-download">
                                            <h4><a href="https://pdfdata.sit-stand.com/collaborate.pdf" target="_blank">Collaborate Desk Brochure</a></h4>
                                            <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/collaborate.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                        </div>


                                      {elseif ($product_manufacturer->name|in_array:['Yo-Yo Desk', 'Varidesk']) }

                                         {if ($product->name|in_array:['Yo-Yo Desk MINI','Yo-Yo Desk 90','Yo-Yo Desk 120','Yo-Yo Desk CUBE']) }
                                          <div class="product-download">
                                            <h4><a href="https://pdfdata.sit-stand.com/yo-yo-brochure.pdf" target="_blank">Yo-Yo Desk Brochure</a></h4>
                                            <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/yo-yo-brochure.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                          </div>
                                         {elseif ($product->name|in_array:['Yo-Yo Desk GO1','Yo-Yo Desk GO2']) }
                                             <div class="product-download">
                                                 <h4><a href="https://pdfdata.sit-stand.com/yo-yo-go-brochure.pdf" target="_blank">Yo-Yo Desk GO Brochure</a></h4>
                                                 <p class="text-muted"></p>
                                                 <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/yo-yo-go-brochure.pdf" target="_blank">
                                                     <span class="wpicon wpicon-download medium"></span>
                                                     {l s="Download"}
                                                 </a>
                                             </div>



                                         {/if}

                                         <div class="product-download">
                                             <h4><a href="https://pdfdata.sit-stand.com/compare-yoyo-varidesk.pdf" target="_blank">Product Comparison – Varidesk & Yo-YoDesk</a></h4>
                                             <p class="text-muted"></p>
                                             <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/compare-yoyo-varidesk.pdf" target="_blank">
                                                 <span class="wpicon wpicon-download medium"></span>
                                                 {l s="Download"}
                                             </a>
                                         </div>


                                     {elseif ($product->name|in_array:['Swopper STANDARD','Swopper CLASSIC',
                                     'Swopper AIR', 'Swopper SADDLE', 'Swopper WORK']) }

                                            <div class="product-download">
                                               <h4><a href="https://pdfdata.sit-stand.com/swopper.pdf" target="_blank">Swopper Brochure</a></h4>
                                               <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/swopper.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                           </div>


                                       {elseif ($product_manufacturer->name)=='UpDown'}

                                          <div class="product-download">
                                               <h4><a href="https://pdfdata.sit-stand.com/updown.pdf" target="_blank">UpDown Brochure</a></h4>
                                               <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/updown.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                           </div>


                                           <div class="product-download">
                                               <h4><a href="https://pdfdata.sit-stand.com/colours_and_dimensions.pdf" target="_blank">Colours and Desktop Dimensions</a></h4>
                                               <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/colours_and_dimensions.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                           </div>



                                            <div class="product-download">
                                               <h4><a href="https://pdfdata.sit-stand.com/colours_and_dimensions.pdf" target="_blank">Fault Handling Protocol</a></h4>
                                               <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/Fault-Handling-Protocol.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                           </div>




                                     {/if}


                                    {foreach from=$attachments item=attachment name=attachements}

                                        <div class="product-download">

                                            <h4><a href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")|escape:'html':'UTF-8'}">{$attachment.name|escape:'html':'UTF-8'}</a></h4>

                                            <p class="text-muted">{$attachment.description|escape:'html':'UTF-8'}</p>

                                            <a class="button-2 fill inline" href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")|escape:'html':'UTF-8'}" target="_blank">

                                                <span class="wpicon wpicon-download medium"></span>

                                                {l s="Download"}

                                            </a>

                                        </div>

                                    {/foreach}

                                         {if ($product->name|in_array:['Milk Classic', 'Milk Grande','4Milk'])}

                                             <div class="product-download">
                                                 <h4><a href="https://pdfdata.sit-stand.com/milk-assembly-guide.pdf" target="_blank">MILK Assembly Guide</a></h4>
                                                 <p class="text-muted"></p>
                                                 <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/milk-assembly-guide.pdf" target="_blank">
                                                     <span class="wpicon wpicon-download medium"></span>
                                                     {l s="Download"}
                                                 </a>
                                             </div>

                                         {/if}




                                         <div class="product-download">
                                            <h4><a href="https://pdfdata.sit-stand.com/brochure.pdf" target="_blank">Sit-Stand Brochure</a></h4>
                                            <p class="text-muted"></p>
                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/brochure.pdf" target="_blank">
                                                <span class="wpicon wpicon-download medium"></span>
                                                {l s="Download"}
                                            </a>
                                        </div>



                                        {if ($category->name)=='Desk Risers'}

		                                        <div class="product-download">
		                                            <h4><a href="https://pdfdata.sit-stand.com/guidelines-risers.pdf" target="_blank">Sit-Stand Guidelines</a></h4>
		                                            <p class="text-muted"></p>
		                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/guidelines-risers.pdf" target="_blank">
		                                                <span class="wpicon wpicon-download medium"></span>
		                                                {l s="Download"}
		                                            </a>
		                                        </div>
                                         {else}

                                               <div class="product-download">
		                                            <h4><a href="https://pdfdata.sit-stand.com/guidelines-desks.pdf" target="_blank">Sit-Stand Guidelines</a></h4>
		                                            <p class="text-muted"></p>
		                                            <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/guidelines-desks.pdf" target="_blank">
		                                                <span class="wpicon wpicon-download medium"></span>
		                                                {l s="Download"}
		                                            </a>
		                                        </div>

                                         {/if}



                                    <div class="product-download">
                                        <h4><a href="https://pdfdata.sit-stand.com/ActiveWorkingSeminar.pdf" target="_blank">Active Working Seminar</a></h4>
                                        <p class="text-muted"></p>
                                        <a class="button-2 fill inline" href="https://pdfdata.sit-stand.com/ActiveWorkingSeminar.pdf" target="_blank">
                                            <span class="wpicon wpicon-download medium"></span>
                                            {l s="Download"}
                                        </a>
                                    </div>
                                         
                                </div>

                            </div>

                        



                        {if isset($product) && $product->customizable}

                            <!--Customization -->

                            <div id="product-tab-5" class="page-product-box tab-content-wrapper">

                                <div class="tab-title" data-tab="product-tab-5"><span>{l s='Customization'}</span></div>

                                <div class="tab-content box">

                                    <!-- Customizable products -->

                                    <form method="post" action="{$customizationFormTarget}" enctype="multipart/form-data" id="customizationForm" class="clearfix">

                                        <h3 class="section-header infoCustomizable">

                                            {l s='After saving your customized product, remember to add it to your cart.'}

                                            {if $product->uploadable_files}

                                            <br />

                                            {l s='Allowed file formats are: GIF, JPG, PNG'}{/if}

                                        </h3>



                                        {if $product->uploadable_files|intval}

                                            <div class="customizableProductsFile">

                                                <h5 class="product-heading-h5">{l s='Pictures'}</h5>

                                                <ul id="uploadable_files" class="clearfix">

                                                    {counter start=0 assign='customizationField'}

                                                    {foreach from=$customizationFields item='field' name='customizationFields'}

                                                        {if $field.type == 0}

                                                            <li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='pictures_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}

                                                                {if isset($pictures.$key)}

                                                                    <div class="customizationUploadBrowse">

                                                                        <img src="{$pic_dir}{$pictures.$key}_small" alt="" />

                                                                            <a href="{$link->getProductDeletePictureLink($product, $field.id_customization_field)|escape:'html':'UTF-8'}" title="{l s='Delete'}" >

                                                                                <span class="wpicon wpicon-close small" title="{l s='Delete'}"></span>

                                                                            </a>

                                                                    </div>

                                                                {/if}

                                                                <div class="customizationUploadBrowse">

                                                                    <label class="customizationUploadBrowseDescription">

                                                                        {if !empty($field.name)}

                                                                            {$field.name}

                                                                        {else}

                                                                            {l s='Please select an image file from your computer'}

                                                                        {/if}

                                                                        {if $field.required}<sup>*</sup>{/if}

                                                                    </label>

                                                                    <input type="file" name="file{$field.id_customization_field}" id="img{$customizationField}" class="form-control customization_block_input {if isset($pictures.$key)}filled{/if}" />

                                                                </div>

                                                            </li>

                                                            {counter}

                                                        {/if}

                                                    {/foreach}

                                                </ul>

                                            </div>

                                        {/if}



                                        {if $product->text_fields|intval}

                                            <div class="customizableProductsText">

                                                <h5 class="product-heading-h5">{l s='Text'}</h5>

                                                <ul id="text_fields">

                                                {counter start=0 assign='customizationField'}

                                                {foreach from=$customizationFields item='field' name='customizationFields'}

                                                    {if $field.type == 1}

                                                        <li class="customizationUploadLine{if $field.required} required{/if}">

                                                            <label for ="textField{$customizationField}">

                                                                {assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}

                                                                {if !empty($field.name)}

                                                                    {$field.name}

                                                                {/if}

                                                                {if $field.required}<sup>*</sup>{/if}

                                                            </label>

                                                            <textarea name="textField{$field.id_customization_field}" class="form-control customization_block_input" id="textField{$customizationField}" rows="3" cols="20">{strip}

                                                                {if isset($textFields.$key)}

                                                                    {$textFields.$key|stripslashes}

                                                                {/if}

                                                            {/strip}</textarea>

                                                        </li>

                                                        {counter}

                                                    {/if}

                                                {/foreach}

                                                </ul>

                                            </div>

                                        {/if}



                                        <p class="required align-left"><sup>*</sup> {l s='required fields'}</p>



                                        <p id="customizedDatas">

                                            <input type="hidden" name="quantityBackup" id="quantityBackup" value="" />

                                            <input type="hidden" name="submitCustomizedDatas" value="1" />

                                            <button class="button-2 fill" name="saveCustomization">

                                                <span>{l s='Save'}</span>

                                            </button>

                                            <span id="ajax-loader" class="unvisible">

                                                <img src="{$img_ps_dir}loader.gif" alt="loader" />

                                            </span>

                                        </p>

                                    </form>

                                </div>

                            </div>

                        {/if}



                        

                        <!-- hook product tab -->

                        <div class="page-product-box">

                            {if isset($HOOK_PRODUCT_TAB_CONTENT) && $HOOK_PRODUCT_TAB_CONTENT}

                                {$HOOK_PRODUCT_TAB_CONTENT}

                            {/if}

                        </div>

                        <!-- END - hook product tab -->



                    </div>



                </div>

                <!-- End - Tabs -->



                {if (isset($quantity_discounts) && count($quantity_discounts) > 0)}

                    <!-- Quantity discount -->

                    <div class="page-product-box">

                        <h3 class="page-product-heading">{l s='Volume discounts'}</h3>

                        <div id="quantityDiscount">

                            <table class="std table-product-discounts">

                                <thead>

                                <tr>

                                    <th>{l s='Quantity'}</th>

                                    <th>{if $display_discount_price}{l s='Price'}{else}{l s='Discount'}{/if}</th>

                                    <th>{l s='You Save'}</th>

                                </tr>

                                </thead>

                                <tbody>

                                {foreach from=$quantity_discounts item='quantity_discount' name='quantity_discounts'}

                                    <tr id="quantityDiscount_{$quantity_discount.id_product_attribute}" class="quantityDiscount_{$quantity_discount.id_product_attribute}" data-discount-type="{$quantity_discount.reduction_type}" data-discount="{$quantity_discount.real_value|floatval}" data-discount-quantity="{$quantity_discount.quantity|intval}">

                                        <td>

                                            {$quantity_discount.quantity|intval}

                                        </td>

                                        <td>

                                            {if $quantity_discount.price >= 0 || $quantity_discount.reduction_type == 'amount'}

                                                {if $display_discount_price}

                                                    {convertPrice price=$productPrice-$quantity_discount.real_value|floatval}

                                                {else}

                                                    {convertPrice price=$quantity_discount.real_value|floatval}

                                                {/if}

                                            {else}

                                                {if $display_discount_price}

                                                    {convertPrice price = $productPrice-($productPrice*$quantity_discount.reduction)|floatval}

                                                {else}

                                                    {$quantity_discount.real_value|floatval}%

                                                {/if}

                                            {/if}

                                        </td>

                                        <td>

                                            <span>{l s='Up to'}</span>

                                            {if $quantity_discount.price >= 0 || $quantity_discount.reduction_type == 'amount'}

                                                {$discountPrice=$productPrice-$quantity_discount.real_value|floatval}

                                            {else}

                                                {$discountPrice=$productPrice-($productPrice*$quantity_discount.reduction)|floatval}

                                            {/if}

                                            {$discountPrice=$discountPrice*$quantity_discount.quantity}

                                            {$qtyProductPrice = $productPrice*$quantity_discount.quantity}

                                            {convertPrice price=$qtyProductPrice-$discountPrice}

                                        </td>

                                    </tr>

                                {/foreach}

                                </tbody>

                            </table>

                        </div>

                    </div>

                {/if}



                <!-- hook product footer -->

               
                <!-- END - hook product footer -->



            </div>

            <!-- END - Secondary Block -->



            {if (isset($HOOK_RIGHT_COLUMN) && $HOOK_RIGHT_COLUMN|trim && !$hide_right_column)}

                <!-- Right Column Hook -->

                <div id="product-right-column-hook" class="column col-3-12">

                    {$HOOK_RIGHT_COLUMN}

                </div>

                <!-- END - Right Column Hook -->

            {/if}

        </div>

	{/if}

	
	
	{if ($product->name)=='WorkFit-T'}
		
		
		<div style="display:none;">
		
		  <div id="embedvideo">
		       <iframe width="100%" src="//www.youtube.com/embed/uykQAdNpog4" frameborder="0" allowfullscreen></iframe>
		  </div>
		  <div style="clear:both;"></div>
		</div>
		
		
		{elseif ($product->name)=='Hush Desk'}
		
		
		<div style="display:none;">
		
		  <div id="embedvideo">
		      <iframe src="//player.vimeo.com/video/116860385" width="560" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
		       
		  </div>
		  <div style="clear:both;"></div>
		</div>




		
		
		
		
		{elseif ($product->name)=='Varidesk Pro 30' || ($product->name)=='Varidesk Pro 36'
         || ($product->name)=='Varidesk Pro Plus 30' || ($product->name)=='Varidesk Pro Plus 36'
         || ($product->name)=='Varidesk Pro Plus 48' || ($product->name)=='Varidesk Pro Plus 36 White'}
		
		<div style="display:none;">
		
		  <div id="embedvideo">
		      <iframe src="http://player.vimeo.com/video/119976615" width="560" height="315" frameborder="0" webkitallowfullscreen 
		      mozallowfullscreen allowfullscreen></iframe> 
		       
		  </div>
		  <div style="clear:both;"></div>
		</div>
		
		
		
		
		
		
		
		
		
		
		
		{elseif ($product->name)=='Sohodesk'}
		
		        <div style="display:none;">
		            <div id="ccolurs-d">
				      Available for orders of 5+ units - call 0333 220 0375 
					   <br/><br/>
		                <div class="ccolours-pics">
					       <img src="{$img_dir}/mypic/sohoccolours/black.JPG" width="100" alt="Black" title="Black"/> 
                           <img src="{$img_dir}/mypic/sohoccolours/yellow.jpg" width="100" alt="Yellow" title="Yellow"/>  
 						    <img src="{$img_dir}/mypic/sohoccolours/pink.JPG" width="100" alt="Pink" title="Pink"/>  
							<img src="{$img_dir}/mypic/sohoccolours/aquamarine.JPG" width="100" alt="Aqua Marine" title="Aqua Marine"/>  
							<img src="{$img_dir}/mypic/sohoccolours/royalblue.JPG" width="100" alt="Royal Blue" title="Royal Blue"/>  
							<img src="{$img_dir}/mypic/sohoccolours/rubyred.JPG" width="100" alt="Ruby Red" title="Ruby Red"/>  
						  
					    </div>
					 
		            </div>
		            <div style="clear:both;"></div>
		        </div>
			
		{/if}
	


{strip}

{if isset($smarty.get.ad) && $smarty.get.ad}

{addJsDefL name=ad}{$base_dir|cat:$smarty.get.ad|escape:'html':'UTF-8'}{/addJsDefL}

{/if}

{if isset($smarty.get.adtoken) && $smarty.get.adtoken}

{addJsDefL name=adtoken}{$smarty.get.adtoken|escape:'html':'UTF-8'}{/addJsDefL}

{/if}

{addJsDef allowBuyWhenOutOfStock=$allow_oosp|boolval}

{addJsDef availableNowValue=$product->available_now|escape:'quotes':'UTF-8'}

{addJsDef availableLaterValue=$product->available_later|escape:'quotes':'UTF-8'}

{addJsDef attribute_anchor_separator=$attribute_anchor_separator|addslashes}

{addJsDef attributesCombinations=$attributesCombinations}

{addJsDef currencySign=$currencySign|html_entity_decode:2:"UTF-8"}

{addJsDef currencyRate=$currencyRate|floatval}

{addJsDef currencyFormat=$currencyFormat|intval}

{addJsDef currencyBlank=$currencyBlank|intval}

{addJsDef currentDate=$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}

{if isset($combinations) && $combinations}

	{addJsDef combinations=$combinations}

    {addJsDef combinationsFromController=$combinations}

    {addJsDef displayDiscountPrice=$display_discount_price}

    {addJsDefL name='upToTxt'}{l s='Up to' js=1}{/addJsDefL}

{/if}

{if isset($combinationImages) && $combinationImages}

	{addJsDef combinationImages=$combinationImages}

{/if}

{addJsDef customizationFields=$customizationFields}

{addJsDef default_eco_tax=$product->ecotax|floatval}

{addJsDef displayPrice=$priceDisplay|intval}

{addJsDef ecotaxTax_rate=$ecotaxTax_rate|floatval}

{addJsDef group_reduction=$group_reduction}

{if isset($cover.id_image_only)}

	{addJsDef idDefaultImage=$cover.id_image_only|intval}

{else}

	{addJsDef idDefaultImage=0}

{/if}

{addJsDef img_ps_dir=$img_ps_dir}

{addJsDef img_prod_dir=$img_prod_dir}

{addJsDef id_product=$product->id|intval}

{addJsDef jqZoomEnabled=$jqZoomEnabled|boolval}

{addJsDef maxQuantityToAllowDisplayOfLastQuantityMessage=$last_qties|intval}

{addJsDef minimalQuantity=$product->minimal_quantity|intval}

{addJsDef noTaxForThisProduct=$no_tax|boolval}

{addJsDef oosHookJsCodeFunctions=Array()}

{addJsDef productHasAttributes=isset($groups)|boolval}

{addJsDef productPriceTaxExcluded=($product->getPriceWithoutReduct(true)|default:'null' - $product->ecotax)|floatval}

{addJsDef productBasePriceTaxExcluded=($product->base_price - $product->ecotax)|floatval}

{addJsDef productReference=$product->reference|escape:'html':'UTF-8'}

{addJsDef productAvailableForOrder=$product->available_for_order|boolval}

{addJsDef productPriceWithoutReduction=$productPriceWithoutReduction|floatval}




{addJsDef productPriceWithoutReductionIncVat=$productPriceWithoutReductionIncVat|floatval}
                                              



{addJsDef productPrice=$productPrice|floatval}

{addJsDef productUnitPriceRatio=$product->unit_price_ratio|floatval}

{addJsDef productShowPrice=(!$PS_CATALOG_MODE && $product->show_price)|boolval}

{addJsDef PS_CATALOG_MODE=$PS_CATALOG_MODE}

{if $product->specificPrice && $product->specificPrice|@count}

	{addJsDef product_specific_price=$product->specificPrice}

{else}

	{addJsDef product_specific_price=array()}

{/if}

{if $display_qties == 1 && $product->quantity}

	{addJsDef quantityAvailable=$product->quantity}

{else}

	{addJsDef quantityAvailable=0}

{/if}

{addJsDef quantitiesDisplayAllowed=$display_qties|boolval}

{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'percentage'}

	{addJsDef reduction_percent=$product->specificPrice.reduction*100|floatval}

{else}

	{addJsDef reduction_percent=0}

{/if}

{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'amount'}

	{addJsDef reduction_price=$product->specificPrice.reduction|floatval}

{else}

	{addJsDef reduction_price=0}

{/if}

{if $product->specificPrice && $product->specificPrice.price}

	{addJsDef specific_price=$product->specificPrice.price|floatval}

{else}

	{addJsDef specific_price=0}

{/if}

{addJsDef specific_currency=($product->specificPrice && $product->specificPrice.id_currency)|boolval} {* TODO: remove if always false *}

{addJsDef stock_management=$stock_management|intval}

{addJsDef taxRate=$tax_rate|floatval}

{addJsDefL name=doesntExist}{l s='This combination does not exist for this product. Please select another combination.' js=1}{/addJsDefL}

{addJsDefL name=doesntExistNoMore}{l s='This colour / size combination is not in stock.' js=1}{/addJsDefL}

{addJsDefL name=doesntExistNoMoreBut}{l s='Please try another combination.' js=1}{/addJsDefL}

{addJsDefL name=fieldRequired}{l s='Please fill in all the required fields before saving your customization.' js=1}{/addJsDefL}

{addJsDefL name=uploading_in_progress}{l s='Uploading in progress, please be patient.' js=1}{/addJsDefL}

{/strip}

{/if}

