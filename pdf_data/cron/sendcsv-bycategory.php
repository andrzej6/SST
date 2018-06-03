<?php


function create_csv_string() {
  
// fetch the data
    $datep = strtotime('- 30 days');

	// create a file pointer connected to the output stream
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;

   // output the column headings
   fputcsv($fp, array('order ref.','date','full_name','email','product'));
   
	$conn = new mysqli('localhost', 'gbs2_7a8le', 'ZuLu12^*)(', 'gbs2_prestashop');
	
    $data1 =$conn->query("SELECT o.reference as order_ref, 
o.date_add as order_date, 
CONCAT_WS(' ', ad.firstname, ad.lastname ) AS full_name, 
g.email, d.product_name AS product_name 

FROM ps_order_detail d 
LEFT JOIN ps_orders o ON ( d.id_order = o.id_order ) 
LEFT JOIN ps_customer g ON ( o.id_customer = g.id_customer ) 
LEFT JOIN ps_address ad ON (o.id_address_delivery = ad.id_address) 
LEFT JOIN ps_product pr ON (d.product_id = pr.id_product) 
LEFT JOIN ps_category_product cp ON pr.id_product = cp.id_product 

WHERE (cp.id_category = 39 or cp.id_category = 40 or cp.id_category = 71 or cp.id_category = 74) 
and (o.date_add >='". date('Y-m-d',$datep)."') 

GROUP BY d.id_order, d.product_name 
ORDER BY d.id_order DESC");

$data2 =$conn->query("SELECT o.reference as order_ref, 
o.date_add as order_date, 
CONCAT_WS(' ', ad.firstname, ad.lastname ) AS full_name, 
g.email, d.product_name AS product_name 

FROM ps_order_detail d 
LEFT JOIN ps_orders o ON ( d.id_order = o.id_order ) 
LEFT JOIN ps_customer g ON ( o.id_customer = g.id_customer ) 
LEFT JOIN ps_address ad ON (o.id_address_delivery = ad.id_address) 
LEFT JOIN ps_product pr ON (d.product_id = pr.id_product) 
LEFT JOIN ps_category_product cp ON pr.id_product = cp.id_product 

WHERE (cp.id_category = 45 or cp.id_category = 76 or cp.id_category = 46 or cp.id_category = 111) 
and (o.date_add >='". date('Y-m-d',$datep)."') 

GROUP BY d.id_order, d.product_name 
ORDER BY d.id_order DESC");


$data3 =$conn->query("SELECT o.reference as order_ref, 
o.date_add as order_date, 
CONCAT_WS(' ', ad.firstname, ad.lastname ) AS full_name, 
g.email, d.product_name AS product_name 

FROM ps_order_detail d 
LEFT JOIN ps_orders o ON ( d.id_order = o.id_order ) 
LEFT JOIN ps_customer g ON ( o.id_customer = g.id_customer ) 
LEFT JOIN ps_address ad ON (o.id_address_delivery = ad.id_address) 
LEFT JOIN ps_product pr ON (d.product_id = pr.id_product) 
LEFT JOIN ps_category_product cp ON pr.id_product = cp.id_product 

WHERE (cp.id_category = 64 or cp.id_category = 110 or cp.id_category = 109 or cp.id_category = 77 or cp.id_category = 66 or cp.id_category = 118) 
and (o.date_add >='". date('Y-m-d',$datep)."') 

GROUP BY d.id_order, d.product_name 
ORDER BY d.id_order DESC");
	
	
$data4 =$conn->query("SELECT o.reference as order_ref, 
o.date_add as order_date, 
CONCAT_WS(' ', ad.firstname, ad.lastname ) AS full_name, 
g.email, d.product_name AS product_name 

FROM ps_order_detail d 
LEFT JOIN ps_orders o ON ( d.id_order = o.id_order ) 
LEFT JOIN ps_customer g ON ( o.id_customer = g.id_customer ) 
LEFT JOIN ps_address ad ON (o.id_address_delivery = ad.id_address) 
LEFT JOIN ps_product pr ON (d.product_id = pr.id_product) 
LEFT JOIN ps_category_product cp ON pr.id_product = cp.id_product 

WHERE (cp.id_category = 52 or cp.id_category = 53 or cp.id_category = 55 or cp.id_category = 56) 
and (o.date_add >='". date('Y-m-d',$datep)."') 

GROUP BY d.id_order, d.product_name 
ORDER BY d.id_order DESC");
	
	
	
    fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------SIT-STAND DESKS--------------'));
    while ($line = $data1->fetch_assoc()) fputcsv($fp, $line);
	
	 fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------DESK RISERS--------------'));
    while ($line = $data2->fetch_assoc()) fputcsv($fp, $line);
	
	 fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------FOOT SOLUTIONS--------------'));
    while ($line = $data3->fetch_assoc()) fputcsv($fp, $line);
	
	 fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------ACTIVE SEATING--------------'));
    while ($line = $data4->fetch_assoc()) fputcsv($fp, $line);
	
    
    // Place stream pointer at beginning
    rewind($fp);

    // Return the data
    return stream_get_contents($fp);

}



function send_csv_mail() {

    $filename = 'myfile';
	$content = chunk_split(base64_encode(create_csv_string())); 
	//$content = create_csv_string(); 
	
	$mailto = 'web@sit-stand.com';
    $subject = 'Sit-Stand.Com Orders By Category';


    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: Web <andrzej@sit-stand.com>" . $eol;
	//$headers = "From: Andrzej <andrzej@sit-stand.com>" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= "Please find attached" . $eol;$eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: text/csv".$eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-disposition: attachment;filename=sst-orders-by-category.csv" . $eol.$eol;
    $body .= $content . $eol.$eol;
    $body .= "--" . $separator . "--";
	

	mail($mailto, $subject, $body, $headers);
	
	/*
    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }
    */



}


send_csv_mail();

