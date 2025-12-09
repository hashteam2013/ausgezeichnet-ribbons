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
            }elseif (trim($app['POST']['max_ribbon']) == '') {
                $msg = 'Please enter max allowed ribbon';
            }else{
                $queryObj = new query('districts');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('districts');
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            $query->Data['max_ribbon'] = $app['POST']['max_ribbon'];
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            $query->Data['is_allowed'] = isset($app['POST']['allow'])? $app['POST']['allow']: '0';
                            if ($query->Insert()) {
                                set_alert('success', "New district added successfully");
                                redirect(app_url('districts','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                             } else{
                            $msg = 'District name already exist';   
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
            } elseif (trim($app['POST']['max_ribbon']) == '') {
                $msg = 'Please enter max allowed ribbons';
            }else{
                            $query = new query('districts');
                            $query->Data['id'] = $id;
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            $query->Data['max_ribbon'] = $app['POST']['max_ribbon'];
                            $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                            $query->Data['is_allowed'] = isset($app['POST']['allow'])? '1': '0';
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('districts','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('districts');
        $query->Where = "where id = ".$id;
        $districts = $query->DisplayOne();
        if(!(is_object($districts))){
            redirect(app_url('districts','list','list',array(),true));
        }
        
        break;
           break;
           
     case 'delete_district':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('districts');
            $query->id = $app['GET']['del'];
            $districts = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($districts))){
            redirect(app_url('districts','list','list',array(),true));
        }
        break;

   
    case 'list':
        $query = new query('districts');
        $query->Where = " order by position";
        $districts = $query->ListOfAllRecords('object');
        $data =   pagination('districts',$limit,$page_no,$url='','position asc');
        $districts= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
