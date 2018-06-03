SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

ALTER TABLE `PREFIX_order_worldpay` CHANGE `transaction_id` `transaction_id` varchar(50) DEFAULT NULL;
ALTER TABLE `PREFIX_order_worldpay` CHANGE `transaction_status` `transaction_status` varchar(10) DEFAULT NULL;
ALTER TABLE `PREFIX_order_worldpay` CHANGE `transaction_time` `transaction_time` varchar(13) DEFAULT NULL;
ALTER TABLE `PREFIX_order_worldpay` CHANGE `transaction_avs` `transaction_avs` int(4) unsigned DEFAULT NULL;
ALTER TABLE `PREFIX_order_worldpay` CHANGE `transaction_waf` `transaction_waf` varchar(32) DEFAULT NULL;
ALTER TABLE `PREFIX_order_worldpay` CHANGE `authorization_mode` `authorization_mode` varchar(1) DEFAULT NULL;
ALTER TABLE `PREFIX_order_worldpay` CHANGE `card_type` `card_type` varchar(32) DEFAULT NULL;
