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

{if isset($no_follow) AND $no_follow}
	{assign var='no_follow_text' value='rel="nofollow"'}
{else}
	{assign var='no_follow_text' value=''}
{/if}

{if isset($p) AND $p}
	{if isset($smarty.get.id_category) && $smarty.get.id_category && isset($category)}
		{if !isset($current_url)}
			{assign var='requestPage' value=$link->getPaginationLink('category', $category, false, false, true, false)}
		{else}
			{assign var='requestPage' value=$current_url}
		{/if}
		{assign var='requestNb' value=$link->getPaginationLink('category', $category, true, false, false, true)}
	{elseif isset($smarty.get.id_manufacturer) && $smarty.get.id_manufacturer && isset($manufacturer)}
		{assign var='requestPage' value=$link->getPaginationLink('manufacturer', $manufacturer, false, false, true, false)}
		{assign var='requestNb' value=$link->getPaginationLink('manufacturer', $manufacturer, true, false, false, true)}
	{elseif isset($smarty.get.id_supplier) && $smarty.get.id_supplier && isset($supplier)}
		{assign var='requestPage' value=$link->getPaginationLink('supplier', $supplier, false, false, true, false)}
		{assign var='requestNb' value=$link->getPaginationLink('supplier', $supplier, true, false, false, true)}
	{else}
		{if !isset($current_url)}
			{assign var='requestPage' value=$link->getPaginationLink(false, false, false, false, true, false)}
		{else}
			{assign var='requestPage' value=$current_url}
		{/if}
		{assign var='requestNb' value=$link->getPaginationLink(false, false, true, false, false, true)}
	{/if}
	<!-- Pagination -->
	<div id="pagination{if isset($paginationId)}_{$paginationId}{/if}" class="pagination row parent">

        <div class="row valign-middle">
            <div class="product-count column {*{if ($nb_products > $products_per_page && $start!=$stop)}col-6-12{else}*}col-12-12{*{/if}*}">
                {if ($n*$p) < $nb_products }
                    {assign var='productShowing' value=$n*$p}
                {else}
                    {assign var='productShowing' value=($n*$p-$nb_products-$n*$p)*-1}
                {/if}

                {if $p==1}
                    {assign var='productShowingStart' value=1}
                {else}
                    {assign var='productShowingStart' value=$n*$p-$n+1}
                {/if}

                {if $nb_products > 1}
                    {l s='Showing %1$d - %2$d of %3$d items' sprintf=[$productShowingStart, $productShowing, $nb_products]}
                {else}
                    {l s='Showing %1$d - %2$d of 1 item' sprintf=[$productShowingStart, $productShowing]}
                {/if}
            </div>

            {*{if $nb_products > $products_per_page && $start!=$stop}
                <div class="column col-6-12 t-align-right">
                    <form class="showall" action="{if !is_array($requestNb)}{$requestNb}{else}{$requestNb.requestUrl}{/if}" method="get">
                        <div>
                            {if isset($search_query) AND $search_query}
                                <input type="hidden" name="search_query" value="{$search_query|escape:'html':'UTF-8'}" />
                            {/if}
                            {if isset($tag) AND $tag AND !is_array($tag)}
                                <input type="hidden" name="tag" value="{$tag|escape:'html':'UTF-8'}" />
                            {/if}
                            <button type="submit" class="button-2 fill">
                                <span>{l s='Show all'}</span>
                            </button>
                            {if is_array($requestNb)}
                                {foreach from=$requestNb item=requestValue key=requestKey}
                                    {if $requestKey != 'requestUrl'}
                                        <input type="hidden" name="{$requestKey|escape:'html':'UTF-8'}" value="{$requestValue|escape:'html':'UTF-8'}" />
                                    {/if}
                                {/foreach}
                            {/if}
                            <input name="n" id="nb_item" class="hide" value="{$nb_products}" />
                        </div>
                    </form>
                </div>
            {/if}*}
        </div>

		{if $start!=$stop}
            <div class="row">
                <ul class="pagination pagination-list column col-12-12 t-align-center">
                    {if $p != 1}
                        {assign var='p_previous' value=$p-1}
                        <li id="pagination_previous{if isset($paginationId)}_{$paginationId}{/if}" class="pagination_previous">
                            <a class="button-2 fill" {$no_follow_text} href="{$link->goPage($requestPage, $p_previous)}">{l s='Previous'}</a>
                        </li>
                    {else}
                        <li id="pagination_previous{if isset($paginationId)}_{$paginationId}{/if}" class="disabled pagination_previous">
                            <span class="button-2 fill disabled">{l s='Previous'}</span>
                        </li>
                    {/if}
                    {if $start==3}
                        <li>
                            <a class="button-2 fill" {$no_follow_text}  href="{$link->goPage($requestPage, 1)}">1</a>
                        </li>
                        <li>
                            <a class="button-2 fill" {$no_follow_text}  href="{$link->goPage($requestPage, 2)}">2</a>
                        </li>
                    {/if}
                    {if $start==2}
                        <li>
                            <a class="button-2 fill" {$no_follow_text}  href="{$link->goPage($requestPage, 1)}">1</a>
                        </li>
                    {/if}
                    {if $start>3}
                        <li>
                            <a class="button-2 fill" {$no_follow_text}  href="{$link->goPage($requestPage, 1)}">1</a>
                        </li>
                        <li class="truncate">
                            <span>...</span>
                        </li>
                    {/if}
                    {section name=pagination start=$start loop=$stop+1 step=1}
                        {if $p == $smarty.section.pagination.index}
                            <li class="active current">
                                <span class="button-2 fill disabled">{$p|escape:'html':'UTF-8'}</span>
                            </li>
                        {else}
                            <li>
                                <a class="button-2 fill" {$no_follow_text} href="{$link->goPage($requestPage, $smarty.section.pagination.index)}">
                                    {$smarty.section.pagination.index|escape:'html':'UTF-8'}
                                </a>
                            </li>
                        {/if}
                    {/section}
                    {if $pages_nb>$stop+2}
                        <li class="truncate">
                            <span>...</span>
                        </li>
                        <li>
                            <a class="button-2 fill" href="{$link->goPage($requestPage, $pages_nb)}">
                                {$pages_nb|intval}
                            </a>
                        </li>
                    {/if}
                    {if $pages_nb==$stop+1}
                        <li>
                            <a class="button-2 fill" href="{$link->goPage($requestPage, $pages_nb)}">
                                {$pages_nb|intval}
                            </a>
                        </li>
                    {/if}
                    {if $pages_nb==$stop+2}
                        <li>
                            <a class="button-2 fill" href="{$link->goPage($requestPage, $pages_nb-1)}">
                                {$pages_nb-1|intval}
                            </a>
                        </li>
                        <li>
                            <a class="button-2 fill" href="{$link->goPage($requestPage, $pages_nb)}">
                                {$pages_nb|intval}
                            </a>
                        </li>
                    {/if}
                    {if $pages_nb > 1 AND $p != $pages_nb}
                        {assign var='p_next' value=$p+1}
                        <li id="pagination_next{if isset($paginationId)}_{$paginationId}{/if}" class="pagination_next">
                            <a class="button-2 fill" {$no_follow_text} href="{$link->goPage($requestPage, $p_next)}">{l s='Next'}</a>
                        </li>
                    {else}
                        <li id="pagination_next{if isset($paginationId)}_{$paginationId}{/if}" class="disabled pagination_next">
                            <span class="button-2 fill disabled">{l s='Next'}</span>
                        </li>
                    {/if}
                </ul>
            </div>
		{/if}
	</div>
	<!-- /Pagination -->
{/if}
