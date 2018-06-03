SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `PREFIX_order_worldpay` (
	`id_order_worldpay` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`id_order` int(10) unsigned NULL,
	`id_cart` int(10) unsigned NULL,
	`transaction_id` varchar(50) NOT NULL,
	`transaction_status` varchar(10) NOT NULL,
	`transaction_time` varchar(13) NOT NULL,
	`transaction_avs` int(4) unsigned NOT NULL,
	`transaction_waf` varchar(32) NOT NULL,
	`authorization_mode` varchar(1) NOT NULL,
	`card_type` varchar(32) NOT NULL,
	`ip_address` bigint DEFAULT NULL,
	`date_add` datetime NOT NULL,
	`date_upd` datetime NOT NULL,
	PRIMARY KEY (`id_order_worldpay`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
