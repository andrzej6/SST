<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 21:10:58
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockviewed/blockviewed.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138109986254ada0e2d6ea23-16668888%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bb925736d0ca6fefed0d1da4e8fe731f0fb96ac' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockviewed/blockviewed.tpl',
      1 => 1419545168,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138109986254ada0e2d6ea23-16668888',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productsViewedObj' => 0,
    'viewedProduct' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ada0e2e68341_74690571',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ada0e2e68341_74690571')) {function content_54ada0e2e68341_74690571($_smarty_tpl) {?><!-- Block Viewed products --><div id="viewed-products_block_left" class="block viewed-blue-border">	<p class="title_block"><?php echo smartyTranslate(array('s'=>'Recently viewed products','mod'=>'blockviewed'),$_smarty_tpl);?>
</p>	<div class="block_content products-block">		<ul class="grid grid-2">			<?php  $_smarty_tpl->tpl_vars['viewedProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewedProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productsViewedObj']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['viewedProduct']->key => $_smarty_tpl->tpl_vars['viewedProduct']->value){
$_smarty_tpl->tpl_vars['viewedProduct']->_loop = true;
?>				<li class="item t-align-center">					<a class="products-block-image img-wrapper"	href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value->product_link, ENT_QUOTES, 'UTF-8', true);?>
"	title="<?php echo smartyTranslate(array('s'=>'More about %s','mod'=>'blockviewed','sprintf'=>array(htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value->name, ENT_QUOTES, 'UTF-8', true))),$_smarty_tpl);?>
" >						<img class="viewedborder" src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['viewedProduct']->value->link_rewrite,$_smarty_tpl->tpl_vars['viewedProduct']->value->cover,'atmn_small');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value->legend, ENT_QUOTES, 'UTF-8', true);?>
" />					</a>					<div class="product-content">						<h5>							<a class="product-name" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value->product_link, ENT_QUOTES, 'UTF-8', true);?>
"	title="<?php echo smartyTranslate(array('s'=>'More about %s','mod'=>'blockviewed','sprintf'=>array(htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value->name, ENT_QUOTES, 'UTF-8', true))),$_smarty_tpl);?>
">								<?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['viewedProduct']->value->name,25,'...'), ENT_QUOTES, 'UTF-8', true);?>
							</a>						</h5>					</div>				</li>			<?php } ?>		</ul>	</div></div><?php }} ?>