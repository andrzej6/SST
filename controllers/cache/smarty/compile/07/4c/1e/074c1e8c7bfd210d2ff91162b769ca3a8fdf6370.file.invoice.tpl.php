<?php /* Smarty version Smarty-3.1.14, created on 2015-01-17 19:13:11
         compiled from "/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/hook/invoice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92696606654bab4477ac9a8-91440900%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '074c1e8c7bfd210d2ff91162b769ca3a8fdf6370' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/hook/invoice.tpl',
      1 => 1421424356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92696606654bab4477ac9a8-91440900',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shipping_date' => 0,
    'payment_info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54bab4477f5075_07637043',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bab4477f5075_07637043')) {function content_54bab4477f5075_07637043($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['shipping_date']->value)){?>
<p><?php echo smartyTranslate(array('s'=>'To be paid due','mod'=>'invoicepayment'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->tpl_vars['shipping_date']->value;?>
</p>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['payment_info']->value)){?>
<h3><?php echo smartyTranslate(array('s'=>'Payment info','mod'=>'invoicepayment'),$_smarty_tpl);?>
</h3>
<p><?php echo $_smarty_tpl->tpl_vars['payment_info']->value;?>
</p>
<?php }?><?php }} ?>