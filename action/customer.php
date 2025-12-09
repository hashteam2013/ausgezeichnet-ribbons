<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
add_css(DIR_WS_ASSETS_CSS . 'account.css');
add_css(DIR_WS_ASSETS_CSS . 'component.css');
if (!LOGGED_IN_USER) {
    redirect(make_url());
}
if( $id!=0){
$query1=new query('customers');
$query1->Where = "Where id = $id ";
$del = $query1->Delete_where();

}

$query = new query('customers');
$query->Where = "where user_id = " . $app['user_info']->id . " ORDER BY last_name";
$customers = $query->ListOfAllRecords();
?>
