<?php

global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;



switch ($action):
    case 'list':

 $query3 = new query('order_items');
 $query3->Field = "product_id, sum(order_items.quantity) as numberofitems, ribbon_name_dr, count(order_items.order_id) as NumberOfProcessedOrders, MIN(order_items.unit_price) as unit_price, MIN(order_items.date_add) as first_date";
 $query3->Where = "INNER JOIN batches ON product_id = batches.id WHERE order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1') GROUP BY product_id, ribbon_name_dr ORDER BY numberofitems desc";
        
$validorderitems = $query3->ListOfAllRecords('object');

 $query4 = new query('order_items');
 $query4->Field = "`product_id`, sum(order_items.quantity) as numberofitems, count(order_items.order_id) as NumberOfProcessedOrders";
 $query4->Where = " WHERE order_items.order_id IN(SELECT orders.id FROM orders WHERE  orders.is_order_valid='1' AND orders.is_packing_made='1')  GROUP BY (`product_id`)";
 $shippedorderitems = $query4->ListOfAllRecords('object');


 $query6 = new query('order_items');
 $query6->Field = "product_id, sum(order_items.quantity) as numberofitems, ribbon_name_dr, count(order_items.order_id) as NumberOfProcessedOrders, MIN(order_items.unit_price) as unit_price, MIN(order_items.date_add) as first_date";
 $query6->Where = "INNER JOIN batches ON product_id = batches.id WHERE  YEAR(order_items.date_add)=YEAR(NOW()) AND MONTH(order_items.date_add) = MONTH(NOW())-1 AND  order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1') GROUP BY product_id, ribbon_name_dr ORDER BY numberofitems desc";
        
$validorderitemsThisMonth = $query6->ListOfAllRecords('object');

 $query6 = new query('order_items');
 $query6->Field = "product_id, sum(order_items.quantity) as numberofitems, ribbon_name_dr, count(order_items.order_id) as NumberOfProcessedOrders, MIN(order_items.unit_price) as unit_price, MIN(order_items.date_add) as first_date";
 $query6->Where = "INNER JOIN batches ON product_id = batches.id WHERE  YEAR(order_items.date_add)=2022 AND MONTH(order_items.date_add) = 12 AND  order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1') GROUP BY product_id, ribbon_name_dr ORDER BY numberofitems desc";
        
$validorderitemsLastMonth = $query6->ListOfAllRecords('object');



 $query5 = new query('orders');
 $query5->Field = "grand_total, discount, date_add, id, total_shipping_amount, comment";
 $query5->Where = " WHERE is_order_valid=1 AND is_payment_made<2 AND comment<>'Anbot'";
 
$validorders = $query5->ListOfAllRecords('object');


$oct2017=0;
$nov2017=0;
$dec2017=0;
$last1=0;
$last7=0;
$last30=0;
$last90=0;
$last365=0;
$U2017=0;
$U2018=0;
$U2019=0;
$U2020=0;
$U2021=0;
$U2022=0;
$U2023=0;
$U2024=0;
$U2025=0;

$jan2018=0;
$feb2018=0;
$mar2018=0;
$apr2018=0;
$may2018=0;
$june2018=0;
$july2018=0;
$aug2018=0;
$sep2018=0;
$oct2018=0;
$nov2018=0;
$dec2018=0;


$jan2019=0;
$feb2019=0;
$mar2019=0;
$apr2019=0;
$may2019=0;
$june2019=0;
$july2019=0;
$aug2019=0;
$sep2019=0;
$oct2019=0;
$nov2019=0;
$dec2019=0;


$jan2020=0;
$feb2020=0;
$mar2020=0;
$apr2020=0;
$may2020=0;
$june2020=0;
$july2020=0;
$aug2020=0;
$sep2020=0;
$oct2020=0;
$nov2020=0;
$dec2020=0;

$jan2021=0;
$feb2021=0;
$mar2021=0;
$apr2021=0;
$may2021=0;
$june2021=0;
$july2021=0;
$aug2021=0;
$sep2021=0;
$oct2021=0;
$nov2021=0;
$dec2021=0;

$jan2022=0;
$feb2022=0;
$mar2022=0;
$apr2022=0;
$may2022=0;
$june2022=0;
$july2022=0;
$aug2022=0;
$sep2022=0;
$oct2022=0;
$nov2022=0;
$dec2022=0;

$jan2023=0;
$feb2023=0;
$mar2023=0;
$apr2023=0;
$may2023=0;
$june2023=0;
$july2023=0;
$aug2023=0;
$sep2023=0;
$oct2023=0;
$nov2023=0;
$dec2023=0;

$jan2024=0;
$feb2024=0;
$mar2024=0;
$apr2024=0;
$may2024=0;
$june2024=0;
$july2024=0;
$aug2024=0;
$sep2024=0;
$oct2024=0;
$nov2024=0;
$dec2024=0;

$jan2025=0;
$feb2025=0;
$mar2025=0;
$apr2025=0;
$may2025=0;
$june2025=0;
$july2025=0;
$aug2025=0;
$sep2025=0;
$oct2025=0;
$nov2025=0;
$dec2025=0;

foreach ($validorders as $order)
{

	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2017)
	{
		$oct2017=$oct2017+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
		$U2017=$U2017+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2017)
	{
		$nov2017=$nov2017+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2017=$U2017+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2017)
	{
		$dec2017=$dec2017+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2017=$U2017+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}


	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2018)
	{
		$jan2018=$jan2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2018)
	{
		$feb2018=$feb2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2018)
	{
		$mar2018=$mar2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2018)
	{
		$apr2018=$apr2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2018)
	{
		$may2018=$may2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2018)
	{
		$june2018=$june2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2018)
	{
		$july2018=$july2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2018)
	{
		$aug2018=$aug2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2018)
	{
		$sep2018=$sep2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2018)
	{
		$oct2018=$oct2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2018)
	{
		$nov2018=$nov2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2018)
	{
		$dec2018=$dec2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2018=$U2018+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}



	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2019)
	{
		$jan2019=$jan2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2019)
	{
		$feb2019=$feb2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2019)
	{
		$mar2019=$mar2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2019)
	{
		$apr2019=$apr2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2019)
	{
		$may2019=$may2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2019)
	{
		$june2019=$june2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2019)
	{
		$july2019=$july2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2019)
	{
		$aug2019=$aug2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2019)
	{
		$sep2019=$sep2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2019)
	{
		$oct2019=$oct2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2019)
	{
		$nov2019=$nov2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2019)
	{
		$dec2019=$dec2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2019=$U2019+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}



	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2020)
	{
		$jan2020=$jan2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2020)
	{
		$feb2020=$feb2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2020)
	{
		$mar2020=$mar2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2020)
	{
		$apr2020=$apr2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2020)
	{
		$may2020=$may2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2020)
	{
		$june2020=$june2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2020)
	{
		$july2020=$july2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2020)
	{
		$aug2020=$aug2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2020)
	{
		$sep2020=$sep2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2020)
	{
		$oct2020=$oct2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2020)
	{
		$nov2020=$nov2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2020)
	{
		$dec2020=$dec2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2020+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}



	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2021)
	{
		$jan2021=$jan2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2021)
	{
		$feb2021=$feb2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2021)
	{
		$mar2021=$mar2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2021)
	{
		$apr2021=$apr2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2021)
	{
		$may2021=$may2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2021)
	{
		$june2021=$june2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2021)
	{
		$july2021=$july2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2021)
	{
		$aug2021=$aug2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2021)
	{
		$sep2021=$sep2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2021)
	{
		$oct2021=$oct2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2021)
	{
		$nov2021=$nov2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2021)
	{
		$dec2021=$dec2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2021=$U2021+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}





	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2022)
	{
		$jan2022=$jan2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2022)
	{
		$feb2022=$feb2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2022)
	{
		$mar2022=$mar2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2022)
	{
		$apr2022=$apr2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2022)
	{
		$may2022=$may2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2022)
	{
		$june2022=$june2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2022)
	{
		$july2022=$july2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2022)
	{
		$aug2022=$aug2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2022)
	{
		$sep2022=$sep2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2022)
	{
		$oct2022=$oct2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2022)
	{
		$nov2022=$nov2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2022)
	{
		$dec2022=$dec2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2022=$U2022+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}





	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2023)
	{
		$jan2023=$jan2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2023)
	{
		$feb2023=$feb2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2023)
	{
		$mar2023=$mar2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2023)
	{
		$apr2023=$apr2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2023)
	{
		$may2023=$may2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2023)
	{
		$june2023=$june2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2023)
	{
		$july2023=$july2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2023)
	{
		$aug2023=$aug2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2023)
	{
		$sep2023=$sep2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2023)
	{
		$oct2023=$oct2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2023)
	{
		$nov2023=$nov2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2023)
	{
		$dec2023=$dec2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2023=$U2023+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}






	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2024)
	{
		$jan2024=$jan2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2024)
	{
		$feb2024=$feb2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2024)
	{
		$mar2024=$mar2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2024)
	{
		$apr2024=$apr2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2024)
	{
		$may2024=$may2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2024)
	{
		$june2024=$june2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2024)
	{
		$july2024=$july2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2024)
	{
		$aug2024=$aug2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2024)
	{
		$sep2024=$sep2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2024)
	{
		$oct2024=$oct2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2024)
	{
		$nov2024=$nov2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2024)
	{
		$dec2024=$dec2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2024=$U2024+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}






	if (date('n',strtotime($order->date_add))==1 && date('Y',strtotime($order->date_add))==2025)
	{
		$jan2025=$jan2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
    	if (date('n',strtotime($order->date_add))==2 && date('Y',strtotime($order->date_add))==2025)
	{
		$feb2025=$feb2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==3 && date('Y',strtotime($order->date_add))==2025)
	{
		$mar2025=$mar2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==4 && date('Y',strtotime($order->date_add))==2025)
	{
		$apr2025=$apr2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==5 && date('Y',strtotime($order->date_add))==2025)
	{
		$may2025=$may2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==6 && date('Y',strtotime($order->date_add))==2025)
	{
		$june2025=$june2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==7 && date('Y',strtotime($order->date_add))==2025)
	{
		$july2025=$july2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2020=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==8 && date('Y',strtotime($order->date_add))==2025)
	{
		$aug2025=$aug2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
    	if (date('n',strtotime($order->date_add))==9 && date('Y',strtotime($order->date_add))==2025)
	{
		$sep2025=$sep2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==10 && date('Y',strtotime($order->date_add))==2025)
	{
		$oct2025=$oct2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==11 && date('Y',strtotime($order->date_add))==2025)
	{
		$nov2025=$nov2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}
	if (date('n',strtotime($order->date_add))==12 && date('Y',strtotime($order->date_add))==2025)
	{
		$dec2025=$dec2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
$U2025=$U2025+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;

	}




$test2=date_create($order->date_add);
$test= date_create();
$test3=date_diff($test,$test2);

	if ( date_interval_format ($test3,'%a')<1)
	{
		$last1=$last1+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}

	if ( date_interval_format ($test3,'%a')<7)
	{
		$last7=$last7+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}

	if ( date_interval_format ($test3,'%a')<30)
	{
		$last30=$last30+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
	if ( date_interval_format ($test3,'%a')<90)
	{
		$last90=$last90+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}
	if ( date_interval_format ($test3,'%a')<365)
	{
		$last365=$last365+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
	}


}



        break;

case 'view':
// $query3 = new query('order_items');
// $query3->Field = "*";
 //$query3->Where = "WHERE order_items.product_id =$id";
        
//$validorderitems = $query3->ListOfAllRecords('object');


 $query3 = new query('order_items');
 $query3->Field = "order_id, customer_id, order_items.quantity as quantity, orders.billing_firstname, orders.billing_lastname, batches.ribbon_name_dr";
 $query3->Where = "INNER JOIN batches ON product_id = batches.id INNER JOIN orders ON orders.id=order_items.order_id WHERE order_items.product_id =$id AND order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1')";
        
$validorderitems = $query3->ListOfAllRecords('object');

 $query4 = new query('order_items');
 $query4->Field = "order_id, customer_id, order_items.quantity as quantity, orders.billing_firstname, orders.billing_lastname, batches.ribbon_name_dr";
 $query4->Where = "INNER JOIN batches ON product_id = batches.id INNER JOIN orders ON orders.id=order_items.order_id WHERE order_items.product_id =$id AND order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_packing_made='1')";

 $shippedorderitems = $query4->ListOfAllRecords('object');





        break;


endswitch;
?>
