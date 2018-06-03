<?php /* Smarty version Smarty-3.1.14, created on 2014-12-26 00:07:47
         compiled from "/home/gbs2/public_html/prestashop/modules/wpmegamenu/views/templates/admin/wp_megamenu/helpers/view/menu_builder.tpl" */ ?>
<?php /*%%SmartyHeaderCode:432054296549ca6d3620ee3-43758589%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12175b5959ba67cdf1f7f1abe0f7352deceda825' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/wpmegamenu/views/templates/admin/wp_megamenu/helpers/view/menu_builder.tpl',
      1 => 1419548091,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '432054296549ca6d3620ee3-43758589',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wpmmMenuItems' => 0,
    'menuItem' => 0,
    'depth' => 0,
    'id_default_lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549ca6d36af450_21536898',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549ca6d36af450_21536898')) {function content_549ca6d36af450_21536898($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['wpmmMenuItems']->value['items']){?>

    <?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable(1, null, 0);?>
    <ol class="sortable">

        <?php  $_smarty_tpl->tpl_vars['menuItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpmmMenuItems']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['menuItem']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->key => $_smarty_tpl->tpl_vars['menuItem']->value){
$_smarty_tpl->tpl_vars['menuItem']->_loop = true;
 $_smarty_tpl->tpl_vars['menuItem']->index++;
?>

            <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->depth>$_smarty_tpl->tpl_vars['depth']->value)){?>
                <ol>
            <?php }elseif(($_smarty_tpl->tpl_vars['menuItem']->value->depth<$_smarty_tpl->tpl_vars['depth']->value)){?>
                <?php echo str_repeat('</ol></li>',($_smarty_tpl->tpl_vars['depth']->value-$_smarty_tpl->tpl_vars['menuItem']->value->depth));?>

            <?php }?>

            <li class="menuItem" id="menuItem_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
">

                <div class="menuitem-container">
                    <div class="title">
                        <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->title[$_smarty_tpl->tpl_vars['id_default_lang']->value];?>

                        <div class="push-right">
                            <div class="menu-type"><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name;?>
</div>
                            <a title="Edit Menu" class="edit-menu-item">Edit</a>
                        </div>
                    </div>

                    <div class="inline-editor-container">
                        <?php echo $_smarty_tpl->getSubTemplate ('./inline_editor.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('menuItem'=>$_smarty_tpl->tpl_vars['menuItem']->value), 0);?>

                    </div>
                </div>

            <?php if (($_smarty_tpl->tpl_vars['menuItem']->index!=$_smarty_tpl->tpl_vars['wpmmMenuItems']->value['count']-1)&&($_smarty_tpl->tpl_vars['wpmmMenuItems']->value['items'][($_smarty_tpl->tpl_vars['menuItem']->index+1)]->depth<=$_smarty_tpl->tpl_vars['menuItem']->value->depth)){?>
                </li>
            <?php }?>

            <?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable($_smarty_tpl->tpl_vars['menuItem']->value->depth, null, 0);?>

            <?php if (($_smarty_tpl->tpl_vars['menuItem']->index==$_smarty_tpl->tpl_vars['wpmmMenuItems']->value['count']-1)){?>
                </li></ol><?php echo str_repeat('</ol></li>',($_smarty_tpl->tpl_vars['depth']->value-1));?>

            <?php }?>

        <?php } ?>

<?php }?>

<?php }} ?>