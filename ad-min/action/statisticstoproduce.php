<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;



switch ($action):
    case 'list':

 $query3 = new query('order_items');
 $query3->Field = "product_id, sum(order_items.quantity) as numberofitems, ribbon_name_dr, count(order_items.order_id) as NumberOfProcessedOrders, order_items.unit_price, order_items.quantity, order_items.date_add";
 $query3->Where = "INNER JOIN batches ON product_id = batches.id WHERE order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1' AND orders.is_order_cancelled='0') GROUP BY (`product_id`) ORDER BY numberofitems desc";
$validorderitems = $query3->ListOfAllRecords('object');

 $query3 = new query('order_items');
 $query3->Field = "product_id, sum(order_items.quantity) as numberofitems, ribbon_name_dr, count(order_items.order_id) as NumberOfProcessedOrders, order_items.unit_price, order_items.quantity, order_items.date_add";
 $query3->Where = "INNER JOIN batches ON product_id = batches.id WHERE order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1' AND orders.is_order_cancelled='1') GROUP BY (`product_id`) ORDER BY numberofitems desc";
$cancelledorderitems = $query3->ListOfAllRecords('object');

 $query4 = new query('order_items');
 $query4->Field = "`product_id`, sum(order_items.quantity) as numberofitems, count(order_items.order_id) as NumberOfProcessedOrders";
 $query4->Where = " WHERE order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1' AND orders.is_packing_made='1' AND orders.is_order_cancelled='0')  GROUP BY (`product_id`)";
 $shippedorderitems = $query4->ListOfAllRecords('object');




 $query5 = new query('orders');
 $query5->Field = "grand_total, discount, date_add, id, total_shipping_amount";
 $query5->Where = " WHERE is_order_valid=1 AND is_payment_made=1 ";
 
$validorders = $query5->ListOfAllRecords('object');


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
