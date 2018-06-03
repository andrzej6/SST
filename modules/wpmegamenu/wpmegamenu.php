<?php

/* Withinpixels - Megamenu - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'wpmegamenu/model/wpMegamenuModel.php');
include_once(_PS_MODULE_DIR_ . 'wpmegamenu/model/wpMegamenuItemsModel.php');

class WPMegamenu extends Module
{
    private $_output = '';

    function __construct()
    {
        $this->name = 'wpmegamenu';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('WithinPixels - Megamenu');
        $this->description = $this->l('Megamenu');
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
               && $this->registerHook('displayHeaderMenu')
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
               && $this->unregisterHook('displayHeaderMenu')
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
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpmegamenu` (
                `id_wpmegamenu` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `active` tinyint(1) unsigned NOT NULL,
                `position` tinyint(3) unsigned NOT NULL,
                `open_in_new` tinyint(1) NOT NULL,
                `icon_class` varchar(255) NOT NULL,
                `menu_class` varchar(255) NOT NULL,
                PRIMARY KEY (`id_wpmegamenu`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpmegamenu_lang` (
                `id_wpmegamenu` int(10) unsigned NOT NULL,
                `id_lang` int(10) unsigned NOT NULL,
                `title` varchar(255) NOT NULL,
                `description` varchar(255) NOT NULL,
                `link` varchar(255) NOT NULL,
                PRIMARY KEY (`id_wpmegamenu`,`id_lang`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpmegamenu_shop` (
                `id_wpmegamenu` int(10) unsigned NOT NULL,
                `id_shop` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wpmegamenu`,`id_shop`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpmegamenuitems` (
                `id_wpmegamenuitems` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_wpmegamenu` int(10) unsigned NULL,
                `active` tinyint(1) unsigned NOT NULL,
                `nleft` int(10) unsigned NOT NULL,
                `nright` int(10) unsigned NOT NULL,
                `depth` int(10) unsigned NOT NULL,
                `icon_class` varchar(255) NOT NULL,
                `menu_type` tinyint(3) unsigned NOT NULL,
                `menu_class` varchar(255) NOT NULL,
                `menu_layout` varchar(255) NOT NULL,
                `menu_image` varchar(255) NOT NULL,
                `open_in_new` tinyint(1) NOT NULL,
                `show_image` tinyint(1) NOT NULL,
                PRIMARY KEY (`id_wpmegamenuitems`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpmegamenuitems_lang` (
                `id_wpmegamenuitems` int(10) unsigned NOT NULL,
                `id_lang` int(10) unsigned NOT NULL,
                `title` varchar(255) NOT NULL,
                `description` varchar(255) NOT NULL,
                `link` varchar(255) NOT NULL,
                `content` text NOT NULL,
                PRIMARY KEY (`id_wpmegamenuitems`,`id_lang`)
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
                DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wpmegamenu`, `' . _DB_PREFIX_ . 'wpmegamenu_lang`, `' . _DB_PREFIX_ . 'wpmegamenu_shop`, `' . _DB_PREFIX_ . 'wpmegamenuitems`, `' . _DB_PREFIX_ . 'wpmegamenuitems_lang`;
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
        $tab->class_name = "AdminWPMegamenu";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Megamenu";
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
        $id_tab = Tab::getIdFromClassName('AdminWPMegamenu');
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
            INSERT IGNORE INTO '._DB_PREFIX_.'wpmegamenu_shop (id_wpmegamenu, id_shop)
            SELECT id_wpmegamenu, '.(int)$params['new_id_shop'].'
            FROM '._DB_PREFIX_.'wpmegamenu_shop
            WHERE id_shop = '.(int)$params['old_id_shop']
        );
    }


    /* ------------------------------------------------------------- */
    /*
    /*  FRONT OFFICE RELATED STUFF
    /*
    /* ------------------------------------------------------------- */

    /*
     * MENU TYPES
     *
     * id : description
     * --   -----------
     *  1 : Custom link
     *  2 : Category link
     *  3 : Product link
     *  4 : Manufacturer link
     *  5 : Supplier link
     *  6 : CMS page link
     *  7 : Custom content
     *  8 : Divider
     *
     */

    /* ------------------------------------------------------------- */
    /*  RENDER MEGAMENU
    /* ------------------------------------------------------------- */
    private function renderMenu()
    {
        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;

        $roots = WPMegamenuModel::getMenus($id_shop);

        $menuTypes = array(
            'customlink' => 1,
            'category' => 2,
            'product' => 3,
            'manufacturer' => 4,
            'supplier' => 5,
            'cmspage' => 6,
            'customcontent' => 7,
            'divider' => 8,
        );

        $wpmegamenu = array();

        // Get Root Items
        foreach ($roots as $root)
        {
            $wpmegamenu['root'][$root['id_wpmegamenu']] = new WPMegamenuModel($root['id_wpmegamenu'], $id_lang);
        }

        // Get Menu Items
        foreach ($roots as $root)
        {
            $items = WPMegamenuItemsModel::getMenuItems($root['id_wpmegamenu']);

            if (!$items){
                continue;
            }

            // Iterate through all items and prepare them
            foreach ($items as $item)
            {
                $wpMegamenuItem = new WPMegamenuItemsModel($item['id_wpmegamenuitems'], $id_lang);

                $menuTitle = "";
                $menuLink = "";

                switch ($wpMegamenuItem->menu_type)
                {
                    case 1:
                        // Custom Link
                        $menuLink = $wpMegamenuItem->link;
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);
                        break;

                    case 2:
                        // Category Link
                        $category = new Category($wpMegamenuItem->link, $id_lang);
                        $menuTitle = $category->name;
                        $menuLink = $this->context->link->getCategoryLink($category, null, $id_lang);
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);
                        break;

                    case 3:
                        // Product Link
                        $product = new Product($wpMegamenuItem->link, false, $id_lang);
                        $menuTitle = $product->name;
                        $menuLink = $this->context->link->getProductLink($product, null, $id_lang);
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);

                        if ($wpMegamenuItem->show_image){
                            $coverImage = $product->getCover($product->id);
                            $wpMegamenuItem->image = $this->context->link->getImageLink($product->link_rewrite, $coverImage['id_image'], 'atmn_normal');
                        }
                        break;

                    case 4:
                        // Manufacturer Link
                        $manufacturer = new Manufacturer($wpMegamenuItem->link, $id_lang);
                        $menuTitle = $manufacturer->name;
                        $menuLink = $this->context->link->getManufacturerLink($manufacturer, null, $id_lang);
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);

                        if ($wpMegamenuItem->show_image){
                            $wpMegamenuItem->image = _PS_BASE_URL_ . _THEME_MANU_DIR_.$manufacturer->id_manufacturer.'-atmn_medium.jpg';
                        }
                        break;

                    case 5:
                        // Supplier Link
                        $supplier = new Supplier($wpMegamenuItem->link, $id_lang);
                        $menuTitle = $supplier->name;
                        $menuLink = $this->context->link->getSupplierLink($supplier, null, $id_lang);
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);

                        if ($wpMegamenuItem->show_image){
                            $wpMegamenuItem->image = _PS_BASE_URL_ . _THEME_SUP_DIR_.$supplier->id_supplier.'-atmn_medium.jpg';
                        }
                        break;

                    case 6:
                        // CMS Page Link
                        $cmsPage = new CMS($wpMegamenuItem->link, $id_lang);
                        $menuTitle = $cmsPage->meta_title;
                        $menuLink = $this->context->link->getCMSLink($cmsPage, null, null, $id_lang);
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);
                        break;

                    case 7:
                        // Custom Content
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);
                        break;

                    case 8:
                        // Divider
                        $menuType = array_search($wpMegamenuItem->menu_type, $menuTypes);
                        break;

                    default:
                        break;
                }

                if ($menuTitle != ''){
                    $wpMegamenuItem->title = $menuTitle;
                }

                if ($menuLink != ''){
                    $wpMegamenuItem->link = $menuLink;
                }

                $wpMegamenuItem->menu_type_name = $menuType;

                $wpmegamenu['root'][$root['id_wpmegamenu']]->items[] = $wpMegamenuItem;
            }

        }

        return $wpmegamenu;
    }

    /* ------------------------------------------------------------- */
    /*  PREPARE FOR HOOK
    /* ------------------------------------------------------------- */
    private function _prepHook($params)
    {
        $wpmegamenu = $this->renderMenu();
        if ($wpmegamenu){
            $this->smarty->assign('wpmegamenu', $wpmegamenu['root']);
        }

        if (isset($params['wpmegamenumobile']) && $params['wpmegamenumobile'] == true){
            $this->smarty->assign('wpmegamenumobile', true);
        }
    }

    /* ------------------------------------------------------------- */
    /*  HOOK (displayHeader)
    /* ------------------------------------------------------------- */
    public function hookDisplayHeader($params)
    {
        $this->context->controller->addCSS($this->_path . 'views/css/hook/wpmegamenu.css');

        $this->context->controller->addJqueryPlugin('wpmegamenu', $this->_path . 'views/js/hook/');
    }

    /* ------------------------------------------------------------- */
    /*  HOOK (displayTop)
    /* ------------------------------------------------------------- */
    public function hookDisplayHeaderMenu($params)
    {
        $this->_prepHook($params);
        return $this->display(__FILE__, 'views/templates/hook/wpmegamenu.tpl');
    }

}