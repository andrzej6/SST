$(document).ready(function()
{
    $('#search_block_top').on('click', function(e)
    {
        if ($(window).width() >= 1024){
            if ($(this).hasClass('wpsearchblock-open')){
                $(this).removeClass('wpsearchblock-open');
            }
            else {
                $(this).addClass('wpsearchblock-open');
                $('#search_query_top').focus();
            }
        }

        e.stopPropagation();
    });

    $('#searchbox').on('click', function(e){
        e.stopPropagation();
    });

    $(document).on('click', function()
    {
        if ($('#search_block_top').hasClass('wpsearchblock-open')){
            $('#search_block_top').removeClass('wpsearchblock-open');
            $('.ac_results').hide();
        }
    });

});