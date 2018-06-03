<?php /* Smarty version Smarty-3.1.14, created on 2015-01-17 20:17:27
         compiled from "/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/hook/confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83566917554bab44b7fe911-74734232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb289c3a52ca2ef62c6e3767a3c326a1d10bdf8d' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/hook/confirmation.tpl',
      1 => 1421525833,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83566917554bab44b7fe911-74734232',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54bab44b85f1a7_05153914',
  'variables' => 
  array (
    'shop_name' => 0,
    'base_dir_ssl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bab44b85f1a7_05153914')) {function content_54bab44b85f1a7_05153914($_smarty_tpl) {?><div class="box cheque-box">
<h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Your order on','mod'=>'invoicepayment'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->tpl_vars['shop_name']->value;?>
</span> <?php echo smartyTranslate(array('s'=>'is complete.','mod'=>'invoicepayment'),$_smarty_tpl);?>
</h3>
	<p class="cheque-indent"><strong class="dark"><?php echo smartyTranslate(array('s'=>'You have chosen the bill method.','mod'=>'invoicepayment'),$_smarty_tpl);?>
</strong></p>
	<p>- <?php echo smartyTranslate(array('s'=>'Your order will be sent very soon.','mod'=>'invoicepayment'),$_smarty_tpl);?>
</p>
	<p>- <?php echo smartyTranslate(array('s'=>'For any questions or for further information, please contact our','mod'=>'invoicepayment'),$_smarty_tpl);?>
 <a class="dark" href="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
contact-us"><?php echo smartyTranslate(array('s'=>'customer support','mod'=>'invoicepayment'),$_smarty_tpl);?>
</a>.</p>
</div><?php }} ?>