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

include_once(_PS_MODULE_DIR_.'/worldpay/classes/response/paymentmoduleresponse.php');

class WorldPayResponse extends PaymentModuleResponse {

	const RESPONSE_TRANSACTION_ID = 'transId';
	const RESPONSE_CART_ID = 'cartId';
	const RESPONSE_TRANSACTION_STATUS = 'transStatus';
	const RESPONSE_TRANSACTION_TIME = 'transTime';
	const RESPONSE_TRANSACTION_AVS = 'AVS';
	const RESPONSE_TRANSACTION_WAF = 'wafMerchMessage';
	const RESPONSE_TRANSACTION_AUTH = 'authentication';
	const RESPONSE_AUTHORIZATION_MODE = 'authMode';
	const RESPONSE_AUTHORIZED_AMOUNT = 'authAmount';
	const RESPONSE_AUTHORIZED_CURRENCY = 'authCurrency';
	const RESPONSE_RAW_AUTHORIZED_MESSAGE = 'rawAuthMessage';
	const RESPONSE_CALLBACK_PASSWORD = 'callbackPW';
	const RESPONSE_CARD_TYPE = 'cardType';
	const RESPONSE_COUNTRY_MATCH = 'countryMatch';
	const RESPONSE_IP_ADDRESS = 'ipAddress';

	protected $parameters = array(
		self::RESPONSE_TRANSACTION_ID => null,
		self::RESPONSE_CART_ID => null,
		self::RESPONSE_TRANSACTION_STATUS => null,
		self::RESPONSE_TRANSACTION_TIME => null,
		self::RESPONSE_TRANSACTION_AVS => null,
		self::RESPONSE_TRANSACTION_WAF => null,
		self::RESPONSE_TRANSACTION_AUTH => null,
		self::RESPONSE_AUTHORIZATION_MODE => null,
		self::RESPONSE_AUTHORIZED_AMOUNT => null,
		self::RESPONSE_AUTHORIZED_CURRENCY => null,
		self::RESPONSE_RAW_AUTHORIZED_MESSAGE => null,
		self::RESPONSE_CALLBACK_PASSWORD => null,
		self::RESPONSE_CARD_TYPE => null,
		self::RESPONSE_COUNTRY_MATCH => null,
		self::RESPONSE_IP_ADDRESS => null,
	);

	public function initialize()
	{
		if (!WorldPayTools::isMethod(self::$response_method))
			throw new WorldPayException(Tools::displayError('Wrong request type.'));

		if (empty($_POST))
			throw new WorldPayException(Tools::displayError('Request doesn\'t contain POST elements.'));

		$this->parameters[self::RESPONSE_TRANSACTION_ID] = WorldPayTools::postIsset('transId') ? $_POST['transId'] : null;
		$this->parameters[self::RESPONSE_CART_ID] = WorldPayTools::postIsset('cartId') ? $_POST['cartId'] : null;
		$this->parameters[self::RESPONSE_TRANSACTION_STATUS] = WorldPayTools::postIsset('transStatus') ? $_POST['transStatus'] : null;
		$this->parameters[self::RESPONSE_TRANSACTION_TIME] = WorldPayTools::postIsset('transTime') ? $_POST['transTime'] : null;
		$this->parameters[self::RESPONSE_TRANSACTION_AVS] = WorldPayTools::postIsset('AVS') ? $_POST['AVS'] : null;
		$this->parameters[self::RESPONSE_TRANSACTION_WAF] = WorldPayTools::postIsset('wafMerchMessage') ? $_POST['wafMerchMessage'] : null;
		$this->parameters[self::RESPONSE_TRANSACTION_AUTH] = WorldPayTools::postIsset('authentication') ? $_POST['authentication'] : null;
		$this->parameters[self::RESPONSE_AUTHORIZATION_MODE] = WorldPayTools::postIsset('authMode') ? $_POST['authMode'] : null;
		$this->parameters[self::RESPONSE_AUTHORIZED_AMOUNT] = WorldPayTools::postIsset('authAmount') ? $_POST['authAmount'] : null;
		$this->parameters[self::RESPONSE_AUTHORIZED_CURRENCY] = WorldPayTools::postIsset('authCurrency') ? $_POST['authCurrency'] : null;
		$this->parameters[self::RESPONSE_RAW_AUTHORIZED_MESSAGE] = WorldPayTools::postIsset('rawAuthMessage') ? $_POST['rawAuthMessage'] : null;
		$this->parameters[self::RESPONSE_CALLBACK_PASSWORD] = WorldPayTools::postIsset('callbackPW') ? $_POST['callbackPW'] : null;
		$this->parameters[self::RESPONSE_CARD_TYPE] = WorldPayTools::postIsset('cardType') ? $_POST['cardType'] : null;
		$this->parameters[self::RESPONSE_COUNTRY_MATCH] = WorldPayTools::postIsset('countryMatch') ? $_POST['countryMatch'] : null;
		$this->parameters[self::RESPONSE_IP_ADDRESS] = WorldPayTools::postIsset('ipAddress') ? $_POST['ipAddress'] : null;

		$this->initialized = true;
	}

	public function getResponseStatus()
	{
		switch ($this->getTransactionStatus())
		{
			case 'C':

				return self::STATE_CANCELED;

			case 'Y':

				switch ($this->getAuthMode())
				{
					case 'A':
					case 'E':

						if ($this->isManualCapture())
							return self::STATE_PENDING;

						return self::STATE_SUCCEED;
				}
		}

		return self::STATE_FAILED;
	}

	public function getTransactionId()
	{
		return $this->parameters[self::RESPONSE_TRANSACTION_ID];
	}

	public function getCartId()
	{
		return $this->parameters[self::RESPONSE_CART_ID];
	}

	public function getTransactionStatus()
	{
		return $this->parameters[self::RESPONSE_TRANSACTION_STATUS];
	}

	public function getTransactionTime()
	{
		return $this->parameters[self::RESPONSE_TRANSACTION_TIME];
	}

	public function getAVS()
	{
		return $this->parameters[self::RESPONSE_TRANSACTION_AVS];
	}

	public function getWafMerchantMessage()
	{
		return $this->parameters[self::RESPONSE_TRANSACTION_WAF];
	}

	public function getAuthentication()
	{
		return $this->parameters[self::RESPONSE_TRANSACTION_AUTH];
	}

	public function getAuthMode()
	{
		return $this->parameters[self::RESPONSE_AUTHORIZATION_MODE];
	}

	public function getAuthAmount()
	{
		return $this->parameters[self::RESPONSE_AUTHORIZED_AMOUNT];
	}

	public function getAuthCurrency()
	{
		return $this->parameters[self::RESPONSE_AUTHORIZED_CURRENCY];
	}

	public function getRAWAuthMessage()
	{
		if ($this->settings->getValue(WorldPaySettings::PAYMENT_RAW_MESSAGE))
			return $this->parameters[self::RESPONSE_RAW_AUTHORIZED_MESSAGE];

		return null;
	}

	public function getCallbackPassword()
	{
		return $this->parameters[self::RESPONSE_CALLBACK_PASSWORD];
	}

	public function getCardType()
	{
		return $this->parameters[self::RESPONSE_CARD_TYPE];
	}

	public function getCountryMatch()
	{
		return $this->parameters[self::RESPONSE_COUNTRY_MATCH];
	}

	public function getIPAddress()
	{
		return $this->parameters[self::RESPONSE_IP_ADDRESS];
	}
}
