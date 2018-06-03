{if $wpmanufacturercarousel.manufacturers}

    <div id="wpmanufacturercarousel" class="row parent">

        <div class="row">
            <div class="column col-12-12 title-1">
                {if ($wpmanufacturercarousel.mainTitle != '')}
                    {$wpmanufacturercarousel.mainTitle}
                {/if}
            </div>
        </div>

        <div class="row">
            <div class="column col-12-12">
                <div id="wpmanufacturercarousel-manufacturers" class="grid carousel-grid owl-carousel">

                    {foreach $wpmanufacturercarousel.manufacturers as $wpmanufacturer}
                        <div class="item">
                            <a class="img-wrapper" href="{$link->getmanufacturerLink($wpmanufacturer.id_manufacturer, $wpmanufacturer.link_rewrite)|escape:'htmlall':'UTF-8'}" title="{$wpmanufacturer.name|escape:'htmlall':'UTF-8'}">
                                <img src="{$img_manu_dir}{$wpmanufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}-atmn_medium.jpg" alt="{$wpmanufacturer.name|escape:'htmlall':'UTF-8'}" />
                            </a>
                        </div>
                    {/foreach}

                </div>
            </div>
        </div>

    </div>

    {if ($wpmanufacturercarousel.autoScroll)}
        {addJsDef wpmc_autoscroll=$wpmanufacturercarousel.autoScrollDelay}
    {else}
        {addJsDef wpmc_autoscroll=false}
    {/if}

    {if ($wpmanufacturercarousel.pauseOnHover)}
        {addJsDef wpmc_pauseonhover=true}
    {else}
        {addJsDef wpmc_pauseonhover=false}
    {/if}

{/if}