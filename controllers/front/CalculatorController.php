<?php

class CalculatorController extends FrontController {

public $php_self = 'calculator';



public function setMedia()
	{
		parent::setMedia();

		
		
		$this->addJS(_THEME_JS_DIR_.'/helperfiles/calculator.js');
		$this->addCSS(_THEME_JS_DIR_.'/helperfiles/calculator.css');
	}












public function init() {
    parent::init();
}


public function initContent() {
    parent::initContent();

    $this->setTemplate(_PS_THEME_DIR_.'calculator.tpl');
    
    
    if (Tools::getIsset('price'))
    
    {
    $this->context->smarty->assign(array(
				
				'myfield' => (int)Tools::getValue('price',null)
			));
    
      }
      
      else 
     {
        $this->context->smarty->assign(array(
				
				'myfield' => 400
			));
        
     }
   
    
    
}




}