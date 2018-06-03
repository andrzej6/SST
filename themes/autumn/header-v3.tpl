<div class="header-v3">
    <section id="header_top" class="hide-below-1024">
        <div class="row">
            <div class="column col-6-12">
                <div class="custom-header-area">
                    {if isset($WPAC_customHeaderText)}
                        {$WPAC_customHeaderText}
                    {/if}
                </div>
                {include file="$tpl_dir./modules/blocklanguages/blocklanguages.tpl"}
                {include file="$tpl_dir./modules/blockcurrencies/blockcurrencies.tpl"}
            </div>

            <div class="column col-6-12">
                <div class="align-right">
                    {include file="$tpl_dir./modules/blockuserinfo/blockuserinfo.tpl"}
                </div>
            </div>
        </div>
    </section>

    <section id="header_bottom">
        <div class="row">
            <div id="logo" class="column col-12-12 t-align-center">
                <a href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}">
                    <img class="logo" src="{$logo_url}" alt="{$shop_name|escape:'htmlall':'UTF-8'}" />
                </a>
            </div>
        </div>

        <div class="row">
            <div class="column col-12-12 divider hide-below-1024"></div>
        </div>

        <div class="row valign-middle">
            <div class="column col-12-12 t-align-center">
                <div id="header_menu" class="hide-below-1024">
                    {hook h='displayHeaderMenu'}
                </div>

                <div id="header_right">
                    <div id="header_search_wrapper">
                        {hook h='displayHeaderSearchBlock'}
                    </div>

                    <div id="header_cart_wrapper" class="hide-below-1024">
                        {$HOOK_TOP}
                    </div>
                </div>
            </div>
        </div>

        <div id="header_mobile_menu" class="soft-hide">
            {hook h='displayHeaderMenu' wpmegamenumobile=true}
        </div>
    </section>
</div>
