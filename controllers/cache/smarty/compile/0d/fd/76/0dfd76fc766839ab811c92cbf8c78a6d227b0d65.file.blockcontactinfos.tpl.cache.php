<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 21:19:31
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcontactinfos/blockcontactinfos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:458583728549c78248204d9-09695060%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dfd76fc766839ab811c92cbf8c78a6d227b0d65' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcontactinfos/blockcontactinfos.tpl',
      1 => 1419541719,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '458583728549c78248204d9-09695060',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7824891fd5_85559175',
  'variables' => 
  array (
    'blockcontactinfos_company' => 0,
    'blockcontactinfos_address' => 0,
    'blockcontactinfos_phone' => 0,
    'blockcontactinfos_email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7824891fd5_85559175')) {function content_549c7824891fd5_85559175($_smarty_tpl) {?><?php if (!is_callable('smarty_function_mailto')) include '/home/gbs2/public_html/prestashop/tools/smarty/plugins/function.mailto.php';
?>

<div id="block_contact_infos" class="footer-block item">
    <h4><?php echo smartyTranslate(array('s'=>'Store Information','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
<span class="wpicon wpicon-plus small"></span></h4>
    <div>
        <ul class="toggle-footer list-icon-custom">
            <?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value!=''){?>
                <li>
                    <span class="wpicon wpicon-location medium"></span>
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value!=''){?>, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?>
                </li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value!=''){?>
                <li>
                    <span class="wpicon wpicon-phone medium"></span><?php echo smartyTranslate(array('s'=>'Call us now:','mod'=>'blockcontactinfos'),$_smarty_tpl);?>

                    <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
                </li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value!=''){?>
                <li>
                    <span class="wpicon wpicon-envelop medium"></span><?php echo smartyTranslate(array('s'=>'Email:','mod'=>'blockcontactinfos'),$_smarty_tpl);?>

                    <span><?php echo smarty_function_mailto(array('address'=>htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value, ENT_QUOTES, 'UTF-8', true),'encode'=>"hex"),$_smarty_tpl);?>
</span>
                </li>
            <?php }?>
        </ul>
    </div>
</div><?php }} ?>