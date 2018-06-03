<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 21:19:30
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockwishlist/my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1907575289549c7f621cc633-56577845%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f929d04ddd122f4aed62ec33f70efc7ddcea7d3' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockwishlist/my-account.tpl',
      1 => 1419541754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1907575289549c7f621cc633-56577845',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7f621df8a0_16462211',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7f621df8a0_16462211')) {function content_549c7f621df8a0_16462211($_smarty_tpl) {?>

<li class="item lnk_wishlist">
	<a 	href="<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist',array(),true));?>
" title="<?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>
">
        <span class="wpicon wpicon-gift xlarge"></span>
		<span><?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>
</span>
	</a>
</li><?php }} ?>