{extends file="helpers/list/list_content.tpl"}

{block name="td_content"}

    {if $key == 'slideImage'}

       <img src="{$tr.$key}" style="max-height:50px" />

    {else}

        {$smarty.block.parent}

    {/if}

{/block}
