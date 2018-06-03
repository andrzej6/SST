<?php
/**
 *  * You are allowed to use this API in your web application.
 *
 * Copyright (C) 2015 by customweb GmbH
 *
 * This program is licenced under the customweb software licence. With the
 * purchase or the installation of the software in your application you
 * accept the licence agreement. The allowed usage is outlined in the
 * customweb software licence which can be found under
 * http://www.sellxed.com/en/software-license-agreement
 *
 * Any modification or distribution is strictly forbidden. The license
 * grants you the installation in one application. For multiuse you will need
 * to purchase further licences at http://www.sellxed.com/shop.
 *
 * See the customweb software licence agreement for more details.
 *
 */
require_once dirname(dirname(dirname(__FILE__))) . '/barclaycardcw.php';
require_once 'Customweb/Payment/Authorization/IPaymentMethod.php';
require_once 'Customweb/Payment/Authorization/IAdapter.php';

require_once 'BarclaycardCw/Util.php';
require_once 'BarclaycardCw/SmartyProxy.php';
require_once 'BarclaycardCw/TransactionContext.php';
require_once 'BarclaycardCw/OrderStatus.php';
require_once 'BarclaycardCw/Entity/Transaction.php';
require_once 'BarclaycardCw/OrderContext.php';
require_once 'BarclaycardCw/PaymentMethodWrapper.php';
require_once 'BarclaycardCw/ConfigurationApi.php';

class BarclaycardCw_PaymentMethod extends PaymentModule implements Customweb_Payment_Authorization_IPaymentMethod {
	/**
	 *
	 * @var BarclaycardCw_ConfigurationApi
	 */
	private $configurationApi = null;
	public $currencies = true;
	public $currencies_mode = 'checkbox';
	public $version = '2.1.236';
	public $paymentMethodDisplayName = 'Barclaycard';
	public $paymentMethodName = '';
	public $author = 'customweb ltd';
	private $transactionContext = null;

	/**
	 * This method init the module.
	 *          	 		 	 	 	   
	 */
	public function __construct(){
		parent::__construct();
		
		// The parent construct is required for translations
		if (defined('_PS_ADMIN_DIR_') || empty($this->id)) {
			$this->displayName = 'Barclaycard: ' . $this->paymentMethodDisplayName;
		}
		else {
			$this->displayName = $this->getPaymentMethodDisplayName();
		}
		
		$this->description = str_replace('!PaymentMethodName', $this->paymentMethodDisplayName, $this->l('ACCEPTS PAYMENTS'));
		$this->confirmUninstall = $this->l('DELETE CONFIRMATION');
		$this->tab = 'payments_gateways';
		$this->bootstrap = true;
		
		if (!isset($_GET['configure']) && $this->context->controller instanceof AdminModulesController && method_exists('Module', 'isModuleTrusted') &&
				 (!Module::isInstalled($this->name) || !Module::isInstalled('mailhook'))) {
			$this->context->smarty = new BarclaycardCw_SmartyProxy($this->context->smarty);
		}
	}

	/**
	 *
	 * @return BarclaycardCw_ConfigurationApi
	 */
	public function getConfigApi(){
		if (empty($this->id)) {
			throw new Exception("Cannot initiate the config api wihtout the module id.");
		}
		
		if ($this->configurationApi == null) {
			$this->configurationApi = new BarclaycardCw_ConfigurationApi($this->id);
		}
		return $this->configurationApi;
	}

	public function getPaymentMethodName(){
		return $this->paymentMethodName;
	}

	public function getPaymentMethodDisplayName(){
		$configuredName = $this->getConfigApi()->getConfigurationValue('METHOD_NAME', $this->context->language->id);
		if (!empty($configuredName)) {
			return $configuredName;
		}
		else {
			return $this->paymentMethodDisplayName;
		}
	}

	public function getPaymentMethodDescription(){
		$configuredDescription = $this->getConfigApi()->getConfigurationValue('METHOD_DESCRIPTION', $this->context->language->id);
		if (!empty($configuredDescription)) {
			return $configuredDescription;
		}
		else {
			return '';
		}
	}

	/**
	 * This method installs the module.
	 *
	 * @return boolean if it was successful
	 */
	public function install(){
		return parent::install() && $this->installPaymentConfigurations() && $this->registerHook('payment') && $this->registerHook('displayPaymentEU') &&
				 $this->registerHook('paymentReturn');
	}

	public function uninstall(){
		return parent::uninstall() && $this->uninstallPaymentConfigurations();
	}

	public function installPaymentConfigurations(){
		$this->getConfigApi()->updateConfigurationValue('MESSAGE_AFTER_ORDER', '');
		
		$languages = Language::getLanguages(false);
		foreach ($languages as $language) {
			if (isset($language['lang_id'])) {
				$this->getConfigApi()->updateConfigurationValue('METHOD_NAME', $this->getPaymentMethodDisplayName(), $language['lang_id']);
			}
		}
		
		return true;
	}

	public function uninstallPaymentConfigurations(){
		$this->getConfigApi()->removeConfigurationValue('MESSAGE_AFTER_ORDER');
		
		$languages = Language::getLanguages(false);
		foreach ($languages as $language) {
			if (isset($language['lang_id'])) {
				$this->getConfigApi()->removeConfigurationValue('METHOD_NAME', $language['lang_id']);
				$this->getConfigApi()->removeConfigurationValue('METHOD_DESCRIPTION', $language['lang_id']);
			}
		}
		$this->getConfigApi()->removeConfigurationValue('MIN_TOTAL');
		$this->getConfigApi()->removeConfigurationValue('MAX_TOTAL');
		
		return true;
	}

	/**
	 * This method checks if for the current cart, the payment can be accepted by this
	 * payment method.
	 *
	 * @throws Exception In case it is not valid
	 * @return boolean
	 */
	public function validate(){
		$orderContext = $this->getOrderContext();
		$adapter = $this->getAuthorizationAdpater($orderContext);
		
		$paymentContext = BarclaycardCw_Util::getPaymentCustomerContext($this->context->cart->id_customer);
		try {
			$adapter->validate($orderContext, $paymentContext, array());
			BarclaycardCw_Util::persistPaymentCustomerContext($paymentContext);
			return NULL;
		}
		catch (Exception $e) {
			BarclaycardCw_Util::persistPaymentCustomerContext($paymentContext);
			return $e->getMessage();
		}
	}

	/**
	 * This method hooks into the payment process.
	 *
	 * @param array $params the params of the hook point
	 * @return string the html output
	 */
	public function hookPayment($params){
		if (!$this->isPaymentMethodVisible()) {
			return;
		}
		
		$link = new Link();
		$confirmationLink = $link->getModuleLink('barclaycardcw', 'payment', array(
			'id_module' => $this->id 
		), true);
		
		$templateVars = array(
			'paymentLogo' => $this->getPaymentMethodLogo(),
			'redirectionUrl' => $confirmationLink,
			'paymentMethodName' => $this->getPaymentMethodDisplayName(),
			'paymentMethodDescription' => $this->getPaymentMethodDescription(),
			'paymentMachineName' => $this->getPaymentMethodName() 
		);
		
		if (!$this->existsPaymentMethodConfigurationValue('PAYMENT_FORM') ||
				 $this->getPaymentMethodConfigurationValue('PAYMENT_FORM') != 'separate_page') {
			try {
				$orderContext = $this->getOrderContext();
				$adapter = BarclaycardCw_Util::getShopAdapterByPaymentAdapter($this->getAuthorizationAdpater($orderContext));
				$adapter->prepareCheckout($this, $orderContext, null, false);
				if ($adapter->isHeaderRedirectionSupported()) {
					$templateVars['redirectionUrl'] = $adapter->getRedirectionUrl();
				}
				else {
					$templateVars['paymentPane'] = $adapter->getCheckoutPageHtml();
				}
			}
			catch (Exception $e) {
				$templateVars['errorMessage'] = $e->getMessage();
			}
		}
		
		$this->smarty->assign($templateVars);
		
		$this->context->controller->addCSS(_MODULE_DIR_ . 'barclaycardcw/css/style.css');
		$this->context->controller->addJS(_MODULE_DIR_ . 'barclaycardcw/js/frontend.js');
		
		$nameBackup = $this->name;
		$this->name = 'barclaycardcw';
		$result = $this->display($this->getTemplateBasePath(), 'payment.tpl');
		$this->name = $nameBackup;
		
		return $result;
	}

	public function hookDisplayPaymentEU($params){
		if (!$this->isPaymentMethodVisible()) {
			return;
		}
		
		$link = new Link();
		$redirectionUrl = $link->getModuleLink('barclaycardcw', 'payment', array(
			'id_module' => $this->id 
		), true);
		
		try {
			if (!$this->existsPaymentMethodConfigurationValue('PAYMENT_FORM') ||
					 $this->getPaymentMethodConfigurationValue('PAYMENT_FORM') != 'separate_page') {
				$adapter = BarclaycardCw_Util::getShopAdapterByPaymentAdapter($this->getAuthorizationAdpater($this->getOrderContext()));
				$adapter->prepareCheckout($this, $this->getOrderContext(), null, false);
				if ($adapter->isHeaderRedirectionSupported()) {
					$redirectionUrl = $adapter->getRedirectionUrl();
				}
			}
		}
		catch (Exception $e) {
			// Since the integration of this hook does not provide a facility to handle exception, we
			// have to kill the process here to print out the error message.
			die($e->getMessage());
		}
		
		return array(
			'cta_text' => $this->getPaymentMethodDisplayName(),
			'logo' => $this->getPaymentMethodLogo(),
			'action' => $redirectionUrl,
		);
	}

	protected function getTemplateBasePath(){
		$filePath = str_replace('lib/BarclaycardCw/PaymentMethod', 'barclaycardcw', __FILE__);
		$filePath = str_replace('lib\\BarclaycardCw\\PaymentMethod', 'barclaycardcw', $filePath);
		return $filePath;
	}

	public function getPaymentMethodLogo(){
		return $this->_path . '/logo.png';
	}

	/**
	 * This method hooks into the return payment hook.
	 * It use allways the order_confirmation.tpl!
	 *
	 * @param array $params the params of the hook point
	 * @return string the html output
	 */
	public function hookPaymentReturn($params){
		$this->context->controller->addCSS(_MODULE_DIR_ . 'barclaycardcw/css/style.css');
		$paymentMethodMessage = $this->getPaymentMethodConfigurationValue('MESSAGE_AFTER_ORDER', $this->context->language->iso_code);
		
		$id_cart = (int) (Tools::getValue('id_cart', 0));
		$link = new Link();
		$url = $link->getPageLink('history', true);
		$order = new Order(Order::getOrderByCartId($id_cart));
		$orderState = $order->getCurrentStateFull($this->context->language->id);
		
		$orderId = $order->id;
		$transaction = current(BarclaycardCw_Entity_Transaction::getTransactionsByOrderId($orderId));
		$this->smarty->assign(
				array(
					'paymentMethodMessage' => $paymentMethodMessage,
					'order' => $order,
					'historyLink' => $url,
					'transaction' => $transaction->getTransactionObject(),
					'orderState' => $orderState['name'] 
				));
		
		$nameBackup = $this->name;
		$this->name = 'barclaycardcw';
		$result = $this->display($this->getTemplateBasePath(), 'payment_return.tpl');
		$this->name = $nameBackup;
		
		return $result;
	}

	/**
	 * The main method for the configuration page.
	 *
	 * @return string html output
	 */
	public function getContent(){
		$this->context->controller->addCSS(_MODULE_DIR_ . 'barclaycardcw/css/admin.css');
		
		$html = '<p><a class="button btn btn-default" href="?controller=adminmodules&configure=barclaycardcw&module_name=barclaycardcw&token=' .
				 Tools::getAdminTokenLite('AdminModules') . '">' . $this->l('CONFIGURE_BASIC_SETTINGS') . '</a></p>';
		if (isset($_POST['submit_barclaycardcw'])) {
			$fields = $this->getConfigApi()->convertFieldTypes($this->getFormFields());
			$this->getConfigApi()->processConfigurationSaveAction($fields);
			$this->displayConfirmation($this->l('Settings updated'));
		}
		$html .= $this->getConfigurationForm();
		
		return $html;
	}

	private function getConfigurationForm(){
		$fields = $this->getConfigApi()->convertFieldTypes($this->getFormFields());
		
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get(
				'PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->id = (int) Tools::getValue('id_carrier');
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submit_barclaycardcw';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab .
				 '&module_name=' . $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigApi()->getConfigurationValues($fields),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id 
		);
		
		$forms = array(
			array(
				'form' => array(
					'legend' => array(
						'title' => $this->paymentMethodDisplayName,
						'icon' => 'icon-envelope' 
					),
					'input' => $fields,
					'submit' => array(
						'title' => $this->l('Save') 
					) 
				) 
			) 
		);
		
		return $helper->generateForm($forms);
	}

	protected function getFormFields(){
		$fields = array(
			array(
				'name' => 'METHOD_NAME',
				'label' => $this->l('METHOD_NAME_LABEL'),
				'desc' => $this->l('METHOD_NAME_DESCRIPTION'),
				'type' => 'textarea',
				'lang' => 'true' 
			),
			array(
				'name' => 'METHOD_DESCRIPTION',
				'label' => $this->l('METHOD_DESCRIPTION_LABEL'),
				'desc' => $this->l('METHOD_DESCRIPTION_DESCRIPTION'),
				'type' => 'textarea',
				'lang' => 'true' 
			),
			array(
				'name' => 'MIN_TOTAL',
				'label' => $this->l('MIN_TOTAL_LABEL'),
				'desc' => $this->l('MIN_TOTAL_DESCRIPTION'),
				'type' => 'text' 
			),
			array(
				'name' => 'MAX_TOTAL',
				'label' => $this->l('MAX_TOTAL_LABEL'),
				'desc' => $this->l('MAX_TOTAL_DESCRIPTION'),
				'type' => 'text' 
			),
			array(
				'name' => 'PAYMENT_FORM',
				'label' => $this->l('PAYMENT_FORM_LABEL'),
				'desc' => $this->l('PAYMENT_FORM_DESCRIPTION'),
				'type' => 'select',
				'options' => array(
					'query' => array(
						array(
							'id' => 'payment_list_page',
							'name' => $this->l('SHOW_ON_PAYMENT_LIST_PAGE') 
						),
						array(
							'id' => 'separate_page',
							'name' => $this->l('SHOW_ON_SEPARATE_PAGE') 
						) 
					),
					'name' => 'name',
					'id' => 'id' 
				) 
			),
			array(
				'name' => 'MESSAGE_AFTER_ORDER',
				'label' => $this->l('MESSAGE_AFTER_ORDER_LABEL'),
				'desc' => $this->l('MESSAGE_AFTER_ORDER_DESCRIPTION'),
				'type' => 'textarea',
				'lang' => 'true' 
			) 
		);
		
		return $fields;
	}

	public function getPaymentMethodConfigurationValue($key, $languageCode = null){
		$langId = null;
		if ($languageCode !== null) {
			$languageCode = (string) $languageCode;
			$langId = BarclaycardCw_Util::getLanguageIdByIETFTag($languageCode);
		}
		
		return $this->getConfigApi()->getConfigurationValue($key, $langId);
	}

	public function existsPaymentMethodConfigurationValue($key, $languageCode = null){
		$langId = null;
		if ($languageCode !== null) {
			$languageCode = (string) $languageCode;
			$langId = BarclaycardCw_Util::getLanguageIdByIETFTag($languageCode);
		}
		
		return $this->getConfigApi()->hasConfigurationKey($key, $langId);
	}

	/**
	 *
	 * @return BarclaycardCw_OrderContext
	 */
	public function getOrderContext(){
		$cart = $this->context->cart;
		return new BarclaycardCw_OrderContext($cart, new BarclaycardCw_PaymentMethodWrapper($this));
	}

	/**
	 *
	 * @return Customweb_Payment_Authorization_IAdapter
	 */
	public function getAuthorizationAdpater(Customweb_Payment_Authorization_IOrderContext $orderContext){
		return BarclaycardCw_Util::getAuthorizationAdapterByContext($orderContext);
	}

	public function l($string, $sprintf = false, $id_lang = null){
		return BarclaycardCw::translate($string, $sprintf);
	}

	public function setCart($cart){
		$this->context->cart = $cart;
	}

	/**
	 *
	 * @return BarclaycardCw_Entity_Transaction
	 */
	public function createTransaction(BarclaycardCw_OrderContext $orderContext, $aliasTransactionId = null, $failedTransactionObject = null){
		$adapter = BarclaycardCw_Util::getAuthorizationAdapterByContext($orderContext);
		if (!($adapter instanceof Customweb_Payment_Authorization_IAdapter)) {
			throw new Exception("The adapter has to implement Customweb_Payment_Authorization_IAdapter.");
		}
		
		return $this->createTransactionWithAdapter($orderContext, $adapter, $aliasTransactionId, $failedTransactionObject);
	}

	public function createTransactionWithAdapter(BarclaycardCw_OrderContext $orderContext, Customweb_Payment_Authorization_IAdapter $adapter, $aliasTransactionId, $failedTransactionObject){
		$transactionContext = $this->createTransactionContext($orderContext, $aliasTransactionId, $failedTransactionObject);
		$transactionObject = $adapter->createTransaction($transactionContext, $failedTransactionObject);
		
		$transaction = $transactionContext->getInternalTransaction();
		$transaction->setTransactionObject($transactionObject);
		BarclaycardCw_Util::getEntityManager()->persist($transaction);
		
		return $transaction;
	}
	
	public function createTransactionContext(BarclaycardCw_OrderContext $orderContext, $aliasTransactionId, $failedTransactionObject) {
		$mainModule = BarclaycardCw::getInstance();
		if ($mainModule->isCreationOfPendingOrderActive()) {
			return $this->createTransactionContextWithPendingOrder($orderContext, $aliasTransactionId, $failedTransactionObject);
		}
		else {
			return $this->createTransactionContextWithoutPendingOrder($orderContext, $aliasTransactionId, $failedTransactionObject);
		}
	}

	private function createTransactionContextWithPendingOrder(BarclaycardCw_OrderContext $orderContext, $aliasTransactionId, $failedTransactionObject){
		$originalCart = new Cart($orderContext->getCartId());
		
		$rs = $originalCart->duplicate();
		if (!isset($rs['success']) || !isset($rs['cart'])) {
			throw new Exception(
					"The cart duplication failed. May be some module prevents it. To fix this you may deactivate the creation of pending orders.");
		}
		$cart = $rs['cart'];
		if (!($cart instanceof Cart)) {
			throw new Exception("The duplicated cart is not of type 'Cart'.");
		}
		
		// Those values are not currently set when cloneing 
// 		$cart->id_address_delivery = $originalCart->id_address_delivery;
// 		$cart->id_address_invoice = $originalCart->id_address_invoice;
// 		$cart->getPackageList(true);
// 		$cart->save();
		
		foreach ($originalCart->getCartRules() as $rule) {
			$cart->addCartRule($rule['obj']->id);
		}
		
		// Since we have duplicate the cart we have also to recreate the order context.
		$orderContext = new BarclaycardCw_OrderContext($cart, new BarclaycardCw_PaymentMethodWrapper($this));
		
		$pendingState = BarclaycardCw_OrderStatus::getPendingOrderStatusId();
		$customer = new Customer(intval($cart->id_customer));
		
		// Make sure that the notification can be processed, even if the payment
		// module is deactivated in this store.
		$this->active = true;
		
		$message = BarclaycardCw_Util::getOrderCreationMessage(BarclaycardCw_Util::getEmployeeIdFromCookie());
		
		BarclaycardCw::startRecordingMailMessages();
		$this->validateOrder((int) $cart->id, $pendingState, $orderContext->getOrderAmountInDecimals(), $this->getPaymentMethodDisplayName(), 
				$message, $extra_vars = array(), $currency_special = null, $dont_touch_amount = false, $customer->secure_key);
		$orderId = $this->currentOrder;
		$messages = BarclaycardCw::stopRecordingMailMessages();
		
		$transaction = new BarclaycardCw_Entity_Transaction();
		$transaction->setOrderId($orderId)->setCustomerId($customer->id)->setModuleId($this->id)->setCartId($cart->id)->setMailMessages($messages)->setOriginalCartId(
				$originalCart->id);
		BarclaycardCw_Util::getEntityManager()->persist($transaction);
		
		return $this->createTransactionContextInner($transaction, $orderContext, $aliasTransactionId);
	}

	private function createTransactionContextWithoutPendingOrder(BarclaycardCw_OrderContext $orderContext, $aliasTransactionId){
		$cart = new Cart($orderContext->getCartId());
		$transaction = new BarclaycardCw_Entity_Transaction();
		$transaction->setModuleId($this->id)->setCartId($cart->id);
		$transaction->setCustomerId($cart->id_customer);
		BarclaycardCw_Util::getEntityManager()->persist($transaction);
		
		return $this->createTransactionContextInner($transaction, $orderContext, $aliasTransactionId);
	}

	private function createTransactionContextInner(BarclaycardCw_Entity_Transaction $transaction, BarclaycardCw_OrderContext $orderContext, $aliasTransactionId){
		// Reset the checkout id.
		$key = BarclaycardCw_Util::getCheckoutCookieKey($this);
		$this->context->cookie->{$key} = null;
		
		return new BarclaycardCw_TransactionContext($transaction, $orderContext, $aliasTransactionId);
	}

	private function isPaymentMethodVisible(){
		if (!$this->active)
			return false;
		
		$orderContext = $this->getOrderContext();
		$adapter = $this->getAuthorizationAdpater($orderContext);
		$paymentContext = BarclaycardCw_Util::getPaymentCustomerContext($orderContext->getCustomerId());
		try {
			$adapter->preValidate($orderContext, $paymentContext);
			BarclaycardCw_Util::persistPaymentCustomerContext($paymentContext);
		}
		catch (Exception $e) {
			BarclaycardCw_Util::persistPaymentCustomerContext($paymentContext);
			return false;
		}
		
		// Check the minimal order total
		$minTotal = floatval($this->getConfigApi()->getConfigurationValue('MIN_TOTAL'));
		if (!empty($minTotal) && $minTotal > 0 && $minTotal > $this->context->cart->getOrderTotal(true, Cart::BOTH)) {
			return false;
		}
		
		// Check the maximal order total
		$maxTotal = floatval($this->getConfigApi()->getConfigurationValue('MAX_TOTAL'));
		if (!empty($maxTotal) && $maxTotal > 0 && $maxTotal < $this->context->cart->getOrderTotal(true, Cart::BOTH)) {
			return false;
		}
		
		return true;
	}
}


