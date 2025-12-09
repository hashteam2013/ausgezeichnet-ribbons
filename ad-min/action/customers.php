<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = 10;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['firstname']) == '') {
                $msg = 'Please enter firstname';
            }elseif (trim($app['POST']['lastname']) == '') {
                $msg = 'Please enter lastname';
            }else{
                    $query = new query('customers');
                            $query->Data['first_name'] = $app['POST']['firstname'];
                            $query->Data['last_name'] = $app['POST']['lastname'];
                            $query->Data['user_id'] =  $app['POST']['id'];
                            $query->Data['is_deleted'] =  $app['POST']['id'];
                            $query->Data['ShownName'] =  $app['POST']['id'];
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            if ($query->Insert()) {
                                set_alert('success', "New customer added successfully");
                                redirect(app_url('customers','list','list',array('id'=>$app['POST']['id']),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
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
            }else{
                            $query = new query('customers');
                            $query->Data['id'] = $id;
                            $query->Data['first_name'] = ucwords($app['POST']['firstname']);
                            $query->Data['last_name'] = ucwords($app['POST']['lastname']);
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }                
            }
            set_alert('error', $msg);
        }
        $query = new query('customers');
        $query->Where = "where id = ".$id;
        $customers = $query->DisplayOne();
        if(!(is_object($customers))){
            redirect(app_url('customers','list','list',array(),true));
        }
        break;
       
    case 'delete':
        if(isset($app['GET']['del']) && $app['GET']['del']!=''){
            $query = new query('customers');
            $query->id = $app['GET']['del']; 
            $user_id = $app['GET']['id'];
            $customers = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('customers','list','list',array('id'=>$user_id),true));
        break; 
    
   default:
    case 'customer_list':
        $id = $app['GET']['id'];
        $query = new query('customers');
        $query->Where = " where user_id = $id  and is_deleted = 0 order by id asc";
        $customers = $query->ListOfAllRecords('object');
        //$data =   pagination('customers',$limit,$page_no,$url='');
        //$customers= $data['show_record'];
        //$pagination = $data['pagination'];
        break;
endswitch;
