$(document).ready(function(){

    /* Add menu item */
    $('.wpmm_addmenuitemform').on('submit', function(e){
        e.preventDefault();
        var self = $(this);
        var serializedForm = $(this).serialize();

        $.ajax({
            type: 'POST',
            cache: false,
            url: wpmm_ajax_url,
            dataType: 'json',
            data: {
                controller: 'AdminWPMegamenu',
                action: 'addMenuItem',
                ajax: true,
                formData: serializedForm,
                id_wpmegamenu: wpmm_id_wpmegamenu
            },
            success: function(result){
                if (result.error){
                    alert(result.errorMessage);
                } else {
                    if(result.successMessage !== 1){
                        alert(result.successMessage);
                    } else {
                        // Clear the fields
                        self.find('.clearable').each(function(){
                           $(this).val("");
                        });

                        reloadSortable();
                    }
                }
            }
        });
    });

    /* Update menu item */
    $('#wpmmMenuBuilder').on('submit', '.wpmm_editmenuitemform', function(e){
        e.preventDefault();
        var serializedForm = $(this).serialize();

        $.ajax({
            type: 'POST',
            cache: false,
            url: wpmm_ajax_url,
            dataType: 'json',
            data: {
                controller: 'AdminWPMegamenu',
                action: 'updateMenuItem',
                ajax: true,
                formData: serializedForm,
                id_wpmegamenu: wpmm_id_wpmegamenu
            },
            success: function(result){
                if (result.error){
                    alert(result.errorMessage);
                } else {
                    if(result.successMessage !== 1){
                        alert(result.successMessage);
                    }

                    reloadSortable();
                }
            }
        });
    });

    /* Delete menu item */
    $('#wpmmMenuBuilder').on('click', '.wpmm_editmenu_delete', function(e){
        e.preventDefault();
        var itemIds = [];

        var parent = $(this).closest('.menuItem');
        var parentId = parent.attr('id').split('_');

        itemIds.push(parentId[1]);

        parent.find('.menuItem').each(function(){
           var id = $(this).attr('id').split('_');
            itemIds.push(id[1]);
        });

        $.ajax({
            type: 'POST',
            cache: false,
            async: true,
            url: wpmm_ajax_url,
            dataType: 'json',
            data: {
                controller: 'AdminWPMegamenu',
                action: 'deleteMenuItem',
                ajax: true,
                itemIds: itemIds
            },
            success: function(){
                reloadSortable();
            }
        });

    });

    /* Edit button */
    $('#wpmmMenuBuilder').on('click', '.edit-menu-item', function(){
       $(this).parents('.menuitem-container').find('.inline-editor-container').slideToggle(250);
    });

    /* Make sortable after document load */
    makeSortable();

    /* Init product autocomplete box */
    productAutocomplete.init();

    /* Init Rich Text Editor */
    initEditor();

    /* Select boxes */
    /* Category */
    $('.wpmm_categorylink_title').val($.trim($('#wpmm_categorylink_category option:selected').text()));
    $('.wpmm_categorylink_link').val($('#wpmm_categorylink_category option:selected').val());

    $('#wpmm_categorylink_category').on('change', function(){
        $('.wpmm_categorylink_title').val($.trim($('#wpmm_categorylink_category option:selected').text()));
        $('.wpmm_categorylink_link').val($('#wpmm_categorylink_category option:selected').val());
    });

    /* Manufacturer */
    $('.wpmm_manufacturerlink_title').val($('#wpmm_manufacturerlink_manufacturer option:selected').text());
    $('.wpmm_manufacturerlink_link').val($('#wpmm_manufacturerlink_manufacturer option:selected').val());

    $('#wpmm_manufacturerlink_manufacturer').on('change', function(){
        $('.wpmm_manufacturerlink_title').val($('#wpmm_manufacturerlink_manufacturer option:selected').text());
        $('.wpmm_manufacturerlink_link').val($('#wpmm_manufacturerlink_manufacturer option:selected').val());
    });

    /* Supplier */
    $('.wpmm_supplierlink_title').val($('#wpmm_supplierlink_supplier option:selected').text());
    $('.wpmm_supplierlink_link').val($('#wpmm_supplierlink_supplier option:selected').val());

    $('#wpmm_supplierlink_supplier').on('change', function(){
        $('.wpmm_supplierlink_title').val($('#wpmm_supplierlink_supplier option:selected').text());
        $('.wpmm_supplierlink_link').val($('#wpmm_supplierlink_supplier option:selected').val());
    });

    /* CMS Page */
    $('.wpmm_cmspagelink_title').val($.trim($('#wpmm_cmspagelink_cmspage option:selected').text()));
    $('.wpmm_cmspagelink_link').val($('#wpmm_cmspagelink_cmspage option:selected').val());

    $('#wpmm_cmspagelink_cmspage').on('change', function(){
        $('.wpmm_cmspagelink_title').val($.trim($('#wpmm_cmspagelink_cmspage option:selected').text()));
        $('.wpmm_cmspagelink_link').val($('#wpmm_cmspagelink_cmspage option:selected').val());
    });

});

function makeSortable(){

    $('.sortable').nestedSortable({
        handle: '.title',
        items: '.menuItem',
        toleranceElement: '.menuitem-container',
        forcePlaceholderSize: true,
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 15,
        tolerance: 'pointer',
        isTree: true,
        expandOnHover: 700,
        update: serializeSortable
    });

}

function serializeSortable(){

    var menuArray = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});

    $.ajax({
        type: 'POST',
        cache: false,
        async: true,
        url: wpmm_ajax_url,
        dataType: 'json',
        data: {
            controller: 'AdminWPMegamenu',
            action: 'saveSortable',
            ajax: true,
            menuArray: menuArray,
            id_wpmegamenu: wpmm_id_wpmegamenu
        }
    });


}

function reloadSortable(){

    $.ajax({
        type: 'POST',
        cache: false,
        async: true,
        url: wpmm_ajax_url,
        dataType: 'json',
        data: {
            controller: 'AdminWPMegamenu',
            action: 'reloadSortable',
            ajax: true,
            id_wpmegamenu: wpmm_id_wpmegamenu
        },
        success: function(result){
            $('#wpmmMenuBuilder').html(result);
            makeSortable();
            initEditor();
        }
    });

}

/* Product autocomplete function */
var productAutocomplete = new function (){
    var self = this;

    this.init = function()
    {
        $('#wpmm_productlink_product')
            .autocomplete('ajax_products_list.php', {
                minChars: 1,
                autoFill: true,
                max:20,
                matchContains: true,
                mustMatch:true,
                scroll:false,
                cacheLength:0,
                formatItem: function(item) {
                    return item[1]+' - '+item[0];
                }
            }).result(self.addProduct);
    };

    this.addProduct = function(event, data, formatted)
    {
        if (data == null)
            return false;
        var productId = data[1];
        var productName = data[0];

        $('.wpmm_productlink_title').val(productName);
        $('.wpmm_productlink_link').val(productId);
    };
};

/* Setup rich text editor */
function initEditor(){

    // First remove any instances of the editor
    var mceLength = tinyMCE.editors.length;
    if (mceLength > 0){
        for (var i=mceLength; i > 0; i--) {
            tinyMCE.editors[i-1].remove();
        }
    }

    tinySetup({
        editor_selector: "custom_content",
        inline: true
    });
}