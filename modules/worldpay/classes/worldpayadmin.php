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
include_once(_PS_MODULE_DIR_.'/worldpay/classes/api/worldpayapi.php');

include_once(_PS_MODULE_DIR_.'/worldpay/classes/order/orderworldpay.php');
include_once(_PS_MODULE_DIR_.'/worldpay/classes/order/worldpayorderpayment.php');

class WorldPayAdmin extends WorldPayCore
{
	/**
	 * @var Order
	 */
	protected $order;

	/**
	 * @var Currency
	 */
	protected $currency;

	/**
	 * @var OrderWorldpay
	 */
	protected $worldpay;

	/**
	 * @var Employee
	 */
	protected $employee;

	/**
	 * @var WorldPayOrderPayment
	 */
	protected $payment;

	/**
	 * @var boolean
	 */
	protected $initialized = false;

	public function initialize(Order $order, Employee $employee)
	{
		$this->order = $order;

		if (!Validate::isLoadedObject($this->order))
			throw new WorldPayException(Tools::displayError('Invalid order'));

		$this->currency = new Currency($this->order->id_currency);

		if (!Validate::isLoadedObject($this->currency))
			throw new WorldPayException(Tools::displayError('Currency is not valid'));

		$this->worldpay = new OrderWorldpay();
		$this->worldpay->getByOrderId($this->order->id);

		if (!Validate::isLoadedObject($this->worldpay))
			throw new WorldPayException(Tools::displayError('Invalid worldpay details'));

		$this->payment = new WorldPayOrderPayment($order);

		$transaction_id = $this->worldpay->transaction_id;
		$transaction_status = $this->worldpay->transaction_status;

		if ($transaction_id && !Validate::isLoadedObject($this->payment) && $transaction_status != WorldPayResponse::STATE_PENDING)
			throw new WorldPayException(Tools::displayError('No order payment details for the reference'));

		$this->employee = $employee;

		if (!Validate::isLoadedObject($this->employee))
			throw new WorldPayException(Tools::displayError('Unknown employee'));

		$this->module->debug(sprintf(
			'WorldPay: admin initialized. Order ID: %s; Currency ID: %s; OrderWorldPay ID: %s; OrderPayment ID: %s; Employee ID: %s;',
			$this->order->id,
			$this->currency->id,
			$this->worldpay->id,
			$this->payment->id,
			$this->employee->id
		), WorldPay::DEBUG);

		$this->initialized = true;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function getOrderPayment()
	{
		return $this->payment;
	}

	public function getOrderWorldPay()
	{
		return $this->worldpay;
	}

	public function getCurrency()
	{
		return $this->currency;
	}

	public function getAdminUrl()
	{
		if ($this->settings->getValue(WorldPaySettings::PAYMENT_MODE) == WorldPaySettings::WORLDPAY_LIVE)
			return WorldPaySettings::WORLDPAY_LIVE_ADMIN_URL;

		return WorldPaySettings::WORLDPAY_TEST_ADMIN_URL;
	}

	public function canCapture()
	{
		$online_operations_enabled = $this->settings->getValue(WorldPaySettings::PAYMENT_ENABLE_ONLINE_OPERATIONS);
		$manual_capture_enabled = $this->settings->getValue(WorldPaySettings::PAYMENT_MANUAL_CAPTURE);

		if (!$online_operations_enabled || !$manual_capture_enabled || !$this->initialized)
			return false;

		if ($this->worldpay->authorization_mode != 'E')
			return false;

		if ($this->worldpay->transaction_status != WorldPayResponse::STATE_PENDING)
			return false;

		if (empty($this->worldpay->transaction_id))
			return false;

		return true;
	}

	public function canRefund()
	{
		if (!$this->settings->getValue(WorldPaySettings::PAYMENT_ENABLE_ONLINE_OPERATIONS) || !$this->initialized)
			return false;

		if ($this->worldpay->transaction_status != WorldPayResponse::STATE_SUCCEED)
			return false;

		if ($this->worldpay->transaction_id != $this->payment->getTransactionId())
			return false;

		return true;
	}

	public function capture()
	{
		if (!$this->canCapture())
			throw new WorldPayException(Tools::displayError('Capture not allowed'));

		$params = $this->prepareAdminParameters();
		$params['transId'] = $this->worldpay->transaction_id;
		$params['authMode'] = '0';
		$params['op'] = 'postAuth-full';

		$this->module->debug('WorldPay: prepare confirm parameters.', WorldPay::INFO);

		$response = $this->sendAdminParameters($params);

		$this->module->debug('WorldPay: confirm response received.', WorldPay::INFO);

		return $this->finishConfirm($response);
	}

	public function refund($amount, $state = null)
	{
		if (!$this->canRefund())
			throw new WorldPayException(Tools::displayError('Refund not allowed'));

		if ($amount <= 0)
			throw new WorldPayException(Tools::displayError('Invalid amount'));

		if ($amount > $this->payment->getAmount())
			$amount > $this->payment->getAmount();

		$params = $this->prepareAdminParameters();
		$params['cartId']  = 'Refund';
		$params['op']      = 'refund-partial';
		$params['transId'] = $this->worldpay->transaction_id;
		$params['amount']  = $amount;
		$params['currency'] = $this->currency->iso_code;

		$this->module->debug('WorldPay: prepare refund parameters.', WorldPay::INFO);

		$response = $this->sendAdminParameters($params);

		$this->module->debug('WorldPay: refund response received. Response: %s', WorldPay::INFO);

		return $this->finishRefund($response, $state);
	}

	protected function finishConfirm($response)
	{
		$response_array = explode(',', $response);

		$result = true;
		$message = $this->module->l('WorldPay: capture payment successful.');

		if (count($response_array) <= 0 || $response_array[0] != 'A' || $response_array[1] != $this->worldpay->transaction_id)
		{
			$message = $this->module->l('WorldPay: error during capture online.');

			$result = false;
		}
		else
		{
			$state = (int)$this->settings->getValue(WorldPaySettings::PAYMENT_ACCEPTED_ORDER_STATUS);

			if ($state)
			{
				$this->changeOrderState($state);

				$this->module->debug(sprintf(
					'WorldPay: confirmation. Order ID: %s; State: %s;',
					$this->order->id,
					$state
				), WorldPay::DEBUG);
			}

			OrderWorldpay::changeTransactionStatus($this->order->id, WorldPayResponse::STATE_SUCCEED);
		}

		$message .= ' <br/>'.$this->module->l('Employee:').' '.$this->employee->firstname.' '.$this->employee->lastname;
		$message .= ' <br/>'.sprintf($this->module->l('Server response: %s'), $response);

		$this->sendPrivateMessage($message);

		$this->module->debug(sprintf(
			'WorldPay: confirmation finished. Status: %s; Message: %s;',
			(int)$result,
			$message
		), WorldPay::DEBUG);

		return $result;
	}

	protected function finishRefund($response, $state = null)
	{
		$response_array = explode(',', $response);

		$result = true;
		$message = $this->module->l('WorldPay: refund payment successful.');

		if (count($response_array) <= 0 || $response_array[0] != 'A' || $response_array[1] != (int)$this->worldpay->transaction_id)
		{
			$message = $this->module->l('Error during refunding online.');

			$result = false;
		}
		else
		{
			if (!empty($state))
			{
				$this->order->setCurrentState($state, $this->employee->id);

				$this->module->debug(sprintf(
					'WorldPay: refund state changed. State: %s;',
					$state
				), WorldPay::DEBUG);
			}

			OrderWorldpay::changeTransactionStatus($this->order->id, WorldPayResponse::STATE_REFUNDED);
		}

		$message .= ' <br/>'.$this->module->l('Employee:').' '.$this->employee->firstname.' '.$this->employee->lastname;
		$message .= ' <br/>'.sprintf($this->module->l('Server response: %s'), $response);

		$this->sendPrivateMessage($message);

		$this->module->debug(sprintf(
			'WorldPay: refund finished. Status: %s; Message: %s;',
			(int)$result,
			$message
		), WorldPay::DEBUG);

		return $result;
	}

	protected function changeOrderState($id_order_state)
	{
		$order_state = new OrderState($id_order_state);

		if (!Validate::isLoadedObject($order_state))
			throw new WorldPayException(Tools::displayError('Invalid new order status'));

		$current_order_state = $this->order->getCurrentOrderState();

		if ($current_order_state->id != $order_state->id)
		{
			// Create new OrderHistory
			$history = new OrderHistory();
			$history->id_order = $this->order->id;
			$history->id_employee = (int)$this->employee->id;

			$use_existings_payment = false;

			if (!$this->order->hasInvoice())
				$use_existings_payment = true;

			$history->changeIdOrderState($order_state->id, $this->order->id, $use_existings_payment);

			$carrier = new Carrier($this->order->id_carrier, $this->order->id_lang);

			$template_vars = array();

			if ($history->id_order_state == Configuration::get('PS_OS_SHIPPING') && $this->order->shipping_number)
				$template_vars = array('{followup}' => str_replace('@', $this->order->shipping_number, $carrier->url));

			// Save all changes
			if ($history->addWithemail(true, $template_vars))
			{
				// synchronizes quantities if needed..
				if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT'))
					foreach ($this->order->getProducts() as $product)
						if (StockAvailable::dependsOnStock($product['product_id']))
							StockAvailable::synchronize($product['product_id'], (int)$product['id_shop']);

				if ($this->order->reference)
				{
					$order_payment = new WorldPayOrderPayment($this->order);
					$order_payment->saveTransactionDetails($this->worldpay);
				}

				return true;
			}

			throw new WorldPayException(Tools::displayError('An error occurred while changing the status or was unable to send e-mail to the customer.'));
		}

		return true;
	}

	protected function sendPrivateMessage($message)
	{
		$new_message = new Message();

		$message = strip_tags($message, '<br>');

		if (!Validate::isCleanHtml($message))
			$message = $this->module->l('Payment message is not valid, please check your module.');

		$new_message->message = $message;
		$new_message->id_order = (int)$this->order->id;
		$new_message->private = 1;

		return $new_message->add();
	}

	protected function sendAdminParameters($params, $request_timeout = 60)
	{
		try
		{
			$this->module->debug(sprintf(
				'WorldPay: sending admin request. URL: %s; Parameters: %s; Timeout: %s;',
				$this->getAdminUrl(),
				WorldPayTools::debugArray($params),
				$request_timeout
			), WorldPay::DEBUG);

			$worldpay_api = new WorldPayAPI();
			$worldpay_api->setUrl($this->getAdminUrl());
			$worldpay_api->setParams($params);
			$worldpay_api->setConfig(array(
				'timeout' => $request_timeout,
			));

			$response = $worldpay_api->sendRequest()->getResponseBody();

			$this->module->debug(sprintf(
				'WorldPay: admin response received: %s.',
				$response
			), WorldPay::DEBUG);

			if (empty($response))
				throw new WorldPayException(Tools::displayError('Worldpay API failure. The request has not been processed.'));
		}
		catch (Exception $e)
		{
			throw new WorldPayException(Tools::displayError('Worldpay API connection error. The request has not been processed.'));
		}

		return $response;
	}

	protected function prepareAdminParameters()
	{
		$params = array (
			'authPW'  => $this->settings->getValue(WorldPaySettings::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS),
			'instId'  => $this->settings->getValue(WorldPaySettings::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID),
		);

		if ($this->settings->getValue(WorldPaySettings::PAYMENT_MODE) == WorldPaySettings::WORLDPAY_TEST)
			$params['testMode'] = 100;

		return $params;
	}
}
