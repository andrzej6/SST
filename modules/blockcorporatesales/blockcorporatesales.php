<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class BlockCorporatesales extends Module
{
	
	
	public function __construct()
  {
    $this->name = 'blockcorporatesales';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Andrzej Dlugosz';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Corporate Sales');
    $this->description = $this->l('Module for Corporate Sales');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
   
  }
	
	
	
	public function install()
{
   if (Shop::isFeatureActive())
    Shop::setContext(Shop::CONTEXT_ALL);
   
   
 
  if (!parent::install() ||
    !$this->registerHook('corporatesalesHook') ||
    !$this->registerHook('header')||
    !$this->_createTables()
  )
    return false;
 
  return true;
}
	
	public function uninstall()
{
  if (!parent::uninstall() ||
    !Configuration::deleteByName('BLOCKGETDOWNLOADS_NAME')
  )
    return false;
 
  return true;
}





private function _createTables()

    {
    	
		
		
	 $response = (bool) Db::getInstance()->execute('

            CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'corporates` (

                `id_corporates` int(10) unsigned NOT NULL AUTO_INCREMENT,

                `name` varchar(255) NOT NULL,

                `email` varchar(255) NOT NULL,

                PRIMARY KEY (`id_corporates`)

            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;

        ');	
		
		
		
		return $response;
		
		
		
    }




public function hookcorporatesalesHook($params)
{
      return $this->display(__FILE__, 'corpo.tpl');
}


public function hookHeader($params)
	{
		$this->page_name = Dispatcher::getInstance()->getController();
		/* if ($this->page_name == 'mydownloads')
		{
			$this->context->controller->addCSS($this->_path.'css/downloads.css', 'all');
			
			//below cancelled password protection functionality:
			// $this->context->controller->addJS($this->_path.'js/downloads.js');
		}
		 
		 */
		
	}







	
	
}