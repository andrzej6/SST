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

class BarclaycardCwPaymentModuleFrontController extends ModuleFrontController
{
	public $ssl = true;

	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		$variables = array();
		$this->addCSS($this->module->getPath() . 'css/style.css', 'all');
		$this->addJS(_MODULE_DIR_ . 'barclaycardcw/js/frontend.js');
		
		$this->display_column_left = false;

		parent::initContent();
		$cart = $this->context->cart;

		/* @var $module BarclaycardCw_PaymentMethod */
		$module = BarclaycardCw_PaymentMethod::getInstanceById(Tools::getValue('id_module', null));

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

		$variables['paymentMethodName'] = $module->getPaymentMethodDisplayName();
		if (strtolower($module->getConfigApi()->getConfigurationValue("VALIDATION")) == 'after') {
			$rs = $module->validate();
			if ($rs !== NULL) {
				$variables['error_message'] = $rs;
				$this->context->smarty->assign($variables);
				$this->setTemplate('validation_error.tpl');
				return;
			}
		}

		$errorTransactionId = Tools::getValue('error_transaction_id', null);
		$errorTransaction = null;
		$errorDbTransaction = null;
		if ($errorTransactionId !== null) {
			$errorDbTransaction = BarclaycardCw_Entity_Transaction::loadById(intval($errorTransactionId));
			$errorTransaction = $errorDbTransaction->getTransactionObject();

			if ($errorTransaction->getTransactionContext()->getOrderContext()->getCustomerId() == $this->context->customer->id && $this->context->customer->id != 0) {
				$errorMessage = current($errorTransaction->getErrorMessages());
			}
			else {
				$errorMessage =
				// The user is not allow to load the error transaction, because it does not belongs to him. Hence
				// we reset it.
				$errorTransaction = null;
				
				// However the error message should be visible.
				$errorMessage = current($errorTransaction->getErrorMessages());
			}
			
			$this->context->smarty->assign(array('error_message' => $errorMessage));
		}

		try {
			$adapter = BarclaycardCw_Util::getShopAdapterByPaymentAdapter($module->getAuthorizationAdpater($module->getOrderContext()));
			
			$createTransaction = true;
			if (isset($_REQUEST['ajaxAliasForm']) || BarclaycardCw::getInstance()->isCreationOfPendingOrderActive()) {
				$createTransaction = false;
			}
			
			$adapter->prepareCheckout($module, $module->getOrderContext(), $errorDbTransaction, $createTransaction);
			$variables['paymentPane'] = $adapter->getCheckoutPageHtml();
		}
		catch(Exception $e) {
			$variables['error_message'] = $e->getMessage();
		}
		
		$this->context->smarty->assign($variables);
		$this->setTemplate('payment_confirmation.tpl');
	}
	
	
	/**
	 * We have to override this method to prevent moving js around and prevents loading 
	 * them correctly.
	 * 
	 * @param string $content
	 */
	protected function smartyOutputContent($content)
	{
		if (version_compare(_PS_VERSION_, '1.6') > 0) {
			$this->context->cookie->write();
			if (is_array($content))
			foreach ($content as $tpl)
				$html = $this->context->smarty->fetch($tpl);
			else
				$html = $this->context->smarty->fetch($content);
			
			$html = trim($html);
			
			if ($this->controller_type == 'front' && !empty($html))
			{
				$html = trim(str_replace(array('</body>', '</html>'), '', $html))."\n";
				$this->context->smarty->assign(array(
					'js_def' => Media::getJsDef(),
					'js_files' => array_unique($this->js_files),
					'js_inline' => array()
				));
				$javascript = $this->context->smarty->fetch(_PS_ALL_THEMES_DIR_.'javascript.tpl');
				echo $html.$javascript."\t</body>\n</html>";
			}
			else
				echo $html;
		}
		else {
			return parent::smartyOutputContent($content);
		}
	}
}
