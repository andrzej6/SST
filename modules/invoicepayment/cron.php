<?php
require(dirname(__FILE__).'/../../config/config.inc.php');
require(dirname(__FILE__).'/invoicepayment.php');


Context::getContext()->link = new Link(); //when this is call by cron context is not init

$ip = new InvoicePayment();
$ip->setReminders();