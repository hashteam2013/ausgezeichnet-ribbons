<?php
//pr(FS_PATH_ADMIN);
global $app;
switch ($action):
    case 'upload':
        if (isset($app['POST']['upload'])) {
            $msg = '';
            $total = $succuss = $unsuccussful = $database_insert_error = $email_already_exists = $invalid_email = $email_empty = $name_empty = $email_suspended = 0;
            $destination = FS_PATH_ADMIN . 'uploads/';
            $random = rand(1000, 9999);
            if (uploadfile($_FILES['file'], $conf_allowed_file_mime_type, $destination, $random, $msg)) {
                $filename = make_file_name($_FILES['file']['name'], $random);
                if (file_exists($destination . $input_file_name)) {
                    if (($handle = fopen($destination . $filename, "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, '', ",")) !== FALSE) {
                            if ($total != 0) {
                                if(trim($data[0])!=''){
                                    if(trim($data[1])!=''){
                                        if(filter_var(trim($data[1]), FILTER_VALIDATE_EMAIL)){ 
                                            $checkquery = new query('email_addresses');
                                            $checkquery -> Where = " where email = '".trim($data[1])."'";
                                            $object = $checkquery ->DisplayOne();
                                            if(!(is_object($object))){
                                                $query = new query('email_addresses');
                                                $query->Data['name'] = ucwords(trim($data[0]));
                                                $query->Data['email'] = trim($data[1]);
                                                $query->Data['checked_by'] = trim($data[2]);
                                                $query->Data['uploaded_by'] = $app['admin_info']->id;
                                                $query->Data['date_add'] ='1';
                                                if($query->Insert()){
                                                    // successfull
                                                    $succuss++;
                                                } else{
                                                    // database insert error
                                                    $database_insert_error++;
                                                    $unsuccussful++;
                                                }
                                            } else{
                                                if($object->is_suspended=='1'){
                                                    // email already suspended
                                                    $email_suspended++;
                                                    $unsuccussful++;
                                                } else{
                                                    // email already exists
                                                    $email_already_exists++;
                                                    $unsuccussful++;
                                                }
                                            }
                                        } else{
                                            //invalid email
                                            $invalid_email++;
                                            $unsuccussful++;
                                        }
                                    } else{
                                        // email empty
                                        $email_empty++;
                                        $unsuccussful++;
                                    }   
                                } else{
                                    // name empty
                                    $name_empty++;
                                    $unsuccussful++;
                                }
                            }
                            $total++;
                        }
                        fclose($handle);
                        $total = $total-1; //exclude first header row
                        $query = new query('upload_stats');
                        $query->Data['file_name'] = $_FILES['file']['name'];
                        $query->Data['added_file_name'] = $filename;
                        $query->Data['total'] = $total;
                        $query->Data['succuss'] = $succuss;
                        $query->Data['unsuccussful'] = $unsuccussful;
                        $query->Data['database_insert_error'] = $database_insert_error;
                        $query->Data['email_already_exists'] = $email_already_exists;
                        $query->Data['invalid_email'] = $invalid_email;
                        $query->Data['email_empty'] = $email_empty;
                        $query->Data['name_empty'] = $name_empty;
                        $query->Data['email_suspended'] = $email_suspended;
                        $query->Data['uploaded_by'] = $app['admin_info']->id;
                        $query->Data['date_add'] ='1';
                        if($query->Insert()){
                            set_alert('success', "Entries added successfully (success : $succuss, Total : $total)");
                            redirect(app_url('stats', 'upload', 'upload', array(), true));
                        } else{
                            $msg = "Entries added succussfully but unable to generate stats (success : $succuss, Total : $total)";
                        }
                    } else{
                        $msg = "Unable to read uploaded file!";
                    }
                } else{
                   $msg = "Error occurred while saving file on server!"; 
                }
            } else {
                if ($msg == '') {
                    $msg = "Error occurred while uploading file!";
                }
            }
            set_alert('error', $msg);
        }
        break;

    case 'unsubscribe':
        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['email']) == '') {
                $msg = 'Please enter email';
            } elseif (!(filter_var($app['POST']['email'], FILTER_VALIDATE_EMAIL))){
                $msg = 'Please enter valid email';
            } elseif (trim($app['POST']['reason']) == '') {
                $msg = 'Please enter reason';
            } elseif ($app['POST']['reason']=='other' && trim($app['POST']['reason_other'])=='') {
                $msg = 'Please enter reason';
            } else {
                $queryObj = new query('email_addresses');
                $queryObj->Field = " id,is_suspended";
                $queryObj->Where = " where email = '".$app['POST']['email']."'";
                $object = $queryObj->DisplayOne();
                if (is_object($object) && count($object)) {
                    if($object->is_suspended=='1'){
                        $msg = 'Already unsubscribed';
                    } else{
                        $query = new query('email_addresses');
                        $query->Data['id'] = $object->id;
                        $query->Data['is_suspended'] ='1';
                        if($app['POST']['reason']=='other'){
                            $query->Data['suspend_reason']= '';
                            $query->Data['suspend_reason_other']= $app['POST']['reason_other'];
                        } else{
                            $query->Data['suspend_reason']= $app['POST']['reason'];
                            $query->Data['suspend_reason_other']= '';
                        }
                        $query->Data['suspend_date'] = date("Y-m-d H:i:s");
                        if ($query->Update()) {
                            set_alert('success', "Email address moved to unsubscribe list.");
                            redirect(app_url('email_addresses','unsubscribe','unsubscribe',array(),true));
                        } else {
                            $msg = 'Error occurred while updating email subscription. Please try again!';
                        }
                    }
                } else{
                    $msg = 'Email address not added in database';
                }
            }
            set_alert('error', $msg);
        }
        break;
    default:
        break;
endswitch;
