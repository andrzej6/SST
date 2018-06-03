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

class OrderWorldpay extends ObjectModel
{
	/** @var integer Order id */
	public $id_order_worldpay;

	/** @var integer Order id */
	public $id_order;

	/** @var integer Cart id */
	public $id_cart;

	/** @var integer transaction id */
	public $transaction_id;

	/** @var string transaction status */
	public $transaction_status;

	/** @var timestamp transaction time */
	public $transaction_time;

	/** @var string AVS */
	public $transaction_avs;

	/** @var string WAF Merchant Message */
	public $transaction_waf;

	/** @var string authorization mode */
	public $authorization_mode;

	/** @var string credit card type */
	public $card_type;

	/** @var string IP address */
	public $ip_address;

	/** @var string Object creation date */
	public $date_add;

	/** @var string Object last modification date */
	public $date_upd;

	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'order_worldpay',
		'primary' => 'id_order_worldpay',
		'fields' => array(
			'id_order_worldpay'		=>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_order'				=>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_cart'				=>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'transaction_id' 		=> 	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'transaction_status'	=> 	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'transaction_time' 		=> 	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'transaction_avs' 		=> 	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'transaction_waf' 		=> 	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'authorization_mode'	=> 	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'card_type' 			=> 	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'ip_address'			=>	array('type' => self::TYPE_INT, 'validate' => 'isIp2Long'),
			'date_add'				=>	array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
			'date_upd'				=>	array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
		),
	);

	public function getTransactionTime()
	{
		return date('Y-m-d H:i:s', ($this->transaction_time / 1000));
	}

	public function getCardType()
	{
		return $this->card_type;
	}

	public function getIPAddress()
	{
		return long2ip($this->ip_address);
	}

	public function saveResponse(WorldPayResponse $response, $id_order = null)
	{
		if (!empty($id_order))
			$this->id_order = (int)$id_order;

		$this->id_cart = (int)$response->getCartId();
		$this->transaction_id = $response->getTransactionId();
		$this->transaction_status = $response->getResponseStatus();
		$this->transaction_time = $response->getTransactionTime();
		$this->transaction_avs = $response->getAVS();
		$this->transaction_waf = $response->getWafMerchantMessage();
		$this->authorization_mode = $response->getAuthMode();
		$this->card_type = $response->getCardType();
		$this->ip_address = ip2long($response->getIPAddress());

		return $this->save();
	}

	public function getByOrderId($id_order)
	{
		$result = Db::getInstance()->getRow('
			SELECT *
			FROM `'._DB_PREFIX_.'order_worldpay`
			WHERE `id_order` = '.(int)$id_order.';'
		);

		if (!$result)
			return false;

		$this->hydrate($result);

		return $this;
	}

	public static function changeTransactionStatus($id_order, $state)
	{
		Db::getInstance()->Execute('
			UPDATE `'._DB_PREFIX_.'order_worldpay`
			SET `transaction_status` = \''.pSQL($state).'\'
			WHERE `id_order` = '.(int)$id_order.';'
		);
	}
}
