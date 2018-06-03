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

if (!defined('_PS_VERSION_'))
	exit;

abstract class PaymentModuleRequest
{
	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var array
	 */
	protected $parameters = array();

	/**
	 * @var boolean
	 */
	protected $initialized = false;

	/**
	 * @var WorldPaySettings
	 */
	protected $settings;

	public function __construct(WorldPaySettings $settings)
	{
		$this->settings = $settings;
	}

	public function isInitialized()
	{
		return $this->initialized;
	}

	abstract public function initialize(Cart $cart);

	public function getRequestTitle()
	{
		return $this->title;
	}

	public function getRequestUrl()
	{
		return $this->url;
	}

	public function getRequestParameters()
	{
		return array_filter($this->parameters);
	}

	/**
	 * @param integer $id_currency
	 * @throws WorldPayException
	 * @return Currency
	 */
	protected function getCurrencyObject($id_currency)
	{
		$currency = new Currency((int)$id_currency);

		if (!Validate::isLoadedObject($currency))
			throw new WorldPayException(Tools::displayError('Invalid currency id.'));

		return $currency;
	}

	/**
	 * @param integer $id_language
	 * @throws WorldPayException
	 * @return Language
	 */
	protected function getLanguageObject($id_language)
	{
		$language = new Language((int)$id_language);

		if (!Validate::isLoadedObject($language))
			throw new WorldPayException(Tools::displayError('Invalid language id.'));

		return $id_language;
	}

	/**
	 * @param integer $id_customer
	 * @throws WorldPayException
	 * @return Currency
	 */
	protected function getCustomerObject($id_customer)
	{
		$customer = new Customer((int)$id_customer);

		if (!Validate::isLoadedObject($customer))
			throw new WorldPayException(Tools::displayError('Invalid customer id.'));

		return $customer;
	}

	/**
	 * @param integer $id_address
	 * @throws WorldPayException
	 * @return Address
	 */
	protected function getAddressObject($id_address)
	{
		$address = new Address((int)$id_address);

		if (!Validate::isLoadedObject($address))
			throw new WorldPayException(Tools::displayError('Invalid address id.'));

		return $address;
	}

	/**
	 * @param integer $id_country
	 * @throws WorldPayException
	 * @return Country
	 */
	protected function getCountryObject($id_country)
	{
		$country = new Country((int)$id_country);

		if (!Validate::isLoadedObject($country))
			throw new WorldPayException(Tools::displayError('Invalid country id.'));

		return $country;
	}
}
