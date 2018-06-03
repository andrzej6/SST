<?php /* Smarty version Smarty-3.1.14, created on 2015-01-17 19:12:52
         compiled from "/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/front/validation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34459413154bab4340e7b69-38460975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25537389465325956b767f2578e375d54b63c7dd' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/invoicepayment/views/templates/front/validation.tpl',
      1 => 1421424356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34459413154bab4340e7b69-38460975',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'path_validation' => 0,
    'currencies' => 0,
    'total' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54bab434209eb3_21842648',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bab434209eb3_21842648')) {function content_54bab434209eb3_21842648($_smarty_tpl) {?><?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Bill payment.','mod'=>'invoicepayment'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<h1 class="page-heading"><?php echo smartyTranslate(array('s'=>'Order summation','mod'=>'invoicepayment'),$_smarty_tpl);?>
</h1>

<?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('payment', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<form action="<?php echo $_smarty_tpl->tpl_vars['path_validation']->value;?>
" method="post">
<div class="box cheque-box">
<h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Bill payment','mod'=>'invoicepayment'),$_smarty_tpl);?>
</h3>
	<input type="hidden" name="confirm" value="1" />
	<p class="cheque-indent"><strong class="dark"><?php echo smartyTranslate(array('s'=>'You have chosen the billing method.','mod'=>'invoicepayment'),$_smarty_tpl);?>
</strong></p>
	<p>- <?php echo smartyTranslate(array('s'=>'The total amount of your order is','mod'=>'invoicepayment'),$_smarty_tpl);?>
 <b id="amount_<?php echo $_smarty_tpl->tpl_vars['currencies']->value[0]['id_currency'];?>
" class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['total']->value),$_smarty_tpl);?>
</b> <?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'invoicepayment'),$_smarty_tpl);?>
</p>
	<p>- <?php echo smartyTranslate(array('s'=>'Please confirm your order by clicking \'I confirm my order\'','mod'=>'invoicepayment'),$_smarty_tpl);?>
.</p>
</div>
    <p class="cart_navigation clearfix" id="cart_navigation">
        <a class="button-exclusive btn btn-default" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,"step=3"), ENT_QUOTES, 'UTF-8', true);?>
"><i class="icon-chevron-left"></i><?php echo smartyTranslate(array('s'=>'Other payment methods','mod'=>'invoicepayment'),$_smarty_tpl);?>
</a>
        <button class="button btn btn-default button-medium"  type="submit"><span><?php echo smartyTranslate(array('s'=>'I confirm my order','mod'=>'invoicepayment'),$_smarty_tpl);?>
<i class="icon-chevron-right right"></i></span></button>
    </p>
</form>
<?php }} ?>