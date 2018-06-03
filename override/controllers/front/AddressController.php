<?php


class AddressController extends AddressControllerCore
{
	

	
	public function postProcess()
	{
		if (Tools::isSubmit('submitAddress'))
			$this->processSubmitAddress();
		else if (!Validate::isLoadedObject($this->_address) && Validate::isLoadedObject($this->context->customer))
		{
			$_POST['firstname'] = $this->context->customer->firstname;
			$_POST['lastname'] = $this->context->customer->lastname;
			$_POST['company'] = $this->context->customer->company;
			
			$_POST['phone'] = $this->context->cookie->phone;
			
		}
	}

	


}
