<?php


class SampleformController extends FrontController {
public $php_self = 'sampleform';

public function setMedia()
	{
		parent::setMedia();
	}


public function init() {
    
    parent::init();
}


public function initContent() {
    parent::initContent();
	
	$this->setTemplate(_PS_THEME_DIR_.'sampleform.tpl');

}


}
