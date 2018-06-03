$(document).ready(function(){

    // Hide main tab_content input
    $('#tab_content').parent().hide();
    $('#tab_content').parent().prev().hide();

    productAutocomplete.init();
    hideCategorySelector();
    hideAutocompleteBox();

    // Show correct element according to the selected tab_type when the page first loaded
    if ($('#tab_type option:selected').val() == 'category')
    {
        showCategorySelector();
        $('#select_category').val($('#tab_content').val());
    }
    else if ($('#tab_type option:selected').val() == 'custom')
    {
        showAutocompleteBox();
    }
    else
    {
        $('#tab_content').val('');
    }

    // Attach category id to the tab_content when category selector changed
    $('#select_category').on('change', function()
    {
        $('#tab_content').val($('#select_category option:selected').val());
    });

    // Show or hide elements according to the selected tab_type
    $('#tab_type').on('change', function()
    {
        if ($('#tab_type option:selected').val() == 'category')
        {
            hideAutocompleteBox();
            showCategorySelector();
            $('#tab_content').val($('#select_category').val());
        }
        else if ($('#tab_type option:selected').val() == 'custom')
        {
            hideCategorySelector();
            showAutocompleteBox();
            productAutocomplete.computeProductIds();
        }
        else
        {
            $('#tab_content').val('');
            hideCategorySelector();
            hideAutocompleteBox();
        }
    });

    function showCategorySelector(){
        $('#select_category').parent().show();
        $('#select_category').parent().prev().show();
    }

    function hideCategorySelector(){
        $('#select_category').parent().hide();
        $('#select_category').parent().prev().hide();
    }

    function showAutocompleteBox(){
        $('#wpproductautocomplete').show();
        $('#wpproductautocomplete').parent().prev().show();
    }

    function hideAutocompleteBox(){
        $('#wpproductautocomplete').hide();
        $('#wpproductautocomplete').parent().prev().hide();

    }

});