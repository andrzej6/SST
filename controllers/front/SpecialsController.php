<?php



class SpecialsController extends FrontController {



public $php_self = 'specials';







public function setMedia()

	{

		parent::setMedia();



		

		

		//$this->addJS(_THEME_JS_DIR_.'/helperfiles/specials.js');

		//$this->addCSS(_THEME_JS_DIR_.'/helperfiles/specials.css');

	}

























public function init() {

    parent::init();

}





public function initContent() {

    parent::initContent();



    $this->setTemplate(_PS_THEME_DIR_.'specials.tpl');

    

    

    if (Tools::getIsset('price'))

    

    {

    $this->context->smarty->assign(array(

				

				'myfield' => (int)Tools::getValue('price',null)

			));

    

      }

      

      else 

     {

        $this->context->smarty->assign(array(

				

				'myfield' => 400

			));

        

     }

   

    

    

}









}