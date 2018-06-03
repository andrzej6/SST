<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 23:53:01
         compiled from "/home/gbs2/public_html/prestashop/modules/wpsearchblock/wpsearchblock-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106723260554ab23dd7391e9-68881890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2e060d0594c0906484b8190e17a5cd03a24735f' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/wpsearchblock/wpsearchblock-top.tpl',
      1 => 1419548294,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106723260554ab23dd7391e9-68881890',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hook_mobile' => 0,
    'link' => 0,
    'ENT_QUOTES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23dd77c9d0_38610621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23dd77c9d0_38610621')) {function content_54ab23dd77c9d0_38610621($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['hook_mobile']->value)){?>
    
    <div class="input_search" data-role="fieldcontain">
        <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('search');?>
" id="searchbox">
            <input type="hidden" name="controller" value="search" />
            <input type="hidden" name="orderby" value="position" />
            <input type="hidden" name="orderway" value="desc" />
            <input class="search_query" type="search" id="search_query_top" name="search_query" placeholder="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'wpsearchblock'),$_smarty_tpl);?>
" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->tpl_vars['ENT_QUOTES']->value,'utf-8'));?>
<?php }?>" />
        </form>
    </div>
                
<?php }else{ ?>

    <div id="search_block_top" class="wpsearchblock-open">
        

        <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('search');?>
" id="searchbox">
            <div class="search_block_top_form">
                <input type="hidden" name="controller" value="search" />
                <input type="hidden" name="orderby" value="position" />
                <input type="hidden" name="orderway" value="desc" />
               
                
                
               <input class="search_query" type="text" id="search_query_top" name="search_query" placeholder="<?php echo smartyTranslate(array('s'=>'search sit-stand.com','mod'=>'wpsearchblock'),$_smarty_tpl);?>
" />
            </div>
        </form>
                    
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['self']->value)."/wpsearchblock-instantsearch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>

<?php }?>

<?php }} ?>