<?php

class CustomersController extends FrontController {
public $php_self = 'customers';

public function setMedia()
	{
		parent::setMedia();
	}

public function init() {
    parent::init();
}

public function initContent() {
    parent::initContent();
    $this->setTemplate(_PS_THEME_DIR_.'our_customers.tpl');
}

}

