<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:25:07
         compiled from "/home/gbs2/public_html/themes/autumn/category-view-type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85734402454ad5de31204e4-82343425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c335909bf299ab4084a60e98a6ead8c8149817c' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/category-view-type.tpl',
      1 => 1419544552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85734402454ad5de31204e4-82343425',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WPAC_categoryViewType' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5de315f684_96006119',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5de315f684_96006119')) {function content_54ad5de315f684_96006119($_smarty_tpl) {?><div class="category-view-type">
    <span class="category-view-type-title"><?php echo smartyTranslate(array('s'=>'View:'),$_smarty_tpl);?>
</span>
    <a href="#" class="category-view-type-selector wpicon-list medium<?php if (($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=='list')){?> active<?php }?>" data-view-type="list" title="<?php echo smartyTranslate(array('s'=>'List View'),$_smarty_tpl);?>
"></a>
    <a href="#" class="category-view-type-selector wpicon-grid medium<?php if (($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=='grid')){?> active<?php }?>" data-view-type="grid" title="<?php echo smartyTranslate(array('s'=>'Grid View'),$_smarty_tpl);?>
"></a>
    
</div><?php }} ?>