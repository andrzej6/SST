{extends file="helpers/form/form.tpl"}

{block name="label"}

    {if $input['name'] == 'carousel_content'}

    {else}
        {$smarty.block.parent}
    {/if}

{/block}

{block name="input"}

    {if $input.name == "product_autocomplete"}

        <div id="wpproductautocomplete">
            <div id="ajax_choose_product">
                <input type="text" value="" id="product_autocomplete_input" />
                <p class="preference_description">{l s='Begin typing the first letters of the product name, then select the product from the drop-down list. <br /> (Do not forget to save the tab afterward)'}</p>
            </div>

            <div id="product_list" style="font-weight:bold;">
                <ul>
                    {if (isset($carousel_content_products) && $carousel_content_products)}
                        {foreach $carousel_content_products as $carousel_content_product}
                            <li data-pid="{$carousel_content_product.id}">{$carousel_content_product.name} (ref: {$carousel_content_product.ref})<span class="delProduct" data-pid="{$carousel_content_product.id}" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span></li>
                        {/foreach}
                    {/if}
                </ul>
            </div>
        </div>

    {else}
        {$smarty.block.parent}
    {/if}

{/block}