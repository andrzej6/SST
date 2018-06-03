<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 20:59:56
         compiled from "/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/blockwishlist/blockwishlist-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:598859599549c7acc7cf273-69556820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff48e389f8a5352d8d8e7f82db418d89ea50fe90' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/default-bootstrap/modules/blockwishlist/blockwishlist-extra.tpl',
      1 => 1419423110,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '598859599549c7acc7cf273-69556820',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7acc8645c5_02427324',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7acc8645c5_02427324')) {function content_549c7acc8645c5_02427324($_smarty_tpl) {?>

<p class="buttons_bottom_block no-print">
	<a id="wishlist_button" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['id_product']->value);?>
', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow"  title="<?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
">
		<?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</p>
<?php }} ?>