<?php /* Smarty version Smarty-3.1.14, created on 2015-01-17 20:04:56
         compiled from "/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/hook/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162712818954bab428c41c61-74416402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27d0eada53f02d9a8ca877f8d1c13c51e5a72d95' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/hook/payment.tpl',
      1 => 1421525049,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162712818954bab428c41c61-74416402',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54bab428cde978_28380104',
  'variables' => 
  array (
    'module_dir' => 0,
    'path_validation' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bab428cde978_28380104')) {function content_54bab428cde978_28380104($_smarty_tpl) {?><style>
p.payment_module a.invoice {  background: url("<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
img/invoice.png") no-repeat scroll 15px 15px #FBFBFB; }
</style>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <p class="payment_module box">
            <a class="bankwire invoice" href="<?php echo $_smarty_tpl->tpl_vars['path_validation']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Pay with invoice','mod'=>'invoicepayment'),$_smarty_tpl);?>
">
                <?php echo smartyTranslate(array('s'=>'Pay with invoice','mod'=>'invoicepayment'),$_smarty_tpl);?>
 
            </a>
        </p>
    </div>
</div><?php }} ?>