<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"";
add_css(DIR_WS_ASSETS_CSS . 'account.css');
add_css(DIR_WS_ASSETS_CSS . 'component.css');
add_js(DIR_WS_ASSETS_JS . 'component.js');
if(!LOGGED_IN_USER){
    redirect(make_url());
}
if (isset($app['GET']['id']) && $app['GET']['id'] != '') {
    $query = new query('orders');
    $query->Where = "where id =$id";
    $orders = $query->DisplayOne();
    if($orders->user_id!=$app['user_info']->id){
        set_alert("error", "You are not authorized to see this order");
        redirect(make_url('orders'));
    }
    $query_one = new query('order_items as oi');
    $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_".$app['language']." as batch_name,c.first_name as firstname,c.last_name as lastname";
    $query_one->Where = " left join batches as b ON b.id = oi.product_id";
    $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
    //$query_one->print=1;
    $query_one->Where.= " where oi.order_id =$id   ORDER BY oi.customer_id";
    $orders_item = $query_one->ListOfAllRecords('object');
     //pr($orders_item);
} else {
    $query = new query('orders');
    $query->Where = "where user_id = " . $app['user_info']->id;
     $query->Where .= " order by id desc";
    $orders = $query->ListOfAllRecords();
}
?>

