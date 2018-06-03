<?php
/**
 * Created by PhpStorm.
 * User: andrzej dlugosz
 * Date: 25/02/2018
 * Time: 14:09
 * all tips taken from:
 * http://doc.prestashop.com/display/PS16/Creating+a+first+module
 * http://doc.prestashop.com/display/PS16/Adding+a+configuration+page
 */

//not to access it directly
if (!defined('_PS_VERSION_')) {
    exit;
}

class AdFreetrial extends Module
{


    public function __construct()
    {
        //name below must be name of module's folder
        $this->name = 'adfreetrial';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Andrzej Dlugosz';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('My FreeTrial Module');
        $this->description = $this->l('Simple module for Freetrial products. Will do extensions.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('AD_FREETRIAL') || !Configuration::get('AD_PRODUCTLIST')) {
            $this->warning = $this->l('No config data provided');
        }
    }




    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        $to_serialize = '120,123,124,24,93,95,155,156,113,77,134,145,160,25,164,162';

        if (!parent::install() ||
            !Configuration::updateValue('AD_FREETRIAL', 'freetrial1') ||
			!Configuration::updateValue('AD_PRODUCTLIST', serialize($to_serialize)) ||
			!$this->registerHook('moduleRoutes')
        ) {
            return false;
        }

        return true;
    }




    public function uninstall()
    {
        if (!parent::uninstall() ||
            !Configuration::deleteByName('AD_FREETRIAL') ||
			!Configuration::deleteByName('AD_PRODUCTLIST')
        ) {
            return false;
        }

        return true;
    }



	
    public function hookModuleRoutes($params) {
        $alias = Configuration::get('AD_FREETRIAL');
        
        $my_link = array(
            'adfreetrial' => array(
                'controller' => 'product',
                'rule' => $alias,
                'keywords' => array(),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'adfreetrial',
                ),
            ),
            
        );
        return $my_link;
    }
    



    public function getContent()
    {
        $output = null;
		$output .= '<script type="text/javascript" src="https://sit-stand.com/js/jquery/plugins/autocomplete/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="https://sit-stand.com/modules/adfreetrial/views/js/admin/jquery.freetrial.admin.js"></script>
		';
		
		
        if (Tools::isSubmit('submit'.$this->name))
        {
            $fname = strval(Tools::getValue('AD_FREETRIAL'));
			$prod_array = Tools::getValue('tab_content');
			
            if (!$fname || empty($fname))
                $output .= $this->displayError($this->l('Invalid Configuration value'));
            elseif ((empty($prod_array)))
                $output .= $this->displayError($this->l('Module needs to contain at least one product. Default one product is listed below'));
            else
            {
                Configuration::updateValue('AD_FREETRIAL', $fname);
				//below $prod_array need to an array
				Configuration::updateValue('AD_PRODUCTLIST', serialize($prod_array));
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }
		
        return $output.$this->displayForm();
    }




    public function displayForm()
    {
        // Get default language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Init Fields form array
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
			
			
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Configuration value'),
                    'name' => 'AD_FREETRIAL',
                    'size' => 100,
                    'required' => true
                ),
				array(
                    'type' => 'text',
                    'label' => $this->l('Add a product'),
                    'name' => 'product_autocomplete',
                    'size' => 50,
					'required' => true
                ),
				array(
                    'type' => 'text',
                    'label' => $this->l('Tab Content'),
                    'name' => 'tab_content',
                    'size' => 150
                ),
            ),
			
			
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            )
        );
		
		
		
		$tab_content_products = array();
		$tab_content = unserialize(Configuration::get('AD_PRODUCTLIST'));
        $tab_content_ex = explode(',', $tab_content);
        $id_default_lang = $this->context->language->id;

		foreach ($tab_content_ex as $pid) {
			$product = new Product($pid, false, $id_default_lang);
			$tab_content_products[] = array(
				'id' => $pid,
				'name' => $product->name,
				'ref' => $product->reference
			);
		}


		if (!empty($tab_content_products))
            $this->context->smarty->assign(array('tab_content_products' => $tab_content_products));
	
	
        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' =>
                array(
                    'desc' => $this->l('Save'),
                    'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                        '&token='.Tools::getAdminTokenLite('AdminModules'),
                ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        // Load current value
        
		$helper->fields_value['AD_FREETRIAL'] = Configuration::get('AD_FREETRIAL');
        $helper->fields_value['tab_content'] = $tab_content;


        return $helper->generateForm($fields_form);
    }






}