{if $wpproductcarousels.carousels}

    <div id="wpproductcarousels" class="row parent">

        {foreach $wpproductcarousels.carousels as $carousel}

            {if ($carousel.products)}
                <div class="wpproductcarousel">
                    <div class="row">
                        <div class="column col-12-12 title-1">
                            {$carousel.title}
                        </div>
                    </div>

                    <div class="row">
                        <div class="column col-12-12">
                            <div class="wpproductcarousel-carousel grid carousel-grid owl-carousel">

                                {foreach $carousel.products as $product}

                                    {if $product}
                                        <div class="item">
                                            <div class="item-wrapper">

                                                <div class="item-upper-container">
                                                    <div class="item-image-container white-border-3px">
                                                        {if $product.new || $product.on_sale || $product.discount}
                                                            <div class="item-tag">
                                                                {if $product.new}
                                                                    <span class="item-tag-new">{l s='New' mod='wpproductcarousels'}</span>
                                                                {/if}

                                                                {if $product.on_sale}
                                                                    <span class="item-tag-discount">{l s='On sale!' mod='wpproductcarousels'}</span>
                                                                {elseif $product.discount}
                                                                    <span class="item-tag-discount">{l s='Discount!' mod='wpproductcarousels'}</span>
                                                                {/if}
                                                            </div>
                                                        {/if}

                                                        <a href="{$product.link}" class="item-image-link" title="{$product.name}">
                                                            <img class="item-image item-image-cover" src="{$product.image}" alt="{$product.name}"/>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="item-details">
                                                    <a href="{$product.link}" class="item-name-link" title="{$product.name}">
                                                        <span class="item-name">{$product.name}</span>
                                                    </a>

                                                    {if $wpproductcarousels.showPrice && $product.price}
                                                        <span class="item-price">
                                                            {$product.price}
                                                            {if $product.reduction}
                                                                <span class="item-old-price">{$product.price_without_reduction}</span>
                                                            {/if}
                                                        </span>
                                                    {/if}

                                                    {if isset($product.average_rating)}
                                                        <span class="item-rating">{$product.average_rating}</span>
                                                    {/if}

                                                    {if $wpproductcarousels.showCartBtn}
                                                        <div class="item-buttons">
                                                            {if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
                                                                {if ($product.allow_oosp || $product.quantity > 0)}
                                                                    {if isset($static_token)}
                                                                        <a class="ajax_add_to_cart_button button-2 fill add-to-cart" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='wpproductcarousels'}" data-id-product="{$product.id|intval}">
                                                                            <span class="wpicon wpicon-cart medium"></span><span>{l s='Add to cart' mod='wpproductcarousels'}</span>
                                                                        </a>
                                                                    {else}
                                                                        <a class="ajax_add_to_cart_button button-2 fill add-to-cart" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id|intval}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='wpproductcarousels'}" data-id-product="{$product.id|intval}">
                                                                            <span class="wpicon wpicon-cart medium"></span><span>{l s='Add to cart' mod='wpproductcarousels'}</span>
                                                                        </a>
                                                                    {/if}
                                                                {else}
                                                                    <a class="button-2 fill view_product_button view-product" href="{$product.link}" title="{l s='View Product' mod='wpproductcarousels'}">
                                                                        <span class="wpicon wpicon-eye2 medium"></span><span>{l s='View Product' mod='wpproductcarousels'}</span>
                                                                    </a>
                                                                {/if}
                                                            {/if}
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
            {/if}

        {/foreach}

    </div>

    {if ($wpproductcarousels.autoScroll)}
        {addJsDef wppc_autoscroll=$wpproductcarousels.autoScrollDelay}
    {else}
        {addJsDef wppc_autoscroll=false}
    {/if}

    {if ($wpproductcarousels.pauseOnHover)}
        {addJsDef wppc_pauseonhover=true}
    {else}
        {addJsDef wppc_pauseonhover=false}
    {/if}

{/if}