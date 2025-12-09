<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            }else{
                $queryObj = new query('paymentconditions');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('paymentconditions');
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            if ($query->Insert()) {
                                set_alert('success', "New paymentconditions added successfully");
                                redirect(app_url('paymentconditions','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating paymentconditions. Please try again!';
                            }
                             } else{
                            $msg = 'payment condition already exists';   
                        }
            }
            set_alert('error', $msg);
        }
        break;
        
    case 'edit':
        
        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            }else{
                            $query = new query('paymentconditions');
                            $query->Data['id'] = $id;
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            if ($query->Update()) {
                                set_alert('success', "paymentcondition info updated successfully");
                                redirect(app_url('paymentconditions','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating paymentconditions. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('paymentconditions');
        $query->Where = "where id = ".$id;
        $paymentconditions = $query->DisplayOne();
        if(!(is_object($paymentconditions))){
            redirect(app_url('paymentconditions','list','list',array(),true));
        }
        
        break;
           break;
           
     case 'delete_paymentcondition':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('paymentconditions');
            $query->id = $app['GET']['del'];
            $paymentcondition = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($paymentcondition))){
            redirect(app_url('paymentconditions','list','list',array(),true));
        }
        break;

   
    case 'list':
        $query = new query('paymentconditions');
        $query->Where = " order by position";
        $paymentconditions = $query->ListOfAllRecords('object');
        $data =   pagination('paymentconditions',$limit,$page_no,$url='','position asc');
        $paymentconditions= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
