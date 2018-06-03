<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:35
         compiled from "/home/gbs2/public_html/themes/autumn/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106533990954ad5643609ab0-56068176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6acef651029b8404c5c2abd83ee681207cd47977' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/header.tpl',
      1 => 1419544576,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106533990954ad5643609ab0-56068176',
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
    'nofollow' => 0,
    'favicon_url' => 0,
    'img_update_time' => 0,
    'page_name' => 0,
    'have_image' => 0,
    'product' => 0,
    'cover' => 0,
    'link' => 0,
    'css_files' => 0,
    'css_uri' => 0,
    'media' => 0,
    'css_dir' => 0,
    'WPAC_customCSS' => 0,
    'HOOK_HEADER' => 0,
    'body_classes' => 0,
    'hide_left_column' => 0,
    'hide_right_column' => 0,
    'content_only' => 0,
    'WPAC_mainLayout' => 0,
    'restricted_country_mode' => 0,
    'geolocation_country' => 0,
    'WPAC_stickyMenu' => 0,
    'CONTENT_HEADER' => 0,
    'HOOK_LEFT_COLUMN' => 0,
    'WPAC_sidebarPosition' => 0,
    'centerColumnClasses' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5643863101_06727397',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5643863101_06727397')) {function content_54ad5643863101_06727397($_smarty_tpl) {?><?php if (!is_callable('smarty_function_implode')) include '/home/gbs2/public_html/tools/smarty/plugins/function.implode.php';
?>

<!DOCTYPE HTML>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
">
	<head>
		<title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>

        <?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)&&$_smarty_tpl->tpl_vars['meta_description']->value){?>
		    <meta name="description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['meta_keywords']->value)&&$_smarty_tpl->tpl_vars['meta_keywords']->value){?>
		    <meta name="keywords" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
        <?php }?>

        
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="generator" content="PrestaShop" />
		<meta name="robots" content="<?php if (isset($_smarty_tpl->tpl_vars['nobots']->value)){?>no<?php }?>index,<?php if (isset($_smarty_tpl->tpl_vars['nofollow']->value)&&$_smarty_tpl->tpl_vars['nofollow']->value){?>no<?php }?>follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['img_update_time']->value;?>
" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['img_update_time']->value;?>
" />
        

        
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        

        
        <meta property="og:title" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
        <meta property="og:type"   content="product" />

        <?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)&&$_smarty_tpl->tpl_vars['meta_description']->value){?>
            <meta name="description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['page_name']->value)&&$_smarty_tpl->tpl_vars['page_name']->value=="product"&&isset($_smarty_tpl->tpl_vars['have_image']->value)&&$_smarty_tpl->tpl_vars['have_image']->value){?>
            <meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value->link_rewrite,$_smarty_tpl->tpl_vars['cover']->value['id_image'],'atmn_large');?>
" />
        <?php }?>
        

        
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        

        <?php if (isset($_smarty_tpl->tpl_vars['css_files']->value)){?>
            <?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['media']->_loop = false;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['css_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value){
$_smarty_tpl->tpl_vars['media']->_loop = true;
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
                <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" />
            <?php } ?>
        <?php }?>

        
        <!--[if IE 9]> <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
ie/ie9.css" type="text/css" media="all" /><![endif]-->
        

        <?php if ((isset($_smarty_tpl->tpl_vars['WPAC_customCSS']->value))){?>
        <!-- Start Custom CSS -->
            <style><?php echo $_smarty_tpl->tpl_vars['WPAC_customCSS']->value;?>
</style>
        <!-- End Custom CSS -->
        <?php }?>

		<?php echo $_smarty_tpl->tpl_vars['HOOK_HEADER']->value;?>


	</head>

	<body itemscope itemtype="http://schema.org/WebPage" <?php if (isset($_smarty_tpl->tpl_vars['page_name']->value)){?> id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?> class="<?php if (isset($_smarty_tpl->tpl_vars['page_name']->value)){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_name']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['body_classes']->value)&&count($_smarty_tpl->tpl_vars['body_classes']->value)){?> <?php echo smarty_function_implode(array('value'=>$_smarty_tpl->tpl_vars['body_classes']->value,'separator'=>' '),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['hide_left_column']->value){?> hide-left-column<?php }?><?php if ($_smarty_tpl->tpl_vars['hide_right_column']->value){?> hide-right-column<?php }?><?php if ($_smarty_tpl->tpl_vars['content_only']->value){?> content_only<?php }?> lang_<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['WPAC_mainLayout']->value;?>
">

    <?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>

		<?php if (isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['restricted_country_mode']->value){?>
			<div id="restricted-country">
				<p><?php echo smartyTranslate(array('s'=>'You cannot place a new order from your country:'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->tpl_vars['geolocation_country']->value;?>
</span></p>
			</div>
		<?php }?>

        <!-- Outer Wrapper -->
        <div id="outer-wrapper">

            <!-- Mobile Menu -->
            <div id="wpmm-nav">
                <div class="row">
                    <div id="wpmm-nav-buttons" class="column col-12-12"></div>
                </div>
            </div>
            <div id="wpmm-container" class="">
                <div id="wpmm-tabs"></div>
            </div>
            <!-- End of Mobile Menu -->

            <!-- Wrapper -->
            <div id="wrapper" <?php if (isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['restricted_country_mode']->value){?>style="margin-top: 40px;"<?php }?>>

                <!-- Cart Layer -->
                <div id="cart-layer-wrapper"></div>
                <!-- End of Cart Layer -->

                <!-- Header -->
                <header id="header">
                    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./".((string)$_smarty_tpl->tpl_vars['WPAC_headerStyle']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                </header>
                <!-- End of Header -->

                <?php if ((isset($_smarty_tpl->tpl_vars['WPAC_stickyMenu']->value)&&$_smarty_tpl->tpl_vars['WPAC_stickyMenu']->value)){?>
                    <div id="sticky-menu-wrapper">
                        <div class="row valign-middle">
                             <div>
                        
                                <div id="sticky-logo" class="column col-for-logo"></div>
                                <div id="sticky-menu" class="column col-8-12"></div>
                            
                            </div>
                            
                            
                                    <div id="sticky-cart" class="column col-for-basket t-align-right hide-below-1024"></div>
                           
                            
                        </div>
                        
                    </div>
                <?php }?>

                <?php if ((isset($_smarty_tpl->tpl_vars['page_name']->value)&&$_smarty_tpl->tpl_vars['page_name']->value=="index")){?>
                    <!-- Slider -->
                    <div id="frontpage-slider">
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomepageSlider'),$_smarty_tpl);?>

                    </div>
                    <!-- End of Slider -->
                <?php }?>

                <?php if ((isset($_smarty_tpl->tpl_vars['CONTENT_HEADER']->value)&&$_smarty_tpl->tpl_vars['CONTENT_HEADER']->value!='')){?>
                    <?php echo $_smarty_tpl->tpl_vars['CONTENT_HEADER']->value;?>

                <?php }?>

                <!-- Columns -->
                <div id="columns" class="<?php if ((isset($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value)&&!$_smarty_tpl->tpl_vars['hide_left_column']->value)){?>sidebar-enabled<?php }?>">

                    <!-- Main Row -->
                    <div class="row parent">

                        <?php if ((isset($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value)&&!$_smarty_tpl->tpl_vars['hide_left_column']->value)){?>
                            <?php if (($_smarty_tpl->tpl_vars['WPAC_sidebarPosition']->value=="left")){?>
                                <?php $_smarty_tpl->tpl_vars['centerColumnClasses'] = new Smarty_variable('col-9-12 push-3-12', null, 0);?>
                            <?php }elseif(($_smarty_tpl->tpl_vars['WPAC_sidebarPosition']->value=="right")){?>
                                <?php $_smarty_tpl->tpl_vars['centerColumnClasses'] = new Smarty_variable('col-9-12', null, 0);?>
                            <?php }?>
                        <?php }else{ ?>
                            <?php $_smarty_tpl->tpl_vars['centerColumnClasses'] = new Smarty_variable('col-12-12', null, 0);?>
                        <?php }?>

                        <!-- Center Column -->
                        <div id="center_column" class="column <?php echo $_smarty_tpl->tpl_vars['centerColumnClasses']->value;?>
"><?php }?>

                            <?php if ((!isset($_smarty_tpl->tpl_vars['CONTENT_HEADER']->value)||(isset($_smarty_tpl->tpl_vars['CONTENT_HEADER']->value)&&$_smarty_tpl->tpl_vars['CONTENT_HEADER']->value==''))){?>
                                <!-- Breadcrumb Column -->
                                <div id="breadcrumb" class="row">
                                        <?php if ($_smarty_tpl->tpl_vars['page_name']->value!='index'&&$_smarty_tpl->tpl_vars['page_name']->value!='pagenotfound'){?>
                                            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                                        <?php }?>
                                </div>
                                <!-- End Breadcrumb Column -->
                            <?php }?><?php }} ?>