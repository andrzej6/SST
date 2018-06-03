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

include_once(_PS_MODULE_DIR_.'/worldpay/classes/worldpaysettings.php');
include_once(_PS_MODULE_DIR_.'/worldpay/classes/worldpaycc.php');
include_once(_PS_MODULE_DIR_.'/worldpay/classes/worldpayadmin.php');

include_once(_PS_MODULE_DIR_.'/worldpay/worldpaytools.php');

class WorldPay extends PaymentModule
{
	const VALIDATION_CONTROLLER = 'validation';

	const DEBUG = 0;
	const INFO = 1;
	const WARNING = 2;
	const ERROR = 3;

	const INSTALL_SQL_FILE = 'db_install.sql';
	const UPDATE_SQL_FILE = 'db_update.sql';
	const UNINSTALL_SQL_FILE = 'db_uninstall.sql';

	public $errors = array();

	public $bootstrap = false;

	public $bootstrap_template = '';

	private static $hooks = array(
		'displayHeader',
		'payment',
		'paymentReturn',
		'adminOrder',
	);

	private static $settings = array(
		'WorldPaySettings',
	);

	private $html = '';

	private $tab_title = array();

	private $id_lang;

	public function __construct()
	{
		$this->name = 'worldpay';
		$this->tab = 'payments_gateways';
		$this->version = '2.2.0';
		$this->author = 'modulesmarket.com';
		$this->module_key = '0b5868e0eef2cdb59336654e8e52a77b';

		$this->currencies = true;
		$this->currencies_mode = 'radio';

		parent::__construct();

		$this->displayName = $this->l('WorldPay');
		$this->description = $this->l('This module allows you to accept payments by WorldPay.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete WorldPay payment module?');

		$this->id_lang = (int)$this->context->language->id;

		foreach (self::$settings as $class)
			call_user_func(array($class, 'setInstance'), $this);

		$this->checkWarnings();

		$this->setCompatibility();

		$this->context->smarty->assign('_worldpay_module', $this);
	}

	private function setCompatibility()
	{
		$has_bootstrap = Tools::version_compare('1.6', _PS_VERSION_);

		$this->bootstrap = $has_bootstrap;
		$this->bootstrap_template = $has_bootstrap ? 'bootstrap-' : null;

		$this->context->smarty->assign('bootstrap', $this->bootstrap);
		$this->context->smarty->assign('bootstrap_prefix', $this->bootstrap_template);
	}

	private function checkWarnings()
	{
		if (_PS_VERSION_ < '1.5' || _PS_VERSION_ >= '1.7')
			$this->warning .= ' '.$this->l('This version of the WorldPay module can only be installed on Prestashop 1.5');

		if (!function_exists('curl_init'))
		{
			$this->debug(sprintf('cURL extension must be enabled on your server to use this module.'), WorldPay::WARNING);

			$this->warning .= ' '.$this->l('cURL extension must be enabled on your server to use this module.');
		}

		if (!$this->active)
			return;

		if (!WorldPaySettings::getInstance()->getValue(WorldPaySettings::PAYMENT_INSTALLATION_ID))
		{
			$this->debug(sprintf('Installation ID must be configured before using this module.'), WorldPay::WARNING);

			$this->warning .= ' '.$this->l('Installation ID must be configured before using this module.');
		}

		if (!count(Currency::checkPaymentCurrencies($this->id)))
		{
			$this->debug(sprintf('No currency has been set for this module'), WorldPay::WARNING);

			$this->warning .= ' '.$this->l('No currency has been set for this module');
		}
	}

	public function install()
	{
		if (_PS_VERSION_ < '1.5' || _PS_VERSION_ >= '1.7')
			return false;

		if (!WorldPayTools::installSettings(self::$settings))
		{
			$this->debug('WorldPay: error while installing settings.', WorldPay::ERROR);

			return false;
		}

		if (!WorldPayTools::executeFileQueries($this, self::INSTALL_SQL_FILE))
		{
			$this->debug('WorldPay: error while installing db.', WorldPay::ERROR);

			return false;
		}

		if (!WorldPayTools::executeFileQueries($this, self::UPDATE_SQL_FILE, true))
		{
			$this->debug('WorldPay: error while updating db.', WorldPay::ERROR);

			return false;
		}

		if (!parent::install())
		{
			$this->debug('WorldPay: error while installing module.', WorldPay::ERROR);

			return false;
		}

		if (!WorldPayTools::registerHooks($this, self::$hooks))
		{
			$this->debug('WorldPay: error while registering hooks.', WorldPay::ERROR);

			return false;
		}

		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall())
		{
			$this->debug('WorldPay: error while uninstalling module.', WorldPay::ERROR);

			return false;
		}

		if (!WorldPayTools::uninstallSettings(self::$settings))
		{
			$this->debug('WorldPay: error while uninstalling settings.', WorldPay::ERROR);

			return false;
		}

		return true;
	}

	public function getContent()
	{
		$this->html = null;

		foreach (self::$settings as $class)
		{
			$instance = call_user_func(array($class, 'getInstance'));

			$this->html .= $instance->submitForm();
		}

		$this->html .= '
			<h2>'.$this->displayName.'</h2>
			<link type="text/css" rel="stylesheet" href="'.$this->getPathUri().'views/css/'.$this->name.'.css" />
		';

		$this->html .= $this->reset();
		$this->html .= $this->displayInfos();

		foreach (self::$settings as $class)
		{
			$instance = call_user_func(array($class, 'getInstance'));

			$this->html .= '
				<div class="tab-page" id="'.$instance->getFormName().'">
					'.$instance->showForm($this->id_lang).'
				</div>
			';
		}

		$this->html .= '<div class="clear"></div>';

		return $this->html;
	}

	private function displayInfos()
	{
		$this->smarty->assign(array(
			'payment_response_url' => $this->getValidationUrl(),
			'worldpay_help_url' => $this->getWorldpayHelpUrl(),
			'module_user_guide_url' => $this->getUserGuideUrl(),
		));

		return $this->display(__FILE__, 'infos.tpl');
	}

	private function reset()
	{
		$html = null;

		$reinstall_hooks = Tools::getValue('reinstall_hooks');

		$reinstall_db = Tools::getValue('reinstall_db');
		$reinstall_db_full = Tools::getValue('full_reinstall_db');

		if (!empty($reinstall_hooks))
		{
			WorldPayTools::registerHooks($this, self::$hooks);

			$this->debug(sprintf('WorldPay: hooks reinstalled.'), WorldPay::INFO);

			$html .= '<div class="conf confirm">'.$this->l('Hooks reinstalled').'</div>';
		}

		if (!empty($reinstall_db) || !empty($reinstall_db_full))
		{
			if (!empty($reinstall_db_full))
			{
				$this->debug(sprintf('WorldPay: db full reinstall.'), WorldPay::INFO);

				WorldPayTools::executeFileQueries($this, self::UNINSTALL_SQL_FILE);
			}

			WorldPayTools::executeFileQueries($this, self::INSTALL_SQL_FILE);
			WorldPayTools::executeFileQueries($this, self::UPDATE_SQL_FILE, true);

			$this->debug(sprintf('WorldPay: db reinstalled.'), WorldPay::INFO);

			$html .= '<div class="conf confirm">'.$this->l('DB reinstalled').'</div>';
		}

		return $html;
	}

	/* HOOKS */

	public function hookDisplayHeader()
	{
		if ($this->bootstrap)
			$this->context->controller->addCSS($this->getPathUri().'views/css/'.$this->name.'.css', 'all');
	}

	public function hookPayment()
	{
		$settings = WorldPaySettings::getInstance();

		$worldpay = new WorldPayRequest($settings);
		$worldpay->initialize($this->context->cart);

		$request_url = $worldpay->getRequestUrl();
		$request_parameters = $worldpay->getRequestParameters();
		$request_title = $worldpay->getRequestTitle();

		$this->debug(sprintf('WorldPay: request initialized. URL: %s; Parameters: %s;', $request_url, WorldPayTools::debugArray($request_parameters)));

		$this->smarty->assign(array(
			'request_url' => $request_url,
			'request_parameters' => $request_parameters,
			'request_title' => $request_title,

			'this_path' => $this->getPathUri(),
			'this_path_ssl' => Tools::getShopDomainSsl(true, true).$this->getPathUri(),
		));

		$this->debug(sprintf('WorldPay: payment displayed. Cart ID: %s.', $this->context->cart->id));

		return $this->display(__FILE__, 'payment.tpl');
	}

	public function hookPaymentReturn($params)
	{
		$order = $params['objOrder'];

		if (!Validate::isLoadedObject($order) || $order->module != $this->name)
			return;

		$settings = WorldPaySettings::getInstance();
		$worldpay = new WorldPayResponse($settings);

		$payment_status = $worldpay->getResponseState($order->current_state);

		$this->smarty->assign(array(
			'total_to_pay' => Tools::displayPrice($params['total_to_pay'], $params['currencyObj'], false),
			'id_order' => $order->id,
			'reference' => $order->reference,
			'status' => $payment_status,

			'_PAYMENT_STATE_SUCCEED_' => WorldPayResponse::STATE_SUCCEED,
			'_PAYMENT_STATE_PENDING_' => WorldPayResponse::STATE_PENDING,
			'_PAYMENT_STATE_CANCELED_' => WorldPayResponse::STATE_CANCELED,
			'_PAYMENT_STATE_FAILED_' => WorldPayResponse::STATE_FAILED,
		));

		$this->debug(sprintf(
			'WorldPay: payment displayed. Order ID: %s; Payment status: %s; Parameters: %s',
			$order->id,
			$payment_status,
			WorldPayTools::debugArray($params)
		), WorldPay::DEBUG);

		return $this->display(__FILE__, 'payment_return.tpl');
	}

	public function hookAdminOrder($params)
	{
		$order = new Order((int)$params['id_order']);

		if (!Validate::isLoadedObject($order) || $order->module != $this->name)
			return;

		$settings = WorldPaySettings::getInstance();
		$order_state = 0;
		$amount = 0.00;

		try
		{
			$worldpay = new WorldPayAdmin($this, $settings);
			$worldpay->initialize($order, $this->context->employee);

			$amount = $worldpay->getOrderPayment()->getAmount();

			if (Tools::isSubmit('submitWorldPayCapture'))
			{
				if ($worldpay->capture())
				{
					$this->debug(sprintf('WorldPay: payment successfully captured.'), WorldPay::INFO);

					Tools::redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$this->debug(sprintf('WorldPay: error during capture online.'), WorldPay::INFO);

					$this->context->controller->errors[] = $this->l('Error during capture online.');
				}
			}
			elseif (Tools::isSubmit('submitWorldPayRefund'))
			{
				$order_state = (int)Tools::getValue('order_state');
				$amount = number_format(Tools::getValue('amount'), 2, '.', '');

				if ($worldpay->refund($amount, $order_state))
				{
					$this->debug(sprintf('WorldPay: payment successfully refunded.'), WorldPay::INFO);

					Tools::redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$this->debug(sprintf('WorldPay: error during refund online.'), WorldPay::INFO);

					$this->context->controller->errors[] = $this->l('Error during refund online.');
				}
			}
		}
		catch (WorldPayException $e)
		{
			$this->debug($e->getMessage(), WorldPay::ERROR);

			$this->context->controller->errors[] = $e->getMessage();
		}

		$order_statuses = OrderState::getOrderStates($this->id_lang);

		$smarty_values = array(
			'can_capture' => $worldpay->canCapture(),
			'can_refund' => $worldpay->canRefund(),

			'this_path' => $this->getPathUri(),
			'this_path_ssl' => Tools::getShopDomainSsl(true, true).$this->getPathUri(),
		);

		if ($worldpay->canRefund())
		{
			$smarty_values += array(
				'currencySign' => $worldpay->getCurrency()->sign,
				'currencyRate' => $worldpay->getCurrency()->conversion_rate,
				'currencyFormat' => $worldpay->getCurrency()->format,
				'currencyBlank' => $worldpay->getCurrency()->blank,

				'current_state' => $order_state,
				'current_amount' => $amount,

				'transaction_amount' => $worldpay->getOrderPayment()->getAmount(),
				'transaction_currency' => $worldpay->getOrderPayment()->getCurrencyId(),
				'transaction_time' => $worldpay->getOrderWorldPay()->getTransactionTime(),
			);
		}

		$this->debug(sprintf(
			'WorldPay: show order details. Parameters: %s',
			WorldPayTools::debugArray($smarty_values)
		), WorldPay::DEBUG);

		$this->context->smarty->assign(array(
			'params' => $params,
			'order_states' => $order_statuses,
		));

		$this->context->smarty->assign($smarty_values);

		return $this->display(__FILE__, 'admin_order.tpl');
	}

	/* HELPERS */

	public function isAuthorized()
	{
		foreach (Module::getPaymentModules() as $module)
			if ($module['name'] == $this->name)
				return true;

		return false;
	}

	public function getValidationUrl()
	{
		return $this->context->link->getModuleLink($this->name, self::VALIDATION_CONTROLLER, array(), true);
	}

	public function getWorldpayHelpUrl()
	{
		return 'http://www.worldpay.com/support/kb/bg/paymentresponse/payment_response.html';
	}

	public function getUserGuideUrl()
	{
		return 'http://modulesmarket.com/prestashop/userguide/worldpay/readme_en.pdf';
	}

	public function debug($message, $level = WorldPay::DEBUG)
	{
		if (WorldPaySettings::getInstance()->getValue(WorldPaySettings::PAYMENT_DEBUG) == WorldPaySettings::NO)
			return;

		$log_level = (int)WorldPaySettings::getInstance()->getValue(WorldPaySettings::PAYMENT_DEBUG_LEVEL);

		$logger = new FileLogger($log_level);
		$logger->setFilename(_PS_ROOT_DIR_.'/log/'.date('Ymd').'_worldpay.log');
		$logger->log($message, $level);
	}

	/* OTHER */

	public function display($file, $template, $cache_id = null, $compile_id = null)
	{
		$bootstrap_template = $this->bootstrap_template.$template;

		if ($this->_isTemplateOverloaded($bootstrap_template) === null)
			return parent::display($file, $template, $cache_id, $compile_id);

		return parent::display($file, $bootstrap_template, $cache_id, $compile_id);
	}
}
