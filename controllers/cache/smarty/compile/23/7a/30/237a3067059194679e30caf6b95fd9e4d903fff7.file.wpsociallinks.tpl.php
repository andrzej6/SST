<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:37
         compiled from "/home/gbs2/public_html/modules/wpsociallinks/views/templates/hook/wpsociallinks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81284987754ad564581b7b1-01602681%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '237a3067059194679e30caf6b95fd9e4d903fff7' => 
    array (
      0 => '/home/gbs2/public_html/modules/wpsociallinks/views/templates/hook/wpsociallinks.tpl',
      1 => 1419548359,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81284987754ad564581b7b1-01602681',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wpsociallinks' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad56458870e1_28296453',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad56458870e1_28296453')) {function content_54ad56458870e1_28296453($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['wpsociallinks']->value['links']){?>

    <div id="wpsociallinks">

        <div class="wpsociallinks-text">
            <?php echo smartyTranslate(array('s'=>'Connect with us:','mod'=>'wpsociallinks'),$_smarty_tpl);?>

        </div>

        <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpsociallinks']->value['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>

            <div class="wpsociallink">
                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['link'];?>
" <?php if (($_smarty_tpl->tpl_vars['link']->value['open_in_new'])){?>target="_blank"<?php }?>>
                    <?php if ((isset($_smarty_tpl->tpl_vars['link']->value['custom_icon'])&&$_smarty_tpl->tpl_vars['link']->value['custom_icon']!='')){?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['wpsociallinks']->value['iconPath'];?>
<?php echo $_smarty_tpl->tpl_vars['link']->value['custom_icon'];?>
" />
                    <?php }else{ ?>
                        <span class="wpicon medium2 wpicon-<?php echo $_smarty_tpl->tpl_vars['link']->value['icon'];?>
"></span>
                    <?php }?>
                </a>
            </div>

        <?php } ?>

    </div>

<?php }?><?php }} ?>