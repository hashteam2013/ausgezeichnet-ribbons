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
                $queryObj = new query('deliveryconditions');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('deliveryconditions');
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            if ($query->Insert()) {
                                set_alert('success', "New deliveryconditions added successfully");
                                redirect(app_url('deliveryconditions','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating deliveryconditions. Please try again!';
                            }
                             } else{
                            $msg = 'delivery condition already exists';   
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
                            $query = new query('deliveryconditions');
                            $query->Data['id'] = $id;
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            if ($query->Update()) {
                                set_alert('success', "deliverycondition info updated successfully");
                                redirect(app_url('deliveryconditions','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating deliveryconditions. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('deliveryconditions');
        $query->Where = "where id = ".$id;
        $deliveryconditions = $query->DisplayOne();
        if(!(is_object($deliveryconditions))){
            redirect(app_url('deliveryconditions','list','list',array(),true));
        }
        
        break;
           break;
           
     case 'delete_deliverycondition':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('deliveryconditions');
            $query->id = $app['GET']['del'];
            $deliverycondition = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($deliverycondition))){
            redirect(app_url('deliveryconditions','list','list',array(),true));
        }
        break;

   
    case 'list':
        $query = new query('deliveryconditions');
        $query->Where = " order by position";
        $deliveryconditions = $query->ListOfAllRecords('object');
        $data =   pagination('deliveryconditions',$limit,$page_no,$url='','position asc');
        $deliveryconditions= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
