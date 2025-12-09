<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if(trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                $queryObj = new query('categories');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('categories');
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                          //  $query->Data['is_district_related'] = isset($app['POST']['district'])? $app['POST']['district']:'0';
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            if ($query->Insert()) {
                               set_alert('success', "New category added successfully");
                                redirect(app_url('categories','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                            } else {
                            $msg = 'Category name already exist';   
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
                            $query = new query('categories');
                            $query->Data['id'] = $id;
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            //$query->Data['is_district_related'] = isset($app['POST']['district'])? '1':'0';
                            $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('categories','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('categories');
        $query->Where = "where id = ".$id;
        $categories = $query->DisplayOne();
        if(!(is_object($categories))){
            redirect(app_url('categories','list','list',array(),true));
        }
        break;
        
    case 'delete_category':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('categories');
            $query->id = $app['GET']['del'];
            $categories = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($categories))){
            redirect(app_url('categories','list','list',array(),true));
        }
        break;
        
    case 'list':
        $query = new query('categories');
        $query->Where = " order by position";
        $categories = $query->ListOfAllRecords('object');
        $data =   pagination('categories',$limit,$page_no,$url='','position asc');
        $categories= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
