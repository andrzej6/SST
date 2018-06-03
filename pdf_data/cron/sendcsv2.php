<?php


function create_csv_string() {
  
  $datep = strtotime('- 31 days');
  
// fetch the data
    $conn = new mysqli('localhost', 'gbs2_7a8le', 'ZuLu12^*)(', 'gbs2_prestashop');

$data =$conn->query("SELECT 
o.reference as order_ref, 
o.date_add as order_date,

CONCAT_WS(' ', ad.firstname, ad.lastname ) AS shipping_name,
ad.address1 as shipping_addrress1,
ad.address2 as shipping_address2,
'' AS shipping_address3,
ad.city as shipping_city,
'' AS shipping_county,
ad.postcode as shipping_postcode,
cd.name as shipping_country,

CONCAT_WS(' ', ai.firstname, ai.lastname ) AS invoice_name,
ai.address1 as invoice_addrress1,
ai.address2 as invoice_address2,
'' AS invoice_address3,
ai.city as invoice_city,
'' AS invoice_county,
ai.postcode as invoice_postcode,
ci.name as invoice_country,

g.email, 
ai.phone,
d.product_reference AS product_code,
d.product_name AS product_name,
d.product_quantity AS quantity,  
d.product_price,
'Standard Shipping' AS shipping_method,
o.payment AS payment_method,
'' AS total_shipping_cost,
'' AS total_tax,
o.total_paid_tax_incl AS total_order_value,
'' AS source,
'' AS gift_message,
ad.other AS notes,
CONCAT_WS(' ,', ad.company, ad.vat_number) AS company_name

FROM ps_order_detail d
LEFT JOIN ps_orders o ON ( d.id_order = o.id_order ) 
LEFT JOIN ps_customer g ON ( o.id_customer = g.id_customer ) 

LEFT JOIN ps_address ad ON (o.id_address_delivery = ad.id_address)
LEFT JOIN ps_address ai ON (o.id_address_invoice = ai.id_address)

LEFT JOIN ps_product pr ON (d.product_id = pr.id_product)
LEFT JOIN ps_country_lang cd ON (ad.id_country = cd.id_country)
LEFT JOIN ps_country_lang ci ON (ai.id_country = ci.id_country)

WHERE o.date_add >='". date('Y-m-d',$datep)."' and (o.current_state=2 or o.current_state=19 or o.current_state=9)

GROUP BY d.id_order, d.product_name
ORDER BY d.id_order DESC");
	

	// create a file pointer connected to the output stream
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;

// output the column headings
fputcsv($fp, array('Unique Order Ref(20)','Order date (for reference only)','Shipping Name(35)','Shipping Address 1(35)',
	'Shipping Address 2(35)','Shipping Address 3(35)','Shipping City(35)','Shipping County(35)','Shipping Post Code(10)',	
	'Shipping Country(35)','Invoice Name(35)','Invoice Address 1(35)','Invoice Address 2(35)','Invoice Address 3(35)','Invoice City(35)',
	'Invoice County(35)','Invoice Post Code(10)','Invoice Country(35)','Email Address(60)','Telephone(20)',
	'Product Code(15)','Product Description(for refence only)','Quantity(5)','Price(7,2)','Shipping Method(50)',
	'Payment Method(for reference only)','Total Shipping Cost(9,2)','Total Tax(9,2)','Total Order Value(9,2)',
	'Source(50)','Gift Message(250)','Notes(250)','Company Name'
));
	
    
    // Loop data and write to file pointer
    while ($line = $data->fetch_assoc()) fputcsv($fp, $line);
    
    // Place stream pointer at beginning
    rewind($fp);

    // Return the data
    return stream_get_contents($fp);

}



function send_csv_mail() {

    $filename = 'myfile';
	//$content = chunk_split(base64_encode(create_csv_string())); 
	$content = create_csv_string(); 
	
	//$mailto = 'andrzej@activeworking.com';
	//$mailto = 'web@sit-stand.com';
	$mailto = 'support1@sit-stand.com, support2@sit-stand.com';
	
	
	
    $subject = 'SST Dashboard Orders';


    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: Web <web@sit-stand.com>" . $eol;
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
    $body .= "Content-disposition: attachment;filename=SST_orders.csv" . $eol.$eol;
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

