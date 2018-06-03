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

{capture name=path}{l s='Search'}{/capture}

<h1 {if isset($instant_search) && $instant_search}id="instant_search_results"{/if} class="page-header {if !isset($instant_search) || (isset($instant_search) && !$instant_search)} product-listing{/if}">
    {if $nbProducts > 0}
        <span class="lighter">
            {if isset($search_query) && $search_query}
                {l s='Search'} "{$search_query|escape:'html':'UTF-8'}"
            {elseif $search_tag}
                {l s='Search'} "{$search_tag|escape:'html':'UTF-8'}"
            {elseif $ref}
                {l s='Search'} "{$ref|escape:'html':'UTF-8'}"
            {/if}
        </span>
    {/if}
</h1>

<div>
    {if isset($instant_search) && $instant_search}
        <a href="#" class="close button-2 fill">
            {l s='Return to the previous page'}
        </a>
    {else}
        <div class="alert alert-info">
            {if $nbProducts == 1}
                {l s='%d result has been found.' sprintf=$nbProducts|intval}
            {else}
                {l s='%d results have been found.' sprintf=$nbProducts|intval}
            {/if}
        </div>
{/if}
</div>

{include file="$tpl_dir./errors.tpl"}

{if !$nbProducts}

	<p class="alert alert-warning">
		{if isset($search_query) && $search_query}
			{l s='No results were found for your search'}&nbsp;"{if isset($search_query)}{$search_query|escape:'html':'UTF-8'}{/if}"
		{elseif isset($search_tag) && $search_tag}
			{l s='No results were found for your search'}&nbsp;"{$search_tag|escape:'html':'UTF-8'}"
		{else}
			{l s='Please enter a search keyword'}
		{/if}
	</p>

{else}

	{if isset($instant_search) && $instant_search}
        <p class="alert alert-info">
            {if $nbProducts == 1}{l s='%d result has been found.' sprintf=$nbProducts|intval}{else}{l s='%d results have been found.' sprintf=$nbProducts|intval}{/if}
        </p>
    {/if}

    <div class="content_sortPagiBar row">
        <div class="sortPagiBar column col-12-12 {if isset($instant_search) && $instant_search} instant_search{/if}">
            {include file="./product-compare.tpl"}

            <div class="align-right">
                {include file="$tpl_dir./category-view-type.tpl"}

                {if !isset($instant_search) || (isset($instant_search) && !$instant_search)}
                    {include file="./nbr-product-page.tpl"}
                {/if}

                {include file="./product-sort.tpl"}
            </div>
        </div>
    </div>

    <div class="product-list-grid grid grid-{if ($WPAC_categoryViewType == "grid")}{$WPAC_gridColumnSize}{elseif ($WPAC_categoryViewType == "list")}1 list{/if}{if isset($WPAC_categoryShowAvgRating) && !$WPAC_categoryShowAvgRating} hide-rating{/if}{if isset($WPAC_categoryShowColorOptions) && !$WPAC_categoryShowColorOptions} hide-color-options{/if}{if isset($WPAC_categoryShowStockInfo) && !$WPAC_categoryShowStockInfo} hide-stock-info{/if}{if isset($WPAC_quickView) && !$WPAC_quickView} hide-quickview{/if}">
        {include file="$tpl_dir./product-list.tpl" products=$search_products}
    </div>

    <div class="content_sortPagiBar bottom row">
        <div class="bottom-pagination-content column col-12-12">
        	{if !isset($instant_search) || (isset($instant_search) && !$instant_search)}
                {include file="./pagination.tpl" paginationId='bottom'}
            {/if}
        </div>
    </div>
{/if}

{addJsDef WPAC_quickView=$WPAC_quickView}

{*Custom Hook for Quick Image Viewer*}
{addJsDef WPAC_quickImageViewer=$WPAC_quickImageViewer}
{addJsDef WPAC_quickImageViewerAutoNext=$WPAC_quickImageViewerAutoNext}
{hook h='quickImageViewer'}