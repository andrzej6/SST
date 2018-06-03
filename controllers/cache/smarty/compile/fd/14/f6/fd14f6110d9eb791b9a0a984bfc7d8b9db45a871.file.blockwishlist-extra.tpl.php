<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 21:21:20
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockwishlist/blockwishlist-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13015902549c7fd0bb0e39-95819359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd14f6110d9eb791b9a0a984bfc7d8b9db45a871' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockwishlist/blockwishlist-extra.tpl',
      1 => 1419541753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13015902549c7fd0bb0e39-95819359',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7fd0bbea80_53896427',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7fd0bbea80_53896427')) {function content_549c7fd0bbea80_53896427($_smarty_tpl) {?>

<div class="buy_block_wishlist_button t-align-center">
    <a id="wishlist_button" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['id_product']->value);?>
', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow"  title="<?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
">
        <span class="wpicon wpicon-flag medium"></span>
        <?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>

    </a>
</div><?php }} ?>