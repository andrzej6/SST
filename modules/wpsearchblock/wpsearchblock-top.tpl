{if isset($hook_mobile)}
    
    <div class="input_search" data-role="fieldcontain">
        <form method="get" action="{$link->getPageLink('search')}" id="searchbox">
            <input type="hidden" name="controller" value="search" />
            <input type="hidden" name="orderby" value="position" />
            <input type="hidden" name="orderway" value="desc" />
            <input class="search_query" type="search" id="search_query_top" name="search_query" placeholder="{l s='Search' mod='wpsearchblock'}" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|htmlentities:$ENT_QUOTES:'utf-8'|stripslashes}{/if}" />
        </form>
    </div>
                
{else}

    <div id="search_block_top" class="wpsearchblock-open">
        

        <form method="get" action="{$link->getPageLink('search')}" id="searchbox">
            <div class="search_block_top_form">
                <input type="hidden" name="controller" value="search" />
                <input type="hidden" name="orderby" value="position" />
                <input type="hidden" name="orderway" value="desc" />
               
                
                
               <input class="search_query" type="text" id="search_query_top" name="search_query" 
                      placeholder="&#x1f50d; search sit-stand.com" />
            </div>
        </form>
                    
        {include file="$self/wpsearchblock-instantsearch.tpl"}
    </div>

{/if}

