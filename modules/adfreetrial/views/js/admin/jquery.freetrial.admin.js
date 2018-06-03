$(document).ready(function(){

    // Hide main tab_content input
    $('#tab_content').parent().hide();
    $('#tab_content').parent().prev().hide();

    productAutocomplete.init();
    //productAutocomplete.computeProductIds();
	showAutocompleteBox();

    function showAutocompleteBox(){
        $('#wpproductautocomplete').show();
        $('#wpproductautocomplete').parent().prev().show();
    }

});

var productAutocomplete = new function (){
    var self = this;

    this.init = function(){

        $('#product_autocomplete_input')
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

        $('#product_autocomplete_input').setOptions({
            extraParams: {
                excludeIds : self.getProductIds()
            }
        });

        $('#product_list').on('click', '.delProduct', function(){
            self.delProduct($(this).attr('data-pid'));
        });
    }

    this.addProduct = function(event, data, formatted)
    {
        if (data == null)
            return false;
        var productId = data[1];
        var productName = data[0];

        $('#product_list ul').append('<li data-pid="' + productId + '">' + productName + '<span class="delProduct" data-pid="' + productId + '" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span></li>');

        $('#tab_content').val('');

        self.computeProductIds();

        $('#product_autocomplete_input').val('');
        $('#product_autocomplete_input').setOptions({
            extraParams: { excludeIds : self.getProductIds() }
        });
    };

    this.delProduct = function(id)
    {
        $('#product_list ul').find('li[data-pid=' + id +']').remove();

        self.computeProductIds();

        $('#product_autocomplete_input').setOptions({
            extraParams: { excludeIds : self.getProductIds() }
        });
    }

    this.computeProductIds = function()
    {
        if ($('#product_list ul').find('li').length == 0) {
            $('#tab_content').val('');
        }
        else {
            $('#product_list ul').find('li').each(function(index){
                if (index != 0){
                    $('#tab_content').val($('#tab_content').val() + ',' + $(this).attr('data-pid'));
                } else {
                    $('#tab_content').val($(this).attr('data-pid'));
                }
            });
        }
    }

    this.getProductIds = function()
    {
        return  $('#tab_content').val();
    };
}