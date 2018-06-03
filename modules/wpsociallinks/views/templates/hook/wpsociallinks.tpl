{if $wpsociallinks.links}

    <div id="wpsociallinks">

        <div class="wpsociallinks-text">
            {l s='Connect with us:' mod='wpsociallinks'}
        </div>

        {foreach $wpsociallinks.links as $link name=slinks}

            <div class="wpsociallink">
                <a href="{$link.link}" {if ($link.open_in_new)}target="_blank"{/if}
                       title="Connect {if $smarty.foreach.slinks.iteration == 1}with Facebook
                                       {elseif $smarty.foreach.slinks.iteration == 2}with Twitter
                                       {elseif $smarty.foreach.slinks.iteration == 3}with Linked In
                                       {/if}">


                    {if (isset($link.custom_icon) && $link.custom_icon != '')}
                        <img src="{$wpsociallinks.iconPath}{$link.custom_icon}" />
                    {else}
                        <span class="wpicon medium2 wpicon-{$link.icon}"></span>
                    {/if}
                </a>
            </div>

        {/foreach}

    </div>

{/if}