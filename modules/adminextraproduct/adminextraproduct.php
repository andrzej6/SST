<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class AdminExtraproduct extends Module
{

	public function __construct()
  {
    $this->name = 'adminextraproduct';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Andrzej Dlugosz';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Extra Product Info');
    $this->description = $this->l('Admin Module for adding extra product info');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
  }
	

	public function install()
{
   
  if (!parent::install() OR
        !$this->alterTable('add') OR         
        /* !$this->registerHook('actionAdminControllerSetMedia') OR */
        !$this->registerHook('actionProductUpdate') OR
        !$this->registerHook('displayAdminProductsExtra') OR
		!$this->registerHook('displayProductContent'))
        return false;
    return true;
}


	public function uninstall()
{
	if (!parent::uninstall() OR !$this->alterTable('remove'))
        return false;
    return true;
}


public function alterTable($method)
{
    switch ($method) {
        case 'add':
            $sql = 'ALTER TABLE ' . _DB_PREFIX_ . 'product_lang ADD COLUMN `ad_extrafield1` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield2` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield3` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield4` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield5` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield6` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield7` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield8` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield9` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield10` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield11` TEXT DEFAULT "",
                                                                ADD COLUMN `ad_extrafield12` TEXT DEFAULT ""';
            break;
         
        case 'remove':
            $sql = 'ALTER TABLE ' . _DB_PREFIX_ . 'product_lang DROP COLUMN `ad_extrafield1`,
                                                               DROP COLUMN `ad_extrafield2`,
                                                               DROP COLUMN `ad_extrafield3`,
                                                               DROP COLUMN `ad_extrafield4`,
                                                               DROP COLUMN `ad_extrafield5`,
                                                               DROP COLUMN `ad_extrafield6`,
                                                               DROP COLUMN `ad_extrafield7`,
                                                               DROP COLUMN `ad_extrafield8`,
                                                               DROP COLUMN `ad_extrafield9`,
                                                               DROP COLUMN `ad_extrafield10`,
                                                               DROP COLUMN `ad_extrafield11`,
                                                               DROP COLUMN `ad_extrafield12`';
            break;
    }
     
    if(!Db::getInstance()->Execute($sql))
        return false;
    return true;
}


public function hookDisplayProductContent($params)
{
	$id_product = (int)Tools::getValue('id_product');
    $result = Db::getInstance()->ExecuteS('SELECT ad_extrafield1, ad_extrafield2, ad_extrafield3, ad_extrafield4, ad_extrafield5,
                                                      ad_extrafield6, ad_extrafield7, ad_extrafield8, ad_extrafield9, ad_extrafield10,
                                                      ad_extrafield11, ad_extrafield12
                                               FROM '._DB_PREFIX_.'product_lang WHERE id_product = ' . (int)$id_product. ' AND id_lang = 1');
	
    if(!$result)
    {$ad_extrafields = array();}
     else
     { 
       $ad_extrafields = $result[0];
       if (isset($ad_extrafields['ad_extrafield9']) && !empty($ad_extrafields['ad_extrafield9']))
		   $ad_extrafields['ad_extrafield9'] = explode(";", $ad_extrafields['ad_extrafield9']);
     }
	  $this->context->smarty->assign(array('ad_extrafields' => $ad_extrafields));
}


public function hookDisplayAdminProductsExtra($params)
{
    if (Validate::isLoadedObject($product = new Product((int)Tools::getValue('id_product'))))
    {
        $this->prepareNewTab();
        return $this->display(__FILE__, 'extratab.tpl');
    }
} 


public function prepareNewTab()
{

    $iso = $this->context->language->iso_code;
    $this->context->smarty->assign(array(
        'ad_extrafields' => $this->getCustomField((int)Tools::getValue('id_product')),
        'languages' => $this->context->controller->_languages,
        'id_lang' => (int)Configuration::get('PS_LANG_DEFAULT'),
        'iso' => file_exists(_PS_CORE_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en',
        'path_css' => _THEME_CSS_DIR_,
        'ad' => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_),
        'tinymce' => true
    ));

}

public function hookActionAdminControllerSetMedia($params)
{
    if($this->context->controller->controller_name == 'AdminProducts' && Tools::getValue('id_product'))
    {
        $this->context->controller->addJS(_PS_JS_DIR_.'tiny_mce/tiny_mce.js');
        $this->context->controller->addJS(_PS_JS_DIR_.'tinymce.inc.js');
    }
}



public function hookActionProductUpdate($params)
{
    $id_product = (int)Tools::getValue('id_product');

    for ($i = 1; $i <= 12; $i++) {
        $ad_extrafield = 'ad_extrafield'.$i;
        if(!Db::getInstance()->update('product_lang', array($ad_extrafield=> Tools::getValue($ad_extrafield)) ,
            'id_lang = 1 AND id_product = ' .$id_product ))
            $this->context->controller->_errors[] = Tools::displayError('Error: ').mysql_error();
    }

 
}


public function getCustomField($id_product)
{
    $result = Db::getInstance()->ExecuteS('SELECT ad_extrafield1, ad_extrafield2, ad_extrafield3, ad_extrafield4, ad_extrafield5,
                                                      ad_extrafield6, ad_extrafield7, ad_extrafield8, ad_extrafield9, ad_extrafield10,
                                                      ad_extrafield11, ad_extrafield12
                                                       FROM '._DB_PREFIX_.'product_lang WHERE id_product = ' . (int)$id_product. ' AND id_lang = 1');
    //$result = 'SELECT deliverytext_short FROM '._DB_PREFIX_.'product_lang WHERE id_product = ' . (int)$id_product. ' AND id_lang = 1';
    if(!$result)
    {return array();}
     else
     {return $result[0];}

}


}