<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class BlockGetdownloads extends Module
{
	
	
	public function __construct()
  {
    $this->name = 'blockgetdownloads';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Andrzej Dlugosz';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Get Downloads');
    $this->description = $this->l('Module for Downloads on Website');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    
  }
	
	
	
	public function install()
{
   if (Shop::isFeatureActive())
    Shop::setContext(Shop::CONTEXT_ALL);
 
  if (!parent::install() ||
    !$this->registerHook('myDownloadHook') ||
    !$this->registerHook('header')
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




public function hookMyDownloadHook($params)
{
      return $this->display(__FILE__, 'downloads.tpl');
}


public function hookHeader($params)
	{
		$this->page_name = Dispatcher::getInstance()->getController();
		if ($this->page_name == 'mydownloads')
		{
			$this->context->controller->addCSS($this->_path.'css/downloads.css', 'all');
			
			//below cancelled password protection functionality:
			// $this->context->controller->addJS($this->_path.'js/downloads.js');
		}
		
	}







	
	
}