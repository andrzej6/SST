<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 13:18:28
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/bankwire/views/templates/hook/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112178996954aa8f2479ff27-81670841%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32b91b1cc0b66c4d20d68cc1c73dd5dd6fe7f120' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/bankwire/views/templates/hook/payment.tpl',
      1 => 1419545039,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112178996954aa8f2479ff27-81670841',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54aa8f247cfa03_96616876',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aa8f247cfa03_96616876')) {function content_54aa8f247cfa03_96616876($_smarty_tpl) {?>
<div class="row">
	<div class="column col-12-12">
        <div class="payment_module box">
            <a class="bankwire" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('bankwire','payment'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Pay by bank wire','mod'=>'bankwire'),$_smarty_tpl);?>
">
            	<?php echo smartyTranslate(array('s'=>'Pay by bank wire','mod'=>'bankwire'),$_smarty_tpl);?>
 <span><?php echo smartyTranslate(array('s'=>'(order processing will be longer)','mod'=>'bankwire'),$_smarty_tpl);?>
</span>
            </a>
        </div>
    </div>
</div><?php }} ?>