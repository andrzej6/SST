<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:36
         compiled from "/home/gbs2/public_html/modules/wpmegamenu/views/templates/hook/wpmegamenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174413567754ad5644e7b5a2-89273892%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0521ec508ff4bc90831ac11a30da30066c0cc232' => 
    array (
      0 => '/home/gbs2/public_html/modules/wpmegamenu/views/templates/hook/wpmegamenu.tpl',
      1 => 1419548104,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174413567754ad5644e7b5a2-89273892',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wpmegamenu' => 0,
    'wpmegamenumobile' => 0,
    'root' => 0,
    'menuItem' => 0,
    'depth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad56452a1b84_64628003',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad56452a1b84_64628003')) {function content_54ad56452a1b84_64628003($_smarty_tpl) {?><?php if ((isset($_smarty_tpl->tpl_vars['wpmegamenu']->value)&&$_smarty_tpl->tpl_vars['wpmegamenu']->value)){?>

    <nav id="wpmegamenu<?php if (isset($_smarty_tpl->tpl_vars['wpmegamenumobile']->value)&&$_smarty_tpl->tpl_vars['wpmegamenumobile']->value){?>-mobile<?php }else{ ?>-main<?php }?>" class="wpmegamenu">
        <ul>
            <?php  $_smarty_tpl->tpl_vars['root'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['root']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpmegamenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['root']->key => $_smarty_tpl->tpl_vars['root']->value){
$_smarty_tpl->tpl_vars['root']->_loop = true;
?>

                <li class="root root-<?php echo $_smarty_tpl->tpl_vars['root']->value->id_wpmegamenu;?>
 <?php echo $_smarty_tpl->tpl_vars['root']->value->menu_class;?>
">
                    <div class="root-item <?php if ($_smarty_tpl->tpl_vars['root']->value->description==''){?>no-description<?php }?>">

                        <?php if ($_smarty_tpl->tpl_vars['root']->value->link!=''){?><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['root']->value->open_in_new){?>target="_blank"<?php }?>><?php }?>
                            <div class="title"><?php if ($_smarty_tpl->tpl_vars['root']->value->icon_class!=''){?><span class="icon <?php echo $_smarty_tpl->tpl_vars['root']->value->icon_class;?>
"></span><?php }?><?php echo $_smarty_tpl->tpl_vars['root']->value->title;?>
</div>
                            <?php if ($_smarty_tpl->tpl_vars['root']->value->description!=''){?><span class="description"><?php echo $_smarty_tpl->tpl_vars['root']->value->description;?>
</span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['root']->value->link!=''){?></a><?php }?>

                    </div>

                    <?php if (isset($_smarty_tpl->tpl_vars['root']->value->items)){?>
                        <ul class="menu-items">

                            <?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable(1, null, 0);?>

                            <?php  $_smarty_tpl->tpl_vars['menuItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['root']->value->items; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['menuItem']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->key => $_smarty_tpl->tpl_vars['menuItem']->value){
$_smarty_tpl->tpl_vars['menuItem']->_loop = true;
 $_smarty_tpl->tpl_vars['menuItem']->index++;
?>

                                <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->depth>$_smarty_tpl->tpl_vars['depth']->value)){?>
                                    <ul class="submenu submenu-depth-<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->depth;?>
">
                                <?php }elseif(($_smarty_tpl->tpl_vars['menuItem']->value->depth<$_smarty_tpl->tpl_vars['depth']->value)){?>
                                    <?php echo str_repeat('</ul></li>',($_smarty_tpl->tpl_vars['depth']->value-$_smarty_tpl->tpl_vars['menuItem']->value->depth));?>

                                <?php }?>

                                    <li class="menu-item menu-item-<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
 depth-<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->depth;?>
 <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name;?>
 <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->menu_layout;?>
 <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->menu_class;?>
 <?php if (isset($_smarty_tpl->tpl_vars['menuItem']->value->image)&&$_smarty_tpl->tpl_vars['menuItem']->value->image){?> withimage<?php }?>">

                                        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name=='customlink'||$_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name=='category'||$_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name=='cmspage')){?>

                                            <div class="title">
                                                <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->link!=''){?><a href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new){?>target="_blank"<?php }?>><?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->icon_class!=''){?><span class="icon <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->icon_class;?>
"></span><?php }?><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->title;?>

                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->description!=''){?><span class="description"><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->description;?>
</span><?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->link!=''){?></a><?php }?>
                                            </div>

                                        <?php }elseif(($_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name=='product')){?>

                                            <?php if (isset($_smarty_tpl->tpl_vars['menuItem']->value->image)&&$_smarty_tpl->tpl_vars['menuItem']->value->image){?>
                                                <a class="white-border-3px img-wrapper" href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new){?>target="_blank"<?php }?>>
                                                    <div class="product-image"><img src="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->image;?>
" /></div>
                                                </a>
                                            <?php }?>
                                            <div class="title">
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new){?>target="_blank"<?php }?>>
                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->icon_class!=''){?><span class="icon <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->icon_class;?>
"></span><?php }?><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->title;?>

                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->description!=''){?><span class="description"><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->description;?>
</span><?php }?>
                                                </a>
                                            </div>

                                        <?php }elseif(($_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name=='manufacturer')){?>

                                            <?php if (isset($_smarty_tpl->tpl_vars['menuItem']->value->image)&&$_smarty_tpl->tpl_vars['menuItem']->value->image){?>
                                                <a class="white-border-3px img-wrapper" href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new){?>target="_blank"<?php }?>>
                                                    <div class="manufacturer-image"><img src="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->image;?>
" /></div>
                                                </a>
                                            <?php }?>
                                            <div class="title">
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new){?>target="_blank"<?php }?>>
                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->icon_class!=''){?><span class="icon <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->icon_class;?>
"></span><?php }?><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->title;?>

                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->description!=''){?><span class="description"><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->description;?>
</span><?php }?>
                                                </a>
                                            </div>

                                        <?php }elseif(($_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name=='supplier')){?>

                                            <?php if (isset($_smarty_tpl->tpl_vars['menuItem']->value->image)&&$_smarty_tpl->tpl_vars['menuItem']->value->image){?>
                                                <a class="white-border-3px img-wrapper" href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new){?>target="_blank"<?php }?>>
                                                    <div class="supplier-image"><img src="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->image;?>
" /></div>
                                                </a>
                                            <?php }?>
                                            <div class="title">
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link;?>
" <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new){?>target="_blank"<?php }?>>
                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->icon_class!=''){?><span class="icon <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->icon_class;?>
"></span><?php }?><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->title;?>

                                                    <?php if ($_smarty_tpl->tpl_vars['menuItem']->value->description!=''){?><span class="description"><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->description;?>
</span><?php }?>
                                                </a>
                                            </div>

                                        <?php }elseif(($_smarty_tpl->tpl_vars['menuItem']->value->menu_type_name=='customcontent')){?>

                                            <div class="normalized">
                                                <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->content;?>

                                            </div>

                                        <?php }?>


                                <?php if (($_smarty_tpl->tpl_vars['menuItem']->index!=(count($_smarty_tpl->tpl_vars['root']->value->items)-1))&&($_smarty_tpl->tpl_vars['root']->value->items[($_smarty_tpl->tpl_vars['menuItem']->index+1)]->depth<=$_smarty_tpl->tpl_vars['menuItem']->value->depth)){?>
                                    </li>
                                <?php }?>

                                <?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable($_smarty_tpl->tpl_vars['menuItem']->value->depth, null, 0);?>

                                <?php if (($_smarty_tpl->tpl_vars['menuItem']->index==count($_smarty_tpl->tpl_vars['root']->value->items)-1)){?>
                                    </li></ul><?php echo str_repeat('</ul></li>',($_smarty_tpl->tpl_vars['depth']->value-1));?>

                                <?php }?>

                            <?php } ?>

                    <?php }?>

                </li>

            <?php } ?>
        </ul>
    </nav>

<?php }?><?php }} ?>