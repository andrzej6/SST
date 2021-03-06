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

require_once 'Customweb/Barclaycard/IAdapter.php';
require_once 'Customweb/Barclaycard/ExternalCheckout/MasterPass/AbstractRequestParameterBuilder.php';



class Customweb_Barclaycard_ExternalCheckout_MasterPass_AuthorizeRequestParameterBuilder extends Customweb_Barclaycard_ExternalCheckout_MasterPass_AbstractRequestParameterBuilder{
	
	protected function buildInnerParamters() {
		if ($this->getContext()->getPaymentMethod()->getPaymentMethodConfigurationValue('capturing') == 'direct') {
			return array(
				'OPERATION' => Customweb_Barclaycard_IAdapter::OPERATION_DIRECT_SALE,
			);
		}
		else {
			return array(
				'OPERATION' => Customweb_Barclaycard_IAdapter::OPERATION_AUTHORISATION,
			);
		}
	}
	
}
	