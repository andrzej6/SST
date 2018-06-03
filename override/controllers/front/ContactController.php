<?php

class ContactController extends ContactControllerCore
{
	
	public function postProcess()
	{
		if (Tools::isSubmit('submitMessage'))
		{

            $extension = array('.txt', '.rtf', '.doc', '.docx', '.pdf', '.zip', '.png', '.jpeg', '.gif', '.jpg');
            $fileAttachment = Tools::fileAttachment('fileUpload');
            $message = Tools::getValue('message'); // Html entities is not usefull, iscleanHtml check there is no bad html tags.
            if (!($from = trim(Tools::getValue('from'))) || !Validate::isEmail($from))
                $this->errors[] = Tools::displayError('Invalid email address.');
            else if (!$message)
                $this->errors[] = Tools::displayError('The message cannot be blank.');
            else if (!Validate::isCleanHtml($message))
                $this->errors[] = Tools::displayError('Invalid message');
            else if (!($id_contact = (int)(Tools::getValue('id_contact'))) || !(Validate::isLoadedObject($contact = new Contact($id_contact, $this->context->language->id))))
                $this->errors[] = Tools::displayError('Please select a subject from the list provided. ');
            else if (!empty($fileAttachment['name']) && $fileAttachment['error'] != 0)
                $this->errors[] = Tools::displayError('An error occurred during the file-upload process.');
            else if (!empty($fileAttachment['name']) && !in_array( Tools::strtolower(substr($fileAttachment['name'], -4)), $extension) && !in_array( Tools::strtolower(substr($fileAttachment['name'], -5)), $extension))
                $this->errors[] = Tools::displayError('Bad file extension');
            else
                {
                    $domain_name = substr(strrchr($from, "@"), 1);
                    if (strpos($domain_name, '.ru') == false) {
                        Hook::exec('enqstoreHook', array($from, 'contact form'));
                        parent::postProcess();
                    }

                }
		
		}
	}
	
}