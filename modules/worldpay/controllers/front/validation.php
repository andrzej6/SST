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

class WorldPayValidationModuleFrontController extends ModuleFrontController {

	public $ssl = true;

	public $id_lang;

	public $display_header = false;
	public $display_footer = false;

	public $display_column_left = false;
	public $display_column_right = false;

	public $content_only = true;
	public $auth = false;

	public $php_self = null;
	public $redirect_after = null;

	public $process_order;
	public $process_status;

	public $settings;
	public $payment;

	public function __construct()
	{
		parent::__construct();

		$this->display_column_left = false;
		$this->display_column_right = false;
		$this->display_header = false;
		$this->display_footer = false;

		$this->content_only = true;
		$this->auth = false;
	}

	public function init()
	{
		parent::init();

		$this->process_order = null;
		$this->process_status = null;

		try
		{
			$this->module->debug(sprintf('WorldPay: Payment validation started. Time: %s', time()), WorldPay::INFO);
			$this->module->debug(sprintf('WorldPay: Payment validation started by %s.', Tools::jsonEncode($_SERVER)), WorldPay::DEBUG);

			$this->settings = WorldPaySettings::getInstance();
			$this->payment = new WorldPayCC($this->module, $this->settings, $this->context);

			$this->id_lang = $this->context->language->id;

			$cart = $this->payment->getCart();

			if ($cart->id_customer == 0 || $cart->id_address_delivery == 0 || $cart->id_address_invoice == 0 || !$this->module->active)
			{
				$this->module->debug(sprintf('WorldPay: invalid data: Cart ID: %s, Customer id: %s', (int)$cart->id, (int)$cart->id_customer), WorldPay::INFO);

				return;
			}

			$this->module->debug(sprintf('WorldPay: cart initialized. Cart ID: %s;', $cart->id), WorldPay::INFO);

			$this->id_lang = $cart->id_lang;

			$customer = $this->payment->getCustomer();

			if (!Validate::isLoadedObject($customer))
			{
				$this->module->debug(sprintf('WorldPay: customer not loaded!'), WorldPay::INFO);

				return;
			}

			$this->module->debug(sprintf('WorldPay: customer initialized. Customer ID: %s;', $customer->id), WorldPay::INFO);

			$this->payment->processPayment();

			$this->process_order = $this->payment->getOrderId();
			$this->process_status = $this->payment->getStatus();

			$this->module->debug(sprintf('WorldPay: payment validation finished. Order ID: %s; Time: %s', $this->process_order, time()), WorldPay::INFO);
		}
		catch (PrestaShopException $e)
		{
			$this->module->debug(sprintf('WorldPay: payment exception. Exception: %s; Time: %s', $e->getMessage(), time()), WorldPay::DEBUG);

			$e->displayMessage();
		}
	}

	public function postProcess()
	{
		$this->module->debug(sprintf('WorldPay: init content. Time: %s', time()), WorldPay::DEBUG);

		$opc = (bool)Configuration::get('PS_ORDER_PROCESS_TYPE');
		$default_redirect_time = WorldPaySettings::WORLDPAY_DEFAULT_REDIRECT_DELAY;

		$redirect_time = (int)$this->settings->getValue(WorldPaySettings::PAYMENT_SHOPPER_REDIRECT_DELAY, $default_redirect_time);
		$redirect_url = $this->context->link->getPageLink(($opc ? 'order-opc' : 'order'), true, $this->id_lang, array('step' => 1));

		if ($this->process_order)
		{
			$cart = $this->payment->getCart();

			$url_params = array(
				'id_cart' => (int)$cart->id,
				'id_module' => (int)$this->module->id,
				'id_order' => $this->process_order,
				'key' => $cart->secure_key,
			);

			$redirect_url = $this->context->link->getPageLink('order-confirmation',	$this->ssl,	$this->id_lang, $url_params);
		}

		$this->context->smarty->assign(array(
			'redirect_enabled' => $redirect_time > 0,
			'redirect_time' => $redirect_time,
			'redirect_url' => $redirect_url,
		));

		$this->module->debug(
			sprintf(
				'WorldPay: init content. Status: %s; Time: %s; Redirect: %s; Redirect time: %s',
					$this->process_status,
					time(),
					$redirect_url,
					$redirect_time
			),
			WorldPay::DEBUG
		);

		switch ($this->process_status)
		{
			case PaymentModuleResponse::STATE_SUCCEED:
			case PaymentModuleResponse::STATE_PENDING:

				return $this->setTemplate('result_success.tpl');

			case PaymentModuleResponse::STATE_CANCELED:

				return $this->setTemplate('result_canceled.tpl');
		}

		return $this->setTemplate('result_failed.tpl');
	}

	protected function smartyOutputContent($content)
	{
		$this->context->smarty->display($content);
	}

	/**
	 * @see Controller::checkAccess()
	 *
	 * @return boolean
	 */
	public function checkAccess()
	{
		return true;
	}

	/**
	 * @see Controller::viewAccess
	 *
	 * @return boolean
	 */
	public function viewAccess()
	{
		return true;
	}

	public function initHeader()
	{
	}

	public function initContent()
	{
	}

	public function initFooter()
	{
	}

	public function process()
	{
	}

	public function redirect()
	{
	}

	public function recoverCart()
	{
		return false;
	}

	public function displayMaintenancePage()
	{
		return false;
	}

	public function displayRestrictedCountryPage()
	{
		return false;
	}
}
