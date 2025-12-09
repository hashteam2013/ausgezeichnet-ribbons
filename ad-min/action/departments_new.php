<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "") ? $app['GET']['page_no'] : 1;
$limit = 10;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['nameen']) == '') {
                $msg = 'Please enter english name';
            } elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            } elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } elseif (trim($app['POST']['max_ribbon']) == '') {
                $msg = 'Please enter max allowed ribbon';
            } elseif (trim($app['POST']['serious_level']) == '') {
                $msg = 'Please enter integrity level';
            } else {
                $queryObj = new query('departments_new');
                $queryObj->Field = " id";
                $queryObj->Where = " where name_en = '" . $app['POST']['nameen'] . "'";
                $object = $queryObj->DisplayOne();
                if (!is_object($object)) {
                    $query = new query('departments_new');
                    $query->Data['name_en'] = $app['POST']['nameen'];
                    $query->Data['name_dr'] = $app['POST']['namedr'];
                    $query->Data['date_add'] = 1;
                    $query->Data['position'] = $app['POST']['position'];
                    $query->Data['max_ribbon'] = $app['POST']['max_ribbon'];
                    $query->Data['serious_level'] = $app['POST']['serious_level'];
                    $query->Data['is_active'] = isset($app['POST']['active']) ? $app['POST']['active'] : '0';
                    $query->Data['is_selected'] = isset($app['POST']['selectable']) ? $app['POST']['selectable'] : '0';
                    $query->Data['is_allowed'] = isset($app['POST']['allow']) ? $app['POST']['allow'] : '0';
                    $query->Data['is_deleted'] = isset($app['POST']['delete']) ? $app['POST']['delete'] : '0';
                    //$query->print=1;
                    if ($query->Insert()) {
                        set_alert('success', "New department added successfully");
                        redirect(app_url('departments_new', 'edit', 'edit', array('id' => $id), true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
                } else {
                    $msg = 'Department name already exist';
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
            } elseif (trim($app['POST']['namedr']) == '') {
                $msg = 'Please enter german name';
            } elseif (trim($app['POST']['position']) == '') {
                $msg = 'Please enter position';
            } elseif (trim($app['POST']['max_ribbon']) == '') {
                $msg = 'Please enter max allowed ribbons';
            } else {
                $query = new query('departments_new');
                $query->Data['id'] = $id;
                $query->Data['name_en'] = $app['POST']['nameen'];
                $query->Data['name_dr'] = $app['POST']['namedr'];
                $query->Data['position'] = $app['POST']['position'];
                $query->Data['max_ribbon'] = $app['POST']['max_ribbon'];
                    $query->Data['serious_level'] = $app['POST']['serious_level'];
                $query->Data['is_active'] = isset($app['POST']['active']) ? '1' : '0';
                $query->Data['is_selected'] = isset($app['POST']['selectable']) ? $app['POST']['selectable'] : '0';
                $query->Data['is_allowed'] = isset($app['POST']['allow']) ? '1' : '0';
                $query->Data['is_deleted'] = isset($app['POST']['delete']) ? '1' : '0';
                if ($query->Update()) {
                    set_alert('success', "Account info updated successfully");
                    redirect(app_url('departments_new', 'edit', 'edit', array('id' => $id), true));
                } else {
                    $msg = 'Error occurred while updating account info. Please try again!';
                }
            }
            set_alert('error', $msg);
        }
        $query = new query('departments_new');
        $query->Where = "where id = " . $id;
        $departments = $query->DisplayOne();
        if (!(is_object($departments))) {
            redirect(app_url('departments_new', 'list', 'list', array(), true));
        }
        break;

    case 'delete_department':
        if (isset($app['GET']['del']) && $app['GET']['del'] != '') {
            $query = new query('departments_new');
            $query->id = $app['GET']['del'];
            $query->Field = " is_deleted ";
            $query->Where = " where id = '" . $app['GET']['del'] . "'";
            $departments = $query->Delete();
        } else {
            set_alert('error', 'Incorrect information');
        }
        if (!(is_object($departments))) {
            redirect(app_url('departments_new', 'list', 'list', array(), true));
        }
        break;

    case 'list':
        $query = new query('departments_new');
        $query->Where = " order by position";
        $departments = $query->ListOfAllRecords('object');
        $data = pagination('departments_new', $limit, $page_no, $url = '', 'position asc');
        $departments = $data['show_record'];
        $pagination = $data['pagination'];
        /*get all departments list for manage position*/
        $query = new query('departments_new');
        $query->Where = " where is_active = '1' order by position";
        $departmentslist = $query->ListOfAllRecords();
        $id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
        if($id != '0' || $id != ''){
            $query = new query('departments_new');
            $query->Where = " where id != $id and is_active = '1' order by position";
            $departments = $query->ListOfAllRecords('object');
        /* get possitions  */
        $query = new query('departments_possitions');
        $query->Where = " where main_department = $id";
        $Setpositions = $query->ListOfAllRecords();
        $positions = array();
        foreach ($Setpositions as $val) {
            $positions[$val['related_department']] = $val['position'];
        }}
        break;

    case 'department_pos':
        $output = array();
        $id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
        /* first tym main depart list */
        $query = new query('departments_new');
        $query->Where = " where is_active = '1' order by position";
        $departmentslist = $query->ListOfAllRecords();
        /* if main depart is selected */
        if ($id != '0') {
            $query = new query('departments_new');
            $query->Where = " where id != $id and is_active = '1' order by position";
            $departmentsexcID = $query->ListOfAllRecords();
        }
        /* if possitions are set previously */
        $query = new query('departments_possitions');
        $query->Where = " where main_department = $id";
        $Setpositions = $query->ListOfAllRecords();
        $positions = array();
        foreach ($Setpositions as $val) {
            $positions[$val['related_department']] = $val['position'];
        }
        /* add positions */
        if (isset($app['POST']['add_pos'])) {
            /* Start get all related_departments of main department */
            $query = new query('departments_possitions');
            $query->Field = "related_department";
            $query->Where = " where main_department =" . $app['POST']['main_depart'];
            $Alldepart = $query->ListOfAllRecords();
            $departarr = array_map('current', $Alldepart);
            //pr($departarr);
            /* End get all related_departments of main department */
            $pos_depart = isset($app['POST']['pos_no']) ? $app['POST']['pos_no'] : '';
            foreach ($pos_depart as $rel_depart => $pos_val) {
                if (in_array($rel_depart, $departarr)) {
                    $query = new query('departments_possitions');
                    $query->Data['main_department'] = isset($app['POST']['main_depart']) ? $app['POST']['main_depart'] : '';
                    $query->Data['related_department'] = $rel_depart;
                    $query->Data['position'] = $pos_val;
                    $query->Where = " where main_department = " . $app['POST']['main_depart'] . " and related_department = " . $rel_depart;
                    if ($query->UpdateCustom()) {
                        $output['status'] = "success";
                        $output['message'] = "Record inserted successfully.";
                    }
                } else {
                    $query = new query('departments_possitions');
                    $query->Data['main_department'] = isset($app['POST']['main_depart']) ? $app['POST']['main_depart'] : '';
                    $query->Data['related_department'] = $rel_depart;
                    $query->Data['position'] = $pos_val;
                    if ($query->insert()) {
                        $output['status'] = "success";
                        $output['message'] = "Record inserted successfully.";
                    }
                }
            }
            set_alert($output['status'], $output['message']);
            redirect(app_url('departments_new', 'department_pos', 'department_pos', array('id' => $app['POST']['main_depart']), true));
        }
        Break;
endswitch;
