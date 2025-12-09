<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$query = new query('international_authorities');
$query->Where = " where is_active = '1' order by position";
$get_ia = $query->ListOfAllRecords();
switch ($action):
case 'add':
 if (isset($app['POST']['add'])) {
            $msg = '';
            if($app['POST']['name_ia'] == ''){
               $msg = 'Please choose international authority first'; 
            }elseif (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            }elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            }elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else{
                $queryObj = new query('international_authorities_sublevel1');
                $queryObj->Field = " id";
                $queryObj->Where = " where name_en = '".$app['POST']['nameen']."'";
                $object = $queryObj->DisplayOne();
                if(!is_object($object)){
                    $query = new query('international_authorities_sublevel1');
                    $query->Data['ia_id'] = $app['POST']['name_ia'];
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['position'] = $app['POST']['position'];
                    $query->Data['date_add'] = 1;
                    $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                    if ($query->Insert()) {
                        set_alert('success', "New international authority sublevel1 added successfully");
                        redirect(app_url('international-authorities-sublevel1','list','list',array(),true));
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
                    $query = new query('international_authorities_sublevel1');
                    $query->Data['id'] = $id;
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['position'] = $app['POST']['position'];
                    $query->Data['is_active'] = isset($app['POST']['active'])? '1': '0';
                    if ($query->Update()) {
                        set_alert('success', "Account info updated successfully");
                        redirect(app_url('international-authorities-sublevel1','edit','edit',array('id'=>$id),true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
            }
            set_alert('error', $msg);
        }
        $query = new query('international_authorities_sublevel1 as ia_auth');
        $query->Field = "ia_auth.id,ia_auth.ia_id as ia_id,ia_auth.name_en,ia_auth.name_dr,ia_auth.position,ia_auth.is_active,ia.name_en as ia_name_en";
        $query->Where = " LEFT JOIN international_authorities as ia ON ia.id = ia_auth.ia_id";
        $query->Where .= " where ia_auth.id = ".$id;
        //$query->print=1;
        $ia_sub1 = $query->DisplayOne();
       //pr($ia_sub1);
        if(!(is_object($ia_sub1))){
            redirect(app_url('international-authorities-sublevel1','list','list',array('id'=>$id),true));
        }
        break;
        
        
  case 'delete_ia':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('international_authorities_sublevel1');
            $query->id = $app['GET']['del'];
           // $query->print=1;
            $sdistricts = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        if(!(is_object($sdistricts))){
            redirect(app_url('international-authorities-sublevel1','list','list',array(),true));
        }
        break;

case 'list':
        $query = new query('international_authorities_sublevel1');
        $query->Where = " order by position";
        $subia = $query->ListOfAllRecords('object');
        break;
endswitch;
?>
