<?php
require 'postcodes.php';

$conn = new mysqli('localhost', 'gbs2_7a8le', 'ZuLu12^*)(', 'gbs2_prestashop');

$data =$conn->query("SELECT 
CONCAT_WS(' ', ad.firstname, ad.lastname ) AS shipping_name,
ad.postcode as shipping_postcode,
cd.name as shipping_country,
g.email,
o.reference
FROM ps_orders o
LEFT JOIN ps_customer g ON ( o.id_customer = g.id_customer ) 
LEFT JOIN ps_address ad ON (o.id_address_delivery = ad.id_address)
LEFT JOIN ps_country_lang cd ON (ad.id_country = cd.id_country)
WHERE g.email !='' 
AND cd.name='United Kingdom'
GROUP BY o.reference");
	
	
while($row = $data->fetch_array())
{
$rows[] = $row;
}



/*
$data1 =array(array('W1U 6RE','email1'),array('TN22 5RE','email2'),array('EC1M 6EL','email3'),array('ne6 1as','email4'));
foreach ($data1 as &$marray) {
	$postcode = new Postcode();
    $distance = $postcode->distance("sw20 9bu", $marray[0], "M");
    $marray[]=$distance;
}

print_r($data1);

*/


$endarray = array();




$address = 'SA1 1DF';
//print 'array(';
foreach ($rows as $key=>$value){
   $postcode = new Postcode();
   $distance = $postcode->distance($address,$value['shipping_postcode'],'M');
   
   //print "array('".$value['shipping_postcode']."','".$value['reference']."','".$value['email']."'),";
   
   $endarray[]=array('zip'=>$value['shipping_postcode'],'dist'=>$distance,'ref'=>$value['reference']);
}



usort($endarray, function($a, $b) {
    //return $a['dist'] - $b['dist'];
	if ($a['dist'] == $b['dist'])
    {return 0;}
    else if ($a['dist'] > $b['dist'])
    {return -1;}
    else {return 1;}
});


//$output = array_slice($endarray, 0, 20);
print_r($endarray);





