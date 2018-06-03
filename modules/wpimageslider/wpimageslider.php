<?php

/* Withinpixels - Frontpage Image Slider - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'wpimageslider/model/wpImageSliderModel.php');

class WPImageSlider extends Module
{
    private $_output = '';

    function __construct()
    {
        $this->name = 'wpimageslider';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('WithinPixels - Image Slider');
        $this->description = $this->l('Frontpage image slider');
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
               && $this->registerHook('displayHomepageSlider')
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
               && $this->unregisterHook('displayHomepageSlider')
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
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpimageslider` (
                `id_wpimageslider` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `active` tinyint(1) unsigned NOT NULL,
                `position` int(5) unsigned NOT NULL,
                `open_in_new` tinyint(1) unsigned NOT NULL,
                `html_position` varchar(255) NOT NULL,
                PRIMARY KEY (`id_wpimageslider`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpimageslider_lang` (
                `id_wpimageslider` int(10) unsigned NOT NULL,
                `id_lang` int(10) unsigned NOT NULL,
                `html` text NOT NULL,
                `link` text NOT NULL,
                `slideImage` varchar(255) NOT NULL,
                PRIMARY KEY (`id_wpimageslider`,`id_lang`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpimageslider_shop` (
                `id_wpimageslider` int(10) unsigned NOT NULL,
                `id_shop` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wpimageslider`,`id_shop`)
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
                DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wpimageslider`, `' . _DB_PREFIX_ . 'wpimageslider_lang`, `' . _DB_PREFIX_ . 'wpimageslider_shop`;
        ');
    }

    /* ------------------------------------------------------------- */
    /*  CREATE CONFIGS
    /* ------------------------------------------------------------- */
    private function _createConfigs()
    {
        $response = Configuration::updateValue('WPIMAGESLIDER_WIDTH', 'fullwidth');
        $response &= Configuration::updateValue('WPIMAGESLIDER_EFFECT', 'fade');
        $response &= Configuration::updateValue('WPIMAGESLIDER_DIRECTIONALNAV', 1);
        $response &= Configuration::updateValue('WPIMAGESLIDER_CONTROLNAV', 1);
        $response &= Configuration::updateValue('WPIMAGESLIDER_AUTOSCROLL', 1);
        $response &= Configuration::updateValue('WPIMAGESLIDER_AUTOSCROLLDELAY', 7000);
        $response &= Configuration::updateValue('WPIMAGESLIDER_AUTOSCROLLSPEED', 600);
        $response &= Configuration::updateValue('WPIMAGESLIDER_PAUSEONHOVER', 1);

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    private function _deleteConfigs()
    {
        $response = Configuration::deleteByName('WPIMAGESLIDER_WIDTH');
        $response &= Configuration::deleteByName('WPIMAGESLIDER_EFFECT');
        $response &= Configuration::deleteByName('WPIMAGESLIDER_DIRECTIONALNAV');
        $response &= Configuration::deleteByName('WPIMAGESLIDER_CONTROLNAV');
        $response &= Configuration::deleteByName('WPIMAGESLIDER_AUTOSCROLL');
        $response &= Configuration::deleteByName('WPIMAGESLIDER_AUTOSCROLLDELAY');
        $response &= Configuration::deleteByName('WPIMAGESLIDER_AUTOSCROLLSPEED');
        $response &= Configuration::deleteByName('WPIMAGESLIDER_PAUSEONHOVER');

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  INSTALL DEMO DATA
    /* ------------------------------------------------------------- */
    private function _installDemoData()
    {
        $languages = $this->context->language->getLanguages();

        $wpImageSlider = new WPImageSliderModel();
        foreach ($languages as $language) {
            $wpImageSlider->slideImage[$language['id_lang']] = 'demoSlideImage1.jpg';
            $wpImageSlider->link[$language['id_lang']] = 'http://www.withinpixels.com';
            $wpImageSlider->open_in_new = 1;
        }
        $wpImageSlider->add();

        $wpImageSlider = new WPImageSliderModel();
        foreach ($languages as $language) {
            $wpImageSlider->slideImage[$language['id_lang']] = 'demoSlideImage2.jpg';
            $wpImageSlider->link[$language['id_lang']] = 'http://www.withinpixels.com';
            $wpImageSlider->open_in_new = 1;
        }
        $wpImageSlider->add();

        $wpImageSlider = new WPImageSliderModel();
        foreach ($languages as $language) {
            $wpImageSlider->slideImage[$language['id_lang']] = 'demoSlideImage3.jpg';
            $wpImageSlider->link[$language['id_lang']] = 'http://www.withinpixels.com';
            $wpImageSlider->open_in_new = 1;
        }
        $wpImageSlider->add();

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
        $tab->class_name = "AdminWPImageSlider";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Image Slider";
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
        $id_tab = Tab::getIdFromClassName('AdminWPImageSlider');
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

            if (Tools::isSubmit('wpimageslider_width')){
                Configuration::updateValue('WPIMAGESLIDER_WIDTH', Tools::getValue('wpimageslider_width'));
            }

            if (Tools::isSubmit('wpimageslider_effect')){
                Configuration::updateValue('WPIMAGESLIDER_EFFECT', Tools::getValue('wpimageslider_effect'));
            }

            if (Tools::isSubmit('wpimageslider_directionalnav')){
                Configuration::updateValue('WPIMAGESLIDER_DIRECTIONALNAV', Tools::getValue('wpimageslider_directionalnav'));
            }

            if (Tools::isSubmit('wpimageslider_controlnav')){
                Configuration::updateValue('WPIMAGESLIDER_CONTROLNAV', Tools::getValue('wpimageslider_controlnav'));
            }

            if (Tools::isSubmit('wpimageslider_autoscroll')){
                Configuration::updateValue('WPIMAGESLIDER_AUTOSCROLL', Tools::getValue('wpimageslider_autoscroll'));
            }

            if (Tools::isSubmit('wpimageslider_pauseonhover')){
                Configuration::updateValue('WPIMAGESLIDER_PAUSEONHOVER', Tools::getValue('wpimageslider_pauseonhover'));
            }

            if (Tools::isSubmit('wpimageslider_autoscrolldelay')){
                if (Validate::isInt(Tools::getValue('wpimageslider_autoscrolldelay'))){
                    Configuration::updateValue('WPIMAGESLIDER_AUTOSCROLLDELAY', Tools::getValue('wpimageslider_autoscrolldelay'));
                } else {
                    $errors[] = $this->l('Autoscroll delay must be a numeric value!');
                }
            }

            if (Tools::isSubmit('wpimageslider_autoscrollspeed')){
                if (Validate::isInt(Tools::getValue('wpimageslider_autoscrollspeed'))){
                    Configuration::updateValue('WPIMAGESLIDER_AUTOSCROLLSPEED', Tools::getValue('wpimageslider_autoscrollspeed'));
                } else {
                    $errors[] = $this->l('Autoscroll speed must be a numeric value!');
                }
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
        $id_default_lang = $this->context->language->id;

        $widths = array(
            array(
                'value' => 'fullwidth',
                'name' => 'Fullwidth'
            ),
            array(
                'value' => 'boxed',
                'name' => 'Boxed'
            )
        );

        $effects = array(
            array(
                'value' => 'fade',
                'name' => 'Fade'
            ),
            array(
                'value' => 'slide',
                'name' => 'Slide'
            )
        );

        $fields_form = array(
            'wpimageslider-general' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Image Slider Options'),
                        'icon' => 'icon-cogs'
                    ),
                    'input' => array(
                        array(
                            'type' => 'select',
                            'name' => 'wpimageslider_width',
                            'label' => $this->l('Slider width'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $widths,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'wpimageslider_effect',
                            'label' => $this->l('Slider transition effect'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $effects,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show directional navigation'),
                            'desc' => $this->l('Show/hide "Previous" and "Next" buttons on slider'),
                            'name' => 'wpimageslider_directionalnav',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'directional_on',
                                    'value' => 1,
                                    'label' => $this->l('Show')
                                ),
                                array(
                                    'id' => 'directional_off',
                                    'value' => 0,
                                    'label' => $this->l('Hide')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show control navigation'),
                            'desc' => $this->l('Show/hide dots under slider'),
                            'name' => 'wpimageslider_controlnav',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'control_on',
                                    'value' => 1,
                                    'label' => $this->l('Show')
                                ),
                                array(
                                    'id' => 'controll_off',
                                    'value' => 0,
                                    'label' => $this->l('Hide')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Autoscroll'),
                            'name' => 'wpimageslider_autoscroll',
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
                            'type' => 'switch',
                            'label' => $this->l('Pause on hover'),
                            'name' => 'wpimageslider_pauseonhover',
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
                        ),
                        array(
                            'type' => 'text',
                            'name' => 'wpimageslider_autoscrolldelay',
                            'label' => $this->l('Autoscroll delay'),
                            'suffix' => 'ms (milliseconds)',
                            'required' => false,
                            'lang' => false,
                        ),
                        array(
                            'type' => 'text',
                            'name' => 'wpimageslider_autoscrollspeed',
                            'label' => $this->l('Autoscroll animation speed'),
                            'suffix' => 'ms (milliseconds)',
                            'required' => false,
                            'lang' => false,
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveImageSliderOptions'
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
                'desc' => $this->l('Edit Slides'),
                'href' => $this->context->link->getAdminLink('AdminWPImageSlider'),
                'imgclass' => 'edit'
            )
        );

        // Load current values
        $helper->fields_value['wpimageslider_width'] = Configuration::get('WPIMAGESLIDER_WIDTH');
        $helper->fields_value['wpimageslider_effect'] = Configuration::get('WPIMAGESLIDER_EFFECT');
        $helper->fields_value['wpimageslider_directionalnav'] = Configuration::get('WPIMAGESLIDER_DIRECTIONALNAV');
        $helper->fields_value['wpimageslider_controlnav'] = Configuration::get('WPIMAGESLIDER_CONTROLNAV');
        $helper->fields_value['wpimageslider_autoscroll'] = Configuration::get('WPIMAGESLIDER_AUTOSCROLL');
        $helper->fields_value['wpimageslider_pauseonhover'] = Configuration::get('WPIMAGESLIDER_PAUSEONHOVER');
        $helper->fields_value['wpimageslider_autoscrolldelay'] = Configuration::get('WPIMAGESLIDER_AUTOSCROLLDELAY');
        $helper->fields_value['wpimageslider_autoscrollspeed'] = Configuration::get('WPIMAGESLIDER_AUTOSCROLLSPEED');

        return $helper->generateForm($fields_form);
    }

    /* ------------------------------------------------------------- */
    /*  HOOK THE MODULE INTO SHOP DATA DUPLICATION ACTION
    /* ------------------------------------------------------------- */
    public function hookActionShopDataDuplication($params)
    {
        Db::getInstance()->execute('
            INSERT IGNORE INTO '._DB_PREFIX_.'wpimageslider_shop (id_wpimageslider, id_shop)
            SELECT id_wpimageslider, '.(int)$params['new_id_shop'].'
            FROM '._DB_PREFIX_.'wpimageslider_shop
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

    /* ------------------------------------------------------------- */
    /*  HOOK (displayHome)
    /* ------------------------------------------------------------- */
    public function hookDisplayHome()
    {
        $this->context->controller->addJqueryPlugin('flexslider-min', $this->_path . 'views/js/hook/');
        $this->context->controller->addJqueryPlugin('wpimageslider', $this->_path . 'views/js/hook/');

        $this->context->controller->addCSS($this->_path . 'views/css/hook/flexslider.css');
        $this->context->controller->addCSS($this->_path . 'views/css/hook/wpimageslider.css');
    }

    /* ------------------------------------------------------------- */
    /*  HOOK (displayHomepageSlider)
    /* ------------------------------------------------------------- */
    public function hookDisplayHomepageSlider($params)
    {
        $this->_prepHook($params);

        return $this->display(__FILE__, 'wpimageslider.tpl');
    }

}