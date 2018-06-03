<?php

/* Withinpixels - Social Links - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'wpsociallinks/model/wpSocialLinksModel.php');

class WPSocialLinks extends Module
{
    function __construct()
    {
        $this->name = 'wpsociallinks';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('WithinPixels - Social Links');
        $this->description = $this->l('Social links on footer');
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
               && $this->registerHook('displayHeader')
               && $this->registerHook('displayFooterSocialLinks')
               && $this->registerHook('actionShopDataDuplication')
               && $this->_createTables()
               && $this->_installDemoData()
               && $this->_createTab();
    }

    /* ------------------------------------------------------------- */
    /*  UNINSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function uninstall()
    {
        return parent::uninstall()
               && $this->unregisterHook('displayHeader')
               && $this->unregisterHook('displayFooterSocialLinks')
               && $this->unregisterHook('actionShopDataDuplication')
               && $this->_deleteTables()
               && $this->_deleteTab();
    }

    /* ------------------------------------------------------------- */
    /*  CREATE THE TABLES
    /* ------------------------------------------------------------- */
    private function _createTables()
    {
        $response = (bool) Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpsociallinks` (
                `id_wpsociallinks` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `active` tinyint(1) unsigned NOT NULL,
                `position` int(5) unsigned NOT NULL,
                `icon` varchar(255) NOT NULL,
                `custom_icon` varchar(255) NOT NULL,
                `link` text NOT NULL,
                `open_in_new` tinyint(1) unsigned NOT NULL,
                PRIMARY KEY (`id_wpsociallinks`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpsociallinks_shop` (
                `id_wpsociallinks` int(10) unsigned NOT NULL,
                `id_shop` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wpsociallinks`,`id_shop`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE THE TABLES
    /* ------------------------------------------------------------- */
    private function _deleteTables()
    {
        return Db::getInstance()->execute('
                DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wpsociallinks`, `' . _DB_PREFIX_ . 'wpsociallinks_shop`;
        ');
    }

    /* ------------------------------------------------------------- */
    /*  CREATE CONFIGS
    /* ------------------------------------------------------------- */
    private function _createConfigs()
    {
        return true;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    private function _deleteConfigs()
    {
        return true;
    }

    /* ------------------------------------------------------------- */
    /*  INSTALL DEMO DATA
    /* ------------------------------------------------------------- */
    private function _installDemoData()
    {
        // Facebook
        $wpSocialLinks = new WPSocialLinksModel();
        $wpSocialLinks->link = 'www.facebook.com/withinpixels';
        $wpSocialLinks->icon = 'facebook';
        $wpSocialLinks->open_in_new = 1;
        $wpSocialLinks->add();

        // Twitter
        $wpSocialLinks = new WPSocialLinksModel();
        $wpSocialLinks->link = 'www.twitter.com/sercan';
        $wpSocialLinks->icon = 'twitter';
        $wpSocialLinks->open_in_new = 1;
        $wpSocialLinks->add();

        return true;
    }

    /* ------------------------------------------------------------- */
    /*  CREATE THE TAB MENU
    /* ------------------------------------------------------------- */
    private function _createTab()
    {
        $response = true;

        // First check for parent tab
        $parentTabID = Tab::getIdFromClassName('AdminWP');

        if ($parentTabID) {
            $parentTab = new Tab($parentTabID);
        } else {
            $parentTab = new Tab();
            $parentTab->active = 1;
            $parentTab->name = array();
            $parentTab->class_name = "AdminWP";
            foreach (Language::getLanguages() as $lang){
                $parentTab->name[$lang['id_lang']] = "WithinPixels";
            }
            $parentTab->id_parent = 0;
            $parentTab->module = $this->name;
            $response &= $parentTab->add();
        }

        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = "AdminWPSocialLinks";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Social Links";
        }
        $tab->id_parent = $parentTab->id;
        $tab->module = $this->name;
        $response &= $tab->add();

        return $response;
    }


    /* ------------------------------------------------------------- */
    /*  DELETE THE TAB MENU
    /* ------------------------------------------------------------- */
    private function _deleteTab()
    {
        $id_tab = Tab::getIdFromClassName('AdminWPSocialLinks');
        $parentTabID = Tab::getIdFromClassName('AdminWP');

        $tab = new Tab($id_tab);
        $tab->delete();

        // Get the number of tabs inside our parent tab
        // If there is no tabs, remove the parent
        $tabCount = Tab::getNbTabs($parentTabID);
        if ($tabCount == 0){
            $parentTab = new Tab($parentTabID);
            $parentTab->delete();
        }

        return true;
    }


    /* ------------------------------------------------------------- */
    /*  HOOK THE MODULE INTO SHOP DATA DUPLICATION ACTION
    /* ------------------------------------------------------------- */
    public function hookActionShopDataDuplication($params)
    {
        Db::getInstance()->execute('
            INSERT IGNORE INTO '._DB_PREFIX_.'wpsociallinks_shop (id_wpsociallinks, id_shop)
            SELECT id_wpsociallinks, '.(int)$params['new_id_shop'].'
            FROM '._DB_PREFIX_.'wpsociallinks_shop
            WHERE id_shop = '.(int)$params['old_id_shop']
        );
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

        $wpSocialLinks = new WPSocialLinksModel();
        $linkIds = $wpSocialLinks->getLinkIds($id_shop);

        $iconPath = _PS_BASE_URL_ . _MODULE_DIR_ . $this->name . '/views/img/front/customIcons/';
        $links = array();

        foreach ($linkIds as $key => $linkId){
            $wpSocialLinks = new WPSocialLinksModel($linkId['id_wpsociallinks']);

            $links[$linkId['id_wpsociallinks']]['link'] = $wpSocialLinks->link;
            $links[$linkId['id_wpsociallinks']]['icon'] = $wpSocialLinks->icon;
            $links[$linkId['id_wpsociallinks']]['custom_icon'] = $wpSocialLinks->custom_icon;
            $links[$linkId['id_wpsociallinks']]['open_in_new'] = $wpSocialLinks->open_in_new;

        }

        $wpsociallinks = array(
            'links' => $links,
            'iconPath' => $iconPath
        );

        $this->smarty->assign('wpsociallinks', $wpsociallinks);
    }


    /* ------------------------------------------------------------- */
    /*  HOOK (displayHeader)
    /* ------------------------------------------------------------- */
    public function hookDisplayHeader($params)
    {
        $this->context->controller->addCSS($this->_path . 'views/css/hook/wpsociallinks.css');
    }

    /* ------------------------------------------------------------- */
    /*  HOOK (displayFooterSocialLinks)
    /* ------------------------------------------------------------- */
    public function hookDisplayFooterSocialLinks($params)
    {
        $this->_prepHook($params);

        return $this->display(__FILE__, 'wpsociallinks.tpl');
    }

}