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
{if isset($category)}

	{if $category->id AND $category->active}

        {*{if $scenes}
            <!-- Scenes -->
            <div class="content_scene row">
                {include file="$tpl_dir./scenes.tpl" scenes=$scenes}
            </div>
        {/if}*}

        {if $category->description}
            <!-- Category desc. -->
            <div class="category-description row">
                <div class="column col-12-12">
                    {$category->description}
                </div>
            </div>
        {/if}

        {if isset($subcategories) && isset($WPAC_subcategories) && $WPAC_subcategories}
            <!-- Subcategories -->
            <div id="subcategories" class="row">
                <div class="column col-12-12">
                    <h3 class="title-1">{l s='Subcategories'}</h3>
                    <ul class="grid grid-6">
                    {foreach from=$subcategories item=subcategory}
                        <li class="item">
                            <div class="title">
                                <a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}">
                                    <span class="wpicon wpicon-tag medium"></span><span class="subcategory-name" >{$subcategory.name|truncate:25:'...'|escape:'html':'UTF-8'|truncate:350}</span>
                                </a>
                            </div>
                        </li>
                    {/foreach}
                    </ul>
                </div>
            </div>
		{/if}

		{if $products}
			<div class="content_sortPagiBar row">
            	<div class="sortPagiBar column col-12-12">
                	{include file="$tpl_dir./category-view-type.tpl"}
                   {include file="./nbr-product-page.tpl"}
            		    {include file="./product-sort.tpl"}

                    <div class="align-right">
                    
                         {include file="./product-compare.tpl"}
                         
                         
                        
                    </div>
				</div>
			</div>

            <div class="product-list-grid grid grid-{if ($WPAC_categoryViewType == "grid")}{$WPAC_gridColumnSize}{elseif ($WPAC_categoryViewType == "list")}1 list{/if}{if isset($WPAC_categoryShowAvgRating) && !$WPAC_categoryShowAvgRating} hide-rating{/if}{if isset($WPAC_categoryShowColorOptions) && !$WPAC_categoryShowColorOptions} hide-color-options{/if}{if isset($WPAC_categoryShowStockInfo) && !$WPAC_categoryShowStockInfo} hide-stock-info{/if}{if isset($WPAC_quickView) && !$WPAC_quickView} hide-quickview{/if}">
			    {include file="./product-list.tpl" products=$products}
            </div>

			<div class="content_sortPagiBar bottom row">
				<div class="bottom-pagination-content column col-12-12">
                    {include file="./pagination.tpl" paginationId='bottom'}
				</div>
			</div>
        {else}
            <h1>{l s='Coming Soon'}</h1>
        {/if}

	{elseif $category->id}
		<p class="alert alert-warning">{l s='Coming Soon'}</p>
	{/if}
{/if}

{addJsDef WPAC_quickView=$WPAC_quickView}

{*Custom Hook for Quick Image Viewer*}
{addJsDef WPAC_quickImageViewer=$WPAC_quickImageViewer}
{addJsDef WPAC_quickImageViewerAutoNext=$WPAC_quickImageViewerAutoNext}
{hook h='quickImageViewer'}