<?php

class adfreetrialProductModuleFrontController extends ModuleFrontController
{



public function setMedia()
	{
		parent::setMedia();
		$this->addCSS(_THEME_CSS_DIR_.'special-final.css');
		$this->addJS(_PS_MODULE_DIR_.'adfreetrial/js/freetrial.js');
		
	}
	
	
	
    public function init(){
            parent::init();
            $this->page_name='Free Trial';

    }
	
	
	
    public function initContent() {

    parent::initContent();

	
	//$productIDs = array(120, 123, 124, 24, 93, 95, 155, 156, 113, 77, 134, 145, 160, 25, 164, 162);
	$tab_content = unserialize(Configuration::get('AD_PRODUCTLIST'));
    $tab_content_ex = explode(',', $tab_content);

    foreach ($tab_content_ex as $id_product){
            $products[] = (array) new Product($id_product);
    }

    $trialprod = $this->_prepareProducts($products);
    $this->context->smarty->assign('trialprod', $trialprod);
    $this->context->smarty->assign(array('meta_title' => 'Sit-Stand.Com® | Free Trials'));

        $template_name  = 'freetrial.tpl';
        $this->setTemplate($template_name );
    }



    private function _prepareProducts($products)
    {
        $id_default_lang = $this->context->language->id;
        $tabProducts = array();

        foreach ($products as $product_nonObj){

            if (isset($product_nonObj['id_product'])){
                $product_nonObj_id = $product_nonObj['id_product'];
            } else {
                $product_nonObj_id = $product_nonObj['id'];
            }
            $product = new Product($product_nonObj_id, true, $id_default_lang);

                // Basic Info
                $tabProducts[$product->id]['id'] = $product->id;
                $tabProducts[$product->id]['name'] = $product->name;
                $tabProducts[$product->id]['link'] = $product->getlink();

                // Image
                $cover_image = $product->getCover($product->id);
                $tabProducts[$product->id]['image'] = $this->context->link->getImageLink($product->link_rewrite, $cover_image['id_image'], "atmn_normal");


        }
        return $tabProducts;
    }


 }