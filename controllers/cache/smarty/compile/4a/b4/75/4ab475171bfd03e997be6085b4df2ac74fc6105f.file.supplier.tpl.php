<?php /* Smarty version Smarty-3.1.14, created on 2015-01-08 08:09:56
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/supplier.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213453292554ae3b547bbc60-12751067%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ab475171bfd03e997be6085b4df2ac74fc6105f' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/supplier.tpl',
      1 => 1419544513,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213453292554ae3b547bbc60-12751067',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'supplier' => 0,
    'products' => 0,
    'WPAC_categoryViewType' => 0,
    'WPAC_gridColumnSize' => 0,
    'WPAC_categoryShowAvgRating' => 0,
    'WPAC_categoryShowColorOptions' => 0,
    'WPAC_categoryShowStockInfo' => 0,
    'WPAC_quickView' => 0,
    'WPAC_quickImageViewer' => 0,
    'WPAC_quickImageViewerAutoNext' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ae3b54897df7_63583443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ae3b54897df7_63583443')) {function content_54ae3b54897df7_63583443($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php if (!isset($_smarty_tpl->tpl_vars['errors']->value)||!sizeof($_smarty_tpl->tpl_vars['errors']->value)){?>
	<h1 class="page-heading product-listing">
		<?php echo smartyTranslate(array('s'=>'List of products by supplier'),$_smarty_tpl);?>
&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['supplier']->value->name, ENT_QUOTES, 'UTF-8', true);?>

	</h1>
	<?php if (!empty($_smarty_tpl->tpl_vars['supplier']->value->description)){?>
		<div class="description_box">
			<p><?php echo $_smarty_tpl->tpl_vars['supplier']->value->description;?>
</p>
		</div>
	<?php }?>

    <?php if ($_smarty_tpl->tpl_vars['products']->value){?>
        <div class="content_sortPagiBar row">
            <div class="sortPagiBar column col-12-12">
                <?php echo $_smarty_tpl->getSubTemplate ("./product-compare.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


                <div class="align-right">
                    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-view-type.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate ("./nbr-product-page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate ("./product-sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                </div>
            </div>
        </div>

        <div class="product-list-grid grid grid-<?php if (($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=="grid")){?><?php echo $_smarty_tpl->tpl_vars['WPAC_gridColumnSize']->value;?>
<?php }elseif(($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=="list")){?>1 list<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_categoryShowAvgRating']->value)&&!$_smarty_tpl->tpl_vars['WPAC_categoryShowAvgRating']->value){?> hide-rating<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_categoryShowColorOptions']->value)&&!$_smarty_tpl->tpl_vars['WPAC_categoryShowColorOptions']->value){?> hide-color-options<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_categoryShowStockInfo']->value)&&!$_smarty_tpl->tpl_vars['WPAC_categoryShowStockInfo']->value){?> hide-stock-info<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_quickView']->value)&&!$_smarty_tpl->tpl_vars['WPAC_quickView']->value){?> hide-quickview<?php }?>">
            <?php echo $_smarty_tpl->getSubTemplate ("./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('products'=>$_smarty_tpl->tpl_vars['products']->value), 0);?>

        </div>

        <div class="content_sortPagiBar bottom row">
            <div class="bottom-pagination-content column col-12-12">
                <?php echo $_smarty_tpl->getSubTemplate ("./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('paginationId'=>'bottom'), 0);?>

            </div>
        </div>
    <?php }else{ ?>
        <p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'No products for this supplier.'),$_smarty_tpl);?>
</p>
    <?php }?>
<?php }?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickView'=>$_smarty_tpl->tpl_vars['WPAC_quickView']->value),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewer'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewer']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewerAutoNext'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewerAutoNext']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'quickImageViewer'),$_smarty_tpl);?>
<?php }} ?>