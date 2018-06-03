<?php

/* Withinpixels - Social Sharing Buttons for Products - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

class WPProductShare extends Module
{
    function __construct()
    {
        $this->name = 'wpproductshare';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('WithinPixels - Product Share Buttons');
        $this->description = $this->l('Social sharing buttons for products');
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
               && $this->registerHook('displayRightColumnProduct')
               && $this->_createConfigs()
               && $this->_createTab();
    }

    /* ------------------------------------------------------------- */
    /*  UNINSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function uninstall()
    {
        return parent::uninstall()
               && $this->unregisterHook('displayRightColumnProduct')
               && $this->_deleteConfigs()
               && $this->_deleteTab();
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
        $response = Configuration::updateValue('WPPRODUCTSHARE_PROFILEID', '');

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    private function _deleteConfigs()
    {
        $response = Configuration::deleteByName('WPPRODUCTSHARE_PROFILEID');

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
        $tab->class_name = "AdminWPProductShare";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Product Share Buttons";
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
        $id_tab = Tab::getIdFromClassName('AdminWPProductShare');
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
        if (Tools::isSubmit('submit'.$this->name)){

            if (Tools::isSubmit('wpproductshare_profileid')){
                Configuration::updateValue('WPPRODUCTSHARE_PROFILEID', Tools::getValue('wpproductshare_profileid'));
            }
        }

        return $this->_displayForm();
    }

    /* ------------------------------------------------------------- */
    /*  DISPLAY CONFIGURATION FORM
    /* ------------------------------------------------------------- */
    private function _displayForm()
    {
        $id_default_lang = $this->context->language->id;

        $fields_form = array(
            'wpproductshare-general' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('AddThis Options'),
                        'icon' => 'icon-cogs'
                    ),
                    'input' => array(
                        array(
                            'type' => 'text',
                            'name' => 'wpproductshare_profileid',
                            'label' => $this->l('Profile ID'),
                            'required' => false,
                            'lang' => false,
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveProductShareOptions'
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

        $helper->fields_value['wpproductshare_profileid'] = Configuration::get('WPPRODUCTSHARE_PROFILEID');


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
        $wpproductshare = array(
            'profileID' => Configuration::get('WPPRODUCTSHARE_PROFILEID')
        );

        $this->smarty->assign('wpproductshare', $wpproductshare);
    }


    /* ------------------------------------------------------------- */
    /*  HOOK (displayFooterSocialLinks)
    /* ------------------------------------------------------------- */
    public function hookDisplayRightColumnProduct($params)
    {
        $this->_prepHook($params);

        return $this->display(__FILE__, 'wpproductshare.tpl');
    }

}