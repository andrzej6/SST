<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 23:53:01
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/header-v1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162768058254ab23dd4d87a2-04290191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a225bdeee346a7e37a0ac013a6c5800c4c7d8af8' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/header-v1.tpl',
      1 => 1419544579,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162768058254ab23dd4d87a2-04290191',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WPAC_customHeaderText' => 0,
    'base_dir' => 0,
    'shop_name' => 0,
    'logo_url' => 0,
    'HOOK_TOP' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23dd5131b6_34277275',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23dd5131b6_34277275')) {function content_54ab23dd5131b6_34277275($_smarty_tpl) {?><div class="header-v1">    <section id="header_top" class="hide-below-1024">        <div class="row">            <div class="column col-12-12">                <div class="custom-header-area">                    <?php if (isset($_smarty_tpl->tpl_vars['WPAC_customHeaderText']->value)){?>                        <?php echo $_smarty_tpl->tpl_vars['WPAC_customHeaderText']->value;?>
                    <?php }?>                </div>                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./modules/blocklanguages/blocklanguages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./modules/blockcurrencies/blockcurrencies.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                                                                                        <div>                    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./modules/blockuserinfo/blockuserinfo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                </div>               </div>                    </div>    </section>    <section id="header_bottom">                <div class="row valign-middle">            <div id="logo" class="column col-for-logo">                <a href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">                    <img class="logo" src="<?php echo $_smarty_tpl->tpl_vars['logo_url']->value;?>
" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />                </a>            </div>            <div id="header_menu" class="column col-8-12 hide-below-1024">                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHeaderMenu'),$_smarty_tpl);?>
            </div>            <div id="header_right" class="column col-for-basket t-align-right">                                                                                                   <?php echo $_smarty_tpl->tpl_vars['HOOK_TOP']->value;?>
                </div>                                                           </div>        </div>        <div id="header_mobile_menu" class="soft-hide">            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHeaderMenu','wpmegamenumobile'=>true),$_smarty_tpl);?>
        </div>    </section></div><?php }} ?>