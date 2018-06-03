{extends file="helpers/form/form.tpl"}
{block name="label"}

    {if $input['name'] == "WPAC_bodyBackgroundColor"}

        <br /><br /><br />
        {$smarty.block.parent}

    {elseif $input['name'] == "merge_oldnewsletter"}

        <strong>{l s='Please discard this area, if you did not use Autumn theme with Prestashop 1.5 before!'}</strong>

        <br />
        <br />

        {$smarty.block.parent}

    {else}
        {$smarty.block.parent}
    {/if}


{/block}

{block name="input"}

    {if $input.name == "WPAC_bodyBackgroundImage" || $input.name == "WPAC_backgroundImage"}

        {if isset($fields_value[$input.name]) && $fields_value[$input.name] != ''}
            <img src="{$imagePath}{$fields_value[$input.name]}" style="width:100%;max-width:100px;"/><br />
            <a href="{$current}&{$identifier}={$form_id}&token={$token}&deleteConfig={$input.name}">
                <img src="../img/admin/delete.gif" alt="{l s='Delete'}" /> {l s='Delete'}
            </a>
            <small>{l s='Do not forget to save the options after deleted the image!'}</small>
            <br /><br />
        {/if}

        {$smarty.block.parent}

    {elseif $input.name == "merge_oldnewsletter"}

        {if ($oldNewsletterTableExists && $newsletterInstalled)}

            <a class="important-button" href="{$current}&{$identifier}={$form_id}&token={$token}&mergeOldNewsletter=1">
                {l s='Merge Subscriptions'}
            </a>
            <br />
            <br />
            <span class="warning-text">
                {l s='You are seeing this option because you have "Autumn Theme - Newsletter Block with Extended Features" module from previous version of the theme.
                      You have to click "Merge Subscriptions" button in order to merge e-mail addresses, otherwise as soon as you remove the "Autumn Theme - Newsletter Block with Extended Features"
                      module, you will lose all of the e-mail addresses that subscribed to your shop using the footer newsletter block from the previous version of the theme.
                      After clicking the link, you may get further instructions, please check this area right after clicked the "Merge Subscriptions" button.'}
                <br />
                <br />
                {l s='Please make a database backup before clicking the "Merge Subscriptions" button.'}
            </span>

        {elseif ($oldNewsletterTableExists && !$newsletterInstalled)}

            <span class="warning-text">
                {l s='You have newsletter subscription data in your database from "Autumn Theme - Newsletter Block with Extended Features" module. Please make sure you have installed and enabled "Newsletter Block"
                      module. After that, you will be able to merge e-mail addresses from here.'}
            </span>

        {else}

            <span class="success-text">
                {l s='You have successfully merged e-mail addresses from "Autumn Theme - Newsletter Block with Extended Features" module. Please use the CSV export option from "Newsletter" module to make sure you have
                      all the e-mail addresses subscribed to your shop before. After that you should uninstall and remove the "Autumn Theme - Newsletter Block with Extended Features" and "Autumn Theme - Newsletter" modules
                      from Modules > Modules page.'}
            </span>

        {/if}

    {else}

        {$smarty.block.parent}

    {/if}

{/block}