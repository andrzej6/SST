<?php
class MatbenefitsController extends FrontController {
public $php_self = 'matbenefits';
public function setMedia()
	{
		parent::setMedia();
	}

public function init() {
    parent::init();
}

public function initContent() {
    parent::initContent();
    $this->setTemplate(_PS_THEME_DIR_.'mat-benefits.tpl');
}

}
