<?php
class LocationsController extends FrontController {
public $php_self = 'locations';

public function setMedia()
	{
		parent::setMedia();
	}

public function init() {
    parent::init();
}

public function initContent() {
    parent::initContent();
    $this->setTemplate(_PS_THEME_DIR_.'locations.tpl');
}

}
