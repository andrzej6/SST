<?php



class FreetrialController extends FrontController {



public $php_self = 'freetrial';







public function setMedia()

	{
		parent::setMedia();
	}




public function init() {

    parent::init();

}





public function initContent() {

    parent::initContent();
    $this->setTemplate(_PS_THEME_DIR_.'freetrial.tpl');

  
}



}

