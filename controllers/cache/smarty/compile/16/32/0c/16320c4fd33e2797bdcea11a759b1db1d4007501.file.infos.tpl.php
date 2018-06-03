<?php /* Smarty version Smarty-3.1.14, created on 2015-01-11 19:06:57
         compiled from "/home/gbs2/public_html/prestashop/modules/bankwire/views/templates/hook/infos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189672358154b2c9d1245a70-23513369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16320c4fd33e2797bdcea11a759b1db1d4007501' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/bankwire/views/templates/hook/infos.tpl',
      1 => 1421003208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189672358154b2c9d1245a70-23513369',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54b2c9d15c2e40_11532802',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b2c9d15c2e40_11532802')) {function content_54b2c9d15c2e40_11532802($_smarty_tpl) {?>

<div class="alert alert-info">
<img src="../modules/bankwire/bankwire.jpg" style="float:left; margin-right:15px;" width="86" height="49">
<p><strong><?php echo smartyTranslate(array('s'=>"This module allows you to accept secure payments by bank wire.",'mod'=>'bankwire'),$_smarty_tpl);?>
</strong></p>
<p><?php echo smartyTranslate(array('s'=>"If the client chooses to pay by bank wire, the order's status will change to 'Waiting for Payment.'",'mod'=>'bankwire'),$_smarty_tpl);?>
</p>
<p><?php echo smartyTranslate(array('s'=>"That said, you must manually confirm the order upon receiving the bank wire.",'mod'=>'bankwire'),$_smarty_tpl);?>
</p>
</div>
<?php }} ?>