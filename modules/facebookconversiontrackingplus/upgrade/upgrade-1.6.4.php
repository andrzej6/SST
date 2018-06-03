<?php
/**
 * Facebook Conversion Pixel Tracking Plus
 *
 * NOTICE OF LICENSE
 *
 * @author    Pol Rué
 * @copyright Smart Modules 2014
 * @license   One time purchase Licence (You can modify or resell the product but just one time per licence)
 * @version 1.8.0
 * @category Marketing & Advertising
 * Registered Trademark & Property of Smart-Modules.pro
 *
 * **************************************************
 * *     Facebook Conversion Trackcing Pixel Plus    *
 * *          http://www.smart-modules.pro           *
 * *                     V 1.8.0                     *
 * **************************************************
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_6_4($object)
{
    /** Update procedure for version 2.1.2 adding new features exclusively for out of stock products */
    if (!$object->isRegisteredInHook('displayFooter')) {
        $object->registerHook('displayFooter');
    }
    if (!$object->isRegisteredInHook('actionAdminControllerSetMedia')) {
        $object->registerHook('actionAdminControllerSetMedia');
    }

    // All done if we get here the upgrade is successfull
    return true;
}
