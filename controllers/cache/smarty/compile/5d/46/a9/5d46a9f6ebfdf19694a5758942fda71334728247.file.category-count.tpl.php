<?php /* Smarty version Smarty-3.1.14, created on 2014-12-26 00:14:12
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:277439964549c7fe992d8d6-39894949%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d46a9f6ebfdf19694a5758942fda71334728247' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/category-count.tpl',
      1 => 1419544547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277439964549c7fe992d8d6-39894949',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7fe9948160_90646318',
  'variables' => 
  array (
    'category' => 0,
    'nb_products' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7fe9948160_90646318')) {function content_549c7fe9948160_90646318($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['category']->value->id==1||$_smarty_tpl->tpl_vars['nb_products']->value==0){?><?php echo smartyTranslate(array('s'=>'No products!'),$_smarty_tpl);?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['nb_products']->value==1){?><?php echo smartyTranslate(array('s'=>'%d product','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d products','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php }?><?php }?><?php }} ?>