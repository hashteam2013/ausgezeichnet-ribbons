
<?php


global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";

switch ($action):
    case'view':
        $query= new query('orders');
        $query->Where = "where id =$id";
        $orders = $query->DisplayOne();
        $newquery = new query('users');
        $newquery->where = "id = $orders->user_id";
        $trust = $newquery->DisplayOne();
        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " where oi.order_id =$id";
        $orders_item = $query_one->ListOfAllRecords('object');



    $log_filename = '../ad-min/post/' . $id . ".csv";


$countrycode = "AT";
$weight='';

if($orders->shipping_country==2)
{
	$weight='1';
	$countrycode = "DE";
}

if($orders->shipping_company=="")
{
$log_title = UTFencoder2("Sendungsnummer;Absenderreferenz1;Absenderreferenz2;PaketReferenz;Empfänger.Titel;Empfänger.Name1;Empfänger.Name2;Empfänger.Name3;Empfänger.Name4;Empfänger.Tel1;Empfänger.Mail;Empfänger.Adresszeile1;Empfänger.Hausnummer;Empfänger.Postleitzahl;Empfänger.Ort;Empfänger.Land;Gewicht;Produkt;Zusatzleistungen (CSV 2);Returnsendung (0…Nein/ 1…Ja);KundenID;PrinterShippingNETName;Absender.Titel;Absender.Name1;Absender.Name2;Absender.Name3;Absender.Name4;Absender.Tel1;Absender.Mail;Absender.Adresszeile1;Absender.Hausnummer;Absender.Postleitzahl;Absender.Ort;Absender.Land;ProvinzIsoCode;Rücksendeweg;Rücksendeoption;Rücksendedauer;Zollbeschreibung;Begleitdokumente;Artikelliste");
$log_msg = $log_title . "\n" . "1" . UTFencoder2($orders->id) . ";;;;;" . UTFencoder2($orders->shipping_firstname) . " " . UTFencoder2($orders->shipping_lastname) . ";" . "" . ";;;;" . UTFencoder2($orders->shipping_email) . ";" . UTFencoder2($orders->shipping_address1) . ";" . UTFencoder2($orders->shipping_address2) . ";" . UTFencoder2($orders->shipping_zip) . ";" . UTFencoder2($orders->shipping_city) . ";" . $countrycode . ";" . $weight . ";" . UTFencoder2($orders->shipmenttarif) . ";;;;;;;;;;;;;;;";
}
else
{
$log_title = UTFencoder2("Sendungsnummer;Absenderreferenz1;Absenderreferenz2;PaketReferenz;Empfänger.Titel;Empfänger.Name1;Empfänger.Name2;Empfänger.Name3;Empfänger.Name4;Empfänger.Tel1;Empfänger.Mail;Empfänger.Adresszeile1;Empfänger.Hausnummer;Empfänger.Postleitzahl;Empfänger.Ort;Empfänger.Land;Gewicht;Produkt;Zusatzleistungen (CSV 2);Returnsendung (0…Nein/ 1…Ja);KundenID;PrinterShippingNETName;Absender.Titel;Absender.Name1;Absender.Name2;Absender.Name3;Absender.Name4;Absender.Tel1;Absender.Mail;Absender.Adresszeile1;Absender.Hausnummer;Absender.Postleitzahl;Absender.Ort;Absender.Land;ProvinzIsoCode;Rücksendeweg;Rücksendeoption;Rücksendedauer;Zollbeschreibung;Begleitdokumente;Artikelliste");
$log_msg = $log_title . "\n" . "1" . UTFencoder2($orders->id) . ";;;;;" . UTFencoder2($orders->shipping_company) . ";" . UTFencoder2($orders->shipping_firstname) . " " . UTFencoder2($orders->shipping_lastname) . ";;;;" . UTFencoder2($orders->shipping_email) . ";" . UTFencoder2($orders->shipping_address1) . ";" . UTFencoder2($orders->shipping_address2) . ";" . UTFencoder2($orders->shipping_zip) . ";" . UTFencoder2($orders->shipping_city) . ";" . $countrycode . ";"  . $weight . ";" . UTFencoder2($orders->shipmenttarif) . ";;;;;;;;;;;;;;;";    
}




    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_filename, $log_msg . "\n");



set_alert('success', 'In Post Versandliste aufgenommen');
redirect("https://www.ausgezeichnet.cc/ad-min/app.php?page=orders&view=view&action=view&id=".$id);

    endswitch;



?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

