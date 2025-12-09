<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";

$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "") ? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['name']) == '') {
                $msg = 'Please enter name';
            } else {
                $queryObj = new query('miniatures');
                $queryObj->Field = " id";
                $queryObj->Where = " name = '" . $app['POST']['name'] . "'";
                $object = $queryObj->DisplayOne();

                if (!is_object($object)) {
                            $query = new query('messages');
                            $query->Data['subject'] = $app['POST']['subject'];
                            $query->Data['message'] = $app['POST']['message'];

                            if ($query->Insert()) {
                                      set_alert('success', "New message added successfully");
                                       redirect(app_url('messages', 'list', 'list', array(), true));
                            } 
		else 
		{
                                   $msg = 'Error occurred while updating info. Please try again!';
                            }
                } else {
                    $msg = 'Miniature subject already exists';
                }
            }
            set_alert('error', $msg);
            break;
        }



$query3 = new query('messages');
$query3->Where = "  ";

$miniatures = $query3->ListOfAllRecords('object');
            break;


    case 'edit':


        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['name']) == '') {
                $msg = 'Please enter name';
            }else{
                            $query = new query('messages');
                            $query->Data['id'] = $id;
                            $query->Data['subject'] = $app['POST']['subject'];
                            $query->Data['message'] = $app['POST']['message'];


                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('messages','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('messages');
        $query->Where = " WHERE id=$id ";
        $miniatures = $query->DisplayOne();
        if(!(is_object($messages))){
            redirect(app_url('messages','list','list',array(),true));
        }
        



        break;

    case 'delete_message':
        if (isset($app['GET']['del']) && $app['GET']['del'] != '') {
            $query = new query('messages');
            $query->id = $app['GET']['del'];
            $miniature = $query->Delete();

            $query2 = new query('messages');
            $query2->Where = "Where message_id =" . $app['GET']['del'];
            $query2->Delete_where();
        } else {
            set_alert('error', 'Incorrect information');
        }
        if (!(is_object($messages))) {
            redirect(app_url('messages', 'list', 'list', array(), true));
        }
        break;


    case 'list':

$query3 = new query('messages');
 $query3->Field = "messages.id as id, messages.subject as subject";
$messages = $query3->ListOfAllRecords('object');



//    $data = pagination('miniatures', $limit, $page_no, $url = '', 'id asc');
//     $miniatures = $data['show_record'];
//   $pagination = $data['pagination'];
        break;

endswitch;
