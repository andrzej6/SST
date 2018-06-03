<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 23:53:01
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89003081654ab23dd2c4303-93982180%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59f51f51451f1e88f0824833fb6fb2cb437d9aad' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/layout.tpl',
      1 => 1419544599,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89003081654ab23dd2c4303-93982180',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wp_restricted_access' => 0,
    'display_header' => 0,
    'HOOK_HEADER' => 0,
    'contentHeader' => 0,
    'template' => 0,
    'display_footer' => 0,
    'live_edit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23dd307108_65290136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23dd307108_65290136')) {function content_54ab23dd307108_65290136($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['contentHeader'] = new Smarty_variable('', null, 0);?>

<?php if (!isset($_smarty_tpl->tpl_vars['wp_restricted_access']->value)||isset($_smarty_tpl->tpl_vars['wp_restricted_access']->value)&&!$_smarty_tpl->tpl_vars['wp_restricted_access']->value){?>
    <?php if (file_exists(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./headers/".((string)$_smarty_tpl->tpl_vars['page_name']->value)."-header.tpl")){?>
        <?php $_smarty_tpl->tpl_vars['contentHeader'] = new Smarty_variable($_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./headers/".((string)$_smarty_tpl->tpl_vars['page_name']->value)."-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0));?>

    <?php }?>
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['display_header']->value)){?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('HOOK_HEADER'=>$_smarty_tpl->tpl_vars['HOOK_HEADER']->value,'CONTENT_HEADER'=>$_smarty_tpl->tpl_vars['contentHeader']->value), 0);?>
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['template']->value)){?><?php echo $_smarty_tpl->tpl_vars['template']->value;?>
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['display_footer']->value)){?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['live_edit']->value)){?><?php echo $_smarty_tpl->tpl_vars['live_edit']->value;?>
<?php }?><?php }} ?>