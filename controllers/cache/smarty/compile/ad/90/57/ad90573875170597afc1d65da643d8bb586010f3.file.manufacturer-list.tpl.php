<?php /* Smarty version Smarty-3.1.14, created on 2015-01-08 08:08:18
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/manufacturer-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45779490054ae3af2262ac3-00658322%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad90573875170597afc1d65da643d8bb586010f3' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/manufacturer-list.tpl',
      1 => 1419544608,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45779490054ae3af2262ac3-00658322',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nbManufacturers' => 0,
    'errors' => 0,
    'WPAC_categoryViewType' => 0,
    'WPAC_gridColumnSize' => 0,
    'manufacturers' => 0,
    'manufacturer' => 0,
    'link' => 0,
    'img_manu_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ae3af2477f51_43233116',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ae3af2477f51_43233116')) {function content_54ae3af2477f51_43233116($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Manufacturers'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1 class="page-header"><?php echo smartyTranslate(array('s'=>'Brands'),$_smarty_tpl);?>
</h1>

<div class="nbr_manufacturer"><?php if ($_smarty_tpl->tpl_vars['nbManufacturers']->value==0){?><?php echo smartyTranslate(array('s'=>'There are no manufacturers.'),$_smarty_tpl);?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['nbManufacturers']->value==1){?><?php echo smartyTranslate(array('s'=>'There is 1 brand'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'There are %d brands','sprintf'=>$_smarty_tpl->tpl_vars['nbManufacturers']->value),$_smarty_tpl);?>
<?php }?><?php }?></div>

<?php if (isset($_smarty_tpl->tpl_vars['errors']->value)&&$_smarty_tpl->tpl_vars['errors']->value){?>

    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php }else{ ?>

    <?php if ($_smarty_tpl->tpl_vars['nbManufacturers']->value>0){?>
        <ul id="manufacturers_list" class="grid grid-<?php if (($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=="grid")){?><?php echo $_smarty_tpl->tpl_vars['WPAC_gridColumnSize']->value;?>
<?php }elseif(($_smarty_tpl->tpl_vars['WPAC_categoryViewType']->value=="list")){?>1 list<?php }?>">
            <?php  $_smarty_tpl->tpl_vars['manufacturer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['manufacturer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['manufacturers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->key => $_smarty_tpl->tpl_vars['manufacturer']->value){
$_smarty_tpl->tpl_vars['manufacturer']->_loop = true;
?>
                <li class="item t-align-center white-border-3px">
                    <div class="left_side">
                        <!-- logo -->
                        <div class="logo">
                            <?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="lnk_img"><?php }?>
                                <img src="<?php echo $_smarty_tpl->tpl_vars['img_manu_dir']->value;?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['image'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
-atmn_medium.jpg" />
                                <?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?></a><?php }?>
                        </div>
                        <!-- name -->
                        <h3>
                            <?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php }?>
                                <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['manufacturer']->value['name'],60,'...'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                <?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?></a><?php }?>
                        </h3>

                        <p class="description rte">
                            <?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?>
                            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                                <?php }?>
                                <span><?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']==1){?><?php echo smartyTranslate(array('s'=>'%d product','sprintf'=>intval($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products'])),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d products','sprintf'=>intval($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products'])),$_smarty_tpl);?>
<?php }?></span>

                                <?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?>
                            </a>
                            <?php }?>
                        </p>
                    </div>

                    <div class="right_side">
                        <?php if ($_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?>
                            <a class="button-2 fill inline" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'View products'),$_smarty_tpl);?>
</a>
                        <?php }else{ ?>
                            <a class="button-2 fill inline disabled" ><?php echo smartyTranslate(array('s'=>'View products'),$_smarty_tpl);?>
</a>
                        <?php }?>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <div class="content_sortPagiBar bottom row">
            <div class="bottom-pagination-content column col-12-12">
                <?php echo $_smarty_tpl->getSubTemplate ("./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('paginationId'=>'bottom'), 0);?>

            </div>
        </div>
    <?php }?>

<?php }?><?php }} ?>