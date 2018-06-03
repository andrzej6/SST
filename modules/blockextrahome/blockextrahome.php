<?php

if (!defined('_PS_VERSION_'))
    exit;

class BlockExtrahome extends Module
{
    public function __construct()
    {
        $this->name = 'blockextrahome';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Andrzej Dlugosz';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Extra Home Section');
        $this->description = $this->l('Module for Extra Home Section');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }


    public function install()

    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);

        if (!parent::install() ||
            !$this->registerHook('displayHome')
        )
            return false;
        return true;
    }



    public function uninstall()

    {
        if (!parent::uninstall())
            return false;
        return true;
    }



    public function hookDisplayHome()
    {
        return $this->display(__FILE__, 'extrahome.tpl');
    }

}