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

abstract class PaymentModuleResponse {

	const STATE_FAILED = 'failed';
	const STATE_CANCELED = 'canceled';
	const STATE_PENDING = 'pending';
	const STATE_SUCCEED = 'succeed';
	const STATE_REFUNDED = 'refunded';

	static protected $response_method = 'POST';

	protected $parameters = array();

	/**
	 * @var boolean
	 */
	protected $initialized = false;

	/**
	 * @var WorldPaySettings
	 */
	protected $settings;

	public function __construct(WorldPaySettings $settings)
	{
		$this->settings = $settings;
	}

	public function getResponseState($state_id)
	{
		switch ($state_id)
		{
			case Configuration::get('PS_OS_CANCELED'):

				return PaymentModuleResponse::STATE_CANCELED;

			case Configuration::get('PS_OS_REFUND'):

				return PaymentModuleResponse::STATE_REFUNDED;

			case $this->settings->getValue(WorldPaySettings::PAYMENT_PENDING_ORDER_STATUS):

				return PaymentModuleResponse::STATE_PENDING;

			case $this->settings->getValue(WorldPaySettings::PAYMENT_ACCEPTED_ORDER_STATUS):

				return PaymentModuleResponse::STATE_SUCCEED;

			case Configuration::get('PS_OS_ERROR'):

			default:

				return PaymentModuleResponse::STATE_FAILED;
		}
	}

	public function getResponseParameters()
	{
		return array_filter($this->parameters);
	}

	public function isInitialized()
	{
		return $this->initialized;
	}

	public function isManualCapture()
	{
		return $this->settings->getValue(WorldPaySettings::PAYMENT_MANUAL_CAPTURE) == WorldPaySettings::YES;
	}

	abstract public function initialize();

	abstract public function getResponseStatus();
}
