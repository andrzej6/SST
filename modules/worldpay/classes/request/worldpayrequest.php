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

include_once(_PS_MODULE_DIR_.'/worldpay/classes/request/paymentmodulerequest.php');

class WorldPayRequest extends PaymentModuleRequest {

	const REQUEST_INSTALLATION_ID = 'instId';
	const REQUEST_CART_ID = 'cartId';
	const REQUEST_AUTH_MODE = 'authMode';
	const REQUEST_TEST_MODE = 'testMode';
	const REQUEST_AMOUNT = 'amount';
	const REQUEST_CURRENCY = 'currency';
	const REQUEST_HIDE_CURRENCY = 'hideCurrency';
	const REQUEST_NAME = 'name';
	const REQUEST_ADDRESS1 = 'address1';
	const REQUEST_ADDRESS2 = 'address2';
	const REQUEST_CITY = 'town';
	const REQUEST_POSTCODE = 'postcode';
	const REQUEST_COUNTRY = 'country';
	const REQUEST_TELEPHONE = 'tel';
	const REQUEST_EMAIL = 'email';
	const REQUEST_LANGUAGE = 'lang';
	const REQUEST_DESCRIPTION = 'desc';
	const REQUEST_CALLBACK = 'MC_callback';
	const REQUEST_FIX_CONTACT = 'fixContact';
	const REQUEST_HIDE_CONTACT = 'hideContact';
	const REQUEST_NO_LANGUAGE_MENU = 'noLanguageMenu';
	const REQUEST_SIGNATURE = 'signature';
	const REQUEST_SIGNATURE_FIELDS = 'signatureFields';

	/**
	 * @var array
	 */
	protected $parameters = array(
		self::REQUEST_INSTALLATION_ID => null,
		self::REQUEST_CART_ID => null,
		self::REQUEST_AUTH_MODE => null,
		self::REQUEST_TEST_MODE => null,
		self::REQUEST_AMOUNT => null,
		self::REQUEST_CURRENCY => null,
		self::REQUEST_HIDE_CURRENCY => null,
		self::REQUEST_NAME => null,
		self::REQUEST_ADDRESS1 => null,
		self::REQUEST_ADDRESS2 => null,
		self::REQUEST_CITY => null,
		self::REQUEST_POSTCODE => null,
		self::REQUEST_COUNTRY => null,
		self::REQUEST_TELEPHONE => null,
		self::REQUEST_EMAIL => null,
		self::REQUEST_LANGUAGE => null,
		self::REQUEST_DESCRIPTION => null,
		self::REQUEST_CALLBACK => null,
		self::REQUEST_FIX_CONTACT => null,
		self::REQUEST_HIDE_CONTACT => null,
		self::REQUEST_NO_LANGUAGE_MENU => null,
		self::REQUEST_SIGNATURE => null,
		self::REQUEST_SIGNATURE_FIELDS => null,
	);

	public function initialize(Cart $cart)
	{
		$currency = $this->getCurrencyObject($cart->id_currency);
		$language = $this->getLanguageObject($cart->id_lang);
		$customer = $this->getCustomerObject($cart->id_customer);
		$address = $this->getAddressObject($cart->id_address_invoice);
		$country = $this->getCountryObject($address->id_country);

		switch ($this->settings->getValue(WorldPaySettings::PAYMENT_MODE))
		{
			case WorldPaySettings::WORLDPAY_LIVE:

				$this->url = WorldPaySettings::WORLDPAY_LIVE_URL;
				break;

			case WorldPaySettings::WORLDPAY_TEST:
			default:

				$this->url = WorldPaySettings::WORLDPAY_TEST_URL;
				break;
		}

		$this->title = $this->settings->getValue(WorldPaySettings::PAYMENT_TITLE, null, $cart->id_lang);

		$this->parameters[self::REQUEST_INSTALLATION_ID] = $this->settings->getValue(WorldPaySettings::PAYMENT_INSTALLATION_ID);
		$this->parameters[self::REQUEST_CART_ID] = (int)$cart->id;

		$this->parameters[self::REQUEST_AMOUNT] = number_format($cart->getOrderTotal(true, Cart::BOTH), 2, '.', '');
		$this->parameters[self::REQUEST_CURRENCY] = $currency->iso_code;
		$this->parameters[self::REQUEST_HIDE_CURRENCY] = 'true';

		$this->parameters[self::REQUEST_NAME] = $customer->firstname.' '.$customer->lastname;
		$this->parameters[self::REQUEST_ADDRESS1] = $address->address1;
		$this->parameters[self::REQUEST_ADDRESS2] = $address->address2;
		$this->parameters[self::REQUEST_CITY] = $address->city;
		$this->parameters[self::REQUEST_POSTCODE] = $address->postcode;
		$this->parameters[self::REQUEST_COUNTRY] = $country->iso_code;
		$this->parameters[self::REQUEST_TELEPHONE] = !empty($address->phone) ? $address->phone : $address->phone_mobile;
		$this->parameters[self::REQUEST_EMAIL] = $customer->email;
		$this->parameters[self::REQUEST_LANGUAGE] = !empty($language->iso_code) ? $language->iso_code : WorldPaySettings::WORLDPAY_DEFAULT_LOCALE;

		$payment_request_type = $this->settings->getValue(WorldPaySettings::PAYMENT_REQUEST_TYPE);
		$payment_mode = $this->settings->getValue(WorldPaySettings::PAYMENT_MODE);

		$this->parameters[self::REQUEST_AUTH_MODE] = $payment_request_type == WorldPaySettings::WORLDPAY_REQUEST_TYPE_PREAUTHORIZATION ? 'E' : 'A';
		$this->parameters[self::REQUEST_TEST_MODE] = $payment_mode == WorldPaySettings::WORLDPAY_TEST ? '100' : '0';

		$payment_description = $this->settings->getValue(WorldPaySettings::PAYMENT_DESCRIPTION, null, $cart->id_lang);

		$this->parameters[self::REQUEST_DESCRIPTION] = sprintf($payment_description, Configuration::get('PS_SHOP_NAME'));
		$this->parameters[self::REQUEST_CALLBACK] = $this->settings->getModule()->getValidationUrl();

		if ($this->settings->getValue(WorldPaySettings::PAYMENT_FIX_CONTACT) == WorldPaySettings::YES)
			$this->parameters[self::REQUEST_FIX_CONTACT] = 1;

		if ($this->settings->getValue(WorldPaySettings::PAYMENT_HIDE_CONTACT) == WorldPaySettings::YES)
			$this->parameters[self::REQUEST_HIDE_CONTACT] = 1;

		if ($this->settings->getValue(WorldPaySettings::PAYMENT_HIDE_LANGUAGE) == WorldPaySettings::YES)
			$this->parameters[self::REQUEST_NO_LANGUAGE_MENU] = null;

		$checksum = trim($this->settings->getValue(WorldPaySettings::PAYMENT_MD5_CHECKSUM));

		if (!empty($checksum))
		{
			switch ($this->settings->getValue(WorldPaySettings::PAYMENT_SIGNATURE_TYPE))
			{
				case WorldPaySettings::WORLDPAY_SIGNATURE_STATIC:

					$signature_params = explode(':', $this->settings->getValue(WorldPaySettings::PAYMENT_SIGNATURE_PARAMETERS));
					$signature_string = $checksum;

					foreach ($signature_params as $param)
						if (array_key_exists($param, $this->parameters))
							$signature_string .= ':'.$this->parameters[$param];

					$this->parameters[self::REQUEST_SIGNATURE] = md5($signature_string);

					break;

				case WorldPaySettings::WORLDPAY_SIGNATURE_DYNAMIC:

					//'amount:currency:instId:cartId:authMode:email';
					$signature_params_string = $this->settings->getValue(WorldPaySettings::PAYMENT_SIGNATURE_PARAMETERS);
					$signature_params = explode(':', $signature_params_string);

					$this->parameters[self::REQUEST_SIGNATURE_FIELDS] = $signature_params_string;

					$signature_string = $checksum.';'.$signature_params_string;

					foreach ($signature_params as $param)
						if (array_key_exists($param, $this->parameters))
							$signature_string .= ';'.$this->parameters[$param];

					$this->parameters[self::REQUEST_SIGNATURE] = md5($signature_string);

					break;
			}
		}

		$this->initialized = true;
	}

	public function getInstallationId()
	{
		return $this->parameters[self::REQUEST_INSTALLATION_ID];
	}

	public function getCartId()
	{
		return $this->parameters[self::REQUEST_CART_ID];
	}

	public function getAuthMode()
	{
		return $this->parameters[self::REQUEST_AUTH_MODE];
	}

	public function getTestMode()
	{
		return $this->parameters[self::REQUEST_TEST_MODE];
	}

	public function getAmount()
	{
		return $this->parameters[self::REQUEST_AMOUNT];
	}

	public function getCurrency()
	{
		return $this->parameters[self::REQUEST_CURRENCY];
	}

	public function getHideCurrency()
	{
		return $this->parameters[self::REQUEST_HIDE_CURRENCY];
	}

	public function getName()
	{
		return $this->parameters[self::REQUEST_NAME];
	}

	public function getAddress1()
	{
		return $this->parameters[self::REQUEST_ADDRESS1];
	}

	public function getAddress2()
	{
		return $this->parameters[self::REQUEST_ADDRESS2];
	}

	public function getCity()
	{
		return $this->parameters[self::REQUEST_CITY];
	}

	public function getPostCode()
	{
		return $this->parameters[self::REQUEST_POSTCODE];
	}

	public function getCountry()
	{
		return $this->parameters[self::REQUEST_COUNTRY];
	}

	public function getPhone()
	{
		return $this->parameters[self::REQUEST_TELEPHONE];
	}

	public function getEmail()
	{
		return $this->parameters[self::REQUEST_EMAIL];
	}

	public function getLanguage()
	{
		return $this->parameters[self::REQUEST_LANGUAGE];
	}

	public function getDescription()
	{
		return $this->parameters[self::REQUEST_DESCRIPTION];
	}

	public function getCallback()
	{
		return $this->parameters[self::REQUEST_CALLBACK];
	}

	public function isFixContact()
	{
		return $this->parameters[self::REQUEST_FIX_CONTACT];
	}

	public function isHideContact()
	{
		return $this->parameters[self::REQUEST_HIDE_CONTACT];
	}

	public function isNoLanguageMenu()
	{
		return $this->parameters[self::REQUEST_NO_LANGUAGE_MENU];
	}

	public function getSignature()
	{
		return $this->parameters[self::REQUEST_SIGNATURE];
	}

	public function getSignatureFields()
	{
		return $this->parameters[self::REQUEST_SIGNATURE_FIELDS];
	}
}
