<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 21:00:31
         compiled from "/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/blockwishlist/blockwishlist_button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:555000746549c7aefa26b24-57259497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b7effd220624c7a284885e533ec4c3244709883' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/blockwishlist/blockwishlist_button.tpl',
      1 => 1419423111,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '555000746549c7aefa26b24-57259497',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7aefa38744_82073616',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7aefa38744_82073616')) {function content_549c7aefa38744_82073616($_smarty_tpl) {?>

<div class="wishlist">
	<a class="addToWishlist wishlistProd_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="#" rel="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
', false, 1); return false;">
		<?php echo smartyTranslate(array('s'=>"Add to Wishlist",'mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</div><?php }} ?>