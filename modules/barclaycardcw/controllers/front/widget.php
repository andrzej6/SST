<?php
/**
  * You are allowed to use this API in your web application.
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

class BarclaycardCwWidgetModuleFrontController extends ModuleFrontController
{
	public $ssl = true;

	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		$this->addCSS($this->module->getPath() . 'css/style.css', 'all');
		$this->display_column_left = false;

		parent::initContent();
		$cart = $this->context->cart;

		$transactionId = Tools::getValue('cw_transaction_id', NULL);
		
		if ($transactionId === NULL) {
			die(Tools::displayError('No transaction id given.'));
		}
		$dbTransaction = BarclaycardCw_Entity_Transaction::loadById($transactionId);
		
		$module = BarclaycardCw_PaymentMethod::getInstanceById($dbTransaction->getModuleId());

		// Check that this payment option is still available in case the customer changed his address just before the end of the checkout process
		$authorized = false;
		foreach (Module::getPaymentModules() as $m) {
			if ($m['name'] == $module->name) {
				$authorized = true;
				break;
			}
		}
		if (!$authorized) {
			die(Tools::displayError('This payment method is not available.'));
		}

		$wrapper = BarclaycardCw_Util::getShopAdapterByPaymentAdapter(BarclaycardCw_Util::getAuthorizationAdapter($dbTransaction->getTransactionObject()->getAuthorizationMethod()));
		
		if (!($wrapper instanceof BarclaycardCw_Adapter_WidgetAdapter)) {
			throw new Exception("Expect 'BarclaycardCw_Adapter_WidgetAdapter'.");
		}
		
		$variables = array();
		$wrapper->prepareWithFormData($_REQUEST, $dbTransaction);
		$variables['widget'] = $wrapper->getWidget();
		
		$this->context->smarty->assign($variables);
		
		$this->setTemplate('widget.tpl');
	}
}
