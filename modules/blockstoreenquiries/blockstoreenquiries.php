<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class BlockStoreenquiries extends Module
{

	public function __construct()
  {
    $this->name = 'blockstoreenquiries';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Andrzej Dlugosz';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Store Enquiries');
    $this->description = $this->l('Module to store enquiries and products comments');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
  }
	

	public function install()
{
   
  if (!parent::install() || !$this->registerHook('enqstoreHook')) 
	  return false;

  $sql = array();
  require_once(dirname(__FILE__) . '/sql/install.php');
        foreach ($sql as $sq) :
            if (!Db::getInstance()->Execute($sq))
                return false;
        endforeach;
		
  return true;
}


	public function uninstall()
{
	$sql = array();
	require_once(dirname(__FILE__) . '/sql/uninstall.php');
        foreach ($sql as $s) :
            if (!Db::getInstance()->Execute($s))
                return false;
        endforeach;
		
  return true;
}


public function hookenqstoreHook($params)
{

    $to      = 'andrzejdlugoszsst@gmail.com';
    $subject = 'the subject';
    $message = 'contact form/ product recommendation or comment sent '.$params[0].':'.$params[1];
    $headers = 'From: andrzej@sit-stand.com' . "\r\n" .
        'Reply-To: andrzej@sit-stand.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
	
	//Db::getInstance()->insert('ps_enquiries_data', array('email'=>$params[0],'qsource'=>$params[1],'created'=>'2018-02-23','modified'=>'2018-02-23'));
	
	
	
	$username = 'gbs2_7a8le';
    $password = 'ZuLu12^*)(';
	
	$conn = new PDO('mysql:host=localhost;dbname=gbs2_prestashop', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    date_default_timezone_set('Europe/London');

                     

    $q1 = "INSERT INTO ps_enquiries_data (email, qsource, created, modified)  
           VALUES (:email, :qsource, :created, :modified)";

    $stmt = $conn->prepare($q1);

    $result1 = $stmt->execute(array(
			 ':email'=>$params[0],
			  ':qsource'=>$params[1],
			  ':created'=>date('Y-m-d H:i:s'),
			  ':modified'=>date('Y-m-d H:i:s'), 
			  ));

}


}