<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
switch ($action):
    case 'add':
        if (isset($app['POST']['add']))
        {

            $msg = '';
            if (trim($app['POST']['code']) == '') {
                $msg = 'Please enter code';
            }elseif (trim($app['POST']['rabatt']) == '') {
                $msg = 'Please enter rabatt';}
            else
            {
                    $queryObj = new query('rabattcodes');
                    $queryObj->Field = " id, code";
                    $queryObj->Where = " where code = '".$app['POST']['code']."'";
                    $object = $queryObj->DisplayOne();
                    if(!is_object($object)){
                            $query = new query('rabattcodes');
                            $query->Data['code'] = ucwords($app['POST']['code']);
                            $query->Data['rabatt'] = ucwords($app['POST']['rabatt']);
                            $query->Data['is_active'] = '1';
                            $query->Data['date_add'] = '1';
                            if ($query->Insert()) {
                                set_alert('success', "New code successfully");
                                redirect(app_url('rabattcodes','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                        } else{
                            $msg = 'Code already in use';   
                        }
                     
            }
            set_alert('error', $msg);
        }
        
        break;
        
    case 'edit':
        
        if (isset($app['POST']['update']))
        {

            $msg = '';
            if (trim($app['POST']['code']) == '') {
                $msg = 'Please enter code';
  
            }elseif (trim($app['POST']['rabatt']) == '') {
                $msg = 'Please enter rabatt';

            } else
            {

                    $queryObj = new query('rabattcodes');
                    $queryObj->Field = " id";
                    $queryObj->Where = " where code !=" .$app['POST']['code'];
                    $object = $queryObj->DisplayOne();
                    if(!is_object($object))
			{

                            $query = new query('rabattcodes');
                            $query->Data['id'] = $id;
                            $query->Data['code'] = ucwords($app['POST']['code']);
                            $query->Data['rabatt'] = ucwords($app['POST']['rabatt']);

                            if ($query->Update()) {
                                set_alert('success', "Code updated successfully");
                                redirect(app_url('rabattcodes','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating code. Please try again!';
                            }
                        } else
                        {
                            $msg = 'code already in use';   
                        }
                
            
            set_alert('error', 'FEHLER:' . $msg);
        }
        }
        $query = new query('rabattcodes');
        $query->Where = "where id = ".$id;
        $rabattcode = $query->DisplayOne();
            
        if(!(is_object($rabattcode)))
        {
            redirect(app_url('rabattcodes','list','list',array(),true));
        }
        
        break;
        
    case 'delete_code':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('rabattcodes');
            $query->id = $app['GET']['del'];
            $rabattcodes = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('rabattcodes','list','list',array(),true));
        break;
        
    case 'suspend_code':
        if(isset($app['GET']['suspend']) && $app['GET']['suspend']!=''){
            $query = new query('rabattcodes');
            $query->Data['id'] = $app['GET']['suspend'];
            $query->Data['is_active'] = '0';
            $rabattcodes = $query->Update();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('rabattcodes','list','list',array(),true));
        break;
    
    case 'unsuspend_code':
        if(isset($app['GET']['unsuspend']) && $app['GET']['unsuspend']!=''){
            $query = new query('rabattcodes');
            $query->Data['id'] = $app['GET']['unsuspend'];
            $query->Data['is_active'] = '1';
            $rabattcodes = $query->Update();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('rabattcodes','list','list',array(),true));
        break;
        
    default:
    
        case 'list':
        $query = new query('rabattcodes');
        $query->Where = " order by id asc";
        $rabattcodes = $query->ListOfAllRecords('object');
        break;
endswitch;
