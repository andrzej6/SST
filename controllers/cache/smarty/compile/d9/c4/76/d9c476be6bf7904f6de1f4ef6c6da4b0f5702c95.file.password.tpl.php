<?php /* Smarty version Smarty-3.1.14, created on 2015-01-08 18:30:31
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:86088449354aeccc73342f1-36809424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9c476be6bf7904f6de1f4ef6c6da4b0f5702c95' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/password.tpl',
      1 => 1419544670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86088449354aeccc73342f1-36809424',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'navigationPipe' => 0,
    'confirmation' => 0,
    'customer_email' => 0,
    'request_uri' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54aeccc78cb128_68094447',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aeccc78cb128_68094447')) {function content_54aeccc78cb128_68094447($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?>
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Authentication'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Authentication'),$_smarty_tpl);?>
</a>
    <span class="navigation-pipe"><?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>
</span><?php echo smartyTranslate(array('s'=>'Forgot your password'),$_smarty_tpl);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<div class="row forgotpass-page-wrapper">
    <div class="column col-12-12 t-align-center">

    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


        <?php if (isset($_smarty_tpl->tpl_vars['confirmation']->value)&&$_smarty_tpl->tpl_vars['confirmation']->value==1){?>
            <p class="alert alert-success"><?php echo smartyTranslate(array('s'=>'Your password has been successfully reset and a confirmation has been sent to your email address:'),$_smarty_tpl);?>
 <?php if (isset($_smarty_tpl->tpl_vars['customer_email']->value)){?><?php echo stripslashes(htmlspecialchars($_smarty_tpl->tpl_vars['customer_email']->value, ENT_QUOTES, 'UTF-8', true));?>
<?php }?></p>
        <?php }elseif(isset($_smarty_tpl->tpl_vars['confirmation']->value)&&$_smarty_tpl->tpl_vars['confirmation']->value==2){?>
            <p class="alert alert-success"><?php echo smartyTranslate(array('s'=>'A confirmation email has been sent to your address:'),$_smarty_tpl);?>
 <?php if (isset($_smarty_tpl->tpl_vars['customer_email']->value)){?><?php echo stripslashes(htmlspecialchars($_smarty_tpl->tpl_vars['customer_email']->value, ENT_QUOTES, 'UTF-8', true));?>
<?php }?></p>
        <?php }else{ ?>
            <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['request_uri']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="post" class="box inline" id="form_forgotpassword">
                <h3 class="section-header"><?php echo smartyTranslate(array('s'=>'Password recovery'),$_smarty_tpl);?>
</h3>
                <div class="form-group"><?php echo smartyTranslate(array('s'=>'Please enter the email address you used to register. We will then send you a new password.'),$_smarty_tpl);?>
</div>
                <div class="form-group">
                    <label for="email"><?php echo smartyTranslate(array('s'=>'Email address'),$_smarty_tpl);?>
</label>
                    <input class="form-control" type="text" id="email" name="email" value="<?php if (isset($_POST['email'])){?><?php echo stripslashes(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8', true));?>
<?php }?>" />
                </div>
                <div class="form-group submit">
                    <button type="submit" class="button-1 fill"><?php echo smartyTranslate(array('s'=>'Retrieve Password'),$_smarty_tpl);?>
</button>
                </div>
            </form>
        <?php }?>

    </div>
</div>

<ul class="footer_links">
	<li>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Back to Login'),$_smarty_tpl);?>
" rel="nofollow">
            <span class="wpicon wpicon-chevron-left small"></span><?php echo smartyTranslate(array('s'=>'Back to Login'),$_smarty_tpl);?>

        </a>
    </li>
</ul>
<?php }} ?>