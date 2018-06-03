<?php

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'blockoffers/model/blockOffersModel.php');

class BlockOffers extends Module
{
    private $_output = '';

    function __construct()
    {
        $this->name = 'blockoffers';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Andrzej Dlugosz';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Block for Special Offers');
        $this->description = $this->l('Special Offer Page');
    }

    /* ------------------------------------------------------------- */
    /*  INSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function install()
    {
        if (Shop::isFeatureActive()){
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return parent::install()
               && $this->_createTable()
               && $this->_createTab()
               && $this->registerHook('moduleRoutes');
    }

    /* ------------------------------------------------------------- */
    /*  UNINSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function uninstall()
    {
        return parent::uninstall()
               && $this->_deleteTable()
               && $this->_deleteTab();
    }


    public function hookModuleRoutes($params) {

        $my_link = array(
            'blockoffers' => array(
                'controller' => 'product',
                'rule' => 'specials',
                'keywords' => array(),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockoffers',
                ),
            ),

        );
        return $my_link;
    }



    /* ------------------------------------------------------------- */
    /*  CREATE THE TABLES
    /* ------------------------------------------------------------- */
    private function _createTable()
    {
        $response = (bool) Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'blockoffers` (
                `id_blockoffers` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `active` tinyint(1) unsigned NOT NULL,
                `position` int(5) unsigned NOT NULL,
				`toptext` text NOT NULL,
				`toplink` text NOT NULL,
				`simage` varchar(255) NOT NULL,
				`bottomtext` text NOT NULL,
				`buttontext` text NOT NULL,
				`buttonlink` text NOT NULL,

                PRIMARY KEY (`id_blockoffers`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE THE TABLES
    /* ------------------------------------------------------------- */
    private function _deleteTable()
    {
        return Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'blockoffers`');
    }





    /* ------------------------------------------------------------- */
    /*  CREATE THE TAB MENU
    /* ------------------------------------------------------------- */
    private function _createTab()
    {
        $response = true;

        $parentTab = new Tab();
        $parentTab->active = 1;


        foreach (Language::getLanguages() as $lang){
            $parentTab->name[$lang['id_lang']] = "Special Offers";
        }


        $parentTab->class_name = "AdminBlockOffer";

        $parentTab->id_parent = 0;
        $parentTab->module = $this->name;
        $response &= $parentTab->add();

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE THE TAB MENU
    /* ------------------------------------------------------------- */
    private function _deleteTab()
    {
        $id_tab = Tab::getIdFromClassName('AdminBlockOffer');
        $tab = new Tab($id_tab);
        $tab->delete();

        return true;
    }


    /* ------------------------------------------------------------- */
    /*
    /*  FRONT OFFICE RELATED STUFF
    /*
    /* ------------------------------------------------------------- */

    /* ------------------------------------------------------------- */
    /*  PREPARE FOR HOOK
    /* ------------------------------------------------------------- */

    private function _prepHook($params)
    {
        $id_shop = $this->context->shop->id;
        $id_default_lang = $this->context->language->id;

        $wpImageSlider = new WPImageSliderModel();
        $slideIds = $wpImageSlider->getSlideIds($id_shop);

        $slides = array();

        foreach ($slideIds as $key => $slideId){
            $slides[$slideId['id_wpimageslider']] = new WPImageSliderModel($slideId['id_wpimageslider'], $id_default_lang);
        }

        if (empty($slides)){
            $slides = false;
        }

        if ($slides){
            foreach ($slides as $slide){
                $slide->slideImage = _PS_BASE_URL_SSL_ . _MODULE_DIR_ . $this->name . '/views/img/' . $slide->slideImage;
				//$slide->slideImage = _PS_BASE_URL_ . _MODULE_DIR_ . $this->name . '/views/img/' . $slide->slideImage;
            }
        }

        $response = array(
            'slides' => $slides,
            'wpis_width' => Configuration::get('WPIMAGESLIDER_WIDTH'),
            'wpis_effect' => Configuration::get('WPIMAGESLIDER_EFFECT'),
            'wpis_directionalnav' => Configuration::get('WPIMAGESLIDER_DIRECTIONALNAV'),
            'wpis_controlnav' => Configuration::get('WPIMAGESLIDER_CONTROLNAV'),
            'wpis_autoscroll' => Configuration::get('WPIMAGESLIDER_AUTOSCROLL'),
            'wpis_pauseonhover' => Configuration::get('WPIMAGESLIDER_PAUSEONHOVER'),
            'wpis_autoscrolldelay' => Configuration::get('WPIMAGESLIDER_AUTOSCROLLDELAY'),
            'wpis_autoscrollspeed' => Configuration::get('WPIMAGESLIDER_AUTOSCROLLSPEED')
        );

        $this->smarty->assign('wpimageslider', $response);
    }





}