<?php


function create_csv_string() {
  
// fetch the data
    $datep = strtotime('- 31 days');

	// create a file pointer connected to the output stream
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;

   // output the column headings
   fputcsv($fp, array('order ref.','country','vat_number','paid','date'));
   
	$conn = new mysqli('localhost', 'gbs2_7a8le', 'ZuLu12^*)(', 'gbs2_prestashop');
	
    //LAST 30 DAYS
	//$data1 =$conn->query("SELECT reference, date_add FROM ps_orders WHERE date_add >='". date('Y-m-d',$datep)."' and total_paid_tax_excl = total_paid_tax_incl ORDER BY date_add DESC");
	$data1 =$conn->query("SELECT o.reference,c.name as country,a.vat_number,o.total_paid_tax_excl, o.date_add FROM ps_orders o LEFT JOIN ps_address a on o.id_customer=a.id_customer LEFT JOIN ps_country_lang c on a.id_country=c.id_country WHERE o.date_add >='". date('Y-m-d',$datep)."'and o.total_paid_tax_excl = o.total_paid_tax_incl GROUP BY o.reference ORDER BY o.date_add DESC");
	
	//ALL TIME
	//$data1 =$conn->query("SELECT reference, date_add FROM ps_orders WHERE total_paid_tax_excl = total_paid_tax_incl ORDER BY date_add DESC");

	
    fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------ORDERS WITHOUT PAID VAT--------------'));
    while ($line = $data1->fetch_assoc()) fputcsv($fp, $line);
	
	
    
    // Place stream pointer at beginning
    rewind($fp);

    // Return the data
    return stream_get_contents($fp);

}



function send_csv_mail() {

    $filename = 'myfile';
	$content = chunk_split(base64_encode(create_csv_string())); 
	//$content = create_csv_string(); 
	
	$mailto = 'jackie@sit-stand.com';
    $subject = 'Sit-Stand.Com - Orders without paid VAT - last 30 days ';


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
    $body .= "Content-disposition: attachment;filename=sst-orders-no-vat.csv" . $eol.$eol;
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

