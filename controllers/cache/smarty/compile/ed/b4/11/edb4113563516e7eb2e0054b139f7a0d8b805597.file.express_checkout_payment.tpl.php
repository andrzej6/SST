<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 23:53:00
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/paypal/views/templates/hook/express_checkout_payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117812831054ab23dc222ad9-67175525%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edb4113563516e7eb2e0054b139f7a0d8b805597' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/paypal/views/templates/hook/express_checkout_payment.tpl',
      1 => 1419545297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117812831054ab23dc222ad9-67175525',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'use_mobile' => 0,
    'base_dir_ssl' => 0,
    'PayPal_lang_code' => 0,
    'logos' => 0,
    'PayPal_payment_method' => 0,
    'PayPal_integral' => 0,
    'PayPal_content' => 0,
    'PayPal_payment_type' => 0,
    'PayPal_current_page' => 0,
    'PayPal_tracking_code' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23dc2a5e77_86189363',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23dc2a5e77_86189363')) {function content_54ab23dc2a5e77_86189363($_smarty_tpl) {?>
<div class="row">
    <div class="column col-12-12">
        <div class="payment_module box">
            <a href="javascript:void(0)" onclick="$('#paypal_payment_form').submit();" id="paypal_process_payment" title="<?php echo smartyTranslate(array('s'=>'Pay with PayPal','mod'=>'paypal'),$_smarty_tpl);?>
">
                <?php if (isset($_smarty_tpl->tpl_vars['use_mobile']->value)&&$_smarty_tpl->tpl_vars['use_mobile']->value){?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/paypal/img/logos/express_checkout_mobile/CO_<?php echo $_smarty_tpl->tpl_vars['PayPal_lang_code']->value;?>
_orange_295x43.png" />
                <?php }else{ ?>
                    <?php if (isset($_smarty_tpl->tpl_vars['logos']->value['LocalPayPalHorizontalSolutionPP'])&&$_smarty_tpl->tpl_vars['PayPal_payment_method']->value==$_smarty_tpl->tpl_vars['PayPal_integral']->value){?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['logos']->value['LocalPayPalHorizontalSolutionPP'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['PayPal_content']->value['payment_choice'];?>
" height="48px" />
                    <?php }else{ ?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['logos']->value['LocalPayPalLogoMedium'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['PayPal_content']->value['payment_choice'];?>
" />
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['PayPal_content']->value['payment_choice'];?>

                <?php }?>

            </a>
        </div>
    </div>
</div>

<form id="paypal_payment_form" action="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/paypal/express_checkout/payment.php" data-ajax="false" title="<?php echo smartyTranslate(array('s'=>'Pay with PayPal','mod'=>'paypal'),$_smarty_tpl);?>
" method="post">
	<input type="hidden" name="express_checkout" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['PayPal_payment_type']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
	<input type="hidden" name="current_shop_url" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['PayPal_current_page']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
	<input type="hidden" name="bn" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['PayPal_tracking_code']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
</form>
<?php }} ?>