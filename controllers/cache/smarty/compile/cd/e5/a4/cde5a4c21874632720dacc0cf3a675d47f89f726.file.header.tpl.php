<?php /* Smarty version Smarty-3.1.14, created on 2014-12-30 09:24:03
         compiled from "/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/controllers/login/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145553550954a26f33588846-70164667%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cde5a4c21874632720dacc0cf3a675d47f89f726' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/controllers/login/header.tpl',
      1 => 1419425436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145553550954a26f33588846-70164667',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'iso' => 0,
    'shop_name' => 0,
    'meta_title' => 0,
    'navigationPipe' => 0,
    'css_files' => 0,
    'css_uri' => 0,
    'media' => 0,
    'js_files' => 0,
    'js_uri' => 0,
    'img_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54a26f335e0d04_40044772',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a26f335e0d04_40044772')) {function content_54a26f335e0d04_40044772($_smarty_tpl) {?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 lt-ie6"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 ie7"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 ie8"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9"> <![endif]-->
<html lang="<?php echo $_smarty_tpl->tpl_vars['iso']->value;?>
">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="robots" content="NOFOLLOW, NOINDEX">
		<title>
			<?php echo $_smarty_tpl->tpl_vars['shop_name']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['meta_title']->value!=''){?><?php if (isset($_smarty_tpl->tpl_vars['navigationPipe']->value)){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['navigationPipe']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?>&gt;<?php }?> <?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
<?php }?> (PrestaShop&trade;)
		</title>
		<?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['media']->_loop = false;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['css_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value){
$_smarty_tpl->tpl_vars['media']->_loop = true;
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
			<link href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" />
		<?php } ?>
		<?php  $_smarty_tpl->tpl_vars['js_uri'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js_uri']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['js_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->key => $_smarty_tpl->tpl_vars['js_uri']->value){
$_smarty_tpl->tpl_vars['js_uri']->_loop = true;
?>
			<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js_uri']->value;?>
"></script>
		<?php } ?>
		<script type="text/javascript" src="../js/login.js?<?php echo time();?>
"></script>
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
favicon.ico" />
	</head>
	<body class="bootstrap">
		<div id="login">
			<div id="content"><?php }} ?>