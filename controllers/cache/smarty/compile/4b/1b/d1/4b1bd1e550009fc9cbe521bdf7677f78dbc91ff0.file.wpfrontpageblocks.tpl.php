<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 22:49:54
         compiled from "/home/gbs2/public_html/prestashop/modules/wpfrontpageblocks/views/templates/hook/wpfrontpageblocks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1628925858549c785ff24b95-11942103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b1bd1e550009fc9cbe521bdf7677f78dbc91ff0' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/wpfrontpageblocks/views/templates/hook/wpfrontpageblocks.tpl',
      1 => 1419547732,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1628925858549c785ff24b95-11942103',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c786009a074_91138207',
  'variables' => 
  array (
    'wpfrontpageblocks' => 0,
    'block' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c786009a074_91138207')) {function content_549c786009a074_91138207($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['wpfrontpageblocks']->value['blocks']){?>

    <div id="wpfrontpageblocks" class="row parent">

        <?php if (($_smarty_tpl->tpl_vars['wpfrontpageblocks']->value['mainTitle']!='')){?>
            <div class="row">
                <div class="column col-12-12 title-1">
                    <?php echo $_smarty_tpl->tpl_vars['wpfrontpageblocks']->value['mainTitle'];?>

                </div>
            </div>
        <?php }?>

        <div class="row">
            <div class="column col-12-12">
                <ul class="grid grid-<?php echo $_smarty_tpl->tpl_vars['wpfrontpageblocks']->value['columnCount'];?>
">

                    <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpfrontpageblocks']->value['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
                        <?php if (($_smarty_tpl->tpl_vars['block']->value->image!='')){?>

                            <li class="wpfrontpageblock item white-border-3px">
                                <?php if ((isset($_smarty_tpl->tpl_vars['block']->value->link)&&$_smarty_tpl->tpl_vars['block']->value->link!='')){?>
                                    <a class="hover-container" href="<?php echo $_smarty_tpl->tpl_vars['block']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['block']->value->open_in_new){?>target="_blank"<?php }?>>
                                <?php }else{ ?>
                                    <div class="hover-container">
                                <?php }?>

                                    <?php if (($_smarty_tpl->tpl_vars['wpfrontpageblocks']->value['hover'])){?>
                                        <div class="hover">
                                            <div class="title"><?php echo $_smarty_tpl->tpl_vars['block']->value->title;?>
</div>
                                            <?php if (($_smarty_tpl->tpl_vars['block']->value->description!='')){?><div class="description"><?php echo $_smarty_tpl->tpl_vars['block']->value->description;?>
</div><?php }?>
                                        </div>
                                    <?php }?>

                                    <img src="<?php echo $_smarty_tpl->tpl_vars['block']->value->image;?>
" />

                                <?php if ((isset($_smarty_tpl->tpl_vars['block']->value->link)&&$_smarty_tpl->tpl_vars['block']->value->link!='')){?>
                                    </a>
                                <?php }else{ ?>
                                    </div>
                                <?php }?>
                            </li>

                        <?php }?>
                    <?php } ?>

                </ul>
            </div>
        </div>

    </div>

<?php }?><?php }} ?>