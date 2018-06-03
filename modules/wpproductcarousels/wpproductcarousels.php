<?php

/* Withinpixels - Frontpage Product Carousels - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'wpproductcarousels/model/wpProductCarouselsModel.php');

class WPProductCarousels extends Module
{
    private $_output = '';

    function __construct()
    {
        $this->name = 'wpproductcarousels';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('WithinPixels - Product Carousels');
        $this->description = $this->l('Product carousels on frontpage');
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
               && $this->registerHook('displayHome')
               && $this->registerHook('actionShopDataDuplication')
               && $this->_createTables()
               && $this->_createConfigs()
               && $this->_installDemoData()
               && $this->_createTab();
    }

    /* ------------------------------------------------------------- */
    /*  UNINSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function uninstall()
    {
        return parent::uninstall()
               && $this->unregisterHook('displayHome')
               && $this->unregisterHook('actionShopDataDuplication')
               && $this->_deleteTables()
               && $this->_deleteConfigs()
               && $this->_deleteTab();
    }

    /* ------------------------------------------------------------- */
    /*  CREATE THE TABLES
    /* ------------------------------------------------------------- */
    private function _createTables()
    {
        $response = (bool) Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpproductcarousels` (
                `id_wpproductcarousels` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `active` tinyint(1) unsigned NOT NULL,
                `position` int(5) unsigned NOT NULL,
                `carousel_type` varchar(255) NOT NULL,
                `carousel_content` text NOT NULL,
                PRIMARY KEY (`id_wpproductcarousels`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpproductcarousels_lang` (
                `id_wpproductcarousels` int(10) unsigned NOT NULL,
                `id_lang` int(10) unsigned NOT NULL,
                `title` varchar(255) NOT NULL,
                PRIMARY KEY (`id_wpproductcarousels`,`id_lang`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpproductcarousels_shop` (
                `id_wpproductcarousels` int(10) unsigned NOT NULL,
                `id_shop` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wpproductcarousels`,`id_shop`)
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
                DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wpproductcarousels`, `' . _DB_PREFIX_ . 'wpproductcarousels_lang`, `' . _DB_PREFIX_ . 'wpproductcarousels_shop`;
        ');
    }

    /* ------------------------------------------------------------- */
    /*  CREATE CONFIGS
    /* ------------------------------------------------------------- */
    private function _createConfigs()
    {
        $response = Configuration::updateValue('WPPRDCAROUSELS_PRICES', 1);
        $response &= Configuration::updateValue('WPPRDCAROUSELS_CARTBUTTONS', 1);
        $response &= Configuration::updateValue('WPPRDCAROUSELS_MAXPRDCTS', 12);
        $response &= Configuration::updateValue('WPPRDCAROUSELS_AUTOSCROLL', 1);
        $response &= Configuration::updateValue('WPPRDCAROUSELS_AUTOSCROLLDELAY', 7000);
        $response &= Configuration::updateValue('WPPRDCAROUSELS_PAUSEONHOVER', 1);

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    private function _deleteConfigs()
    {
        $response = Configuration::deleteByName('WPPRDCAROUSELS_PRICES');
        $response &= Configuration::deleteByName('WPPRDCAROUSELS_CARTBUTTONS');
        $response &= Configuration::deleteByName('WPPRDCAROUSELS_MAXPRDCTS');
        $response &= Configuration::deleteByName('WPPRDCAROUSELS_AUTOSCROLL');
        $response &= Configuration::deleteByName('WPPRDCAROUSELS_AUTOSCROLLDELAY');
        $response &= Configuration::deleteByName('WPPRDCAROUSELS_PAUSEONHOVER');

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  INSTALL DEMO DATA
    /* ------------------------------------------------------------- */
    private function _installDemoData()
    {
        $languages = $this->context->language->getLanguages(true);

        // Featured Products tab
        $wpProductCarousels = new WPProductCarouselsModel();
        foreach ($languages as $language){
            $wpProductCarousels->title[$language['id_lang']] = 'Featured Products';
        }
        $wpProductCarousels->carousel_type = 'featured';
        $wpProductCarousels->add();

        // New Products tab
        $wpProductCarousels = new WPProductCarouselsModel();
        foreach ($languages as $language){
            $wpProductCarousels->title[$language['id_lang']] = 'New Products';
        }
        $wpProductCarousels->carousel_type = 'new';
        $wpProductCarousels->add();

        // Special Products tab
        $wpProductCarousels = new WPProductCarouselsModel();
        foreach ($languages as $language){
            $wpProductCarousels->title[$language['id_lang']] = 'Special Products';
        }
        $wpProductCarousels->carousel_type = 'special';
        $wpProductCarousels->add();

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
        $tab->class_name = "AdminWPProductCarousels";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Product Carousels";
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
        $id_tab = Tab::getIdFromClassName('AdminWPProductCarousels');
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
    /*  GET CONTENT
    /* ------------------------------------------------------------- */
    public function getContent()
    {   
        $errors = array();

        if (Tools::isSubmit('submit'.$this->name)){

            if (Tools::isSubmit('wpproductcarousels_show_prices')){
                Configuration::updateValue('WPPRDCAROUSELS_PRICES', Tools::getValue('wpproductcarousels_show_prices'));
            }

            if (Tools::isSubmit('wpproductcarousels_show_cart_buttons')){
                Configuration::updateValue('WPPRDCAROUSELS_CARTBUTTONS', Tools::getValue('wpproductcarousels_show_cart_buttons'));
            }

            // Validate numeric value
            if (Tools::isSubmit('wpproductcarousels_max_products')){
                if (Validate::isInt(Tools::getValue('wpproductcarousels_max_products'))){
                    Configuration::updateValue('WPPRDCAROUSELS_MAXPRDCTS', Tools::getValue('wpproductcarousels_max_products'));
                } else {
                    $errors[] = $this->l('Max product count per carousel must be a numeric value!');
                }
            }

            if (Tools::isSubmit('wpproductcarousels_autoscroll')){
                Configuration::updateValue('WPPRDCAROUSELS_AUTOSCROLL', Tools::getValue('wpproductcarousels_autoscroll'));
            }

            // Validate numeric value
            if (Tools::isSubmit('wpproductcarousels_autoscrolldelay')){
                if (Validate::isInt(Tools::getValue('wpproductcarousels_autoscrolldelay'))){
                    Configuration::updateValue('WPPRDCAROUSELS_AUTOSCROLLDELAY', Tools::getValue('wpproductcarousels_autoscrolldelay'));
                } else {
                    $errors[] = $this->l('Scroll delay must be a numeric value!');
                }
            }

            if (Tools::isSubmit('wpproductcarousels_pauseonhover')){
                Configuration::updateValue('WPPRDCAROUSELS_PAUSEONHOVER', Tools::getValue('wpproductcarousels_pauseonhover'));
            }

            // Prepare the output
            if (count($errors)){
                $this->_output .= $this->displayError(implode('<br />', $errors));
            } else {
                $this->_output .= $this->displayConfirmation($this->l('Configuration updated'));
            }

        }

        return $this->_output.$this->displayForm();
    }

    /* ------------------------------------------------------------- */
    /*  DISPLAY CONFIGURATION FORM
    /* ------------------------------------------------------------- */
    public function displayForm()
    {
        // Get default Language
        $id_default_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        $fields_form = array(
            'wpproductcarousels-general' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Product Carousels Options'),
                        'icon' => 'icon-cogs'
                    ),
                    'input' => array(
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show prices'),
                            'name' => 'wpproductcarousels_show_prices',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'prices_on',
                                    'value' => 1,
                                    'label' => $this->l('Show')
                                ),
                                array(
                                    'id' => 'prices_off',
                                    'value' => 0,
                                    'label' => $this->l('Hide')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show "Add to Cart" buttons'),
                            'name' => 'wpproductcarousels_show_cart_buttons',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'cart_button_on',
                                    'value' => 1,
                                    'label' => $this->l('Show')
                                ),
                                array(
                                    'id' => 'cart_button_off',
                                    'value' => 0,
                                    'label' => $this->l('Hide')
                                )
                            )
                        ),
                        array(
                            'type' => 'text',
                            'name' => 'wpproductcarousels_max_products',
                            'label' => $this->l('Max. product count per carousel'),
                            'required' => true,
                            'lang' => false,
                            'suffix' => $this->l('products per carousel')
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Auto scroll'),
                            'desc' => $this->l('Scroll the carousels automatically'),
                            'name' => 'wpproductcarousels_autoscroll',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'autoscroll_on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'autoscroll_off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                )
                            )
                        ),
                        array(
                            'type' => 'text',
                            'name' => 'wpproductcarousels_autoscrolldelay',
                            'label' => $this->l('Auto scroll delay'),
                            'desc' => $this->l('Delay between the auto scrolls'),
                            'suffix' => 'milliseconds',
                            'required' => false,
                            'lang' => false,
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Pause on hover'),
                            'desc' => $this->l('Pause the carousel on mouse hover'),
                            'name' => 'wpproductcarousels_pauseonhover',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'pauseonhover_on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'pauseonhover_off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                )
                            )
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveProductCarouselsOptions'
                    )
                )
            )
        );

        $helper = new HelperForm();

        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        $helper->default_form_language = $id_default_lang;
        $helper->allow_employee_form_lang = $id_default_lang;

        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'editTabs' => array(
                'desc' => $this->l('Edit Carousels'),
                'href' => $this->context->link->getAdminLink('AdminWPProductCarousels'),
                'imgclass' => 'edit'
            )
        );

        // Load current values
        $helper->fields_value['wpproductcarousels_show_prices'] = Configuration::get('WPPRDCAROUSELS_PRICES');
        $helper->fields_value['wpproductcarousels_show_cart_buttons'] = Configuration::get('WPPRDCAROUSELS_CARTBUTTONS');
        $helper->fields_value['wpproductcarousels_max_products'] = Configuration::get('WPPRDCAROUSELS_MAXPRDCTS');
        $helper->fields_value['wpproductcarousels_autoscroll'] = Configuration::get('WPPRDCAROUSELS_AUTOSCROLL');
        $helper->fields_value['wpproductcarousels_autoscrolldelay'] = Configuration::get('WPPRDCAROUSELS_AUTOSCROLLDELAY');
        $helper->fields_value['wpproductcarousels_pauseonhover'] = Configuration::get('WPPRDCAROUSELS_PAUSEONHOVER');

        return $helper->generateForm($fields_form);

    }

    /* ------------------------------------------------------------- */
    /*  HOOK THE MODULE INTO SHOP DATA DUPLICATION ACTION
    /* ------------------------------------------------------------- */
    public function hookActionShopDataDuplication($params)
    {
        Db::getInstance()->execute('
            INSERT IGNORE INTO '._DB_PREFIX_.'wpproductcarousels_shop (id_wpproductcarousels, id_shop)
            SELECT id_wpproductcarousels, '.(int)$params['new_id_shop'].'
            FROM '._DB_PREFIX_.'wpproductcarousels_shop
            WHERE id_shop = '.(int)$params['old_id_shop']
        );
    }


    /* ------------------------------------------------------------- */
    /*
    /*  FRONT OFFICE RELATED STUFF
    /*
    /* ------------------------------------------------------------- */

    /* ------------------------------------------------------------- */
    /*  GET CAROUSEL CONTENT
    /* ------------------------------------------------------------- */
    private function _getCarouselContent($id_wpproductcarousels)
    {
        $id_default_lang = $this->context->language->id;
        $wpProductCarousels = new WPProductCarouselsModel($id_wpproductcarousels, $id_default_lang);

        if (Validate::isLoadedObject($wpProductCarousels))
        {
            $type = strtolower(str_replace(' ', '-', $wpProductCarousels->title));
            $maxProductCount = Configuration::get('WPPRDCAROUSELS_MAXPRDCTS');
            $products = array();

            switch ($wpProductCarousels->carousel_type)
            {
                case 'featured':
                    $category = new Category($this->context->shop->getCategory(), $id_default_lang);
                    $products = $category->getProducts($id_default_lang, 1, $maxProductCount);
                    break;

                case 'new':
                    $products = Product::getNewProducts($id_default_lang, 0, $maxProductCount);
                    break;

                case 'special':
                    $products = Product::getPricesDrop($id_default_lang, 0, $maxProductCount);
                    break;

                case 'category':
                    $category = new Category($wpProductCarousels->carousel_content, $id_default_lang);
                    $products = $category->getProducts($id_default_lang, 1, $maxProductCount);
                    break;

                case 'custom':
                    $productIDs = explode(",", $wpProductCarousels->carousel_content);
                    $i = 1;
                    foreach ($productIDs as $id_product){
                        if ($i <= $maxProductCount) {
                            $products[] = (array) new Product($id_product);
                            $i++;
                        }
                    }
                    break;
            }

            if ($products){
                return $this->_prepareProducts($products, $type);
            } else {
                return false;
            }
        }

        return false;
    }

    /* ------------------------------------------------------------- */
    /*  PREPARE PRODUCT
    /* ------------------------------------------------------------- */

    private function _prepareProducts($products, $type)
    {
        $id_default_lang = $this->context->language->id;
        $carouselProducts = array();

        foreach ($products as $product_nonObj){
            if (isset($product_nonObj['id_product'])){
                $product_nonObj_id = $product_nonObj['id_product'];
            } else {
                $product_nonObj_id = $product_nonObj['id'];
            }

            $product = new Product($product_nonObj_id, true, $id_default_lang);

            if ($product->active){
                // Basic Info
                $carouselProducts[$product->id]['id'] = $product->id;
                $carouselProducts[$product->id]['type'] = $type;
                $carouselProducts[$product->id]['name'] = $product->name;
                $carouselProducts[$product->id]['link'] = $product->getlink();

                // Image
                $cover_image = $product->getCover($product->id);
                $carouselProducts[$product->id]['image'] = $this->context->link->getImageLink($product->link_rewrite, $cover_image['id_image'], "atmn_normal");

                //Price
                if (Configuration::get('PS_CATALOG_MODE') == 0 && $product->show_price == 1 && Configuration::get('WPISOTOPETABS_PRICES') == TRUE)
                {
                    $carouselProducts[$product->id]['price'] = $product->convertAndFormatPrice($product->getPrice());
                }
                else
                {
                    $carouselProducts[$product->id]['price'] = FALSE;
                }

                //Reductions
                if ($product->specificPrice && Configuration::get('PS_CATALOG_MODE') == 0 && $product->show_price == 1 && Configuration::get('WPISOTOPETABS_PRICES') == TRUE)
                {
                    $reduction_type = $product->specificPrice['reduction_type'];
                    if ($reduction_type == "percentage")
                    {
                        $carouselProducts[$product->id]['reduction'] = $product->specificPrice['reduction'] * 100 . "%";
                    }
                    else
                    {
                        $carouselProducts[$product->id]['reduction'] = $product->convertAndFormatPrice($product->specificPrice['reduction']);
                    }
                }
                else
                {
                    $carouselProducts[$product->id]['reduction'] = FALSE;
                }

                if ($product->getPriceWithoutReduct() != $product->getPrice())
                {
                    $p_price = $product->getPrice();
                    $p_priceReduct = $product->getPrice(true, null, 6, null, true);
                    $carouselProducts[$product->id]['price_without_reduction'] = $product->convertAndFormatPrice($p_price + $p_priceReduct);
                }
                else
                {
                    $carouselProducts[$product->id]['price_without_reduction'] = FALSE;
                }

                //Tags
                //defaults
                $carouselProducts[$product->id]['new'] = FALSE;
                $carouselProducts[$product->id]['on_sale'] = FALSE;
                $carouselProducts[$product->id]['discount'] = FALSE;

                if (Configuration::get('PS_CATALOG_MODE') == 0 && $product->show_price == 1)
                {
                    if (isset($product->new) && $product->new == 1)
                    {
                        $carouselProducts[$product->id]['new'] = TRUE;
                    }

                    if (isset($product->on_sale) && $product->on_sale == 1)
                    {
                        $carouselProducts[$product->id]['on_sale'] = TRUE;
                    }
                    elseif ($product->specificPrice && $product->specificPrice['reduction_type'])
                    {
                        $carouselProducts[$product->id]['discount'] = TRUE;
                    }
                }

                //Add to Cart button related info
                if (isset($product_nonObj['id_product_attribute'])){
                    $carouselProducts[$product->id]['id_product_attribute'] = (int)$product_nonObj['id_product_attribute'];
                }else{
                    $carouselProducts[$product->id]['id_product_attribute'] = 0;
                }
                $carouselProducts[$product->id]['available_for_order'] = (int)$product->available_for_order;
                $carouselProducts[$product->id]['minimal_quantity'] = (int)$product->minimal_quantity;
                $carouselProducts[$product->id]['customizable'] = (int)$product->customizable;

                $allow_oosp = $product->isAvailableWhenOutOfStock((int)$product->out_of_stock);
                $carouselProducts[$product->id]['allow_oosp'] = $allow_oosp;

                $carouselProducts[$product->id]['quantity'] = (int)$product->quantity;
            }
        }

        if (isset($carouselProducts)) {
            return $carouselProducts;
        } else {
            return false;
        }
    }



    /* ------------------------------------------------------------- */
    /*  PREPARE FOR HOOK
    /* ------------------------------------------------------------- */

    private function _prepHook($params)
    {
        $id_shop = $this->context->shop->id;
        $id_default_lang = $this->context->language->id;

        $wpProductCarousels = new WPProductCarouselsModel();
        $carouselIds = $wpProductCarousels->getCarouselIds($id_shop);

        $carousels = array();

        foreach ($carouselIds as $key => $carouselId){
            $wpProductCarousels = new WPProductCarouselsModel($carouselId['id_wpproductcarousels'], $id_default_lang);
            $carousels[$carouselId['id_wpproductcarousels']]['title'] = $wpProductCarousels->title;

            $carousels[$carouselId['id_wpproductcarousels']]['products'] = $this->_getCarouselContent($carouselId['id_wpproductcarousels']);
        }

        $wpproductcarousels = array(
            'carousels' => $carousels,
            'showPrice' => Configuration::get('WPPRDCAROUSELS_PRICES'),
            'showCartBtn' => Configuration::get('WPPRDCAROUSELS_CARTBUTTONS'),
            'autoScroll' => Configuration::get('WPPRDCAROUSELS_AUTOSCROLL'),
            'autoScrollDelay' => Configuration::get('WPPRDCAROUSELS_AUTOSCROLLDELAY'),
            'pauseOnHover' => Configuration::get('WPPRDCAROUSELS_PAUSEONHOVER'),
        );

        if ($carousels){
            $this->context->controller->addJqueryPlugin('wpproductcarousels', $this->_path . 'views/js/hook/');
        }

        $this->smarty->assign('wpproductcarousels', $wpproductcarousels);
    }


    /* ------------------------------------------------------------- */
    /*  HOOK (displayHeader)
    /* ------------------------------------------------------------- */
    public function hookDisplayHome($params)
    {
        $this->_prepHook($params);

        $this->context->controller->addCSS($this->_path . 'views/css/hook/wpproductcarousels.css');

        return $this->display(__FILE__, 'wpproductcarousels.tpl');
    }

}