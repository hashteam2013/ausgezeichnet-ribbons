<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['firstname']) == '') {
                $msg = 'Please enter firstname';
            }elseif (trim($app['POST']['lastname']) == '') {
                $msg = 'Please enter lastname';
            }elseif (trim($app['POST']['email']) == '') {
                $msg = 'Please enter email';
            }elseif (!filter_var($app['POST']['email'], FILTER_VALIDATE_EMAIL)){
                $msg = 'Please enter valid email';
            }elseif (trim($app['POST']['username']) == '') {
                $msg = 'Please enter username';
            }elseif (strlen($app['POST']['password']) <= '4') {
                $msg = 'Password lenght must be five or more';
            }elseif (strlen($app['POST']['password']) > '20') {
                $msg = 'Password lenght cannot be more than 20';
            } else{
                    $queryObj = new query('admin_users');
                    $queryObj->Field = " id";
                    $queryObj->Where = " where email = '".$app['POST']['email']."'";
                    $object = $queryObj->DisplayOne();
                    if(!is_object($object)){
                        $queryObj = new query('admin_users');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where username = '".$app['POST']['username']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('admin_users');
                            $query->Data['firstname'] = ucwords($app['POST']['firstname']);
                            $query->Data['lastname'] = ucwords($app['POST']['lastname']);
                            $query->Data['email'] = $app['POST']['email'];
                            $query->Data['username'] = $app['POST']['username'];
                            $query->Data['password'] = generateHash($app['POST']['password']);
                            $query->Data['role'] = 'admin';
                            $query->Data['added_by'] = $app['admin_info']->id;
                            $query->Data['is_active'] = '1';
                            $query->Data['date_add'] = '1';
                            if ($query->Insert()) {
                                set_alert('success', "New user added successfully");
                                redirect(app_url('users','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                        } else{
                            $msg = 'Account already associated with same username';   
                        }
                    } else{
                        $msg = 'Account already associated with same email';   
                    }
            }
            set_alert('error', $msg);
        }
        
        break;
        
    case 'edit':
        
        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['firstname']) == '') {
                $msg = 'Please enter firstname';
            }elseif (trim($app['POST']['lastname']) == '') {
                $msg = 'Please enter lastname';
            }elseif (trim($app['POST']['email']) == '') {
                $msg = 'Please enter email';
            }elseif (trim($app['POST']['username']) == '') {
                $msg = 'Please enter username';
            }elseif (trim($app['POST']['password']) != '' && strlen($app['POST']['password']) <= '4') {
                $msg = 'Password lenght must be five or more';
            }elseif (trim($app['POST']['password']) != '' && strlen($app['POST']['password']) > '20') {
                $msg = 'Password lenght cannot be more than 20';
            } else{
                if (filter_var($app['POST']['email'], FILTER_VALIDATE_EMAIL)){
                    $queryObj = new query('admin_users');
                    $queryObj->Field = " id";
                    $queryObj->Where = " where id != '".$id."' and email = '".$app['POST']['email']."'";
                    $object = $queryObj->DisplayOne();
                    if(!is_object($object)){
                        $queryObj = new query('admin_users');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where id != '".$id."' and username = '".$app['POST']['username']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('admin_users');
                            $query->Data['id'] = $id;
                            $query->Data['firstname'] = ucwords($app['POST']['firstname']);
                            $query->Data['lastname'] = ucwords($app['POST']['lastname']);
                            $query->Data['email'] = $app['POST']['email'];
                            $query->Data['username'] = $app['POST']['username'];
                            if(trim($app['POST']['password']) != '' ){
                                $query->Data['password'] = generateHash($app['POST']['password']);
                            }
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('users','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                        } else{
                            $msg = 'Account already associated with same username';   
                        }
                    } else{
                        $msg = 'Account already associated with same email';   
                    }
                } else{
                    $msg = 'Please enter valid email';
                }
            }
            set_alert('error', $msg);
        }
        
        $query = new query('admin_users');
        $query->Where = "where id = ".$id;
        $user = $query->DisplayOne();
            
        if(!(is_object($user))){
            redirect(app_url('users','list','list',array(),true));
        }
        
        break;
        
    case 'delete_user':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' && $app['admin_info']->role=='super_admin'){
            $query = new query('admin_users');
            $query->id = $app['GET']['del'];
            $users = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('users','list','list',array(),true));
        break;
        
    case 'suspend_user':
        if(isset($app['GET']['suspend']) && $app['GET']['suspend']!='' && $app['admin_info']->role=='super_admin'){
            $query = new query('admin_users');
            $query->Data['id'] = $app['GET']['suspend'];
            $query->Data['is_active'] = '0';
            $users = $query->Update();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('users','list','list',array(),true));
        break;
    
    case 'unsuspend_user':
        if(isset($app['GET']['unsuspend']) && $app['GET']['unsuspend']!='' && $app['admin_info']->role=='super_admin'){
            $query = new query('admin_users');
            $query->Data['id'] = $app['GET']['unsuspend'];
            $query->Data['is_active'] = '1';
            $users = $query->Update();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('users','list','list',array(),true));
        break;
        
    default:
    
        case 'list':
        $query = new query('admin_users');
        $query->Where = " order by firstname asc";
        $users = $query->ListOfAllRecords('object');
        break;
endswitch;
