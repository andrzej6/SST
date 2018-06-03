<?php


function create_csv_string() {
  
// fetch the data
    $datep = strtotime('- 7 days');

	// create a file pointer connected to the output stream
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;

   // output the column headings
   fputcsv($fp, array('first name','last name','email','phone','date'));
   
	$conn = new mysqli('localhost', 'gbs2_7a8le', 'ZuLu12^*)(', 'gbs2_prestashop');
	
    
	$data1 =$conn->query("SELECT g.firstname, g.lastname, g.email, ad.phone, g.date_add as reg_date FROM ps_customer g LEFT JOIN ps_orders o ON ( g.id_customer = o.id_customer ) LEFT JOIN ps_address ad ON (g.id_customer = ad.id_customer) WHERE g.date_add >='". date('Y-m-d',$datep)."' and o.date_add is Null and  ad.phone!='' GROUP BY g.email ORDER BY g.date_add DESC");
	
	

	
    fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------REGISTRATIONS ON SST NON ORDERED--------------'));
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
	
	$mailto = 'rik@sit-stand.com';
    $subject = 'Sit-Stand.Com - Registered on SST, not ordered ';


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
    $body .= "Content-disposition: attachment;filename=registered-not-ordered.csv" . $eol.$eol;
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

