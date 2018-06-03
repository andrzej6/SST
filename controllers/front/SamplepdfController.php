<?php
class myIterator implements Iterator {
    private $position = 0;
    private $array = array(
        "firstelement"
    );  

    public function __construct() {
        $this->position = 0;
    }
    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->array[$this->position];
    }
    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->array[$this->position]);
    }
}

class SamplepdfController extends FrontController {
public $php_self = 'samplepdf';public function postProcess(){	if (Tools::isSubmit('submitsimpleform'))		{          $fname = Tools::getValue('fname');		   $lname = Tools::getValue('lname');							}	else {		$fname = "fname";		$lname = "lname";	}						$this->context->smarty->assign(array(			'fname' => $fname,			'lname' => $lname		));         }
public function setMedia()
	{
		parent::setMedia();
	}

public function init() {
    //@ini_set('display_errors', 'on');
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    parent::init();
}

public function initContent() {
    parent::initContent();	
	$object = new myIterator;
	//$object = new SplStack;	
	$pdf = new PDF($object,'Sample', $this->context->smarty);
	$pdf->render();
}
}

