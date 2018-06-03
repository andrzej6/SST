<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:22
         compiled from "/home/gbs2/public_html/themes/autumn/modules/editorial/editorial.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8953942054ad563629d416-44660121%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce43da083135393f3dc408d37e705590009f6de0' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/modules/editorial/editorial.tpl',
      1 => 1419545235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8953942054ad563629d416-44660121',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'editorial' => 0,
    'homepage_logo' => 0,
    'image_path' => 0,
    'link' => 0,
    'image_width' => 0,
    'image_height' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad563638a0f3_10555567',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad563638a0f3_10555567')) {function content_54ad563638a0f3_10555567($_smarty_tpl) {?>

<div id="editorial_block_center" class="editorial_block normalized">
	<?php if ($_smarty_tpl->tpl_vars['editorial']->value->body_home_logo_link){?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editorial']->value->body_home_logo_link, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo stripslashes(htmlspecialchars($_smarty_tpl->tpl_vars['editorial']->value->body_title, ENT_QUOTES, 'UTF-8', true));?>
"><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['homepage_logo']->value){?><img class="img-responsive" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getMediaLink($_smarty_tpl->tpl_vars['image_path']->value), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo stripslashes(htmlspecialchars($_smarty_tpl->tpl_vars['editorial']->value->body_title, ENT_QUOTES, 'UTF-8', true));?>
" <?php if ($_smarty_tpl->tpl_vars['image_width']->value){?>width="<?php echo $_smarty_tpl->tpl_vars['image_width']->value;?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['image_height']->value){?>height="<?php echo $_smarty_tpl->tpl_vars['image_height']->value;?>
" <?php }?>/><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['editorial']->value->body_home_logo_link){?></a><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['editorial']->value->body_logo_subheading){?><p id="editorial_image_legend"><?php echo stripslashes($_smarty_tpl->tpl_vars['editorial']->value->body_logo_subheading);?>
</p><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['editorial']->value->body_title){?><h1><?php echo stripslashes($_smarty_tpl->tpl_vars['editorial']->value->body_title);?>
</h1><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['editorial']->value->body_subheading){?><h2><?php echo stripslashes($_smarty_tpl->tpl_vars['editorial']->value->body_subheading);?>
</h2><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['editorial']->value->body_paragraph){?><div class="rte"><?php echo stripslashes($_smarty_tpl->tpl_vars['editorial']->value->body_paragraph);?>
</div><?php }?>
</div><?php }} ?>