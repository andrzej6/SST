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

include_once(_PS_MODULE_DIR_.'/worldpay/classes/worldpaymoduleconfig.php');

class WorldPaySettings extends WorldPayModuleConfig
{
	const WORLDPAY_TITLE = 'Credit Card (WorldPay)';
	const WORLDPAY_DESCRIPTION = 'Your purchase at %s';

	const WORLDPAY_SUBNET = '155.136.16.';

	const WORLDPAY_DEFAULT_REDIRECT_DELAY = 5;
	const WORLDPAY_DEFAULT_LOCALE = 'en';

	const WORLDPAY_TEST_URL = 'https://secure-test.worldpay.com/wcc/purchase';
	const WORLDPAY_LIVE_URL = 'https://secure.worldpay.com/wcc/purchase';

	const WORLDPAY_TEST_ADMIN_URL = 'https://secure-test.worldpay.com/wcc/itransaction';
	const WORLDPAY_LIVE_ADMIN_URL = 'https://secure.worldpay.com/wcc/itransaction';

	const PAYMENT_ACCEPTED_ORDER_STATUS = 'WRLDPAPTORDERSTATE';
	const PAYMENT_PENDING_ORDER_STATUS = 'WRLDPPDGORDERSTATE';

	const PAYMENT_DISABLE_ORDER_ON_CANCEL = 'WRLDP_ORDOCNCL';
	const PAYMENT_DISABLE_ORDER_ON_ERROR = 'WRLDP_ORDOERR';

	const PAYMENT_TITLE = 'WRLDP_TITLE';
	const PAYMENT_DESCRIPTION = 'WRLDP_DESC';
	const PAYMENT_INSTALLATION_ID = 'WRLDP_INSTALLATIONID';
	const PAYMENT_RESPONSE_PASSWORD = 'WRLDP_RESPONSEPASSWORD';
	const PAYMENT_MD5_CHECKSUM = 'WRLDP_MD5CHECKSUM';
	const PAYMENT_SIGNATURE_TYPE = 'WRLDP_SIGTYPE';
	const PAYMENT_SIGNATURE_PARAMETERS = 'WRLDP_SIGPARAMS';
	const PAYMENT_REQUEST_TYPE = 'WRLDP_REQUESTTYPE';
	const PAYMENT_MODE = 'WRLDP_MODE';
	const PAYMENT_SHOPPER_REDIRECT_DELAY = 'WRLDP_SHPRREDIRDELAY';
	const PAYMENT_MANUAL_CAPTURE = 'WRLDP_MANUALCAPTURE';
	const PAYMENT_FIX_CONTACT = 'WRLDP_FIXCONTACT';
	const PAYMENT_HIDE_CONTACT = 'WRLDP_HIDECONTACT';
	const PAYMENT_HIDE_LANGUAGE = 'WRLDP_HIDELANGUAGE';
	const PAYMENT_ENABLE_ONLINE_OPERATIONS = 'WRLDP_ONLINEOPS';
	const PAYMENT_REMOTE_ADMIN_INSTALLATION_ID = 'WRLDP_ADMININSTALLID';
	const PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS = 'WRLDP_ADMINAUTHPASS';
	const PAYMENT_DEBUG = 'WRLDP_DEBUG';
	const PAYMENT_DEBUG_LEVEL = 'WRLDP_DEBUGLVL';
	const PAYMENT_CREATE_ORDER_ON_CANCEL = 'WRLDP_CANCELCREATEORDER';
	const PAYMENT_CREATE_ORDER_ON_ERROR = 'WRLDP_ERRORCREATEORDER';
	const PAYMENT_RAW_MESSAGE = 'WRLDP_RAWMESSAGE';
	const PAYMENT_AMOUNT_CHECK = 'WRLDP_AMTCHK';

	const WORLDPAY_LIVE = 'live';
	const WORLDPAY_TEST = 'test';

	const WORLDPAY_SIGNATURE_STATIC = 1;
	const WORLDPAY_SIGNATURE_DYNAMIC = 2;

	const WORLDPAY_SIGNATURE_STATIC_PARAMETERS = 'amount:currency:instId:cartId:authMode:email';

	const WORLDPAY_REQUEST_TYPE_PREAUTHORIZATION = 'authorize';
	const WORLDPAY_REQUEST_TYPE_AUTHORIZATION = 'authorize_capture';

	protected $submit_action = 'settings';

	private static $instance;

	public static function getInstance()
	{
		if (empty(self::$instance))
			self::setInstance();

		return self::$instance;
	}

	public static function setInstance(Module $module = null)
	{
		self::$instance = new self($module);

		return self::$instance;
	}

	public function getTitle()
	{
		return $this->l('Payment Settings');
	}

	public function showForm($id_lang)
	{
		return $this->renderForm(array(
			array(
				'form' => array(
					'legend' => array(
						'title' => $this->l('Gateway settings'),
						'icon' => 'icon-cogs'
					),
					'input' => array(
						array(
							'type' => 'select',
							'label' => $this->l('Mode'),
							'name' => self::PAYMENT_MODE,
							'required' => true,
							'options' => array(
								'id' => 'value',
								'name' => 'label',
								'query' => array(
									array(
										'label' => $this->l('Live Mode'),
										'value' => self::WORLDPAY_LIVE,
									),
									array(
										'label' => $this->l('Test Mode'),
										'value' => self::WORLDPAY_TEST,
									),
								),
							),
							'desc' => $this->l('The mode of the WorldPay gateway.'),
							'value' => $this->getValue(self::PAYMENT_MODE),
						),
						array(
							'type' => 'text',
							'label' => $this->l('Installation ID'),
							'name' => self::PAYMENT_INSTALLATION_ID,
							'required' => true,
							'desc' => $this->l('The ID for the installation taken from the Merchant Interface.'),
							'value' => $this->getValue(self::PAYMENT_INSTALLATION_ID),
						),
						array(
							'type' => 'text',
							'label' => $this->l('Payment Response password'),
							'name' => self::PAYMENT_RESPONSE_PASSWORD,
							'required' => false,
							'desc' => $this->l('The Payment Response password set in the Merchant Interface.'),
							'value' => $this->getValue(self::PAYMENT_RESPONSE_PASSWORD),
						),
						array(
							'type' => 'text',
							'label' => $this->l('MD5 secret'),
							'name' => self::PAYMENT_MD5_CHECKSUM,
							'required' => false,
							'desc' => $this->l('This should be a string (spaces are permitted) of up to 16 characters, known only to yourself and to WorldPay.'),
							'value' => $this->getValue(self::PAYMENT_MD5_CHECKSUM),
						),
						array(
							'type' => 'select',
							'label' => $this->l('Signature Type'),
							'name' => self::PAYMENT_SIGNATURE_TYPE,
							'required' => false,
							'options' => array(
								'id' => 'value',
								'name' => 'label',
								'query' => array(
									array(
										'label' => $this->l('Static'),
										'value' => self::WORLDPAY_SIGNATURE_STATIC,
									),
									array(
										'label' => $this->l('Dynamic'),
										'value' => self::WORLDPAY_SIGNATURE_DYNAMIC,
									),
								),
							),
							'desc' => $this->l('Signature type will be only used if MD5 secret is filled.'),
							'value' => $this->getValue(self::PAYMENT_SIGNATURE_TYPE),
						),
						array(
							'type' => 'text',
							'label' => $this->l('Signature parameters'),
							'name' => self::PAYMENT_SIGNATURE_PARAMETERS,
							'required' => false,
							'desc' => $this->l('Must be the same as parameters list in the Worldpay\'s Merchant Interface, if signature type is static.'),
							'value' => $this->getValue(self::PAYMENT_SIGNATURE_PARAMETERS),
						),
						array(
							'type' => 'select',
							'label' => $this->l('Request Type'),
							'name' => self::PAYMENT_REQUEST_TYPE,
							'required' => true,
							'options' => array(
								'id' => 'value',
								'name' => 'label',
								'query' => array(
									array(
										'label' => $this->l('Preauthorization'),
										'value' => self::WORLDPAY_REQUEST_TYPE_PREAUTHORIZATION,
									),
									array(
										'label' => $this->l('Authorization'),
										'value' => self::WORLDPAY_REQUEST_TYPE_AUTHORIZATION,
									),
								),
							),
							'desc' => $this->l('Specifies the authorisation mode used.'),
							'value' => $this->getValue(self::PAYMENT_REQUEST_TYPE),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Fix contact'),
							'name' => self::PAYMENT_FIX_CONTACT,
							'required' => false,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Lock the address information passed to WorldPay, so that shoppers cannot change it when they reach the payment pages.'),
							'value' => $this->getValue(self::PAYMENT_FIX_CONTACT),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Hide contact'),
							'name' => self::PAYMENT_HIDE_CONTACT,
							'required' => false,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Parameter to hide the address information of shoppers on the payment pages.'),
							'value' => $this->getValue(self::PAYMENT_HIDE_CONTACT),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Hide language select'),
							'name' => self::PAYMENT_HIDE_LANGUAGE,
							'required' => false,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Select "Enabled" to hide language select on WorldPay the payment pages.'),
							'value' => $this->getValue(self::PAYMENT_HIDE_LANGUAGE),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Enable online operations'),
							'name' => self::PAYMENT_ENABLE_ONLINE_OPERATIONS,
							'required' => false,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Remote admin installation is needed to perform online confirmation and refund.'),
							'value' => $this->getValue(self::PAYMENT_ENABLE_ONLINE_OPERATIONS),
						),
						array(
							'type' => 'text',
							'label' => $this->l('Remote Admin Installation ID'),
							'name' => self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID,
							'required' => false,
							'desc' => $this->l('Required for Remote Admin.'),
							'value' => $this->getValue(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID),
						),
						array(
							'type' => 'text',
							'label' => $this->l('Authorisation password'),
							'name' => self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS,
							'required' => false,
							'desc' => $this->l('Required for Remote Admin.'),
							'value' => $this->getValue(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Manual funds capturing'),
							'name' => self::PAYMENT_MANUAL_CAPTURE,
							'required' => false,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Select this option if pre-authorization and manual funds capture is set on your WorldPay account.'),
							'value' => $this->getValue(self::PAYMENT_MANUAL_CAPTURE),
						),
					),
				),
			),
			array(
				'form' => array(
					'legend' => array(
						'title' => $this->l('Shop settings'),
						'icon' => 'icon-cogs'
					),
					'input' => array(
						array(
							'type' => 'text',
							'label' => $this->l('Redirection delay time'),
							'name' => self::PAYMENT_SHOPPER_REDIRECT_DELAY,
							'required' => true,
							'desc' =>
								$this->l('Select after what time customer will be automatically redirected back from the WorldPay to the shop after the payment.').' '.
								$this->l('If zero set (0) automatic redirection is disabled.')
							,
							'value' => $this->getValue(self::PAYMENT_SHOPPER_REDIRECT_DELAY),
						),
						array(
							'type' => 'select',
							'label' => $this->l('Accepted order status'),
							'name' => self::PAYMENT_ACCEPTED_ORDER_STATUS,
							'required' => true,
							'options' => array(
								'id' => 'value',
								'name' => 'label',
								'query' => $this->getOrderStatuses($id_lang),
							),
							'desc' => $this->l('Order status when WorldPay request type is set to Authorization or Preauthorization with automatic capturing enabled.'),
							'value' => $this->getValue(self::PAYMENT_ACCEPTED_ORDER_STATUS),
						),
						array(
							'type' => 'select',
							'label' => $this->l('Pending order status'),
							'name' => self::PAYMENT_PENDING_ORDER_STATUS,
							'required' => false,
							'options' => array(
								'id' => 'value',
								'name' => 'label',
								'query' => $this->getOrderStatuses($id_lang),
							),
							'desc' => $this->l('Order status when WorldPay request type is set to Preauthorization and manual capturing is enabled.'),
							'value' => $this->getValue(self::PAYMENT_PENDING_ORDER_STATUS),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Disable creating canceled orders'),
							'name' => self::PAYMENT_DISABLE_ORDER_ON_CANCEL,
							'required' => true,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Disable creating canceled order when Cancel button clicked on the WorldPay payment page.'),
							'value' => $this->getValue(self::PAYMENT_DISABLE_ORDER_ON_CANCEL),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Disable creating failed orders'),
							'name' => self::PAYMENT_DISABLE_ORDER_ON_ERROR,
							'required' => true,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Disable creating failed order when WorldPay\'s callback error appears.'),
							'value' => $this->getValue(self::PAYMENT_DISABLE_ORDER_ON_ERROR),
						),
						array(
							'type' => 'text',
							'label' => $this->l('Title'),
							'name' => self::PAYMENT_TITLE,
							'required' => true,
							'lang' => true,
							'desc' => $this->l('Title which is displayed on payment selection form.'),
							'value' => $this->getValue(self::PAYMENT_TITLE),
						),
						array(
							'type' => 'text',
							'label' => $this->l('Description'),
							'name' => self::PAYMENT_DESCRIPTION,
							'required' => false,
							'lang' => true,
							'desc' => $this->l('A textual description of the payment (up to 255 characters).'),
							'value' => $this->getValue(self::PAYMENT_DESCRIPTION),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Raw message in the order history'),
							'name' => self::PAYMENT_RAW_MESSAGE,
							'required' => false,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Attach responses from WorldPay in the order history messages.'),
							'value' => $this->getValue(self::PAYMENT_RAW_MESSAGE),
						),
						array(
							'type' => Tools::version_compare('1.6', _PS_VERSION_) ? 'switch' : 'radio',
							'label' => $this->l('Debug'),
							'name' => self::PAYMENT_DEBUG,
							'required' => false,
							'class' => 't',
							'is_bool' => true,
							'values' => array(
									array(
											'id' => 'active_on',
											'value' => 1,
											'label' => $this->l('Enabled')
									),
									array(
											'id' => 'active_off',
											'value' => 0,
											'label' => $this->l('Disabled')
									)
							),
							'desc' => $this->l('Enable writing debug information to the file.'),
							'value' => $this->getValue(self::PAYMENT_DEBUG),
						),
					),
				),
			),
		));
	}

	public function init()
	{
		$this->setValue(self::PAYMENT_ACCEPTED_ORDER_STATUS, Configuration::get(self::PAYMENT_ACCEPTED_ORDER_STATUS));
		$this->setValue(self::PAYMENT_PENDING_ORDER_STATUS, Configuration::get(self::PAYMENT_PENDING_ORDER_STATUS));
		$this->setValue(self::PAYMENT_DISABLE_ORDER_ON_CANCEL, Configuration::get(self::PAYMENT_DISABLE_ORDER_ON_CANCEL));
		$this->setValue(self::PAYMENT_DISABLE_ORDER_ON_ERROR, Configuration::get(self::PAYMENT_DISABLE_ORDER_ON_ERROR));
		$this->setValue(self::PAYMENT_TITLE, Configuration::getInt(self::PAYMENT_TITLE));
		$this->setValue(self::PAYMENT_DESCRIPTION, Configuration::getInt(self::PAYMENT_DESCRIPTION));
		$this->setValue(self::PAYMENT_INSTALLATION_ID, Configuration::get(self::PAYMENT_INSTALLATION_ID));
		$this->setValue(self::PAYMENT_RESPONSE_PASSWORD, Configuration::get(self::PAYMENT_RESPONSE_PASSWORD));
		$this->setValue(self::PAYMENT_MD5_CHECKSUM, Configuration::get(self::PAYMENT_MD5_CHECKSUM));
		$this->setValue(self::PAYMENT_SIGNATURE_TYPE, Configuration::get(self::PAYMENT_SIGNATURE_TYPE));
		$this->setValue(self::PAYMENT_SIGNATURE_PARAMETERS, Configuration::get(self::PAYMENT_SIGNATURE_PARAMETERS));
		$this->setValue(self::PAYMENT_REQUEST_TYPE, Configuration::get(self::PAYMENT_REQUEST_TYPE));
		$this->setValue(self::PAYMENT_MANUAL_CAPTURE, Configuration::get(self::PAYMENT_MANUAL_CAPTURE));
		$this->setValue(self::PAYMENT_MODE, Configuration::get(self::PAYMENT_MODE));
		$this->setValue(self::PAYMENT_SHOPPER_REDIRECT_DELAY, Configuration::get(self::PAYMENT_SHOPPER_REDIRECT_DELAY));
		$this->setValue(self::PAYMENT_FIX_CONTACT, Configuration::get(self::PAYMENT_FIX_CONTACT));
		$this->setValue(self::PAYMENT_HIDE_CONTACT, Configuration::get(self::PAYMENT_HIDE_CONTACT));
		$this->setValue(self::PAYMENT_HIDE_LANGUAGE, Configuration::get(self::PAYMENT_HIDE_LANGUAGE));
		$this->setValue(self::PAYMENT_ENABLE_ONLINE_OPERATIONS, Configuration::get(self::PAYMENT_ENABLE_ONLINE_OPERATIONS));
		$this->setValue(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID, Configuration::get(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID));
		$this->setValue(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS, Configuration::get(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS));
		$this->setValue(self::PAYMENT_RAW_MESSAGE, Configuration::get(self::PAYMENT_RAW_MESSAGE));
		$this->setValue(self::PAYMENT_AMOUNT_CHECK, Configuration::get(self::PAYMENT_AMOUNT_CHECK));
		$this->setValue(self::PAYMENT_DEBUG, Configuration::get(self::PAYMENT_DEBUG));
		$this->setValue(self::PAYMENT_DEBUG_LEVEL, Configuration::get(self::PAYMENT_DEBUG_LEVEL));
	}

	public function install()
	{
		$this->createOrderStatuses();

		$payment_title = Configuration::getInt(self::PAYMENT_TITLE);
		$payment_description = Configuration::getInt(self::PAYMENT_DESCRIPTION);

		foreach ($payment_title as $id_lang => $title)
		{
			$title = self::WORLDPAY_TITLE;

			$payment_title[$id_lang] = $title;
		}

		foreach ($payment_description as $id_lang => $description)
		{
			$description = self::WORLDPAY_DESCRIPTION;

			$payment_description[$id_lang] = $description;
		}

		Configuration::updateValue(self::PAYMENT_ACCEPTED_ORDER_STATUS, Configuration::get('PS_OS_PAYMENT'));
		Configuration::updateValue(self::PAYMENT_PENDING_ORDER_STATUS, Configuration::get('PS_OS_WORLDPAY_AWAITING'));
		Configuration::updateValue(self::PAYMENT_DISABLE_ORDER_ON_CANCEL, self::NO);
		Configuration::updateValue(self::PAYMENT_DISABLE_ORDER_ON_ERROR, self::NO);
		Configuration::updateValue(self::PAYMENT_TITLE, $payment_title);
		Configuration::updateValue(self::PAYMENT_DESCRIPTION, $payment_description);
		Configuration::updateValue(self::PAYMENT_INSTALLATION_ID, null);
		Configuration::updateValue(self::PAYMENT_RESPONSE_PASSWORD, null);
		Configuration::updateValue(self::PAYMENT_MD5_CHECKSUM, null);
		Configuration::updateValue(self::PAYMENT_SIGNATURE_TYPE, self::WORLDPAY_SIGNATURE_STATIC);
		Configuration::updateValue(self::PAYMENT_SIGNATURE_PARAMETERS, self::WORLDPAY_SIGNATURE_STATIC_PARAMETERS);
		Configuration::updateValue(self::PAYMENT_REQUEST_TYPE, self::WORLDPAY_REQUEST_TYPE_PREAUTHORIZATION);
		Configuration::updateValue(self::PAYMENT_MANUAL_CAPTURE, self::NO);
		Configuration::updateValue(self::PAYMENT_MODE, self::WORLDPAY_TEST);
		Configuration::updateValue(self::PAYMENT_SHOPPER_REDIRECT_DELAY, self::WORLDPAY_DEFAULT_REDIRECT_DELAY);
		Configuration::updateValue(self::PAYMENT_FIX_CONTACT, self::YES);
		Configuration::updateValue(self::PAYMENT_HIDE_CONTACT, self::NO);
		Configuration::updateValue(self::PAYMENT_HIDE_LANGUAGE, self::NO);
		Configuration::updateValue(self::PAYMENT_ENABLE_ONLINE_OPERATIONS, self::NO);
		Configuration::updateValue(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID, null);
		Configuration::updateValue(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS, null);
		Configuration::updateValue(self::PAYMENT_RAW_MESSAGE, self::YES);
		Configuration::updateValue(self::PAYMENT_AMOUNT_CHECK, self::YES);
		Configuration::updateValue(self::PAYMENT_DEBUG, self::NO);
		Configuration::updateValue(self::PAYMENT_DEBUG_LEVEL, WorldPay::DEBUG);

		return true;
	}

	public function uninstall()
	{
		Configuration::deleteByName(self::PAYMENT_ACCEPTED_ORDER_STATUS);
		Configuration::deleteByName(self::PAYMENT_PENDING_ORDER_STATUS);
		Configuration::deleteByName(self::PAYMENT_DISABLE_ORDER_ON_CANCEL);
		Configuration::deleteByName(self::PAYMENT_DISABLE_ORDER_ON_ERROR);
		Configuration::deleteByName(self::PAYMENT_TITLE);
		Configuration::deleteByName(self::PAYMENT_DESCRIPTION);
		Configuration::deleteByName(self::PAYMENT_INSTALLATION_ID);
		Configuration::deleteByName(self::PAYMENT_RESPONSE_PASSWORD);
		Configuration::deleteByName(self::PAYMENT_MD5_CHECKSUM);
		Configuration::deleteByName(self::PAYMENT_SIGNATURE_TYPE);
		Configuration::deleteByName(self::PAYMENT_SIGNATURE_PARAMETERS);
		Configuration::deleteByName(self::PAYMENT_REQUEST_TYPE);
		Configuration::deleteByName(self::PAYMENT_MANUAL_CAPTURE);
		Configuration::deleteByName(self::PAYMENT_MODE);
		Configuration::deleteByName(self::PAYMENT_SHOPPER_REDIRECT_DELAY);
		Configuration::deleteByName(self::PAYMENT_FIX_CONTACT);
		Configuration::deleteByName(self::PAYMENT_HIDE_CONTACT);
		Configuration::deleteByName(self::PAYMENT_HIDE_LANGUAGE);
		Configuration::deleteByName(self::PAYMENT_ENABLE_ONLINE_OPERATIONS);
		Configuration::deleteByName(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID);
		Configuration::deleteByName(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS);
		Configuration::deleteByName(self::PAYMENT_RAW_MESSAGE);
		Configuration::deleteByName(self::PAYMENT_AMOUNT_CHECK);
		Configuration::deleteByName(self::PAYMENT_DEBUG);
		Configuration::deleteByName(self::PAYMENT_DEBUG_LEVEL);

		return true;
	}

	public function update()
	{
		if ($this->validate())
		{
			$payment_title = Configuration::getInt(self::PAYMENT_TITLE);
			$payment_description = Configuration::getInt(self::PAYMENT_DESCRIPTION);

			foreach ($payment_title as $id_lang => $title)
				$payment_title[$id_lang] = Tools::getValue(self::PAYMENT_TITLE.'_'.$id_lang, $title);

			foreach ($payment_description as $id_lang => $description)
				$payment_description[$id_lang] = Tools::getValue(self::PAYMENT_DESCRIPTION.'_'.$id_lang, $description);

			Configuration::updateValue(self::PAYMENT_ACCEPTED_ORDER_STATUS, (int)Tools::getValue(self::PAYMENT_ACCEPTED_ORDER_STATUS));
			Configuration::updateValue(self::PAYMENT_PENDING_ORDER_STATUS, (int)Tools::getValue(self::PAYMENT_PENDING_ORDER_STATUS));
			Configuration::updateValue(self::PAYMENT_DISABLE_ORDER_ON_CANCEL, (int)Tools::getValue(self::PAYMENT_DISABLE_ORDER_ON_CANCEL));
			Configuration::updateValue(self::PAYMENT_DISABLE_ORDER_ON_ERROR, (int)Tools::getValue(self::PAYMENT_DISABLE_ORDER_ON_ERROR));
			Configuration::updateValue(self::PAYMENT_TITLE, $payment_title);
			Configuration::updateValue(self::PAYMENT_DESCRIPTION, $payment_description);
			Configuration::updateValue(self::PAYMENT_INSTALLATION_ID, Tools::getValue(self::PAYMENT_INSTALLATION_ID));
			Configuration::updateValue(self::PAYMENT_RESPONSE_PASSWORD, Tools::getValue(self::PAYMENT_RESPONSE_PASSWORD));
			Configuration::updateValue(self::PAYMENT_MD5_CHECKSUM, Tools::getValue(self::PAYMENT_MD5_CHECKSUM));
			Configuration::updateValue(self::PAYMENT_SIGNATURE_TYPE, Tools::getValue(self::PAYMENT_SIGNATURE_TYPE));
			Configuration::updateValue(self::PAYMENT_SIGNATURE_PARAMETERS, Tools::getValue(self::PAYMENT_SIGNATURE_PARAMETERS));
			Configuration::updateValue(self::PAYMENT_REQUEST_TYPE, Tools::getValue(self::PAYMENT_REQUEST_TYPE));
			Configuration::updateValue(self::PAYMENT_MANUAL_CAPTURE, Tools::getValue(self::PAYMENT_MANUAL_CAPTURE));
			Configuration::updateValue(self::PAYMENT_MODE, Tools::getValue(self::PAYMENT_MODE));
			Configuration::updateValue(self::PAYMENT_SHOPPER_REDIRECT_DELAY, Tools::getValue(self::PAYMENT_SHOPPER_REDIRECT_DELAY));
			Configuration::updateValue(self::PAYMENT_FIX_CONTACT, Tools::getValue(self::PAYMENT_FIX_CONTACT));
			Configuration::updateValue(self::PAYMENT_HIDE_CONTACT, Tools::getValue(self::PAYMENT_HIDE_CONTACT));
			Configuration::updateValue(self::PAYMENT_HIDE_LANGUAGE, Tools::getValue(self::PAYMENT_HIDE_LANGUAGE));
			Configuration::updateValue(self::PAYMENT_ENABLE_ONLINE_OPERATIONS, Tools::getValue(self::PAYMENT_ENABLE_ONLINE_OPERATIONS));
			Configuration::updateValue(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID, Tools::getValue(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID));
			Configuration::updateValue(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS, Tools::getValue(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS));
			Configuration::updateValue(self::PAYMENT_RAW_MESSAGE, Tools::getValue(self::PAYMENT_RAW_MESSAGE));
			Configuration::updateValue(self::PAYMENT_AMOUNT_CHECK, Tools::getValue(self::PAYMENT_AMOUNT_CHECK));
			Configuration::updateValue(self::PAYMENT_DEBUG, Tools::getValue(self::PAYMENT_DEBUG));
			Configuration::updateValue(self::PAYMENT_DEBUG_LEVEL, (int)Tools::getValue(self::PAYMENT_DEBUG_LEVEL));

			$this->init();

			$this->getModule()->debug(sprintf(
				'WorldPay: settings initialized. Settings: %s;',
				WorldPayTools::debugArray($this->values)
			), WorldPay::DEBUG);

			return true;
		}

		return false;
	}

	protected function validate()
	{
		$condition = true;

		$condition &=
			Tools::strlen(Tools::getValue(self::PAYMENT_ACCEPTED_ORDER_STATUS))
			&& Validate::isInt(Tools::getValue(self::PAYMENT_ACCEPTED_ORDER_STATUS));

		if (Tools::getValue(self::PAYMENT_PENDING_ORDER_STATUS))
			$condition &= Validate::isInt(Tools::getValue(self::PAYMENT_PENDING_ORDER_STATUS));

		$condition &=
			Tools::strlen(Tools::getValue(self::PAYMENT_DISABLE_ORDER_ON_CANCEL))
			&& Validate::isBool(Tools::getValue(self::PAYMENT_DISABLE_ORDER_ON_CANCEL));

		$condition &=
			Tools::strlen(Tools::getValue(self::PAYMENT_DISABLE_ORDER_ON_ERROR))
			&& Validate::isBool(Tools::getValue(self::PAYMENT_DISABLE_ORDER_ON_ERROR));

		if (Tools::getValue(self::PAYMENT_TITLE))
			$condition &= Validate::isAnything(Tools::getValue(self::PAYMENT_TITLE));

		if (Tools::getValue(self::PAYMENT_DESCRIPTION))
			$condition &= Validate::isAnything(Tools::getValue(self::PAYMENT_DESCRIPTION));

		$condition &=
			Tools::strlen(Tools::getValue(self::PAYMENT_INSTALLATION_ID)) &&
			Validate::isString(Tools::getValue(self::PAYMENT_INSTALLATION_ID));

		if (Tools::getValue(self::PAYMENT_RESPONSE_PASSWORD))
			$condition &= Validate::isString(Tools::getValue(self::PAYMENT_RESPONSE_PASSWORD));

		if (Tools::getValue(self::PAYMENT_MD5_CHECKSUM))
			$condition &= Validate::isString(Tools::getValue(self::PAYMENT_MD5_CHECKSUM));

		if (Tools::getValue(self::PAYMENT_SIGNATURE_TYPE))
			$condition &= Validate::isInt(Tools::getValue(self::PAYMENT_SIGNATURE_TYPE));

		if (Tools::getValue(self::PAYMENT_SIGNATURE_PARAMETERS))
			$condition &= Validate::isString(Tools::getValue(self::PAYMENT_SIGNATURE_PARAMETERS));

		$condition &=
			Tools::strlen(Tools::getValue(self::PAYMENT_REQUEST_TYPE))
			&& Validate::isString(Tools::getValue(self::PAYMENT_REQUEST_TYPE));

		if (Tools::getValue(self::PAYMENT_MANUAL_CAPTURE))
			$condition &= Validate::isString(Tools::getValue(self::PAYMENT_MANUAL_CAPTURE));

		$condition &=
			Tools::strlen(Tools::getValue(self::PAYMENT_MODE))
			&& Validate::isString(Tools::getValue(self::PAYMENT_MODE));

		$condition &=
			Tools::strlen(Tools::getValue(self::PAYMENT_SHOPPER_REDIRECT_DELAY))
			&& Validate::isInt(Tools::getValue(self::PAYMENT_SHOPPER_REDIRECT_DELAY));

		if (Tools::getValue(self::PAYMENT_FIX_CONTACT))
			$condition &= Validate::isBool(Tools::getValue(self::PAYMENT_FIX_CONTACT));

		if (Tools::getValue(self::PAYMENT_HIDE_CONTACT))
			$condition &= Validate::isBool(Tools::getValue(self::PAYMENT_HIDE_CONTACT));

		if (Tools::getValue(self::PAYMENT_HIDE_LANGUAGE))
			$condition &= Validate::isBool(Tools::getValue(self::PAYMENT_HIDE_LANGUAGE));

		if (Tools::getValue(self::PAYMENT_ENABLE_ONLINE_OPERATIONS))
			$condition &= Validate::isBool(Tools::getValue(self::PAYMENT_ENABLE_ONLINE_OPERATIONS));

		if (Tools::getValue(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID))
			$condition &= Validate::isString(Tools::getValue(self::PAYMENT_REMOTE_ADMIN_INSTALLATION_ID));

		if (Tools::getValue(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS))
			$condition &= Validate::isString(Tools::getValue(self::PAYMENT_REMOTE_ADMIN_AUTHORIZATION_PASS));

		if (Tools::getValue(self::PAYMENT_RAW_MESSAGE))
			$condition &= Validate::isBool(Tools::getValue(self::PAYMENT_RAW_MESSAGE));

		if (Tools::getValue(self::PAYMENT_AMOUNT_CHECK))
			$condition &= Validate::isBool(Tools::getValue(self::PAYMENT_AMOUNT_CHECK));

		if (Tools::getValue(self::PAYMENT_DEBUG))
			$condition &= Validate::isBool(Tools::getValue(self::PAYMENT_DEBUG));

		if (Tools::getValue(self::PAYMENT_DEBUG_LEVEL))
			$condition &= Validate::isInt(Tools::getValue(self::PAYMENT_DEBUG_LEVEL));

		return (boolean)$condition;
	}

	protected function createOrderStatuses()
	{
		if (!Configuration::get('PS_OS_WORLDPAY_AWAITING'))
		{
			$order_state = new OrderState();
			$order_state->name = array();

			foreach (Language::getLanguages() as $language)
				$order_state->name[$language['id_lang']] = 'Awaiting WorldPay payment';

			$order_state->module_name = $this->getModule()->name;
			$order_state->invoice = false;
			$order_state->send_email = false;
			$order_state->color = 'RoyalBlue';
			$order_state->hidden = false;
			$order_state->logable = false;
			$order_state->delivery = false;
			$order_state->shipped = false;
			$order_state->paid = false;
			$order_state->deleted = false;

			if ($order_state->add())
			{
				$source = $this->getModule()->getLocalPath().'/logo.gif';
				$destination = $this->getModule()->getLocalPath().'/../../img/os/'.(int)$order_state->id.'.gif';

				copy($source, $destination);
			}

			Configuration::updateValue('PS_OS_WORLDPAY_AWAITING', (int)$order_state->id);
		}
	}

	protected function getOrderStatuses($lang_id)
	{
		$order_statuses = OrderState::getOrderStates($lang_id);
		$order_status_options = array();

		foreach ($order_statuses as $order_status)
			$order_status_options[] = array(
				'label' => $order_status['name'],
				'value' => $order_status['id_order_state'],
			);

		return $order_status_options;
	}
}
