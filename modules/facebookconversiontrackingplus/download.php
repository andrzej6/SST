<?php
/**
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

require(dirname(__FILE__).'/../../config/config.inc.php');
if ((Tools::getToken() == false) || (!Tools::getIsset('token'))) {
    die('Can\'t access');
}

$root = dirname(__FILE__);
$filename = array(1 => 'export-customers.csv', 2 => 'export-newsletter.csv', 3 => 'export-all.csv');
$file = $root.'/csv/'.$filename[Tools::getValue('typexp')];
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='.basename($file).';');
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($file));
readfile($file);
exit();
