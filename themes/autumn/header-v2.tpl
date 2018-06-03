<div class="header-v2">
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

        <div class="row valign-middle">
            <div id="logo" class="column col-6-12">
                <a href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}">
                    <img class="logo" src="{$logo_url}" alt="{$shop_name|escape:'htmlall':'UTF-8'}" />
                </a>
            </div>

            <div id="header_right" class="column col-6-12 t-align-right">
                <div id="header_search_wrapper">
                    {hook h='displayHeaderSearchBlock'}
                </div>

                <div id="header_cart_wrapper" class="hide-below-1024">
                    {$HOOK_TOP}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="divider column col-12-12 hide-below-1024"></div>
        </div>

        <div id="header_menu" class="row hide-below-1024">
            <div class="column col-12-12">
                {hook h='displayHeaderMenu'}
            </div>
        </div>

        <div id="header_mobile_menu" class="soft-hide">
            {hook h='displayHeaderMenu' wpmegamenumobile=true}
        </div>

    </section>
</div>