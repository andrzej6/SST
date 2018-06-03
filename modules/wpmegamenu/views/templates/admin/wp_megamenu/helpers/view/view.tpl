<script>
    var wpmm_ajax_url = '{$wpmm_ajax_url}';
    var wpmm_id_wpmegamenu = {$wpmm_id_wpmegamenu};

    // Rich Text Editor related
    var iso = '{$iso|addslashes}';
    var pathCSS = '{$smarty.const._THEME_CSS_DIR_|addslashes}';
    var ad = '{$ad|addslashes}';
</script>

<div class="left-column col-lg-4">

    {* CUSTOM LINK FORM *}
    <form id="wpmm_customlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="1" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add Custom Link / Text'}
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                            <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                                <label for="wpmm_customlink_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_customlink_title_{$language.id_lang}" name="wpmm_customlink_title_{$language.id_lang}" class="clearable" />
                                </div>

                                {if $languages|count > 1}
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                            {$language.iso_code}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            {foreach from=$languages item=lang}
                                                <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                {/if}

                            {if $languages|count > 1}
                            </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                            <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                                <label for="wpmm_customlink_link_{$language.id_lang}" class="control-label col-lg-3">{l s='Link'}</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_customlink_link_{$language.id_lang}" name="wpmm_customlink_link_{$language.id_lang}" class="clearable" />
                                </div>

                                {if $languages|count > 1}
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                            {$language.iso_code}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            {foreach from=$languages item=lang}
                                                <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                {/if}

                            {if $languages|count > 1}
                            </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_customlink_submit" name="wpmm_customlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> {l s='Add Custom Link / Text'}
                </button>
            </div>
        </div>

    </form>
    {* END - CUSTOM LINK FORM *}



    {* CATEGORY LINK FORM *}
    <form id="wpmm_categorylink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="2" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add Category Link'}
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                            <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                                <label for="wpmm_categorylink_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_categorylink_title_{$language.id_lang}" name="wpmm_categorylink_title_{$language.id_lang}" class="wpmm_categorylink_title" />
                                </div>

                                {if $languages|count > 1}
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                            {$language.iso_code}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            {foreach from=$languages item=lang}
                                                <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                {/if}

                            {if $languages|count > 1}
                            </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                            <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                                <label for="wpmm_categorylink_link_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Link'}</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_categorylink_link_{$language.id_lang}" name="wpmm_categorylink_link_{$language.id_lang}" class="wpmm_categorylink_link" />
                                </div>

                                {if $languages|count > 1}
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                            {$language.iso_code}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            {foreach from=$languages item=lang}
                                                <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                {/if}

                            {if $languages|count > 1}
                            </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">

                        <label for="wpmm_categorylink_category" class="control-label col-lg-3">{l s='Category'}</label>
                        <div class="col-lg-7">
                            <select id="wpmm_categorylink_category" name="wpmm_categorylink_category">
                                {foreach $wpmmCategories as $wpmmCategory}
                                    <option value="{$wpmmCategory.value}">{$wpmmCategory.name}</option>
                                {/foreach}
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_categorylink_submit" name="wpmm_categorylink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> {l s='Add Category Link'}
                </button>
            </div>
        </div>

    </form>
    {* END - CATEGORY LINK FORM *}



    {* PRODUCT LINK FORM *}
    <form id="wpmm_productlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="3" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add Product Link'}
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_productlink_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_productlink_title_{$language.id_lang}" name="wpmm_productlink_title_{$language.id_lang}"  class="wpmm_productlink_title" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_productlink_link_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Link'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_productlink_link_{$language.id_lang}" name="wpmm_productlink_link_{$language.id_lang}" class="wpmm_productlink_link" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="wpmm_productlink_product" class="control-label col-lg-3">{l s='Product'}</label>
                        <div class="col-lg-7">
                            <input type="text" id="wpmm_productlink_product" name="wpmm_productlink_product" class="clearable" />
                            <p class="help-block">{l s='Start typing a product name...'}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_productlink_submit" name="wpmm_productlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> {l s='Add Product Link'}
                </button>
            </div>
        </div>

    </form>
    {* END - PRODUCT LINK FORM *}



    {* MANUFACTURER LINK FORM *}
    <form id="wpmm_manufacturerlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="4" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add Manufacturer Link'}
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_manufacturerlink_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_manufacturerlink_title_{$language.id_lang}" name="wpmm_manufacturerlink_title_{$language.id_lang}" class="wpmm_manufacturerlink_title" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_manufacturerlink_link_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Link'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_manufacturerlink_link_{$language.id_lang}" name="wpmm_manufacturerlink_link_{$language.id_lang}" class="wpmm_manufacturerlink_link" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">

                        <label for="wpmm_manufacturerlink_manufacturer" class="control-label col-lg-3">{l s='Manufacturer'}</label>
                        <div class="col-lg-7">
                            <select id="wpmm_manufacturerlink_manufacturer" name="wpmm_manufacturerlink_manufacturer">
                                {foreach $wpmmManufacturers as $wpmmManufacturer}
                                    <option value="{$wpmmManufacturer.value}">{$wpmmManufacturer.name}</option>
                                {/foreach}
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_manufacturerlink_submit" name="wpmm_manufacturerlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> {l s='Add Manufacturer Link'}
                </button>
            </div>
        </div>

    </form>
    {* END - MANUFACTURER LINK FORM *}



    {* SUPPLIER LINK FORM *}
    <form id="wpmm_supplierlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="5" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add Supplier Link'}
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_supplierlink_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_supplierlink_title_{$language.id_lang}" name="wpmm_supplierlink_title_{$language.id_lang}" class="wpmm_supplierlink_title" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_supplierlink_link_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Link'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_supplierlink_link_{$language.id_lang}" name="wpmm_supplierlink_link_{$language.id_lang}" class="wpmm_supplierlink_link" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">

                        <label for="wpmm_supplierlink_category" class="control-label col-lg-3">{l s='Supplier'}</label>
                        <div class="col-lg-7">
                            <select id="wpmm_supplierlink_supplier" name="wpmm_supplierlink_supplier">
                                {foreach $wpmmSuppliers as $wpmmSupplier}
                                    <option value="{$wpmmSupplier.value}">{$wpmmSupplier.name}</option>
                                {/foreach}
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_supplierlink_submit" name="wpmm_supplierlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> {l s='Add Supplier Link'}
                </button>
            </div>
        </div>

    </form>
    {* END - SUPPLIER LINK FORM *}



    {* CMS PAGE LINK FORM *}
    <form id="wpmm_cmspagelink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="6" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add CMS Page Link'}
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_cmspagelink_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_cmspagelink_title_{$language.id_lang}" name="wpmm_cmspagelink_title_{$language.id_lang}" class="wpmm_cmspagelink_title" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_cmspagelink_link_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Link'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_cmspagelink_link_{$language.id_lang}" name="wpmm_cmspagelink_link_{$language.id_lang}" class="wpmm_cmspagelink_link" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="wpmm_cmspagelink_cmspage" class="control-label col-lg-3">{l s='CMS Page'}</label>
                        <div class="col-lg-7">
                            <select id="wpmm_cmspagelink_cmspage" name="wpmm_cmspagelink_cmspage">
                                {$wpmmCMSPages}
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_cmspagelink_submit" name="wpmm_cmspagelink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> {l s='Add CMS Page Link'}
                </button>
            </div>
        </div>

    </form>
    {* END - CMS PAGE LINK FORM *}



    {* ADD CUSTOM CONTENT FORM *}
    <form id="wpmm_customcontent" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="7" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add Custom Content'}
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_customcontent_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_customcontent_title_{$language.id_lang}" name="wpmm_customcontent_title_{$language.id_lang}" value="Custom Content" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_customcontent_link_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Link'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_customcontent_link_{$language.id_lang}" name="wpmm_customcontent_link_{$language.id_lang}" value="customcontent" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <button type="submit" value="1"  id="wpmm_advanced_customcontent" name="wpmm_advanced_customcontent" class="btn btn-default wpmm_advanced_customcontent">
                        <i class="process-icon-new"></i> {l s='Add Custom Content'}
                    </button>
                </div>
            </div>

        </div>

    </form>
    {* END - ADD CUSTOM CONTENT FORM *}




    {* ADD DIVIDER FORM *}
    <form id="wpmm_divider" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="8" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> {l s='Add Divider'}
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_divider_title_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Title'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_divider_title_{$language.id_lang}" name="wpmm_divider_title_{$language.id_lang}" value="Divider" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group hidden">
                <div class="col-lg-12">
                    <div class="form-group">
                        {foreach from=$languages item=language}

                            {if $languages|count > 1}
                                <div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $id_default_lang}style="display:none"{/if}>
                            {/if}

                            <label for="wpmm_divider_link_{$language.id_lang}" class="control-label col-lg-3 required">{l s='Link'}</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_divider_link_{$language.id_lang}" name="wpmm_divider_link_{$language.id_lang}" value="divider" />
                            </div>

                            {if $languages|count > 1}
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        {$language.iso_code}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {foreach from=$languages item=lang}
                                            <li><a href="javascript:hideOtherLanguage({$lang.id_lang});" tabindex="-1">{$lang.name}</a></li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}

                            {if $languages|count > 1}
                                </div>
                            {/if}

                        {/foreach}
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <button type="submit" value="1"  id="wpmm_advanced_divider" name="wpmm_advanced_divider" class="btn btn-default wpmm_advanced_divider">
                        <i class="process-icon-new"></i> {l s='Add Divider'}
                    </button>
                </div>
            </div>

        </div>

    </form>
    {* END - ADD DIVIDER FORM *}

</div>

<div class="right-column col-lg-8">

    <div class="panel">
        <div class="panel-heading">
            <i class="icon-list"></i> {l s='Menu Structure'}
        </div>

        <div id="wpmmMenuBuilder">
            {include file='./menu_builder.tpl' wpmmMenuItems=$wpmmMenuItems}
        </div>
    </div>

</div>




