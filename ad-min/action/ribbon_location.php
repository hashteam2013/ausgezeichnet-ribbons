<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['name']) == '') {
                $msg = 'Please enter name';
            }
            else if($app['POST']['position'] == ''){
                $msg = 'Please enter position';
            }else {
                $queryObj = new query('ribbon_location');
                $queryObj->Field = " id";
                $queryObj->Where = " where name = '".$app['POST']['name']."'";
                $object = $queryObj->DisplayOne();
                if(!is_object($object)){
                $query = new query('ribbon_location');
                $query->Data['SetID'] = $app['POST']['SetID'];
                $query->Data['name'] = $app['POST']['name'];
                $query->Data['position'] = $app['POST']['position'];
                $query->Data['date_add'] = '1';
                if ($query->Insert()) {
                    set_alert('success', "Ribbon Location added successfully");
                    redirect(app_url('ribbon_location', 'list', 'list', array(), true));
                } else {
                    $msg = 'Error occurred while updating account info. Please try again!';
                }
                } else{
                        $msg = ' same location already exist';   
                }
            }
            set_alert('error', $msg);
        }
        break;

    case 'edit':

        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['name']) == '') {
                $msg = 'Please enter name';
            }else if($app['POST']['position'] == ''){
                $msg = 'Please enter position';
            } else {
                $query = new query('ribbon_location');
                $query->Data['id'] = $id;
                $query->Data['name'] = $app['POST']['name'];
                $query->Data['SetID'] = $app['POST']['SetID'];
                $query->Data['position'] = $app['POST']['position'];
                if ($query->Update()) {
                    set_alert('success', "Location updated successfully");
                    redirect(app_url('ribbon_location', 'edit', 'edit', array('id' => $id), true));
                } else {
                    $msg = 'Error occurred while updating account info. Please try again!';
                }
            }
            set_alert('error', $msg);
        }
        $query = new query('ribbon_location');
        $query->Where = "where id = " . $id;
        $ribbon_location = $query->DisplayOne();
        if (!(is_object($ribbon_location))) {
            redirect(app_url('ribbon_location', 'list', 'list', array(), true));
        }

        break;

    case 'delete_ribbon_location':
        if (isset($app['GET']['del']) && $app['GET']['del'] != '') {
            $query = new query('ribbon_location');
            $query->id = $app['GET']['del'];
            $ribbon_location = $query->Delete();
        } else {
            set_alert('error', 'Incorrect information');
        }
        if (!(is_object($ribbon_location))) {
            redirect(app_url('ribbon_location', 'list', 'list', array(), true));
        }
        break;

    case 'list':
        $query = new query('ribbon_location');
        $query->Where = " order by position";
        $ribbon_location = $query->ListOfAllRecords('object');
        $data =   pagination('ribbon_location',$limit,$page_no,$url='','position asc');
        $ribbon_location= $data['show_record'];
        $pagination = $data['pagination'];
        break;

endswitch;

