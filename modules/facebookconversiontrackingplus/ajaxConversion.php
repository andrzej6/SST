<?php
/**
 * Conversion Pixel (for Facebook Ads)
 *
 * NOTICE OF LICENSE
 *
 * @category marketing
 * @author    Pol Rué
 * @copyright Smart Modules 2014
 * @version 
1.5.5
 * @license   GNU Public License 2.0 (read license.txt for more details)
 * Registered Trademark & Property of Smart-Modules.pro
 *
 * *****************************************
 * * Facebook Conversion Tracking Pixel    *
 * *   http://www.smart-modules.pro        *
 * *               V 1.5.5                 *
 * *****************************************
*/

require(dirname(__FILE__).'/../../config/config.inc.php');
require(dirname(__FILE__).'/facebookconversiontrackingplus.php');
$tmp = new FacebookConversionTrackingPlus();
$tmp->ajaxConversionSuccessfull();