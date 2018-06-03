<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 20:59:21
         compiled from "/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/blocknewproducts/tab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1155586484549c7aa93d4400-70439779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8a2f709dbcfcc0c8a32679ec331d63d903b12c6' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/blocknewproducts/tab.tpl',
      1 => 1419423090,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1155586484549c7aa93d4400-70439779',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'active_li' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7aa93e1e49_19109846',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7aa93e1e49_19109846')) {function content_549c7aa93e1e49_19109846($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/home/gbs2/public_html/prestashop/tools/smarty/plugins/function.counter.php';
?>
<?php echo smarty_function_counter(array('name'=>'active_li','assign'=>'active_li'),$_smarty_tpl);?>

<li<?php if ($_smarty_tpl->tpl_vars['active_li']->value==1){?> class="active"<?php }?>><a data-toggle="tab" href="#blocknewproducts" class="blocknewproducts"><?php echo smartyTranslate(array('s'=>'New arrivals','mod'=>'blocknewproducts'),$_smarty_tpl);?>
</a></li><?php }} ?>