<?php /* Smarty version Smarty-3.1.14, created on 2015-01-19 14:37:31
         compiled from "/home/gbs2/public_html/prestashop/modules/productbundles/productbundles.tpl" */ ?>
<?php /*%%SmartyHeaderCode:915203586549c78244a1d55-39765719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ff598b364925b545bbb6db3981373bbc775978e' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/modules/productbundles/productbundles.tpl',
      1 => 1421678217,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '915203586549c78244a1d55-39765719',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c782456ea99_80176608',
  'variables' => 
  array (
    'isinpack' => 0,
    'tabletoprint' => 0,
    'packtoprint' => 0,
    'packcontain' => 0,
    'link' => 0,
    'themeimagedir' => 0,
    'packItems' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c782456ea99_80176608')) {function content_549c782456ea99_80176608($_smarty_tpl) {?><!-- Block mymodule -->    <div>           
<?php if ($_smarty_tpl->tpl_vars['isinpack']->value){?>                <div class="bundle_title"> Bundle options:</div>        <br/>                                
<?php  $_smarty_tpl->tpl_vars['packtoprint'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['packtoprint']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabletoprint']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['packtoprint']->key => $_smarty_tpl->tpl_vars['packtoprint']->value){
$_smarty_tpl->tpl_vars['packtoprint']->_loop = true;
?>                                                                                  
<table class="bundlestable">                
<tr><td colspan="2" height="5" class="bundletitle"><?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['packtoprint']->value[0]['name'],45,'...'), ENT_QUOTES, 'UTF-8', true);?>
 contains:</td></tr>                                
<?php  $_smarty_tpl->tpl_vars['packcontain'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['packcontain']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['packtoprint']->value[1]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['packcontain']->key => $_smarty_tpl->tpl_vars['packcontain']->value){
$_smarty_tpl->tpl_vars['packcontain']->_loop = true;
?>                                            
                                        
				   <tr>                     <td class="leftalign">                                                              
				   <a class="item-name-link" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['packcontain']->value['id_product']);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['packcontain']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">  
				   <?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['packcontain']->value['name'],45,'...'), ENT_QUOTES, 'UTF-8', true);?>
                       </a>                                                              
				   </td>                                          <td>                    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packcontain']->value['price']),$_smarty_tpl);?>
                                         
				   </td>                     </tr>               <?php } ?>                                                                               
				   <tr class="bdivider"><td class="leftalign"> Combined prize  </td><td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packtoprint']->value[0]['simpleaddproduct']),$_smarty_tpl);?>
 </td></tr>              
				   <tr><td class="leftalign"> Bundle price    </td><td class="greencell"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packtoprint']->value[0]['price']),$_smarty_tpl);?>
 </td></tr>               
				   <tr><td class="leftalign"> You save        </td><td class="redcell">    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['packtoprint']->value[0]['simpleaddproduct']-$_smarty_tpl->tpl_vars['packtoprint']->value[0]['price']),$_smarty_tpl);?>
  </td></tr>  
				   <tr><td colspan="2" class="getbundle">               
				   <a class="item-name-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['packtoprint']->value[0]['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['packtoprint']->value[0]['name'], ENT_QUOTES, 'UTF-8', true);?>
">                          
				   <img src="<?php echo $_smarty_tpl->tpl_vars['themeimagedir']->value;?>
/mypic/bundle.png" alt="bundle icon" height="20" width="20"> VIEW BUNDLE                </a></td></tr>                              
				   </table>                                              <br/>                                                     <?php } ?>                                         
				   <?php }elseif(isset($_smarty_tpl->tpl_vars['packItems']->value)&&count($_smarty_tpl->tpl_vars['packItems']->value)>0){?>                                                                                                                 
				   
				   <div class="bundle_title"> Bundle content:</div>                                                                            
				   <div id="pack_cont_changed" class="page-product-box">                                        
				   <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-pack-list1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('products'=>$_smarty_tpl->tpl_vars['packItems']->value), 0);?>
                                    </div>  
				   <?php }else{ ?>                         
				   
				   
				   <!-- Block Viewed products -->     
				   
				   <div id="viewed-products_block_left" class="block shorterblock">	  
				   <p class="title_block"><?php echo smartyTranslate(array('s'=>'Popular products','mod'=>'blockviewed'),$_smarty_tpl);?>
</p>	    
				   
				   <div class="block_content products-block">	

				   
				          <ul class="grid grid-2">			
						  
				              <li class="item t-align-center">
				                     <a class="products-block-image img-wrapper"	href="http://sit-stand.com/prestashop/stools-seating/24-muvman-stool.html"	
								        title="More about Muvman Stool" >		
								  
				                     <img class="viewedborder white-border-3px" src="http://sit-stand.com/prestashop/66-atmn_small/http://sit-stand.com/prestashop/stools-seating/24-muvman-stool.html.jpg" 
								            alt="Muvman Stool" />					
								     </a>	
									 
						            <div class="product-content">						
						               <h5>							
				                          <a class="product-name" href="http://sit-stand.com/prestashop/stools-seating/24-muvman-stool.html"	
										     title="More about Muvman Stool">
				                              <?php echo smartyTranslate(array('s'=>'Muvman Stool'),$_smarty_tpl);?>
							
						                 </a>					
						              </h5>					
					               </div>	
						      </li>
							  
							  
							  <li class="item t-align-center">
				                     <a class="products-block-image img-wrapper"	href="http://sit-stand.com/prestashop/electric-desks/32-milk-classic.html"	
								        title="More about Milk Classic" >		
								  
				                     <img class="viewedborder white-border-3px" src="http://sit-stand.com/prestashop/128-atmn_small/http://sit-stand.com/prestashop/electric-desks/32-milk-classic.html.jpg" 
								            alt="Milk Classic" />					
								     </a>	
									 
						            <div class="product-content">						
						               <h5>							
				                          <a class="product-name" href="http://sit-stand.com/prestashop/electric-desks/32-milk-classic.html"	
										     title="More about Milk Classic">
				                              <?php echo smartyTranslate(array('s'=>'Milk Classic'),$_smarty_tpl);?>
							
						                 </a>					
						              </h5>					
					               </div>	
						      </li>
							  
							  
							  
							  <li class="item t-align-center">
				                     <a class="products-block-image img-wrapper"	href="http://sit-stand.com/prestashop/electric-desks/75-hushdesk.html"	
								        title="More about Hushdesk" >		
								  
				                     <img class="viewedborder white-border-3px" src="http://sit-stand.com/prestashop/275-atmn_small/http://sit-stand.com/prestashop/electric-desks/75-hushdesk.html.jpg" 
								            alt="Hushdesk" />					
								     </a>	
									 
						            <div class="product-content">						
						               <h5>							
				                          <a class="product-name" href="http://sit-stand.com/prestashop/electric-desks/75-hushdesk.html"	
										     title="More about Hushdesk">
				                              <?php echo smartyTranslate(array('s'=>'Hushdesk'),$_smarty_tpl);?>
							
						                 </a>					
						              </h5>					
					               </div>	
						      </li>
							  
							  
							  <li class="item t-align-center">
				                     <a class="products-block-image img-wrapper"	href="http://sit-stand.com/prestashop/electric-desks/76-sohodesk.html"	
								        title="More about Sohodesk" >		
								  
				                     <img class="viewedborder white-border-3px" src="http://sit-stand.com/prestashop/276-atmn_small/http://sit-stand.com/prestashop/electric-desks/76-sohodesk.html.jpg" 
								            alt="Sohodesk" />					
								     </a>	
									 
						            <div class="product-content">						
						               <h5>							
				                          <a class="product-name" href="http://sit-stand.com/prestashop/electric-desks/76-sohodesk.html"	
										     title="More about Sohodesk">
				                              <?php echo smartyTranslate(array('s'=>'Sohodesk'),$_smarty_tpl);?>
							
						                 </a>					
						              </h5>					
					               </div>	
						      </li>
							  
							  
							  
							  <li class="item t-align-center">
				                     <a class="products-block-image img-wrapper"	href="http://sit-stand.com/prestashop/stools/77-ongo.html"	
								        title="More about ONGO" >		
								  
				                     <img class="viewedborder white-border-3px" src="http://sit-stand.com/prestashop/346-atmn_small/http://sit-stand.com/prestashop/stools/77-ongo.html.jpg" 
								            alt="ONGO" />					
								     </a>	
									 
						            <div class="product-content">						
						               <h5>							
				                          <a class="product-name" href="http://sit-stand.com/prestashop/stools/77-ongo.html"	
										     title="More about ONGO">
				                              <?php echo smartyTranslate(array('s'=>'ONGO'),$_smarty_tpl);?>
							
						                 </a>					
						              </h5>					
					               </div>	
						      </li>
							  
							  
							  
							  <li class="item t-align-center">
				                     <a class="products-block-image img-wrapper"	href="http://sit-stand.com/prestashop/manual-lift/27-xtable.html"	
								        title="More about XTable" >		
								  
				                     <img class="viewedborder white-border-3px" src="http://sit-stand.com/prestashop/136-atmn_small/http://sit-stand.com/prestashop/manual-lift/27-xtable.html.jpg" 
								            alt="Xtable" />					
								     </a>	
									 
						            <div class="product-content">						
						               <h5>							
				                          <a class="product-name" href="http://sit-stand.com/prestashop/manual-lift/27-xtable.html"	
										     title="More about XTable">
				                              <?php echo smartyTranslate(array('s'=>'XTable'),$_smarty_tpl);?>
							
						                 </a>					
						              </h5>					
					               </div>	
						      </li>
							

				        </ul>
				</div>
	</div>            
				   <?php }?>                       </div>  <!-- /Block mymodule -->
				   
				   
				   
				   
				   <?php }} ?>