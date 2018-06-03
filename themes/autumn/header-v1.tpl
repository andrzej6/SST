<div class="header-v1">
    <section id="header_top" class="hide-below-1024">
        <div class="row">
            <div class="column col-12-12">
                <div class="custom-header-area">
                    {if isset($WPAC_customHeaderText)}
                        {$WPAC_customHeaderText}
                    {/if}
                </div>
                {include file="$tpl_dir./modules/blocklanguages/blocklanguages.tpl"}
                {include file="$tpl_dir./modules/blockcurrencies/blockcurrencies.tpl"}

                <div>
                    {include file="$tpl_dir./modules/blockuserinfo/blockuserinfo.tpl"}
                </div>
            </div>
        </div>
    </section>

    <section id="header_bottom">
        <h2 style="display:none;">Logo and Menu</h2>
        <div class="row valign-middle">

            <div id="logo" class="column col-for-logo">
               <a href="{$base_dir_ssl}" title="{$shop_name|escape:'htmlall':'UTF-8'}">
                   {* <img class="logo" src="{$logo_url}" alt="{$shop_name|escape:'htmlall':'UTF-8'}" />  *}
                   <img class="logo" src="{$base_dir_ssl}/img/logo-anim.gif" alt="{$shop_name|escape:'htmlall':'UTF-8'}" />
               </a>
            </div>

            <div id="header_menu" class="column col-8-12 hide-below-1024">
                {hook h='displayHeaderMenu'}
            </div>

            <div id="header_right" class="column col-for-basket t-align-right">
                {$HOOK_TOP}
            </div>
        </div>


        <div id="header_mobile_menu" class="soft-hide">
           {hook h='displayHeaderMenu' wpmegamenumobile=true}
        </div>

    </section>
</div>