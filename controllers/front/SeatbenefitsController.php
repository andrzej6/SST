<?php
class SeatbenefitsController extends FrontController {
public $php_self = 'seatbenefits';
public function setMedia()
	{
		parent::setMedia();
	}

public function init() {
    parent::init();
}

public function initContent() {
    parent::initContent();
    $this->setTemplate(_PS_THEME_DIR_.'seat-benefits.tpl');
}

}
