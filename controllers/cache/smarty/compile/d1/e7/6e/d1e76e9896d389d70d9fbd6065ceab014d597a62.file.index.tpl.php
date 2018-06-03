<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 22:04:02
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1648586238549c786018e8a1-51367948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1e76e9896d389d70d9fbd6065ceab014d597a62' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/index.tpl',
      1 => 1419544597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1648586238549c786018e8a1-51367948',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c78601f3784_58378667',
  'variables' => 
  array (
    'HOOK_HOME_TAB_CONTENT' => 0,
    'HOOK_HOME_TAB' => 0,
    'HOOK_HOME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c78601f3784_58378667')) {function content_549c78601f3784_58378667($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)){?>
    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)){?>
        <ul id="home-page-tabs" class="nav nav-tabs clearfix">
			<?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value;?>

		</ul>
	<?php }?>
	<div class="tab-content"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>
</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME']->value)){?>
	<?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

<?php }?><?php }} ?>