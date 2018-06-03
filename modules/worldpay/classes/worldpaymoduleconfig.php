<?php
/**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2014 PrestaShop SA
*  @version   Release: $Revision: 6844 $
*  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

abstract class WorldPayModuleConfig
{
	const DISABLED = 0;
	const ENABLED = 1;

	const NO = 0;
	const YES = 1;

	private $errors;

	private $module;

	private $context;

	protected $values = array();

	protected $submit_action = 'config';

	abstract public function init();

	abstract public function install();

	abstract public function uninstall();

	abstract public function update();

	abstract public function showForm($id_lang);

	abstract protected function validate();

	protected function __construct(Module $module = null)
	{
		if (is_null($module))
			$module = Module::getInstanceByName('worldpay');

		$this->module = $module;
		$this->context = Context::getContext();

		$this->init();
	}

	/**
	 * @return Module
	 */
	public function getModule()
	{
		return $this->module;
	}

	public function getTitle()
	{
		return $this->l('Configuration');
	}

	public function getFormName()
	{
		return $this->submit_action;
	}

	public function getValue($name, $default = null, $id_lang = null)
	{
		if (!isset($this->values[$name]))
			return $default;

		if (!empty($id_lang) && is_array($this->values[$name]))
			return isset($this->values[$name][$id_lang]) ? $this->values[$name][$id_lang] : $default;

		return $this->values[$name];
	}

	public function setValue($name, $value)
	{
		$this->values[$name] = $value;
	}

	public function getSubmittedValues()
	{
		if (Tools::isSubmit($this->submit_action))
			$this->values = array_merge($this->values, $_POST);

		return $this->values;
	}

	public function submitForm()
	{
		if (Tools::isSubmit($this->submit_action))
			if ($this->update())
			{
				$conf = 4;
				$token = Tools::getAdminTokenLite('AdminModules');

				return Tools::redirectAdmin($this->getFormUrl()."&token={$token}&conf={$conf}");
			}
			else
				$this->errors[] = $this->l('Error while saving configuration');

		$return = null;

		if (count($this->errors))
			foreach ($this->errors as $err)
				$return .= $this->getModule()->displayError($err);

		return $return;
	}

	protected function renderForm(array $fields_form)
	{
		$fields_form[]['form'] = array(
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => Tools::version_compare('1.6', _PS_VERSION_) ? null : 'button',
			),
		);

		$helper = new HelperForm();
		$helper->show_toolbar = false;

		$helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;

		$helper->submit_action = $this->getFormName();
		$helper->currentIndex = $this->getFormUrl();
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getSubmittedValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		return $helper->generateForm($fields_form);
	}

	protected function getFormUrl()
	{
		$params = null;
		$params .= '&configure='.$this->module->name;
		$params .= '&tab_module='.$this->module->tab;
		$params .= '&module_name='.$this->module->name;

		return $this->context->link->getAdminLink('AdminModules', false).$params;
	}

	protected function l($string)
	{
		if (is_object($this->module))
			return $this->module->l($string);

		return $string;
	}
}
