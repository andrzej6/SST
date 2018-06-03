<?php /* Smarty version Smarty-3.1.14, created on 2015-01-11 19:07:50
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/cheque/views/templates/hook/infos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:42528524954b2ca06de04c0-57762240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb9eb18137e2e8bea6190628db7ab9f0a7b0dfc2' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/cheque/views/templates/hook/infos.tpl',
      1 => 1419545223,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42528524954b2ca06de04c0-57762240',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54b2ca06e73d68_70744169',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b2ca06e73d68_70744169')) {function content_54b2ca06e73d68_70744169($_smarty_tpl) {?>

<div class="alert alert-info">
    <img src="../modules/cheque/cheque.jpg" style="float:left; margin-right:15px;" width="86" height="49">
    <p><strong><?php echo smartyTranslate(array('s'=>"This module allows you to accept payments by check.",'mod'=>'cheque'),$_smarty_tpl);?>
</strong></p>
    <p><?php echo smartyTranslate(array('s'=>"If the client chooses this payment method, the order status will change to 'Waiting for payment.'",'mod'=>'cheque'),$_smarty_tpl);?>
</p>
    <p><?php echo smartyTranslate(array('s'=>"You will need to manually confirm the order as soon as you receive a check.",'mod'=>'cheque'),$_smarty_tpl);?>
</p>
</div>
<?php }} ?>