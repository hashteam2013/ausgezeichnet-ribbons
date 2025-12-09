<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
/*get districts */
$query = new query('districts');
$query->Where = " where is_active = '1' order by position";
$get_districts = $query->ListOfAllRecords();
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if($app['POST']['name_dist'] == ''){
                $msg = 'Please choose district name';  
            }elseif (trim($app['POST']['name_subdist']) == '') {
                $msg = 'Please choose subdistrict name';
            }elseif (trim($app['POST']['name_comm']) == '') {
                $msg = 'Please choose community name';
            }elseif (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                        $queryObj = new query('boroughs');
                        $queryObj->Field = " id";
                        $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                        $object = $queryObj->DisplayOne();
                        if(!is_object($object)){
                            $query = new query('boroughs');
                            $query->Data['dist_id'] = isset($app['POST']['name_dist'])?$app['POST']['name_dist']:'';
                            $query->Data['subdist_id'] = isset($app['POST']['name_subdist'])?$app['POST']['name_subdist']:'';
                            $query->Data['comm_id'] = isset($app['POST']['name_comm'])?$app['POST']['name_comm']:'';
                            $query->Data['name_en'] = $app['POST']['nameen'];
                            $query->Data['name_dr'] = $app['POST']['namedr'];
                            $query->Data['position'] = $app['POST']['position'];
                            $query->Data['date_add'] = 1;
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            if ($query->Insert()) {
                                set_alert('success', "New borough added successfully");
                                redirect(app_url('boroughs','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                             } else{
                            $msg = 'borough name already exist';   
                        }
            }
            set_alert('error', $msg);
        }
        break;
        
    case 'edit':
        if (isset($app['POST']['update'])) {
            //pr($app['POST']);
            $msg = '';
             if($app['POST']['name_dist'] == ''){
              $msg = 'Please choose district name';  
            }elseif (trim($app['POST']['name_subdist']) == '') {
                $msg = 'Please choose subdistrict name';
            }elseif (trim($app['POST']['name_comm']) == '') {
                $msg = 'Please choose community name';
            }elseif (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                    $query = new query('boroughs');
                    $query->Data['id'] = $id;
                    $query->Data['dist_id'] = $app['POST']['name_dist'];
                    $query->Data['subdist_id'] = $app['POST']['name_subdist'];
                     $query->Data['comm_id'] = $app['POST']['name_comm'];
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['position'] = $app['POST']['position'];
                    $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                    if ($query->Update()) {
                        set_alert('success', "Account info updated successfully");
                        redirect(app_url('boroughs','edit','edit',array('id'=>$id),true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
            }
            set_alert('error', $msg);
        }
        
        /*get all subdistrict using selected district id*/
        $query = new query("boroughs");
        $query->Field = "dist_id,subdist_id";
        $query->Where = " where id = $id and is_active = '1'";
        $boro_editrec = $query->DisplayOne('object');
        if(!empty($boro_editrec->dist_id))
        {
        $query = new query("sub_districts");
        $query->Where = " where district_id = $boro_editrec->dist_id and is_active = '1'";
        $subdist_byselDist = $query->ListOfAllRecords();
        }
        
        /*get all communities using selected district id & subdistr_id*/
        if(!empty($boro_editrec->subdist_id))
        {
        $query = new query("communities");
        $query->Where = " where dist_id = $boro_editrec->dist_id and  subdist_id = $boro_editrec->subdist_id and is_active = '1'";
        $comm_byselDissub = $query->ListOfAllRecords();
        }
        
        /*get all records from borough in edit case*/
        $query = new query('boroughs as boro');
        $query->Field = "boro.id,boro.name_en,boro.name_dr,boro.is_active,dis.name_en as dist_name,subdist.name_en as subname,"
                . "boro.dist_id as dist_id,boro.subdist_id as subdist_id,boro.position,boro.comm_id,commo.name_en as comm_name";
        $query->Where = " LEFT JOIN districts as dis ON dis.id = boro.dist_id";
        $query->Where .= " LEFT JOIN sub_districts as subdist ON subdist.id = boro.subdist_id";
        $query->Where .= " LEFT JOIN communities as commo ON commo.id = boro.comm_id";
        $query->Where .= " where boro.id = ".$id;
        $boro = $query->DisplayOne();
        if(!(is_object($boro))){
            redirect(app_url('boroughs','list','list',array(),true));
        }
        break;
           
           
     case 'delete_borough':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('boroughs');
            $query->id = $app['GET']['del'];
            $delborough = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($delborough))){
            redirect(app_url('boroughs','list','list',array(),true));
        }
        break;

    case 'list':
        $query = new query('boroughs');
        $query->Where = " order by position";
        $boroughs = $query->ListOfAllRecords('object');
        $data =   pagination('boroughs',$limit,$page_no,$url='','position asc');
        $communities= $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
