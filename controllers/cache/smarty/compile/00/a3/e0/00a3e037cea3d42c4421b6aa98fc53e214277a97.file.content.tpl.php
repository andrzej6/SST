<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 23:52:10
         compiled from "/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67443485954ab23aa40f2b2-58067447%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00a3e037cea3d42c4421b6aa98fc53e214277a97' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/content.tpl',
      1 => 1419422138,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67443485954ab23aa40f2b2-58067447',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23aa419a77_17492461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23aa419a77_17492461')) {function content_54ab23aa419a77_17492461($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>

<?php if (isset($_smarty_tpl->tpl_vars['content']->value)){?>
	<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }?>
<?php }} ?>