<?php



class OureventsController extends FrontController {



public $php_self = 'ourevents';





public function setMedia()

	{
		parent::setMedia();
		
		$this->addJS(_PS_JS_DIR_.'hiddenemail.js');
	}




public function init() {

    parent::init();
	
	
	
	
	

}





public function initContent() {

    parent::initContent();
	
	
	

    $this->setTemplate(_PS_THEME_DIR_.'ourevents.tpl');

    

   
    

   

}




}

