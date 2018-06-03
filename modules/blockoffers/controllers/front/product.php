<?php

class blockoffersProductModuleFrontController extends ModuleFrontController
{



public function setMedia()
	{
		parent::setMedia();
        $this->addCSS(_THEME_CSS_DIR_.'special-final.css');
		$this->addJS(_PS_MODULE_DIR_.'blockoffers/js/specials.js');
		
	}
	
	
	
    public function init(){
            parent::init();
            $this->page_name='Special Offers';

    }
	
	
	
    public function initContent() {

    parent::initContent();


        $id_shop = $this->context->shop->id;
        $blockoffers = new blockOffersModel();
        $products = $blockoffers->getSlideIds($id_shop);


        $this->context->smarty->assign('special_prod', $products);
        //$this->context->smarty->assign('special_prod', 'var');
        $this->context->smarty->assign(array('meta_title' => 'Sit-Stand.Com® | Special Offers'));

        $template_name  = 'specials.tpl';
        $this->setTemplate($template_name );
    }






 }