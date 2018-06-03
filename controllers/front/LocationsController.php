<?php
class LocationsController extends FrontController {
public $php_self = 'locations';public $display_column_left = false;public $display_column_right = false;

public function setMedia()
	{
		parent::setMedia();				$this->addCSS(_THEME_CSS_DIR_.'locations.css');        $this->addJS(_THEME_JS_DIR_.'locations.js');
	}

public function init() {
    parent::init();	$this->display_column_left = false;
}

public function initContent() {
    parent::initContent();		
    $this->setTemplate(_PS_THEME_DIR_.'locations.tpl');
}

}

