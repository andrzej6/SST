<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:05:36
         compiled from "/home/gbs2/public_html/themes/autumn/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214593737054ad59509238a1-09546487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b31156d0183a72211119b9c047f1160887e19808' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/breadcrumb.tpl',
      1 => 1419544535,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214593737054ad59509238a1-09546487',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'base_dir' => 0,
    'path' => 0,
    'category' => 0,
    'navigationPipe' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad59509a9c11_03780766',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad59509a9c11_03780766')) {function content_54ad59509a9c11_03780766($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/gbs2/public_html/tools/smarty/plugins/modifier.replace.php';
?><!-- Breadcrumb --><?php if (isset(Smarty::$_smarty_vars['capture']['path'])){?>    <?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(Smarty::$_smarty_vars['capture']['path'], null, 0);?><?php }?><div class="breadcrumb column col-12-12 <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='calculator'){?>bread-fix<?php }?>" xmlns:v="http://rdf.data-vocabulary.org/#">    <span typeof="v:Breadcrumb">        <a rel="v:url" class="breadcrumb-home wpicon-home2" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"></a>        <?php if (isset($_smarty_tpl->tpl_vars['path']->value)&&$_smarty_tpl->tpl_vars['path']->value){?>            <?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(smarty_modifier_replace($_smarty_tpl->tpl_vars['path']->value,'<a','<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title"'), null, 0);?>            <?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(smarty_modifier_replace($_smarty_tpl->tpl_vars['path']->value,'</span>','</span></span>'), null, 0);?>            <span class="navigation-pipe" <?php if (isset($_smarty_tpl->tpl_vars['category']->value)&&isset($_smarty_tpl->tpl_vars['category']->value->id_category)&&$_smarty_tpl->tpl_vars['category']->value->id_category==1){?>style="display:none;"<?php }?>>                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['navigationPipe']->value, ENT_QUOTES, 'UTF-8', true);?>
            </span>            </span>            <?php if (!strpos($_smarty_tpl->tpl_vars['path']->value,'span')){?>                <span class="navigation_page"><?php echo $_smarty_tpl->tpl_vars['path']->value;?>
</span>            <?php }else{ ?>                            <?php if (($_smarty_tpl->tpl_vars['page_name']->value=="product")){?>                    <span class="prodname"><?php echo $_smarty_tpl->tpl_vars['path']->value;?>
</span>                <?php }else{ ?>                    <?php echo $_smarty_tpl->tpl_vars['path']->value;?>
                <?php }?>                                                                <?php }?>        <?php }else{ ?>            </span>        <?php }?></div><?php if (isset($_GET['search_query'])&&isset($_GET['results'])&&$_GET['results']>1&&isset($_SERVER['HTTP_REFERER'])){?>    <div>        <br />        <br />        <a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER'], ENT_QUOTES, 'UTF-8', true);?>
" name="back" target="_parent" class="button-2 fill inline">            <?php echo smartyTranslate(array('s'=>'Back to Search results for "%s" (%d other results)','sprintf'=>array($_GET['search_query'],$_GET['results'])),$_smarty_tpl);?>
        </a>    </div><?php }?><!-- /Breadcrumb --><?php }} ?>