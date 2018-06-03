<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:33
         compiled from "/home/gbs2/public_html/modules/wpisotopetabs/views/templates/hook/wpisotopetabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:163265527754ad5641abc955-08949343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1a75d88db9b80a43e5cc7f889b967fd0da77133' => 
    array (
      0 => '/home/gbs2/public_html/modules/wpisotopetabs/views/templates/hook/wpisotopetabs.tpl',
      1 => 1419547957,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '163265527754ad5641abc955-08949343',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wpisotopetabs' => 0,
    'filter' => 0,
    'product' => 0,
    'add_prod_display' => 0,
    'restricted_country_mode' => 0,
    'PS_CATALOG_MODE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5641c00b82_18043862',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5641c00b82_18043862')) {function content_54ad5641c00b82_18043862($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['wpisotopetabs']->value['products']){?>    <div id="wpisotopetabs" class="row parent">        <div class="row">            <div class="column col-12-12">                <ul class="wpisotopetabs-filters">                    <?php  $_smarty_tpl->tpl_vars['filter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['filter']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['wpisotopetabs']->value['filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['filter']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['filter']->key => $_smarty_tpl->tpl_vars['filter']->value){
$_smarty_tpl->tpl_vars['filter']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['filter']->key;
 $_smarty_tpl->tpl_vars['filter']->index++;
 $_smarty_tpl->tpl_vars['filter']->first = $_smarty_tpl->tpl_vars['filter']->index === 0;
?>                        <li class="wpisotopetabs-filter">                            <a href="#" data-filter="<?php echo $_smarty_tpl->tpl_vars['filter']->value['filter'];?>
" class="<?php if ($_smarty_tpl->tpl_vars['filter']->first){?>active<?php }elseif($_smarty_tpl->tpl_vars['filter']->value['title']=='Special Offers'){?>overviewclass<?php }?>"><?php echo $_smarty_tpl->tpl_vars['filter']->value['title'];?>
</a>                        </li>                    <?php } ?>                </ul>            </div>        </div>        <div class="row">            <div class="column col-12-12">                <div class="wpisotopetabs-products">                    <ul class="isotope-grid grid grid-5">                        <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['wpisotopetabs']->value['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['product']->key;
?>                            <?php if ($_smarty_tpl->tpl_vars['product']->value){?>                                <li class="isotope-item item <?php echo $_smarty_tpl->tpl_vars['product']->value['type'];?>
">                                    <div class="item-wrapper">                                        <div class="item-upper-container">                                            <div class="item-image-container white-border-3px">                                                <?php if ($_smarty_tpl->tpl_vars['product']->value['new']||$_smarty_tpl->tpl_vars['product']->value['on_sale']||$_smarty_tpl->tpl_vars['product']->value['discount']){?>                                                    <div class="item-tag">                                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['new']){?>                                                            <span class="item-tag-new"><?php echo smartyTranslate(array('s'=>'New','mod'=>'wpisotopetabs'),$_smarty_tpl);?>
</span>                                                        <?php }?>                                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['on_sale']){?>                                                            <span class="item-tag-discount"><?php echo smartyTranslate(array('s'=>'On sale','mod'=>'wpisotopetabs'),$_smarty_tpl);?>
</span>                                                        <?php }elseif($_smarty_tpl->tpl_vars['product']->value['discount']){?>                                                            <span class="item-tag-discount"><?php echo smartyTranslate(array('s'=>'REDUCED','mod'=>'wpisotopetabs'),$_smarty_tpl);?>
</span>                                                        <?php }?>                                                    </div>                                                <?php }?>                                                <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" class="item-image-link img-wrapper" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
">                                                    <img class="item-image item-image-cover" src="<?php echo $_smarty_tpl->tpl_vars['product']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
"/>                                                </a>                                            </div>                                        </div>                                        <div class="item-details">                                           <div class="containslink">                                            <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" class="item-name-link" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
">                                                <span class="item-name"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</span>                                            </a>                                                                                        </div>                                            <?php if ($_smarty_tpl->tpl_vars['wpisotopetabs']->value['showPrice']&&$_smarty_tpl->tpl_vars['product']->value['price']){?>                                                <span class="item-price" <?php if ($_smarty_tpl->tpl_vars['product']->value['on_sale']||$_smarty_tpl->tpl_vars['product']->value['discount']){?> style="font-weight:bold" <?php }?>>                                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
 (Ex VAT)                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['reduction']){?>                                                        <div class="item-old-price">Was <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>
</div>                                                    <?php }?>                                                </span>                                            <?php }?>                                            <?php if (isset($_smarty_tpl->tpl_vars['product']->value['average_rating'])){?>                                                <span class="item-rating"><?php echo $_smarty_tpl->tpl_vars['product']->value['average_rating'];?>
</span>                                            <?php }?>                                            <?php if ($_smarty_tpl->tpl_vars['wpisotopetabs']->value['showCartBtn']){?>                                                <div class="item-buttons">                                                    <?php if (($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']==0||(isset($_smarty_tpl->tpl_vars['add_prod_display']->value)&&($_smarty_tpl->tpl_vars['add_prod_display']->value==1)))&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>                                                        <?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)){?>                                                           <a class="button-2 fill view_product_button view-product" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo smartyTranslate(array('s'=>'View Product','mod'=>'wpisotopetabs'),$_smarty_tpl);?>
">                                                                <span class="wpicon wpicon-eye2 medium"></span><span><?php echo smartyTranslate(array('s'=>'View Product','mod'=>'wpisotopetabs'),$_smarty_tpl);?>
</span>                                                            </a>                                                        <?php }?>                                                    <?php }?>                                                </div>                                            <?php }?>                                        </div>                                    </div>                                </li>                            <?php }?>                        <?php } ?>                        <li class="isotope-item item grid-sizer"></li>                    </ul>                </div>            </div>        </div>    </div><?php }?><?php }} ?>