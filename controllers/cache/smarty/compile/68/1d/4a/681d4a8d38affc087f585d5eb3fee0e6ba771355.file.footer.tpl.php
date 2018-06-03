<?php /* Smarty version Smarty-3.1.14, created on 2015-01-05 23:53:01
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112660359054ab23ddbafe54-36096417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '681d4a8d38affc087f585d5eb3fee0e6ba771355' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/footer.tpl',
      1 => 1419544567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112660359054ab23ddbafe54-36096417',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'HOOK_LEFT_COLUMN' => 0,
    'hide_left_column' => 0,
    'WPAC_sidebarPosition' => 0,
    'sidebarClasses' => 0,
    'WPAC_footerColumnCount' => 0,
    'HOOK_FOOTER' => 0,
    'WPAC_customFooterText' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23ddbf3c43_63042854',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23ddbf3c43_63042854')) {function content_54ab23ddbf3c43_63042854($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>

                    </div>
                    <!-- End of Center Column -->

                    <?php if ((isset($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value)&&!$_smarty_tpl->tpl_vars['hide_left_column']->value)){?>

                        <?php if (($_smarty_tpl->tpl_vars['WPAC_sidebarPosition']->value=="left")){?>
                            <?php $_smarty_tpl->tpl_vars['sidebarClasses'] = new Smarty_variable('pull-9-12 sidebar-left', null, 0);?>
                        <?php }elseif(($_smarty_tpl->tpl_vars['WPAC_sidebarPosition']->value=="right")){?>
                            <?php $_smarty_tpl->tpl_vars['sidebarClasses'] = new Smarty_variable('sidebar-right', null, 0);?>
                        <?php }?>

                        <!-- Sidebar -->
                        <div id="sidebar" class="column col-3-12 <?php echo $_smarty_tpl->tpl_vars['sidebarClasses']->value;?>
">
                            <?php echo $_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value;?>

                        </div>
                        <!-- End of Sidebar -->

                    <?php }?>

                </div>
                <!-- End of Main Row -->

            </div>
            <!-- End of Columns -->

            <!-- Footer -->
            <footer id="footer">

                <section id="footer-social-links">
                    <div class="row">
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayFooterSocialLinks'),$_smarty_tpl);?>

                    </div>
                </section>

                <section id="main-footer" class="row">
                    <div class="grid grid-<?php if ((isset($_smarty_tpl->tpl_vars['WPAC_footerColumnCount']->value)&&$_smarty_tpl->tpl_vars['WPAC_footerColumnCount']->value)){?><?php echo $_smarty_tpl->tpl_vars['WPAC_footerColumnCount']->value;?>
<?php }?>">
                        <?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>

                    </div>
                </section>

                <section id="bottom-footer">
                    <div class="row">
                        <div class="column col-12-12">
                            <?php if (isset($_smarty_tpl->tpl_vars['WPAC_customFooterText']->value)){?>
                                <?php echo $_smarty_tpl->tpl_vars['WPAC_customFooterText']->value;?>

                            <?php }?>
                        </div>
                    </div>
                </section>

            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Wrapper -->

    </div>
    <!-- End of Outer Wrapper -->

<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


</body>
</html>

<?php }} ?>