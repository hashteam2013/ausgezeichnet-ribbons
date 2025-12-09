<?php
global $app;
$query = new query('categories');
$query->Field = " id,name_en,name_dr,is_district_related,position, show_closed";
$query->Where = "where is_active = 1 order by position";
$categories = $query->ListOfAllRecords('object');

$query = new query('additional_categories');
$query->Field = " id,name_en,name_dr,is_district_related,position, show_closed";
$query->Where = "where is_active = 1 order by position";
$additional_categories = $query->ListOfAllRecords('object');

$query = new query('departments');
$query->Field = " id,name_en,name_dr";
$query->Where = "where is_active = 1 order by position";
$departments = $query->ListOfAllRecords('object');

$query = new query('districts');
$query->Field = " id,name_en,name_dr";
$query->Where = "where is_active = 1 order by position";
$districts = $query->ListOfAllRecords('object');

if(LOGGED_IN_USER){
    $query = new query('customers');
    $query->Field = " id,user_id,first_name,last_name,is_active";
    $query->Where = "where is_active = '1' and user_id = " . $app['user_info']->id . " ORDER BY last_name";
    $customers = $query->ListOfAllRecords();
} else{
    $customers = array();
    
}
$selected_customer_id = 0;
$selected_customer_batches = array();

if (!empty($customers)) {
    $selected_customer_id = $customers[0]['id'];
    $query = new query("customer_batches as cust");
    $query->Field = "batch.id,batch.batch_image,batch.level, batch.grade,batch.value,cust.batch_id,batch.type,batch.ribbon_name_en,batch.ribbon_name_dr,cust.customer_id,cust.id,cust.type,cust.number,cust.country,cust.year";
    $query->Where = "LEFT JOIN batches as batch ON batch.id = cust.batch_id";
    $query->Where .= " where cust.customer_id = " . $selected_customer_id." order by batch.value DESC";
    //$query->print=1;
    $selected_customer_batches = $query->ListOfAllRecords();

    $query2= new query('order_items'); 
    $query2->Field="order_items.id, order_items.customer_id, order_items.order_id , order_items.product_id,  orders.is_order_valid ";
    $query2->Where = " LEFT JOIN batches on order_items.product_id=batches.id LEFT JOIN orders on order_items.order_id=orders.id WHERE orders.is_order_valid='1'  AND order_items.customer_id IN(Select customers.id from customers WHERE customers.id=$selected_customer_id)  ORDER BY order_id ";
    $customer_order_items = $query2->ListOfAllRecords('object');
    


}
?>
