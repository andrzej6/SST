<?php /* Smarty version Smarty-3.1.14, created on 2014-12-30 13:52:25
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcategories/blockcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1852080594549c7fe7b2f6c5-14249870%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '787009e30e22bfbd676ee020d983eb9046c4e563' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/blockcategories/blockcategories.tpl',
      1 => 1419545062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1852080594549c7fe7b2f6c5-14249870',
  'function' => 
  array (
  ),
  'cache_lifetime' => 31536000,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c7fe7bf60d9_02823480',
  'variables' => 
  array (
    'blockCategTree' => 0,
    'currentCategory' => 0,
    'isDhtml' => 0,
    'child' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c7fe7bf60d9_02823480')) {function content_549c7fe7bf60d9_02823480($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['blockCategTree']->value&&count($_smarty_tpl->tpl_vars['blockCategTree']->value['children'])){?><!-- Block categories module --><div id="categories_block_left" class="block">	<h2 class="title_block">		<?php if (isset($_smarty_tpl->tpl_vars['currentCategory']->value)){?>						<?php echo smartyTranslate(array('s'=>'Browse Categories','mod'=>'blockcategories'),$_smarty_tpl);?>
		<?php }else{ ?>			<?php echo smartyTranslate(array('s'=>'Categories','mod'=>'blockcategories'),$_smarty_tpl);?>
		<?php }?>	</h2>	<div class="block_content browsecatlist">		<ul class="tree <?php if ($_smarty_tpl->tpl_vars['isDhtml']->value){?>dhtml<?php }?> list-icon-arrow">			<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blockCategTree']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
$_smarty_tpl->tpl_vars['child']->_loop = true;
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blockCategTree']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>				<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['blockCategTree']['last']){?>					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value,'last'=>'true'), 0);?>
				<?php }else{ ?>					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value), 0);?>
				<?php }?>			<?php } ?>		</ul>	</div></div><!-- /Block categories module --><?php }?><?php }} ?>