<?php
/**
 * Facebook Conversion Pixel Tracking Plus
 *
 * NOTICE OF LICENSE
 *
 * @author    Pol Rué
 * @copyright Smart Modules 2014
 * @license   One time purchase Licence (You can modify or resell the product but just one time per licence)
 * @version 1.8.0
 * @category Marketing & Advertising
 * Registered Trademark & Property of Smart-Modules.pro
 *
 * **************************************************
 * *     Facebook Conversion Trackcing Pixel Plus    *
 * *          http://www.smart-modules.pro           *
 * *                     V 1.8.0                     *
 * **************************************************
 *
 * Versions:
 * 1.0 First release. After the succes of his younger Brother the Facebook Conversion Pixel we have released the Facebook Conversion Trackcing Pixel Plus, the ultimate conversion tracking module for Facebook Ads
 * 1.0.1 Added some modifications
 * 1.1.0 Bug fixed and better code
 * 1.1.1 Improved add to cart code
 * 1.2.0 Added support for Custom Audiences
 * 1.3.0 Works with new Facebook's Pixel Code
 * 1.3.1 Added new functionalities (track addToWishlist, StartCheckout, Start Payment)
 * 1.3.2 Better global searches tracking
 * 1.4.0 Added Single Product Tracking
 * 1.5.0 Added Dynamic Product Ads Code
 * 1.5.1 Better Compatibility for Dynamic Products for PrestaShop 1.5.X versions
 * 1.5.2 Small bugs fixed better value detection for dynamic products
 * 1.5.3 Added Product Catalogue ID for better compatibility with multlang feeds
 * 1.5.4 Bugs fixed
 * 1.5.5 Added Conversion Tests
 * 1.5.6 Added Prefix for IDs in catalogue
 * 1.5.7 Fixed keypage bugs on 1.5.X versions
 * 1.5.8 Added support for onepagecheckout module
 * 1.5.9 Bug fixed with prefix
 * 1.6.0 Added more options for customization
 * 1.6.0 Added prefix for combinations
 * 1.6.0 Added combination detect on default scheme using themes. Some themes may need customizations
 * 1.6.1 Better themes support for addToCart event
 * 1.6.2 Bug fixing, imrpoved combinatios
 * 1.6.3 Better Product detection, bugs fixed
 * 1.6.4 Code optimization
 * 1.6.4 Added new event ViewCategory
 * 1.6.4 Modified search event with more options to meet new Facebook standards
 * 1.6.5 Minor bug fixing
 * 1.6.6 Minor fixes in addtocart event
 * 1.6.7 Better conversion detection
 * 1.6.8 Comptabibility Improvements for Product Feeds
 * 1.6.9 Minor bug fixes
 * 1.7.0 Added multiple addToCart event calls from one page (ie. category or search view)
 * 1.7.1 Recoded addToCart procedure for non ajax settings.
 * 1.7.2 New advanced options, force pixels on header for non standard themes
 * 1.7.3 small bug fix on search events
 * 1.7.4 Better compatibility for PS 1.5.X versions
 * 1.7.5 Improved order process for 1.7
 * 1.7.6 Improved performance on orders tracking
 * 1.7.7 Issue Fixed on tracking with one page checkout ps module
 * 1.7.8 Added Polish Translation
 * 1.7.8 Added Dutch Translation
 * 1.7.8 Added German Translation
 * 1.7.8 Added Portuguese Translation
 * 1.7.9 Added Italian Translation
 * 1.7.9 Added Russian Translation
 * 1.8.0 Added custom add to cart button option
 * 1.8.0 Added ajax order confirmation procedure option
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
class FacebookConversionTrackingPlus extends Module
{
    private $_html = '';
    public $type = '';
    public $pixelparams = '';
    private $pixels = array();
    private $extras_type = '';
    public function __construct()
    {
        $this->name = 'facebookconversiontrackingplus';
        $this->tab = 'advertising_marketing';
        $this->version = '1.8.0';
        $this->author = 'Smart Modules';
        $this->need_instance = 0;
        $this->module_key = '3e316ca70bb2494f37010fc46feb2f4d';
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Facebook Conversion Tracking Pixel Plus');
        $this->description = $this->l('Multiple Facebook Conversion Tracking Pixels: Checkouts, Registrations, Leads, Keypages, all Facebook Conversion Tracking Pixels in one module... Multi-Pixel Ready');
        $this->type = array(
            1 => $this->l('Key Page'));
        $this->extras_type = array (
            1 => 'index',
            2 => 'category',
            3 => 'product',
            //4 => 'search',
            4 => 'cms',
            5 => 'contact');
        $this->extras_type_lang = array (
            1 => $this->l('Index'),
            2 => $this->l('Category'),
            3 => $this->l('Product'),
            //4 => $this->l('Search'),
            4 => $this->l('CMS'),
            5 => $this->l('Contact'));
        $this->pixelparams = array( 'pixel_active' => '0', 'pixel_name' => '', 'pixel_extras' => '', 'pixel_extras_type' => '', 'pixel_extras_name' => '');
        $this->_file = array(1 => 'export-customers.csv', 2 => 'export-newsletter.csv', 3 => 'export-all.csv');
        $this->confirmUninstall = $this->l('Are you sure about removing all your Facebook Pixels?');
        /* Backward compatibility */
        if (_PS_VERSION_ < '1.5') {
            require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
        }
    }
    public function install()
    {
        include(dirname(__FILE__).'/sql/install.php');
        if (!parent::install()
        || !$this->registerHook('actionCustomerAccountAdd')
        || !$this->registerHook('createAccount')
        || !$this->registerHook('header')
        || !$this->registerHook('displayHeader')
        || !$this->registerHook('displayFooter')
        || !$this->registerHook('actionCartSave')
        || !$this->registerHook('orderConfirmation')
        || !$this->registerHook('paymentReturn')
        || !$this->registerHook('actionAdminControllerSetMedia')
        || !$this->registerHook('actionValidateOrder')) {
            return false;
        }
        Configuration::updateValue('pixel_account_on', '');
        Configuration::updateValue('FCTP_CONV', 1);
        Configuration::updateValue('FCTP_ADD_TO_CART', 1);
        Configuration::updateValue('FCTP_REG', 1);
        Configuration::updateValue('FCTP_SEARCH', 1);
        Configuration::updateValue('FCTP_CATEGORY', 1);
        Configuration::updateValue('FCTP_SEARCH_ITEMS', 1);
        Configuration::updateValue('FCTP_CATEGORY_ITEMS', 1);
        Configuration::updateValue('FCTP_CATEGORY_TOP_SALES', 1);
        Configuration::updateValue('FCTP_WISH', 1);
        Configuration::updateValue('FCTP_START', 1);
        Configuration::updateValue('FCTP_START_ORD', 1);
        Configuration::updateValue('FCTP_DYNAMIC_ADS', 1);
        Configuration::updateValue('FCTP_PIXEL_ID', '1');
        Configuration::updateValue('FCTP_VIEWED', '1');
        Configuration::updateValue('FCTP_FORCE_HEADER', '0');
        Configuration::updateValue('FCTP_AJAX', '1');
        Configuration::updateValue('FCTP_DEEP_CHECK', '0');
        Configuration::updateValue('FCP_CUST_ADD_TO_CART', '');
        return true;
    }
    public function uninstall($delete = false)
    {
        if ($delete == true) {
            include(dirname(__FILE__).'/sql/uninstall.php');
        }
        Configuration::deleteByName('pixel_account_on');
        Configuration::deleteByName('FCTP_CONV');
        Configuration::deleteByName('FCTP_ADD_TO_CART');
        Configuration::deleteByName('FCTP_REG');
        Configuration::deleteByName('FCTP_SEARCH');
        Configuration::deleteByName('FCTP_CATEGORY');
        Configuration::deleteByName('FCTP_SEARCH_ITEMS');
        Configuration::deleteByName('FCTP_CATEGORY_ITEMS');
        Configuration::deleteByName('FCTP_CATEGORY_TOP_SALES');
        Configuration::deleteByName('FCTP_WISH');
        Configuration::deleteByName('FCTP_START');
        Configuration::deleteByName('FCTP_START_ORD');
        Configuration::deleteByName('FCTP_PIXEL_ID');
        Configuration::deleteByName('FCTP_DYNAMIC_ADS');
        Configuration::deleteByName('FCTP_VIEWED');
        Configuration::deleteByName('FCTP_FORCE_HEADER');
        Configuration::deleteByName('FCP_CUST_ADD_TO_CART');
        Configuration::deleteByName('FCTP_AJAX');
        Configuration::deleteByName('FCTP_DEEP_CHECK');

        return parent::uninstall();
    }
    public function reset()
    {
        if (!$this->uninstall(false)) {
            return false;
        }
        if (!$this->install()) {
            return false;
        }
        return true;
    }
    public function getContent()
    {
        // Initialize var
        $js = '';
        $css = '';
          /* Check custom auciences customer generation CSV folder permissions */
        if (!is_writable(dirname(__FILE__).'/csv/')) {
            $this->context->controller->errors[] = Tools::displayError($this->l('Please make').' /modules/'.$this->name.'/csv/ '.$this->l('folder writable'));
        }
        $this->context->controller->addJS(dirname(__FILE__).'views/js/download.js');
          // If it's a submit
        if (Tools::isSubmit('add'.$this->name)) {
            return $this->createNewPixel().$this->newpixelJS();
        } elseif (Tools::isSubmit('update'.$this->name)) {
            return $this->createNewPixel(Tools::getValue('id_facebookpixels')).$this->newpixelJS();
        } else {
            // Show the basic configuration page
            // Check if Blocknewsletter Module is activated
            if (Module::isEnabled('blocknewsletter')) {
                $this->context->smarty->assign('newsletter', 1);
            } else {
                $this->context->smarty->assign('newsletter', 0);
            }

            if (version_compare(_PS_VERSION_, '1.6', '<')) {
                // It's 1.5.X
                $css = '<style media="all">#content label { float:none} </style>';
                $this->context->smarty->assign(array('oldps' => 1));
            } else {
                $this->context->smarty->assign(array('oldps' => 0));
            }


            $this->context->smarty->assign('myurl', $this->getCurrentUrl());
            $this->context->smarty->assign('mytoken', Tools::getAdminTokenLite('AdminModules'));
            if (Configuration::get('FCTP_PIXEL_ID') != '') {
                $this->context->smarty->assign(array('fctpid' => Configuration::get('FCTP_PIXEL_ID')));
                $this->context->smarty->assign('pixelsetup', 1);
            }
            $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configuration.tpl');
            if (Tools::isSubmit('submit'.$this->name)) {
                $this->postProcess();
                if (version_compare(_PS_VERSION_, '1.6', '<')) {
                    // For 1.5 and below, redirect to avoid conflicts
                    $redUrl = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').$_SERVER['SERVER_NAME'].__PS_BASE_URI__.basename(_PS_ADMIN_DIR_).'/index.php?controller=AdminModules&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules');
                    Tools::redirect($redUrl);
                }
            }
            if (Tools::isSubmit('submitnewpixel')) {
                $validation = $this->validatenewpixelform();
                if ($validation['ok'] == true) {
                    $output .= $validation['output'];
                } else {
                    return $validation['output'].$this->createNewPixel(Tools::getValue('id_facebookpixels')).$this->newpixelJS();
                }
            }
            if (Tools::isSubmit('delete'.$this->name)) {
                $output .= $this->deletepixel();
            }
            if (Tools::isSubmit('status'.$this->name)) {
                $output .= $this->statuspixel();
            }

            // Generate the basic Pixel configuration
            $output .= $this->getBasicForm();
            $output_bottom = '<div class=\'panel\'>';
            $output_bottom .= '<p><e>'.$this->l('This module allows to optimize Facebook campaigns to leads').'<br />'.$this->l('To get a new code or to recover it enter to ').'<a href=\'https://www.facebook.com/ads/manage/convtrack.php\' target=\'_blank\' title=\'Create a Conversion Tracking Pixel\' >'.$this->l('Facebook Ads Manager').'</a>. '.$this->l('Once you have it copy and paste it here').'</e></p>';
            $output_bottom .= '<p>'.$this->l('If you want to test your pixels you can install the').' <a href=\'https://chrome.google.com/webstore/detail/fb-pixel-helper/fdgfkebogiimcoedlicjlajpkdmockpc?hl=en&gl=US&authuser=1\' target=\'_blank\'>'.$this->l('Pixel Helper').'</a>. '.$this->l('A Google Chrome\'s extension to Test the Facebook Conversions Pixels').'.</p>';
            $output_bottom .= '</div>';
            // Check if requiested to generate a CSV customer list
            if (Tools::getValue('typexp') != '') {
                $typexp = Tools::getValue('typexp');
            }
            if (!empty($typexp)) {
                $token = Tools::getAdminTokenLite('AdminModules');
                if ($this->getProcess($typexp) == true) {
                    $url = '/modules/facebookconversiontrackingplus/download.php?typexp='.(int)Tools::getValue('typexp').'&token='.$token;
                    $js = '<script type="text/javascript">
                    $(document).ready(function() {
                        $.ajax({
                            type: \'POST\',
                            url: "'.$url.'",
                            success: function(data){
                                  if (data == true){
                                    alert(\'This file is not available for download.\');
                                  }else{
                                    window.location ="'.$url.'";
                                  }
                            }
                        })
                    });
                    </script>';
                }
            }
            return $output.$js.$this->displayExistingPixels().$output_bottom.$css;
        }
    }
    /**
    * Save the form data.
    */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();
        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, trim(Tools::getValue($key)));
        }
    }
    public function newpixelJS()
    {
        $js = '
        <script type=\'text/javascript\'>
        $(document).ready(function() {
            var tmpval = \'0.0\';
            $(\'#pixel_code\').bind(\'input propertychange\', function()
            {
                var text = $(this).val();
                var p= text.indexOf(\'?ev=\')+4;
                var q= text.indexOf(\'&amp;\');
                text = text.substr(text.indexOf(\'?ev=\')+4,text.indexOf(\'&amp;\')-(text.indexOf(\'?ev=\')+4))
                if (text != \'\' && !isNaN(text))
                {
                    $(\'#id_pixel\').val(text);
                }
                else
                {
                    text=get_id_pixel(text);
                }
            });';
        if (version_compare(_PS_VERSION_, '1.6', '>=')) {
            $js .= '// Initialize Form Extra Options
                if ($(\'#pixel_type\').val() != 1)
                {
                    $(\'#pixel_extras\').parent().parent().hide();
                    $(\'#pixel_extras_type\').parent().parent().hide();
                    if ($(\'#pixel_type\').val() == 1)
                    {
                        tmpval = $(\'#pixel_value\').val();
                        $(\'#pixel_value\').val(\''.$this->l('Automatic Value').'\');
                        $(\'#pixel_value\').attr(\'disabled\',\'disabled\');
                        $(\'#pixel_value\').disabled = true;
                    }
                    if ($(\'#pixel_extras_type\').val() == 1 || $(\'#pixel_extras_type\').val() == 6)
                    {
                        $(\'#pixel_extras\').parent().parent().hide();
                    }
                }
                $(\'#pixel_value\').focusout(function() {
                    var value;
                    value = $(this).val();
                    value = $(this).val().split(\',\').join(\'.\');
                    value = parseFloat(value).toFixed(2);
                    if (isNaN(value) && $(\'#pixel_type\').val() != 1)
                    {
                        alert(\''.$this->l('Error: Value must be a number').'\');
                        $(this).val(\'0.0\');
                    }
                    else
                        $(this).val(value);
                });';
            $js .= '
                update_extras($(\'#pixel_extras_type\'));
                $(\'#pixel_extras_type\').change(function()
                {
                         update_extras($(this));
                });
                    function update_extras(element) {
                         if (element.val() == 1 || element.val() == 6)
                    {
                        $(\'#pixel_extras\').parent().parent().hide();
                    }
                    else if (element.val() == 4)
                    {
                        $(\'#pixel_extras\').parent().parent().show();
                        $(\'#pixel_extras\').parent().prev().html(\''.$this->l('Enter a Search string to track').'\');
                    }
                    else
                    {
                        $(\'#pixel_extras\').parent().parent().show();
                        $(\'#pixel_extras\').parent().prev().html(\''.$this->l('Enter the ID of the Key page you want to track').'\');
                    }
                }';
        } else {
            // PS < 1.6
            $js .= '
            //Initialize the Pixel Extras
                update_extras($(\'#pixel_extras_type\'));
                $(\'#pixel_extras_type\').change(function()
                {
                         update_extras($(this));
                });
                function update_extras(element) {
                    if (element.val() == 1 || element.val() == 5) {
                        //$(\'#pixel_extras\').parent().parent().hide();
                        $(\'#pixel_extras\').parent().hide();
                        $(\'#pixel_extras\').parent().prev().hide();
                    }
                    else { 
                        $(\'#pixel_extras\').parent().show();
                        $(\'#pixel_extras\').parent().prev().show();
                        $(\'#pixel_extras\').parent().prev().html(\''.$this->l('Enter the ID of the Key page you want to track').'\');
                    }
                }';
        }
        $js .= '});
        </script>';
        return $js;
    }

    /** List Items Creation **/
    public function displayExistingPixels()
    {
        $this->fields_list = array();
        $this->fields_list['id_facebookpixels'] = array(
                'title' => $this->l('ID'),
                'type' => 'int',
                'search' => false,
                'orderby' => false,
            );
        /*$this->fields_list['id_pixel'] = array(
                'title' => $this->l('Pixel Identifier'),
                'type' => 'int',
                'search' => false,
                'orderby' => false,
            );*/
        $this->fields_list['pixel_active'] = array(
                'title' => $this->l('Active'),
                'type' => 'bool',
                'search' => false,
                'orderby' => false,
                'align' => 'text-center',
                'active' => 'status',
            );
        $this->fields_list['pixel_name'] = array(
                'title' => $this->l('Name'),
                'type' => 'text',
                'search' => false,
                'orderby' => false,
            );
        $this->fields_list['pixel_type'] = array(
                'title' => $this->l('Type'),
                'type' => 'text',
                'search' => false,
                'orderby' => false,
            );
        $this->fields_list['pixel_extras_name'] = array(
                'title' => $this->l('What to track'),
                'type' => 'text',
                'search' => false,
                'orderby' => false,
            );
        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->simple_header = false;
        $helper->identifier = 'id_facebookpixels';
        $helper->actions = array('edit', 'delete');
        $helper->show_toolbar = true;
        $helper->imageType = 'jpg';
        $helper->toolbar_btn['new'] = array(
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&add'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Add new Pixel')
        );
        $helper->title = $this->l('Keypage Views and Searches'); //.' - '.$this->displayName;
        $helper->table = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $content = $this->getListContent($this->context->language->id);
        $helper->listTotal = count($content);

        return $helper->generateList($content, $this->fields_list);
    }

    protected function getListContent($id_lang = null)
    {
        if (is_null($id_lang)) {
            $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        }
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'facebookpixels`';
        $content = Db::getInstance()->executeS(pSQL($sql));
        $contentsize = count($content);
        for ($i = 0; $i < $contentsize; $i++) {
            $content[$i]['pixel_type'] = $this->extras_type_lang[$content[$i]['pixel_extras_type']];
        }
        return $content;
    }
    /** End List **/
    public function createNewPixel()
    {
        $select_options = array();
        $extra_options = array();
        $types = count($this->type);
        $extras = count($this->extras_type);
        for ($i = 1; $i < $types + 1; $i++) {
            $select_options[] = array('id_option' => $i, 'name' =>$this->type[$i]);
        }
        for ($i = 1; $i < $extras + 1; $i++) {
            $extra_options[] = array('id_extra_option' => $i, 'extra' =>$this->extras_type_lang[$i]);
        }
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Add New Conversion Tracking Pixel'),
                    'icon' => 'icon-plus',
                ),
                'input' => array(
                    array(
                        'label' => $this->l('Pixel Status'),
                        'type' => 'radio',
                        'name' => 'pixel_active',
                        'required' => true,
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'pixel_active_on',
                                'value' => 1,
                                'label' => $this->l('Active')),
                            array(
                                'id' => 'pixel_active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled'))
                        ),
                    ),
                    array(
                        'label' => $this->l('Pixel Name').' ('.$this->l('optional').')',
                        'type' => 'text',
                        'name' => 'pixel_name',
                        'placeholder' => $this->l('Write a name that describes your pixel'),
                    ),
                    array(
                        'label' => $this->l('Type of Pixel'),
                        'type' => 'select',
                        'class' => '',
                        'name' => 'pixel_type',
                        'options' => array(
                            'query' => $select_options,
                            'id' => 'id_option',
                            'name' =>'name',
                        )
                    ),
                    /*array(
                        'label' => $this->l('Pixel\'s Value'),
                        'type' => 'text',
                        'name' => 'pixel_value',
                    ),*/
                    array(
                        'label' => $this->l('KeyPage Type'),
                        'type' => 'select',
                        'class' => '',
                        'name' => 'pixel_extras_type',
                        'options' => array(
                            'query' => $extra_options,
                            'id' => 'id_extra_option',
                            'name' =>'extra',
                        )
                    ),
                    array(
                        'label' => $this->l('Key page identifier'),
                        'type' => 'text',
                        'name' => 'pixel_extras',
                        'placeholder' => $this->l('Enter the ID of the Key page you want to track'),
                        'required' => true,
                              'desc' => $this->l('To know the ID go to Porduct/Category/CMS list and copy the first column parameter "ID" of the desired element, and copy it here.'),
                    ),
                    array(
                        'type' => 'hidden',
                        'name' => 'id_facebookpixels',
                    ),
                    array(
                        'type' => 'hidden',
                        'name' => 'pixel_extras_name',
                    ),
                ),
                'buttons' => array(
                    array(
                    'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
                    'title' => $this->l('Back to list'),
                    'icon' => 'process-icon-back'
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'name' => 'submitnewpixel',
                    'id' => 'submitnewpixel'
                )
            )
        );
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->id = (int)Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitnewpixel';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        $fields_values = $this->getPixels(Tools::getValue('id_facebookpixels'));
        if ($fields_values != false) {
            foreach ($fields_values[0] as $key => $value) {
                if ($value != '' || isset($value)) {
                    $helper->fields_value[$key] = $value;
                } else {
                    $helper->fields_value[$key] = Tools::getValue($key);
                }
            }
             $helper->fields_value['pixel_code'] = Tools::getValue('pixel_code');
        } else { // Es un pixel nou o es error
            $helper->fields_value['pixel_active'] = Tools::getValue('pixel_active', 1);
            $helper->fields_value['pixel_name'] = Tools::getValue('pixel_name');
            $helper->fields_value['pixel_value'] = (float)Tools::getValue('pixel_value');
            $helper->fields_value['pixel_extras'] = Tools::getValue('pixel_extras');
            $helper->fields_value['pixel_type'] = Tools::getValue('pixel_type');
            $helper->fields_value['pixel_code'] = Tools::getValue('pixel_code');
            $helper->fields_value['id_pixel'] = Tools::getValue('id_pixel');
            $helper->fields_value['pixel_extras_type'] = Tools::getValue('pixel_extras_type');
            $helper->fields_value['id_facebookpixels'] = Tools::getValue('id_facebookpixels');
            $helper->fields_value['pixel_extras_name'] = Tools::getValue('pixel_extras_name', '');
        }
        $css = '<style media=\'screen\'>#fieldset_0 textarea, #fieldset_0 input, #fieldset_0 select { width:50% !important;} #fieldset_0 .radio input { width:auto !important; } '.(version_compare(_PS_VERSION_, '1.6', '<=') ? 'label[for=pixel_active_on], label[for=pixel_active_off], input#pixel_active_on,input#pixel_active_off { width:auto !important; float:none; }' : '').'</style>';
        return $helper->generateForm(array($fields_form)).$css;
    }

    private function getBasicForm()
    {
        $langs = Language::getLanguages();
        $shops = Shop::getShops();
        $fields_value = array();
        $switch_options = array(
               array(
                    'id' => 'active_on',
                    'value' => 1,
                    'label' => $this->l('Enabled')
               ),
               array(
                    'id' => 'active_off',
                    'value' => 0,
                    'label' => $this->l('Disabled')
               ));
        $num_items_options = array();

        for ($i = 5; $i <= 10; $i++) {
            $num_items_options[] = array(
                'id_option' => $i,
                'name' => $i
            );
        }

        $select_options = array();
        $extra_options = array();
        $types = count($this->type);
        $extras = count($this->extras_type);
        for ($i = 1; $i < $types + 1; $i++) {
            $select_options[] = array('id_option' => $i, 'name' =>$this->type[$i]);
        }
        for ($i = 1; $i < $extras + 1; $i++) {
            $extra_options[] = array('id_extra_option' => $i, 'extra' =>$this->extras_type_lang[$i]);
        }
        $fields_form = array();
        $fields_form[] = array(
                    'form' => array(
                         'legend' => array(
                              'title' => $this->l('Facebook Pixel\'s ID'),
                              'icon' => 'icon-facebook',
                         ),
                         'input' => array(
                              array(
                                   'label' => $this->l('Pixel Identifier'),
                                   'type' => 'text',
                                   'name' => 'FCTP_PIXEL_ID',
                                   'desc' => $this->l('Here you have to put your Facebook\'s Pixel identifier, you can get it anytime from your ').' <a href="https://www.facebook.com/ads/manager/pixel/facebook_pixel/" title="'.$this->l('Facebook ads Manager').'" target="_blank">'.$this->l('Facebook ads Manager').'</a>',
                              ),
                         ),
                         'submit' => array(
                              'title' => $this->l('Save'),
                              'name' => 'submit'.$this->name,
                              'id' => 'submit'.$this->name),
                     ),
                );
          $fields_form[] = array(
               'form' => array(
                    'legend' => array(
                         'title' => $this->l('Basic Trackable events'),
                         'icon' => 'icon-facebook',
                    ),
                    'input' => array(
                         array(
                              'label' => $this->l('Track all Viewed Products'),
                              'type' => 'switch',
                              'name' => 'FCTP_VIEWED',
                              'desc' => $this->l('Enable this option to track all products viewed').'. '.$this->l('Product listings like category or search are excluded'),
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                         array(
                              'label' => $this->l('Track Categories'),
                              'type' => 'switch',
                              'name' => 'FCTP_CATEGORY',
                              'desc' => $this->l('Enable this option to track all categories viewed').'.',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                         array(
                              'label' => $this->l('Track Conversions'),
                              'type' => 'switch',
                              'name' => 'FCTP_CONV',
                              'desc' => $this->l('Enable this option to track all conversions made from your site').'.',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                         array(
                              'label' => $this->l('Track add to cart'),
                              'type' => 'switch',
                              'name' => 'FCTP_ADD_TO_CART',
                              'desc' => $this->l('Will trigger every time a user adds to cart an item').'.',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                         /*array(
                              'label' => $this->l('Add to cart Value'),
                              'type' => 'text',
                              'name' => 'FCTP_ADD_TO_CART_VALUE',
                              'desc' => $this->l('Set a value for your add to carts, can be 0').'.',
                         ),*/
                         array(
                              'label' => $this->l('Track Registrations'),
                              'type' => 'switch',
                              'name' => 'FCTP_REG',
                              'desc' => $this->l('Will trigger when a user registers to your site').'.',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),

                         /*array(
                              'label' => $this->l('Registration Value'),
                              'type' => 'text',
                              'name' => 'FCTP_REG_VALUE',
                              'desc' => $this->l('Set a value for getting a user registered on your store, can be 0').'.',
                         ),*/
                         array(
                              'label' => $this->l('Track Searches'),
                              'type' => 'switch',
                              'name' => 'FCTP_SEARCH',
                              'desc' => $this->l('Will trigger when a user registers does a search on your site').'.',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                         array(
                              'label' => $this->l('Add to Wishlist'),
                              'type' => 'switch',
                              'name' => 'FCTP_WISH',
                              'desc' => $this->l('Will trigger when a user adds to a wishlist an item').'.<br/>'.$this->l('It\'s mandatory to have the Prestashop\'s Block Wishlist Module activated for this to work'),
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                         /*array(
                              'label' => $this->l('Wishlist add Value'),
                              'type' => 'text',
                              'name' => 'FCTP_REG_VALUE',
                              'desc' => $this->l('Set a value for getting an item added to a whishlist, can be 0').'.',
                         ),*/
                         array(
                              'label' => $this->l('Start Order'),
                              'type' => 'switch',
                              'name' => 'FCTP_START_ORD',
                              'desc' => $this->l('Will trigger when a user starts the order\'s funnel process').' ('.$this->l('When a customer clicks on "Proceed to Checkout"').')',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                         /*array(
                              'label' => $this->l('Start order Value'),
                              'type' => 'text',
                              'name' => 'FCTP_START_ORD_VAL',
                              'desc' => $this->l('Set a value for a customer to start the checkout process, can be 0').'.',
                         ),*/
                         array(
                              'label' => $this->l('Start Payment'),
                              'type' => 'switch',
                              'name' => 'FCTP_START',
                              'desc' => $this->l('Will trigger when a user starts the order\'s payment process').' ('.$this->l('beta feature, it may not work with all payment methods').')',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),/*
                         array(
                              'label' => $this->l('Start Payment Value'),
                              'type' => 'text',
                              'name' => 'FCTP_REG_VALUE',
                              'desc' => $this->l('Set a value for an user to start introducind their payment data, can be 0').'.',
                         ),*/),
                    'submit' => array(
                         'title' => $this->l('Save'),
                         'name' => 'submit'.$this->name,
                         'id' => 'submit'.$this->name
                     ),
                ),
           );
        $fields_form[] = array(
               'form' => array(
                    'legend' => array(
                         'title' => $this->l('Additional options for events'),
                         'icon' => 'icon-cogs',
                    ),
                    'input' => array(
                        array(
                            'label' => $this->l('Search Results Items?'),
                            'type' => 'select',
                            'name' => 'FCTP_SEARCH_ITEMS',
                            'desc' => $this->l('Set up the number of items that will be sent to Facebook').' ('.$this->l('between 5 and 10').')',
                            'options' => array(
                                'query' => $num_items_options,
                                'id' => 'id_option',
                                'name' => 'name',
                            ),
                        ),
                        array(
                            'label' => $this->l('Category Results Items?'),
                            'type' => 'select',
                            'name' => 'FCTP_CATEGORY_ITEMS',
                            'desc' => $this->l('Set up the number of items that will be sent to Facebook').' ('.$this->l('between 5 and 10').')',
                            'options' => array(
                                'query' => $num_items_options,
                                'id' => 'id_option',
                                'name' => 'name',
                            ),
                        ),
                        array(
                            'label' => $this->l('Use Category Top sellers').' / '.$this->l('Use Category default listing'),
                            'type' => 'switch',
                            'name' => 'FCTP_CATEGORY_TOP_SALES',
                            'desc' => $this->l('Chosse yes if you want to send to Facebook the top selling products for dynamic ads').'<br />'.
                                      $this->l('Choose no if you want to send the products ordered by position inside the category'),
                            'is_bool' => true,
                            'values' => $switch_options
                        ),
                    ),
                    'submit' => array(
                         'title' => $this->l('Save'),
                         'name' => 'submit'.$this->name,
                         'id' => 'submit'.$this->name
                     ),
                ),
           );

        $fields_form[] = array(
               'form' => array(
                    'legend' => array(
                         'title' => $this->l('Advanced Options'),
                         'icon' => 'icon-alert',
                    ),
                    'input' => array(
                        array(
                            'label' => $this->l('Fore Pixels on Header'),
                            'type' => 'switch',
                            'name' => 'FCTP_FORCE_HEADER',
                            'desc' => $this->l('Disabled by default').'<br/>'.
                                      $this->l('The module tries to output the pixels on the footer of the page, this way the JS doesn\'t block the page render').', '.$this->l(' this way the customer feels the page loading faster and you will also improve your page\'s SEO').'<br />'.
                                      $this->l('Some themes and customizated pages doesn\'t have the footer hook, if it\'s your case enable this option').'.',
                            'is_bool' => true,
                            'values' => $switch_options,
                        ),
                        array(
                            'type' => 'text',
                            'label' => $this->l('Add To Cart custom selector'),
                            'name' => 'FCP_CUST_ADD_TO_CART',
                            'size' => 20,
                            'desc' => $this->l('If your theme has a customized add to cart button use this box to enter the jQuery selector/s'),
                        ),
                        array(
                            'label' => $this->l('Use Ajax to confirm the conversion is sent'),
                            'type' => 'switch',
                            'name' => 'FCTP_AJAX',
                            'desc' => $this->l('Disable it to work directly with database'),
                            'is_bool' => true,
                            'values' => $switch_options,
                        ),
                        array(
                            'label' => $this->l('Deep check for new orders?'),
                            'type' => 'switch',
                            'name' => 'FCTP_DEEP_CHECK',
                            'desc' => $this->l('Only for custom payment methods not using the standard method to create orders'),
                            'is_bool' => true,
                            'values' => $switch_options,
                        ),
                    ),
                    'submit' => array(
                         'title' => $this->l('Save'),
                         'name' => 'submit'.$this->name,
                         'id' => 'submit'.$this->name
                     ),
                ),
           );
        $fields_form[] = array(
               'form' => array(
                    'legend' => array(
                         'title' => $this->l('Dynamic Product Ads'), //' ('.$this->l('beta feature').')',  NOT BETA ANYMORE
                         'icon' => 'icon-facebook',
                    ),
                    'input' => array(
                         array(
                              'label' => $this->l('Enable Dynamic Product Ads?'),
                              'type' => 'switch',
                              'name' => 'FCTP_DYNAMIC_ADS',
                              'desc' => $this->l('To use product Ads is required to have').' '.$this->l('Track add to cart').', '.$this->l('and').' '.$this->l('Track Conversions').' '.$this->l('enabled. It\'s also required to have an uploaded Product Catalogue on Facebook with matching product ids.').'.',
                              'is_bool' => true,
                              'values' => $switch_options
                         ),
                    ),
                    'submit' => array(
                         'title' => $this->l('Save'),
                         'name' => 'submit'.$this->name,
                         'id' => 'submit'.$this->name
                     ),
                ),
           );
           

        foreach ($shops as $shop) {
            // Start with the Dynamic Product Ads options
            $fields = '';
            $fields[] = array(
                'type' => 'text',
                'label' => $this->l('Product identifier Prefix'),
                'name' => 'FPF_PREFIX_'.$shop['id_shop'],
                'size' => 20,
                'desc' => $this->l('If your feed does have a Prefix for IDs just enter it here').'. '.$this->l('Otherwise you can leave it blank').'.'
            );
            $fields[] = array(
                  'label' => $this->l('Enable combinations tracking?'),
                  'type' => 'switch',
                  'name' => 'FCTP_COMBI_'.$shop['id_shop'],
                  'is_bool' => true,
                  'values' => $switch_options
            );
            $fields[] = array(
                'type' => 'text',
                'label' => $this->l('Combinations Prefix'),
                'name' => 'FCTP_COMBI_PREFIX_'.$shop['id_shop'],
                'size' => 20,
                'desc' => $this->l('If you want to use the combinations tracking they will be added after the product Id, use this prefix to sepparate the actual ID from the combination ID').'. '.$this->l('Otherwise you can leave it blank').'.',
            );
            foreach ($langs as $lang) {
                $fields_value[] = 'FPF_'.$shop['id_shop'].'_'.$lang['id_lang'];
                // Init Fields form array
                $feed = Tools::getHttpHost(true).__PS_BASE_URI__.'modules/facebookproductsfeed/feeds/facebook-products-feed-shop-'.$shop['id_shop'].'-lang-'.$lang['id_lang'].'.xml';
                $fields[] = array(
                    'type' => 'text',
                    'label' => $this->l('Product Feed').' '.$this->l('in').' '.$lang['name'],
                    'name' => 'FPF_'.$shop['id_shop'].'_'.$lang['id_lang'],
                    'size' => 20,
                    'placeholder' => $this->l('Facebook\'s feed identifier'),
                    'desc' => $this->l('Enter the ID of the Product Catalogue from Facebook in order to work.').(Module::isInstalled('facebookproductsfeed') && Module::isEnabled('facebookproductsfeed') ? '<br /><span class="feed_lang" style="display:none">'.$lang['name'].'</span>'.'<a class="copyurl" href="#" data-feed="'.$feed.'">'.$this->l('Click here to show the URL of this feed').'</a>' : '').'
                    <br />'.$this->l('You can leave it empty if your shop only uses one language')
                );
            }
            // Generate a form for each Shop
            $fields_form[]['form'] = array(
                'legend' => array(
                    'title' => '<span class="shop_name">'.$shop['name'].'</span> '.$this->l('Facebook Products Feeds'),
                ),
                'input' => $fields,
                'submit' => array(
                    'title' => $this->l('Save Configuration'),
                    'name' => 'submit'.$this->name,
                    'id' => 'submit'.$this->name,
                    'class' => 'button'
                )
            );
        }
        // Retrocompatibility for Switch in Prestashop 1.5
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            foreach ($fields_form as &$form) {
                foreach ($form['form']['input'] as &$input) {
                    if ($input['type'] == 'switch') {
                        $input['type'] = 'radio';
                    }
                }
            }
        }
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submit'.$this->name;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );
          // Generate the FORM
          return $helper->generateForm($fields_form);
    }
    public function getConfigFormValues()
    {
        $form_values = array(
            'FCTP_CONV' => Configuration::get('FCTP_CONV'),
            'FCTP_ADD_TO_CART' => Configuration::get('FCTP_ADD_TO_CART'),
            'FCTP_REG' => Configuration::get('FCTP_REG'),
            'FCTP_SEARCH' => Configuration::get('FCTP_SEARCH'),
            'FCTP_CATEGORY' => Configuration::get('FCTP_CATEGORY'),
            'FCTP_SEARCH_ITEMS' => Configuration::get('FCTP_SEARCH_ITEMS'),
            'FCTP_CATEGORY_ITEMS' => Configuration::get('FCTP_CATEGORY_ITEMS'),
            'FCTP_CATEGORY_TOP_SALES' => Configuration::get('FCTP_CATEGORY_TOP_SALES'),
            'FCTP_WISH' => Configuration::get('FCTP_WISH'),
            'FCTP_START' => Configuration::get('FCTP_START'),
            'FCTP_START_ORD' => Configuration::get('FCTP_START_ORD'),
            'FCTP_PIXEL_ID' => Configuration::get('FCTP_PIXEL_ID'),
            'FCTP_DYNAMIC_ADS' => Configuration::get('FCTP_DYNAMIC_ADS'),
            'FCTP_VIEWED' => Configuration::get('FCTP_VIEWED'),
            'FCTP_FORCE_HEADER' => Configuration::get('FCTP_FORCE_HEADER'),
            'FCP_CUST_ADD_TO_CART' => Configuration::get('FCP_CUST_ADD_TO_CART'),
            'FCTP_AJAX' => Configuration::get('FCTP_AJAX'),
            'FCTP_DEEP_CHECK' => Configuration::get('FCTP_DEEP_CHECK'),
        );
        $langs = Language::getLanguages();
        $shops = Shop::getShops();
        foreach ($shops as $shop) {
            $more_values = array(
                'FCTP_COMBI_'.$shop['id_shop'] => Configuration::get('FCTP_COMBI_'.$shop['id_shop']),
                'FCTP_COMBI_PREFIX_'.$shop['id_shop'] => Configuration::get('FCTP_COMBI_PREFIX_'.$shop['id_shop']),
                'FPF_PREFIX_'.$shop['id_shop'] => Configuration::get('FPF_PREFIX_'.$shop['id_shop']),
            );
            $form_values = array_merge($form_values, $more_values);
            foreach ($langs as $lang) {
                $form_values['FPF_'.$shop['id_shop'].'_'.$lang['id_lang']] = Configuration::get('FPF_'.$shop['id_shop'].'_'.$lang['id_lang']);
            }
        }

        return $form_values;
    }
    public function validatenewpixelform()
    {
        $res = array();
        $res['ok'] = true;
        $res['output'] = '';

        // Validation and Cast
        $this->pixelparams['pixel_active'] = (int)Tools::getValue('pixel_active');

        // Pixel name validation
        $this->pixelparams['pixel_name'] = pSQL(Tools::getValue('pixel_name'));
        $this->pixelparams['pixel_type'] = 1; //(int)Tools::getValue('pixel_type');
        $this->pixelparams['pixel_extras'] = pSQL(Tools::getValue('pixel_extras'));
        $this->pixelparams['pixel_extras_type'] = pSQL(Tools::getValue('pixel_extras_type'));

        // Validate Keypage
        if (Tools::getValue('pixel_type') == 1) {
            $keypageexists = $this->checkKeypageExists();
            if ($keypageexists == false) {
                $res['output'] .= $this->displayError($this->l('Error: Please enter a valid KeyPage ID, you can find the id of your desired page in the product/category/cms list'));
                $res['ok'] = false;
            } else {
                if ($keypageexists[0]['name'] != '' && $keypageexists[0]['name'] != 1) {
                    $this->pixelparams['pixel_extras_name'] = pSQL($keypageexists[0]['name']);
                }
            }
        }
        if ($res['ok'] == true) {
            $this->updatepixel(Tools::getValue('id_facebookpixels'));
            if (Tools::getValue('id_facebookpixels') != '') {
                $res['output'] .= $this->displayConfirmation($this->l('Pixel Updated'));
            } else {
                $res['output'] .= $this->displayConfirmation($this->l('New Pixel Created'));
            }
        }
        return $res;
    }

    public function updatepixel($id = 0)
    {
        if ($id == 0) {
            Db::getInstance()->insert('facebookpixels', $this->pixelparams);
        } else {
            Db::getInstance()->update('facebookpixels', $this->pixelparams, 'id_facebookpixels = '.(int)$id);
        }
    }

    public function deletepixel()
    {
        $id = (int)Tools::getValue('id_facebookpixels');
        if (Db::getInstance()->delete('facebookpixels', 'id_facebookpixels = '.(int)$id)) {
            return $this->displayConfirmation($this->l('Pixel Deleted'));
        } else {
            return $this->displayWarning($this->l('There was an errror deleting the pixel it may be already deleted.'));
        }
    }

    public function statuspixel()
    {
        $id = Tools::getValue('id_facebookpixels');
            $sql = 'SELECT pixel_active FROM '._DB_PREFIX_.'facebookpixels WHERE id_facebookpixels = '.(int)$id;
        if ($results = Db::getInstance()->executeS(pSQL($sql))) {
            $results = (bool)$results[0]['pixel_active'];
            $results = !$results;

            $results = Db::getInstance()->update('facebookpixels', array('pixel_active' => $results), 'id_facebookpixels = '.(int)$id);
            return $this->displayConfirmation($this->l('Pixel Status Updated'));
        }
    }

    public function displayOldForm()
    {
        $output = '<form class=\'form\' action=\''.Tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']).'&submitfacebookconversionpixel\' method=\'post\'>
        <fieldset style=\'float:left;width:600px;\'><legend>'.$this->l('Facebook Conversion Tracking Pixel Settings').'</legend>
            <div style=\'float:left; width:20%;\'>
                <label for=\'FCP_VALUE_TMP\'>'.$this->l('Paste the HTML provided by Facebook Here').'</label>
            </div>
            <div class=\'\' style=\'float:right; width:60%;\'>
                <textarea name=\'FCP_VALUE_TMP\' id=\'FCP_VALUE_TMP\' style=\'width:98%;\' rows=8></textarea>
                <p style=\'margin-bottom:20px\'><e>'.$this->l('This module allows to optimize Facebook campaigns to leads').'<br />'.$this->l('To get a new code or to recover it enter to ').'<a href=\'https://www.facebook.com/ads/manage/convtrack.php\' target=\'_blank\' title=\'Create a Conversion Tracking Pixel\' >'.$this->l('Facebook Ads Manager').'</a>. '.$this->l('Once you have it copy and paste it here').'</e></p>
            </div>
            <div style=\'clear:both\'></div>
            <div class=\'\' style=\'float:left; width:20%;\'>
                <label for=\'FCP_VALUE\'>'.$this->l('Pixel ID:').'</label>
            </div>
            <div class=\'\' style=\'float:right; width:60%;\'>
                <input name=\'FCP_VALUE\' id=\'FCP_VALUE\' readonly=\'readonly\' size=20 style=\'width:100%;\' value=\''.Configuration::get('FCP_VALUE').'\' />
            <div style=\'clear:both\'></div>
            </div>
            <div class=\'margin-form\' style=\'padding-left:40%;\'>
                <div style=\'clear:both\'></div>
                <input style=\'margin-top:15px;\' value=\''.$this->l('Save').'\' name=\'submitfacebookconversionpixel\' id=\'submitfacebookconversionpixel\' class=\'button\' type=\'submit\'>
            </div>
        </fieldset>
        </form>';
        return $output;
    }
    public function getPixels($id = 0)
    {
        if ($id != 0 && $id != '') {
            $sql = 'SELECT * from `'._DB_PREFIX_.'facebookpixels`';
            if ($id != 0 && $id != '') {
                $sql .= ' WHERE id_facebookpixels = '.(int)$id;
            }
            if ($results = Db::getInstance()->ExecuteS(pSQL($sql))) {
                return $results;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    private function prepareKeypages()
    {
        $curl = $_SERVER['REQUEST_URI'];
        $curl = explode('?', $_SERVER['REQUEST_URI'], 2);
        preg_match('/^[^\d]*(\d+)/', $curl[0], $cid);
        foreach ($cid as $value) {
            if ($value != '' && isset($value)) {
                $value = (int)($value);
                if (is_int($value)) {
                    $this->context->smarty->assign(array('product_id' => $value));
                }
            }
        }

        if (Tools::getValue('search_query')) {
            $this->context->smarty->assign(array('search_query' => Tools::getValue('search_query')));
        }
        $this->context->smarty->assign(array('extras_types' => $this->extras_type));
    }

    private function checkKeypageExists()
    {
        $sql = '';
        $results = false;
        $lang_id = (int)$this->context->language->id;
        $keypage = (int)Tools::getValue('pixel_extras');
        $type = Tools::getValue('pixel_extras_type');
        $type = $this->extras_type[$type];
        if (Shop::isFeatureActive()) {
            $id_shop = Shop::getContextShopID(true);
            // Check if we will need the id_shop_group
            $sql = 'SHOW COLUMNS FROM `'._DB_PREFIX_.'product_lang` LIKE "id_shop_group"';
            if ($results = Db::getInstance()->ExecuteS($sql)) {
                $id_shop_group = Shop::getContextShopGroupID(true);
            } else {
                $id_shop_group = '';
            }
            $shop = ' AND id_shop = '.(int)$id_shop.($id_shop_group != '' ? ' AND id_shop_group = '.(int)$id_shop_group : '');
        } else {
            $shop = '';
        }
        //
        switch ($type) {
            case 'cms':
                $sql = 'SELECT meta_title AS name FROM `'._DB_PREFIX_.'cms` LEFT JOIN `'._DB_PREFIX_.'cms_lang` USING (id_cms) WHERE id_cms = '.(int)$keypage.' AND id_lang = '.(int)$lang_id.$shop;
                break;
            case 'product':
                $sql = 'SELECT name FROM `'._DB_PREFIX_.'product_lang` WHERE id_product = '.(int)$keypage.' AND id_lang = '.(int)$lang_id.$shop;
                break;
            case 'category':
                $sql = 'SELECT name FROM '._DB_PREFIX_.'category LEFT JOIN `'._DB_PREFIX_.'category_lang` USING (id_category) WHERE id_category = '.(int)$keypage.' AND id_lang = '.(int)$lang_id.$shop;
                break;
            case 'index':
            case 'contact':
            case 'search':
                return 1;
        }
        if ($results = Db::getInstance()->ExecuteS(pSQL($sql))) {
            return $results;
        } else {
            return false;
        }
    }
    private function prepareCustomer()
    {
        if (Configuration::get('pixel_account_on') == $this->context->cookie->id_customer) {
            $this->context->smarty->assign(array('registeron' => 1));
        }
    }
    public function hookPaymentReturn($params)
    {
        //return $this->hookDisplayOrderConfirmation($params);
    }
    public function hookOrderConfirmation($params)
    {
        //return $this->hookDisplayOrderConfirmation($params);
    }

    private function addConversionPixel($id = '')
    {
        // Check if it's an ajax request
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || Configuration::get) {
            // Order Successfull
            $id = '';
            $validation = Configuration::get('FCP_ORDER_CONVERSION');
            if ($validation != '' && !empty($validation)) {
                $validation = explode(":", $validation);
                if ((int)$this->context->cookie->id_customer == (int)$validation[1]) {
                    $id = $validation[0];
                    if (!Configuration::get('FCTP_AJAX')) {
                        Configuration::deleteByName('FCP_ORDER_CONVERSION');
                    }
                } elseif ((int)$this->context->cookie->id_customer == 0) {
                    // Guest checkouts
                    $id = $validation[0];
                    if (!Configuration::get('FCTP_AJAX')) {
                        Configuration::deleteByName('FCP_ORDER_CONVERSION');
                    }
                }
            }
            if ($id != '') {
                // Get the total numbers of products purchased
                $order = new Order((int)$id);
                echo '<!-- '.print_r($order, true).' -->';
                $products = $order->getProducts();
                echo '<!-- '.print_r($products, true).' -->';
                $product_quantity = 0;
                $product_list = '';
                $prefix = Configuration::get('FPF_PREFIX');
                foreach ($products as $product) {
                    $product_quantity += $product['product_quantity'];
                    for ($i = 0; $i < $product['product_quantity']; $i++) {
                        if (isset($product['id_product'])) {
                            $product_list[] = $prefix.$product['id_product'];
                        } elseif (isset($product['product_id'])) {
                            $product_list[] = $prefix.$product['product_id'];
                        }
                    }
                }

                $ordervars = array(
                'ordervalue' => (float)$order->total_paid,
                'currency' => $this->context->currency->iso_code,
                'product_quantity' => $product_quantity,
                'product_list' => $product_list,
                'order_id' => (int)$id);

                if (Configuration::get('FCTP_AJAX')) {
                    $ordervars['aurl'] = $this->_path . 'ajaxConversion.php';
                }
                
                $this->smarty->assign('ordervars', $ordervars);
                return $this->display(__FILE__, '/views/templates/hook/checkoutpixel.tpl');
            }
        }
    }

    private function getCategoryTopSales($id_category)
    {
        $sql = 'SELECT product_id, COUNT(product_id) AS sales FROM `'._DB_PREFIX_.'order_detail` WHERE product_id IN (SELECT id_product FROM `'._DB_PREFIX_.'category_product` WHERE id_category = '.(int)$id_category.') GROUP BY product_id ORDER BY sales DESC LIMIT 10';
        return DB::getInstance()->executeS(pSQL($sql));
    }
    private function displayPixels($typeid)
    {
        $sql = 'SELECT * FROM '._DB_PREFIX_.'facebookpixels WHERE pixel_type = '.(int)$typeid.' AND pixel_active = 1';
        if ($results = Db::getInstance()->ExecuteS(pSQL($sql))) {
            $this->context->smarty->assign(array('pixels_'.$typeid => $results));
            return true;
        } else {
            return false;
        }
    }

    public function printPixels()
    {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            //Get Current Controller (only in 1.6)
            $entity = $this->context->controller->php_self;
            $lang_id = $this->context->cookie->id_lang;
            if ($entity == '') {
                $entity = Tools::getValue('controller');
            }
            switch ($entity) {
                case 'product':
                    $product = new Product(Tools::getValue('id_product'));
                    $entityname = $product->name[$lang_id];
                    $entityprice = $product->price;
                    $combinations = $product->getAttributeCombinations($lang_id);
                    $hascombi = empty($combinations) ? '0' : '1';
                    $this->context->smarty->assign(array('hascombi' => $hascombi));
                    break;
                case 'category':
                    $entityname = new Category(Tools::getValue('id_category'));
                    $entityname = $entityname->name[$lang_id];
                    if (Configuration::get('FCTP_CATEGORY_TOP_SALES')) {
                        $this->context->smarty->assign(array('top_sell_id' =>$this->getCategoryTopSales((int)Tools::getValue('id_category'))));
                    }
                    $this->context->smarty->assign(array(
                        'max_cat_items' => Configuration::get('FCTP_CATEGORY_ITEMS'),
                    ));
                    break;
                case 'cms':
                    $entityname = new CMS(Tools::getValue('id_cms'));
                    $entityname = $entityname->meta_title[$lang_id];
                    break;
                case 'search':
                    $this->context->smarty->assign(array(
                        'max_cat_items' => Configuration::get('FCTP_CATEGORY_ITEMS'),
                    ));
                    break;
            }
            $this->context->smarty->assign(
                array(
                    'fctpid' => trim(Configuration::get('FCTP_PIXEL_ID')),
                    'entity' => $entity,
                    'entityname' => (isset($entityname) ? $entityname : ''),
                    'entityprice' => (isset($entityprice) ? $entityprice : ''),
                    'fctp_currency' => $this->context->currency->iso_code,
                )
            );
            $output = '';

            $output .= $this->display(__FILE__, '/views/templates/hook/pixelheader.tpl');

            // Add deep check before printing pixels
            if (Configuration::get('FCTP_DEEP_CHECK')) {
                $this->deepCheckForNewOrder();
            }
            // If there is a new order print it!
            if (Configuration::get('FCP_ORDER_CONVERSION') != '') {
                $output .= $this->addConversionPixel();
            }
            // Add to Cart
            if (Configuration::get('FCTP_ADD_TO_CART') == 1 && !($entity == 'order-confirmation')) {

                    $this->context->smarty->assign(array('custom_add_to_cart' => Configuration::get('FCP_CUST_ADD_TO_CART')));
                    $output .= $this->display(__FILE__, '/views/templates/hook/addtocart.tpl');
            }

            // Order related
            if ($entity == 'order' || $entity == 'order-opc') {
                // Choose payment method (start payment of the order)
                if (Tools::getValue('step') == 3 || $entity == 'order-opc') {
                    if (Configuration::get('FCTP_START') == 1) {
                        $output .= $this->display(__FILE__, '/views/templates/hook/start_payment.tpl');
                    }
                }
                if (Tools::getValue('step') == '') {
                    // It just started the Order process
                    if (Configuration::get('FCTP_START_ORD') == 1) {
                        $output .= $this->display(__FILE__, '/views/templates/hook/start_order.tpl');
                    }
                }
            }

            // Wishlist
            if (Configuration::get('FCTP_WISH') == 1) {
                $output .= $this->display(__FILE__, '/views/templates/hook/wishlist.tpl');
            }

            // Key Page || ViewContent
            // Toghether to avoid duplicates
            if ($this->displayPixels(1)) {
                $this->prepareKeypages();
                $output .= $this->display(__FILE__, '/views/templates/hook/keypage.tpl');
            }
            if (Configuration::get('FCTP_VIEWED') == 1 && $entity == 'product') {
                $nprod = new Product(Tools::getValue('id_product'));
                $this->context->smarty->assign(
                    array(
                        'product_id' => Tools::getValue('id_product'),
                        'price' => $nprod->getPrice(),
                        'name' => $nprod->name[$this->context->language->id],
                    )
                );
                $output .= $this->display(__FILE__, '/views/templates/hook/viewcontent.tpl');
            }

            // Registered Customer
            if (Configuration::get('pixel_account_on') != '' && Configuration::get('FCTP_REG')) {
                $this->prepareCustomer();
                $output .= $this->display(__FILE__, '/views/templates/hook/registration.tpl');
                Configuration::updateValue('pixel_account_on', '');
            }

            // is a search
            if ($entity == 'search') {
                if (Configuration::get('FCTP_SEARCH') == 1) {
                    $this->context->smarty->assign(array('search_keywords' => Tools::getValue('search_query')));
                    $output .= $this->display(__FILE__, '/views/templates/hook/search.tpl');
                }
            }

            // New event viewCategory
            if ($entity == 'category') {
                if (Configuration::get('FCTP_CATEGORY') == 1) {
                    $output .= $this->display(__FILE__, '/views/templates/hook/category.tpl');
                }
            }
            return $output;
        }
    }

    public function deepCheckForNewOrder()
    {
        $sql = 'SELECT id_order, id_customer FROM '._DB_PREFIX_.'orders ORDER BY id_order DESC';
        $result = DB::getInstance(_PS_USE_SQL_SLAVE_)->getRow(pSQL($sql));
        $lastOrder = Configuration::get('FCTP_LAST_ORDER');
        if ($lastOrder == '') {
            $lastOrder = array(0,0);
        } else {
            $lastOrder = explode(':', $lastOrder);
        }
        if ($result['id_order'] > $lastOrder[0]) {
            $ordervars = $result['id_order'].':'.$result['id_customer'];
            Configuration::updateValue('FCP_ORDER_CONVERSION', $ordervars);
            Configuration::updateValue('FCTP_LAST_ORDER', $ordervars);
        }
    }
    public function hookDisplayHeader($params)
    {
        $output = '';
        // Add necessary variables to smarty
        $combi = Configuration::get('FCTP_COMBI_'.$this->context->shop->id);
        // Check If dynamic ads can be enabled
        if (Configuration::get('FCTP_ADD_TO_CART') == 1 && Configuration::get('FCTP_CONV') == 1 && Configuration::get('FCTP_DYNAMIC_ADS') == 1) {
            $this->context->smarty->assign(array('dynamic_ads' => 1, 'id_prefix' => Configuration::get('FPF_PREFIX_'.$this->context->shop->id), 'combi' => $combi, 'combi_prefix' => ($combi ? Configuration::get('FCTP_COMBI_PREFIX_'.$this->context->shop->id) : '')));
            
            // Add the Feed ID for Dynamic Product Ads
            $feed_id = Configuration::get('FPF_'.$this->context->shop->id.'_'.$this->context->language->id);
            if ($feed_id != '') {
                $this->context->smarty->assign(array('fpf_id' => $feed_id));
            }
        } else {
            $this->context->smarty->assign(array('dynamic_ads' => 0));
        }
        if (Configuration::get('FCTP_FORCE_HEADER') == 1) {
            $output .= $this->printPixels();
        }

        // if PS 1.7 track start order here
        if (version_compare(_PS_VERSION_, '1.7', '>=') == true && $this->context->controller->php_self == 'order') {
            if (Configuration::get('FCTP_START_ORD') == 1) {
                $pcart = new Cart($this->context->cart->id);
                $productsCart = $pcart->getProducts();
                //print_r($this->context->cart);
                $pcart = '';
                //print_r($productsCart);
                foreach ($productsCart as $product) {
                    while ($product['cart_quantity'] > 0) {
                        $pcart .= '\''.$product['id_product'].'\',';
                        $product['cart_quantity']--;
                    }
                }
                $pcart = trim($pcart, ',');
                //echo $pcart;
                $this->context->smarty->assign(
                    array(
                        'page_name' => 'order_ps_17',
                        'fctpid' => Configuration::get('FCTP_PIXEL_ID'),
                        'pcart' => $pcart,
                    )
                );
                $output .= $this->display(__FILE__, '/views/templates/hook/pixelheader.tpl');
                if (Configuration::get('FCTP_FORCE_HEADER') != 1) {
                    $output .= $this->display(__FILE__, '/views/templates/hook/start_order.tpl');
                }
            }
        }
        return $output;
    }

    public function hookDisplayFooter($params)
    {
        if (Configuration::get('FCTP_FORCE_HEADER') != 1) {
            return $this->printPixels();
        }
    }

    public function hookActionCartSave($params)
    {
        Configuration::updateValue('FCP_add_to_cart', 1);
    }

    public function hookActionCustomerAccountAdd($params)
    {
        Configuration::updateValue('pixel_account_on', $params['newCustomer']->id);
    }

    public function hookCreateAccount($params)
    {
        return $this->hookActionCustomerAccountAdd($params);
    }

    public function hookActionValidateOrder($params)
    {
        $id = '';
        if (isset($params['objOrder'])) {
            $order = $params['objOrder'];
        } elseif (isset($params['order'])) {
            $order = $params['order'];
        }
        if (isset($order->id)) {
            $id = $order->id;

            // Compatibility check
            if ($id == '') {
                $id = $order->id_order;
            }

            $orderstring = $id.':'.$order->id_customer;
            Configuration::updateValue('FCP_ORDER_CONVERSION', $orderstring);
        }
        //Configuration::updateValue('FCP_DEBUG', $orderstring.'@'.serialize($params));
    }

    /* Customer CSV Export Start */
    private function getCurrentUrl()
    {
        $url = Tools::strlen($_SERVER['QUERY_STRING']) ? basename($_SERVER['PHP_SELF']).'?'.$_SERVER['QUERY_STRING'] : basename($_SERVER['PHP_SELF']);
        $pos = strpos($url, 'typexp');
        if ($pos === false) {
            return $url;
        } else {
            return Tools::substr($url, 0, $pos - 1);
        }
    }

    private function getProcess($typexp)
    {
        // Process the files
        $res = array();
        if ($typexp > 0 && $typexp <= 3) {
            if (class_exists('DbQuery')) {
                $dbquery = new DbQuery();
                $dbquery->select('c.`email`');
                if ($typexp == 1 || $typexp == 3) {
                        $dbquery->from('customer', 'c');
                }
                if ($typexp == 2) {
                        $dbquery->from('newsletter', 'c');
                }
                $dbquery->groupBy('c.`email`');
                if (Context::getContext()->cookie->shopContext) {
                    $dbquery->where('c.id_shop = '.(int)Context::getContext()->shop->id);
                }
                $rq = Db::getInstance()->executeS($dbquery->build());
            } else {
                $dbquery = 'SELECT c.email ';
                if ($typexp == 1 || $typexp == 3) {
                    $dbquery .= 'FROM '._DB_PREFIX_.'customer c ';
                }
                if ($typexp == 2) {
                    $dbquery .= 'FROM '._DB_PREFIX_.'newsletter c ';
                }
                $dbquery .= 'GROUP BY c.email';
                $rq = Db::getInstance()->executeS($dbquery);
            }
            // Newsletter customers for Export all
            if ($typexp == 3) {
                if (class_exists('DbQuery')) {
                    $dbquery = new DbQuery();
                    $dbquery->select('c.`email`');
                    $dbquery->from('newsletter', 'c');
                    $dbquery->groupBy('c.`email`');
                    $dbquery->where('c.id_shop = '.(int)Context::getContext()->shop->id);
                    $rs = Db::getInstance()->executeS($dbquery->build());
                } else {
                    $dbquery = 'SELECT c.email FROM '._DB_PREFIX_.'newsletter c GROUP BY c.email';
                    $rs = Db::getInstance()->executeS($dbquery);
                }
            }
            if (is_array($rq)) {
                // Initialize the arrays
                $array1 = array();
                $array2= array();
                foreach ($rq as $item) {
                    $array1[] = $item['email'];
                }
                // If we have the Newsletter array, merge it
                if (!empty($rs)) {
                    if (is_array($rs)) {
                        foreach ($rs as $item) {
                            $array2[] = $item['email'];
                        }
                        $array1 = array_unique(array_merge($array1, $array2));
                    }
                }
                $res = $this->createCSV($array1, $typexp);
            }
            return $res;
        }
    }

    public function hookActionAdminControllerSetMedia()
    {
        if (Tools::getValue('configure') == 'facebookconversiontrackingplus' && version_compare(_PS_VERSION_, '1.6', '<')) {
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }
    public function ajaxConversionSuccessfull() {
        Configuration::deleteByName('FCP_ORDER_CONVERSION');
    }
    private function createCSV($res, $typexp)
    {
        if (count($res) > 0) {
            $line = implode("\n", $res);
            if ($file = @fopen(dirname(__FILE__).'/csv/'.(string)$this->_file[$typexp], 'w')) {
                if (!fwrite($file, $line)) {
                    $this->context->controller->errors[] = Tools::displayError($this->l('Error: cannot write').' '.dirname(__FILE__).'/csv/'.$this->_file[$typexp].' !');
                    fclose($file);
                } else {
                    fclose($file);
                    return true;
                }
            } else {
                $this->context->controller->errors[] = Tools::displayError($this->l('Bad permissions, can\'t create the file'));
            }
            return false;
        } else {
            echo '<script type="text/javascript">$(document).ready(function() {alert("'.
            $this->l('Can\'t generate the CSV file.').'\\n\\n'.
            $this->l('The newsletter list is empty').'") });</script>';
        }
    }
    /* Customer CSV Export END */
}
