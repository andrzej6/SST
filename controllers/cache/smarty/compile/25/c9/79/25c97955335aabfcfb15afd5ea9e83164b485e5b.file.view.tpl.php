<?php /* Smarty version Smarty-3.1.14, created on 2014-12-26 00:07:46
         compiled from "/home/gbs2/public_html/prestashop/modules/wpmegamenu/views/templates/admin/wp_megamenu/helpers/view/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:762578245549ca6d2e7dd24-00762946%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25c97955335aabfcfb15afd5ea9e83164b485e5b' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/wpmegamenu/views/templates/admin/wp_megamenu/helpers/view/view.tpl',
      1 => 1419548095,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '762578245549ca6d2e7dd24-00762946',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wpmm_ajax_url' => 0,
    'wpmm_id_wpmegamenu' => 0,
    'iso' => 0,
    'ad' => 0,
    'languages' => 0,
    'language' => 0,
    'id_default_lang' => 0,
    'lang' => 0,
    'wpmmCategories' => 0,
    'wpmmCategory' => 0,
    'wpmmManufacturers' => 0,
    'wpmmManufacturer' => 0,
    'wpmmSuppliers' => 0,
    'wpmmSupplier' => 0,
    'wpmmCMSPages' => 0,
    'wpmmMenuItems' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549ca6d33abb55_97251233',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549ca6d33abb55_97251233')) {function content_549ca6d33abb55_97251233($_smarty_tpl) {?><script>
    var wpmm_ajax_url = '<?php echo $_smarty_tpl->tpl_vars['wpmm_ajax_url']->value;?>
';
    var wpmm_id_wpmegamenu = <?php echo $_smarty_tpl->tpl_vars['wpmm_id_wpmegamenu']->value;?>
;

    // Rich Text Editor related
    var iso = '<?php echo addslashes($_smarty_tpl->tpl_vars['iso']->value);?>
';
    var pathCSS = '<?php echo addslashes(@constant('_THEME_CSS_DIR_'));?>
';
    var ad = '<?php echo addslashes($_smarty_tpl->tpl_vars['ad']->value);?>
';
</script>

<div class="left-column col-lg-4">

    
    <form id="wpmm_customlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="1" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add Custom Link / Text'),$_smarty_tpl);?>

            </div>

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

                                <label for="wpmm_customlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_customlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_customlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="clearable" />
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

                                <label for="wpmm_customlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_customlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_customlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="clearable" />
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

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_customlink_submit" name="wpmm_customlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add Custom Link / Text'),$_smarty_tpl);?>

                </button>
            </div>
        </div>

    </form>
    



    
    <form id="wpmm_categorylink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="2" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add Category Link'),$_smarty_tpl);?>

            </div>

            <div class="form-group hidden">
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

                                <label for="wpmm_categorylink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_categorylink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_categorylink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_categorylink_title" />
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

            <div class="form-group hidden">
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

                                <label for="wpmm_categorylink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                                <div class="col-lg-7">
                                    <input type="text" id="wpmm_categorylink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_categorylink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_categorylink_link" />
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

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">

                        <label for="wpmm_categorylink_category" class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Category'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-7">
                            <select id="wpmm_categorylink_category" name="wpmm_categorylink_category">
                                <?php  $_smarty_tpl->tpl_vars['wpmmCategory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wpmmCategory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpmmCategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wpmmCategory']->key => $_smarty_tpl->tpl_vars['wpmmCategory']->value){
$_smarty_tpl->tpl_vars['wpmmCategory']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['wpmmCategory']->value['value'];?>
"><?php echo $_smarty_tpl->tpl_vars['wpmmCategory']->value['name'];?>
</option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_categorylink_submit" name="wpmm_categorylink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add Category Link'),$_smarty_tpl);?>

                </button>
            </div>
        </div>

    </form>
    



    
    <form id="wpmm_productlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="3" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add Product Link'),$_smarty_tpl);?>

            </div>

            <div class="form-group hidden">
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

                            <label for="wpmm_productlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_productlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_productlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"  class="wpmm_productlink_title" />
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

            <div class="form-group hidden">
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

                            <label for="wpmm_productlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_productlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_productlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_productlink_link" />
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

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="wpmm_productlink_product" class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Product'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-7">
                            <input type="text" id="wpmm_productlink_product" name="wpmm_productlink_product" class="clearable" />
                            <p class="help-block"><?php echo smartyTranslate(array('s'=>'Start typing a product name...'),$_smarty_tpl);?>
</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_productlink_submit" name="wpmm_productlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add Product Link'),$_smarty_tpl);?>

                </button>
            </div>
        </div>

    </form>
    



    
    <form id="wpmm_manufacturerlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="4" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add Manufacturer Link'),$_smarty_tpl);?>

            </div>

            <div class="form-group hidden">
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

                            <label for="wpmm_manufacturerlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_manufacturerlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_manufacturerlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_manufacturerlink_title" />
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

            <div class="form-group hidden">
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

                            <label for="wpmm_manufacturerlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_manufacturerlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_manufacturerlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_manufacturerlink_link" />
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

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">

                        <label for="wpmm_manufacturerlink_manufacturer" class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Manufacturer'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-7">
                            <select id="wpmm_manufacturerlink_manufacturer" name="wpmm_manufacturerlink_manufacturer">
                                <?php  $_smarty_tpl->tpl_vars['wpmmManufacturer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wpmmManufacturer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpmmManufacturers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wpmmManufacturer']->key => $_smarty_tpl->tpl_vars['wpmmManufacturer']->value){
$_smarty_tpl->tpl_vars['wpmmManufacturer']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['wpmmManufacturer']->value['value'];?>
"><?php echo $_smarty_tpl->tpl_vars['wpmmManufacturer']->value['name'];?>
</option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_manufacturerlink_submit" name="wpmm_manufacturerlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add Manufacturer Link'),$_smarty_tpl);?>

                </button>
            </div>
        </div>

    </form>
    



    
    <form id="wpmm_supplierlink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="5" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add Supplier Link'),$_smarty_tpl);?>

            </div>

            <div class="form-group hidden">
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

                            <label for="wpmm_supplierlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_supplierlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_supplierlink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_supplierlink_title" />
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

            <div class="form-group hidden">
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

                            <label for="wpmm_supplierlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_supplierlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_supplierlink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_supplierlink_link" />
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

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">

                        <label for="wpmm_supplierlink_category" class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Supplier'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-7">
                            <select id="wpmm_supplierlink_supplier" name="wpmm_supplierlink_supplier">
                                <?php  $_smarty_tpl->tpl_vars['wpmmSupplier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wpmmSupplier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpmmSuppliers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wpmmSupplier']->key => $_smarty_tpl->tpl_vars['wpmmSupplier']->value){
$_smarty_tpl->tpl_vars['wpmmSupplier']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['wpmmSupplier']->value['value'];?>
"><?php echo $_smarty_tpl->tpl_vars['wpmmSupplier']->value['name'];?>
</option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_supplierlink_submit" name="wpmm_supplierlink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add Supplier Link'),$_smarty_tpl);?>

                </button>
            </div>
        </div>

    </form>
    



    
    <form id="wpmm_cmspagelink" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="6" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add CMS Page Link'),$_smarty_tpl);?>

            </div>

            <div class="form-group hidden">
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

                            <label for="wpmm_cmspagelink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_cmspagelink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_cmspagelink_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_cmspagelink_title" />
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

            <div class="form-group hidden">
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

                            <label for="wpmm_cmspagelink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_cmspagelink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_cmspagelink_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="wpmm_cmspagelink_link" />
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

            <div class="form-group">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="wpmm_cmspagelink_cmspage" class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'CMS Page'),$_smarty_tpl);?>
</label>
                        <div class="col-lg-7">
                            <select id="wpmm_cmspagelink_cmspage" name="wpmm_cmspagelink_cmspage">
                                <?php echo $_smarty_tpl->tpl_vars['wpmmCMSPages']->value;?>

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="wpmm_cmspagelink_submit" name="wpmm_cmspagelink_submit" class="btn btn-default pull-right">
                    <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add CMS Page Link'),$_smarty_tpl);?>

                </button>
            </div>
        </div>

    </form>
    



    
    <form id="wpmm_customcontent" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="7" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add Custom Content'),$_smarty_tpl);?>

            </div>

            <div class="form-group hidden">
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

                            <label for="wpmm_customcontent_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_customcontent_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_customcontent_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="Custom Content" />
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

            <div class="form-group hidden">
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

                            <label for="wpmm_customcontent_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_customcontent_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_customcontent_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="customcontent" />
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

            <div class="form-group">
                <div class="col-lg-12">
                    <button type="submit" value="1"  id="wpmm_advanced_customcontent" name="wpmm_advanced_customcontent" class="btn btn-default wpmm_advanced_customcontent">
                        <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add Custom Content'),$_smarty_tpl);?>

                    </button>
                </div>
            </div>

        </div>

    </form>
    




    
    <form id="wpmm_divider" class="wpmm_addmenuitemform form-horizontal">

        <input type="hidden" name="menu_type" value="8" />

        <div class="panel">
            <div class="panel-heading">
                <i class="icon-edit"></i> <?php echo smartyTranslate(array('s'=>'Add Divider'),$_smarty_tpl);?>

            </div>

            <div class="form-group hidden">
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

                            <label for="wpmm_divider_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_divider_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_divider_title_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="Divider" />
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

            <div class="form-group hidden">
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

                            <label for="wpmm_divider_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="control-label col-lg-3 required"><?php echo smartyTranslate(array('s'=>'Link'),$_smarty_tpl);?>
</label>
                            <div class="col-lg-7">
                                <input type="text" id="wpmm_divider_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="wpmm_divider_link_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="divider" />
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

            <div class="form-group">
                <div class="col-lg-12">
                    <button type="submit" value="1"  id="wpmm_advanced_divider" name="wpmm_advanced_divider" class="btn btn-default wpmm_advanced_divider">
                        <i class="process-icon-new"></i> <?php echo smartyTranslate(array('s'=>'Add Divider'),$_smarty_tpl);?>

                    </button>
                </div>
            </div>

        </div>

    </form>
    

</div>

<div class="right-column col-lg-8">

    <div class="panel">
        <div class="panel-heading">
            <i class="icon-list"></i> <?php echo smartyTranslate(array('s'=>'Menu Structure'),$_smarty_tpl);?>

        </div>

        <div id="wpmmMenuBuilder">
            <?php echo $_smarty_tpl->getSubTemplate ('./menu_builder.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('wpmmMenuItems'=>$_smarty_tpl->tpl_vars['wpmmMenuItems']->value), 0);?>

        </div>
    </div>

</div>




<?php }} ?>