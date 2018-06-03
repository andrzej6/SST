<?php


function create_csv_string() {
  
// fetch the data
    $datep = strtotime('- 30 days');

	// create a file pointer connected to the output stream
    if (!$fp = fopen('php://temp', 'w+')) return FALSE;

   // output the column headings
   fputcsv($fp, array('email','date',));
   
	$conn = new mysqli('localhost', 'gbs2_7a8le', 'ZuLu12^*)(', 'gbs2_prestashop');
	
    $data1 =$conn->query("SELECT email, date_add FROM ps_customer WHERE date_add >='". date('Y-m-d',$datep)."' ORDER BY date_add DESC");
	$data2 =$conn->query("SELECT email, date_created FROM ps_corporates WHERE date_created >='". date('Y-m-d',$datep)."' ORDER BY date_created DESC");
	$data3 =$conn->query("SELECT email, created FROM ps_enquiries_data WHERE created >='". date('Y-m-d',$datep)."' ORDER BY created DESC");
	
    fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------WEBSITE REGISTRATIONS--------------'));
    while ($line = $data1->fetch_assoc()) fputcsv($fp, $line);
	
	fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------CORPORATE SALES REGISTRATIONS--------------'));
    while ($line = $data2->fetch_assoc()) fputcsv($fp, $line);
	
	fputcsv($fp, array('','',));
    fputcsv($fp, array('','--------------SST PRODUCT COMMENTS / CONTACT FORM--------------'));
    while ($line = $data3->fetch_assoc()) fputcsv($fp, $line);
	
    
    // Place stream pointer at beginning
    rewind($fp);

    // Return the data
    return stream_get_contents($fp);

}



function send_csv_mail() {

    $filename = 'myfile';
	$content = chunk_split(base64_encode(create_csv_string())); 
	//$content = create_csv_string(); 
	
	$mailto = 'digital@sit-stand.com';
	//$mailto = 'andrzejdlugoszsst@gmail.com';
    $subject = 'Sit-Stand.Com Registrations';


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
    $body .= "Content-disposition: attachment;filename=sst-registrations.csv" . $eol.$eol;
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

