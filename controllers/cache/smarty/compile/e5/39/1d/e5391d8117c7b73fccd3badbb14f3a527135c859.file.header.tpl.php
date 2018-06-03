<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 19:25:43
         compiled from "/home/gbs2/public_html/prestashop/modules/paypal/views/templates/admin/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178435683354aae53729aaf3-46460427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e5391d8117c7b73fccd3badbb14f3a527135c859' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/paypal/views/templates/admin/header.tpl',
      1 => 1420485924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178435683354aae53729aaf3-46460427',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PayPal_WPS' => 0,
    'PayPal_HSS' => 0,
    'PayPal_ECS' => 0,
    'PayPal_module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54aae5372f59d4_19946635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aae5372f59d4_19946635')) {function content_54aae5372f59d4_19946635($_smarty_tpl) {?>

<script type="text/javascript">
	var PayPal_WPS = '<?php echo intval($_smarty_tpl->tpl_vars['PayPal_WPS']->value);?>
';
	var PayPal_HSS = '<?php echo intval($_smarty_tpl->tpl_vars['PayPal_HSS']->value);?>
';
	var PayPal_ECS = '<?php echo intval($_smarty_tpl->tpl_vars['PayPal_ECS']->value);?>
';
</script>

<script type="text/javascript" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['PayPal_module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
/js/back_office.js"></script><?php }} ?>