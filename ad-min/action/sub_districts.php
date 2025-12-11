<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$query = new query('districts');
$query->Where = " where is_active = '1' order by position";
$get_districts = $query->ListOfAllRecords();
switch ($action):
case 'add':
 if (isset($app['POST']['add'])) {
            $msg = '';
            if($app['POST']['name_dist'] == ''){
               $msg = 'Please choose district first'; 
            }elseif (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                $queryObj = new query('sub_districts');
                $queryObj->Field = " id";
                $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                $object = $queryObj->DisplayOne();
                if(!is_object($object)){
                    $query = new query('sub_districts');
                    $query->Data['district_id'] = $app['POST']['name_dist'];
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['position'] = $app['POST']['position'];
                    // store created timestamp and ensure required flags are set
                    $query->Data['date_add'] = date('Y-m-d H:i:s');
                    $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                    $query->Data['is_deleted'] = '0';
                    if ($query->Insert()) {
                        set_alert('success', "New sub district added successfully");
                        redirect(app_url('sub_districts','list','list',array(),true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
                     } else{
                    $msg = 'Sub district name already exist';   
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
                    $query = new query('sub_districts');
                    $query->Data['id'] = $id;
                    $query->Data['district_id'] = $app['POST']['name_dist'];
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['position'] = $app['POST']['position'];
                    $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                    if ($query->Update()) {
                        set_alert('success', "Account info updated successfully");
                        redirect(app_url('sub_districts','edit','edit',array('id'=>$id),true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
            }
            set_alert('error', $msg);
        }
        $query = new query('sub_districts as s_dist');
        $query->Field = "s_dist.id,s_dist.district_id as dist_id,s_dist.name_en,s_dist.name_dr,s_dist.position,s_dist.is_active,dis.name_en as district_name_en";
        $query->Where = " LEFT JOIN districts as dis ON dis.id = s_dist.district_id";
        $query->Where .= " where s_dist.id = ".$id;
        $s_districts = $query->DisplayOne();
        //pr($s_districts);
        if(!(is_object($s_districts))){
            redirect(app_url('sub_districts','list','list',array(),true));
        }
        break;
        
        
  case 'delete_sub_district':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('sub_districts');
            $query->id = $app['GET']['del'];
            $sdistricts = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($sdistricts))){
            redirect(app_url('sub_districts','list','list',array(),true));
        }
        break;

case 'list':
        $query = new query('sub_districts');
        $query->Where = " order by position";
        $subdistricts = $query->ListOfAllRecords('object');
        break;
endswitch;
?>
