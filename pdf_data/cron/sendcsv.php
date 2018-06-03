<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

$datep = strtotime('- 90 days');

// output the column headings
fputcsv($output, array('Unique Order Ref(20)','Order date (for reference only)','Shipping Name(35)','Shipping Address 1(35)',
	'Shipping Address 2(35)','Shipping Address 3(35)','Shipping City(35)','Shipping County(35)','Shipping Post Code(10)',	
	'Shipping Country(35)','Invoice Name(35)','Invoice Address 1(35)','Invoice Address 2(35)','Invoice Address 3(35)','Invoice City(35)',
	'Invoice County(35)','Invoice Post Code(10)','Invoice Country(35)','Email Address(60)','Telephone(20)',
	'Product Code(15)','Product Description(for refence only)','Quantity(5)','Price(7,2)','Shipping Method(50)',
	'Payment Method(for reference only)','Total Shipping Cost(9,2)','Total Tax(9,2)','Total Order Value(9,2)',
	'Source(50)','Gift Message(250)','Notes(250)','Company Name'
));

// fetch the data
mysql_connect('localhost', 'gbs2_7a8le', 'ZuLu12^*)(');
mysql_select_db('gbs2_prestashop');
$rows = mysql_query("SELECT 
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

WHERE o.date_add >='". date('Y-m-d',$datep)."'

GROUP BY d.id_order, d.product_name
ORDER BY d.id_order DESC");

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);