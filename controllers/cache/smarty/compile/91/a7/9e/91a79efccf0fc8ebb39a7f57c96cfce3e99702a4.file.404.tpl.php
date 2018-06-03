<?php /* Smarty version Smarty-3.1.14, created on 2014-12-30 14:45:36
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110890007454a2ba90cb33f4-65897697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91a79efccf0fc8ebb39a7f57c96cfce3e99702a4' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/404.tpl',
      1 => 1419544519,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110890007454a2ba90cb33f4-65897697',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54a2ba90d0e4c1_18734491',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a2ba90d0e4c1_18734491')) {function content_54a2ba90d0e4c1_18734491($_smarty_tpl) {?>
<div class="pagenotfound t-align-center">
    <div>
        <span class="text404"><?php echo smartyTranslate(array('s'=>'404!'),$_smarty_tpl);?>
</span>
    </div>
    <div class="info404">
        <h1><?php echo smartyTranslate(array('s'=>'This page is not available'),$_smarty_tpl);?>
</h1>

        <p><?php echo smartyTranslate(array('s'=>'We\'re sorry, but the Web address you\'ve entered is no longer available.'),$_smarty_tpl);?>
</p>
        <p><?php echo smartyTranslate(array('s'=>'To find a product, please type its name in the field below.'),$_smarty_tpl);?>
</p>

        <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'), ENT_QUOTES, 'UTF-8', true);?>
" method="post" class="std">
            <fieldset>
                <div>
                    <p><label for="search_query"><?php echo smartyTranslate(array('s'=>'Search our product catalog:'),$_smarty_tpl);?>
</label></p>
                    <br />
                    <input id="search_query" name="search_query" type="text" class="form-control grey" />
                    <button type="submit" name="Submit" value="OK" class="button-1 fill"><span><?php echo smartyTranslate(array('s'=>'Ok'),$_smarty_tpl);?>
</span></button>
                </div>
            </fieldset>
        </form>

        <div class="buttons">
            <a class="button-2 fill inline" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"><span class="wpicon wpicon-home2"></span>&nbsp;<?php echo smartyTranslate(array('s'=>'Back to Home'),$_smarty_tpl);?>
</a>
        </div>
    </div>
</div>
<?php }} ?>