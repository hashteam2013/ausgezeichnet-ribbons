<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);   
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "") ? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
/* get districts */
$query = new query('districts');
$query->Where = " where is_active = '1' order by position";
$get_districts = $query->ListOfAllRecords();
/* get subdistricts */
$query = new query('sub_districts');
$query->Where = " where is_active = '1' order by position";
$get_subdistricts = $query->ListOfAllRecords();
//pr($get_subdistricts);
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if ($app['POST']['name_dist'] == '') {
                $msg = 'Please choose district name for community';
            } elseif (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            } elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            } elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else {
                $queryObj = new query('communities');
                $queryObj->Field = " id";
                $queryObj->Where = " where name_en = '" . $app['POST']['nameen'] . "'";
                $object = $queryObj->DisplayOne();
                if (!is_object($object)) {
                    $query = new query('communities');
                    $query->Data['dist_id'] = isset($app['POST']['name_dist']) ? $app['POST']['name_dist'] : '';
                    $query->Data['subdist_id'] = (isset($app['POST']['name_subdist']) && $app['POST']['name_subdist'] != '') ? $app['POST']['name_subdist'] : '0';
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['position'] = $app['POST']['position'];
                    $query->Data['date_add'] = 1;
                    $query->Data['is_active'] = isset($app['POST']['active']) ? $app['POST']['active'] : '0';
                    $query->Data['is_deleted'] = isset($app['POST']['delete']) ? $app['POST']['delete'] : '0';
                    if ($query->Insert()) {
                        set_alert('success', "New community added successfully");
                        redirect(app_url('communities', 'list', 'list', array(), true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
                } else {
                    $msg = 'community name already exist';
                }
            }
            set_alert('error', $msg);
        }
        break;

    case 'edit':
        if (isset($app['POST']['update'])) {
            $msg = '';
            if ($app['POST']['name_dist'] == '') {
                $msg = 'Please choose district name for community';
            } elseif (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            } elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            } elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } else {
                $query = new query('communities');
                $query->Data['id'] = $id;
                $query->Data['dist_id'] = $app['POST']['name_dist'];
                $query->Data['subdist_id'] = (isset($app['POST']['name_subdist']) && $app['POST']['name_subdist'] != '') ? $app['POST']['name_subdist'] : '0';
                $query->Data['name_en'] = $app['POST']['nameen'];
                $query->Data['name_dr'] = $app['POST']['namedr'];
                $query->Data['position'] = $app['POST']['position'];
                $query->Data['is_active'] = isset($app['POST']['active']) ? '1' : '0';
                if ($query->Update()) {
                    set_alert('success', "Account info updated successfully");
                    redirect(app_url('communities', 'edit', 'edit', array('id' => $id), true));
                } else {
                    $msg = 'Error occurred while updating account info. Please try again!';
                }
            }
            set_alert('error', $msg);
        }
        $query = new query('communities as comm');
        $query->Field = "comm.id,comm.name_en,comm.name_dr,comm.is_active,dis.name_en as dist_name,subdist.name_en as subname,"
                . "comm.dist_id as dist_id,comm.subdist_id as subdist_id,comm.position";
        $query->Where = " LEFT JOIN districts as dis ON dis.id = comm.dist_id";
        $query->Where .= " LEFT JOIN sub_districts as subdist ON subdist.id = comm.subdist_id";
        $query->Where .= " where comm.id = " . $id;
        $communities = $query->DisplayOne();
        //pr($communities);
        if (!(is_object($communities))) {
            redirect(app_url('communities', 'list', 'list', array(), true));
        }

        break;


    case 'delete_community':
        if (isset($app['GET']['del']) && $app['GET']['del'] != '') {
            $query = new query('communities');
            $query->id = $app['GET']['del'];
            $communities = $query->Delete();
        } else {
            set_alert('error', 'Incorrect information');
        }
        if (!(is_object($communities))) {
            redirect(app_url('communities', 'list', 'list', array(), true));
        }
        break;


    case 'list':
        $query = new query('communities');
        $query->Where = " order by position";
        $communities = $query->ListOfAllRecords('object');
        $data = pagination('communities', $limit, $page_no, $url = '', 'position asc');
        $communities = $data['show_record'];
        $pagination = $data['pagination'];
        break;
endswitch;
