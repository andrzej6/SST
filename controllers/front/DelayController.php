<?php


class DelayController extends FrontController {

    public $php_self = 'delay';



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

        $this->setTemplate(_PS_THEME_DIR_.'delay.tpl');

    }



}



