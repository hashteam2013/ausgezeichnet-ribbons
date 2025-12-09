<?php

global $app;

add_css(DIR_WS_ASSETS_CSS . 'account.css');
add_css(DIR_WS_ASSETS_CSS . 'component.css');

if (!LOGGED_IN_USER) {
    redirect(make_url());
}

if (isset($app['POST']['update'])) {
    //  pr($app['POST']);
    $msg = '';
    if (trim($app['POST']['old_password']) == '') {
        $msg = 'Please enter old password';
    } elseif (trim($app['POST']['new_password']) == '') {
        $msg = 'Please enter new password';
    } elseif (trim($app['POST']['confirm_new_password']) == '') {
        $msg = 'Please enter confirm password';
    } elseif (strlen($app['POST']['new_password']) <= '4') {
        $msg = 'Password lenght must be five or more';
    } elseif (strlen($app['POST']['new_password']) > '20') {
        $msg = 'Password lenght cannot be more than 20';
    } elseif ($app['POST']['confirm_new_password'] != $app['POST']['new_password']) {
        $msg = 'Password and confirm password should be same';
    } else {
        $old_password = generateHash($app['POST']['old_password']);
        $queryObj = new query('users');
        $queryObj->Where = " where id = '" . $app['user_info']->id . "' and password = '" . $old_password . "'";
        //$queryObj->print=1;
        $object = $queryObj->DisplayOne();
        if (is_object($object) && count($object)) {
            $query = new query('users');
            $query->Data['id'] = $app['user_info']->id;
            $query->Data['password'] = generateHash($app['POST']['new_password']);
            if ($query->Update()) {
                set_alert('success', "Password updated successfully.");
                redirect(make_url('change_password', array(), true));
            } else {
                $msg = 'Error occurred while updating password. Please try again!';
            }
        } else {
            $msg = 'Wrong old password';
        }
    }
    set_alert('error', $msg);
}
       
