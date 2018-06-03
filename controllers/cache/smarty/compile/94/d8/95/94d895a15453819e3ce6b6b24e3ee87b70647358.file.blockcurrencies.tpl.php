<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 23:53:01
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcurrencies/blockcurrencies.tpl" */ ?>
<?php /*%%SmartyHeaderCode:137175846954ab23dd592cf9-27290173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94d895a15453819e3ce6b6b24e3ee87b70647358' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcurrencies/blockcurrencies.tpl',
      1 => 1419545092,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137175846954ab23dd592cf9-27290173',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'currencies' => 0,
    'request_uri' => 0,
    'currency' => 0,
    'cookie' => 0,
    'f_currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23dd5bca54_68839267',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23dd5bca54_68839267')) {function content_54ab23dd5bca54_68839267($_smarty_tpl) {?>
<?php if (count($_smarty_tpl->tpl_vars['currencies']->value)>1){?>
    <div id="currencies_block_top">
        <div id="currency_selector" class="disable-select">
            <form id="setCurrency" action="<?php echo $_smarty_tpl->tpl_vars['request_uri']->value;?>
" method="post">
                <div class="current_currency">
                    <input type="hidden" name="id_currency" id="id_currency" value=""/>
                    <input type="hidden" name="SubmitCurrency" value="" />
                    <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

                </div>

                <ul class="currencies_ul">
                    <?php  $_smarty_tpl->tpl_vars['f_currency'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f_currency']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['currencies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f_currency']->key => $_smarty_tpl->tpl_vars['f_currency']->value){
$_smarty_tpl->tpl_vars['f_currency']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['f_currency']->key;
?>
                        <li class="<?php if ($_smarty_tpl->tpl_vars['cookie']->value->id_currency==$_smarty_tpl->tpl_vars['f_currency']->value['id_currency']){?>selected<?php }else{ ?>selectable<?php }?>">
                            <a href="javascript:setCurrency(<?php echo $_smarty_tpl->tpl_vars['f_currency']->value['id_currency'];?>
);" title="<?php echo $_smarty_tpl->tpl_vars['f_currency']->value['name'];?>
" rel="nofollow"><?php echo $_smarty_tpl->tpl_vars['f_currency']->value['sign'];?>
</a>
                        </li>
                    <?php } ?>
                </ul>
            </form>
        </div>
    </div>
<?php }?><?php }} ?>