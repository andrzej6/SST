<?php /* Smarty version Smarty-3.1.14, created on 2015-01-08 22:32:03
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167512276754af056390fb04-44629347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f98749d2432f23dfd325ab09878f1a89a7e0655a' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/search.tpl',
      1 => 1419544491,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167512276754af056390fb04-44629347',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'instant_search' => 0,
    'nbProducts' => 0,
    'search_query' => 0,
    'search_tag' => 0,
    'ref' => 0,
    'WPAC_categoryViewType' => 0,
    'WPAC_gridColumnSize' => 0,
    'WPAC_categoryShowAvgRating' => 0,
    'WPAC_categoryShowColorOptions' => 0,
    'WPAC_categoryShowStockInfo' => 0,
    'WPAC_quickView' => 0,
    'search_products' => 0,
    'WPAC_quickImageViewer' => 0,
    'WPAC_quickImageViewerAutoNext' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54af0563f0f742_91206466',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54af0563f0f742_91206466')) {function content_54af0563f0f742_91206466($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Search'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1 <?php if (isset($_smarty_tpl->tpl_vars['instant_search']->value)&&$_smarty_tpl->tpl_vars['instant_search']->value){?>id="instant_search_results"<?php }?> class="page-header <?php if (!isset($_smarty_tpl->tpl_vars['instant_search']->value)||(isset($_smarty_tpl->tpl_vars['instant_search']->value)&&!$_smarty_tpl->tpl_vars['instant_search']->value)){?> product-listing<?php }?>">
    <?php if ($_smarty_tpl->tpl_vars['nbProducts']->value>0){?>
        <span class="lighter">
            <?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)&&$_smarty_tpl->tpl_vars['search_query']->value){?>
                <?php echo smartyTranslate(array('s'=>'Search'),$_smarty_tpl);?>
 "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true);?>
"
            <?php }elseif($_smarty_tpl->tpl_vars['search_tag']->value){?>
                <?php echo smartyTranslate(array('s'=>'Search'),$_smarty_tpl);?>
 "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_tag']->value, ENT_QUOTES, 'UTF-8', true);?>
"
            <?php }elseif($_smarty_tpl->tpl_vars['ref']->value){?>
                <?php echo smartyTranslate(array('s'=>'Search'),$_smarty_tpl);?>
 "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ref']->value, ENT_QUOTES, 'UTF-8', true);?>
"
            <?php }?>
        </span>
    <?php }?>
</h1>

<div>
    <?php if (isset($_smarty_tpl->tpl_vars['instant_search']->value)&&$_smarty_tpl->tpl_vars['instant_search']->value){?>
        <a href="#" class="close button-2 fill">
            <?php echo smartyTranslate(array('s'=>'Return to the previous page'),$_smarty_tpl);?>

        </a>
    <?php }else{ ?>
        <div class="alert alert-info">
            <?php if ($_smarty_tpl->tpl_vars['nbProducts']->value==1){?>
                <?php echo smartyTranslate(array('s'=>'%d result has been found.','sprintf'=>intval($_smarty_tpl->tpl_vars['nbProducts']->value)),$_smarty_tpl);?>

            <?php }else{ ?>
                <?php echo smartyTranslate(array('s'=>'%d results have been found.','sprintf'=>intval($_smarty_tpl->tpl_vars['nbProducts']->value)),$_smarty_tpl);?>

            <?php }?>
        </div>
<?php }?>
</div>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php if (!$_smarty_tpl->tpl_vars['nbProducts']->value){?>

	<p class="alert alert-warning">
		<?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)&&$_smarty_tpl->tpl_vars['search_query']->value){?>
			<?php echo smartyTranslate(array('s'=>'No results were found for your search'),$_smarty_tpl);?>
&nbsp;"<?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?>"
		<?php }elseif(isset($_smarty_tpl->tpl_vars['search_tag']->value)&&$_smarty_tpl->tpl_vars['search_tag']->value){?>
			<?php echo smartyTranslate(array('s'=>'No results were found for your search'),$_smarty_tpl);?>
&nbsp;"<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_tag']->value, ENT_QUOTES, 'UTF-8', true);?>
"
		<?php }else{ ?>
			<?php echo smartyTranslate(array('s'=>'Please enter a search keyword'),$_smarty_tpl);?>

		<?php }?>
	</p>

<?php }else{ ?>

	<?php if (isset($_smarty_tpl->tpl_vars['instant_search']->value)&&$_smarty_tpl->tpl_vars['instant_search']->value){?>
        <p class="alert alert-info">
            <?php if ($_smarty_tpl->tpl_vars['nbProducts']->value==1){?><?php echo smartyTranslate(array('s'=>'%d result has been found.','sprintf'=>intval($_smarty_tpl->tpl_vars['nbProducts']->value)),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d results have been found.','sprintf'=>intval($_smarty_tpl->tpl_vars['nbProducts']->value)),$_smarty_tpl);?>
<?php }?>
        </p>
    <?php }?>

    <div class="content_sortPagiBar row">
        <div class="sortPagiBar column col-12-12 <?php if (isset($_smarty_tpl->tpl_vars['instant_search']->value)&&$_smarty_tpl->tpl_vars['instant_search']->value){?> instant_search<?php }?>">
            <?php echo $_smarty_tpl->getSubTemplate ("./product-compare.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


            <div class="align-right">
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-view-type.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


                <?php if (!isset($_smarty_tpl->tpl_vars['instant_search']->value)||(isset($_smarty_tpl->tpl_vars['instant_search']->value)&&!$_smarty_tpl->tpl_vars['instant_search']->value)){?>
                    <?php echo $_smarty_tpl->getSubTemplate ("./nbr-product-page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                <?php }?>

                <?php echo $_smarty_tpl->getSubTemplate ("./product-sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            </div>
        </div>
    </div>

    <div class="product-list-grid grid grid-<?php if (($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=="grid")){?><?php echo $_smarty_tpl->tpl_vars['WPAC_gridColumnSize']->value;?>
<?php }elseif(($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=="list")){?>1 list<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_categoryShowAvgRating']->value)&&!$_smarty_tpl->tpl_vars['WPAC_categoryShowAvgRating']->value){?> hide-rating<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_categoryShowColorOptions']->value)&&!$_smarty_tpl->tpl_vars['WPAC_categoryShowColorOptions']->value){?> hide-color-options<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_categoryShowStockInfo']->value)&&!$_smarty_tpl->tpl_vars['WPAC_categoryShowStockInfo']->value){?> hide-stock-info<?php }?><?php if (isset($_smarty_tpl->tpl_vars['WPAC_quickView']->value)&&!$_smarty_tpl->tpl_vars['WPAC_quickView']->value){?> hide-quickview<?php }?>">
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('products'=>$_smarty_tpl->tpl_vars['search_products']->value), 0);?>

    </div>

    <div class="content_sortPagiBar bottom row">
        <div class="bottom-pagination-content column col-12-12">
        	<?php if (!isset($_smarty_tpl->tpl_vars['instant_search']->value)||(isset($_smarty_tpl->tpl_vars['instant_search']->value)&&!$_smarty_tpl->tpl_vars['instant_search']->value)){?>
                <?php echo $_smarty_tpl->getSubTemplate ("./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('paginationId'=>'bottom'), 0);?>

            <?php }?>
        </div>
    </div>
<?php }?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickView'=>$_smarty_tpl->tpl_vars['WPAC_quickView']->value),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewer'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewer']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewerAutoNext'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewerAutoNext']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'quickImageViewer'),$_smarty_tpl);?>
<?php }} ?>