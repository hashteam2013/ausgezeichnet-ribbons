<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if($app['POST']['add_cat'] == ''){
               $msg = 'Please choose additional category';  
            }elseif(trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                    $queryObj = new query('add_cat_sub');
                    $queryObj->Field = " id";
                    $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                    $object = $queryObj->DisplayOne();
                    if(!is_object($object)){
                        $query = new query('add_cat_sub');
                        $query->Data['add_cat_id'] = $app['POST']['add_cat'];
                        $query->Data['name_en'] = $app['POST']['nameen'];
                        $query->Data['name_dr'] = $app['POST']['namedr'];
                        $query->Data['position'] = $app['POST']['position'];
                        $query->Data['date_add'] = '1';
                        $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                        $query->Data['is_deleted'] = isset($app['POST']['delete'])? $app['POST']['delete']: '0';
                        if ($query->Insert()) {
                            set_alert('success', "New additional category sub added successfully");
                            redirect(app_url('add_cat_sub','list','list',array(),true));
                        } else {
                            $msg = 'Error occurred while updating account info. Please try again!';
                        }
                        } else {
                        $msg = 'Additional category sub name already exists';   
                    }
            }
            set_alert('error', $msg);
        }
        
        $queryadd_cat = new query('additional_categories');
        $queryadd_cat->Field = "id,name_en";
        $add_cat_name = $queryadd_cat->ListOfAllRecords();
        break;
        
    case 'edit':
        if (isset($app['POST']['update'])) {
            $msg = '';
            if($app['POST']['add_cat'] == ''){
                $msg = 'Please choose additional category';  
            }elseif (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                    $query = new query('add_cat_sub');
                    $query->Data['id'] = $id;
                    $query->Data['add_cat_id'] = $app['POST']['add_cat'];
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['position'] = $app['POST']['position'];
                    $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                    $query->Data['is_deleted'] = isset($app['POST']['delete'])? '1': '0';
                    if ($query->Update()) {
                        set_alert('success', "Account info updated successfully");
                        redirect(app_url('add_cat_sub','edit','edit',array('id'=>$id),true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
            }
            set_alert('error', $msg);
        }
        $query = new query('add_cat_sub');
        $query->Where = "where id = ".$id;
        $add_cat_sub = $query->DisplayOne();
        if(!(is_object($add_cat_sub))){
            redirect(app_url('add_cat_sub','list','list',array(),true));
        }
        
        $queryadd_cat = new query('additional_categories');
        $queryadd_cat->Field = "id,name_en";
        $add_cat_name = $queryadd_cat->ListOfAllRecords();
        break;
        
    case 'delete_add_cat_sub':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('add_cat_sub');
            $query->id = $app['GET']['del'];
            $query->Field = " is_deleted ";
            $query->Where = " where id = '" . $app['GET']['del']. "'";
            $add_cat_sub = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($add_cat_sub))){
            redirect(app_url('add_cat_sub','list','list',array(),true));
        }
        break;
        
    case 'list':
        $query = new query('add_cat_sub');
        $query->Where = " order by position";
        $add_cat_subs = $query->ListOfAllRecords('object');
        $data =   pagination('add_cat_sub',$limit,$page_no,$url='',' position asc');
        $add_cat_subs= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
