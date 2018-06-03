<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:35
         compiled from "/home/gbs2/public_html/modules/wpsearchblock/wpsearchblock-instantsearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85473311954ad5643d16256-78641576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '901c71c684285035e450188df9f3db448af41a43' => 
    array (
      0 => '/home/gbs2/public_html/modules/wpsearchblock/wpsearchblock-instantsearch.tpl',
      1 => 1419548291,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85473311954ad5643d16256-78641576',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'instantsearch' => 0,
    'blocksearch_type' => 0,
    'search_ssl' => 0,
    'link' => 0,
    'cookie' => 0,
    'ajaxsearch' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5643ddbca5_22647708',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5643ddbca5_22647708')) {function content_54ad5643ddbca5_22647708($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['instantsearch']->value){?>
    <script type="text/javascript">
        // <![CDATA[
        function tryToCloseInstantSearch() {
            if ($('#old_center_column').length > 0)
            {
                $('#center_column').remove();
                $('#old_center_column').attr('id', 'center_column');
                $('#center_column').show();
                return false;
            }
        }

        instantSearchQueries = new Array();
        function stopInstantSearchQueries() {
            for (i = 0; i < instantSearchQueries.length; i++) {
                instantSearchQueries[i].abort();
            }
            instantSearchQueries = new Array();
        }

        $("#search_query_<?php echo $_smarty_tpl->tpl_vars['blocksearch_type']->value;?>
").keyup(function() {
            if ($(this).val().length > 0) {
                stopInstantSearchQueries();
                instantSearchQuery = $.ajax({
                    url: '<?php if ($_smarty_tpl->tpl_vars['search_ssl']->value==1){?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('search',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('search');?>
<?php }?>',
                    data: {
                        instantSearch: 1,
                        id_lang: <?php echo $_smarty_tpl->tpl_vars['cookie']->value->id_lang;?>
,
                        q: $(this).val()
                    },
                    dataType: 'html',
                    type: 'POST',
                    success: function(data) {
                        if ($("#search_query_<?php echo $_smarty_tpl->tpl_vars['blocksearch_type']->value;?>
").val().length > 0)
                        {
                            tryToCloseInstantSearch();
                            $('#center_column').attr('id', 'old_center_column');
                            $('#old_center_column').after('<div id="center_column" class="' + $('#old_center_column').attr('class') + '">' + data + '</div>');
                            $('#old_center_column').hide();
                            $("#instant_search_results a.close").click(function() {
                                $("#search_query_<?php echo $_smarty_tpl->tpl_vars['blocksearch_type']->value;?>
").val('');
                                return tryToCloseInstantSearch();
                            });
                            return false;
                        }
                        else
                            tryToCloseInstantSearch();
                    }
                });
                instantSearchQueries.push(instantSearchQuery);
            }
            else
                tryToCloseInstantSearch();
        });
        // ]]>
    </script>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['ajaxsearch']->value){?>
    <script type="text/javascript">
        var moduleDir = "<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
";
        // <![CDATA[
        $('document').ready(function() {
            $("#search_query_<?php echo $_smarty_tpl->tpl_vars['blocksearch_type']->value;?>
").autocompleteCustom(moduleDir + "wpsearch_ajax.php", {
                minChars: 3,
                max: 9,
                width: 300,
                selectFirst: false,
                scroll: false,
                dataType: "json",
                formatItem: function(data, i, max, value, term) {
                    return value;
                },
                parse: function(data) {
                    var mytab = new Array();

                    for (var i = 0; i < data.length; i++) {

                        if (i == 8) {
                            var keyword = $("#search_query_<?php echo $_smarty_tpl->tpl_vars['blocksearch_type']->value;?>
").val();
                            data[i].pname = 'more_link';
                            data[i].product_link = keyword;
    
                            mytab[mytab.length] = { data: data[i], value: '<span class="ac_more_link"><?php echo smartyTranslate(array('s'=>'More Results...','mod'=>'wpsearchblock'),$_smarty_tpl);?>
</span>' };
                            
                            return mytab;
                        }
                        else {
                            if (data[i].pname.length > 35) {
                                var pname = jQuery.trim(data[i].pname).substring(0, 35).split(" ").slice(0, -1).join(" ") + "...";
                            } else {
                                var pname = data[i].pname;
                            }
                            mytab[mytab.length] = { data: data[i], value: '<img src="' + data[i].product_image + '" alt="' + data[i].pname + '" height="30" />' + '<span class="ac_product_name">' + pname + '</span>' };

                        }
                    }

                    return mytab;

                },
                extraParams: {
                    ajaxSearch: 1,
                    id_lang: <?php echo $_smarty_tpl->tpl_vars['cookie']->value->id_lang;?>

                }
                
            }).result(function(event, data, formatted) {
                if (data.pname == 'more_link') {
                    $('#search_query_<?php echo $_smarty_tpl->tpl_vars['blocksearch_type']->value;?>
').val(data.product_link);
                    $('#searchbox').submit();
                } else {
                    $('#search_query_<?php echo $_smarty_tpl->tpl_vars['blocksearch_type']->value;?>
').val(data.pname);
                    document.location.href = data.product_link;
                }
            })
        });
        // ]]>
    </script>
<?php }?><?php }} ?>