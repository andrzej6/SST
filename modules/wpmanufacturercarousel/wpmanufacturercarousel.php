<?php

/* Withinpixels - Frontpage Manufacturer Carousel - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

class WPManufacturerCarousel extends Module
{
    private $_output = '';

    function __construct()
    {
        $this->name = 'wpmanufacturercarousel';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('WithinPixels - Manufacturer Carousel');
        $this->description = $this->l('Frontpage manufacturer carousel');
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
               && $this->_createConfigs()
               && $this->_createTab();
    }

    /* ------------------------------------------------------------- */
    /*  UNINSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function uninstall()
    {
        return parent::uninstall()
               &&  $this->unregisterHook('displayHome')
               &&  $this->_deleteConfigs()
               &&  $this->_deleteTab();
    }

    /* ------------------------------------------------------------- */
    /*  CREATE THE TABLES
    /* ------------------------------------------------------------- */
    private function _createTables()
    {
        return true;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE THE TABLES
    /* ------------------------------------------------------------- */
    private function _deleteTables()
    {
        return true;
    }

    /* ------------------------------------------------------------- */
    /*  CREATE CONFIGS
    /* ------------------------------------------------------------- */
    private function _createConfigs()
    {
        $languages = $this->context->language->getLanguages();

        foreach ($languages as $language){
            $title[$language['id_lang']] = 'Manufacturers';
        }
        $response = Configuration::updateValue('WPMANCAR_TITLE', $title);

        $response &= Configuration::updateValue('WPMANCAR_AUTOSCROLL', 1);
        $response &= Configuration::updateValue('WPMANCAR_AUTOSCROLLDELAY', 7000);
        $response &= Configuration::updateValue('WPMANCAR_PAUSEONHOVER', 1);

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    private function _deleteConfigs()
    {
        $response = Configuration::deleteByName('WPMANCAR_TITLE');
        $response &= Configuration::deleteByName('WPMANCAR_AUTOSCROLL');
        $response &= Configuration::deleteByName('WPMANCAR_AUTOSCROLLDELAY');
        $response &= Configuration::deleteByName('WPMANCAR_PAUSEONHOVER');

        return $response;
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
        $tab->class_name = "AdminWPManufacturerCarousel";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Manufacturer Carousel";
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
        $id_tab = Tab::getIdFromClassName('AdminWPManufacturerCarousel');
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
        $languages = $this->context->language->getLanguages();
        $errors = array();

        if (Tools::isSubmit('submit'.$this->name)){

            $title = array();

            foreach ($languages as $language){
                if (Tools::isSubmit('wpmanufacturercarousel_title_'.$language['id_lang'])){
                    $title[$language['id_lang']] = Tools::getValue('wpmanufacturercarousel_title_'.$language['id_lang']);
                }
            }
            if (isset($title) && $title){
                Configuration::updateValue('WPMANCAR_TITLE', $title);
            }

            if (Tools::isSubmit('wpmanufacturercarousel_autoscroll')){
                Configuration::updateValue('WPMANCAR_AUTOSCROLL', Tools::getValue('wpmanufacturercarousel_autoscroll'));
            }

            if (Tools::isSubmit('wpmanufacturercarousel_autoscrolldelay')){
                if (Validate::isInt(Tools::getValue('wpmanufacturercarousel_autoscrolldelay'))){
                    Configuration::updateValue('WPMANCAR_AUTOSCROLLDELAY', Tools::getValue('wpmanufacturercarousel_autoscrolldelay'));
                } else {
                    $errors[] = $this->l('Scroll delay must be a numeric value!');
                }
            }

            if (Tools::isSubmit('wpmanufacturercarousel_pauseonhover')){
                Configuration::updateValue('WPMANCAR_PAUSEONHOVER', Tools::getValue('wpmanufacturercarousel_pauseonhover'));
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
        $languages = $this->context->language->getLanguages();

        $fields_form = array(
            'wpmanufacturercarousel-general' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Manufacturer Carousel Options'),
                        'icon' => 'icon-cogs'
                    ),
                    'input' => array(
                        array(
                            'type' => 'text',
                            'name' => 'wpmanufacturercarousel_title',
                            'label' => $this->l('Title'),
                            'desc' => $this->l('This title will appear just before the manufacturer carousel, leave it empty to hide it completely'),
                            'required' => false,
                            'lang' => true,
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Auto scroll'),
                            'desc' => $this->l('Scroll the manufacturers automatically'),
                            'name' => 'wpmanufacturercarousel_autoscroll',
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
                            'name' => 'wpmanufacturercarousel_autoscrolldelay',
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
                            'name' => 'wpmanufacturercarousel_pauseonhover',
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
                        'name' => 'saveFrontpageBlocksOptions'
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

        foreach($languages as $language){
            $helper->languages[] = array(
                'id_lang' => $language['id_lang'],
                'iso_code' => $language['iso_code'],
                'name' => $language['name'],
                'is_default' => ($id_default_lang == $language['id_lang'] ? 1 : 0)
            );
        }

        // Load current values
        $helper->fields_value['wpmanufacturercarousel_autoscroll'] = Configuration::get('WPMANCAR_AUTOSCROLL');
        $helper->fields_value['wpmanufacturercarousel_autoscrolldelay'] = Configuration::get('WPMANCAR_AUTOSCROLLDELAY');
        $helper->fields_value['wpmanufacturercarousel_pauseonhover'] = Configuration::get('WPMANCAR_PAUSEONHOVER');

        foreach($languages as $language){
            $helper->fields_value['wpmanufacturercarousel_title'][$language['id_lang']] = Configuration::get('WPMANCAR_TITLE', $language['id_lang']);
        }

        return $helper->generateForm($fields_form);
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
        $id_default_lang = $this->context->language->id;

        $manufacturers = Manufacturer::getManufacturers(false, $id_default_lang);

        $wpmanufacturercarousel = array(
            'manufacturers' => $manufacturers,
            'mainTitle' => Configuration::get('WPMANCAR_TITLE', $id_default_lang),
            'autoScroll' => Configuration::get('WPMANCAR_AUTOSCROLL'),
            'autoScrollDelay' => Configuration::get('WPMANCAR_AUTOSCROLLDELAY'),
            'pauseOnHover' => Configuration::get('WPMANCAR_PAUSEONHOVER'),
        );

        if ($manufacturers) {
            $this->context->controller->addJqueryPlugin('wpmanufacturercarousel', $this->_path . 'views/js/hook/');
        }

        $this->smarty->assign('wpmanufacturercarousel', $wpmanufacturercarousel);
    }

    /* ------------------------------------------------------------- */
    /*  HOOK (displayHeader)
    /* ------------------------------------------------------------- */
    public function hookDisplayHome($params)
    {
        $this->_prepHook($params);

        $this->context->controller->addCSS($this->_path . 'views/css/hook/wpmanufacturercarousel.css');

        return $this->display(__FILE__, 'wpmanufacturercarousel.tpl');
    }

}