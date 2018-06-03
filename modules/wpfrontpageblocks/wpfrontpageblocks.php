<?php

/* Withinpixels - Frontpage Blocks - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'wpfrontpageblocks/model/wpFrontpageBlocksModel.php');

class WPFrontpageBlocks extends Module
{
    private $_output = '';

    function __construct()
    {
        $this->name = 'wpfrontpageblocks';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('WithinPixels - Frontpage Blocks');
        $this->description = $this->l('Frontpage custom blocks');
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
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpfrontpageblocks` (
                `id_wpfrontpageblocks` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `active` tinyint(1) unsigned NOT NULL,
                `position` int(5) unsigned NOT NULL,
                `open_in_new` tinyint(1) unsigned NOT NULL,
                PRIMARY KEY (`id_wpfrontpageblocks`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpfrontpageblocks_lang` (
                `id_wpfrontpageblocks` int(10) unsigned NOT NULL,
                `id_lang` int(10) unsigned NOT NULL,
                `title` varchar(255) NOT NULL,
                `description` varchar(255) NOT NULL,
                `link` text NOT NULL,
                `image` varchar(255) NOT NULL,
                PRIMARY KEY (`id_wpfrontpageblocks`,`id_lang`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;
        ');

        $response &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wpfrontpageblocks_shop` (
                `id_wpfrontpageblocks` int(10) unsigned NOT NULL,
                `id_shop` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_wpfrontpageblocks`,`id_shop`)
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
                DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wpfrontpageblocks`, `' . _DB_PREFIX_ . 'wpfrontpageblocks_lang`, `' . _DB_PREFIX_ . 'wpfrontpageblocks_shop`;
        ');
    }

    /* ------------------------------------------------------------- */
    /*  CREATE CONFIGS
    /* ------------------------------------------------------------- */
    private function _createConfigs()
    {
        $languages = $this->context->language->getLanguages();

        foreach ($languages as $language){
            $title[$language['id_lang']] = 'Frontpage Blocks';
        }
        $response = Configuration::updateValue('WPFRONTPAGEBLOCKS_TITLE', $title);

        $response &= Configuration::updateValue('WPFRONTPAGEBLOCKS_COLCOUNT', 3);
        $response &= Configuration::updateValue('WPFRONTPAGEBLOCKS_HOVER', 0);

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    private function _deleteConfigs()
    {
        $response = Configuration::deleteByName('WPFRONTPAGEBLOCKS_TITLE');
        $response &= Configuration::deleteByName('WPFRONTPAGEBLOCKS_COLCOUNT');
        $response &= Configuration::deleteByName('WPFRONTPAGEBLOCKS_HOVER');

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  INSTALL DEMO DATA
    /* ------------------------------------------------------------- */
    private function _installDemoData()
    {
        $languages = $this->context->language->getLanguages(true);

        // Block 1
        $wpFrontpageBlock = new WPFrontpageBlocksModel();
        foreach ($languages as $language){
            $wpFrontpageBlock->title[$language['id_lang']] = 'Block 1';
        }
        $wpFrontpageBlock->link = 'http://www.withinpixels.com';
        $wpFrontpageBlock->image = '1-demoImage_1.jpg';
        $wpFrontpageBlock->add();

        // Block 2
        $wpFrontpageBlock = new WPFrontpageBlocksModel();
        foreach ($languages as $language){
            $wpFrontpageBlock->title[$language['id_lang']] = 'Block 2';
        }
        $wpFrontpageBlock->link = 'http://www.withinpixels.com';
        $wpFrontpageBlock->image = '2-demoImage_1.jpg';
        $wpFrontpageBlock->add();

        // Block 3
        $wpFrontpageBlock = new WPFrontpageBlocksModel();
        foreach ($languages as $language){
            $wpFrontpageBlock->title[$language['id_lang']] = 'Block 3';
        }
        $wpFrontpageBlock->link = 'http://www.withinpixels.com';
        $wpFrontpageBlock->image = '3-demoImage_1.jpg';
        $wpFrontpageBlock->add();

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
        $tab->class_name = "AdminWPFrontpageBlocks";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Frontpage Blocks";
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
        $id_tab = Tab::getIdFromClassName('AdminWPFrontpageBlocks');
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

            foreach ($languages as $language){
                if (Tools::isSubmit('wpfrontpageblocks_title_'.$language['id_lang'])){
                    $title[$language['id_lang']] = Tools::getValue('wpfrontpageblocks_title_'.$language['id_lang']);
                }
            }
            if (isset($title) && $title) {
                Configuration::updateValue('WPFRONTPAGEBLOCKS_TITLE', $title);
            }

            if (Tools::isSubmit('wpfrontpageblocks_colcount')){
                Configuration::updateValue('WPFRONTPAGEBLOCKS_COLCOUNT', Tools::getValue('wpfrontpageblocks_colcount'));
            }

            if (Tools::isSubmit('wpfrontpageblocks_hover')){
                Configuration::updateValue('WPFRONTPAGEBLOCKS_HOVER', Tools::getValue('wpfrontpageblocks_hover'));
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

        $columnCounts = array(
            array(
                'value' => '2',
                'name' => '2 columns'
            ),
            array(
                'value' => '3',
                'name' => '3 columns'
            ),
            array(
                'value' => '4',
                'name' => '4 columns'
            ),
            array(
                'value' => '5',
                'name' => '5 columns'
            ),
            array(
                'value' => '6',
                'name' => '6 columns'
            ),
        );

        $fields_form = array(
            'wpfrontpageblocks-general' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Frontpage Blocks Options'),
                        'icon' => 'icon-cogs'
                    ),
                    'input' => array(
                        array(
                            'type' => 'text',
                            'name' => 'wpfrontpageblocks_title',
                            'label' => $this->l('Title'),
                            'desc' => $this->l('This title will appear just before the frontpage blocks, leave it empty to hide the title completely'),
                            'required' => false,
                            'lang' => true,
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'wpfrontpageblocks_colcount',
                            'label' => $this->l('Column count'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $columnCounts,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show title and description on hover'),
                            'name' => 'wpfrontpageblocks_hover',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'hover_on',
                                    'value' => 1,
                                    'label' => $this->l('Remove')
                                ),
                                array(
                                    'id' => 'hover_off',
                                    'value' => 0,
                                    'label' => $this->l('Keep')
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
        /*$helper->show_toolbar = false;*/
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'editTabs' => array(
                'desc' => $this->l('Edit Blocks'),
                'href' => $this->context->link->getAdminLink('AdminWPFrontpageBlocks'),
                'imgclass' => 'edit'
            )
        );

        foreach($languages as $language){
            $helper->languages[] = array(
                'id_lang' => $language['id_lang'],
                'iso_code' => $language['iso_code'],
                'name' => $language['name'],
                'is_default' => ($id_default_lang == $language['id_lang'] ? 1 : 0)
            );
        }

        // Load current values
        $helper->fields_value['wpfrontpageblocks_colcount'] = Configuration::get('WPFRONTPAGEBLOCKS_COLCOUNT');
        $helper->fields_value['wpfrontpageblocks_hover'] = Configuration::get('WPFRONTPAGEBLOCKS_HOVER');

        foreach($languages as $language){
            $helper->fields_value['wpfrontpageblocks_title'][$language['id_lang']] = Configuration::get('WPFRONTPAGEBLOCKS_TITLE', $language['id_lang']);
        }

        return $helper->generateForm($fields_form);
    }

    /* ------------------------------------------------------------- */
    /*  HOOK THE MODULE INTO SHOP DATA DUPLICATION ACTION
    /* ------------------------------------------------------------- */
    public function hookActionShopDataDuplication($params)
    {
        Db::getInstance()->execute('
            INSERT IGNORE INTO '._DB_PREFIX_.'wpfrontpageblocks_shop (id_wpfrontpageblocks, id_shop)
            SELECT id_wpfrontpageblocks, '.(int)$params['new_id_shop'].'
            FROM '._DB_PREFIX_.'wpfrontpageblocks_shop
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

        $wpFrontpageBlocks = new WPFrontpageBlocksModel();
        $blockIds = $wpFrontpageBlocks->getBlockIds($id_shop);

        $blocks = array();

        foreach ($blockIds as $key => $blockId){
            $blocks[$blockId['id_wpfrontpageblocks']] = new WPFrontpageBlocksModel($blockId['id_wpfrontpageblocks'], $id_default_lang);
        }

        if (empty($blocks)){
            $blocks = false;
        }

        if ($blocks) {
            foreach ($blocks as $block){
                $block->image = _PS_BASE_URL_SSL_ . _MODULE_DIR_ . $this->name . '/views/img/' . $block->image;
				// $block->image = _PS_BASE_URL_ . _MODULE_DIR_ . $this->name . '/views/img/' . $block->image;
            }
        }

        $response = array(
            'columnCount' => Configuration::get('WPFRONTPAGEBLOCKS_COLCOUNT'),
            'hover' => Configuration::get('WPFRONTPAGEBLOCKS_HOVER'),
            'mainTitle' => Configuration::get('WPFRONTPAGEBLOCKS_TITLE', $id_default_lang),
            'blocks' => $blocks
        );

        $this->smarty->assign('wpfrontpageblocks', $response);
    }

    /* ------------------------------------------------------------- */
    /*  HOOK (displayHeader)
    /* ------------------------------------------------------------- */
    public function hookDisplayHome($params)
    {
        $this->_prepHook($params);

        $this->context->controller->addCSS($this->_path . 'views/css/hook/wpfrontpageblocks.css');

        return $this->display(__FILE__, 'wpfrontpageblocks.tpl');
    }

}