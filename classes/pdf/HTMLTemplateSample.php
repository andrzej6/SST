
<?php

class HTMLTemplateSample extends HTMLTemplate
{
	
	public function __construct($object, $smarty)
	{
		$this->smarty = $smarty;
		$this->smarty->assign(array(
			'sample_text' => "Content text",			'header_text' => "Header text",			'footer_text' => "Footer text",
			
		));
	}
	
	
	public function getHeader()
	{
		return $this->smarty->fetch($this->getTemplate('sample_header'));
	}
	
	public function getFooter()
	{
		return $this->smarty->fetch($this->getTemplate('sample_footer'));
	}
	
	
	
	public function getContent()
	{
		return $this->smarty->fetch($this->getTemplate('sample'));
	}

	
	 public function getFilename()
	{
		return 'Sample.pdf';
	}
	
	public function getBulkFilename()
	{
		return 'Sample.pdf';
	}
	
	
	public function assignHookData($object)
	{
	 return true;
	}
	
	
	
	
}


