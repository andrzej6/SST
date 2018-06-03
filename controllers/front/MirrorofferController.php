<?php



class MirrorofferController extends FrontController {



public $php_self = 'mirroroffer';


public function postProcess()
	{
	}




public function setMedia()

	{
		parent::setMedia();
		$this->addCSS(_THEME_CSS_DIR_.'mirror.css');
		
		
		
	}




public function init() {

    parent::init();
	
	
	
	
	

}





public function initContent() {

    parent::initContent();
	

    $this->setTemplate(_PS_THEME_DIR_.'mirroroffer.tpl');

    

   
    

   

}




}

