<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:25:29
         compiled from "/home/gbs2/public_html/themes/autumn/specials.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27595065854ad5df91dc505-64149978%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3196b50f8a733c152e73d3d246a1cc1fdc254c6' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/specials.tpl',
      1 => 1419544504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27595065854ad5df91dc505-64149978',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'myfield' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5df9221585_21007137',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5df9221585_21007137')) {function content_54ad5df9221585_21007137($_smarty_tpl) {?><script>var myfield = <?php echo $_smarty_tpl->tpl_vars['myfield']->value;?>
;</script><?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?> Special Offers<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><div class="popup-pre"></div>                 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'myPopupHook'),$_smarty_tpl);?>
        <?php }} ?>