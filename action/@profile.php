<?php

global $app;
$id = $logged_in_user_info->id;
add_css(DIR_WS_ASSETS_CSS . 'account.css');
add_css(DIR_WS_ASSETS_CSS . 'component.css');
add_js(DIR_WS_ASSETS_JS . 'component.js');
if (!LOGGED_IN_USER) {
    redirect(make_url());
}
$query = new query('departments');
$query->Field = "id,name_en";
$get_department = $query->ListOfAllRecords();


$query = new query('districts');
$query->Field = "id,name_en";
$get_district = $query->ListOfAllRecords();

if (isset($app['POST']['update'])) {
    $msg = '';
    if (trim($app['POST']['firstname']) == '') {
        $msg = 'Please enter firstname ';
    } elseif (trim($app['POST']['lastname']) == '') {
        $msg = 'Please enter lastname';
    } elseif (trim($app['POST']['fone']) == '') {
        $msg = 'Please enter contact number';
    } elseif (trim($app['POST']['address1']) == '') {
        $msg = 'Please enter address';
    } elseif (trim($app['POST']['city']) == '') {
        $msg = 'Please enter city';
    } elseif (trim($app['POST']['state']) == '') {
        $msg = 'Please enter state';
    } elseif (trim($app['POST']['country']) == '') {
        $msg = 'Please enter country';
    } elseif (trim($app['POST']['zip']) == '') {
        $msg = 'Please enter zipcode';
    } elseif (trim($app['POST']['org']) == '') {
        $msg = 'Please enter organization';
    } elseif (trim($app['POST']['district']) == '') {
        $msg = 'Please enter district';
    } else {
        $query = new query('users');
        $query->Data['id'] = $id;
        $query->Data['company'] = $app['POST']['company'];
        $query->Data['first_name'] = ucwords($app['POST']['firstname']);
        $query->Data['last_name'] = ucwords($app['POST']['lastname']);
        $query->Data['phone'] = $app['POST']['fone'];
        $query->Data['email'] = $app['POST']['mail'];
        $query->Data['address1'] = $app['POST']['address1'];
        $query->Data['address2'] = $app['POST']['address2'];
        $query->Data['city'] = $app['POST']['city'];
        $query->Data['state'] = $app['POST']['state'];
        $query->Data['country'] = $app['POST']['country'];
        $query->Data['zipcode'] = $app['POST']['zip'];
        $query->Data['organization'] = $app['POST']['org'];
        $query->Data['district'] = $app['POST']['district'];
        if ($query->Update()) {
            set_alert('success', "Account info updated successfully");
            redirect(make_url('profile'));
        } else {
            $msg = 'Error occurred while updating account info. Please try again!';
        }
    }
    set_alert('error', $msg);
}
