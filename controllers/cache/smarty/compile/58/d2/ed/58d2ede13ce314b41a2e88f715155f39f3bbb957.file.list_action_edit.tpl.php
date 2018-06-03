<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 20:58:51
         compiled from "/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/helpers/list/list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:342392546549c7a8b5bd438-39311004%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '58d2ede13ce314b41a2e88f715155f39f3bbb957' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/helpers/list/list_action_edit.tpl',
      1 => 1419425549,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '342392546549c7a8b5bd438-39311004',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7a8b627334_98570089',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7a8b627334_98570089')) {function content_549c7a8b627334_98570089($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="edit">
	<i class="icon-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>