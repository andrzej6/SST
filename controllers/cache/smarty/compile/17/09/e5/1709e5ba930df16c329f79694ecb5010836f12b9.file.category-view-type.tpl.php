<?php /* Smarty version Smarty-3.1.14, created on 2014-12-26 00:14:11
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/category-view-type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1415668511549c7fe8981719-65391909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1709e5ba930df16c329f79694ecb5010836f12b9' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/category-view-type.tpl',
      1 => 1419544552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1415668511549c7fe8981719-65391909',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7fe8a38ee5_48669633',
  'variables' => 
  array (
    'WPAC_categoryViewType' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7fe8a38ee5_48669633')) {function content_549c7fe8a38ee5_48669633($_smarty_tpl) {?><div class="category-view-type">
    <span class="category-view-type-title"><?php echo smartyTranslate(array('s'=>'View:'),$_smarty_tpl);?>
</span>
    <a href="#" class="category-view-type-selector wpicon-list medium<?php if (($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=='list')){?> active<?php }?>" data-view-type="list" title="<?php echo smartyTranslate(array('s'=>'List View'),$_smarty_tpl);?>
"></a>
    <a href="#" class="category-view-type-selector wpicon-grid medium<?php if (($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=='grid')){?> active<?php }?>" data-view-type="grid" title="<?php echo smartyTranslate(array('s'=>'Grid View'),$_smarty_tpl);?>
"></a>
    
</div><?php }} ?>