<?php



class MydownloadsController extends FrontController {



public $php_self = 'mydownloads';







public function setMedia()

	{
		parent::setMedia();
	}




public function init() {

    parent::init();

}





public function initContent() {

    parent::initContent();
	
	$cookie = new Cookie('getdownload','/'); 
     
	 
	 if(isset($cookie->pass_ok))
	 {
	 	
		  $this->context->smarty->assign(array('passok' =>'OK'));
		  
	 }
	  
	 else {
	 	 $this->context->smarty->assign(array('passok' =>'nOK'));
	 } 
	  	

    $this->setTemplate(_PS_THEME_DIR_.'mydownloads.tpl');

    

   
    

   

}




}

