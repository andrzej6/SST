<?php /* Smarty version Smarty-3.1.14, created on 2015-01-02 17:32:51
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/addresses.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189465089054a6d6437bd5b3-21963886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d8eeaf7e6b2ba6b5887e3456dad6ae15eef2107' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/addresses.tpl',
      1 => 1419544525,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189465089054a6d6437bd5b3-21963886',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'navigationPipe' => 0,
    'multipleAddresses' => 0,
    'addresses_style' => 0,
    'address' => 0,
    'pattern' => 0,
    'addressKey' => 0,
    'key' => 0,
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54a6d6438a1b59_24652639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a6d6438a1b59_24652639')) {function content_54a6d6438a1b59_24652639($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/gbs2/public_html/prestashop/tools/smarty/plugins/modifier.replace.php';
?>
<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?>
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smartyTranslate(array('s'=>'My account'),$_smarty_tpl);?>
</a><span class="navigation-pipe"><?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>
</span><span class="navigation_page"><?php echo smartyTranslate(array('s'=>'My addresses'),$_smarty_tpl);?>
</span>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1 class="page-header"><?php echo smartyTranslate(array('s'=>'My addresses'),$_smarty_tpl);?>
</h1>

<h3 class="extra-info"><?php echo smartyTranslate(array('s'=>'Please configure your default billing and delivery addresses when placing an order. You may also add additional addresses, which can be useful for sending gifts or receiving an order at your office.'),$_smarty_tpl);?>
</h3>

<?php if (isset($_smarty_tpl->tpl_vars['multipleAddresses']->value)&&$_smarty_tpl->tpl_vars['multipleAddresses']->value){?>

    <div class="addresses box">
        <h3 class="section-header"><?php echo smartyTranslate(array('s'=>'Your addresses'),$_smarty_tpl);?>
</h3>
        <p class="p-indent"><?php echo smartyTranslate(array('s'=>'Be sure to update your personal information if it has changed.'),$_smarty_tpl);?>
</p>

        <?php $_smarty_tpl->tpl_vars["adrs_style"] = new Smarty_variable($_smarty_tpl->tpl_vars['addresses_style']->value, null, 0);?>

        <div class="bloc_adresses grid grid-3">
            <?php  $_smarty_tpl->tpl_vars['address'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['address']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['multipleAddresses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['address']->key => $_smarty_tpl->tpl_vars['address']->value){
$_smarty_tpl->tpl_vars['address']->_loop = true;
?>
                <div class="item address">
                    <h3 class="section-header"><?php echo $_smarty_tpl->tpl_vars['address']->value['object']['alias'];?>
</h3>
                    <ul class="list-icon-arrow">
                        <?php  $_smarty_tpl->tpl_vars['pattern'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pattern']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['address']->value['ordered']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pattern']->key => $_smarty_tpl->tpl_vars['pattern']->value){
$_smarty_tpl->tpl_vars['pattern']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['addressKey'] = new Smarty_variable(explode(" ",$_smarty_tpl->tpl_vars['pattern']->value), null, 0);?>
                            <li>
                            <?php  $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['key']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['addressKey']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['key']->key => $_smarty_tpl->tpl_vars['key']->value){
$_smarty_tpl->tpl_vars['key']->_loop = true;
?>
                                <span <?php if (isset($_smarty_tpl->tpl_vars['addresses_style']->value[$_smarty_tpl->tpl_vars['key']->value])){?> class="<?php echo $_smarty_tpl->tpl_vars['addresses_style']->value[$_smarty_tpl->tpl_vars['key']->value];?>
"<?php }?>>
                                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['address']->value['formated'][smarty_modifier_replace($_smarty_tpl->tpl_vars['key']->value,',','')], ENT_QUOTES, 'UTF-8', true);?>

                                </span>
                            <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="t-align-center">
                        <a class="button-2 fill inline address_update" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['address']->value['object']['id']);?>
<?php $_tmp1=ob_get_clean();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true,null,"id_address=".$_tmp1), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Update'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Update'),$_smarty_tpl);?>
</a>
                        <a class="button-2 fill inline address_delete" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['address']->value['object']['id']);?>
<?php $_tmp2=ob_get_clean();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true,null,"id_address=".$_tmp2."&delete"), ENT_QUOTES, 'UTF-8', true);?>
" onclick="return confirm('<?php echo smartyTranslate(array('s'=>'Are you sure?','js'=>1),$_smarty_tpl);?>
');" title="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
</a>
                    </div>
                </div>
            <?php } ?>
            <div class="t-align-center">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Add an address'),$_smarty_tpl);?>
" class="button-1 fill inline"><span class="wpicon wpicon-plus small"></span><?php echo smartyTranslate(array('s'=>'Add a new address'),$_smarty_tpl);?>
</a>
            </div>
        </div>
    </div>

<?php }else{ ?>

    <div class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'No addresses are available.'),$_smarty_tpl);?>
</div>

    <div class="box t-align-center">
        <a class="button-1 fill inline" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true), ENT_QUOTES, 'UTF-8', true);?>
"><span class="wpicon wpicon-plus small"></span><?php echo smartyTranslate(array('s'=>'Add a new address'),$_smarty_tpl);?>
</a>
    </div>

<?php }?>

<ul class="footer_links">
    <li class="back-to-myaccount">
        <a class="button-2 fill inline" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
">
            <span class="wpicon wpicon-user"></span><?php echo smartyTranslate(array('s'=>'Back to Your Account'),$_smarty_tpl);?>

        </a>
    </li>
    <li class="back-to-home">
        <a class="button-2 fill inline" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
">
            <span class="wpicon wpicon-home2"></span><?php echo smartyTranslate(array('s'=>'Back to Home'),$_smarty_tpl);?>

        </a>
    </li>
</ul><?php }} ?>