<?php


try {
	
	
	

$currentDir = dirname(__FILE__);
$dir = realpath($currentDir.'/../..');
include_once($dir.'/config/config.inc.php');
include_once($dir.'/config/settings.inc.php');
include_once($dir.'/classes/Cookie.php');
$cookie = new Cookie('getdownload','/'); 	
$cookie->__set('pass_ok', 'OK');
$cookie->write();


 // setcookie('pass_ok', md5('ok'),time()+60*60*24*30, '/');
die('1');	
	
}
catch (Exception $e)
{
	die('0');
	
}
?>
