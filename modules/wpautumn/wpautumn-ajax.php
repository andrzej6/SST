<?php

/*-------------------------------------------------------------*/
/*  WPAutumn Theme Ajax Requests Handler
/*-------------------------------------------------------------*/

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('wpautumn.php');

$context = Context::getContext();
$WPAutumn = new WPAutumn();

$action = Tools::getValue('action');

switch ($action) {
    case 'loadImageSources':
         /* Quick Image Viewer on Product Thumbnails */
        $pid = Tools::getValue('pid');
        $linkRewrite = Tools::getValue('linkRewrite');
        $id_lang = $context->language->id;
        $output = '';

        $product = new Product($pid, true, $id_lang);
        $productImages = $product->getImages($context->language->id);
        $productLink = $product->getLink();

        foreach ($productImages as $productImage)
        {
            if ($productImage['cover'] == 0) {
                $output .= '<a class="item-image-link img-wrapper" href="'.$productLink.'">';
                $output .= '<img class="lazyOwl" data-src="';
                $output .= $context->link->getImageLink($linkRewrite, $pid.'-'.$productImage['id_image'], 'atmn_normal');
                $output .= '" /></a>';
            }
        }

        die(Tools::jsonEncode($output));
        break;

    case 'changeProductListViewType':
        $viewType = Tools::getValue('viewType');
        $context->cookie->category_view_type = $viewType;
        $context->cookie->write();
        die(Tools::jsonEncode($context->cookie->category_view_type));

    default:
        break;
}