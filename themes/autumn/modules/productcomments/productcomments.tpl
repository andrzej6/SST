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
* Do not edit or add to this file if you wish to upgrade PrestaShop to newersend_friend_form_content
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="product-tab-7" class="page-product-box tab-content-wrapper">
    <div class="tab-title" data-tab="product-tab-7"><span>{l s='Reviews' mod='productcomments'}</span></div>
	<div id="product_comments_block_tab" class="tab-content box">
		{if $comments}

			{foreach from=$comments item=comment}
				{if $comment.content}
                    <div class="comment row">

                        <div class="comment_author column col-3-12">
                            <div class="star_content">
                                {section name="i" start=0 loop=5 step=1}
                                    {if $comment.grade le $smarty.section.i.index}
                                        <div class="star"><span class="wpicon wpicon-star medium"></span></div>
                                    {else}
                                        <div class="star star_on"><span class="wpicon wpicon-star2 medium"></span></div>
                                    {/if}
                                {/section}
                            </div>

                            <div class="comment_author_infos">
                                <strong>{$comment.customer_name|escape:'html':'UTF-8'}</strong>
                                <em>{dateFormat date=$comment.date_add|escape:'html':'UTF-8' full=0}</em>
                            </div>
                        </div>

                        <div class="comment_details column col-9-12">
                            <p class="title_block">
                                <strong>{$comment.title}</strong>
                            </p>

                            <p>{$comment.content|escape:'html':'UTF-8'|nl2br}</p>

                            {if $comment.total_advice > 0 || $is_logged}
                                <ul>
                                    {if $comment.total_advice > 0}
                                        <li>
                                            {l s='%1$d out of %2$d people found this review useful.' sprintf=[$comment.total_useful,$comment.total_advice] mod='productcomments'}
                                        </li>
                                    {/if}

                                    {if $is_logged}
                                        {if !$comment.customer_advice}
                                        <li>
                                            <div>{l s='Was this comment useful to you?' mod='productcomments'}</div>
                                            <button class="usefulness_btn button-1 fill" data-is-usefull="1" data-id-product-comment="{$comment.id_product_comment}">
                                                <span>{l s='Yes' mod='productcomments'}</span>
                                            </button>
                                            <button class="usefulness_btn button-1 fill" data-is-usefull="0" data-id-product-comment="{$comment.id_product_comment}">
                                                <span>{l s='No' mod='productcomments'}</span>
                                            </button>
                                        </li>
                                        {/if}

                                    {/if}
                                </ul>
                            {/if}

                        </div>

				    </div>
				{/if}
			{/foreach}

			{if (!$too_early AND ($is_logged OR $allow_guests))}
                <a id="new_comment_tab_btn" class="button-1 fill inline open-comment-form" href="#new_comment_form">
                    <span>{l s='Write your review' mod='productcomments'}</span>
                </a>
			{/if}

		{else}

			{if (!$too_early AND ($is_logged OR $allow_guests))}
                <a id="new_comment_tab_btn" class="button-1 fill inline open-comment-form" href="#new_comment_form">
                    <span>{l s='Be the first to write your review' mod='productcomments'} </span>
                </a>
			{else}
			    <p>{l s='No customer comments for the moment.' mod='productcomments'}</p>
			{/if}

		{/if}	
	</div>
</div>

<!-- Fancybox -->
<div style="display: none;">
	<div id="new_comment_form">

		<form id="id_new_comment_form" action="#">
			<h3 class="section-header">
				{l s='Write a review' mod='productcomments'}
			</h3>

            {if isset($product) && $product}
                <div class="product row">
                    <img class="white-border-3px column col-3-12" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'atmn_large')|escape:'html':'UTF-8'}" alt="{$product->name|escape:'html':'UTF-8'}" />
                    <div class="product_desc column col-9-12">
                        <p class="product_name">
                            <strong>{$product->name}</strong>
                        </p>
                        {$product->description_short}
                    </div>
                </div>
            {/if}

            <div class="new_comment_form_content">
                <div id="new_comment_form_error" class="error" style="display: none;">
                    <ul></ul>
                </div>

                {if $criterions|@count > 0}
                    <ul id="criterions_list">
                    {foreach from=$criterions item='criterion'}
                        <li>
                            <label>{$criterion.name|escape:'html':'UTF-8'}:</label>
                            <div class="star_content">
                                <input class="star" type="radio" name="criterion[{$criterion.id_product_comment_criterion|round}]" value="1" />
                                <input class="star" type="radio" name="criterion[{$criterion.id_product_comment_criterion|round}]" value="2" />
                                <input class="star" type="radio" name="criterion[{$criterion.id_product_comment_criterion|round}]" value="3" />
                                <input class="star" type="radio" name="criterion[{$criterion.id_product_comment_criterion|round}]" value="4" />
                                <input class="star" type="radio" name="criterion[{$criterion.id_product_comment_criterion|round}]" value="5" checked="checked" />
                            </div>
                        </li>
                    {/foreach}
                    </ul>
                {/if}

                <label for="comment_title">
                    {l s='Title' mod='productcomments'}: <sup class="required">*</sup>
                </label>
                <input id="comment_title" name="title" type="text" value=""/>

                <label for="content">
                    {l s='Comment' mod='productcomments'}: <sup class="required">*</sup>
                </label>
                <textarea id="content" name="content" rows="20"></textarea>

                {if $allow_guests == true && !$is_logged}
                    <label>
                        {l s='Your name' mod='productcomments'}: <sup class="required">*</sup>
                    </label>
                    <input id="commentCustomerName" name="customer_name" type="text" value=""/>
                {/if}

                <div class="required"><sup>*</sup> {l s='Required fields' mod='productcomments'}</div>

                <div id="new_comment_form_footer">
                    <input id="id_product_comment_send" name="id_product" type="hidden" value='{$id_product_comment_form}' />
                    <button id="submitNewMessage" name="submitMessage" type="submit" class="button-1 fill">
                        <span>{l s='Send' mod='productcomments'}</span>
                    </button>
                    <a class="closefb" href="#">
                        {l s='Cancel' mod='productcomments'}
                    </a>
                </div>
            </div>
		</form>

	</div>
</div>
<!-- End fancybox -->
{strip}
{addJsDef productcomments_controller_url=$productcomments_controller_url|@addcslashes:'\''}
{addJsDef moderation_active=$moderation_active|boolval}
{addJsDef productcomments_url_rewrite=$productcomments_url_rewriting_activated|boolval}
{addJsDef secure_key=$secure_key}

{addJsDefL name=confirm_report_message}{l s='Are you sure you want report this comment?' mod='productcomments' js=1}{/addJsDefL}
{addJsDefL name=productcomment_added}{l s='Your comment has been added!' mod='productcomments' js=1}{/addJsDefL}
{addJsDefL name=productcomment_added_moderation}{l s='Your comment has been added and will be available once approved by a moderator' mod='productcomments' js=1}{/addJsDefL}
{addJsDefL name=productcomment_title}{l s='New comment' mod='productcomments' js=1}{/addJsDefL}
{addJsDefL name=productcomment_ok}{l s='OK' mod='productcomments' js=1}{/addJsDefL}
{/strip}