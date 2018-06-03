<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 21:21:45
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockwishlist/blockwishlist_button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:420859624549c7fe945e750-62769368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4d681d1ab4b51f078f473e55ded0fdeab72e20d' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockwishlist/blockwishlist_button.tpl',
      1 => 1419541754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '420859624549c7fe945e750-62769368',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7fe9471cb0_67935960',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7fe9471cb0_67935960')) {function content_549c7fe9471cb0_67935960($_smarty_tpl) {?>

<a class="add-to-wishlist addToWishlist wishlistProd_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="#" rel="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
', false, 1); return false;" title="<?php echo smartyTranslate(array('s'=>"Add to Wishlist",'mod'=>'blockwishlist'),$_smarty_tpl);?>
">
    <span class="wpicon wpicon-gift medium"></span>&nbsp;<?php echo smartyTranslate(array('s'=>"Add to Wishlist",'mod'=>'blockwishlist'),$_smarty_tpl);?>

</a>
<?php }} ?>