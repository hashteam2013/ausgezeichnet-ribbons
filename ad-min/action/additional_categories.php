<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            //  echo "<pre>";
            //  print_r($app['POST']);
            // exit;
            $msg = '';
            if(trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                $queryObj = new query('additional_categories');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('additional_categories');
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            // ensure DB gets required flag even though form omits the field
                            $query->Data['is_district_related'] = '0';
                            $query->Data['is_deleted'] = '0';
                            $query->Data['date_add'] = date('Y-m-d H:i:s');
                            $query->Data['show_closed'] = '0';
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            if ($query->Insert()) {
                               set_alert('success', "New additional_category added successfully");
                                redirect(app_url('additional_categories','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                        } else {
                            $msg = 'additional_category name already exist';   
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
                            $query = new query('additional_categories');
                            $query->Data['id'] = $id;
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            //$query->Data['is_district_related'] = isset($app['POST']['district'])? '1':'0';
                            $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('additional_categories','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('additional_categories');
        $query->Where = "where id = ".$id;
        $additional_categories = $query->DisplayOne();
        if(!(is_object($additional_categories))){
            redirect(app_url('additional_categories','list','list',array(),true));
        }
        break;
        
    case 'delete_additional_category':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('additional_categories');
            $query->id = $app['GET']['del'];
            $additional_categories = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($additional_categories))){
            redirect(app_url('additional_categories','list','list',array(),true));
        }
        break;
        
    case 'list':
        $query = new query('additional_categories');
        $query->Where = " order by position";
        $additional_categories = $query->ListOfAllRecords('object');
        $data =   pagination('additional_categories',$limit,$page_no,$url='','position asc');
        $additional_categories= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
