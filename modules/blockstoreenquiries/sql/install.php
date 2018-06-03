<?php

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'enquiries_data` (
  `id_enquiries` int(11) NOT NULL auto_increment,
  `email` varchar(128) DEFAULT NULL,
  `qsource` varchar(32) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id_enquiries`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8' ;


?>