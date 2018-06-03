<?php
/**
 * Invoice payment method, PS 1.6.x
 *
 * @author    silbersaiten
 * @copyright Silbersaiten GbR <www.silbersaiten.de> 2014
 *
 * Support: http://www.silbersaiten.de/
 *
 */
if ( ! defined('_PS_VERSION_'))
{
    exit;
}

class InvoicePayment extends PaymentModule {
    public $_html;
    public $_postErrors = array();
    private static $_tblCache = array();
    private static $_queries = array(
	'invoice_payment_group_settings' => '
	    CREATE TABLE IF NOT EXISTS `%PREFIX%invoice_payment_group_settings` (
		`id_group` int(10) unsigned NOT NULL,
		`days_amount` int(10) unsigned DEFAULT NULL,
		PRIMARY KEY (`id_group`)
	    ) ENGINE=%ENGINE% DEFAULT CHARSET=utf8',
	    
	'invoice_payment_status_settings' => '
	    CREATE TABLE IF NOT EXISTS `%PREFIX%invoice_payment_status_settings` (
		`id_order_state` int(10) unsigned NOT NULL,
		PRIMARY KEY (`id_order_state`)
	    ) ENGINE=%ENGINE% DEFAULT CHARSET=utf8',
	    
	'invoice_payment_order' => '
	    CREATE TABLE IF NOT EXISTS `%PREFIX%invoice_payment_order` (
		`id_order` int(10) unsigned NOT NULL,
		`is_paid` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		`is_reminded` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		`date_add` datetime NOT NULL,
		PRIMARY KEY (`id_order`)
	    ) ENGINE=%ENGINE% DEFAULT CHARSET=utf8',
    );

    public function __construct() {
	    $this->name = 'invoicepayment';
	    $this->tab = 'payments_gateways';
		$this->author = 'Silbersaiten';
	    $this->version = '2.0.1';
        $this->module_key = '3d5467af7231b92cc5c54bbcbd6f664e';
	    
	    $this->currencies = true;
	    $this->currencies_mode = 'checkbox';

	    parent::__construct();

	    $this->displayName = $this->l('Invoice Payment');
	    $this->description = $this->l('Accept invoice payments');
    }

    public function install() {
	if ( ! parent::install() ||
	    ! $this->registerHook('payment') ||
	    ! $this->registerHook('paymentReturn') ||
	    ! $this->registerHook('displayPDFInvoice') ||
	    ! $this->registerHook('postUpdateOrderStatus') ||
	    ! $this->registerHook('actionObjectOrderAddAfter')) {
	    return false;
	}

	foreach (self::$_queries as $query) {
	    $query = strtr($query, array('%PREFIX%' => _DB_PREFIX_, '%ENGINE%' => _MYSQL_ENGINE_));
	    
	    if ( ! Db::getInstance()->Execute($query)) {
		$this->uninstall();
		
		return false;
	    }
	}

	Configuration::updateValue('PS_INVOICE_PAYMENT_NUM', 0);
	Configuration::updateValue('PS_INVOICE_PAYMENT_SUM', 500);
	Configuration::updateValue('PS_MAIL_DELAY_DAYS', 3);
	Configuration::updateValue('PS_MAIL_DELAY_OS', 0);

	return true;
    }

    public function uninstall() {
	if (parent::uninstall()) {
	    foreach (array_keys(self::$_queries) as $table) {
		Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . pSQL($table) . '`');
	    }

	    return true;
	}

	return false;
    }

    private static function tableExists($table, $useCache = true) {
        if ( ! sizeof(self::$_tblCache) || ! $useCache) {
            $tmp = Db::getInstance()->ExecuteS('SHOW TABLES');

            foreach ($tmp as $entry) {
                reset($entry);

                $tableTmp = strtolower($entry[key($entry)]);

                if ( ! array_search($tableTmp, self::$_tblCache)) {
                    self::$_tblCache[] = $tableTmp;
                }
            }
        }

        return array_search(strtolower($table), self::$_tblCache) ? true : false;
    }

    public function hookPayment($params) {
	if ($this->active) {
	    // Check if cart has product download
	    

	    $this->context->smarty->assign(array(
		'path_validation' => $this->context->link->getModuleLink('invoicepayment', 'validation', array(), true),
		'this_path' => $this->_path,
		'this_path_ssl' => (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'modules/'.$this->name.'/'
	    ));
	    
	    return $this->display(__FILE__, '/views/templates/hook/payment.tpl');
	}
		
	return '';
    }
	
    public function hookPaymentReturn($params) {
        if ($this->active) {
	    return $this->display(__FILE__, '/views/templates/hook/confirmation.tpl');
        }

        return '';
    }

    public function hookDisplayPDFInvoice($params) {
        $order = new Order((int)$params['object']->id_order);

        if (Validate::isLoadedObject($order) && $order->module == $this->name) {
	    $display_tpl = false;
            $validStatuses = self::getValidStatuses();
            $history = $order->getHistory($order->id_lang);

            foreach ($history as $h) {
                if (in_array($h['id_order_state'], $validStatuses)) {
                    $shipping_date = $h['date_add'];

                    break;
                }
            }

            if (isset($shipping_date)) {
                $customer = new Customer((int)($order->id_customer));

                if (Validate::isLoadedObject($customer)) {
                    $days = self::getDaysForGroup($customer->id_default_group);

                    if ($days > 0 ) {
                        $days*= (60 * 60 * 24);

                        $this->context->smarty->assign('shipping_date', Tools::displayDate(date('Y-m-d h:i:s', (strtotime($shipping_date) + $days)), $order->id_lang));

			$display_tpl = true;
                    }
                }
            }
			
	    $payment_info = Configuration::get('INVOICE_PAYMENT_INFO', $order->id_lang);
			
	    if ( ! Tools::isEmpty($payment_info)) {
		$this->context->smarty->assign('payment_info', $payment_info);
				
		$display_tpl = true;
	    }
			
	    if ($display_tpl) {
		return $this->display(__FILE__, '/views/templates/hook/invoice.tpl');
	    }
        }
    }

    public static function getGroupsSettings() {
        $prepared = array();
        $groups = Db::getInstance()->ExecuteS('SELECT * FROM `' . _DB_PREFIX_ . 'invoice_payment_group_settings`');

        if ( ! $groups || ! sizeof($groups)) {
            return $prepared;
        }

        foreach ($groups as $group) {
            $prepared[(int)$group['id_group']] = (int)$group['days_amount'];
        }

        return $prepared;
    }

    public static function getDaysForGroup($id_group) {
        return (int)Db::getInstance()->getValue('SELECT `days_amount` FROM `' . _DB_PREFIX_ . 'invoice_payment_group_settings` WHERE `id_group` = ' . (int)$id_group);
    }

    public function updateGroups($groupData) {
        Db::getInstance()->Execute('TRUNCATE `' . _DB_PREFIX_ . 'invoice_payment_group_settings`');

        foreach ($groupData as $id_group => $days_amount) {
            if ( ! Validate::isUnsignedId($id_group) || ! Validate::isUnsignedInt($days_amount)) {
                $this->_postErrors[] = $this->l('Ivalid values provided for group #') . $id_group;

                continue;
            }

            Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'invoice_payment_group_settings` (`id_group`, `days_amount`) VALUES (' . (int)$id_group . ', ' . (int)$days_amount . ')');
        }
    }


    public function updateStatuses($statusData) {
        Db::getInstance()->Execute('TRUNCATE `' . _DB_PREFIX_ . 'invoice_payment_status_settings`');

        if (is_array($statusData)) {
            foreach (array_keys($statusData) as $id_order_state) {
                if ( ! Validate::isUnsignedId($id_order_state) || ! Validate::isLoadedObject($status = new OrderState((int)$id_order_state))) {
                    $this->_postErrors[] = $this->l('Ivalid order status id #') . $id_order_state;

                    continue;
                }

                Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'invoice_payment_status_settings` (`id_order_state`) VALUES (' . (int)$id_order_state . ')');
            }
        }
    }


    public static function getValidStatuses() {
        $preparedStatuses = array();

        $statuses = Db::getInstance()->ExecuteS('SELECT * FROM `' . _DB_PREFIX_ . 'invoice_payment_status_settings`');

        if ($statuses && sizeof($statuses)) {
            foreach ($statuses as $status) {
                array_push($preparedStatuses, $status['id_order_state']);
            }
        }

        return $preparedStatuses;
    }
	
    private function getModuleLink() {
	return Context::getContext()->link->getAdminLink('AdminModules', true) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
    }

    public function getContent() {
        $bill_num        = Configuration::get('PS_INVOICE_PAYMENT_NUM');
        $bill_sum        = Configuration::get('PS_INVOICE_PAYMENT_SUM');
	$mail_delay      = Configuration::get('PS_MAIL_DELAY_DAYS');
	$mail_os         = (int)Configuration::get('PS_MAIL_DELAY_OS');
	$defaultLanguage = (int)$this->context->language->id;
        $groups          = Group::getGroups($defaultLanguage);
        $orderStates     = OrderState::getOrderStates($defaultLanguage);
	$languages       = Language::getLanguages();

        $this->_html = '<h2>' . $this->displayName . '</h2>';

        $this->_postProcess();

        if (Tools::getValue('m') == 1) {
            $this->_html.= $this->displayConf($this->l('Settings successfully updated'));
        }

        $this->_html.= '<form action="' . $this->getModuleLink() . '" method="post">
            <fieldset>
            <legend>'.$this->l('Configuration').'</legend>

			<label>'.$this->l('Start after # of orders').'</label>
			<div class="margin-form">
				<input type="text" name="invoice_payment_num" value="'.$bill_num.'" />
				<p class="clear">'.$this->l('Please specify after wich order your customers should be billed. Leave the field blank if you accept the billing method right at the first order. ').'</p>
			</div>

			<label>'.$this->l('Order limit').'</label>
			<div class="margin-form">
				 <input type="text" name="invoice_payment_sum" value="'.$bill_sum.'" />
				<p class="clear">'.$this->l('Please specify the amount for the order limit.').'</p>
			</div>
			
			<label>'.$this->l('Mail delay').'</label>
			<div class="margin-form">
				 <input type="text" name="mail_delay" value="'.$mail_delay.'" />
				<p class="clear">'.$this->l('After a "payment due" date is reached, if the payment is still not received in the specified number of days, a reminder will be sent to customer. Leave empty or set to 0 to disable, then no reminders will be sent.').'</p>
				<p>'.$this->l('Place this URL in crontab or call it manually daily:').'<br />
				<b>'.Tools::getShopDomain(true, true).__PS_BASE_URI__.'modules/invoicepayment/cron.php</b></p>
			</div>
			
			<label>'.$this->l('Reminder status').'</label>
			<div class="margin-form">
			    <select name="mail_status">
				<option value="0" ' . ($mail_os == 0 ? 'selected="selected"' : '') .'>' . $this->l('None') . '</option>
			    ';
			
	foreach ($orderStates as $orderState) {
	    $this->_html.= '<option value="' . $orderState['id_order_state'] . '" ' . ($mail_os == $orderState['id_order_state'] ? 'selected="selected"' : '') .'>' . $orderState['name'] . '</option>';
	}
	
	$this->_html.= '
			    </select>
				<p class="clear">'.$this->l('When a reminder is sent, the order status will be changed to this one. If you choose "none", the reminders will still be sent, but the order status will not be changed.').'</p>
			</div>';

        if (sizeof($orderStates)) {
            $validStatuses = self::getValidStatuses();

            $this->_html.= '
			<label>' . $this->l('Order states') . '</label>
			<div class="margin-form">
				<table class="table" cellspacing="0" cellpadding="0">
					<tr>
						<th></th>
						<th></th>
						<th>' . $this->l('Name') . '</th>
					</tr>';

            $i = 1;
            foreach ($orderStates as $orderState) {
                $this->_html.= '
				<tr' . ($i % 2 == 0 ? ' class="alt_row"' : '') . '>
					<td>
						<input type="checkbox" name="orderStates[' . $orderState['id_order_state'] . ']"' . (in_array($orderState['id_order_state'], $validStatuses) ? ' checked="checked"' : '') . ' />
					</td>
					<td>
						<span style="display: block; margin: 3px; width: 24px; box-shadow: 0 0 3px rgba(0,0,0,0.3); height: 24px; border-radius: 3px; padding: 3px; border: 1px solid #eee; background: #fff;">
							<span style="display: block; width: 100%; height: 100%; box-shadow: 0 0 3px rgba(0,0,0,0.2); border-radius: 3px; background-color: ' . $orderState['color'] . '"></span>
						</span>
					</td>
					<td>
						' . $orderState['name'] . '
					</td>
				</tr>';

                $i++;
            }

            $this->_html.= '
				</table>
			</div>';
        }

        if (sizeof($groups)) {
            $groupValues = self::getGroupsSettings();

            $this->_html.= '
			<label>' . $this->l('Payment due dates') . '</label>
			<div class="margin-form">
				<table class="table" cellspacing="0" cellpadding="0">
					<tr>
						<th>' . $this->l('Group') . '</th>
						<th>' . $this->l('Days') . '</th>
					</tr>';

            $i = 1;

            foreach ($groups as $group) {
                $this->_html.= '
				<tr' . ($i % 2 == 0 ? ' class="alt_row"' : '') . '>
					<td>' . $group['name'] . '</td>
					<td>
						<input type="text" size="3" name="groupDays[' . $group['id_group'] . ']" value="' . (array_key_exists($group['id_group'], $groupValues) ? $groupValues[$group['id_group']] : '') . '" />
					</td>
				</tr>';

                $i++;
            }

            $this->_html.= '
				</table>
			</div>';
        }
		
	$this->_html.= '<label>' . $this->l('Payment information') . '</label>
	<div class="margin_form">';
		
	foreach ($languages as $language)
	{
		$val = Tools::htmlentitiesUTF8(Tools::getValue('payment_info_' . $language['id_lang'], Configuration::get('INVOICE_PAYMENT_INFO', $language['id_lang'])));
		$this->_html .= '
			<div id="pinfo_' . $language['id_lang'] . '" style="display: ' . ($language['id_lang'] == $defaultLanguage ? 'block' : 'none') . ';float: left;">
				<textarea cols="60" rows="10" name="payment_info_' . $language['id_lang'] . '" id="payment_info_' . $language['id_lang'] . '">' . $val . '</textarea>
			</div>';
	}
	$this->_html .= $this->displayFlags($languages, $defaultLanguage, 'pinfo', 'pinfo', true);
	
	$this->_html.= '
	</div>';

        $this->_html.= '
			<center>
				<input class="button" name="btnSaveBill" value="'.$this->l('Save').'" type="submit" />
			</center>

            </fieldset>
        </form>
        <br />';

        return $this->_html;
    }

    private function _postProcess() {
	$languages = Language::getLanguages();

        if (Tools::isSubmit('btnSaveBill')) {
            $bill_num = Tools::getValue('invoice_payment_num', -1);
            $bill_sum = Tools::getValue('invoice_payment_sum', -1);
	    $delay_os = Tools::getValue('mail_status');
	    $delay_days = Tools::getValue('mail_delay');
	    $payment_info = array();
			
	    foreach ($languages as $language) {
		    $payment_info[$language['id_lang']] = Tools::getValue('payment_info_' . $language['id_lang']);
	    }
	    
	    Configuration::updateValue('INVOICE_PAYMENT_INFO', $payment_info);
	    
	    if ($delay_days && ! Validate::isUnsignedId($delay_days)) {
		$this->_postErrors[] = $this->l('"Mail delay" - incorrect value');
	    }
	    
	    if ($delay_os && ! Validate::isUnsignedId($delay_os)) {
		$this->_postErrors[] = $this->l('"Reminder status" - incorrect value');
	    }

            if ( ! Validate::isPhoneNumber($bill_num) || ! Validate::isUnsignedInt($bill_num)) {
                $this->_postErrors[] = $this->l('"Start after # of orders" - incorrect value');
            }

            if ( ! Validate::isUnsignedInt($bill_sum)) {
                $this->_postErrors[] = $this->l('"Order limit" - incorrect value');
            }

            if ( ! sizeof($this->_postErrors)) {
                $this->updateGroups(Tools::getValue('groupDays'));
            }

            if ( ! sizeof($this->_postErrors)) {
                $this->updateStatuses(Tools::getValue('orderStates'));
            }

            if (sizeof($this->_postErrors)) {
                $this->outputErrors();
            }
            else {
                Configuration::updateValue('PS_INVOICE_PAYMENT_NUM', (int)$bill_num);
                Configuration::updateValue('PS_INVOICE_PAYMENT_SUM', (int)$bill_sum);
		Configuration::updateValue('PS_MAIL_DELAY_DAYS', (int)$delay_days);
		Configuration::updateValue('PS_MAIL_DELAY_OS', (int)$delay_os);

                Tools::redirectAdmin($this->getModuleLink() . '&m=1');
            }
        }
    }

    public function checkCart(&$cart) {
        $bill_num = (int)Configuration::get('PS_INVOICE_PAYMENT_NUM');
        $bill_sum = (int)Configuration::get('PS_INVOICE_PAYMENT_SUM');
	$currency_order = new Currency((int)($cart->id_currency));
	$currencies_module = $this->getCurrency((int)$cart->id_currency);
	$currency_ok = false;
		
	if ( ! is_array($currencies_module)) {
	    return false;
	}
		
	foreach ($currencies_module as $currency_module) {
	    if ($currency_order->id == $currency_module['id_currency']) {
		$currency_ok = true;
		
		break;
	    }
	}
		
	if ( ! $currency_ok) {
	    return false;
	}

        if (isset($cart) && $cart->getOrderTotal(true, Cart::BOTH) <= $bill_sum) {
            $customer = new Customer($cart->id_customer);
            $stats = $customer->getStats();

            if (isset($stats['nb_orders']) && $stats['nb_orders'] >= $bill_num) {
                return true;
            }
        }

        return false;
    }

    private function displayConf($conf) {
        return '
	<div class="conf">
		<img src="../img/admin/ok2.png" alt="" /> ' . $conf . '
	</div>';
    }

    private function outputErrors() {
        if (sizeof($this->_postErrors)) {
            foreach ($this->_postErrors as $error) {
                $this->_html.= parent::displayError($error);
            }
        }
    }
    
    public function setReminders() {
        $delay = (int)Configuration::get('PS_MAIL_DELAY_DAYS');
        $id_order_state = (int)Configuration::get('PS_MAIL_DELAY_OS');



        if ( ! $delay || ! $id_order_state) {

            return false;
        }

        $group_delays = self::getGroupsSettings();

        $longest_delay = 0;

        foreach ($group_delays as $id_group => $days_amount) {
            if ($days_amount > $longest_delay) {
                $longest_delay = $days_amount;
            }
        }

        $order_list = Db::getInstance()->ExecuteS('SELECT `id_order`  FROM `' . _DB_PREFIX_ . 'invoice_payment_order` WHERE  DATEDIFF(NOW(),  `date_add`) <= ' . ($longest_delay + $delay) . ' AND `is_paid` = 0 AND `is_reminded` = 0');


        if ($order_list && sizeof($order_list)) {
            $languages = Language::getLanguages(true);

            foreach ($order_list as $o) {
                $order = new Order($o['id_order']);

                if (Validate::isLoadedObject($order) && Validate::isLoadedObject($customer = new Customer($order->id_customer))) {
                    if ( ! array_key_exists($customer->id_default_group, $group_delays)) {
                        continue ;
                    }

                    $order_lang = false;

                    foreach ($languages as $language) {
                        if ($language['id_lang'] == $order->id_lang) {
                            $order_lang = $language;
                        }
                    }

                    if ( ! $order_lang) {
                        continue ;
                    }

                    $customer_delay = $group_delays[$customer->id_default_group] + $delay;
                    if (strtotime($order->date_add) <= strtotime('-' . $customer_delay . ' days')) {
                        $new_history = new OrderHistory();
                        $new_history->id_order = (int)$order->id;
                        $new_history->changeIdOrderState((int)$id_order_state, $order, true);
                        $new_history->add(true);
                    }
                }
            }
        }
    }
    
    public function hookActionObjectOrderAddAfter($params) {
        $order = $params['object'];

        if ($order->module == $this->name) {
            Db::getInstance()->insert('invoice_payment_order', array(
            'id_order' => $order->id,
            'date_add' => $order->date_add
            ));
        }
    }
    
    public function hookPostUpdateOrderStatus($params) {
        $order_state = $params['newOrderStatus'];
        $id_order = $params['id_order'];

        $order = new Order((int)$id_order);

        if (Validate::isLoadedObject($order) && $order->module == $this->name) {
            if ($order_state->id == Configuration::get('PS_MAIL_DELAY_OS')) {

                $invoice_payment_data = Db::getInstance()->getRow('SELECT * FROM `' . _DB_PREFIX_ . 'invoice_payment_order` WHERE `id_order` = ' . (int)$order->id);

                if ($invoice_payment_data && $invoice_payment_data['is_paid'] == 0) {



                    $customer = new Customer($order->id_customer);

                    $data = array(
                        '{firstname}' => $customer->firstname,
                        '{lastname}' => $customer->lastname,
                        '{order_reference}' => $order->getUniqReference(),
                        '{order_date}' => Tools::displayDate($order->date_add)
                    );

                    if ($order->invoice_number) {
                        $pdf = new PDF($order->getInvoicesCollection(), PDF::TEMPLATE_INVOICE, $this->context->smarty);
                        $file_attachment['content'] = $pdf->render(false);
                        $file_attachment['name'] = Configuration::get('PS_INVOICE_PREFIX', (int)$order->id_lang, null, $order->id_shop).sprintf('%06d', $order->invoice_number).'.pdf';
                        $file_attachment['mime'] = 'application/pdf';
                    }
                    else {
                        $file_attachment = null;
                    }


                    Mail::Send(
                        (int)$order->id_lang,
                        'reminder',
                        Mail::l('Payment reminder', (int)$order->id_lang),
                        $data,
                        $customer->email,
                        $customer->firstname.' '.$customer->lastname,
                        null,
                        null,
                        $file_attachment,
                        null,
                        dirname(__FILE__) . '/mails/',
                        false,
                        (int)$order->id_shop
                    );

                    Db::getInstance()->update('invoice_payment_order', array('is_reminded' => 1), '`id_order` = ' . (int)$order->id);
                }
            }  else {
                if ($order_state->paid) {
                    Db::getInstance()->update('invoice_payment_order', array('is_paid' => 1), '`id_order` = ' . (int)$order->id);
                }
                else {
                    Db::getInstance()->update('invoice_payment_order', array('is_paid' => 0), '`id_order` = ' . (int)$order->id);
                }
            }
        }
    }
}
