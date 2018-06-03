<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:24:55
         compiled from "/home/gbs2/public_html/themes/autumn/headers/category-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:185999210254ad5dd784c661-96924285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '564d5509e63593ea7de2e71eec301db3ea4e5be4' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/headers/category-header.tpl',
      1 => 1419541635,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185999210254ad5dd784c661-96924285',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'WPAC_categoryHeaderStyle' => 0,
    'link' => 0,
    'categoryHeaderBreadcrumbPosition' => 0,
    'categoryHeaderNamePosition' => 0,
    'categoryHeaderNameExtraClass' => 0,
    'categoryHeaderBreadcrumbExtraClass' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5dd7941a19_01736637',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5dd7941a19_01736637')) {function content_54ad5dd7941a19_01736637($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['category']->value)&&$_smarty_tpl->tpl_vars['category']->value->id&&$_smarty_tpl->tpl_vars['category']->value->active){?>

    <?php $_smarty_tpl->tpl_vars['WPAC_categoryHeaderStyle'] = new Smarty_variable(explode("|",$_smarty_tpl->tpl_vars['WPAC_categoryHeaderStyle']->value), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['categoryHeaderNamePosition'] = new Smarty_variable($_smarty_tpl->tpl_vars['WPAC_categoryHeaderStyle']->value[0], null, 0);?>
    <?php $_smarty_tpl->tpl_vars['categoryHeaderBreadcrumbPosition'] = new Smarty_variable($_smarty_tpl->tpl_vars['WPAC_categoryHeaderStyle']->value[1], null, 0);?>

    <div id="category-header" <?php if ($_smarty_tpl->tpl_vars['category']->value->id_image){?>style="background-image: url('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['category']->value->link_rewrite,$_smarty_tpl->tpl_vars['category']->value->id_image,'atmn_category'), ENT_QUOTES, 'UTF-8', true);?>
');background-size: 100% 100%;"<?php }?>>
        <div class="row parent">

            <?php if (($_smarty_tpl->tpl_vars['categoryHeaderBreadcrumbPosition']->value==$_smarty_tpl->tpl_vars['categoryHeaderNamePosition']->value)){?>

                <div class="row">
                    <div class="category-name column col-12-12 t-align-<?php echo $_smarty_tpl->tpl_vars['categoryHeaderNamePosition']->value;?>
">
                        <h1><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h1>
                        <span class="category-product-count">
                            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-count.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="breadcrumb-wrapper column col-12-12 t-align-<?php echo $_smarty_tpl->tpl_vars['categoryHeaderBreadcrumbPosition']->value;?>
">
                        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                    </div>
                </div>

            <?php }else{ ?>
            
                <?php if (($_smarty_tpl->tpl_vars['categoryHeaderNamePosition']->value=="right")){?>
                    <?php $_smarty_tpl->tpl_vars['categoryHeaderNameExtraClass'] = new Smarty_variable("t-align-right push-6-12", null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['categoryHeaderBreadcrumbExtraClass'] = new Smarty_variable("pull-6-12", null, 0);?>
                <?php }else{ ?>
                    <?php $_smarty_tpl->tpl_vars['categoryHeaderNameExtraClass'] = new Smarty_variable('', null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['categoryHeaderBreadcrumbExtraClass'] = new Smarty_variable("t-align-right", null, 0);?>
                <?php }?>

                <div class="one-row row valign-middle">
                    <div class="category-name column col-6-12 <?php echo $_smarty_tpl->tpl_vars['categoryHeaderNameExtraClass']->value;?>
">
                        <h1><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h1>
                        <span class="category-product-count">
                            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-count.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                        </span>
                    </div>

                    <div class="breadcrumb-wrapper column col-6-12 <?php echo $_smarty_tpl->tpl_vars['categoryHeaderBreadcrumbExtraClass']->value;?>
">
                        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                    </div>
                </div>

            <?php }?>

        </div>
    </div>
<?php }?><?php }} ?>