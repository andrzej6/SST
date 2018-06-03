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

include_once(_PS_MODULE_DIR_.'/worldpay/classes/worldpaycore.php');

include_once(_PS_MODULE_DIR_.'/worldpay/classes/order/orderworldpay.php');
include_once(_PS_MODULE_DIR_.'/worldpay/classes/order/worldpayorderpayment.php');

include_once(_PS_MODULE_DIR_.'/worldpay/classes/request/worldpayrequest.php');
include_once(_PS_MODULE_DIR_.'/worldpay/classes/response/worldpayresponse.php');

class WorldPayCC extends WorldPayCore {

	/**
	 * @var WorldPayRequest
	 */
	protected $request;

	/**
	 * @var WorldPayResponse
	 */
	protected $response;

	/**
	 * @var Cart
	 */
	protected $cart;

	/**
	 * @var Customer
	 */
	protected $customer;

	/**
	 * @var Context
	 */
	protected $context;

	/**
	 * @var integer
	 */
	protected $id_order;

	public function __construct(WorldPay $module, WorldPaySettings $settings, Context $context = null)
	{
		$this->module = $module;
		$this->settings = $settings;
		$this->context = $context;

		$this->response = new WorldPayResponse($settings);
		$this->response->initialize();

		$this->module->debug(
			sprintf(
				'WorldPay: response initialized. Parameters: %s',
					WorldPayTools::debugArray($this->response->getResponseParameters())
			),
			WorldPay::DEBUG
		);

		$this->cart = new Cart((int)$this->response->getCartId());
		$this->customer = new Customer((int)$this->cart->id_customer);

		if ($this->context)
		{
			$this->context->cart = $this->cart;
			$this->context->customer = $this->customer;

			if (!empty($this->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')}))
			{
				$infos = Address::getCountryAndState((int)$this->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')});

				$country = new Country((int)$infos['id_country']);

				if (Validate::isLoadedObject($country))
					$this->context->country = $country;
			}

			$this->context->language = new Language((int)$this->context->cart->id_lang);
			$this->context->shop = new Shop((int)$this->context->cart->id_shop);
			$this->context->currency = new Currency((int)$this->context->cart->id_currency, null, $this->context->shop->id);
		}

		$this->request = new WorldPayRequest($settings);
		$this->request->initialize($this->cart);

		$this->module->debug(
			sprintf(
				'WorldPay: request initialized. Parameters: %s',
					WorldPayTools::debugArray($this->request->getRequestParameters())
			),
			WorldPay::DEBUG
		);
	}

	public function getCart()
	{
		return $this->cart;
	}

	public function getCustomer()
	{
		return $this->customer;
	}

	public function getContext()
	{
		return $this->context;
	}

	public function getStatus()
	{
		return $this->response->getResponseStatus();
	}

	public function getOrderId()
	{
		return (int)$this->id_order;
	}

	public function processPayment()
	{
		$this->id_order = null;

		$this->validateResponse();

		$this->module->debug(sprintf('WorldPay: processing payment.'), WorldPay::INFO);

		switch ($this->getStatus())
		{
			case PaymentModuleResponse::STATE_SUCCEED:
			case PaymentModuleResponse::STATE_PENDING:

				if ($this->isManualCaptureEnabled())
					return $this->processPendingPayment();

				return $this->processSuccessfulPayment();

			case PaymentModuleResponse::STATE_CANCELED:

				return $this->processCanceledPayment();

			case PaymentModuleResponse::STATE_FAILED:

				return $this->processFailedPayment();
		}
	}

	protected function processSuccessfulPayment()
	{
		$this->validateSuccessfulResponse();

		$amount = $this->response->getAuthAmount();
		$parameters = $this->formatParameters($this->response);
		$message = $this->module->l('authorize: Customer returned successfully');

		if ($this->response->getWafMerchantMessage())
			$message .= ' <br/>'.$this->response->getWafMerchantMessage();

		return $this->validateOrder(PaymentModuleResponse::STATE_SUCCEED, $amount, $message, $parameters);
	}

	protected function processPendingPayment()
	{
		$this->validateSuccessfulResponse();

		$amount = $this->response->getAuthAmount();
		$parameters = $this->formatParameters($this->response);
		$message = $this->module->l('preauthorize: Customer returned successfully');

		if ($this->response->getWafMerchantMessage())
			$message .= ' <br/>'.$this->response->getWafMerchantMessage();

		return $this->validateOrder(PaymentModuleResponse::STATE_PENDING, $amount, $message, $parameters);
	}

	protected function processCanceledPayment()
	{
		if ($this->settings->getValue(WorldPaySettings::PAYMENT_DISABLE_ORDER_ON_CANCEL) == WorldPaySettings::YES)
			return null;

		return $this->validateOrder(PaymentModuleResponse::STATE_CANCELED, 0, $this->module->l('Payment has been canceled.'), array());
	}

	protected function processFailedPayment()
	{
		if ($this->settings->getValue(WorldPaySettings::PAYMENT_DISABLE_ORDER_ON_ERROR) == WorldPaySettings::YES)
			return null;

		return $this->validateOrder(PaymentModuleResponse::STATE_FAILED, 0, $this->module->l('Payment has been failed.'), array());
	}

	protected function isManualCaptureEnabled()
	{
		return $this->settings->getValue(WorldPaySettings::PAYMENT_MANUAL_CAPTURE) == WorldPaySettings::YES;
	}

	protected function getOrderState($state)
	{
		switch ($state)
		{
			case PaymentModuleResponse::STATE_CANCELED:

				return Configuration::get('PS_OS_CANCELED');

			case PaymentModuleResponse::STATE_PENDING:

				return $this->settings->getValue(WorldPaySettings::PAYMENT_PENDING_ORDER_STATUS);

			case PaymentModuleResponse::STATE_SUCCEED:

				return $this->settings->getValue(WorldPaySettings::PAYMENT_ACCEPTED_ORDER_STATUS);

			case PaymentModuleResponse::STATE_FAILED:

			default:

				return Configuration::get('PS_OS_ERROR');
		}
	}

	protected function formatParameters(WorldPayResponse $response)
	{
		$parameters = $response->getResponseParameters();
		$parameters['transaction_id'] = $response->getTransactionId();

		return $parameters;
	}

	protected function validateOrder($response_state, $amount_paid, $message = null, $extra_vars = array())
	{
		$this->module->debug(sprintf('WorldPay: validate order.'), WorldPay::INFO);

		$id_cart = (int)$this->cart->id;
		$id_order_state = (int)$this->getOrderState($response_state);
		$payment_method = $this->module->displayName;
		$secure_key = $this->cart->secure_key;

		if ($this->response->getRAWAuthMessage())
			$message .= ' <br/>'.$this->response->getRAWAuthMessage();

		$message .= ' </br>';

		if ($this->module->validateOrder($id_cart, $id_order_state, $amount_paid, $payment_method, $message, $extra_vars, null, false, $secure_key))
		{
			$order = new Order($this->module->currentOrder);

			if ($order->reference)
			{
				$order_payment = new WorldPayOrderPayment($order);
				$order_payment->saveOrderWorldPay($this->response);
			}

			$this->module->debug(sprintf(
				'WorldPay: save response. OrderID: %s; Order reference: %s;',
				$order->id,
				$order->reference
			), WorldPay::DEBUG);
		}

		$this->module->debug(
			sprintf(
				'WorldPay: validate order. Cart ID: %s; Amount: %s; Order State: %s; Secure Key: %s; Order ID: %s; Extra vars: %s;',
					$id_cart,
					$amount_paid,
					$id_order_state,
					$secure_key,
					$this->module->currentOrder,
					WorldPayTools::debugArray($extra_vars)
			),
			WorldPay::DEBUG
		);

		$this->id_order = $this->module->currentOrder;

		return $this->module->currentOrder;
	}

	protected function validateResponse()
	{
		$this->module->debug(sprintf('WorldPay: validating payment.'), WorldPay::INFO);

		if (!Validate::isLoadedObject($this->cart))
			throw new WorldPayException(Tools::displayError('Cart not found'));

		if ($this->cart->OrderExists())
			throw new WorldPayException(Tools::displayError('Order already exist'));

		if ($this->response->getCallbackPassword() != $this->settings->getValue(WorldPaySettings::PAYMENT_RESPONSE_PASSWORD))
			throw new WorldPayException(Tools::displayError('Transaction password wrong'));
	}

	protected function validateSuccessfulResponse()
	{
		if ($this->getSettings()->getValue(WorldPaySettings::PAYMENT_AMOUNT_CHECK, WorldPaySettings::YES))
		{
			$this->module->debug(sprintf('WorldPay: processing successful payment.'), WorldPay::INFO);

			// check transaction amount
			if ($this->request->getAmount() != $this->response->getAuthAmount())
				throw new WorldPayException(Tools::displayError('Transaction amount doesn\'t match.'));

			// check transaction currency
			if ($this->request->getCurrency() != $this->response->getAuthCurrency())
				throw new WorldPayException(Tools::displayError('Transaction currency doesn\'t match.'));
		}
	}
}
