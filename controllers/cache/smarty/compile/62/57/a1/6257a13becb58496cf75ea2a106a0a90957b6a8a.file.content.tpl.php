<?php /* Smarty version Smarty-3.1.14, created on 2014-12-30 14:40:09
         compiled from "/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/controllers/cms_content/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210496021854a2b9499285c7-29219005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6257a13becb58496cf75ea2a106a0a90957b6a8a' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/controllers/cms_content/content.tpl',
      1 => 1419425406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210496021854a2b9499285c7-29219005',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cms_breadcrumb' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54a2b9499e79b9_24570005',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a2b9499e79b9_24570005')) {function content_54a2b9499e79b9_24570005($_smarty_tpl) {?>

<?php if (isset($_smarty_tpl->tpl_vars['cms_breadcrumb']->value)){?>
	<ul class="breadcrumb cat_bar">
		<?php echo $_smarty_tpl->tpl_vars['cms_breadcrumb']->value;?>

	</ul>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }} ?>