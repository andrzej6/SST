<?php if (!defined('_PS_VERSION_'))  exit;  

class ProductBundles extends Module{
	
	    public function __construct()  {
	    	    $this->name = 'productbundles';    
	    	    $this->tab = 'front_office_features';    
	    	    $this->version = '1.0';    
	    	    $this->author = 'Andrzej Dlugosz';    
	    	    $this->need_instance = 0;    
	    	    $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');    
	    	    $this->bootstrap = true;     parent::__construct();     
	    	    $this->displayName = $this->l('Product Bundles');    
	    	    $this->description = $this->l('Module checks if product is in bundles and displays them');     
	    	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');     
	    	    if (!Configuration::get('PRODUCTBUNDLES'))            
	    	    $this->warning = $this->l('No name provided');  }
	    	    
	    	    public function install(){
	    	    	  if (Shop::isFeatureActive())    Shop::setContext(Shop::CONTEXT_ALL);   
	    	    	  if (!parent::install() ||    !$this->registerHook('extraRight') ||        !Configuration::updateValue('PRODUCTBUNDLES', 'some config data here...')  )    
	    	    	  return false;   
	    	    	  
	    	    	  return true;}
	    	    	  
	    	    	  
	    	    	  public function uninstall(){
	    	    	  	  if (!parent::uninstall() ||    !Configuration::deleteByName('PRODUCTBUNDLES')  )    return false;   return true;}
	    	    	  	  
	    	    	  	  public function hookExtraRight($params){
	    	    	  	  	   
	    	    	  	  	   $id_product = (int) Tools::getValue('id_product');  
                               $this->product = new Product($id_product, true, $this->context->language->id, $this->context->shop->id);
                               $id_category = (int)$this->product->id_category_default;
                               $this->category = new Category((int)$id_category, (int)$this->context->cookie->id_lang);
								$category_id = $this->category->id;
								// added the # of products per category, so we can display these in the category tree block
                                $ProductsCount = 0;
                                 $ProductsCount = (int)Db::getInstance()->getValue('SELECT COUNT(cp.id_category) FROM '._DB_PREFIX_.'category_product cp, '._DB_PREFIX_.'product pr WHERE cp.id_category = '. $id_category .' AND cp.id_product = pr.id_product AND pr.active = 1' );
												        
							    $this->context->smarty->assign(      array( 
							   'config_data' => Configuration::get('PRODUCTBUNDLES'),                   
							   'count_products'=>$ProductsCount,         
							   'themeimagedir' => _THEME_IMG_DIR_,                )  );  
							   return $this->display(__FILE__, 'productbundles.tpl');                        }


}