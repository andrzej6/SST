<?php /* Smarty version Smarty-3.1.14, created on 2015-01-06 02:40:16
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/guest-tracking.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20182381254ab4b10cfb0c9-46207260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '940e180a7508f212b9d6e87ec69cbad67c7a4672' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/guest-tracking.tpl',
      1 => 1419544573,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20182381254ab4b10cfb0c9-46207260',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order_collection' => 0,
    'order' => 0,
    'transformSuccess' => 0,
    'link' => 0,
    'action' => 0,
    'show_login_link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab4b10ed61d8_48749356',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab4b10ed61d8_48749356')) {function content_54ab4b10ed61d8_48749356($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Guest Tracking'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1 class="page-header"><?php echo smartyTranslate(array('s'=>'Guest Tracking'),$_smarty_tpl);?>
</h1>

<?php if (isset($_smarty_tpl->tpl_vars['order_collection']->value)){?>
	<?php  $_smarty_tpl->tpl_vars['order'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_collection']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order']->key => $_smarty_tpl->tpl_vars['order']->value){
$_smarty_tpl->tpl_vars['order']->_loop = true;
?>
		<?php $_smarty_tpl->tpl_vars['order_state'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->getCurrentState(), null, 0);?>
		<?php $_smarty_tpl->tpl_vars['invoice'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->invoice, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['order_history'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->order_history, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['carrier'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->carrier, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['address_invoice'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->address_invoice, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['address_delivery'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->address_delivery, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['inv_adr_fields'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->inv_adr_fields, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['dlv_adr_fields'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->dlv_adr_fields, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['invoiceAddressFormatedValues'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->invoiceAddressFormatedValues, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['deliveryAddressFormatedValues'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->deliveryAddressFormatedValues, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['currency'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->currency, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['discounts'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->discounts, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['invoiceState'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->invoiceState, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['deliveryState'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->deliveryState, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['products'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->products, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['customizedDatas'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->customizedDatas, null, 0);?>
		<?php $_smarty_tpl->tpl_vars['HOOK_ORDERDETAILDISPLAYED'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->hook_orderdetaildisplayed, null, 0);?>
		<?php if (isset($_smarty_tpl->tpl_vars['order']->value->total_old)){?>
			<?php $_smarty_tpl->tpl_vars['total_old'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->total_old, null, 0);?>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['order']->value->followup)){?>
			<?php $_smarty_tpl->tpl_vars['followup'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value->followup, null, 0);?>
		<?php }?>
		
		<div id="block-history">
			<div id="block-order-detail" class="std">
			<?php echo $_smarty_tpl->getSubTemplate ("./order-detail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</div>
		</div>
	<?php } ?>

	<h3 id="guestToCustomer" class="section-header secondary"><?php echo smartyTranslate(array('s'=>'For more advantages...'),$_smarty_tpl);?>
</h3>

	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
	<?php if (isset($_smarty_tpl->tpl_vars['transformSuccess']->value)){?>
		<p class="alert alert-success"><?php echo smartyTranslate(array('s'=>'Your guest account has been successfully transformed into a customer account. You can now login as a registered shopper: '),$_smarty_tpl);?>
 <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smartyTranslate(array('s'=>'Login'),$_smarty_tpl);?>
</a></p>
	<?php }else{ ?>
		<form method="post" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
#guestToCustomer" class="box">
            <div class="form-group">
                <?php echo smartyTranslate(array('s'=>'Transform your guest account into a customer account'),$_smarty_tpl);?>

            </div>

            <div class="text form-group">
                <label><strong class="dark"><?php echo smartyTranslate(array('s'=>'Set your password:'),$_smarty_tpl);?>
</strong></label>
                <input type="password" name="password" class="form-control" />
            </div>

            <input type="hidden" name="id_order" value="<?php if (isset($_smarty_tpl->tpl_vars['order']->value->id)){?><?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
<?php }else{ ?><?php if (isset($_GET['id_order'])){?><?php echo htmlspecialchars($_GET['id_order'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php if (isset($_POST['id_order'])){?><?php echo htmlspecialchars($_POST['id_order'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?><?php }?><?php }?>" />
            <input type="hidden" name="order_reference" value="<?php if (isset($_GET['order_reference'])){?><?php echo htmlspecialchars($_GET['order_reference'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php if (isset($_POST['order_reference'])){?><?php echo htmlspecialchars($_POST['order_reference'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?><?php }?>" />
            <input type="hidden" name="email" value="<?php if (isset($_GET['email'])){?><?php echo htmlspecialchars($_GET['email'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php if (isset($_POST['email'])){?><?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?><?php }?>" />

            <div class="form-group submit">
                <button type="submit" name="submitTransformGuestToCustomer" class="button-1 fill">
                    <?php echo smartyTranslate(array('s'=>'Send'),$_smarty_tpl);?>

                </button>
            </div>
		</form>
	<?php }?>
<?php }else{ ?>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if (isset($_smarty_tpl->tpl_vars['show_login_link']->value)&&$_smarty_tpl->tpl_vars['show_login_link']->value){?>
		<div>
            <br />
            <a class="button-1 fill" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
">
                <?php echo smartyTranslate(array('s'=>'Click here to login to your customer account.'),$_smarty_tpl);?>

            </a>
            <br />
        </div>
	<?php }?>
	<form method="post" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="std" id="guestTracking">
		<fieldset class="description_box box">
			<h3 class="section_header"><?php echo smartyTranslate(array('s'=>'To track your order, please enter the following information:'),$_smarty_tpl);?>
</h3>
                <div class="text form-group">
                    <label><?php echo smartyTranslate(array('s'=>'Order Reference:'),$_smarty_tpl);?>
 </label>
                    <input class="form-control" type="text" name="order_reference" value="<?php if (isset($_GET['id_order'])){?><?php echo htmlspecialchars($_GET['id_order'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php if (isset($_POST['id_order'])){?><?php echo htmlspecialchars($_POST['id_order'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?><?php }?>" size="8" />
                    <span class="form_info"><?php echo smartyTranslate(array('s'=>'For example: QIIXJXNUI or QIIXJXNUI#1'),$_smarty_tpl);?>
</span>
                </div>
                <div class="text form-group">
                    <label><?php echo smartyTranslate(array('s'=>'Email:'),$_smarty_tpl);?>
</label>
                    <input class="form-control" type="text" name="email" value="<?php if (isset($_GET['email'])){?><?php echo htmlspecialchars($_GET['email'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php if (isset($_POST['email'])){?><?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?><?php }?>" />
                </div>
                <div class="form-group submit">
                    <button type="submit" name="submitGuestTracking" class="button-1 fill">
                        <?php echo smartyTranslate(array('s'=>'Send'),$_smarty_tpl);?>

                    </button>
                </div>
		</fieldset>
	</form>
<?php }?>
<?php }} ?>