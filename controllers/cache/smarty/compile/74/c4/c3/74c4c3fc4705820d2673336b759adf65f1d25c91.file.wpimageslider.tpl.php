<?php /* Smarty version Smarty-3.1.14, created on 2015-01-07 15:52:37
         compiled from "/home/gbs2/public_html/modules/wpimageslider/views/templates/hook/wpimageslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:184364892754ad56454d3b80-01069685%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74c4c3fc4705820d2673336b759adf65f1d25c91' => 
    array (
      0 => '/home/gbs2/public_html/modules/wpimageslider/views/templates/hook/wpimageslider.tpl',
      1 => 1420394404,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184364892754ad56454d3b80-01069685',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wpimageslider' => 0,
    'slide' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54ad56456253f6_19404542',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ad56456253f6_19404542')) {function content_54ad56456253f6_19404542($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['wpimageslider']->value['slides']){?>

    <div class="row parent <?php if (isset($_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_width'])&&$_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_width']=='fullwidth'){?>fullwidth-row<?php }?>">
        <div id="wpimageslider" class="column col-12-12">
            <ul class="slides">

                <?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wpimageslider']->value['slides']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['slider']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value){
$_smarty_tpl->tpl_vars['slide']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['slider']['iteration']++;
?>

               <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['slider']['iteration']==1){?>
                  <li>
                        <a href="http://sit-stand.com/prestashop/stools-seating/24-muvman-stool.html"> 
                        <img src="<?php echo $_smarty_tpl->tpl_vars['slide']->value->slideImage;?>
" /></a>
                        <?php if ((isset($_smarty_tpl->tpl_vars['slide']->value->html)&&$_smarty_tpl->tpl_vars['slide']->value->html!='')){?>
                            <div class="flex-caption <?php echo $_smarty_tpl->tpl_vars['slide']->value->html_position;?>
">
                                <div class="flex-caption-html-content">
                                    <?php echo $_smarty_tpl->tpl_vars['slide']->value->html;?>

                                </div>
                            </div>
                        <?php }?>
                    </li>
               <?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['slider']['iteration']==2){?>
                     
                     <li>
                        <a href="http://sit-stand.com/prestashop/electric-desks/75-hushdesk.html"> 
                        <img src="<?php echo $_smarty_tpl->tpl_vars['slide']->value->slideImage;?>
" /></a>
                        <?php if ((isset($_smarty_tpl->tpl_vars['slide']->value->html)&&$_smarty_tpl->tpl_vars['slide']->value->html!='')){?>
                            <div class="flex-caption <?php echo $_smarty_tpl->tpl_vars['slide']->value->html_position;?>
">
                                <div class="flex-caption-html-content">
                                    <?php echo $_smarty_tpl->tpl_vars['slide']->value->html;?>

                                </div>
                            </div>
                        <?php }?>
                    </li>
                
                <?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['slider']['iteration']==3){?>
                     
                     <li>
                        <a href="http://sit-stand.com/prestashop/electric-desks/76-sohodesk.html"> 
                        <img src="<?php echo $_smarty_tpl->tpl_vars['slide']->value->slideImage;?>
" /></a>
                        <?php if ((isset($_smarty_tpl->tpl_vars['slide']->value->html)&&$_smarty_tpl->tpl_vars['slide']->value->html!='')){?>
                            <div class="flex-caption <?php echo $_smarty_tpl->tpl_vars['slide']->value->html_position;?>
">
                                <div class="flex-caption-html-content">
                                    <?php echo $_smarty_tpl->tpl_vars['slide']->value->html;?>

                                </div>
                            </div>
                        <?php }?>
                    </li>
 

                <?php }else{ ?>
                    <li>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['slide']->value->slideImage;?>
" />
                        <?php if ((isset($_smarty_tpl->tpl_vars['slide']->value->html)&&$_smarty_tpl->tpl_vars['slide']->value->html!='')){?>
                            <div class="flex-caption <?php echo $_smarty_tpl->tpl_vars['slide']->value->html_position;?>
">
                                <div class="flex-caption-html-content">
                                    <?php echo $_smarty_tpl->tpl_vars['slide']->value->html;?>

                                </div>
                            </div>
                        <?php }?>
                    </li>
                    
                 <?php }?>   
                    
                    
                    
                    
                    
                    
                    
                    
                    

                <?php } ?>

            </ul>
        </div>
    </div>

    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_effect'=>$_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_effect']),$_smarty_tpl);?>

    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_autoscrolldelay'=>$_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_autoscrolldelay']),$_smarty_tpl);?>

    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_autoscrollspeed'=>$_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_autoscrollspeed']),$_smarty_tpl);?>


    <?php if (($_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_directionalnav'])){?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_directionalnav'=>true),$_smarty_tpl);?>

    <?php }else{ ?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_directionalnav'=>false),$_smarty_tpl);?>

    <?php }?>

    <?php if (($_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_controlnav'])){?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_controlnav'=>true),$_smarty_tpl);?>

    <?php }else{ ?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_controlnav'=>false),$_smarty_tpl);?>

    <?php }?>

    <?php if (($_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_autoscroll'])){?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_autoscroll'=>true),$_smarty_tpl);?>

    <?php }else{ ?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_autoscroll'=>false),$_smarty_tpl);?>

    <?php }?>

    <?php if (($_smarty_tpl->tpl_vars['wpimageslider']->value['wpis_pauseonhover'])){?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_pauseonhover'=>true),$_smarty_tpl);?>

    <?php }else{ ?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('wpis_pauseonhover'=>false),$_smarty_tpl);?>

    <?php }?>

<?php }?><?php }} ?>