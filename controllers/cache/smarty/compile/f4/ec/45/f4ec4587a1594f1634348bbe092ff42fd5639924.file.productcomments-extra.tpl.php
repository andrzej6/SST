<?php /* Smarty version Smarty-3.1.14, created on 2014-12-25 21:21:20
         compiled from "/home/gbs2/public_html/prestashop/themes/autumn/modules/productcomments/productcomments-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1588322655549c78245c2759-51492305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4ec4587a1594f1634348bbe092ff42fd5639924' => 
    array (
      0 => '/home/gbs2/public_html/prestashop/themes/autumn/modules/productcomments/productcomments-extra.tpl',
      1 => 1419541765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1588322655549c78245c2759-51492305',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549c782461fcc9_75017210',
  'variables' => 
  array (
    'content_only' => 0,
    'nbComments' => 0,
    'too_early' => 0,
    'is_logged' => 0,
    'allow_guests' => 0,
    'averageTotal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549c782461fcc9_75017210')) {function content_549c782461fcc9_75017210($_smarty_tpl) {?> 
<?php if ((!$_smarty_tpl->tpl_vars['content_only']->value&&(($_smarty_tpl->tpl_vars['nbComments']->value==0&&$_smarty_tpl->tpl_vars['too_early']->value==false&&($_smarty_tpl->tpl_vars['is_logged']->value||$_smarty_tpl->tpl_vars['allow_guests']->value))||($_smarty_tpl->tpl_vars['nbComments']->value!=0)))){?>
    <div id="product_comments_block_extra" class="iconed-text" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">

        <span class="wpicon wpicon-bubble-dots medium"></span>

        
        <?php if ($_smarty_tpl->tpl_vars['nbComments']->value!=0){?>
            <meta itemprop="worstRating" content = "0" />
            <meta itemprop="ratingValue" content="<?php echo $_smarty_tpl->tpl_vars['averageTotal']->value;?>
" />
            <meta itemprop="bestRating" content = "5" />
            <meta itemprop="reviewCount" content="<?php echo $_smarty_tpl->tpl_vars['nbComments']->value;?>
" />
        <?php }?>
        

        <?php if ($_smarty_tpl->tpl_vars['nbComments']->value!=0){?>
            <div class="comments_note">
                <div class="star_content">
                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['name'] = "i";
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total']);
?>
                        <?php if ($_smarty_tpl->tpl_vars['averageTotal']->value<=$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']){?>
                            <div class="star wpicon wpicon-star medium"></div>
                        <?php }else{ ?>
                            <div class="star star_on wpicon wpicon-star2 medium"></div>
                        <?php }?>
                    <?php endfor; endif; ?>
                </div>
                <div class="reviews">
                    <a href="#idTab5"><?php echo $_smarty_tpl->tpl_vars['nbComments']->value;?>
 <?php echo smartyTranslate(array('s'=>'review(s)','mod'=>'productcomments'),$_smarty_tpl);?>
</a>
                </div>
            </div>
        <?php }?>

        <div class="comments_advices">
            <?php if (($_smarty_tpl->tpl_vars['too_early']->value==false&&($_smarty_tpl->tpl_vars['is_logged']->value||$_smarty_tpl->tpl_vars['allow_guests']->value))){?>
                <a class="open-comment-form" href="#new_comment_form">
                    <?php echo smartyTranslate(array('s'=>'Write a review','mod'=>'productcomments'),$_smarty_tpl);?>

                </a>
            <?php }?>
        </div>
    </div>
<?php }?>
<?php }} ?>