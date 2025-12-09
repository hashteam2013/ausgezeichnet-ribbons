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
            } else{
                $queryObj = new query('departments');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('departments');
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            $query->Data['is_deleted'] = isset($app['POST']['delete'])? $app['POST']['delete']: '0';
                            if ($query->Insert()) {
                                set_alert('success', "New collection added successfully");
                                redirect(app_url('departments','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                            } else{
                            $msg = 'Collection name already exist';   
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
            } else{
                            $query = new query('departments');
                            $query->Data['id'] = $id;
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                             $query->Data['is_deleted'] = isset($app['POST']['delete'])? '1': '0';
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('departments','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('departments');
        $query->Where = "where id = ".$id;
        $departments = $query->DisplayOne();
        if(!(is_object($departments))){
            redirect(app_url('departments','list','list',array(),true));
        }
        break;
        
    case 'delete_department':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('departments');
            $query->id = $app['GET']['del'];
            $query->Field = " is_deleted ";
            $query->Where = " where id = '" . $app['GET']['del']. "'";
            $departments = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($departments))){
            redirect(app_url('departments','list','list',array(),true));
        }
        break;
        
    case 'list':
        $query = new query('departments');
        $query->Where = " order by position";
        $departments = $query->ListOfAllRecords('object');
        $data =   pagination('departments',$limit,$page_no,$url='','position asc');
        $departments= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
