<?php

/* Withinpixels - Autumn Theme Configuration - 2014 - Sercan YEMEN - twitter.com/sercan */

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'wpautumn/model/wpAutumnModel.php');

class WPAutumn extends Module
{
    private $_output = '';

    private $_standardConfig = '';
    private $_styleConfig = '';
    private $_multiLangConfig = '';

    private $_cssConfig = '';

    function __construct()
    {
        $this->name = 'wpautumn';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Sercan YEMEN';
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Withinpixels - Autumn Theme Configuration');
        $this->description = $this->l('Required by Autumn Theme');

        $this->_defineArrays();
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
               && $this->registerHook('displayFooter')
               && $this->registerHook('quickImageViewer')
               && $this->_createConfigs()
               && $this->_createTab();
    }

    /* ------------------------------------------------------------- */
    /*  UNINSTALL THE MODULE
    /* ------------------------------------------------------------- */
    public function uninstall()
    {
        return parent::uninstall()
               && $this->unregisterHook('displayHeader')
               && $this->unregisterHook('displayFooter')
               && $this->unregisterHook('quickImageViewer')
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
        $languages = $this->context->language->getLanguages();

        foreach ($languages as $language){
            $customHeaderText[$language['id_lang']] = 'Welcome to our store!';
        }

        foreach ($languages as $language){
            $customFooterText[$language['id_lang']] = 'Autumn - Responsive Prestashop Theme © 2014';
        }

        // General Options
        $response = Configuration::updateValue('WPAC_mainLayout', 'fullwidth');
        $response &= Configuration::updateValue('WPAC_sidebarPosition', 'left');
        $response &= Configuration::updateValue('WPAC_gridColumnSize', 4);

        // Header Options
        $response &= Configuration::updateValue('WPAC_headerStyle', 'header-v1');
        $response &= Configuration::updateValue('WPAC_stickyMenu', 0);
        $response &= Configuration::updateValue('WPAC_customHeaderText', $customHeaderText);
        $response &= Configuration::updateValue('WPAC_headerTopBgColor' , '');
        $response &= Configuration::updateValue('WPAC_headerMainBgColor' , '');

        // Footer Options
        $response &= Configuration::updateValue('WPAC_footerColumnCount', 4);
        $response &= Configuration::updateValue('WPAC_customFooterText', $customFooterText);
        $response &= Configuration::updateValue('WPAC_secondaryFooter', 0);
        $response &= Configuration::updateValue('WPAC_footerMainBgColor' , '');
        $response &= Configuration::updateValue('WPAC_footerBottomBgColor' , '');

        // Category Page Options
        $response &= Configuration::updateValue('WPAC_quickView', 1);
        $response &= Configuration::updateValue('WPAC_quickImageViewer', 1);
        $response &= Configuration::updateValue('WPAC_quickImageViewerAutoNext', 1);
        $response &= Configuration::updateValue('WPAC_categoryHeaderStyle', 'left|right');
        $response &= Configuration::updateValue('WPAC_subcategories', 0);
        $response &= Configuration::updateValue('WPAC_categoryViewType', 'grid');
        $response &= Configuration::updateValue('WPAC_categoryShowAvgRating', 0);
        $response &= Configuration::updateValue('WPAC_categoryShowColorOptions', 0);
        $response &= Configuration::updateValue('WPAC_categoryShowStockInfo', 0);

        // Product Page Options
        $response &= Configuration::updateValue('WPAC_enableProductNav', 1);
        $response &= Configuration::updateValue('WPAC_productShowReference', 1);
        $response &= Configuration::updateValue('WPAC_productShowCondition', 1);
        $response &= Configuration::updateValue('WPAC_productShowManName', 1);

        // Color Options
        $response &= Configuration::updateValue('WPAC_mainColorScheme', '');

        // Background Options
        $response &= Configuration::updateValue('WPAC_backgroundColor', '');
        $response &= Configuration::updateValue('WPAC_backgroundImage', '');
        $response &= Configuration::updateValue('WPAC_backgroundRepeat', 'repeat');
        $response &= Configuration::updateValue('WPAC_backgroundAttachment', 'scroll');
        $response &= Configuration::updateValue('WPAC_backgroundSize', 'auto');

        $response &= Configuration::updateValue('WPAC_bodyBackgroundColor', '');
        $response &= Configuration::updateValue('WPAC_bodyBackgroundImage', '');
        $response &= Configuration::updateValue('WPAC_bodyBackgroundRepeat', 'repeat');
        $response &= Configuration::updateValue('WPAC_bodyBackgroundAttachment', 'scroll');
        $response &= Configuration::updateValue('WPAC_bodyBackgroundSize', 'auto');

        // Custom Codes
        $response &= Configuration::updateValue('WPAC_customCSS', '');
        $response &= Configuration::updateValue('WPAC_customJS', '');

        // Override Options
        $response &= Configuration::updateValue('PS_TC_ACTIVE', 0);
        $response &= Configuration::updateValue('PS_QUICK_VIEW', 1);

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    private function _deleteConfigs()
    {
        // General Options
        $response = Configuration::deleteByName('WPAC_mainLayout');
        $response &= Configuration::deleteByName('WPAC_sidebarPosition');
        $response &= Configuration::deleteByName('WPAC_gridColumnSize');

        // Header Options
        $response &= Configuration::deleteByName('WPAC_headerStyle');
        $response &= Configuration::deleteByName('WPAC_stickyMenu');
        $response &= Configuration::deleteByName('WPAC_customHeaderText');
        $response &= Configuration::deleteByName('WPAC_headerTopBgColor');
        $response &= Configuration::deleteByName('WPAC_headerMainBgColor');

        // Footer Options
        $response &= Configuration::deleteByName('WPAC_footerColumnCount');
        $response &= Configuration::deleteByName('WPAC_customFooterText');
        $response &= Configuration::deleteByName('WPAC_secondaryFooter');
        $response &= Configuration::deleteByName('WPAC_footerMainBgColor');
        $response &= Configuration::deleteByName('WPAC_footerBottomBgColor');

        // Category Page Options
        $response &= Configuration::deleteByName('WPAC_quickImageViewer');
        $response &= Configuration::deleteByName('WPAC_quickImageViewerAutoNext');
        $response &= Configuration::deleteByName('WPAC_quickView');
        $response &= Configuration::deleteByName('WPAC_categoryHeaderStyle');
        $response &= Configuration::deleteByName('WPAC_subcategories');
        $response &= Configuration::deleteByName('WPAC_categoryViewType');
        $response &= Configuration::deleteByName('WPAC_categoryShowAvgRating');
        $response &= Configuration::deleteByName('WPAC_categoryShowColorOptions');
        $response &= Configuration::deleteByName('WPAC_categoryShowStockInfo');

        // Product Page Options
        $response &= Configuration::deleteByName('WPAC_enableProductNav');
        $response &= Configuration::deleteByName('WPAC_productShowReference');
        $response &= Configuration::deleteByName('WPAC_productShowCondition');
        $response &= Configuration::deleteByName('WPAC_productShowManName');

        // Color Options
        $response &= Configuration::deleteByName('WPAC_mainColorScheme');

        // Background Options
        $response &= Configuration::deleteByName('WPAC_backgroundColor');
        $response &= Configuration::deleteByName('WPAC_backgroundImage');
        $response &= Configuration::deleteByName('WPAC_backgroundRepeat');
        $response &= Configuration::deleteByName('WPAC_backgroundAttachment');
        $response &= Configuration::deleteByName('WPAC_backgroundSize');

        $response &= Configuration::deleteByName('WPAC_bodyBackgroundColor');
        $response &= Configuration::deleteByName('WPAC_bodyBackgroundImage');
        $response &= Configuration::deleteByName('WPAC_bodyBackgroundRepeat');
        $response &= Configuration::deleteByName('WPAC_bodyBackgroundAttachment');
        $response &= Configuration::deleteByName('WPAC_bodyBackgroundSize');

        // Custom Codes
        $response &= Configuration::deleteByName('WPAC_customCSS');
        $response &= Configuration::deleteByName('WPAC_customJS');

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
        $tab->class_name = "AdminWPAutumnConfig";
        $tab->name = array();
        foreach (Language::getLanguages() as $lang){
            $tab->name[$lang['id_lang']] = "Autumn Theme Configuration";
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
        $id_tab = Tab::getIdFromClassName('AdminWPAutumnConfig');
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
    /*  DEFINE ARRAYS
    /* ------------------------------------------------------------- */
    private function _defineArrays()
    {
        $bgImageDir = _PS_BASE_URL_ . _MODULE_DIR_ . $this->name . '/views/img/front/bg/';

        // CONFIG ARRAYS
        $this->_standardConfig = array(
            // General Options
            'WPAC_mainLayout',
            'WPAC_sidebarPosition',
            'WPAC_gridColumnSize',

            // Header Options
            'WPAC_headerStyle',
            'WPAC_stickyMenu',

            // Footer Options
            'WPAC_footerColumnCount',
            'WPAC_secondaryFooter',

            // Category Page Options
            'WPAC_quickImageViewer',
            'WPAC_quickImageViewerAutoNext',
            'WPAC_quickView',
            'WPAC_categoryHeaderStyle',
            'WPAC_subcategories',
            'WPAC_categoryViewType',
            'WPAC_categoryShowAvgRating',
            'WPAC_categoryShowColorOptions',
            'WPAC_categoryShowStockInfo',

            // Product Page Options
            'WPAC_enableProductNav',
            'WPAC_productShowReference',
            'WPAC_productShowCondition',
            'WPAC_productShowManName',

        );

        $this->_styleConfig = array(
            // Header Options
            'WPAC_headerTopBgColor',
            'WPAC_headerMainBgColor',

            // Footer Options
            'WPAC_footerMainBgColor',
            'WPAC_footerBottomBgColor',

            // Background Options
            'WPAC_backgroundColor',
            'WPAC_backgroundImage',
            'WPAC_backgroundRepeat',
            'WPAC_backgroundAttachment',
            'WPAC_backgroundSize',

            'WPAC_bodyBackgroundColor',
            'WPAC_bodyBackgroundImage',
            'WPAC_bodyBackgroundRepeat',
            'WPAC_bodyBackgroundAttachment',
            'WPAC_bodyBackgroundSize',

            // Color Options
            'WPAC_mainColorScheme',

            // Custom Codes
            'WPAC_customCSS',
            'WPAC_customJS'
        );

        $this->_multiLangConfig = array(
            // Header Options
            'WPAC_customHeaderText',
            'WPAC_customFooterText'
        );

        // CSS AND CONFIG RELATIONS
        $this->_cssConfig = array(
            // #wrapper Background
            'WPAC_backgroundColor' => array(
                array(
                    'selector' => '#wrapper',
                    'rule' => 'background-color'
                )
            ),
            'WPAC_backgroundImage' => array(
                array(
                    'selector' => '#wrapper',
                    'rule' => 'background-image',
                    'prefix' => 'url("'.$bgImageDir,
                    'suffix' => '")'
                )
            ),
            'WPAC_backgroundRepeat' => array(
                array(
                    'selector' => '#wrapper',
                    'rule' => 'background-repeat'
                )
            ),
            'WPAC_backgroundAttachment' => array(
                array(
                    'selector' => '#wrapper',
                    'rule' => 'background-attachment'
                )
            ),
            'WPAC_backgroundSize' => array(
                array(
                    'selector' => '#wrapper',
                    'rule' => 'background-size'
                )
            ),

            // Body Background
            'WPAC_bodyBackgroundColor' => array(
                array(
                    'selector' => 'body',
                    'rule' => 'background-color'
                )
            ),
            'WPAC_bodyBackgroundImage' => array(
                array(
                    'selector' => 'body',
                    'rule' => 'background-image',
                    'prefix' => 'url("'.$bgImageDir,
                    'suffix' => '")'
                )
            ),
            'WPAC_bodyBackgroundRepeat' => array(
                array(
                    'selector' => 'body',
                    'rule' => 'background-repeat'
                )
            ),
            'WPAC_bodyBackgroundAttachment' => array(
                array(
                    'selector' => 'body',
                    'rule' => 'background-attachment'
                )
            ),
            'WPAC_bodyBackgroundSize' => array(
                array(
                    'selector' => 'body',
                    'rule' => 'background-size'
                )
            ),

            // Header
            'WPAC_headerTopBgColor' => array(
                array(
                    'selector' => '#header_top',
                    'rule' => 'background-color'
                )
            ),
            'WPAC_headerMainBgColor' => array(
                'css' => array(
                    'selector' => '#header_bottom',
                    'rule' => 'background-color'
                )
            ),

            // Footer
            'WPAC_footerMainBgColor' => array(
                array(
                    'selector' => '#footer',
                    'rule' => 'background-color'
                )
            ),
            'WPAC_footerBottomBgColor' => array(
                array(
                    'selector' => '#bottom-footer',
                    'rule' => 'background-color'
                ),
                array(
                    'selector' => '#footer-social-links',
                    'rule' => 'background-color'
                )
            ),

            // Main Color Scheme
            'WPAC_mainColorScheme' => array(
                //layout.css
                array(
                    'selector' => '.grid .item-price',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.grid .item-tag-new',
                    'rule' => 'background'
                ),

                //autumn.css
                array(
                    'selector' => 'a:hover',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.colored-text',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.iconed-text > .wpicon',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.colored-bg',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '.price',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.required sup, sup.required',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.button-1.fill',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '.button-1.flat',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '.no-touch .button-1.outline:hover',
                    'rule' => 'border-color'
                ),
                array(
                    'selector' => '.no-touch .button-1.outline:hover',
                    'rule' => 'background',
                    'suffix' => '!important'
                ),
                array(
                    'selector' => '.no-touch .button-3:hover',
                    'rule' => 'background',
                    'suffix' => '!important'
                ),
                array(
                    'selector' => 'h3.section-header',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.tabs .tab-title.active',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.tabs .tab-title.active',
                    'rule' => 'border-color'
                ),
                array(
                    'selector' => '.tabs .tab-contents .tab-content-wrapper.active .tab-title',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.tabs .tab-contents .tab-content-wrapper.active .tab-title',
                    'rule' => 'border-color'
                ),
                array(
                    'selector' => '#header_shopping_cart .wpicon-cart',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '#categories_block_left li a.selected',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '#layered_block_left .layered_subtitle',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.ui-slider-horizontal .ui-slider-range',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '.no-touch .tags_block a:hover',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '#currency_selector .currencies_ul li.selected',
                    'rule' => 'background-color'
                ),
                array(
                    'selector' => '#language_selector .languages_ul li.selected',
                    'rule' => 'background-color'
                ),
                array(
                    'selector' => '#category-header',
                    'rule' => 'background-color'
                ),
                array(
                    'selector' => '.sortPagiBar .category-view-type > a.active',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.no-touch .grid .item-quick-image-viewer-buttons > div:hover',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '#product_comparison .on_sale',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.pb-left-column #image-block .new',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '.secondary_block .page-product-heading',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '#product_comparison .discount',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.myaccount-link-list .item .wpicon',
                    'rule' => 'color'
                ),
                array(
                    'selector' => 'ul.step li.step_done',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '.cart_product_contains > #summary_products_quantity',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '#cart_summary .cart_total_price #total_price_container #total_price_label',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '#order_step .step_done',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '#order-opc .order-opc-section-title > .number',
                    'rule' => 'background'
                ),
                array(
                    'selector' => '.no-touch #product_comments_block_tab span.report_btn:hover',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.no-touch #secondary-footer a:hover',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '#footer a:hover',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.block .title_block',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.block h4',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.block .title_block a',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.block h4 a',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '#mobile-header-toggle',
                    'rule' => 'background'
                ),

                //wpmegamenu.css
                array(
                    'selector' => '.wpmegamenu .menu-items',
                    'rule' => 'border-color'
                ),

                array(
                    'selector' => '.no-touch .wpmegamenu .root:hover .root-item > .title',
                    'rule' => 'color'
                ),

                // wpisotopetabs.css
                array(
                    'selector' => '.no-touch #wpisotopetabs .wpisotopetabs-filter a:hover',
                    'rule' => 'background',
                    'suffix' => '!important'
                ),
                array(
                    'selector' => '#wpisotopetabs .wpisotopetabs-filter a.active',
                    'rule' => 'background',
                    'suffix' => '!important'
                ),

                //wpsearchblock.css
                array(
                    'selector' => '.ac_results .ac_product_name strong',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.ac_results .ac_over',
                    'rule' => 'background',
                    'suffix' => '!important'
                ),
                array(
                    'selector' => '.ac_results.mobile .ac_product_name strong',
                    'rule' => 'color'
                ),
                array(
                    'selector' => '.ac_results.mobile .ac_over',
                    'rule' => 'background',
                    'suffix' => '!important'
                ),

                //wpmobilemenu
                array(
                    'selector' => '#wpmm-nav',
                    'rule' => 'background'
                ),

                //owl carousel
                array(
                    'selector' => '.owl-theme .owl-controls .owl-page span',
                    'rule' => 'background'
                )
            )
        );

    }

    /* ------------------------------------------------------------- */
    /*  GET CONTENT
    /* ------------------------------------------------------------- */
    public function getContent()
    {
        $id_shop = $this->context->shop->id;
        $languages = $this->context->language->getLanguages();
        $errors = array();

        // Load css file for option panel
        $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/admin/wpautumn-admin.css');

        if (Tools::isSubmit('submit'.$this->name)){

            // General Options
            if (Tools::isSubmit('WPAC_mainLayout')){
                Configuration::updateValue('WPAC_mainLayout', Tools::getValue('WPAC_mainLayout'));
            }

            if (Tools::isSubmit('WPAC_sidebarPosition')){
                Configuration::updateValue('WPAC_sidebarPosition', Tools::getValue('WPAC_sidebarPosition'));
            }

            if (Tools::isSubmit('WPAC_gridColumnSize')){
                Configuration::updateValue('WPAC_gridColumnSize', Tools::getValue('WPAC_gridColumnSize'));
            }

            // Header Options
            if (Tools::isSubmit('WPAC_headerStyle')){
                Configuration::updateValue('WPAC_headerStyle', Tools::getValue('WPAC_headerStyle'));
            }

            if (Tools::isSubmit('WPAC_stickyMenu')){
                Configuration::updateValue('WPAC_stickyMenu', Tools::getValue('WPAC_stickyMenu'));
            }

            foreach ($languages as $language){
                if (Tools::isSubmit('WPAC_customHeaderText_'.$language['id_lang'])){
                    $customHeaderText[$language['id_lang']] = Tools::getValue('WPAC_customHeaderText_'.$language['id_lang']);
                }
            }
            if (isset($customHeaderText) && $customHeaderText) {
                Configuration::updateValue('WPAC_customHeaderText', $customHeaderText);
            }

            if (Tools::isSubmit('WPAC_headerTopBgColor')){
                Configuration::updateValue('WPAC_headerTopBgColor', Tools::getValue('WPAC_headerTopBgColor'));
            }

            if (Tools::isSubmit('WPAC_headerMainBgColor')){
                Configuration::updateValue('WPAC_headerMainBgColor', Tools::getValue('WPAC_headerMainBgColor'));
            }

            // Footer Options
            if (Tools::isSubmit('WPAC_footerColumnCount')){
                Configuration::updateValue('WPAC_footerColumnCount', Tools::getValue('WPAC_footerColumnCount'));
            }

            foreach ($languages as $language){
                if (Tools::isSubmit('WPAC_customFooterText_'.$language['id_lang'])){
                    $customFooterText[$language['id_lang']] = Tools::getValue('WPAC_customFooterText_'.$language['id_lang']);
                }
            }
            if (isset($customFooterText) && $customFooterText) {
                Configuration::updateValue('WPAC_customFooterText', $customFooterText);
            }

/*            if (Tools::isSubmit('WPAC_secondaryFooter')){
                Configuration::updateValue('WPAC_secondaryFooter', Tools::getValue('WPAC_secondaryFooter'));
            }*/

            if (Tools::isSubmit('WPAC_footerMainBgColor')){
                Configuration::updateValue('WPAC_footerMainBgColor', Tools::getValue('WPAC_footerMainBgColor'));
            }

            if (Tools::isSubmit('WPAC_footerBottomBgColor')){
                Configuration::updateValue('WPAC_footerBottomBgColor', Tools::getValue('WPAC_footerBottomBgColor'));
            }

            // Category Page Options
            if (Tools::isSubmit('WPAC_quickImageViewer')){
                Configuration::updateValue('WPAC_quickImageViewer', Tools::getValue('WPAC_quickImageViewer'));
            }

            if (Tools::isSubmit('WPAC_quickImageViewerAutoNext')){
                Configuration::updateValue('WPAC_quickImageViewerAutoNext', Tools::getValue('WPAC_quickImageViewerAutoNext'));
            }

            if (Tools::isSubmit('WPAC_quickView')){
                Configuration::updateValue('WPAC_quickView', Tools::getValue('WPAC_quickView'));
            }

            if (Tools::isSubmit('WPAC_categoryHeaderStyle')){
                Configuration::updateValue('WPAC_categoryHeaderStyle', Tools::getValue('WPAC_categoryHeaderStyle'));
            }

            if (Tools::isSubmit('WPAC_subcategories')){
                Configuration::updateValue('WPAC_subcategories', Tools::getValue('WPAC_subcategories'));
            }

            if (Tools::isSubmit('WPAC_categoryViewType')){
                Configuration::updateValue('WPAC_categoryViewType', Tools::getValue('WPAC_categoryViewType'));
            }

            if (Tools::isSubmit('WPAC_categoryShowAvgRating')){
                Configuration::updateValue('WPAC_categoryShowAvgRating', Tools::getValue('WPAC_categoryShowAvgRating'));
            }

            if (Tools::isSubmit('WPAC_categoryShowColorOptions')){
                Configuration::updateValue('WPAC_categoryShowColorOptions', Tools::getValue('WPAC_categoryShowColorOptions'));
            }

            if (Tools::isSubmit('WPAC_categoryShowStockInfo')){
                Configuration::updateValue('WPAC_categoryShowStockInfo', Tools::getValue('WPAC_categoryShowStockInfo'));
            }

            // Product Page Options
            if (Tools::isSubmit('WPAC_enableProductNav')){
                Configuration::updateValue('WPAC_enableProductNav', Tools::getValue('WPAC_enableProductNav'));
            }

            if (Tools::isSubmit('WPAC_productShowReference')){
                Configuration::updateValue('WPAC_productShowReference', Tools::getValue('WPAC_productShowReference'));
            }

            if (Tools::isSubmit('WPAC_productShowCondition')){
                Configuration::updateValue('WPAC_productShowCondition', Tools::getValue('WPAC_productShowCondition'));
            }

            if (Tools::isSubmit('WPAC_productShowManName')){
                Configuration::updateValue('WPAC_productShowManName', Tools::getValue('WPAC_productShowManName'));
            }

            // Color Options
            if (Tools::isSubmit('WPAC_mainColorScheme')){
                Configuration::updateValue('WPAC_mainColorScheme', Tools::getValue('WPAC_mainColorScheme'));
            }

            // Background Options
            if (Tools::isSubmit('WPAC_backgroundColor')){
                Configuration::updateValue('WPAC_backgroundColor', Tools::getValue('WPAC_backgroundColor'));
            }

            if (isset($_FILES['WPAC_backgroundImage']) && isset($_FILES['WPAC_backgroundImage']['tmp_name']) && !empty($_FILES['WPAC_backgroundImage']['tmp_name']))
            {
                if ($error = ImageManager::validateUpload($_FILES['WPAC_backgroundImage'], Tools::convertBytes(ini_get('upload_max_filesize')))){
                    $errors[] = $error;
                } else {
                    $imageName = explode('.', $_FILES['WPAC_backgroundImage']['name']);
                    $imageExt = $imageName[1];
                    $imageName = $imageName[0];
                    $backgroundImageName = $imageName . '-' . $id_shop . '.' . $imageExt;

                    Configuration::updateValue('WPAC_backgroundImage', $backgroundImageName);

                    if (!move_uploaded_file($_FILES['WPAC_backgroundImage']['tmp_name'], _PS_MODULE_DIR_ . $this->name . '/views/img/front/bg/' . $backgroundImageName)) {
                        $errors[] = $this->l('File upload error.');
                    }
                }
            }

            if (Tools::isSubmit('WPAC_backgroundRepeat')){
                Configuration::updateValue('WPAC_backgroundRepeat', Tools::getValue('WPAC_backgroundRepeat'));
            }

            if (Tools::isSubmit('WPAC_backgroundAttachment')){
                Configuration::updateValue('WPAC_backgroundAttachment', Tools::getValue('WPAC_backgroundAttachment'));
            }

            if (Tools::isSubmit('WPAC_backgroundSize')){
                Configuration::updateValue('WPAC_backgroundSize', Tools::getValue('WPAC_backgroundSize'));
            }

            if (Tools::isSubmit('WPAC_bodyBackgroundColor')){
                Configuration::updateValue('WPAC_bodyBackgroundColor', Tools::getValue('WPAC_bodyBackgroundColor'));
            }

            if (isset($_FILES['WPAC_bodyBackgroundImage']) && isset($_FILES['WPAC_bodyBackgroundImage']['tmp_name']) && !empty($_FILES['WPAC_bodyBackgroundImage']['tmp_name']))
            {
                if ($error = ImageManager::validateUpload($_FILES['WPAC_bodyBackgroundImage'], Tools::convertBytes(ini_get('upload_max_filesize')))){
                    $errors[] = $error;
                } else {
                    $imageName = explode('.', $_FILES['WPAC_bodyBackgroundImage']['name']);
                    $imageExt = $imageName[1];
                    $imageName = $imageName[0];
                    $bodyBackgroundImageName = $imageName . '-' . $id_shop . '.' . $imageExt;

                    Configuration::updateValue('WPAC_bodyBackgroundImage', $bodyBackgroundImageName);

                    if (!move_uploaded_file($_FILES['WPAC_bodyBackgroundImage']['tmp_name'], _PS_MODULE_DIR_ . $this->name . '/views/img/front/bg/' . $bodyBackgroundImageName)) {
                        $errors[] = $this->l('File upload error.');
                    }
                }
            }

            if (Tools::isSubmit('WPAC_bodyBackgroundRepeat')){
                Configuration::updateValue('WPAC_bodyBackgroundRepeat', Tools::getValue('WPAC_bodyBackgroundRepeat'));
            }

            if (Tools::isSubmit('WPAC_bodyBackgroundAttachment')){
                Configuration::updateValue('WPAC_bodyBackgroundAttachment', Tools::getValue('WPAC_bodyBackgroundAttachment'));
            }

            if (Tools::isSubmit('WPAC_bodyBackgroundSize')){
                Configuration::updateValue('WPAC_bodyBackgroundSize', Tools::getValue('WPAC_bodyBackgroundSize'));
            }

            // Custom Codes
            if (Tools::isSubmit('WPAC_customCSS')){
                Configuration::updateValue('WPAC_customCSS', Tools::getValue('WPAC_customCSS'));
            }

            if (Tools::isSubmit('WPAC_customJS')){
                Configuration::updateValue('WPAC_customJS', Tools::getValue('WPAC_customJS'));
            }

            // Write the configurations to a CSS file
            $response = $this->_writeCss();
            if (!$response) {
                $errors[] = $this->l('An error occured while writing the css file!');
            }

            // Prepare the output
            if (count($errors)){
                $this->_output .= $this->displayError(implode('<br />', $errors));
            } else {
                $this->_output .= $this->displayConfirmation($this->l('Configuration updated'));
            }

        } elseif (Tools::isSubmit('deleteConfig')) {
            $config = Tools::getValue('deleteConfig');
            $configValue = Configuration::get($config);

            if (file_exists(_PS_MODULE_DIR_ . $this->name . '/views/img/front/bg/' . $configValue)){
                unlink(_PS_MODULE_DIR_ . $this->name . '/views/img/front/bg/' . $configValue);
            }

            Configuration::updateValue($config, null);

        } elseif (Tools::isSubmit('mergeOldNewsletter') && Tools::getValue('mergeOldNewsletter') == 1) {
            $this->_mergeOldNewsletter();
        }

        return $this->_output.$this->_displayForm();
    }


    /* ------------------------------------------------------------- */
    /*  DISPLAY CONFIGURATION FORM
    /* ------------------------------------------------------------- */
    private function _displayForm()
    {
        $id_default_lang = $this->context->language->id;
        $languages = $this->context->language->getLanguages();
        $id_shop = $this->context->shop->id;

        // General Options
        $layoutTypes = array(
            array(
                'value' => 'fullwidth',
                'name' => 'FullWidth'
            ),
            array(
                'value' => 'boxed',
                'name' => 'Boxed'
            )
        );

        $sidebarPositions = array(
            array(
                'value' => 'left',
                'name' => 'Left'
            ),
            array(
                'value' => 'right',
                'name' => 'Right'
            )
        );

        $gridColumnSizes = array(
            array(
                'value' => 2,
                'name' => '2 products'
            ),
            array(
                'value' => 3,
                'name' => '3 products'
            ),
            array(
                'value' => 4,
                'name' => '4 products'
            ),
            array(
                'value' => 5,
                'name' => '5 products'
            ),
            array(
                'value' => 6,
                'name' => '6 products'
            )
        );

        // Header Options
        $headerStyles = array(
            array(
                'value' => 'header-v1',
                'name' => 'Header1'
            ),
            array(
                'value' => 'header-v2',
                'name' => 'Header2'
            ),
            array(
                'value' => 'header-v3',
                'name' => 'Header3'
            )
        );

        // Footer Options
        $footerColumnCounts = array(
            array(
                'value' => 2,
                'name' => '2 columns'
            ),
            array(
                'value' => 3,
                'name' => '3 columns'
            ),
            array(
                'value' => 4,
                'name' => '4 columns'
            ),
            array(
                'value' => 5,
                'name' => '5 columns'
            ),
            array(
                'value' => 6,
                'name' => '6 columns'
            )
        );

        // Category Page Options
        $categoryHeaderStyles = array(
            array(
                'value' => 'left|left',
                'name' => 'Title and Breadcrumb on the left'
            ),
            array(
                'value' => 'center|center',
                'name' => 'Title and Breadcrumb in the center'
            ),
            array(
                'value' => 'right|right',
                'name' => 'Title and Breadcrumb on the right'
            ),
            array(
                'value' => 'left|right',
                'name' => 'Title on the left - Breadcrumb on the right'
            ),
            array(
                'value' => 'right|left',
                'name' => 'Breadcrumb on the left - Title on the right'
            )
        );

        $categoryViewTypes = array(
            array(
                'value' => 'grid',
                'name' => 'Grid'
            ),
            array(
                'value' => 'list',
                'name' => 'List'
            )
        );

        // Background Options
        $backgroundRepeatOptions = array(
            array(
                'value' => 'repeat-x',
                'name' => 'Repeat-X'
            ),
            array(
                'value' => 'repeat-y',
                'name' => 'Repeat-Y'
            ),
            array(
                'value' => 'repeat',
                'name' => 'Repeat Both'
            ),
            array(
                'value' => 'no-repeat',
                'name' => 'No Repeat'
            )
        );

        $backgroundAttachmentOptions = array(
            array(
                'value' => 'scroll',
                'name' => 'Scroll'
            ),
            array(
                'value' => 'fixed',
                'name' => 'Fixed'
            )
        );

        $backgroundSizeOptions = array(
            array(
                'value' => 'auto',
                'name' => 'Auto'
            ),
            array(
                'value' => 'cover',
                'name' => 'Cover'
            )
        );

        $fields_form = array(
            'wpautumn-general' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('General'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_mainLayout',
                            'label' => $this->l('Layout type'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $layoutTypes,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_sidebarPosition',
                            'label' => $this->l('Sidebar position'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $sidebarPositions,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_gridColumnSize',
                            'label' => $this->l('Number of products in one row'),
                            'desc' => $this->l('Only for "Grid" view. This option will adapt itself according to the screen resolution of the device.'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $gridColumnSizes,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-header' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Header'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_headerStyle',
                            'label' => $this->l('Header style'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $headerStyles,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Sticky menu'),
                            'name' => 'WPAC_stickyMenu',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'stickymenu_on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'stickymenu_off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                )
                            )
                        ),
                        array(
                            'type' => 'text',
                            'name' => 'WPAC_customHeaderText',
                            'label' => $this->l('Custom header text'),
                            'required' => false,
                            'lang' => true,
                        ),
                        array(
                            'type' => 'color',
                            'name' => 'WPAC_headerTopBgColor',
                            'label' => $this->l('Header top section background color'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        ),
                        array(
                            'type' => 'color',
                            'name' => 'WPAC_headerMainBgColor',
                            'label' => $this->l('Header main background color'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-footer' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Footer'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_footerColumnCount',
                            'label' => $this->l('Footer column count'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $footerColumnCounts,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'text',
                            'name' => 'WPAC_customFooterText',
                            'label' => $this->l('Custom footer text'),
                            'required' => false,
                            'lang' => true,
                        ),
                        /*array(
                            'type' => 'radio',
                            'label' => $this->l('Show secondary footer'),
                            'name' => 'WPAC_secondaryFooter',
                            'required' => false,
                            'class' => 't',
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'secondaryfooter_on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'secondaryfooter_off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                )
                            )
                        ),*/
                        array(
                            'type' => 'color',
                            'name' => 'WPAC_footerMainBgColor',
                            'label' => $this->l('Footer main background color'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        ),
                        array(
                            'type' => 'color',
                            'name' => 'WPAC_footerBottomBgColor',
                            'label' => $this->l('Footer bottom section background color'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-categorypages' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Category Page'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_categoryHeaderStyle',
                            'label' => $this->l('Category header style'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $categoryHeaderStyles,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show subcategories'),
                            'name' => 'WPAC_subcategories',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'subcategories_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'subcategories_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_categoryViewType',
                            'label' => $this->l('Default category view type'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $categoryViewTypes,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Enable quick view'),
                            'name' => 'WPAC_quickView',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'quickview_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'quickview_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Enable quick image viewer'),
                            'name' => 'WPAC_quickImageViewer',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'quickimage_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'quickimage_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Slide to 2nd image automatically in quick image viewer on hover'),
                            'name' => 'WPAC_quickImageViewerAutoNext',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'quickimageautonext_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'quickimageautonext_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show average rating stars'),
                            'name' => 'WPAC_categoryShowAvgRating',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'avgratings_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'avgratings_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show color options'),
                            'name' => 'WPAC_categoryShowColorOptions',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'coloroptions_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'coloroptions_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show stock information'),
                            'name' => 'WPAC_categoryShowStockInfo',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'stockinfo_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'stockinfo_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-productpages' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Product Page'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Enable Previous/Next Product buttons for product pages'),
                            'name' => 'WPAC_enableProductNav',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'productnav_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'productnav_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show product reference code'),
                            'name' => 'WPAC_productShowReference',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'productreference_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'productreference_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show product condition'),
                            'name' => 'WPAC_productShowCondition',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'productcondition_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'productcondition_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Show product manufacturer name'),
                            'name' => 'WPAC_productShowManName',
                            'required' => false,
                            'is_bool' => true,
                            'values' => array(
                                array(
                                    'id' => 'productmanname_on',
                                    'value' => 1,
                                    'label' => $this->l('Yes')
                                ),
                                array(
                                    'id' => 'productmanname_off',
                                    'value' => 0,
                                    'label' => $this->l('No')
                                )
                            )
                        ),
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-color' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Color'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'color',
                            'name' => 'WPAC_mainColorScheme',
                            'label' => $this->l('Main color scheme'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-background' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Backgrounds'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'color',
                            'name' => 'WPAC_backgroundColor',
                            'label' => $this->l('Background color'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        ),
                        array(
                            'type' => 'file',
                            'name' => 'WPAC_backgroundImage',
                            'label' => $this->l('Background image'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_backgroundRepeat',
                            'label' => $this->l('Background repeat'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $backgroundRepeatOptions,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_backgroundAttachment',
                            'label' => $this->l('Background attachment'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $backgroundAttachmentOptions,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_backgroundSize',
                            'label' => $this->l('Background size'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $backgroundSizeOptions,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'color',
                            'name' => 'WPAC_bodyBackgroundColor',
                            'label' => $this->l('Body background color'),
                            'desc' => $this->l('Body background color only visible in "Boxed" mode.'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        ),
                        array(
                            'type' => 'file',
                            'name' => 'WPAC_bodyBackgroundImage',
                            'label' => $this->l('Body background image'),
                            'desc' => $this->l('Body background image only visible in "Boxed" mode.'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_bodyBackgroundRepeat',
                            'label' => $this->l('Body background repeat'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $backgroundRepeatOptions,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_bodyBackgroundAttachment',
                            'label' => $this->l('Body background attachment'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $backgroundAttachmentOptions,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'WPAC_bodyBackgroundSize',
                            'label' => $this->l('Body background size'),
                            'required' => false,
                            'lang' => false,
                            'options' => array(
                                'query' => $backgroundSizeOptions,
                                'id' => 'value',
                                'name' => 'name'
                            )
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-codes' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Custom Codes'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'textarea',
                            'name' => 'WPAC_customCSS',
                            'desc' => $this->l('Important Note: Use this area if only there are rules you cannot override with using normal css files. This will add css rules as inline code and it is not the best practice. Try using "custom.css" file located under "themes/autumn/css/" folder to add your custom css rules.'),
                            'rows' => 10,
                            'label' => $this->l('Custom CSS Code'),
                            'required' => false,
                            'lang' => false
                        ),
                        array(
                            'type' => 'textarea',
                            'name' => 'WPAC_customJS',
                            'rows' => 10,
                            'label' => $this->l('Custom JS Code'),
                            'required' => false,
                            'lang' => false
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
                    )
                )
            ),
            'wpautumn-merge' => array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Data Merge'),
                        'icon' => 'icon-cog'
                    ),
                    'input' => array(
                        array(
                            'type' => 'text',
                            'name' => 'merge_oldnewsletter',
                            'label' => $this->l('Merge Newsletter Data'),
                            'size' => 20,
                            'required' => false,
                            'lang' => false
                        )
                    ),
                    // Submit Button
                    'submit' => array(
                        'title' => $this->l('Save'),
                        'name' => 'saveAutumnThemeConfig'
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
            'save' => array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
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

        // Load standard field values
        foreach ($this->_standardConfig as $key => $standardField) {
            $helper->fields_value[$standardField] = Configuration::get($standardField);
        }

        // Load css field values
        foreach ($this->_styleConfig as $key => $cssField) {
            $helper->fields_value[$cssField] = Configuration::get($cssField);
        }

        // Load multi-language field values
        foreach ($this->_multiLangConfig as $key => $multiLangField) {
            foreach ($languages as $language) {
                $helper->fields_value[$multiLangField][$language['id_lang']] = Tools::getValue($multiLangField.'_'.$language['id_lang'], Configuration::get($multiLangField, $language['id_lang']));
            }
        }

        // MERGE OPTIONS
        //Check stuff for merge
        $oldNewsletterTableExists = false;
        if (Module::isInstalled('autumnnewsletterblock')){
            $oldNewsletterTableExists = WPAutumnModel::checkAutumnNewsletterTable();
        }
        $newsletterInstalled = Module::isInstalled('blocknewsletter');

        // Custom variables
        $helper->tpl_vars = array(
            'oldNewsletterTableExists' => $oldNewsletterTableExists,
            'newsletterInstalled' => $newsletterInstalled,
            'imagePath' => _MODULE_DIR_ . $this->name . '/views/img/front/bg/',
            'shopId' => $id_shop
        );

        return $helper->generateForm($fields_form);
    }

    /* ------------------------------------------------------------- */
    /*  WRITE CSS
    /* ------------------------------------------------------------- */
    private function _writeCss()
    {
        $id_shop = $this->context->shop->id;

        $cssFile = _PS_MODULE_DIR_ . $this->name . '/views/css/front/configCss-' . $id_shop . '.css';
        $handle = fopen($cssFile, 'w');

        $config = $this->_getThemeConfig();

        // Make sure the css file wont be empty, otherwise it will throw a not found error in the browser
        // So, I put some initial stuff in it.
        $cssCode = 'body{ }';

        // Read _cssConfig and create css rules
        foreach ($this->_cssConfig as $configName => $css) {

            // First, check if the config is set, otherwise we dont need to
            // create a css rules for that particular config
            if ($config[$configName] != '') {

                foreach ($css as $line) {
                    $cssCode .= $line['selector'] . '{' . $line['rule'] . ':' .  (isset($line['prefix']) ? $line['prefix'] : '' ) . (isset($line['value']) ? $line['value'] : $config[$configName]) . (isset($line['suffix']) ? $line['suffix'] : '' ) . ';}';
                }

            }

        }

        $response = fwrite($handle, $cssCode);

        return $response;

    }

    /* ------------------------------------------------------------- */
    /*  GET THEME CONFIG
    /* ------------------------------------------------------------- */
    private function _getThemeConfig($standard = true, $style = true, $multiLang = true)
    {
        $id_default_lang = $this->context->language->id;

        $config = array();

        if ($standard) {
            foreach ($this->_standardConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem);
            }
        }

        if ($style) {
            foreach ($this->_styleConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem);
            }
        }

        if ($multiLang) {
            foreach ($this->_multiLangConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem, $id_default_lang);
            }
        }

        return $config;
    }

    /* ------------------------------------------------------------- */
    /*  MERGE OLD NEWSLETTER
    /* ------------------------------------------------------------- */
    private function _mergeOldNewsletter()
    {
        $oldNewsletterTableExists = WPAutumnModel::checkAutumnNewsletterTable();
        $newsletterInstalled = Module::isInstalled('blocknewsletter');

        if ($oldNewsletterTableExists && $newsletterInstalled) {
            $wpAutumn = new WPAutumnModel();
            $response = $wpAutumn->mergeOldNewsletterContent();

            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules').'&configure=wpautumn');
        }

        return false;
    }


    /* ------------------------------------------------------------- */
    /*
    /*  FRONT-OFFICE STUFF
    /*
    /* ------------------------------------------------------------- */

    /* ------------------------------------------------------------- */
    /*  PREPARE PRODUCT NAVIGATIONS
    /* ------------------------------------------------------------- */
    private function _prepProductNav()
    {
        $controller_name = Dispatcher::getInstance()->getController();
        $id_lang = $this->context->language->id;

        // First make sure we have all the stuff we need, so we can get the next/prev product links
        if ( $controller_name != 'product' || !Tools::getIsset('id_product') ){
            return false;
        }

        $id_product = Tools::getValue('id_product');
        $product = new Product($id_product, false, $id_lang);

        if ( !isset($this->context->cookie->last_visited_category) ||
            ( isset($this->context->cookie->last_visited_category) && $this->context->cookie->last_visited_category == '' ) ||
            !Product::idIsOnCategoryId($id_product, array('0' => array('id_category' => $this->context->cookie->last_visited_category))))
        {
            $id_category = $product->id_category_default;
        } else {
            $id_category = $this->context->cookie->last_visited_category;
        }

        $productPos = WPAutumnModel::findProductPos($id_category, $id_product);
        if (!is_int($productPos)) {
            return false;
        }

        $prevProductID = WPAutumnModel::getProductIdFromPos($id_category, $productPos - 1);
        if (!is_int($prevProductID)) {
            $prevProductLink = 'firstItem';
        } else {
            $prevProduct = new Product($prevProductID, false, $id_lang);
            $prevProductLink = $this->context->link->getProductLink($prevProduct);
        }

        $nextProductID = WPAutumnModel::getProductIdFromPos($id_category, $productPos + 1);
        if (!is_int($nextProductID)) {
            $nextProductLink = 'lastItem';
        } else {
            $nextProduct = new Product($nextProductID, false, $id_lang);
            $nextProductLink = $this->context->link->getProductLink($nextProduct);
        }

        return array(
                    'prev' => $prevProductLink,
                    'next' => $nextProductLink
        );

    }

    /* ------------------------------------------------------------- */
    /*  PREPARE FOR HOOK
    /* ------------------------------------------------------------- */
    private function _prepHook($params)
    {
        $config = $this->_getThemeConfig();
        $controller_name = Dispatcher::getInstance()->getController();

        if ($config){
            foreach ($config as $key => $value){

                //Check cookies for category view type option
                if ($key == 'WPAC_categoryViewType') {
                    if (isset($this->context->cookie->category_view_type)) {
                        $this->smarty->assignGlobal($key, $this->context->cookie->category_view_type);
                        continue;
                    }
                }

                $this->smarty->assignGlobal($key, $value);
            }
        }

        /* WPAC_productNav */
        if (Configuration::get('WPAC_enableProductNav') == 1) {
            $productNavLinks = $this->_prepProductNav();
            if ($productNavLinks) {
                $this->smarty->assignGlobal('WPAC_productNavLinks', $productNavLinks);
            }
        }

        /* GLOBAL SMARTY VARS */

        /* Mobile menu my account */
        $has_address = $this->context->customer->getAddresses($this->context->language->id);
        $this->smarty->assignGlobal('WPMM_has_customer_an_address', empty($has_address));
        $this->smarty->assignGlobal('WPMM_voucherAllowed', CartRule::isFeatureActive());
        $this->smarty->assignGlobal('WPMM_returnAllowed', (int)Configuration::get('PS_ORDER_RETURN'));
        $this->smarty->assignGlobal('WPMM_HOOK_CUSTOMER_ACCOUNT', Hook::exec('displayCustomerAccount'));

        /* Mobile device detection */
        if ($this->context->mobile_detect->isTablet()){
            $this->smarty->assignGlobal('WPAC_device', 'tablet');
        } elseif ($this->context->mobile_detect->isMobile()){
            $this->smarty->assignGlobal('WPAC_device', 'mobile');
        } else {
            $this->smarty->assignGlobal('WPAC_device', 'desktop');
        }

        /* LOAD JS */

        // Load custom JS files
        $this->context->controller->addJqueryPlugin('plugins', _THEME_JS_DIR_ . 'autumn/');

        if (Module::isInstalled('blocklayered') && Module::isEnabled('blocklayered') && $controller_name == 'category') {
            $this->context->controller->addJqueryPlugin('ui.touch-punch.min', _THEME_JS_DIR_ . 'autumn/');
        }

        $this->context->controller->addJqueryPlugin('autumn', _THEME_JS_DIR_ . 'autumn/');

        return true;
    }


    /* ------------------------------------------------------------- */
    /*  HOOK (displayHeader)
    /* ------------------------------------------------------------- */
    public function hookDisplayHeader($params)
    {
        $this->_prepHook($params);
    }

    /* ------------------------------------------------------------- */
    /*  HOOK (displayFooter)
    /* ------------------------------------------------------------- */
    public function hookDisplayFooter($params)
    {
        $id_shop = $this->context->shop->id;

        /* We are loading css files in this hook, because
         * this is the only way to make sure these css files
         * will override any other css files.. Otherwise
         * module positioning will cause a lot of issues.
         */

        /* LOAD CSS */

        // Load custom CSS files
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'wp_framework/reset.css');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'wp_framework/layout.css');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'wp_framework/normalize.css');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'wp_framework/iconfont.css');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'autumn.css');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'wp_framework/responsive.css');

        // DO NOT MOVE THIS -> see the file for more information
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'jquery_plugins/jquery.plugins.css');
        // DO NOT MOVE THIS

        // Load auto-created css files
        $cssFile = 'configCss-' . $id_shop . '.css';
        if (file_exists(_PS_MODULE_DIR_ . $this->name . '/views/css/front/' . $cssFile)) {
            $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/front/' . $cssFile);
        }

        // Load custom.css file
        //$this->context->controller->addCSS(_THEME_CSS_DIR_ . 'custom.css');

        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'custom-final-base.css');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'custom-final-otherfiles.css');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'custom-final-check.css');

        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'buttons.css');

    }

    /* ------------------------------------------------------------- */
    /*  SCRIPT FOR hookQuickImageViewer
    /* ------------------------------------------------------------- */
    private function _quickImageScript()
    {
        $quickImageViewerScript = '
            <script type="text/javascript">
                $(window).load(function(){
                    if (WPAC_quickImageViewer == 1){
                        $(".item-images").each(function () {
                            initQuickImageViewer($(this));
                        });
                    }
                });
            </script>

        ';
        return $quickImageViewerScript;
    }

    /* ------------------------------------------------------------- */
    /*  CUSTOM HOOK (hookQuickImageViewer)
    /* ------------------------------------------------------------- */
    public function hookQuickImageViewer($params)
    {
        echo $this->_quickImageScript();
    }

}
