<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 16:29:24
         compiled from "/home/gbs2/public_html/modules/productbundles/productbundles.tpl" */ ?>
<?php /*%%SmartyHeaderCode:72317731754ad5ee4e4a3f3-40954352%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8b63161644fd078d0e7844b7575e46a322138d5' => 
    array (
      0 => '/home/gbs2/public_html/modules/productbundles/productbundles.tpl',
      1 => 1419420815,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '72317731754ad5ee4e4a3f3-40954352',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'isinpack' => 0,
    'tabletoprint' => 0,
    'packtoprint' => 0,
    'packcontain' => 0,
    'link' => 0,
    'themeimagedir' => 0,
    'packItems' => 0,
    'prodbycat' => 0,
    'viewedProduct' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad5ee502c071_29598422',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad5ee502c071_29598422')) {function content_54ad5ee502c071_29598422($_smarty_tpl) {?><!-- Block mymodule -->    <div>           <?php if ($_smarty_tpl->tpl_vars['isinpack']->value){?>                <div class="bundle_title"> Bundle options:</div>        <br/>                                <?php  $_smarty_tpl->tpl_vars['packtoprint'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['packtoprint']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabletoprint']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['packtoprint']->key => $_smarty_tpl->tpl_vars['packtoprint']->value){
$_smarty_tpl->tpl_vars['packtoprint']->_loop = true;
?>                                                                                  <table class="bundlestable">                <tr><td colspan="2" height="5" class="bundletitle"><?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['packtoprint']->value[0]['name'],45,'...'), ENT_QUOTES, 'UTF-8', true);?>
 contains:</td></tr>                                <?php  $_smarty_tpl->tpl_vars['packcontain'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['packcontain']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['packtoprint']->value[1]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['packcontain']->key => $_smarty_tpl->tpl_vars['packcontain']->value){
$_smarty_tpl->tpl_vars['packcontain']->_loop = true;
?>                                                                                                                              <tr>                     <td class="leftalign">                                                               <a class="item-name-link" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['packcontain']->value['id_product']);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['packcontain']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">                                  <?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['packcontain']->value['name'],45,'...'), ENT_QUOTES, 'UTF-8', true);?>
                       </a>                                                               </td>                                          <td>                    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packcontain']->value['price']),$_smarty_tpl);?>
                                          </td>                     </tr>               <?php } ?>                                                                               <tr class="bdivider"><td class="leftalign"> Combined prize  </td><td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packtoprint']->value[0]['simpleaddproduct']),$_smarty_tpl);?>
 </td></tr>               <tr><td class="leftalign"> Bundle price    </td><td class="greencell"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packtoprint']->value[0]['price']),$_smarty_tpl);?>
 </td></tr>               <tr><td class="leftalign"> You save        </td><td class="redcell">    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packtoprint']->value[0]['simpleaddproduct']-$_smarty_tpl->tpl_vars['packtoprint']->value[0]['price']),$_smarty_tpl);?>
  </td></tr>               <tr><td colspan="2" class="getbundle">               <a class="item-name-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['packtoprint']->value[0]['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['packtoprint']->value[0]['name'], ENT_QUOTES, 'UTF-8', true);?>
">                           <img src="<?php echo $_smarty_tpl->tpl_vars['themeimagedir']->value;?>
/mypic/bundle.png" alt="bundle icon" height="20" width="20"> VIEW BUNDLE                </a></td></tr>                              </table>                                              <br/>                                                     <?php } ?>                                         <?php }elseif(isset($_smarty_tpl->tpl_vars['packItems']->value)&&count($_smarty_tpl->tpl_vars['packItems']->value)>0){?>                                                                                                                 <div class="bundle_title"> Bundle content:</div>                                                                                                                                                                                                    <div id="pack_cont_changed" class="page-product-box">                                        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-pack-list1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('products'=>$_smarty_tpl->tpl_vars['packItems']->value), 0);?>
                                    </div>                                                                                                                                                                                                                                                                      <?php }else{ ?>                         <!-- Block Viewed products -->     <div id="viewed-products_block_left" class="block shorterblock">	   <p class="title_block"><?php echo smartyTranslate(array('s'=>'Popular products','mod'=>'blockviewed'),$_smarty_tpl);?>
</p>	    <div class="block_content products-block">		    <ul class="grid grid-2">			<?php  $_smarty_tpl->tpl_vars['viewedProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewedProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['prodbycat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['viewedProduct']->key => $_smarty_tpl->tpl_vars['viewedProduct']->value){
$_smarty_tpl->tpl_vars['viewedProduct']->_loop = true;
?>				<li class="item t-align-center">					<a class="products-block-image img-wrapper"	href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"	title="<?php echo smartyTranslate(array('s'=>'More about %s','mod'=>'blockviewed','sprintf'=>array(htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value['name'], ENT_QUOTES, 'UTF-8', true))),$_smarty_tpl);?>
" >						<img class="viewedborder white-border-3px" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['viewedProduct']->value['link'],$_smarty_tpl->tpl_vars['viewedProduct']->value['id_image'],'atmn_small'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" />					</a>					<div class="product-content">						<h5>							<a class="product-name" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"	title="<?php echo smartyTranslate(array('s'=>'More about %s','mod'=>'blockviewed','sprintf'=>array(htmlspecialchars($_smarty_tpl->tpl_vars['viewedProduct']->value['name'], ENT_QUOTES, 'UTF-8', true))),$_smarty_tpl);?>
">								<?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['viewedProduct']->value['name'],25,'...'), ENT_QUOTES, 'UTF-8', true);?>
							</a>						</h5>					</div>				</li>			<?php } ?>		</ul>	</div></div>                                                                                                                                                                                 <?php }?>                       </div>  <!-- /Block mymodule --><?php }} ?>