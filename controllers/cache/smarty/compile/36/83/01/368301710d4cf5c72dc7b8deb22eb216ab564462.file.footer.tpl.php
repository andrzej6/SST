<?php /* Smarty version Smarty-3.1.14, created on 2015-01-06 02:39:53
         compiled from "/home/gbs2/public_html/prestashop/pdf/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155513131354ab4af94909f9-05044687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '368301710d4cf5c72dc7b8deb22eb216ab564462' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/pdf/footer.tpl',
      1 => 1419419905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155513131354ab4af94909f9-05044687',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'available_in_your_account' => 0,
    'shop_address' => 0,
    'shop_phone' => 0,
    'shop_fax' => 0,
    'shop_details' => 0,
    'free_text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab4af94d0bf2_62004080',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab4af94d0bf2_62004080')) {function content_54ab4af94d0bf2_62004080($_smarty_tpl) {?>
<table>
	<tr>
		<td style="text-align: center; font-size: 6pt; color: #444">
            <?php if ($_smarty_tpl->tpl_vars['available_in_your_account']->value){?>
                <?php echo smartyTranslate(array('s'=>'An electronic version of this invoice is available in your account. To access it, log in to our website using your e-mail address and password (which you created when placing your first order).','pdf'=>'true'),$_smarty_tpl);?>
             
    			<br />
            <?php }?>
			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_address']->value, ENT_QUOTES, 'UTF-8', true);?>
<br />

			<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)||!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>
				<?php echo smartyTranslate(array('s'=>'For more assistance, contact Support:','pdf'=>'true'),$_smarty_tpl);?>
<br />
				<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)){?>
					Tel: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_phone']->value, ENT_QUOTES, 'UTF-8', true);?>

				<?php }?>

				<?php if (!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>
					Fax: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_fax']->value, ENT_QUOTES, 'UTF-8', true);?>

				<?php }?>
				<br />
			<?php }?>
            
            <?php if (isset($_smarty_tpl->tpl_vars['shop_details']->value)){?>
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_details']->value, ENT_QUOTES, 'UTF-8', true);?>
<br />
            <?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['free_text']->value)){?>
    			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['free_text']->value, ENT_QUOTES, 'UTF-8', true);?>
<br />
            <?php }?>
		</td>
	</tr>
</table>

<?php }} ?>