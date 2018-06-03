<?php /* Smarty version Smarty-3.1.14, created on 2015-01-02 17:32:33
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132887292154a6d631d8f181-37587613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf1464544f7927bd4a9d6071881390d9e5e693b5' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/my-account.tpl',
      1 => 1419544611,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132887292154a6d631d8f181-37587613',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'account_created' => 0,
    'has_customer_an_address' => 0,
    'link' => 0,
    'returnAllowed' => 0,
    'voucherAllowed' => 0,
    'HOOK_CUSTOMER_ACCOUNT' => 0,
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54a6d631eb7f21_00473734',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a6d631eb7f21_00473734')) {function content_54a6d631eb7f21_00473734($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'My account'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1 class="page-header"><?php echo smartyTranslate(array('s'=>'My account'),$_smarty_tpl);?>
</h1>

<?php if (isset($_smarty_tpl->tpl_vars['account_created']->value)){?>
	<p class="alert alert-success">
		<?php echo smartyTranslate(array('s'=>'Your account has been created.'),$_smarty_tpl);?>

	</p>
<?php }?>

<h3 class="extra-info"><?php echo smartyTranslate(array('s'=>'Welcome to your account. Here you can manage all of your personal information and orders.'),$_smarty_tpl);?>
</h3>

<ul class="myaccount-link-list grid grid-4">

    <?php if ($_smarty_tpl->tpl_vars['has_customer_an_address']->value){?>
        <li class="item">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Add my first address'),$_smarty_tpl);?>
">
                <span class="wpicon wpicon-address-book xlarge"></span>
                <span><?php echo smartyTranslate(array('s'=>'Add my first address'),$_smarty_tpl);?>
</span>
            </a>
        </li>
    <?php }?>

    <li class="item">
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('history',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Orders'),$_smarty_tpl);?>
">
            <span class="wpicon wpicon-cart xlarge"></span>
            <span><?php echo smartyTranslate(array('s'=>'Order history and details'),$_smarty_tpl);?>
</span>
        </a>
    </li>

    <?php if ($_smarty_tpl->tpl_vars['returnAllowed']->value){?>
        <li class="item">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order-follow',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Merchandise returns'),$_smarty_tpl);?>
">
                <span class="wpicon wpicon-undo xlarge"></span>
                <span><?php echo smartyTranslate(array('s'=>'My merchandise returns'),$_smarty_tpl);?>
</span>
            </a>
        </li>
    <?php }?>

    <li class="item">
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order-slip',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Credit slips'),$_smarty_tpl);?>
">
            <span class="wpicon wpicon-file xlarge"></span>
            <span><?php echo smartyTranslate(array('s'=>'My credit slips'),$_smarty_tpl);?>
</span>
        </a>
    </li>

    <li class="item">
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('addresses',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Addresses'),$_smarty_tpl);?>
">
            <span class="wpicon wpicon-address-book xlarge"></span>
            <span><?php echo smartyTranslate(array('s'=>'My addresses'),$_smarty_tpl);?>
</span>
        </a>
    </li>

    <li class="item">
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('identity',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Information'),$_smarty_tpl);?>
">
            <span class="wpicon wpicon-vcard xlarge"></span>
            <span><?php echo smartyTranslate(array('s'=>'My personal information'),$_smarty_tpl);?>
</span>
        </a>
    </li>

    <?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value||isset($_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value)&&$_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value!=''){?>
        <?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value){?>
            <li class="item">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('discount',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Vouchers'),$_smarty_tpl);?>
">
                    <span class="wpicon wpicon-ticket xlarge"></span>
                    <span><?php echo smartyTranslate(array('s'=>'My vouchers'),$_smarty_tpl);?>
</span>
                </a>
            </li>
        <?php }?>

        <?php echo $_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value;?>

    <?php }?>

</ul>

<ul class="footer_links">
    <li class="back-to-home">
        <a class="button-2 fill inline" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
">
            <span class="wpicon wpicon-home2"></span><?php echo smartyTranslate(array('s'=>'Back to Home'),$_smarty_tpl);?>

        </a>
    </li>
</ul>
<?php }} ?>