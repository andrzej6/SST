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



$endarray = array();
function IsPostcode($postcode)
{
    $postcode = strtoupper(str_replace(' ','',$postcode));
    if(preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]?[\s]?[0-9][ABD-HJLNP-UW-Z]{2}$)/i",$postcode) || preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]$)/i",$postcode))
    {    
        return true;
    }
    else
    {
        return false;
    }
}




//print 'array(';
foreach ($rows as $key=>$value){
   
   if (IsPostcode($value['shipping_postcode']))
   {
   $endarray[]=$value['shipping_postcode'];
   }
}



foreach ($endarray as $elem){
	
	print $elem."<br/>";
	
	

}
//$output = array_slice($endarray, 0, 20);
//print_r($endarray);





