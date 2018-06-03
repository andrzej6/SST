<?php /* Smarty version Smarty-3.1.14, created on 2015-01-08 08:06:42
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/prices-drop.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171169969854ae3a926f21f2-63654934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87926bbe534607739b103a532e3eed72d8fcd208' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/prices-drop.tpl',
      1 => 1419544676,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171169969854ae3a926f21f2-63654934',
  'function' => 
  array (
  ),
  'variables' => 
  array (
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
  'unifunc' => 'content_54ae3a92c7fc03_84597990',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ae3a92c7fc03_84597990')) {function content_54ae3a92c7fc03_84597990($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Price drop'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1 class="page-header"><?php echo smartyTranslate(array('s'=>'Price drop'),$_smarty_tpl);?>
</h1>

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
    <p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'No price drop!'),$_smarty_tpl);?>
</p>
<?php }?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickView'=>$_smarty_tpl->tpl_vars['WPAC_quickView']->value),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewer'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewer']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewerAutoNext'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewerAutoNext']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'quickImageViewer'),$_smarty_tpl);?>
<?php }} ?>