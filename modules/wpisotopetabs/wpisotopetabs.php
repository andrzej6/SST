<?php/* Withinpixels - Frontpage Isotope Tabs - 2014 - Sercan YEMEN - twitter.com/sercan */if (!defined('_PS_VERSION_'))    exit;include_once(_PS_MODULE_DIR_ . 'wpisotopetabs/model/wpIsotopeTabsModel.php');class WPIsotopeTabs extends Module{    private $_output = '';    function __construct()    {        $this->name = 'wpisotopetabs';        $this->tab = 'front_office_features';        $this->version = '1.0';        $this->author = 'Sercan YEMEN';        $this->need_instance = 0;        $this->bootstrap = true;        parent::__construct();        $this->displayName = $this->l('WithinPixels - Isotope Tabs');        $this->description = $this->l('Frontpage product tabs (Isotope)');    }    /* ------------------------------------------------------------- */    /*  INSTALL THE MODULE    /* ------------------------------------------------------------- */    public function install()    {        if (Shop::isFeatureActive()){            Shop::setContext(Shop::CONTEXT_ALL);        }        return parent::install()               && $this->registerHook('displayHome')               && $this->registerHook('actionShopDataDuplication')               && $this->_createTables()               && $this->_createConfigs()               && $this->_installDemoData()               && $this->_createTab();    }    /* ------------------------------------------------------------- */    /*  UNINSTALL THE MODULE    /* ------------------------------------------------------------- */    public function uninstall()    {        return parent::uninstall()               && $this->unregisterHook('displayHome')               && $this->unregisterHook('actionShopDataDuplication')               && $this->_deleteTables()               && $this->_deleteConfigs()               && $this->_deleteTab();    }    /* ------------------------------------------------------------- */    /*  CREATE THE TABLES    /* ------------------------------------------------------------- */    private function _createTables()    {        $response = (bool) Db::getInstance()->execute('            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpisotopetabs` (                `id_wpisotopetabs` int(10) unsigned NOT NULL AUTO_INCREMENT,                `active` tinyint(1) unsigned NOT NULL,                `position` int(5) unsigned NOT NULL,                `tab_type` varchar(255) NOT NULL,                `tab_content` text NOT NULL,                PRIMARY KEY (`id_wpisotopetabs`)            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;        ');        $response &= Db::getInstance()->execute('            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpisotopetabs_lang` (                `id_wpisotopetabs` int(10) unsigned NOT NULL,                `id_lang` int(10) unsigned NOT NULL,                `title` varchar(255) NOT NULL,                PRIMARY KEY (`id_wpisotopetabs`,`id_lang`)            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;        ');        $response &= Db::getInstance()->execute('            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpisotopetabs_shop` (                `id_wpisotopetabs` int(10) unsigned NOT NULL,                `id_shop` int(10) unsigned NOT NULL,                PRIMARY KEY (`id_wpisotopetabs`,`id_shop`)            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;        ');        return $response;    }    /* ------------------------------------------------------------- */    /*  DELETE THE TABLES    /* ------------------------------------------------------------- */    private function _deleteTables()    {        return Db::getInstance()->execute('                DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wpisotopetabs`, `' . _DB_PREFIX_ . 'wpisotopetabs_lang`, `' . _DB_PREFIX_ . 'wpisotopetabs_shop`;        ');    }    /* ------------------------------------------------------------- */    /*  CREATE CONFIGS    /* ------------------------------------------------------------- */    private function _createConfigs()    {        $response = Configuration::updateValue('WPISOTOPETABS_PRICES', 1);        $response &= Configuration::updateValue('WPISOTOPETABS_CARTBUTTONS', 1);        $response &= Configuration::updateValue('WPISOTOPETABS_MAXPRDCTS', 20);        $response &= Configuration::updateValue('WPISOTOPETABS_DISABLESHOWALL', 0);        return $response;    }    /* ------------------------------------------------------------- */    /*  DELETE CONFIGS    /* ------------------------------------------------------------- */    private function _deleteConfigs()    {        $response = Configuration::deleteByName('WPISOTOPETABS_PRICES');        $response &= Configuration::deleteByName('WPISOTOPETABS_CARTBUTTONS');        $response &= Configuration::deleteByName('WPISOTOPETABS_MAXPRDCTS');        $response &= Configuration::deleteByName('WPISOTOPETABS_DISABLESHOWALL');        return $response;    }    /* ------------------------------------------------------------- */    /*  INSTALL DEMO DATA    /* ------------------------------------------------------------- */    private function _installDemoData()    {        $languages = $this->context->language->getLanguages(true);        // Featured Products tab        $wpIsotopeTabs = new WPIsotopeTabsModel();        foreach ($languages as $language){            $wpIsotopeTabs->title[$language['id_lang']] = 'Featured Products';        }        $wpIsotopeTabs->tab_type = 'featured';        $wpIsotopeTabs->add();        // New Products tab        $wpIsotopeTabs = new WPIsotopeTabsModel();        foreach ($languages as $language){            $wpIsotopeTabs->title[$language['id_lang']] = 'New Products';        }        $wpIsotopeTabs->tab_type = 'new';        $wpIsotopeTabs->add();        // Special Products tab        $wpIsotopeTabs = new WPIsotopeTabsModel();        foreach ($languages as $language){            $wpIsotopeTabs->title[$language['id_lang']] = 'Special Products';        }        $wpIsotopeTabs->tab_type = 'special';        $wpIsotopeTabs->add();        return true;    }    /* ------------------------------------------------------------- */    /*  CREATE THE TAB MENU    /* ------------------------------------------------------------- */    private function _createTab()    {        $response = true;        // First check for parent tab        $parentTabID = Tab::getIdFromClassName('AdminWP');        if ($parentTabID) {            $parentTab = new Tab($parentTabID);        } else {            $parentTab = new Tab();            $parentTab->active = 1;            $parentTab->name = array();            $parentTab->class_name = "AdminWP";            foreach (Language::getLanguages() as $lang){                $parentTab->name[$lang['id_lang']] = "WithinPixels";            }            $parentTab->id_parent = 0;            $parentTab->module = $this->name;            $response &= $parentTab->add();        }        $tab = new Tab();        $tab->active = 1;        $tab->class_name = "AdminWPIsotopeTabs";        $tab->name = array();        foreach (Language::getLanguages() as $lang){            $tab->name[$lang['id_lang']] = "Isotope Tabs";        }        $tab->id_parent = $parentTab->id;        $tab->module = $this->name;        $response &= $tab->add();        return $response;    }    /* ------------------------------------------------------------- */    /*  DELETE THE TAB MENU    /* ------------------------------------------------------------- */    private function _deleteTab()    {        $id_tab = Tab::getIdFromClassName('AdminWPIsotopeTabs');        $parentTabID = Tab::getIdFromClassName('AdminWP');        $tab = new Tab($id_tab);        $tab->delete();        // Get the number of tabs inside our parent tab        // If there is no tabs, remove the parent        $tabCount = Tab::getNbTabs($parentTabID);        if ($tabCount == 0){            $parentTab = new Tab($parentTabID);            $parentTab->delete();        }        return true;    }    /* ------------------------------------------------------------- */    /*  GET CONTENT    /* ------------------------------------------------------------- */    public function getContent()    {           $errors = array();        if (Tools::isSubmit('submit'.$this->name)){            if (Tools::isSubmit('wpisotopetabs_prices')){                Configuration::updateValue('WPISOTOPETABS_PRICES', Tools::getValue('wpisotopetabs_prices'));            }            if (Tools::isSubmit('wpisotopetabs_cartbuttons')){                Configuration::updateValue('WPISOTOPETABS_CARTBUTTONS', Tools::getValue('wpisotopetabs_cartbuttons'));            }            // Validate numeric values            if (Tools::isSubmit('wpisotopetabs_maxprdcts')){                if (Validate::isInt(Tools::getValue('wpisotopetabs_maxprdcts'))){                    Configuration::updateValue('WPISOTOPETABS_MAXPRDCTS', Tools::getValue('wpisotopetabs_maxprdcts'));                } else {                    $errors[] = $this->l('Max product count per tab must be a numeric value!');                }            }            if (Tools::isSubmit('wpisotopetabs_disableshowall')){                Configuration::updateValue('WPISOTOPETABS_DISABLESHOWALL', Tools::getValue('wpisotopetabs_disableshowall'));            }            // Prepare the output            if (count($errors)){                $this->_output .= $this->displayError(implode('<br />', $errors));            } else {                $this->_output .= $this->displayConfirmation($this->l('Configuration updated'));            }        }        return $this->_output.$this->displayForm();    }    /* ------------------------------------------------------------- */    /*  DISPLAY CONFIGURATION FORM    /* ------------------------------------------------------------- */    public function displayForm()    {        // Get default Language        $id_default_lang = (int) Configuration::get('PS_LANG_DEFAULT');        $fields_form = array(            'wpisotopetabs-general' => array(                'form' => array(                    'legend' => array(                        'title' => $this->l('Isotope Tabs Options'),                        'icon' => 'icon-cogs'                    ),                    'input' => array(                        array(                            'type' => 'switch',                            'label' => $this->l('Show prices'),                            'name' => 'wpisotopetabs_prices',                            'required' => false,                            'is_bool' => true,                            'values' => array(                                array(                                    'id' => 'prices_on',                                    'value' => 1,                                    'label' => $this->l('Show')                                ),                                array(                                    'id' => 'prices_off',                                    'value' => 0,                                    'label' => $this->l('Hide')                                )                            )                        ),                        array(                            'type' => 'switch',                            'label' => $this->l('Show "Add to Cart" buttons'),                            'name' => 'wpisotopetabs_cartbuttons',                            'required' => false,                            'is_bool' => true,                            'values' => array(                                array(                                    'id' => 'cartbutton_on',                                    'value' => 1,                                    'label' => $this->l('Show')                                ),                                array(                                    'id' => 'cartbutton_off',                                    'value' => 0,                                    'label' => $this->l('Hide')                                )                            )                        ),                        array(                            'type' => 'switch',                            'label' => $this->l('Show "Show All" tab'),                            'name' => 'wpisotopetabs_disableshowall',                            'required' => false,                            'is_bool' => true,                            'values' => array(                                array(                                    'id' => 'showall_on',                                    'value' => 1,                                    'label' => $this->l('Show')                                ),                                array(                                    'id' => 'showall_off',                                    'value' => 0,                                    'label' => $this->l('Hide')                                )                            )                        ),                        array(                            'type' => 'text',                            'name' => 'wpisotopetabs_maxprdcts',                            'label' => $this->l('Max. product count per tab'),                            'required' => true,                            'lang' => false,                            'suffix' => $this->l('products per tab')                        )                    ),                    // Submit Button                    'submit' => array(                        'title' => $this->l('Save'),                        'name' => 'saveIsotopeTabsOptions'                    )                )            )        );        $helper = new HelperForm();        $helper->module = $this;        $helper->name_controller = $this->name;        $helper->token = Tools::getAdminTokenLite('AdminModules');        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;        $helper->default_form_language = $id_default_lang;        $helper->allow_employee_form_lang = $id_default_lang;        $helper->title = $this->displayName;        $helper->show_toolbar = true;        $helper->toolbar_scroll = true;        $helper->submit_action = 'submit'.$this->name;        $helper->toolbar_btn = array(            'editTabs' => array(                'desc' => $this->l('Edit Tabs'),                'href' => $this->context->link->getAdminLink('AdminWPIsotopeTabs'),                'imgclass' => 'edit'            )        );        // Load current values        $helper->fields_value['wpisotopetabs_prices'] = Configuration::get('WPISOTOPETABS_PRICES');        $helper->fields_value['wpisotopetabs_cartbuttons'] = Configuration::get('WPISOTOPETABS_CARTBUTTONS');        $helper->fields_value['wpisotopetabs_maxprdcts'] = Configuration::get('WPISOTOPETABS_MAXPRDCTS');        $helper->fields_value['wpisotopetabs_disableshowall'] = Configuration::get('WPISOTOPETABS_DISABLESHOWALL');        return $helper->generateForm($fields_form);    }    /* ------------------------------------------------------------- */    /*  HOOK THE MODULE INTO SHOP DATA DUPLICATION ACTION    /* ------------------------------------------------------------- */    public function hookActionShopDataDuplication($params)    {        Db::getInstance()->execute('            INSERT IGNORE INTO '._DB_PREFIX_.'wpisotopetabs_shop (id_wpisotopetabs, id_shop)            SELECT id_wpisotopetabs, '.(int)$params['new_id_shop'].'            FROM '._DB_PREFIX_.'wpisotopetabs_shop            WHERE id_shop = '.(int)$params['old_id_shop']        );    }    /* ------------------------------------------------------------- */    /*    /*  FRONT OFFICE RELATED STUFF    /*    /* ------------------------------------------------------------- */    /* ------------------------------------------------------------- */    /*  GET TABS LIST    /* ------------------------------------------------------------- */    private function _getTabsList($id_shop, $id_lang)    {        $wpIsotopeTabs = new WPIsotopeTabsModel();        $tabIds = $wpIsotopeTabs->getTabIds($id_shop);        $response = array();        if (Configuration::get('WPISOTOPETABS_DISABLESHOWALL')){            $response[] = array(                'title'  => $this->l('Show All'),                'filter' => '*'            );        }        foreach ($tabIds as $key => $tabId)        {            $wpIsotopeTabs = new WPIsotopeTabsModel($tabId['id_wpisotopetabs'], $id_lang);            $response[] = array(                'title'  => $wpIsotopeTabs->title,                'filter' => strtolower(str_replace(' ', '-', $wpIsotopeTabs->title))            );        }        if ($response){            return $response;        } else {            return NULL;        }    }    /* ------------------------------------------------------------- */    /*  GET TAB CONTENT    /* ------------------------------------------------------------- */    private function _getTabContent($id_wpisotopetabs)    {        $id_default_lang = $this->context->language->id;        $wpIsotopeTabs = new WPIsotopeTabsModel($id_wpisotopetabs, $id_default_lang);        if (Validate::isLoadedObject($wpIsotopeTabs))        {            $type = strtolower(str_replace(' ', '-', $wpIsotopeTabs->title));            $maxProductCount = Configuration::get('WPISOTOPETABS_MAXPRDCTS');            $products = array();            switch ($wpIsotopeTabs->tab_type)            {                case 'featured':                    $category = new Category($this->context->shop->getCategory(), $id_default_lang);                    $products = $category->getProducts($id_default_lang, 1, $maxProductCount);                    break;                 case 'new':                    $products = Product::getNewProducts($id_default_lang, 0, $maxProductCount);                    break;                case 'special':                    $products = Product::getPricesDrop($id_default_lang, 0, $maxProductCount);                    break;                case 'category':                    $category = new Category($wpIsotopeTabs->tab_content, $id_default_lang);                    $products = $category->getProductstabs($id_default_lang, 1, $maxProductCount, 'price', 'ASC');                    break;                case 'custom':                    $productIDs = explode(",", $wpIsotopeTabs->tab_content);                    $i = 1;                    foreach ($productIDs as $id_product){                        if ($i <= $maxProductCount) {                            $products[] = (array) new Product($id_product);                            $i++;                        }                    }                    break;            }            if ($products){                return $this->_prepareProducts($products, $type);            } else {                return false;            }        }        return false;    }    /* ------------------------------------------------------------- */    /*  PREPARE PRODUCT    /* ------------------------------------------------------------- */    private function _prepareProducts($products, $type)    {        $id_default_lang = $this->context->language->id;        $tabProducts = array();        foreach ($products as $product_nonObj){            if (isset($product_nonObj['id_product'])){                $product_nonObj_id = $product_nonObj['id_product'];            } else {                $product_nonObj_id = $product_nonObj['id'];            }            $product = new Product($product_nonObj_id, true, $id_default_lang);            if ($product->active){                // Basic Info                $tabProducts[$product->id]['id'] = $product->id;                $tabProducts[$product->id]['type'] = $type;                $tabProducts[$product->id]['name'] = $product->name;                $tabProducts[$product->id]['link'] = $product->getlink();                // Image                $cover_image = $product->getCover($product->id);                $tabProducts[$product->id]['image'] = $this->context->link->getImageLink($product->link_rewrite, $cover_image['id_image'], "atmn_normal");                //Price                if (Configuration::get('PS_CATALOG_MODE') == 0 && $product->show_price == 1 && Configuration::get('WPISOTOPETABS_PRICES') == TRUE)                {                    $tabProducts[$product->id]['price'] = $product->convertAndFormatPrice($product->getPrice(0));                }                else                {                    $tabProducts[$product->id]['price'] = FALSE;                }                //Reductions                if ($product->specificPrice && Configuration::get('PS_CATALOG_MODE') == 0 && $product->show_price == 1 && Configuration::get('WPISOTOPETABS_PRICES') == TRUE)                {                    $reduction_type = $product->specificPrice['reduction_type'];                    if ($reduction_type == "percentage")                    {                        $tabProducts[$product->id]['reduction'] = $product->specificPrice['reduction'] * 100 . "%";                    }                    else                    {                        $tabProducts[$product->id]['reduction'] = $product->convertAndFormatPrice($product->specificPrice['reduction']);                    }                }                else                {                    $tabProducts[$product->id]['reduction'] = FALSE;                }                if ($product->getPriceWithoutReduct() != $product->getPrice())                {                    $p_price = $product->getPrice();                    $p_priceReduct = $product->getPrice(true, null, 6, null, true);                                        // $tabProducts[$product->id]['price_without_reduction'] = $product->convertAndFormatPrice($p_price + $p_priceReduct);                    $tabProducts[$product->id]['price_without_reduction'] = Product::getPriceStatic($product->id, false, null, 2, null, false, false);                }                else                {                    $tabProducts[$product->id]['price_without_reduction'] = FALSE;                }                //Tags                //defaults                $tabProducts[$product->id]['new'] = FALSE;                $tabProducts[$product->id]['on_sale'] = FALSE;                $tabProducts[$product->id]['discount'] = FALSE;                if (Configuration::get('PS_CATALOG_MODE') == 0 && $product->show_price == 1)                {                    if (isset($product->new) && $product->new == 1)                    {                        $tabProducts[$product->id]['new'] = TRUE;                    }                    if (isset($product->on_sale) && $product->on_sale == 1)                    {                        $tabProducts[$product->id]['on_sale'] = TRUE;                    }                    elseif ($product->specificPrice && $product->specificPrice['reduction_type'])                    {                        $tabProducts[$product->id]['discount'] = TRUE;                    }                }                //Add to Cart button related info                if (isset($product_nonObj['id_product_attribute'])){                    $tabProducts[$product->id]['id_product_attribute'] = (int)$product_nonObj['id_product_attribute'];                }else{                    $tabProducts[$product->id]['id_product_attribute'] = 0;                }                $tabProducts[$product->id]['available_for_order'] = (int)$product->available_for_order;                $tabProducts[$product->id]['minimal_quantity'] = (int)$product->minimal_quantity;                $tabProducts[$product->id]['customizable'] = (int)$product->customizable;                $allow_oosp = $product->isAvailableWhenOutOfStock((int)$product->out_of_stock);                $tabProducts[$product->id]['allow_oosp'] = $allow_oosp;                $tabProducts[$product->id]['quantity'] = (int)$product->quantity;            }        }        if (isset($tabProducts)) {            return $tabProducts;        } else {            return false;        }    }    /* ------------------------------------------------------------- */    /*  PREPARE FOR HOOK    /* ------------------------------------------------------------- */    private function _prepHook($params)    {        $id_shop = $this->context->shop->id;        $id_default_lang = $this->context->language->id;        $wpIsotopeTabs = new WPIsotopeTabsModel();        $tabIds = $wpIsotopeTabs->getTabIds($id_shop);        $tab_contents = array();        $products = array();        foreach ($tabIds as $key => $tabId){            $tab_contents[$tabId['id_wpisotopetabs']] = $this->_getTabContent($tabId['id_wpisotopetabs']);        }        foreach ($tab_contents as $key => $productsArray){            if ($productsArray){                foreach ($productsArray as $productID => $product){                    if (array_key_exists($productID, $products)){                        $products[$productID]['type'] .= ' ' . $product['type'];                    } else {                        $products[$productID] = $product;                    }                }            }        }        $wpisotopetabs = array(            'filters' => $this->_getTabsList($id_shop, $id_default_lang),            'products' => $products,            'showPrice' => Configuration::get('WPISOTOPETABS_PRICES'),            'showCartBtn' => Configuration::get('WPISOTOPETABS_CARTBUTTONS')        );        $this->smarty->assign('wpisotopetabs', $wpisotopetabs);    }    /* ------------------------------------------------------------- */    /*  HOOK (displayHeader)    /* ------------------------------------------------------------- */    public function hookDisplayHome($params)    {        $this->_prepHook($params);        $this->context->controller->addCSS($this->_path . 'views/css/hook/wpisotopetabs.css');        $this->context->controller->addCSS($this->_path . 'views/css/hook/isotope.css');        $this->context->controller->addJqueryPlugin('wpisotopetabs', $this->_path . 'views/js/hook/');        $this->context->controller->addJqueryPlugin('isotope.pkgd.min', $this->_path . 'views/js/hook/');        return $this->display(__FILE__, 'wpisotopetabs.tpl');    }}