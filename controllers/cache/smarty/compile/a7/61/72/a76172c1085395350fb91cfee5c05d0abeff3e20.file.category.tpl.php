<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:24:55
         compiled from "/home/gbs2/public_html/themes/autumn/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:136541603254ad5dd7735522-62007908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a76172c1085395350fb91cfee5c05d0abeff3e20' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/category.tpl',
      1 => 1419544541,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136541603254ad5dd7735522-62007908',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'subcategories' => 0,
    'WPAC_subcategories' => 0,
    'subcategory' => 0,
    'link' => 0,
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
  'unifunc' => 'content_54ad5dd77f2918_85567236',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5dd77f2918_85567236')) {function content_54ad5dd77f2918_85567236($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['category']->value)){?>

	<?php if ($_smarty_tpl->tpl_vars['category']->value->id&&$_smarty_tpl->tpl_vars['category']->value->active){?>

        

        <?php if ($_smarty_tpl->tpl_vars['category']->value->description){?>
            <!-- Category desc. -->
            <div class="category-description row">
                <div class="column col-12-12">
                    <?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>

                </div>
            </div>
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['subcategories']->value)&&isset($_smarty_tpl->tpl_vars['WPAC_subcategories']->value)&&$_smarty_tpl->tpl_vars['WPAC_subcategories']->value){?>
            <!-- Subcategories -->
            <div id="subcategories" class="row">
                <div class="column col-12-12">
                    <h3 class="title-1"><?php echo smartyTranslate(array('s'=>'Subcategories'),$_smarty_tpl);?>
</h3>
                    <ul class="grid grid-6">
                    <?php  $_smarty_tpl->tpl_vars['subcategory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subcategory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subcategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->key => $_smarty_tpl->tpl_vars['subcategory']->value){
$_smarty_tpl->tpl_vars['subcategory']->_loop = true;
?>
                        <li class="item">
                            <div class="title">
                                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true);?>
">
                                    <span class="wpicon wpicon-tag medium"></span><span class="subcategory-name" ><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['subcategory']->value['name'],25,'...'), ENT_QUOTES, 'UTF-8', true),350);?>
</span>
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['products']->value){?>
			<div class="content_sortPagiBar row">
            	<div class="sortPagiBar column col-12-12">
                	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-view-type.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                   <?php echo $_smarty_tpl->getSubTemplate ("./nbr-product-page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            		    <?php echo $_smarty_tpl->getSubTemplate ("./product-sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


                    <div class="align-right">
                    
                         <?php echo $_smarty_tpl->getSubTemplate ("./product-compare.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                         
                         
                        
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
            <h1><?php echo smartyTranslate(array('s'=>'Coming Soon'),$_smarty_tpl);?>
</h1>
        <?php }?>

	<?php }elseif($_smarty_tpl->tpl_vars['category']->value->id){?>
		<p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'Coming Soon'),$_smarty_tpl);?>
</p>
	<?php }?>
<?php }?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickView'=>$_smarty_tpl->tpl_vars['WPAC_quickView']->value),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewer'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewer']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('WPAC_quickImageViewerAutoNext'=>$_smarty_tpl->tpl_vars['WPAC_quickImageViewerAutoNext']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'quickImageViewer'),$_smarty_tpl);?>
<?php }} ?>