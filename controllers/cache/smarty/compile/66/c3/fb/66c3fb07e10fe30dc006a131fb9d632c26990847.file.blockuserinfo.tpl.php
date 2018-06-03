<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:35
         compiled from "/home/gbs2/public_html/themes/autumn/modules/blockuserinfo/blockuserinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145368838754ad5643a1b869-30137687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66c3fb07e10fe30dc006a131fb9d632c26990847' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/modules/blockuserinfo/blockuserinfo.tpl',
      1 => 1419545163,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145368838754ad5643a1b869-30137687',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_logged' => 0,
    'link' => 0,
    'cookie' => 0,
    'WPMM_has_customer_an_address' => 0,
    'WPMM_returnAllowed' => 0,
    'WPMM_voucherAllowed' => 0,
    'WPMM_HOOK_CUSTOMER_ACCOUNT' => 0,
    'back' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5643c21869_20053795',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5643c21869_20053795')) {function content_54ad5643c21869_20053795($_smarty_tpl) {?><div id="header_user_info">
    <?php if ($_smarty_tpl->tpl_vars['is_logged']->value){?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="account" rel="nofollow"><?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>
</a>
        <span class="separator">-</span>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="logout" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
    <?php }else{ ?>
    
    
       

            
           <span class="h-leftcol">     
	               <span class="h-col"> <a href="/responses/prestashop/"><?php echo smartyTranslate(array('s'=>'Home','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a></span>
	                 
	               <span class="h-col"> <a href="/responses/prestashop/contact-us"><?php echo smartyTranslate(array('s'=>'Contact Us','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</a> </span>
	            
	            
	            
	        </span>  
		           
		           
		      <div class="h-centcol">     
		            <span class="h-col">
		            <span class="wpicon wpicon-envelop small"></span>
		            <a href="mailto:sales@sit-stand.com?subject=enquiry">sales@sit-stand.com</a>
		            </span> 
		           
		           
		           
		           <span class="h-col">
		            <span class="wpicon wpicon-phone small"></span>
		             0333 220 0375
		            </span> 
		           
		       </div>
		       
		           
		           
		       <span class="h-rightcol">    
		           <span class="h-col">
	                 <div id="header_search_wrapper">

                    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHeaderSearchBlock'),$_smarty_tpl);?>


                </div>

                </span>
       
          
     
     
    
    
                 <span class="h-col">
                 <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Login or Register','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="login" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Login or Register','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
                 </span>
           
            </span>
    
    
    
    
    <?php }?>
</div>


<?php if ($_smarty_tpl->tpl_vars['is_logged']->value){?>
    <div id="mobile_header_user_info" class="soft-hide">
        <span class="username">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="account" rel="nofollow">
                <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>

            </a>
        </span>

        <span class="myaccount">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="account" rel="nofollow"><?php echo smartyTranslate(array('s'=>'My Account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
            <span class="separator">|</span>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="logout" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
        </span>
    </div>

    <div id="mobile_myaccount" class="soft-hide">
        <ul class="myaccount-link-list grid grid-3">
            <?php if ($_smarty_tpl->tpl_vars['WPMM_has_customer_an_address']->value){?>
                <li class="item">
                    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Add my first address'),$_smarty_tpl);?>
">
                        <span class="wpicon wpicon-address-book xlarge"></span>
                        <span><?php echo smartyTranslate(array('s'=>'Add my first address'),$_smarty_tpl);?>
</span>
                    </a>
                </li>
            <?php }?>
            <li class="item">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('history',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Orders'),$_smarty_tpl);?>
">
                    <span class="wpicon wpicon-cart xlarge"></span>
                    <span><?php echo smartyTranslate(array('s'=>'Order history and details'),$_smarty_tpl);?>
</span>
                </a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['WPMM_returnAllowed']->value){?>
                <li class="item">
                    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order-follow',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Merchandise returns'),$_smarty_tpl);?>
">
                        <span class="wpicon wpicon-undo xlarge"></span>
                        <span><?php echo smartyTranslate(array('s'=>'My merchandise returns'),$_smarty_tpl);?>
</span>
                    </a>
                </li>
            <?php }?>
            <li class="item">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order-slip',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Credit slips'),$_smarty_tpl);?>
">
                    <span class="wpicon wpicon-file xlarge"></span>
                    <span><?php echo smartyTranslate(array('s'=>'My credit slips'),$_smarty_tpl);?>
</span>
                </a>
            </li>
            <li class="item">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('addresses',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Addresses'),$_smarty_tpl);?>
">
                    <span class="wpicon wpicon-address-book xlarge"></span>
                    <span><?php echo smartyTranslate(array('s'=>'My addresses'),$_smarty_tpl);?>
</span>
                </a>
            </li>
            <li class="item">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('identity',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Information'),$_smarty_tpl);?>
">
                    <span class="wpicon wpicon-vcard xlarge"></span>
                    <span><?php echo smartyTranslate(array('s'=>'My personal information'),$_smarty_tpl);?>
</span>
                </a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['WPMM_voucherAllowed']->value){?>
                <li class="item">
                    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('discount',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Vouchers'),$_smarty_tpl);?>
">
                        <span class="wpicon wpicon-ticket xlarge"></span>
                        <span><?php echo smartyTranslate(array('s'=>'My vouchers'),$_smarty_tpl);?>
</span>
                    </a>
                </li>
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['WPMM_HOOK_CUSTOMER_ACCOUNT']->value;?>

        </ul>
    </div>

<?php }else{ ?>

    <div id="quick_login" class="soft-hide">
        <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true);?>
" method="post" id="login_form" class="box inline">
            <h3 class="section-header"><?php echo smartyTranslate(array('s'=>'Already registered?'),$_smarty_tpl);?>
</h3>
            <div class="form_content">
                <div class="form-group">
                    <label for="email"><?php echo smartyTranslate(array('s'=>'Email address'),$_smarty_tpl);?>
</label>
                    <input class="is_required validate account_input form-control" data-validate="isEmail" type="text" id="email" name="email" value="<?php if (isset($_POST['email'])){?><?php echo stripslashes($_POST['email']);?>
<?php }?>" />
                </div>
                <div class="form-group">
                    <label for="passwd"><?php echo smartyTranslate(array('s'=>'Password'),$_smarty_tpl);?>
</label>
                    <input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="passwd" value="<?php if (isset($_POST['passwd'])){?><?php echo stripslashes($_POST['passwd']);?>
<?php }?>" />
                </div>
                <div class="lost_password form-group"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('password'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Recover your forgotten password'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Forgot your password?'),$_smarty_tpl);?>
</a></div>
                <div class="form-group submit">
                    <?php if (isset($_smarty_tpl->tpl_vars['back']->value)){?><input type="hidden" class="hidden" name="back" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['back']->value, ENT_QUOTES, 'UTF-8', true);?>
" /><?php }?>
                    <button type="submit" id="SubmitLogin" name="SubmitLogin" class="button-1 fill">
                        <?php echo smartyTranslate(array('s'=>'Sign in'),$_smarty_tpl);?>

                    </button>
                </div>
            </div>
        </form>

        <div class="quick_login_register">
            <h3 class="section-header"><?php echo smartyTranslate(array('s'=>'Don\'t have an account?','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</h3>

            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Register Now','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="login button-1 fill inline" rel="nofollow">
                <?php echo smartyTranslate(array('s'=>'Register Now','mod'=>'blockuserinfo'),$_smarty_tpl);?>

            </a>
        </div>
    </div>


<?php }?><?php }} ?>