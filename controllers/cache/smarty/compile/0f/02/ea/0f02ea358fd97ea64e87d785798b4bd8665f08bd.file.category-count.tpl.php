<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:24:55
         compiled from "/home/gbs2/public_html/themes/autumn/category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12493208254ad5dd7946511-68680553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f02ea358fd97ea64e87d785798b4bd8665f08bd' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/category-count.tpl',
      1 => 1419544547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12493208254ad5dd7946511-68680553',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'nb_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5dd797eec1_01403272',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5dd797eec1_01403272')) {function content_54ad5dd797eec1_01403272($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['category']->value->id==1||$_smarty_tpl->tpl_vars['nb_products']->value==0){?><?php echo smartyTranslate(array('s'=>'No products!'),$_smarty_tpl);?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['nb_products']->value==1){?><?php echo smartyTranslate(array('s'=>'%d product','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d products','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php }?><?php }?><?php }} ?>