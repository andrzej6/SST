<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 22:58:47
         compiled from "/home/gbs2/public_html/prestashop/modules/wpmanufacturercarousel/views/templates/hook/wpmanufacturercarousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1410524398549c78600f5537-59674995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c001e8177e2c49a185322cc3ababf7473fad7b46' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/wpmanufacturercarousel/views/templates/hook/wpmanufacturercarousel.tpl',
      1 => 1419548008,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1410524398549c78600f5537-59674995',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c786016bfb1_50325664',
  'variables' => 
  array (
    'wpmanufacturercarousel' => 0,
    'wpmanufacturer' => 0,
    'link' => 0,
    'img_manu_dir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c786016bfb1_50325664')) {function content_549c786016bfb1_50325664($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['wpmanufacturercarousel']->value['manufacturers']){?>

    <div id="wpmanufacturercarousel" class="row parent">

        <div class="row">
            <div class="column col-12-12 title-1">
                <?php if (($_smarty_tpl->tpl_vars['wpmanufacturercarousel']->value['mainTitle']!='')){?>
                    <?php echo $_smarty_tpl->tpl_vars['wpmanufacturercarousel']->value['mainTitle'];?>

                <?php }?>
            </div>
        </div>

        <div class="row">
            <div class="column col-12-12">
                <div id="wpmanufacturercarousel-manufacturers" class="grid carousel-grid owl-carousel">

                    <?php  $_smarty_tpl->tpl_vars['wpmanufacturer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wpmanufacturer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpmanufacturercarousel']->value['manufacturers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wpmanufacturer']->key => $_smarty_tpl->tpl_vars['wpmanufacturer']->value){
$_smarty_tpl->tpl_vars['wpmanufacturer']->_loop = true;
?>
                        <div class="item">
                            <a class="img-wrapper" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['wpmanufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['wpmanufacturer']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['wpmanufacturer']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['img_manu_dir']->value;?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['wpmanufacturer']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
-atmn_medium.jpg" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['wpmanufacturer']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

    </div>

    <?php if (($_smarty_tpl->tpl_vars['wpmanufacturercarousel']->value['autoScroll'])){?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpmc_autoscroll'=>$_smarty_tpl->tpl_vars['wpmanufacturercarousel']->value['autoScrollDelay']),$_smarty_tpl);?>

    <?php }else{ ?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpmc_autoscroll'=>false),$_smarty_tpl);?>

    <?php }?>

    <?php if (($_smarty_tpl->tpl_vars['wpmanufacturercarousel']->value['pauseOnHover'])){?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpmc_pauseonhover'=>true),$_smarty_tpl);?>

    <?php }else{ ?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpmc_pauseonhover'=>false),$_smarty_tpl);?>

    <?php }?>

<?php }?><?php }} ?>