<?php /* Smarty version Smarty-3.1.14, created on 2015-01-20 11:37:20
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/maintenance.tpl" */ ?>
<?php /*%%SmartyHeaderCode:209572907054be3df0618733-00194606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c57173b653ceccb6a9080ed80489aacba251ebe7' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/maintenance.tpl',
      1 => 1419544602,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209572907054be3df0618733-00194606',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang_iso' => 0,
    'meta_title' => 0,
    'meta_description' => 0,
    'meta_keywords' => 0,
    'nobots' => 0,
    'favicon_url' => 0,
    'css_dir' => 0,
    'logo_url' => 0,
    'logo_image_width' => 0,
    'logo_image_height' => 0,
    'HOOK_MAINTENANCE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54be3df06f16d6_51418504',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54be3df06f16d6_51418504')) {function content_54be3df06f16d6_51418504($_smarty_tpl) {?>

<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
" style="height:100%">
    <head>
        <title><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)){?>
            <meta name="description" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['meta_keywords']->value)){?>
            <meta name="keywords" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
        <?php }?>
        <meta name="robots" content="<?php if (isset($_smarty_tpl->tpl_vars['nobots']->value)){?>no<?php }?>index,follow" />
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
/wp_framework/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
/wp_framework/layout.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
/wp_framework/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
autumn.css" rel="stylesheet" type="text/css" />
    </head>
    <body id="maintenance" class="maintenance" style="height:100%">
        <div id="wrapper">
            <div class="row">
                <div class="column col-12-12">
                    <div id="logo">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['logo_url']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['logo_image_width']->value){?>width="<?php echo $_smarty_tpl->tpl_vars['logo_image_width']->value;?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['logo_image_height']->value){?>height="<?php echo $_smarty_tpl->tpl_vars['logo_image_height']->value;?>
"<?php }?> alt="logo" />
                    </div>
                    <div id="message">
                        <div><?php echo smartyTranslate(array('s'=>'In order to perform website maintenance, our online store will be temporarily offline.'),$_smarty_tpl);?>
</div>
                        <div><?php echo smartyTranslate(array('s'=>'We apologize for the inconvenience and ask that you please try again later.'),$_smarty_tpl);?>
</div>
                    </div>
                    <?php echo $_smarty_tpl->tpl_vars['HOOK_MAINTENANCE']->value;?>

                </div>
            </div>
        </div>
    </body>
</html>
<?php }} ?>