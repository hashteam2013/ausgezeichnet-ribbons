<?php
global $app;
switch ($action):
    case 'manage':
        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['firstname']) == '') {
                $msg = 'Please enter firstname';
            }elseif (trim($app['POST']['lastname']) == '') {
                $msg = 'Please enter lastname';
            }elseif (trim($app['POST']['email']) == '') {
                $msg = 'Please enter email';
            } else{
                if (filter_var($app['POST']['email'], FILTER_VALIDATE_EMAIL)){
                    $queryObj = new query('admin_users');
                    $queryObj->Field = " id";
                    $queryObj->Where = " where id != '".$app['admin_info']->id."' and email = '".$app['POST']['email']."'";
                    $object = $queryObj->DisplayOne();
                    if(is_object($object)){
                        $msg = 'Account already associated with same email';
                    } else{
                        $query = new query('admin_users');
                        $query->Data['id'] = $app['admin_info']->id;
                        $query->Data['firstname'] = ucwords($app['POST']['firstname']);
                        $query->Data['lastname'] = ucwords($app['POST']['lastname']);
                        $query->Data['email'] = $app['POST']['email'];
                        if ($query->Update()) {
                            set_alert('success', "Account info updated successfully");
                            redirect(app_url('profile','manage','manage',array(),true));
                        } else {
                            $msg = 'Error occurred while updating account info. Please try again!';
                        }
                    }
                } else{
                    $msg = 'Please enter valid email';
                }
            }
            set_alert('error', $msg);
        }
        
        break;
    
    case 'change_password':
        if (isset($app['POST']['update'])) {
            $msg = '';
            
            if (trim($app['POST']['old_password']) == '') {
                $msg = 'Please enter old password';
            } elseif (trim($app['POST']['new_password']) == '') {
                $msg = 'Please enter new password';
            } elseif (strlen($app['POST']['new_password']) <= '4') {
                $msg = 'Password lenght must be five or more';
            } elseif (strlen($app['POST']['new_password']) > '20') {
                $msg = 'Password lenght cannot be more than 20';
            } elseif (trim($app['POST']['confirm_new_password']) == '') {
                $msg = 'Please enter confirm password';
            } elseif ($app['POST']['confirm_new_password'] != $app['POST']['new_password']) {
                $msg = 'Password and confirm password should be same';
            } else {
                $old_password = generateHash($app['POST']['old_password']);
                $queryObj = new query('admin_users');
                $queryObj->Field = " id";
                $queryObj->Where = " where id = '".$app['admin_info']->id."' and password = '".$old_password."'";
                $object = $queryObj->DisplayOne();
                
                if (is_object($object) && count($object)) {
                    $query = new query('admin_users');
                    $query->Data['id'] = $app['admin_info']->id;
                    $query->Data['password'] = generateHash($app['POST']['new_password']);
                    if ($query->Update()) {
                        set_alert('success', "Password updated successfully.");
                        redirect(app_url('profile','change_password','change_password',array(),true));
                    } else {
                        $msg = 'Error occurred while updating password. Please try again!';
                    }
                } else{
                    $msg = 'Wrong old password';
                }
            }
            set_alert('error', $msg);
        }
        break;
    default:
        break;
endswitch;
