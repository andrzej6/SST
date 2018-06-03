<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:29:23
         compiled from "/home/gbs2/public_html/themes/autumn/modules/sendtoafriend/sendtoafriend-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90896188654ad5ee37a3366-09696260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01f99c03e44b309c572bb045dcf326d63f6bb344' => 
    array (
      0 => '/home/gbs2/public_html/themes/autumn/modules/sendtoafriend/sendtoafriend-extra.tpl',
      1 => 1419545341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90896188654ad5ee37a3366-09696260',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'stf_product' => 0,
    'stf_product_cover' => 0,
    'link' => 0,
    'stf_secure_key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5ee3874612_96234272',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5ee3874612_96234272')) {function content_54ad5ee3874612_96234272($_smarty_tpl) {?> <div>               <div id="prod-email-us" class="iconed-text">                    <span class="wpicon wpicon-envelop medium"></span>                    <a id="send_us_button" href="#send_us_form">		                       <?php echo smartyTranslate(array('s'=>'Email us about this product','mod'=>'sendtoafriend'),$_smarty_tpl);?>
	                  </a>            </div>       			      <div id="forward-product" class="iconed-text">                    <span class="wpicon wpicon-envelop medium"></span>                    <a id="send_friend_button" href="#send_friend_form">		                       <?php echo smartyTranslate(array('s'=>'Forward this product by email','mod'=>'sendtoafriend'),$_smarty_tpl);?>
	                  </a>             </div>            <div id="prod-call-us" class="iconed-text">                                          <span class="wpicon wpicon-phone medium"></span>                 <span class="callustext">Call us about this product</span>                 <span class="callusnumber"> 0333 220 0375</span>                           </div>      </div>                        		<div style="display: none;">		<div id="send_friend_form">			<h3 class="section-header">				<?php echo smartyTranslate(array('s'=>'Forward this product by Email','mod'=>'sendtoafriend'),$_smarty_tpl);?>
			</h3>			<div>				<div class="product row">					<img class="white-border-3px column col-3-12" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['stf_product']->value->link_rewrite,$_smarty_tpl->tpl_vars['stf_product_cover']->value,'atmn_large'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['stf_product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />					<div class="product_desc column col-9-12">						<p class="product_name">							<strong><?php echo $_smarty_tpl->tpl_vars['stf_product']->value->name;?>
</strong>						</p>						<?php echo $_smarty_tpl->tpl_vars['stf_product']->value->description_short;?>
					</div>				</div>				<div class="send_friend_form_content col-xs-12 col-sm-6" id="send_friend_form_content">					<div id="send_friend_form_error"></div>					<div id="send_friend_form_success"></div>					<div class="form_container">						<p class="intro_form">							<?php echo smartyTranslate(array('s'=>'Recipient','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 :						</p>						<p class="text">							<label for="friend_name">								<?php echo smartyTranslate(array('s'=>'Name of recipient','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :							</label>							<input id="friend_name" name="friend_name" type="text" value=""/>						</p>						<p class="text">							<label for="friend_email">								<?php echo smartyTranslate(array('s'=>'E-mail address of recipient','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :							</label>							<input id="friend_email" name="friend_email" type="text" value=""/>						</p>						<p class="txt_required">							<sup class="required">*</sup> <?php echo smartyTranslate(array('s'=>'Required fields','mod'=>'sendtoafriend'),$_smarty_tpl);?>
						</p>					</div>					<p class="submit">						<button id="sendEmail" class="button-1 fill" name="sendEmail" type="submit">							<span><?php echo smartyTranslate(array('s'=>'Send','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</span>						</button>						<a class="closefb" href="#">							<?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'sendtoafriend'),$_smarty_tpl);?>
						</a>					</p>        				</div>      			</div>    		</div>					</div>				<div style="display:none;">				<div id="send_us_form">			<h3 class="section-header">				<?php echo smartyTranslate(array('s'=>'Email us about this product','mod'=>'sendtoafriend'),$_smarty_tpl);?>
			</h3>			<div>				<div class="product row">					<img class="white-border-3px column col-3-12" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['stf_product']->value->link_rewrite,$_smarty_tpl->tpl_vars['stf_product_cover']->value,'atmn_large'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['stf_product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />					<div class="product_desc column col-9-12">						<p class="product_name">							<strong><?php echo $_smarty_tpl->tpl_vars['stf_product']->value->name;?>
</strong>						</p>						<?php echo $_smarty_tpl->tpl_vars['stf_product']->value->description_short;?>
					</div>				</div>				<div class="send_friend_form_content col-xs-12 col-sm-6" id="send_us_form_content">					<div id="send_us_form_error"></div>					<div id="send_us_form_success"></div>					<div class="form_container">						<p class="intro_form">							<?php echo smartyTranslate(array('s'=>'Your Message','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 						</p>															 <p class="text">							<label for="your_phone">								<?php echo smartyTranslate(array('s'=>'Your phone number','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :							</label>							<input id="your_phone" name="your_phone" type="text" value=""/>						</p>					  					  <p class="text">							<label for="your_email">								<?php echo smartyTranslate(array('s'=>'Your e-mail address','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :							</label>							<input id="your_email" name="your_email" type="text" value=""/>						</p>											<div class="form-group">            <label for="message"><?php echo smartyTranslate(array('s'=>'Message'),$_smarty_tpl);?>
 <sup class="required">*</sup> :</label>            <textarea class="form-control" id="message" name="message"></textarea>         </div>	                                    <p class="txt_required">							<sup class="required">*</sup> <?php echo smartyTranslate(array('s'=>'Required fields','mod'=>'sendtoafriend'),$_smarty_tpl);?>
						</p>         						         					</div>																	<p class="submit">						<button id="sendEmail1" class="button-1 fill" name="sendEmail1" type="submit">							<span><?php echo smartyTranslate(array('s'=>'Send','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</span>						</button>						<a class="closefb" href="#">							<?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'sendtoafriend'),$_smarty_tpl);?>
						</a>					</p>      			</div>      			</div>     		</div>				</div>																								<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('stf_secure_key'=>$_smarty_tpl->tpl_vars['stf_secure_key']->value),$_smarty_tpl);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'stf_msg_success')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_success'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Your e-mail has been sent successfully','mod'=>'sendtoafriend','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_success'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'stf_msg_error')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_error'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Your e-mail could not be sent. Please check the e-mail address and try again.','mod'=>'sendtoafriend','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_error'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'stf_msg_title')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_title'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_title'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'stf_msg_required')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_required'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'You did not fill required fields','mod'=>'sendtoafriend','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'stf_msg_required'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }} ?>