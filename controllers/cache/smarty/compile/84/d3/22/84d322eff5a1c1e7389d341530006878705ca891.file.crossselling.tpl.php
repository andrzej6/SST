<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 22:29:45
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcart/crossselling.tpl" */ ?>
<?php /*%%SmartyHeaderCode:992412860549c8fd9756091-27173854%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84d322eff5a1c1e7389d341530006878705ca891' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcart/crossselling.tpl',
      1 => 1419545059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '992412860549c8fd9756091-27173854',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orderProducts' => 0,
    'orderProduct' => 0,
    'link' => 0,
    'restricted_country_mode' => 0,
    'PS_CATALOG_MODE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c8fd9815631_40793639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c8fd9815631_40793639')) {function content_549c8fd9815631_40793639($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['orderProducts']->value)&&count($_smarty_tpl->tpl_vars['orderProducts']->value)>0){?>

    <div class="row crossseling-content">
        <div class="column col-12-12 title-1 t-align-left">
                <span class="colored-text"><?php echo smartyTranslate(array('s'=>'Customers who bought this product also bought:','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
        </div>
    </div>

    <div id="blockcart_crossselling_list" class="row">
        <div class="column col-12-12">

            <div id="blockcart-crossselling-carousel" class="grid carousel-grid owl-carousel">
                <?php  $_smarty_tpl->tpl_vars['orderProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['orderProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orderProducts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['orderProduct']->key => $_smarty_tpl->tpl_vars['orderProduct']->value){
$_smarty_tpl->tpl_vars['orderProduct']->_loop = true;
?>
                    <div class="product-box item">
                        <div class="item-wrapper">
                            <div class="item-upper-container">
                                <div class="item-image-container white-border-3px">
                                    <a class="img-wrapper" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
">
                                        <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['orderProduct']->value['link_rewrite'],$_smarty_tpl->tpl_vars['orderProduct']->value['id_image'],'atmn_normal'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
" />
                                    </a>
                                </div>
                            </div>

                            <div class="item-details">
                                <a class="item-name-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
">
                                    <span class="item-name"><?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['orderProduct']->value['name'],45,'...'), ENT_QUOTES, 'UTF-8', true);?>
</span>
                                </a>

                                <?php if ($_smarty_tpl->tpl_vars['orderProduct']->value['show_price']==1&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>
                                    <span class="item-price">
                                            <span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['orderProduct']->value['displayed_price']),$_smarty_tpl);?>
</span>
                                        </span>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>

<?php }?><?php }} ?>