<?php /* Smarty version Smarty-3.1.14, created on 2015-01-02 17:30:45
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/specials.tpl" */ ?>
<?php /*%%SmartyHeaderCode:416835593549c84f41219c3-17326625%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '499fbd879f7ddfc5fbc35e08cb7198ac59436965' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/specials.tpl',
      1 => 1419544504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '416835593549c84f41219c3-17326625',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c84f415aab8_86841064',
  'variables' => 
  array (
    'myfield' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c84f415aab8_86841064')) {function content_549c84f415aab8_86841064($_smarty_tpl) {?><script>var myfield = <?php echo $_smarty_tpl->tpl_vars['myfield']->value;?>
;</script><?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?> Special Offers<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><div class="popup-pre"></div>                 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'myPopupHook'),$_smarty_tpl);?>
        <?php }} ?>