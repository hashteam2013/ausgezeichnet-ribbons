<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = 10;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            //pr($app['POST']);
            $msg = '';
            if (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                
                $queryObj = new query('international_authorities');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                     
                        if(!is_object($object)){
                         
                            $query = new query('international_authorities');
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            // ensure non-nullable column is always set
                            $query->Data['is_deleted'] = '0';
                            // populate required timestamp column
                            $query->Data['date_add'] = date('Y-m-d H:i:s');
                            if ($query->Insert()) {
                           
                                set_alert('success', "New international authorities added successfully");
                                redirect(app_url('international-authorities','list','list',array(),true));
                            } else {
                                
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                             } else{
                            $msg = 'International authorities name already exist';   
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
                            $query = new query('international_authorities');
                            $query->Data['id'] = $id;
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('international-authorities','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('international_authorities');
        $query->Where = "where id = ".$id;
        $districts = $query->DisplayOne();
        if(!(is_object($districts))){
            redirect(app_url('international_authorities','list','list',array(),true));
        }
        
        break;
           break;
           
     case 'delete_district':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('international_authorities');
            $query->id = $app['GET']['del'];
            $districts = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($districts))){
            redirect(app_url('international_authorities','list','list',array(),true));
        }
        break;

    case 'list':
        $query = new query('international_authorities');
        $query->Where = " order by position";
        $districts = $query->ListOfAllRecords('object');
        $data =   pagination('international_authorities',$limit,$page_no,$url='','position asc');
        $districts= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;

?>