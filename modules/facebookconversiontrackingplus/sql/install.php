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

$sql = array();
$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'facebookpixels` (
    `id_facebookpixels` int(11) NOT NULL AUTO_INCREMENT,
     `pixel_active` int(1) NOT NULL,
     `pixel_name` text NULL,
     `pixel_type` int(2) NOT NULL,
     `pixel_extras` text(255) NULL,
     `pixel_extras_type` int(2) NULL,
     `pixel_extras_name` text(255) NULL,
    PRIMARY KEY  (`id_facebookpixels`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
