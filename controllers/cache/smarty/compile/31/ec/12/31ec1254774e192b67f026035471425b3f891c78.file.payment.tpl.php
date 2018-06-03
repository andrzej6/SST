<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 13:18:28
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/cheque/views/templates/hook/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32991769754aa8f2488ebc9-53083100%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31ec1254774e192b67f026035471425b3f891c78' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/cheque/views/templates/hook/payment.tpl',
      1 => 1419545226,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32991769754aa8f2488ebc9-53083100',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54aa8f248a4855_60367608',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aa8f248a4855_60367608')) {function content_54aa8f248a4855_60367608($_smarty_tpl) {?>
<div class="row">
	<div class="column col-12-12">
        <div class="payment_module box">
            <a class="cheque" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('cheque','payment',array(),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Pay by check.','mod'=>'cheque'),$_smarty_tpl);?>
">
                <?php echo smartyTranslate(array('s'=>'Pay by check','mod'=>'cheque'),$_smarty_tpl);?>
 <span><?php echo smartyTranslate(array('s'=>'(order processing will be longer)','mod'=>'cheque'),$_smarty_tpl);?>
</span>
            </a>
        </div>
    </div>
</div>
<?php }} ?>