<?php /* Smarty version Smarty-3.1.14, created on 2014-12-26 00:07:47
         compiled from "/home/gbs2/public_html/prestashop/modules/wpmegamenu/views/templates/admin/wp_megamenu/helpers/view/inline_editor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1599406596549ca6d36b38a5-78354635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9734f07063d927b52b962b0004a7d936865cd659' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/wpmegamenu/views/templates/admin/wp_megamenu/helpers/view/inline_editor.tpl',
      1 => 1419548089,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1599406596549ca6d36b38a5-78354635',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menuItem' => 0,
    'languages' => 0,
    'language' => 0,
    'id_default_lang' => 0,
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549ca6d38f6716_77246763',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549ca6d38f6716_77246763')) {function content_549ca6d38f6716_77246763($_smarty_tpl) {?><form id="wpmm_editmenu_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="wpmm_editmenuitemform form-horizontal">
    <div class="panel">

        <div class="panel-heading">
            <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Edit Menu Item'),$_smarty_tpl);?>

        </div>

        
        <input type="hidden" name="id_wpmegamenuitem" id="id_wpmegamenuitem_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" value="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" />
        <input type="hidden" name="menu_type" id="menu_type_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" value="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->menu_type;?>
" />
        



        
        <?php if ((isset($_smarty_tpl->tpl_vars['menuItem']->value->item_info)&&$_smarty_tpl->tpl_vars['menuItem']->value->item_info)){?>
            <div class="form-group">
                <div class="col-lg-2 control-label"><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->item_info_label;?>
</div>
                <div class="col-lg-10 wpmm_item_info"><a href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->item_info_link;?>
" target="_blank"><strong><?php echo $_smarty_tpl->tpl_vars['menuItem']->value->item_info_name;?>
</strong></a></div>
            </div>
        <?php }?>
        



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type==1)){?>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="translatable-field lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" <?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang']!=$_smarty_tpl->tpl_vars['id_default_lang']->value){?>style="display:none"<?php }?>>
                            <?php }?>

                            <label for="wpmm_editmenu_title_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-2 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-8">
                                <input type="text" id="wpmm_editmenu_title_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_editmenu_title_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->title[$_smarty_tpl->tpl_vars['language']->value['id_lang']];?>
" />
                            </div>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        <?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                                            <li><a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
);" tabindex="-1"><?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>
</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php }?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                </div>
                            <?php }?>

                        <?php } ?>
                    </div>

                </div>
            </div>
        <?php }?>
        



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type==1)){?>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="translatable-field lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" <?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang']!=$_smarty_tpl->tpl_vars['id_default_lang']->value){?>style="display:none"<?php }?>>
                            <?php }?>

                            <label for="wpmm_editmenu_link_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-8">
                                <input type="text" id="wpmm_editmenu_link_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_editmenu_link_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->link[$_smarty_tpl->tpl_vars['language']->value['id_lang']];?>
" />
                            </div>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        <?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                                            <li><a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
);" tabindex="-1"><?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>
</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php }?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                </div>
                            <?php }?>

                        <?php } ?>
                    </div>

                </div>
            </div>
        <?php }?>
        



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type!=7)&&($_smarty_tpl->tpl_vars['menuItem']->value->menu_type!=8)){?>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="translatable-field lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" <?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang']!=$_smarty_tpl->tpl_vars['id_default_lang']->value){?>style="display:none"<?php }?>>
                            <?php }?>

                            <label for="wpmm_editmenu_description_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-8">
                                <input type="text" id="wpmm_editmenu_description_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_editmenu_description_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->description[$_smarty_tpl->tpl_vars['language']->value['id_lang']];?>
" />
                            </div>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        <?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                                            <li><a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
);" tabindex="-1"><?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>
</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php }?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                </div>
                            <?php }?>

                        <?php } ?>
                    </div>

                </div>
            </div>
        <?php }?>
        



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type==7)){?>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php $_smarty_tpl->tpl_vars['use_textarea_autosize'] = new Smarty_variable(true, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="translatable-field lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" <?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang']!=$_smarty_tpl->tpl_vars['id_default_lang']->value){?>style="display:none"<?php }?>>
                            <?php }?>

                            <label for="wpmm_editmenu_customcontent_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Custom content'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-8">
                                
                                <div id="wpmm_editmenu_customcontent_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="custom_content">
                                    <?php echo $_smarty_tpl->tpl_vars['menuItem']->value->content[$_smarty_tpl->tpl_vars['language']->value['id_lang']];?>

                                </div>
                            </div>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
                                        <?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                                            <li><a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
);" tabindex="-1"><?php echo $_smarty_tpl->tpl_vars['lang']->value['name'];?>
</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php }?>

                            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1){?>
                                </div>
                            <?php }?>

                        <?php } ?>
                    </div>

                </div>
            </div>
        <?php }?>
        



        
        <div class="form-group">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="wpmm_editmenu_class_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Custom class'),$_smarty_tpl);?>
</label>
                    <div class="col-lg-8">
                        <input type="text" id="wpmm_editmenu_class_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" name="wpmm_editmenu_class_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" value="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->menu_class;?>
" />
                    </div>
                </div>

            </div>
        </div>
        



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type!=7&&$_smarty_tpl->tpl_vars['menuItem']->value->menu_type!=8)){?>
        <div class="form-group">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="wpmm_editicon_class_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Icon class'),$_smarty_tpl);?>
</label>
                    <div class="col-lg-8">
                        <input type="text" id="wpmm_editicon_class_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" name="wpmm_editicon_class_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" value="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->icon_class;?>
" />
                    </div>
                </div>

            </div>
        </div>
        
        <?php }?>



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type!=7)&&($_smarty_tpl->tpl_vars['menuItem']->value->menu_type!=8)){?>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="wpmm_editmenu_target_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Open in new tab'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-8">
                            <input type="checkbox" id="wpmm_editmenu_target_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" name="wpmm_editmenu_target_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->open_in_new)){?>checked="checked"<?php }?> />
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type==3)||($_smarty_tpl->tpl_vars['menuItem']->value->menu_type==4)||($_smarty_tpl->tpl_vars['menuItem']->value->menu_type==5)){?>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="wpmm_editmenu_showimage_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Show image'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-8">
                            <input type="checkbox" id="wpmm_editmenu_showimage_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" name="wpmm_editmenu_showimage_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->show_image)){?>checked="checked"<?php }?> />
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        



        
        <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_type!=8)){?>
            <div class="form-group wpmm_editmenu_layout_formgroup">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="control-label col-lg-2"><?php echo smartyTranslate(array('s'=>'Column size'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-8">
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='')){?>checked<?php }?> value="auto" /> <?php echo smartyTranslate(array('s'=>'Auto'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-1-1')){?>checked<?php }?> value="menucol-1-1" /> <?php echo smartyTranslate(array('s'=>'1/1'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-1-2')){?>checked<?php }?> value="menucol-1-2" /> <?php echo smartyTranslate(array('s'=>'1/2'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-1-3')){?>checked<?php }?> value="menucol-1-3" /> <?php echo smartyTranslate(array('s'=>'1/3'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-2-3')){?>checked<?php }?> value="menucol-2-3" /> <?php echo smartyTranslate(array('s'=>'2/3'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-1-4')){?>checked<?php }?> value="menucol-1-4" /> <?php echo smartyTranslate(array('s'=>'1/4'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-3-4')){?>checked<?php }?> value="menucol-3-4" /> <?php echo smartyTranslate(array('s'=>'3/4'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-1-5')){?>checked<?php }?> value="menucol-1-5" /> <?php echo smartyTranslate(array('s'=>'1/5'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-1-6')){?>checked<?php }?> value="menucol-1-6" /> <?php echo smartyTranslate(array('s'=>'1/6'),$_smarty_tpl);?>
</label>
                            <label class="wpmm_editmenu_layout_label"><input type="radio" name="wpmm_editmenu_layout_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" <?php if (($_smarty_tpl->tpl_vars['menuItem']->value->menu_layout=='menucol-1-10')){?>checked<?php }?> value="menucol-1-10" /> <?php echo smartyTranslate(array('s'=>'1/10'),$_smarty_tpl);?>
</label>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        

        <div class="panel-footer">
            <button type="submit" value="1" id="wpmm_editmenu_submit_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" name="wpmm_editmenu_submit_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="btn btn-default pull-right">
                <i class="process-icon-new"></i> Update Menu Item
            </button>
            <a id="wpmm_editmenu_delete_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" name="wpmm_editmenu_delete_<?php echo $_smarty_tpl->tpl_vars['menuItem']->value->id;?>
" class="btn btn-default wpmm_editmenu_delete">
                <i class="process-icon-delete"></i> Delete Menu Item
            </a>
        </div>

    </div>
</form><?php }} ?>