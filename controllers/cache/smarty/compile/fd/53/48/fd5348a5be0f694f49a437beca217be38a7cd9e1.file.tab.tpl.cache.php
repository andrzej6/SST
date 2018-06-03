<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 20:59:21
         compiled from "/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/homefeatured/tab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1093314004549c7aa97031c8-52548038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd5348a5be0f694f49a437beca217be38a7cd9e1' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/homefeatured/tab.tpl',
      1 => 1419423114,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1093314004549c7aa97031c8-52548038',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'active_li' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7aa9710c97_93856521',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7aa9710c97_93856521')) {function content_549c7aa9710c97_93856521($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/home/gbs2/public_html/prestashop/tools/smarty/plugins/function.counter.php';
?>
<?php echo smarty_function_counter(array('name'=>'active_li','assign'=>'active_li'),$_smarty_tpl);?>

<li<?php if ($_smarty_tpl->tpl_vars['active_li']->value==1){?> class="active"<?php }?>><a data-toggle="tab" href="#homefeatured" class="homefeatured"><?php echo smartyTranslate(array('s'=>'Popular','mod'=>'homefeatured'),$_smarty_tpl);?>
</a></li><?php }} ?>