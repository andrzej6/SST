<?php /* Smarty version Smarty-3.1.14, created on 2015-01-09 21:41:31
         compiled from "/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/controllers/carts/helpers/view/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131349626554b04b0bc9f979-89751984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '292be2d84f04d3edee532e12cc28c395c30d24ca' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/controllers/carts/helpers/view/view.tpl',
      1 => 1419426362,
      2 => 'file',
    ),
    '9498ddb25ff2ee9ff4a447a8cdc0575a9ff1e793' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/adminGbs4221A/themes/default/template/helpers/view/view.tpl',
      1 => 1419425571,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131349626554b04b0bc9f979-89751984',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name_controller' => 0,
    'hookName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54b04b0c43f605_53438580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b04b0c43f605_53438580')) {function content_54b04b0c43f605_53438580($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/home/gbs2/public_html/prestashop/tools/smarty/plugins/function.math.php';
?>

<div class="leadin"></div>


<div class="panel">
	<?php ob_start();?><?php echo smartyTranslate(array('s'=>sprintf('Cart #%06d',$_smarty_tpl->tpl_vars['cart']->value->id)),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['customer']->value->id){?><?php echo (string)$_smarty_tpl->tpl_vars['customer']->value->firstname;?><?php echo " ";?><?php echo (string)$_smarty_tpl->tpl_vars['customer']->value->lastname;?><?php }else{ ?><?php echo smartyTranslate(array('s'=>'Guest'),$_smarty_tpl);?>
<?php }?><?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo smartyTranslate(array('s'=>'On'),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['cart']->value->date_upd,'full'=>0),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['total_price']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("helpers/kpi/kpi.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('id'=>"kpi-cart",'color'=>"color1",'icon'=>"icon-shopping-cart",'title'=>$_tmp1,'subtitle'=>$_tmp2." ".$_tmp3." ".$_tmp4,'value'=>$_tmp5,'source'=>'','chart'=>null), 0);?>

</div>
<div class="row">
	<div class="col-lg-6">
		<div class="panel">
			<h3><i class="icon-user"></i> <?php echo smartyTranslate(array('s'=>'Customer information'),$_smarty_tpl);?>
</h3>
			<?php if ($_smarty_tpl->tpl_vars['customer']->value->id){?>
				<a class="btn btn-default pull-right" href="mailto:<?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
"><i class="icon-envelope"></i> <?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
</a>
				<h2>
					<?php if ($_smarty_tpl->tpl_vars['customer']->value->id_gender==1){?>
					<i class="icon-male"></i> 
					<?php }elseif($_smarty_tpl->tpl_vars['customer']->value->id_gender==2){?>
					<i class="icon-female"></i> 
					<?php }else{ ?>
					<i class="icon-question"></i> 
					<?php }?>
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCustomers'), ENT_QUOTES, 'UTF-8', true);?>
&id_customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
&viewcustomer"><?php echo $_smarty_tpl->tpl_vars['customer']->value->firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->lastname;?>
</a></h2>
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-lg-3 control-label"><?php echo smartyTranslate(array('s'=>'Account registration date:'),$_smarty_tpl);?>
</label>
						<div class="col-lg-3"><p class="form-control-static"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['customer']->value->date_add),$_smarty_tpl);?>
</p></div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label"><?php echo smartyTranslate(array('s'=>'Valid orders placed:'),$_smarty_tpl);?>
</label>
						<div class="col-lg-3"><p class="form-control-static"><?php echo $_smarty_tpl->tpl_vars['customer_stats']->value['nb_orders'];?>
</p></div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label"><?php echo smartyTranslate(array('s'=>'Total spent since registration:'),$_smarty_tpl);?>
</label>
						<div class="col-lg-3"><p class="form-control-static"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['customer_stats']->value['total_orders'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</p></div>
					</div>
				</div>
			<?php }else{ ?>
				<h2><?php echo smartyTranslate(array('s'=>'Guest not registered'),$_smarty_tpl);?>
</h2>
			<?php }?>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel">
			<h3><i class="icon-shopping-cart"></i> <?php echo smartyTranslate(array('s'=>'Order information'),$_smarty_tpl);?>
</h3>
			<?php if ($_smarty_tpl->tpl_vars['order']->value->id){?>
				<h2><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
&vieworder"> <?php echo smartyTranslate(array('s'=>'Order #%d','sprintf'=>sprintf("%06d",$_smarty_tpl->tpl_vars['order']->value->id)),$_smarty_tpl);?>
</a></h2>
				<?php echo smartyTranslate(array('s'=>'Made on:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['order']->value->date_add),$_smarty_tpl);?>

			<?php }else{ ?>
				<h2><?php echo smartyTranslate(array('s'=>'No order was created from this cart.'),$_smarty_tpl);?>
</h2>
				<?php if ($_smarty_tpl->tpl_vars['customer']->value->id){?>
					<a class="btn btn-default" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&id_cart=<?php echo $_smarty_tpl->tpl_vars['cart']->value->id;?>
&addorder"><i class="icon-shopping-cart"></i> <?php echo smartyTranslate(array('s'=>'Create an order from this cart.'),$_smarty_tpl);?>
</a>
				<?php }?>
			<?php }?>
		</div>
	</div>
</div>
<div class="panel">
	<h3><i class="icon-archive"></i> <?php echo smartyTranslate(array('s'=>'Cart summary'),$_smarty_tpl);?>
</h3>
		<table class="table" id="orderProducts">
			<thead>
				<tr>
					<th class="fixed-width-xs">&nbsp;</th>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'Product'),$_smarty_tpl);?>
</span></th>
					<th class="text-right fixed-width-md"><span class="title_box"><?php echo smartyTranslate(array('s'=>'Unit price'),$_smarty_tpl);?>
</span></th>
					<th class="text-center fixed-width-md"><span class="title_box"><?php echo smartyTranslate(array('s'=>'Quantity'),$_smarty_tpl);?>
</span></th>
					<th class="text-center fixed-width-sm"><span class="title_box"><?php echo smartyTranslate(array('s'=>'Stock'),$_smarty_tpl);?>
</span></th>
					<th class="text-right fixed-width-sm"><span class="title_box"><?php echo smartyTranslate(array('s'=>'Total'),$_smarty_tpl);?>
</span></th>
				</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
				<?php if (isset($_smarty_tpl->tpl_vars['customized_datas']->value[$_smarty_tpl->tpl_vars['product']->value['id_product']][$_smarty_tpl->tpl_vars['product']->value['id_product_attribute']][$_smarty_tpl->tpl_vars['product']->value['id_address_delivery']])){?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['product']->value['image'];?>
</td>
						<td><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'), ENT_QUOTES, 'UTF-8', true);?>
&id_product=<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
&updateproduct">
									<span class="productName"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</span><?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes'])){?><br /><?php echo $_smarty_tpl->tpl_vars['product']->value['attributes'];?>
<?php }?><br />
								<?php if ($_smarty_tpl->tpl_vars['product']->value['reference']){?><?php echo smartyTranslate(array('s'=>'Ref:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['reference'];?>
<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['product']->value['reference']&&$_smarty_tpl->tpl_vars['product']->value['supplier_reference']){?> / <?php echo $_smarty_tpl->tpl_vars['product']->value['supplier_reference'];?>
<?php }?>
							</a>
						</td>
						<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_wt'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
						<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['product']->value['customization_quantity'];?>
</td>
						<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['product']->value['qty_in_stock'];?>
</td>
						<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_customization_wt'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
					</tr>
					<?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customized_datas']->value[$_smarty_tpl->tpl_vars['product']->value['id_product']][$_smarty_tpl->tpl_vars['product']->value['id_product_attribute']][$_smarty_tpl->tpl_vars['product']->value['id_address_delivery']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value){
$_smarty_tpl->tpl_vars['customization']->_loop = true;
?>
					<tr>
						<td colspan="2">
						<?php  $_smarty_tpl->tpl_vars['datas'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['datas']->_loop = false;
 $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customization']->value['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['datas']->key => $_smarty_tpl->tpl_vars['datas']->value){
$_smarty_tpl->tpl_vars['datas']->_loop = true;
 $_smarty_tpl->tpl_vars['type']->value = $_smarty_tpl->tpl_vars['datas']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['type']->value==constant('Product::CUSTOMIZE_FILE')){?>
								<ul style="margin: 0; padding: 0; list-style-type: none;">
								<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
$_smarty_tpl->tpl_vars['data']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['data']->key;
?>
										<li style="display: inline; margin: 2px;">
											<a href="displayImage.php?img=<?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
&name=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
-file<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" target="_blank">
											<img src="<?php echo $_smarty_tpl->tpl_vars['pic_dir']->value;?>
<?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
_small" alt="" /></a>
										</li>
								<?php } ?>
								</ul>
							<?php }elseif($_smarty_tpl->tpl_vars['type']->value==constant('Product::CUSTOMIZE_TEXTFIELD')){?>
								<div class="form-horizontal">
									<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
$_smarty_tpl->tpl_vars['data']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['data']->key;
?>
										<div class="form-group">
											<span class="control-label col-lg-3"><strong><?php if ($_smarty_tpl->tpl_vars['data']->value['name']){?><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Text #'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
<?php }?></strong></span>
											<div class="col-lg-9">
												<p class="form-control-static"><?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
</p>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php }?>
						<?php } ?>
						</td>
						<td></td>
						<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
</td>
						<td></td>
						<td></td>
					</tr>
					<?php } ?>
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['product']->value['cart_quantity']>$_smarty_tpl->tpl_vars['product']->value['customization_quantity']){?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['product']->value['image'];?>
</td>
						<td>
							<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'), ENT_QUOTES, 'UTF-8', true);?>
&id_product=<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
&updateproduct">
							<span class="productName"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</span><?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes'])){?><br /><?php echo $_smarty_tpl->tpl_vars['product']->value['attributes'];?>
<?php }?><br />
							<?php if ($_smarty_tpl->tpl_vars['product']->value['reference']){?><?php echo smartyTranslate(array('s'=>'Ref:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['reference'];?>
<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['product']->value['reference']&&$_smarty_tpl->tpl_vars['product']->value['supplier_reference']){?> / <?php echo $_smarty_tpl->tpl_vars['product']->value['supplier_reference'];?>
<?php }?>
							</a>
						</td>
						<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['product_price'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
						<td class="text-center"><?php echo smarty_function_math(array('equation'=>'x - y','x'=>$_smarty_tpl->tpl_vars['product']->value['cart_quantity'],'y'=>intval($_smarty_tpl->tpl_vars['product']->value['customization_quantity'])),$_smarty_tpl);?>
</td>
						<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['product']->value['qty_in_stock'];?>
</td>
						<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['product_total'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
					</tr>
				<?php }?>
			<?php } ?>
			<tr>
				<td colspan="5"><?php echo smartyTranslate(array('s'=>'Total cost of products:'),$_smarty_tpl);?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['total_products']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
			</tr>		
			<?php if ($_smarty_tpl->tpl_vars['total_discounts']->value!=0){?>
			<tr>
				<td colspan="5"><?php echo smartyTranslate(array('s'=>'Total value of vouchers:'),$_smarty_tpl);?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['total_discounts']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['total_wrapping']->value>0){?>
			<tr>
				<td colspan="5"><?php echo smartyTranslate(array('s'=>'Total cost of gift wrapping:'),$_smarty_tpl);?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['total_wrapping']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,Cart::ONLY_SHIPPING)>0){?>
			<tr>
				<td colspan="5"><?php echo smartyTranslate(array('s'=>'Total cost of shipping:'),$_smarty_tpl);?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['total_shipping']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="5" class=" success"><strong><?php echo smartyTranslate(array('s'=>'Total:'),$_smarty_tpl);?>
</strong></td>
				<td class="text-right success"><strong><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['total_price']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</strong></td>
			</tr>
		</tbody>
	</table>
	
	<?php if ($_smarty_tpl->tpl_vars['discounts']->value){?>
	<table class="table">
		<tr>
			<th><img src="../img/admin/coupon.gif" alt="<?php echo smartyTranslate(array('s'=>'Discounts'),$_smarty_tpl);?>
" /><?php echo smartyTranslate(array('s'=>'Discount name'),$_smarty_tpl);?>
</th>
			<th align="center" style="width: 100px"><?php echo smartyTranslate(array('s'=>'Value'),$_smarty_tpl);?>
</th>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['discount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['discount']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['discounts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['discount']->key => $_smarty_tpl->tpl_vars['discount']->value){
$_smarty_tpl->tpl_vars['discount']->_loop = true;
?>
			<tr>
				<td><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminDiscounts'), ENT_QUOTES, 'UTF-8', true);?>
&id_discount=<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
&updatediscount"><?php echo $_smarty_tpl->tpl_vars['discount']->value['name'];?>
</a></td>
				<td align="center">- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0][0]->displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl);?>
</td>
			</tr>
		<?php } ?>
	</table>
	<?php }?>
	<div class="alert alert-warning">
		<?php echo smartyTranslate(array('s'=>'For this particular customer group, prices are displayed as:'),$_smarty_tpl);?>
 <b><?php if ($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod()==@constant('PS_TAX_EXC')){?><?php echo smartyTranslate(array('s'=>'Tax excluded'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Tax included'),$_smarty_tpl);?>
<?php }?></b>
	</div>	
	<div class="clear" style="height:20px;">&nbsp;</div>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayAdminView'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['name_controller']->value)){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo ucfirst($_smarty_tpl->tpl_vars['name_controller']->value);?>
View<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php }elseif(isset($_GET['controller'])){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo htmlentities(ucfirst($_GET['controller']));?>
View<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php }?>
<?php }} ?>