<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 21:53:15
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blocknewsletter/blocknewsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:115922255754ab23dc669293-48208813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '640db4bfd8222341bfe8131b677468013b305b64' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blocknewsletter/blocknewsletter.tpl',
      1 => 1420667575,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '115922255754ab23dc669293-48208813',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ab23dc6c57e2_35652848',
  'variables' => 
  array (
    'msg' => 0,
    'nw_error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab23dc6c57e2_35652848')) {function content_54ab23dc6c57e2_35652848($_smarty_tpl) {?>
<div class="footerstripe">

<div class="item fblock">
	<a href="/prestashop/contact-us"><?php echo smartyTranslate(array('s'=>'Contact Us','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a>
	<div class="block_content">
		
	</div>
</div>



<div class="item fblock">
	<a href="http://sit-stand.com/prestashop/content/10-customer-service"><?php echo smartyTranslate(array('s'=>'Customer Service','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a>
	<div class="block_content">
		
	</div>
</div>






<div class="item fblock">
	<a href="/prestashop/content/3-terms-and-conditions-of-use"><?php echo smartyTranslate(array('s'=>'Terms & Conditions','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a>
	<div class="block_content">
		
	</div>
</div>



<div class="item fblock">
	<a href="http://sit-stand.com/prestashop/content/8-commercial-terms"><?php echo smartyTranslate(array('s'=>'Commercial Terms','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a>
	<div class="block_content">
		
	</div>
</div>



<div class="item fblock">
	<a href="http://sit-stand.com/prestashop/content/9-copywright"><?php echo smartyTranslate(array('s'=>'Copyright','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a>
	<div class="block_content">
		
	</div>
</div>

<div class="item fblock">
	<a href="http://sit-stand.com/prestashop/content/7-privacy"><?php echo smartyTranslate(array('s'=>'Privacy','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a>
	<div class="block_content">
		
	</div>
</div>

<div class="item fblock">
	<a href="/prestashop/sitemap"><?php echo smartyTranslate(array('s'=>'Sitemap','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a>
	<div class="block_content">
		
	</div>
</div>

</div>

<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('msg_newsl'=>addcslashes($_smarty_tpl->tpl_vars['msg']->value,'\'')),$_smarty_tpl);?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['nw_error']->value)){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('nw_error'=>$_smarty_tpl->tpl_vars['nw_error']->value),$_smarty_tpl);?>
<?php }?><?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'placeholder_blocknewsletter')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'placeholder_blocknewsletter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Enter your e-mail','mod'=>'blocknewsletter','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'placeholder_blocknewsletter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'alert_blocknewsletter')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'alert_blocknewsletter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Newsletter : %1$s','sprintf'=>$_smarty_tpl->tpl_vars['msg']->value,'js'=>1,'mod'=>"blocknewsletter"),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'alert_blocknewsletter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><?php }} ?>