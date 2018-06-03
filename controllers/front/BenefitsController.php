<?php



class BenefitsController extends FrontController {
public $php_self = 'benefits';

public function setMedia()
	{
		parent::setMedia();
		$this->addCSS(_THEME_CSS_DIR_.'benefits.css');
	}

public function init() {
    parent::init();
}

public function initContent() {
    parent::initContent();
    $this->setTemplate(_PS_THEME_DIR_.'benefits.tpl');
}

}

